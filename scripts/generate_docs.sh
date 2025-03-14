#!/usr/bin/env bash
set -Eeuo pipefail
set -x

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

SRCDIR=$1

DOCDIR=$(dirname "$SCRIPT_DIR")

"$SCRIPT_DIR/helpers_doc_generate.py" 2     -i "$SRCDIR" -o "$DOCDIR/pages/06.contribute/10.packaging_apps/20.scripts/10.helpers/packaging_app_scripts_helpers.md"
"$SCRIPT_DIR/helpers_doc_generate.py" 2.1   -i "$SRCDIR" -o "$DOCDIR/pages/06.contribute/10.packaging_apps/20.scripts/12.helpers21/packaging_app_scripts_helpers_v21.md"
"$SCRIPT_DIR/resources_doc_generate.py"     -i "$SRCDIR" -o "$DOCDIR/pages/06.contribute/10.packaging_apps/10.manifest/10.appresources/packaging_app_manifest_resources.md"
"$SCRIPT_DIR/forms_doc_generate.py"         -i "$SRCDIR" -o "$DOCDIR/pages/06.contribute/15.dev/03.forms/forms.md"
