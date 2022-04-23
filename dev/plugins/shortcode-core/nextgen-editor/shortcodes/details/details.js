window.nextgenEditor.addShortcode('details', {
  type: 'block',
  plugin: 'shortcode-core',
  title: 'Details',
  button: {
    group: 'shortcode-core',
    label: 'Details',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.2 8.348a1 1 0 001.4.2l3.465-2.6a1.5 1.5 0 000-2.4L3.6.948a1 1 0 00-1.2 1.6l2.666 2a.25.25 0 010 .4l-2.666 2a1 1 0 00-.2 1.4zM23 21.248H1a1 1 0 000 2h22a1 1 0 000-2zM23 16.248H1a1 1 0 000 2h22a1 1 0 000-2zM23 11.248H1a1 1 0 000 2h22a1 1 0 000-2zM24 7.248a1 1 0 00-1-1H12a1 1 0 000 2h11a1 1 0 001-1zM12 3.248h11a1 1 0 000-2H12a1 1 0 000 2z"/></svg>',
  },
  attributes: {
    summary: {
      type: String,
      title: 'Summary',
      bbcode: true,
      widget: 'input-text',
      default: '',
    },
    class: {
      type: String,
      title: 'Class',
      widget: 'input-text',
      default: '',
    },
  },
  titlebar({ attributes }) {
    return attributes.class
      ? `class: <strong>${attributes.class}</strong>`
      : '';
  },
  content({ attributes }) {
    let output = '';

    output += `<details class="${attributes.class || ''}" open>`;

    if (attributes.summary) {
      output += `<summary>${attributes.summary}</summary>`;
    }

    output += '{{content_editable}}';
    output += '</details>';

    return output;
  },
  preserve: {
    block: [
      'details',
      'summary',
    ],
  },
});
