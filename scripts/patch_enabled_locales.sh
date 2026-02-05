

enabled_locales="$(curl -s https://translate.yunohost.org/api/projects/yunohost-doc/languages/ \
                  | jq -r '[ .[] | select(.translated_percent >= 5.5 ) | .code ]' \
                  | tr -d '\n')"


sed -i "s@^\s*const\s*enabled_locales =.*@const enabled_locales = $enabled_locales;@g" docusaurus.config.ts
