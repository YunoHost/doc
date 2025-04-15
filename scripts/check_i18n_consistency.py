#!/usr/bin/env python3

import argparse
import sys
from pathlib import Path

SCRIPT_DIR = Path(__file__).resolve().parent
DOC_DIR = SCRIPT_DIR.parent

def get_locale_dir(locale: str) -> Path:
    return DOC_DIR / "i18n" / locale / "docusaurus-plugin-content-docs" / "current"

def check_locale(locale: str) -> bool:
    ret = True
    docs_dir = DOC_DIR / "docs"
    locale_dir = get_locale_dir(locale)

    for root, dirs, files in locale_dir.walk(follow_symlinks=True):
        for file in files:
            relpath = root.relative_to(locale_dir) / file
            expected_file = docs_dir / relpath
            if not expected_file.exists():
                ret = False
                print(f"{locale}: file {relpath} does not exist in default version")

    return ret


def list_locales() -> list[str]:
    return sorted(subdir.name for subdir in (DOC_DIR / "i18n").iterdir())

def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument("-l", "--locale", type=str, help="Locale to check the pages for, all if not passed")
    args = parser.parse_args()

    locales: list[str] = [args.locale] if args.locale else list_locales()

    ret = True
    for locale in locales:
        ret = check_locale(locale) and ret

    if not ret:
        sys.exit(1)

if __name__ == "__main__":
    main()
