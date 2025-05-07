#!/usr/bin/env bash
set -Eeuo pipefail
SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

set -x

for lang in ar ca de en es fr it oc ru; do
    yarn write-translations -l "$lang"
done
