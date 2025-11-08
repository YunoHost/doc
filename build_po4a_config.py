#!/usr/bin/env python3
import glob
import os

CONTENT_PATH = "docs/"
POT_PATH = "l10n_test"
TRANSLATED_PATH = "l10n_translated"

PO4A_CONFIG = "[po4a_alias:markdown] text opt:\"--option markdown\"\n"
PO4A_PATH=f"[po4a_paths] {POT_PATH}/pot/$master.pot $lang:{POT_PATH}/po/$lang/$master.pot\n"

def add_language_to_po4a_config(languages: list[str]):
    """
    Add a language to the PO4A configuration.
    :param languages: Language codes to add
    :return: None
    """
    global PO4A_CONFIG
    PO4A_CONFIG += f"[po4a_langs] {" ".join(languages)} \n"

def add_to_po4a_path():
    global PO4A_CONFIG
    PO4A_CONFIG += PO4A_PATH

def add_to_po4a_config(file: str, source_content_path: str):
    global PO4A_CONFIG
    file_full_path = os.path.join(source_content_path, file)
    file_without_extension = file.replace(".mdx", "")
    file_without_extension = file_without_extension.replace(os.path.sep, "__")
    PO4A_CONFIG += f"[type: markdown] {file_full_path} $lang:{TRANSLATED_PATH}/$lang/{file} pot:\"{file_without_extension}\" opt:\"--keep 0\" \n"

def identify_pages_to_translate():
    source_content_path = CONTENT_PATH
    files = glob.glob(root_dir=source_content_path, pathname="**/*.mdx", recursive=True)

    for file in files:
        print(f"File to translate identified: {file}")
        add_to_po4a_config(file, source_content_path)

    global PO4A_CONFIG
    save_file(os.path.join("./","po4a.cfg"), PO4A_CONFIG)

def save_file(file_path: str, content: str):
    """
    Save __old_content to a file, creating directories if necessary.
    :param file_path: File path to save the __old_content
    :param content: Content to save
    :return: None
    """
    os.makedirs(os.path.dirname(file_path), exist_ok=True)
    with open(file_path, 'w') as file:
        file.write(content)


def get_languages_to_publish():
    with open("languages_to_publish.txt", "r") as file:
        languages = [line.strip() for line in file.readlines() if line.strip()]
    add_language_to_po4a_config(languages)


if __name__ == "__main__":
    print("Start processing...")
    print("🕊 Building po4a config... 🕊")
    get_languages_to_publish()
    add_to_po4a_path()
    print("🕊 Identifying pages to translate... 🕊")
    identify_pages_to_translate()
    print("🕊 Done 🕊")
