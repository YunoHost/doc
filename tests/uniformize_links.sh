for FILE in $(ls *.md); 
do
    grep -q "Unfortunately, this page only exists" $FILE && continue

    # Replace markdown links with full url ... we only need the relative url
    sed -i -E 's@\(https://yunohost.org/#/(\w+)\)@(/\1)@g' $FILE

    # Replace (/foo_fr) to (foo)
    sed -i -E 's@\(\/?((\w|-)+)_(en|fr|es|it|ar|de|oc|ca)\)@(/\1)@g' $FILE

    # Replace href="/foo_fr" to href="foo"
    sed -i -E 's@href="/?((\w|-)+)_(en|fr|es|it|ar|de|oc|ca)"@href="/\1"@g' $FILE;
done

git checkout project_organization.md project_organization_fr.md
