#!/bin/bash
while IFS= read -r file
do
    # echo $file
    # [ -f "$file" ] && echo "$file does not exist"
    if [ ! -f $file ]; then
        echo "https://yunohost.org/images/"$file
    fi
done < "images.list"