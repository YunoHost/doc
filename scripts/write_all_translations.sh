#!/usr/bin/env bash
set -Eeuo pipefail
set -x

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
DOCDIR=$(dirname "$SCRIPT_DIR")

# Might be yarn, bun etc
executor=${npm_execpath:-npm}

readarray -t linguas < "$DOCDIR/i18n/LINGUAS"
for lang in "${linguas[@]}"; do
    "$executor" run docusaurus write-translations -l "${lang/_/-}" "$@"
done
