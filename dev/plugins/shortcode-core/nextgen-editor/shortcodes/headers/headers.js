window.nextgenEditor.addHook('hookInit', () => {
  window.nextgenEditor.addButtonGroup('shortcode-core-headers', {
    icon: '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.567 20.509h-.61a.274.274 0 01-.24-.17L10.62 2.5l-.01-.01c-.21-.6-.76-1-1.39-1H9.2c-.63 0-1.19.39-1.39.99L1.74 20.29v-.01c-.04.09-.13.16-.24.16H.9a.976.976 0 10-.08 1.95h3l-.01-.001c.54 0 .97-.44.98-.98v-.02a.96.96 0 00-.82-.96l-.01-.001c-.07-.02-.14-.06-.17-.12a.245.245 0 01-.03-.2l1.5-4.413h-.01c.03-.1.12-.17.23-.17h7.23l-.01-.001c.1 0 .19.06.23.16l1.5 4.41c.04.12-.03.26-.16.31h-.04c-.47.07-.8.48-.8.95v-.01c-.01.54.43.97.97.98h2.94c.54.01.99-.41 1.01-.95.01-.55-.41-1-.95-1.02-.03-.01-.05-.01-.07-.01zM6.47 13.669v-.001c-.14 0-.25-.11-.25-.25-.01-.03 0-.06.01-.08L9 5.178h-.01c.04-.13.18-.2.31-.16.07.02.12.08.15.15l2.78 8.153c.02.07.01.15-.04.22h-.01c-.05.06-.13.1-.2.09z"/><path d="M23.02 20.509h-.22l-.01-.001a.274.274 0 01-.24-.17L18.29 7.87a1.53 1.53 0 00-1.94-.97c-.46.15-.81.5-.97.96l-1.15 3.38h-.01c-.18.51.09 1.06.61 1.24.51.17 1.06-.1 1.24-.62l.51-1.513v-.01c.04-.13.18-.2.31-.16.07.02.12.08.15.15l1.46 4.3c.04.12-.03.26-.16.31-.03 0-.06.01-.09.01h-1.37v-.01c-.55.01-.97.46-.95 1.01.01.51.43.93.94.94h2.2l-.01-.001c.1 0 .19.06.23.16l1.1 3.21a.25.25 0 01-.12.3v-.01c-.32.16-.52.49-.52.84v-.01c-.01.54.43.97.97.98h2.17c.54.01.99-.41 1.01-.95.01-.55-.41-1-.95-1.02-.03-.01-.05-.01-.07-.01z"/></svg>',
    label: 'SC Headers',
  });
});

for (let i = 1; i <= 6; i += 1) {
  window.nextgenEditor.addShortcode(`h${i}`, {
    type: 'block',
    plugin: 'shortcode-core',
    title: `H${i}`,
    button: {
      group: 'shortcode-core-headers',
      label: `H${i}`,
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
    },
    titlebar({ attributes }) {
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

      return `<div id="${id}" class="${cclass}">{{content_editable}}</div>`;
    },
  });
}
