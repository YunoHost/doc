window.nextgenEditor.addShortcode('mark', {
  type: 'inline',
  plugin: 'shortcode-core',
  title: 'Mark',
  button: {
    group: 'shortcode-core',
    label: 'Mark',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3.448 18a.253.253 0 00-.184-.073.25.25 0 00-.179.083L.192 21.247A.75.75 0 00.751 22.5H4a.752.752 0 00.507-.2L6 20.929a.244.244 0 00.081-.178.25.25 0 00-.073-.183zM7.27 20.035a1.256 1.256 0 001.7.068c.611-.524 1.8-1.278 2.894-.447a1.269 1.269 0 001.7-.171l.182-.227a.25.25 0 00-.018-.333l-8.673-8.667a.249.249 0 00-.341-.011l-.273.238a1.257 1.257 0 00-.111 1.641c.832 1.094.078 2.282-.444 2.894a1.254 1.254 0 00.065 1.7zM14.312 18.1a.249.249 0 00.372-.021L23.1 7.6a1.884 1.884 0 00-.133-2.486L18.379.523A1.841 1.841 0 0015.9.443L5.844 9.256a.25.25 0 00-.012.365zM24 23a1 1 0 00-1-1H9a1 1 0 000 2h14a1 1 0 001-1z"/></svg>',
  },
  attributes: {
    style: {
      type: String,
      title: 'Style',
      bbcode: true,
      widget: {
        type: 'radios',
        values: [
          { value: 'inline', label: 'Inline' },
          { value: 'block', label: 'Block' },
        ],
      },
      default: 'inline',
    },
    class: {
      type: String,
      title: 'Class',
      widget: 'input-text',
      default: '',
    },
  },
  titlebar({ attributes }) {
    return []
      .concat([
        attributes.style ? `style: <strong>${attributes.style}</strong>` : null,
        attributes.class ? `class: <strong>${attributes.class}</strong>` : null,
      ])
      .filter((item) => !!item)
      .join(', ');
  },
  content({ attributes }) {
    const style = attributes.style === 'block'
      ? 'display:block'
      : '';

    const cclass = `mark-class-${attributes.class}`;

    return `<span class="${cclass}" style="${style}">{{content_editable}}</span>`;
  },
});
