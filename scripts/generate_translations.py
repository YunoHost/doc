import tempfile
import os
from pathlib import Path

#langs = ["ar", "ca", "de", "es", "fr", "it", "oc", "ru"]
langs = ["fr"]

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
]
patterns_to_ignore = [
    r'import.*;',
    r'\s*\<\S*\>',
    r'\s*<(' + '|'.join(tags_to_ignore_even_if_they_have_attributes) + ").*>",
    r'\!\[\]\(/img/\S*\)'
]

yaml_front_matter_keys_to_translate = ["title", "description", "sidebar_label"]


conf = f"""
[options] {' '.join(options)}
[po4a_alias:markdown] text opt:"--option markdown --option breaks='{'|'.join(patterns_to_ignore)}' --option neverwrap --option yfm_keys={','.join(yaml_front_matter_keys_to_translate)}"

[po4a_langs] {' '.join(langs)}
[po4a_paths] po4a/$master/$master.pot $lang:po4a/$master/$lang.po

"""

base_dir = Path(__name__).parent.parent

os.chdir(base_dir)
for page in sorted(Path("./docs/admin").rglob("*.mdx")):
    page = str(page).split("/", 1)[1]  # Remove the starting 'docs/'
    pot_id = page.replace("/", "__")[:-len(".mdx")]
    conf += f'\n[type: markdown] ./docs/{page} $lang:i18n/$lang/docusaurus-plugin-content-docs/current/{page} pot:{pot_id} opt:"--keep 0"'

with tempfile.NamedTemporaryFile(prefix="po4a_", suffix=".cfg", dir=base_dir) as po4a_conf:
    po4a_conf.write(conf.encode())
    os.system(f"po4a {po4a_conf.name} --no-translations")

    # We dont want to translate code blocks, the vast majority is language agnostic
    os.system("sed -i '/^#. type: Fenced .* block/,/^$/d' po4a/*/*.po po4a/*/*.pot")
