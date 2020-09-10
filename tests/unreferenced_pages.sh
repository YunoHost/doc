

MARKDOWN_TARGETS=$(grep -nr -o -E "\]\(\/?(\w|-)+\)" ./*.md | tr -d ']()/' | awk -F: '{print $3}' | sort | uniq)
HTML_TARGETS=$(grep -nr -o -E 'href="\/?(\w|-)+\"' ./*.md | sed -E 's@href="/?@@g' | tr -d '"' | awk -F: '{print $3}' | sort | uniq)

ALL_TARGETS=$(echo $MARKDOWN_TARGETS $HTML_TARGETS)

PAGES=$(ls *.md | sed -E 's/(_(fr|it|de|ar|oc|es|ru|ca))?\.md//g' | sort | uniq)

returncode=0

for PAGE in $PAGES
do
    if [[ $PAGE == "index" ]] || [[ $PAGE == "README" ]] || [[ $PAGE == "default" ]] 
    then
        continue
    fi
    if ! echo $ALL_TARGETS | grep -q -w $PAGE
    then
        returncode=1
        echo "The following page is not referenced by any other page :( -> $PAGE"
    fi
done

exit $returncode
