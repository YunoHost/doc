#!/usr/bin/env python3

import argparse
import datetime
import os
import re
import subprocess
import tempfile
import textwrap
from pathlib import Path

import requests

DOCS_DIR = Path(__file__).parent.parent.resolve()

yaml_front_matter_keys_to_translate = ["title", "description", "sidebar_label"]

options = [
    "--master-language en",
    "--master-charset UTF-8",
    "--localized-charset UTF-8",
    "--package-name 'YunoHost documentation'",
    "--copyright-holder 'YunoHost Contributors'",
]

tags_to_ignore_even_if_they_have_attributes = [
    "div",
    "img",
    "YunoHostDocsCard",
    "YunoHostDocsCardHeading",
    "YunoHostImagesList",
    "Tabs",
    "InitialConfiguration",
    "InstallScript",
    "DocCardList",
]
patterns_to_ignore = [
    r"import.*;",
    r"^\s*\<\S*\>\s*$",
    r"\s*<(" + "|".join(tags_to_ignore_even_if_they_have_attributes) + ").*>",
    r"\!\[\]\(/img/\S*\)",
]


def download_po4a() -> Path:
    po4a_path = DOCS_DIR / ".po4a"
    po4a_url = (
        "https://github.com/mquinson/po4a/releases/download/v0.74/po4a-0.74.tar.gz"
    )
    po4a_tarball = DOCS_DIR / ".po4a.tar.gz"

    if not po4a_path.exists():
        response = requests.get(po4a_url, stream=True)
        assert response.status_code == 200
        po4a_tarball.write_bytes(response.raw.read())

        po4a_path.mkdir()
        subprocess.check_call(
            ["tar", "xzf", po4a_tarball, "--strip-components=1"], cwd=po4a_path
        )
        po4a_tarball.unlink()

    assert (po4a_path / "po4a").exists()
    return po4a_path


def translated_langs() -> list[str]:
    # Find the translated langs from docusaurus config
    docusaurus_config = DOCS_DIR / "docusaurus.config.ts"
    langs_match = re.search(
        r"\n\s*const enabled_locales\s*=\s*\[([^\]]*)\]\s*;",
        docusaurus_config.read_text(),
    )
    assert langs_match
    langs = langs_match[1].replace('"', "").replace(" ", "").split(",")
    langs.remove("en")
    return langs


def po4a_config(langs: list[str], pages: list[str], print_whole: bool = False) -> str:
    breaks = f"breaks='{'|'.join(patterns_to_ignore)}'"
    yfm_keys = f"yfm_keys={','.join(yaml_front_matter_keys_to_translate)}"

    conf = textwrap.dedent(f"""
        [options] {" ".join(options)}
        [po4a_alias:markdown] text opt:"--option markdown --option {breaks} --option neverwrap --option nobullets --option {yfm_keys}"

        [po4a_langs] {" ".join(langs)}
        [po4a_paths] i18n/docs/admin/$master/en.pot $lang:i18n/docs/admin/$master/$lang.po
    """)

    if not print_whole:
        print("=" * 20)
        print(conf)
        print("=" * 20)

    for page in pages:
        pot = page.replace("/", "__")[: -len(".mdx")]
        conf += f'\n[type: markdown] ./docs/admin/{page} $lang:i18n/$lang/docusaurus-plugin-content-docs/current/admin/{page} pot:{pot} opt:"--keep 10"'

    if print_whole:
        print("=" * 20)
        print(conf)
        print("=" * 20)

    return conf


def main() -> None:
    parser = argparse.ArgumentParser()
    sub = parser.add_subparsers(dest="action")
    sub.add_parser("regen_pot")
    sub.add_parser("build_translated_mdx")
    args = parser.parse_args()
    action = args.action

    po4a_path = download_po4a()
    po4a_perllib = po4a_path / "lib"
    po4a_env = os.environ | {"PERLLIB": str(po4a_perllib)}

    langs = translated_langs()

    pages = []

    admin_dir = DOCS_DIR / "docs" / "admin"
    for page in sorted(admin_dir.rglob("*.mdx")):
        page = str(page.relative_to(admin_dir))
        pages.append(page)

    with tempfile.NamedTemporaryFile(
        prefix="po4a_", suffix=".cfg", mode="w+t", dir=po4a_path
    ) as po4a_conf:
        po4a_conf.write(po4a_config(langs, pages))
        po4a_conf.flush()

        command = [str(po4a_path / "po4a"), po4a_conf.name]
        if action == "regen_pot":
            command += ["--no-translations"]
        elif action == "build_translated_mdx":
            command += ["--no-update"]
        else:
            command += ["--help"]
        subprocess.check_call(command, env=po4a_env, cwd=DOCS_DIR)

    if action == "regen_pot":
        # We don't want to update the .po, only the .pot ... Weblate will take care of the pot -> po workflow
        subprocess.check_call(
            f"git checkout {DOCS_DIR}/i18n/docs/admin/*/*.po", shell=True, cwd=DOCS_DIR
        )
        # Boring unecessary headers
        this_year = datetime.date.today().year
        subprocess.check_call(
            "sed -i "
            "-e '/^# SOME DESCRIPTIVE TITLE$/d' "
            "-e '/^# FIRST AUTHOR /d' "
            f"-e 's/^# Copyright (C) YEAR /# Copyright (C) {this_year} /g' "
            f"{DOCS_DIR}/i18n/docs/admin/*/*",
            shell=True,
        )
        # We dont want to translate code blocks, the vast majority is language agnostic
        subprocess.check_call(
            "sed -i "
            "'/^#. type: Fenced code block/,/^$/d' "
            f"{DOCS_DIR}/i18n/docs/admin/*/*.pot",
            shell=True,
        )

        # Only add the files which are changes that are not just the timestamp...
        git_diff_result = subprocess.check_output(
            "git --no-pager diff --ignore-matching-lines='^\"POT-Creation-Date:' "
            "| grep '^---\\s./.*.pot' "
            "| sed 's@^--- ./@@g'",
            shell=True,
            cwd=DOCS_DIR,
        ).decode()
        files_to_git_add = list(
            filter(None, git_diff_result.replace("\n", " ").strip().split(" "))
        )

        if files_to_git_add:
            subprocess.check_call(["git", "add", *files_to_git_add], cwd=DOCS_DIR)
        # and restore the other ones
        subprocess.check_call(
            ["git", "checkout", "--", "i18n/docs/admin/"], cwd=DOCS_DIR
        )

    if action == "build_translated_mdx":
        # List generated files
        subprocess.check_call(
            [
                "find",
                "-path",
                "./i18n/*/docusaurus-plugin-content-docs/current/admin/**.mdx",
            ],
            cwd=DOCS_DIR,
        )


if __name__ == "__main__":
    main()
