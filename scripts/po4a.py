import os
import tempfile
import sys
from pathlib import Path

if len(sys.argv) < 2 or sys.argv[1] not in ['regen_po', 'build_translated_mdx']:
    raise Exception("This script expects 'regen_po' or 'build_translated_mdx' as first arg")
action = sys.argv[1]

langs = ["ar", "ca", "de", "es", "fr", "it", "oc", "ru"]

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
    "LangRedirect",
    "DocCardList",
]
patterns_to_ignore = [
    r'import.*;',
    r'^\s*\<\S*\>\s*$',
    r'\s*<(' + '|'.join(tags_to_ignore_even_if_they_have_attributes) + ").*>",
    r'\!\[\]\(/img/\S*\)'
]

yaml_front_matter_keys_to_translate = ["title", "description", "sidebar_label"]


conf = f"""
[options] {' '.join(options)}
[po4a_alias:markdown] text opt:"--option markdown --option breaks='{'|'.join(patterns_to_ignore)}' --option neverwrap --option nobullets --option yfm_keys={','.join(yaml_front_matter_keys_to_translate)}"

[po4a_langs] {' '.join(langs)}
[po4a_paths] i18n/docs/admin/$master/en.pot $lang:i18n/docs/admin/$master/$lang.po

"""



base_dir = Path(__name__).parent.parent
os.chdir(base_dir)


if not Path("./.po4a").exists():
    os.system("wget https://github.com/mquinson/po4a/releases/download/v0.74/po4a-0.74.tar.gz")
    os.system("tar -xzf po4a-0.74.tar.gz")
    os.system("mv po4a-0.74 .po4a")
    os.system("rm po4a-0.74.tar.gz")

assert Path("./.po4a/po4a").exists()
cmd = "PERLLIB=./.po4a/lib/ ./.po4a/po4a"

for page in sorted(Path("./docs/admin").rglob("*.mdx")):
    page = str(page).split("/", 2)[-1]  # Remove the starting 'docs/admin'
    pot = page.replace("/", "__")[:-len(".mdx")]
    conf += f'\n[type: markdown] ./docs/admin/{page} $lang:i18n/$lang/docusaurus-plugin-content-docs/current/admin/{page} pot:{pot} opt:"--keep 10"'

print(conf)
print("==========")

with tempfile.NamedTemporaryFile(prefix="po4a_", suffix=".cfg", dir=base_dir) as po4a_conf:
    po4a_conf.write(conf.encode())
    if action == "regen_po":
        flags = "--no-translations"
    elif action == "build_translated_mdx":
        flags = "--no-update"
    else:
        falgs = "--help"
    os.system(f"{cmd} {po4a_conf.name} {flags}")

if action == "regen_po":
    # We don't want to update the .po, only the .pot ... Weblate will take care of the pot -> po workflow
    os.system("git checkout i18n/docs/admin/*/*.po")
    # We dont want to translate code blocks, the vast majority is language agnostic
    os.system("sed -i '/^#. type: Fenced code block/,/^$/d' i18n/docs/admin/*/*.pot")
