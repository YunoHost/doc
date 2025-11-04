#!/bin/Bash
#
cd -- "$(dirname $( dirname -- "${BASH_SOURCE[0]}" ) )"

RET=0

for FILE in $(grep -hro "/img/[^)\"'?]*" ./docs/ ./i18n/*/docusaurus-plugin-content-docs/current/ | sort | uniq)
do 
    if ! test -e ./static$FILE
    then
        echo "Image $FILE does not exists but is used as src in some file ?"
        echo "------------"
        grep -nr "$FILE" ./docs/ ./i18n/*/docusaurus-plugin-content-docs/current/
        RET=1
    fi
done

exit $RET
