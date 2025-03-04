#!/usr/bin/env python3

import re
import sys
from pathlib import Path

import frontmatter


def list_known_pages(pages_dir: Path) -> list[str]:
    known_pages = []
    for page in pages_dir.rglob("*.md"):
        meta = frontmatter.load(page).metadata
        route = meta.get("routes", {}).get("default")
        if route:
            known_pages.append(route)
        for alias in meta.get("routes", {}).get("aliases", []):
            known_pages.append(alias)
    return known_pages


def list_dead_links(pages_dir: Path, known_pages: list[str]) -> list[tuple[Path, str]]:
    dead_links = []
    md_link_re = re.compile(r"\]\((/?[\w-]+)\)")
    for page in pages_dir.rglob("*.md"):
        content = frontmatter.load(page).content
        links = md_link_re.findall(content)
        for link in links:
            if link not in known_pages:
                dead_links.append((page, link))
    return dead_links


def main() -> None:
    pages_dir = Path(__file__).resolve().parent.parent / "pages"
    dead_links = list_dead_links(pages_dir, list_known_pages(pages_dir))
    for page, link in dead_links:
        print(f"Page {page.relative_to(pages_dir)} contains dead link to {link}")
    if len(dead_links):
        sys.exit(1)


if __name__ == "__main__":
    main()
