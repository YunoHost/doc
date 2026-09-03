#!/usr/bin/env bash
set -Eeuo pipefail
SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

set -x

# Might be yarn, bun etc
executor=${npm_execpath:-npm}

langs=$(grep "enabled_locales =" $SCRIPT_DIR/../docusaurus.config.ts | awk -F= '{print $2}' | tr -d '[]",;')
for lang in $langs; do
    "$executor" run docusaurus write-translations -l "$lang" "$@"
done
