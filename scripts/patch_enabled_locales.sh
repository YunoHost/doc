#!/usr/bin/env bash
set -Eeuo pipefail

enabled_locales="$(
    curl -s https://translate.yunohost.org/api/projects/yunohost-doc/languages/ \
    | jq -c '[ .[] | select(.translated_percent >= 5.5 ) | .code | sub("_"; "-") ] | sort' \
)"


sed -i "s@^\s*const\s*enabled_locales =.*@const enabled_locales = $enabled_locales;@g" docusaurus.config.ts
