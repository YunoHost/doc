window.nextgenEditor.addHook('hookMarkdowntoHTML', {
  weight: -50,
  handler(options, input) {
    let output = input;

    const realNames = Object.values(window.nextgenEditor.shortcodes).map((shortcode) => shortcode.realName)
      .filter((value, index, self) => self.indexOf(value) === index);

    const openingRegexp = realNames
      .map((name) => `(\\[${name}[^\\]]*\\])`).join('|');

    realNames.forEach((name) => {
      const regexp = `\\[${name}(?<attributes>(=| +).+?(?=/]))?\\/\\]`;

      output = output.replace(new RegExp(regexp, 'g'), (...matches) => {
        const groups = matches.pop();

        const attributes = groups.attributes.trim()
          ? `${groups.attributes}`
          : '';

        return `[${name}${attributes}][/${name}]`;
      });
    });

    const hashMap = {};
    let shortcodeCounter = 1;

    while (shortcodeCounter > 0) {
      shortcodeCounter = 0;

      // eslint-disable-next-line no-loop-func
      Object.values(window.nextgenEditor.shortcodes).forEach((shortcode) => {
        const regexp = `(?<spaces_before> *)\\[${shortcode.realName}(?<attributes>(=| +)[^\\]]*)?\\](?<content>(((?!(${openingRegexp}|(\\[\\/${shortcode.realName}\\]))).)|\\n)*)\\[\\/${shortcode.realName}\\](?<spaces_after> *)`;

        output = output.replace(new RegExp(regexp, 'g'), (...matches) => {
          shortcodeCounter += 1;

          const hash = Math.random().toString(36).slice(2);
          hashMap[hash] = { shortcode, matches };

          if (shortcode.child) {
            const childName = shortcode.child.realName;

            Object.keys(hashMap).forEach((childHash) => {
              const childShortcode = hashMap[childHash].shortcode;

              if (childShortcode === shortcode.child && childShortcode.name !== `${shortcode.realName}_${childName}` && matches[0].includes(childHash)) {
                hashMap[childHash].shortcode = window.nextgenEditor.shortcodes[`${shortcode.realName}_${childName}`];
              }
            });
          }

          return hash;
        });
      });
    }

    shortcodeCounter = 1;

    while (shortcodeCounter > 0) {
      shortcodeCounter = 0;

      // eslint-disable-next-line no-loop-func
      Object.keys(hashMap).forEach((hash) => {
        if (!output.includes(hash)) {
          return;
        }

        shortcodeCounter += 1;

        const { shortcode, matches } = hashMap[hash];
        const groups = matches.pop();

        const spacesBefore = groups.spaces_before.replace(/ /g, '&nbsp;');
        const spacesAfter = groups.spaces_after.replace(/ /g, '&nbsp;');

        if (shortcode.type === 'block') {
          let content = groups.content.trim();

          if (groups.spaces_before.length) {
            content = content.replace(new RegExp(`^( ){${groups.spaces_before.length}}`, 'gm'), '');
          }

          const replacement = `\n\n[${shortcode.name}${groups.attributes || ''}]\n\n${content}\n\n[/${shortcode.name}]\n\n`;

          output = output.replace(new RegExp(`(\\n)?(\\n)?${hash}(\\n)?(\\n)?`), replacement);
        }

        if (shortcode.type === 'inline') {
          output = output.replace(hash, `${spacesBefore}[${shortcode.name}${groups.attributes || ''}]${groups.content}[/${shortcode.name}]${spacesAfter}`);
        }
      });
    }

    output = output.replace(/^\n\n/, '').replace(/\n\n$/, '');

    return output;
  },
});
