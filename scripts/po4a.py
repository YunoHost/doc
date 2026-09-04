#!/usr/bin/env python3
#
# Copyright (c) 2024 YunoHost Contributors
#
# This file is part of YunoHost (see https://yunohost.org)
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with this program. If not, see <http://www.gnu.org/licenses/>.
#

import argparse
import datetime
import subprocess
import tempfile
import textwrap
from pathlib import Path

PROJECT_DIR = Path(__file__).parent.parent.resolve()

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


def translated_langs() -> list[str]:
    linguas = PROJECT_DIR / "i18n" / "LINGUAS"
    langs = linguas.read_text().splitlines()
    langs.remove("en")
    return langs


def po4a_config(langs: list[str], pages: list[Path], *, print_whole: bool = False) -> str:
    breaks = f"breaks='{'|'.join(patterns_to_ignore)}'"
    yfm_keys = f"yfm_keys={','.join(yaml_front_matter_keys_to_translate)}"
    text_opts = f"--option markdown --option {breaks} --option neverwrap --option nobullets --option {yfm_keys}"

    conf = textwrap.dedent(f"""
        [options] {" ".join(options)}
        [po4a_alias:markdown] text opt:"{text_opts}"

        [po4a_langs] {" ".join(langs)}
        [po4a_paths] i18n/docs/$master/en.pot $lang:i18n/docs/$master/$lang.po
    """)

    if not print_whole:
        print("=" * 20)
        print(conf)
        print("=" * 20)

    source_dir = Path("docs")
    target_dir = Path("i18n/$lang/docusaurus-plugin-content-docs/current")

    for page in pages:
        source = source_dir / page
        target = target_dir / page
        # First element (admin, community, dev)
        topdir = page.parts[0]
        pot = str(page.relative_to(topdir)).replace("/", "__")[: -len(".mdx")]
        conf += f'\n[type: markdown] ./{source} $lang:{target} pot:{topdir}/{pot} opt:"--keep 10"'

    if print_whole:
        print("=" * 20)
        print(conf)
        print("=" * 20)

    return conf


def call_po4a(args: list[str], *, langs: list[str], pages: list[Path]) -> None:
    with tempfile.NamedTemporaryFile(prefix="po4a_", suffix=".cfg", mode="w+t") as po4a_conf:
        po4a_conf.write(po4a_config(langs, pages))
        po4a_conf.flush()
        subprocess.check_call(["po4a", po4a_conf.name, *args], cwd=PROJECT_DIR)


def main() -> None:
    parser = argparse.ArgumentParser()
    sub = parser.add_subparsers(dest="action", required=True)
    sub.add_parser("regen_pot")
    sub.add_parser("build_translated_mdx")
    args = parser.parse_args()

    langs = translated_langs()

    # Only manage admin dir for now
    admin_dir = PROJECT_DIR / "docs" / "admin"
    pages = [page.relative_to(PROJECT_DIR / "docs") for page in sorted(admin_dir.rglob("*.mdx"))]

    if args.action == "regen_pot":
        call_po4a(["--no-translations"], langs=langs, pages=pages)

        # We don't want to update the .po, only the .pot ... Weblate will take care of the pot -> po workflow
        subprocess.check_call(["git", "checkout", f"{PROJECT_DIR}/i18n/docs/admin/*/*.po"], cwd=PROJECT_DIR)

        # Boring unecessary headers
        this_year = datetime.date.today().year
        for pofile in (PROJECT_DIR / "i18n/docs/admin").rglob("*.pot"):
            remove_title = "/^# SOME DESCRIPTIVE TITLE$/d"
            remove_author = "/^# FIRST AUTHOR /d"
            patch_year = f"s/^# Copyright (C) YEAR /# Copyright (C) {this_year} /g"
            cmd = ["sed", "-i", "-e", remove_title, "-e", remove_author, "-e", patch_year, str(pofile)]
            subprocess.check_call(cmd)
            # We dont want to translate code blocks, the vast majority is language agnostic
            cmd = ["sed", "-i", "/^#. type: Fenced code block/,/^$/d", str(pofile)]
            subprocess.check_call(cmd)

        # Only add the files which are changes that are not just the timestamp...
        cmd = ["git", "diff", "--ignore-matching-lines", '^"POT-Creation-Date:', "--name-only"]
        diff_files = subprocess.check_output(cmd, cwd=PROJECT_DIR, text=True).splitlines()
        diff_pot = [file for file in diff_files if file.endswith(".pot")]
        if diff_pot:
            subprocess.check_call(["git", "add", *diff_pot], cwd=PROJECT_DIR)
        # and restore the other ones
        subprocess.check_call(["git", "checkout", "--", "i18n/docs"], cwd=PROJECT_DIR)

        return

    if args.action == "build_translated_mdx":
        call_po4a(["--no-update"], langs=langs, pages=pages)
        for file in (PROJECT_DIR / "i18n").rglob("*/docusaurus-plugin-content-docs/current/**/*.mdx"):
            print(file)
        return


if __name__ == "__main__":
    main()
