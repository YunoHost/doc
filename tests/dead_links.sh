returncode=0

# Find all markdown links and generate a list of filename.md:N:linktarget   (with N the line number)
for LINK in $(grep -nr -o -E "\]\(\/?(\w|-)+\)" ./*.md | tr -d ']()/')
do
    PAGE=$(echo $LINK | awk -F: '{print $3}')
    [ -e "$PAGE.md" ] || echo "This Markdown link looks dead (page doesn't exist in english?) $LINK"
    [ -e "$PAGE.md" ] || returncode=1
done

# Find all HTML/href links and generate a list of filename.md:N:linktarget   (with N the line number)
for LINK in $(grep -nr -o -E 'href="\/?(\w|-)+\"' ./*.md | sed -E 's@href="/?@@g' | tr -d '"')
do
    PAGE=$(echo $LINK | awk -F: '{print $3}')
    [ -e "$PAGE.md" ] || echo "This HTML link looks dead (page doesn't exist in english?) $LINK"
    [ -e "$PAGE.md" ] || returncode=1
done

exit $returncode
