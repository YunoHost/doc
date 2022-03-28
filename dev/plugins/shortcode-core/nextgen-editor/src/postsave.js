window.nextgenEditor.addHook('hookHTMLtoMarkdown', {
  weight: 50,
  handler(options, editor, input) {
    let output = input;

    const realNames = Object.values(window.nextgenEditor.shortcodes).map((shortcode) => shortcode.realName)
      .filter((value, index, self) => self.indexOf(value) === index);

    const openingRegexp = realNames
      .map((name) => `(\\[${name}[^\\]]*\\])`).join('|');

    const hashMap = {};
    let shortcodeCounter = 1;

    while (shortcodeCounter > 0) {
      shortcodeCounter = 0;

      // eslint-disable-next-line no-loop-func
      Object.values(window.nextgenEditor.shortcodes).forEach((shortcode) => {
        const regexp = `(?<opening>\\[${shortcode.realName}[^\\]]*\\])(?<content>(((?!(${openingRegexp}|(\\[\\/${shortcode.realName}\\]))).)|\\n)*)(?<closing>\\[\\/${shortcode.realName}\\])`;

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

        if (shortcode.type === 'block') {
          let content = groups.content.replace(/^\n/, '').replace(/\n$/, '');

          if (shortcode.child) {
            content = content.trim().split('\n').filter((line) => !!line).join('\n');
            content = `\n${content}\n`;
          }

          if (shortcode.parent) {
            content = `\n${content}\n`;
          }

          output = output.replace(hash, `${groups.opening}${content}${groups.closing}`);
        }

        if (shortcode.type === 'inline') {
          output = output.replace(hash, matches[0]);
        }
      });
    }

    /*
    Object.values(window.nextgenEditor.shortcodes).forEach((shortcode) => {
      const regexp = `(?<opening>\\[${shortcode.realName}[^\\]]*\\])\n(?<content>(((?!(${openingRegexp}|(\\[\\/${shortcode.realName}\\]))).))*)\n(?<closing>\\[\\/${shortcode.realName}\\])`;

      output = output.replace(new RegExp(regexp, 'g'), (...matches) => {
        const groups = matches.pop();
        return `${groups.opening}${groups.content}${groups.closing}`;
      });
    });
    */

    return output;
  },
});
