#!/usr/bin/env bash
set -Eeuo pipefail
set -x

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

SRCDIR=$1

DOCDIR=$(dirname "$SCRIPT_DIR")

"$SCRIPT_DIR/helpers_doc_generate.py" 2     -i "$SRCDIR" -o "$DOCDIR/docs/packaging/20.scripts/20.helpers_v2.0.mdx"
"$SCRIPT_DIR/helpers_doc_generate.py" 2.1   -i "$SRCDIR" -o "$DOCDIR/docs/packaging/20.scripts/20.helpers_v2.1.mdx"
"$SCRIPT_DIR/resources_doc_generate.py"     -i "$SRCDIR" -o "$DOCDIR/docs/packaging/10.manifest/10.resources.mdx"
"$SCRIPT_DIR/forms_doc_generate.py"         -i "$SRCDIR" -o "$DOCDIR/docs/dev/15.core/forms.mdx"
