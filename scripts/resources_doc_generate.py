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
import ast
import datetime
import subprocess
from pathlib import Path

from jinja2 import Template


TEMPLATE_FILE = Path(__file__).resolve().parent / "resources_doc_template.md.j2"

def get_current_commit(docdir: Path) -> str:
    p = subprocess.Popen(
        ["git", "rev-parse", "--verify", "HEAD"],
        cwd=docdir,
        stdout=subprocess.PIPE,
        stderr=subprocess.STDOUT,
    )
    stdout, stderr = p.communicate()

    current_commit = stdout.strip().decode("utf-8")
    return current_commit


def get_changelog_version(srcdir: Path) -> str:
    changelog_file = srcdir / "debian" / "changelog"
    version = changelog_file.open("r").readline().split()[1].strip("()")
    return version


##############################################################################


def list_resources(srcdir: Path) -> dict[str, str]:
    resources_file = srcdir / "src" / "utils" / "resources.py"

    # NB: This magic is because we want to be able to run this script outside of a YunoHost context,
    # in which we cant really 'import' the file because it will trigger a bunch of moulinette/yunohost imports...
    tree = ast.parse(resources_file.read_text())

    resource_docstrings: dict[str, str] = {}

    for cl in tree.body:
        if isinstance(cl, ast.ClassDef) and cl.bases:
            assert isinstance(cl.bases[0], ast.Name)
            if cl.bases[0].id == "AppResource":
                assert isinstance(cl.body[1], ast.Assign)
                assert isinstance(cl.body[1].targets[0], ast.Name)
                assert cl.body[1].targets[0].id == "type"
                assert isinstance(cl.body[1].value, ast.Constant)
                resource_id = cl.body[1].value.value.replace("_", " ").title()
                docstring = ast.get_docstring(cl)
                assert isinstance(docstring, str)
                resource_docstrings[resource_id] = docstring

    return dict(sorted(resource_docstrings.items()))


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument("--input", "-i", type=Path, required=True, help="Input yunohost source directory")
    parser.add_argument("--output", "-o", type=Path, required=True)
    args = parser.parse_args()

    resources = list_resources(args.input)

    version = get_changelog_version(args.input)
    commit = get_current_commit(Path(__file__).parent)

    template = Template(TEMPLATE_FILE.read_text())
    template.globals["now"] = datetime.datetime.utcnow

    result = template.render(
        resources=resources,
        date=datetime.datetime.now().strftime("%d/%m/%Y"),
        version=version,
        current_commit=commit,
    )

    args.output.write_text(result)


if __name__ == "__main__":
    main()
