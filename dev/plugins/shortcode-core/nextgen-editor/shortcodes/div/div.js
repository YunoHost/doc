window.nextgenEditor.addShortcode('div', {
  type: 'block',
  plugin: 'shortcode-core',
  title: 'Div',
  button: {
    group: 'shortcode-core',
    label: 'Div',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24 4.5a3 3 0 00-3-3H3a3 3 0 00-3 3v15a3 3 0 003 3h18a3 3 0 003-3zM3 5a1 1 0 111 1 1 1 0 01-1-1zm3 0a1 1 0 111 1 1 1 0 01-1-1zm3 0a1 1 0 111 1 1 1 0 01-1-1zm13 14.5a1 1 0 01-1 1H3a1 1 0 01-1-1V9a.5.5 0 01.5-.5h19a.5.5 0 01.5.5z"/><path d="M7.75 12a.75.75 0 00.75.75.25.25 0 01.25.25v4a.75.75 0 001.5 0v-4a.25.25 0 01.25-.25.75.75 0 000-1.5h-2a.75.75 0 00-.75.75zM4 17.75a.75.75 0 00.75-.75v-1a.25.25 0 01.5 0v1a.75.75 0 001.5 0v-5a.75.75 0 00-1.5 0v2a.25.25 0 01-.5 0v-2a.75.75 0 00-1.5 0v5a.75.75 0 00.75.75zM17.75 16a1.752 1.752 0 001.75 1.75h1a.75.75 0 000-1.5h-1a.25.25 0 01-.25-.25v-4a.75.75 0 00-1.5 0zM13 17.75a.75.75 0 00.75-.75v-2.085a.057.057 0 01.106-.029.781.781 0 001.288 0 .057.057 0 01.106.029V17a.75.75 0 001.5 0v-5a.751.751 0 00-1.394-.386l-.642 1.071a.25.25 0 01-.428 0l-.642-1.071A.751.751 0 0012.25 12v5a.75.75 0 00.75.75z"/></svg>',
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
    style: {
      type: String,
      title: 'Style',
      widget: 'input-text',
      default: '',
    },
  },
  titlebar({ attributes }) {
    return []
      .concat([
        attributes.id ? `id: <strong>${attributes.id}</strong>` : null,
        attributes.class ? `class: <strong>${attributes.class}</strong>` : null,
        attributes.style ? `style: <strong>${attributes.style}</strong>` : null,
      ])
      .filter((item) => !!item)
      .join(', ');
  },
  content({ attributes }) {
    const id = attributes.id || '';
    const cclass = attributes.class || '';
    const style = attributes.style || '';

    return `<div id="${id}" class="${cclass}" style="${style}">{{content_editable}}</div>`;
  },
});
