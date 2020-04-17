returncode=0
for FILE in $(ls *.md)
do
    NB_OPENING=$(grep -E "^ *\`\`\` *\w+ *$" $FILE | wc -l)
    NB_CLOSE=$(grep -E "^ *\`\`\` *$" $FILE | wc -l)
    if [[ "$NB_OPENING" != "$NB_CLOSE" ]]
    then
        echo "There are some mistakes in code block syntax in $FILE ..."
        returncode=1
    fi
done

if [[ $returncode == 1 ]]
then
    echo "Make sure that all the code block in the problematic files do specific the language in the opening backticks (for example, \`\`\`bash). Otherwise, rendering in the actual website will be broken because of a bug in markdown parsing lib..."
    exit 1
fi
