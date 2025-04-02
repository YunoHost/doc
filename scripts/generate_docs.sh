#!/usr/bin/env bash
set -Eeuo pipefail
set -x

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

SRCDIR=$1

DOCDIR=$(dirname "$SCRIPT_DIR")

"$SCRIPT_DIR/helpers_doc_generate.py" 2     -i "$SRCDIR" -o "$DOCDIR/docs/06.contribute/10.apps/20.scripts/20.helpers_v2.0.mdx"
"$SCRIPT_DIR/helpers_doc_generate.py" 2.1   -i "$SRCDIR" -o "$DOCDIR/docs/06.contribute/10.apps/20.scripts/20.helpers_v2.1.mdx"
"$SCRIPT_DIR/resources_doc_generate.py"     -i "$SRCDIR" -o "$DOCDIR/docs/06.contribute/10.apps/10.manifest/10.resources.mdx"
"$SCRIPT_DIR/forms_doc_generate.py"         -i "$SRCDIR" -o "$DOCDIR/docs/06.contribute/15.core/forms.mdx"

# Fixups until the sources are updated
sed -i 's|/packaging_config_panels|/contribute/apps/advanced/config_panels|' "$DOCDIR/docs/06.contribute/15.core/forms.mdx"
sed -i 's|#read-and-write-values-the|/contribute/apps/advanced/config_panels#the-bind-statement|' "$DOCDIR/docs/06.contribute/15.core/forms.mdx"
sed -i 's|(#actions)|(/contribute/apps/advanced/config_panels#actions)|' "$DOCDIR/docs/06.contribute/15.core/forms.mdx"
