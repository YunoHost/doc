window.nextgenEditor.addShortcode('figure', {
  type: 'block',
  plugin: 'shortcode-core',
  title: 'Figure',
  button: {
    group: 'shortcode-core',
    label: 'Figure',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24 3a3 3 0 00-3-3H3a3 3 0 00-3 3v18a3 3 0 003 3h18a3 3 0 003-3zm-2 18a1 1 0 01-1 1H3a1 1 0 01-1-1V3a1 1 0 011-1h18a1 1 0 011 1z"/><circle cx="14" cy="9.5" r="3"/><path d="M14 5.25a.75.75 0 00.75-.75V4a.75.75 0 00-1.5 0v.5a.75.75 0 00.75.75zM9.935 6.494A.75.75 0 1011 5.434l-.353-.354a.75.75 0 00-1.066 1.061zM8.5 10.25H9a.75.75 0 000-1.5h-.5a.75.75 0 000 1.5zM18.065 12.506a.75.75 0 00-1.06 1.06l.353.354a.75.75 0 001.061-1.061zM18.25 9.5a.75.75 0 00.75.75h.5a.75.75 0 000-1.5H19a.75.75 0 00-.75.75zM17.535 6.715a.743.743 0 00.53-.221l.354-.353a.75.75 0 00-1.061-1.061l-.353.354a.751.751 0 00.53 1.281zM15.8 16.086a4.573 4.573 0 00-1.449.234.249.249 0 00-.12.388 7.827 7.827 0 011.518 3.654.161.161 0 00.159.138h3.154a1.536 1.536 0 001.264-.663 4.607 4.607 0 00-4.526-3.751zM7.914 14.551a6.875 6.875 0 00-4.32 1.518.25.25 0 00-.094.2v2.7A1.535 1.535 0 005.035 20.5h9.427a.251.251 0 00.193-.09.249.249 0 00.053-.205 6.909 6.909 0 00-6.794-5.654z"/></svg>',
  },
  attributes: {
    id: {
      type: String,
      title: 'ID',
      widget: 'input-text',
      default: '',
    },
    class: {
      type: String,
      title: 'Class',
      widget: 'input-text',
      default: '',
    },
    caption: {
      type: String,
      title: 'Caption',
      widget: 'input-text',
      default: '',
    },
  },
  titlebar({attributes }) {
    return []
      .concat([
        attributes.id ? `id: <strong>${attributes.id}</strong>` : null,
        attributes.class ? `class: <strong>${attributes.class}</strong>` : null,
      ])
      .filter((item) => !!item)
      .join(', ');
  },
  content({ attributes }) {
    const id = attributes.id || '';
    const cclass = attributes.class || '';
    const caption = attributes.caption || '';

    return `<div id="${id}" class="${cclass}">{{content_editable}}<div style="margin:0 8px;">${caption}</div></div>`;
  },
});
