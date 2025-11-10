import tempfile
import os
from pathlib import Path

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
[po4a_paths] po4a/admin/$master/en.pot $lang:po4a/admin/$master/$lang.po

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
    os.system(f"{cmd} {po4a_conf.name} --no-translations")
    #os.system(f"{cmd} {po4a_conf.name} --no-update")

# We dont want to translate code blocks, the vast majority is language agnostic
os.system("sed -i '/^#. type: Fenced code block/,/^$/d' po4a/admin/*/*.po po4a/admin/*/*.pot")
