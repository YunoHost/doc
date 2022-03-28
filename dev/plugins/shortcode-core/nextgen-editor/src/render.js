import uncollapse from './uncollapse';

window.nextgenEditor.addHook('hookMarkdowntoHTML', {
  weight: 50,
  handler(options, input) {
    let output = input;

    let shortcodeCounter = 1;
    const openingRegexp = Object.keys(window.nextgenEditor.shortcodes).map((name) => `(\\[${name}[^\\]]*\\])`).join('|');

    while (shortcodeCounter > 0) {
      shortcodeCounter = 0;

      // eslint-disable-next-line no-loop-func
      Object.values(window.nextgenEditor.shortcodes).forEach((shortcode) => {
        const regexp = `(?<p1><p>)?\\[${shortcode.name}(?<attributes>(=| +)[^\\]]*)?\\](<\\/p>)?(?<content>(((?!(${openingRegexp}|(\\[\\/${shortcode.name}\\]))).)|\\n)*)\\[\\/${shortcode.name}\\](?<p2><\\/p>)?`;

        output = output.replace(new RegExp(regexp, 'g'), (...matches) => {
          shortcodeCounter += 1;

          const groups = matches.pop();

          let content = shortcode.type === 'block'
            ? groups.content.replace(/<p>$/, '')
            : groups.content;

          const bbcode = Object.keys(shortcode.attributes).reduce((acc, attrName) => acc || (shortcode.attributes[attrName].bbcode && shortcode.attributes[attrName].shorthand && attrName), '');
          const innerHTMLAttribute = Object.keys(shortcode.attributes).reduce((acc, attrName) => acc || (shortcode.attributes[attrName].innerHTML && attrName), '');

          let attrGroup = bbcode && groups.attributes && groups.attributes.startsWith('=')
            ? `${bbcode}${groups.attributes}`
            : groups.attributes || '';

          if (innerHTMLAttribute) {
            const innerHTML = shortcode.type === 'block'
              ? content.replace(/^<p>/, '').replace(/<\/p>$/, '').replace(/^&nbsp;$/, '')
              : content.replace(/^&nbsp;$/, '');

            attrGroup = attrGroup
              ? `${attrGroup} ${innerHTMLAttribute}="${innerHTML}"`
              : `${innerHTMLAttribute}="${innerHTML}"`;

            content = '';
          }

          const domAttributes = new DOMParser().parseFromString(`<div ${attrGroup}></div>`, 'text/html').body.firstChild.attributes;

          const attributes = Object.keys(shortcode.attributes).reduce((acc, attrName) => {
            const attribute = shortcode.attributes[attrName];

            let attrValue = domAttributes.getNamedItem(attrName)
              ? domAttributes.getNamedItem(attrName).value
              : attribute.default.value;

            if (attribute.type === Boolean && domAttributes.getNamedItem(attrName)) {
              attrValue = domAttributes.getNamedItem(attrName) !== 'false';
            }

            if (attribute.type === Number) {
              attrValue = +attrValue;
            }

            acc[attrName] = attrValue;

            return acc;
          }, {});

          let replacement = '';

          const attributesEncoded = encodeURIComponent(JSON.stringify(attributes));

          if (shortcode.type === 'block') {
            replacement += `<shortcode-block name="${shortcode.name}" attributes="${attributesEncoded}">`;
            replacement += content;
            replacement += '</shortcode-block>';
          }

          if (shortcode.type === 'inline') {
            replacement += groups.p1 || '';
            replacement += `<shortcode-inline name="${shortcode.name}" attributes="${attributesEncoded}">`;
            replacement += content;
            replacement += '</shortcode-inline>';
            replacement += groups.p2 || '';
          }

          return replacement;
        });
      });
    }

    output = uncollapse(output);

    return output;
  },
});
