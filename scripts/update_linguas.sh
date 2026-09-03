#!/usr/bin/env bash
set -Eeuo pipefail
set -x

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
DOCDIR=$(dirname "$SCRIPT_DIR")

curl -s https://translate.yunohost.org/api/projects/yunohost-doc/languages/ \
| jq '[ .[] | select(.translated_percent >= 5.5 ) | .code | sub("_"; "-") ] | sort | .[]' -r \
> "$DOCDIR/i18n/LINGUAS"
