window.nextgenEditor.addHook('hookInit', () => {
  Object.values(window.nextgenEditor.shortcodes).forEach((shortcode) => {
    shortcode.attributes = shortcode.attributes || {};

    if (!shortcode.button) {
      shortcode.button = { label: shortcode.title };
    }

    Object.values(shortcode.attributes).forEach((attribute) => {
      if (attribute.default === undefined) {
        attribute.default = '';
      }
      if (typeof attribute.default !== 'object') {
        attribute.default = { value: attribute.default };
      }
      if (attribute.shorthand === undefined) {
        attribute.shorthand = true;
      }
    });

    if (shortcode.type === 'block' && !shortcode.titlebar) {
      shortcode.titlebar = () => '';
    }
    if (!shortcode.content) {
      shortcode.content = () => '';
    }

    if (shortcode.preserve) {
      if (shortcode.preserve.block) {
        window.nextgenEditor.addVariable('preserveBlockTags', shortcode.preserve.block);
      }

      if (shortcode.preserve.inline) {
        window.nextgenEditor.addVariable('preserveInlineTags', shortcode.preserve.inline);
      }
    }

    if (!shortcode.parent) {
      window.nextgenEditor.addButton(`shortcode_${shortcode.name}`, {
        command: `shortcode_${shortcode.name}`,
        ...shortcode.button,
      });
    }
  });
});
