# How does internationalization (i18n) work in this project?

Internationalization is the process of preparing the software so that it can be easily adapted to various languages and regions without requiring engineering changes to the source code.

Internationalization is a continuous process, it will always require attention to support edge cases.

TODO:

* Could we automate the language list with a python script to update the `docusaurus.config.js` file? The Python script could read the i18n folder. Publication criteria to be defined first.
* Where is the language name coming from? It is displayed in the language switch button.

## What are the files to translate?

Markdown files stored in the `docs/` folder and its subfolders.

Json files stored in the `i18n/` folder and its subfolders.

Json content is described there: https://docusaurus.io/docs/i18n/introduction#json-files

Docusaurus doesn't need to have all strings existing in translated json file to build.

## How to add a new language?

Each language has a code, the folder `i18n/<language-code>/` shall exist.
Clone `docs/*` content into `i18n/<language-code>/docusaurus-plugin-content-docs`

in `docusaurus.config.js`, add the language code in:
* in `i18n.locales` key to allow Docusaurus to build the language
* `plugins.docusaurus-lunr-search` to allow search for this specific language
* `scripts.data-language-redirect` to allow language detection and redirection

## Language specific

Right to left languages (like Arabic, Hebrew, ...) need additional configuration to be added in `i18n.locales`.

## How does the communication with translation platform work?

There is none yet.

## Mandatory steps after code change in src/ folder

Update all default translations

```bash
npm run docusaurus write-translations
```