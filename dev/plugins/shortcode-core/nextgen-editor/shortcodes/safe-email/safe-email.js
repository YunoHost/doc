window.nextgenEditor.addShortcode('safe-email', {
  type: 'inline',
  plugin: 'shortcode-core',
  title: 'Safe Email',
  button: {
    group: 'shortcode-core',
    label: 'Safe Email',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 9.25a4.924 4.924 0 011.666.291.25.25 0 00.334-.236V1.75a.158.158 0 00-.1-.147.16.16 0 00-.173.034L12.2 10.164a2.407 2.407 0 01-3.4 0L.271 1.637A.159.159 0 000 1.75v10.5A1.749 1.749 0 001.75 14h12.043a.25.25 0 00.249-.226A4.992 4.992 0 0119 9.25z"/><path d="M9.726 9.236a1.094 1.094 0 001.547 0L19.748.761A.437.437 0 0019.5.019 1.62 1.62 0 0019.249 0h-17.5A1.62 1.62 0 001.5.019a.437.437 0 00-.352.3.441.441 0 00.102.442zM22.5 15.5v-1.25a3.5 3.5 0 00-7 0v1.25A1.5 1.5 0 0014 17v5.5a1.5 1.5 0 001.5 1.5h7a1.5 1.5 0 001.5-1.5V17a1.5 1.5 0 00-1.5-1.5zM19 12.75a1.5 1.5 0 011.5 1.5v1.25h-3v-1.25a1.5 1.5 0 011.5-1.5zm1 7.5a1 1 0 11-1-1 1 1 0 011 1z"/></svg>',
  },
  attributes: {
    icon: {
      type: String,
      title: 'Icon',
      bbcode: true,
      widget: 'input-text',
      default: 'grav',
    },
    autolink: {
      type: String,
      title: 'Autolink',
      widget: {
        type: 'checkbox',
        valueType: String,
        label: 'Yes',
      },
      default: 'false',
    },
  },
  content({ attributes }) {
    let output = '';

    if (attributes.autolink === 'true') {
      output += '<span style="color:#1c90fb">';
    }

    if (attributes.icon) {
      output += `<span class="fa fa-${attributes.icon}" style="margin-left:4px"></span>`;
    }

    output += '{{content_editable}}';

    if (attributes.autolink === 'true') {
      output += '</span>';
    }

    return output;
  },
});
