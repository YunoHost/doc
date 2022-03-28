window.nextgenEditor.addShortcode('size', {
  type: 'inline',
  plugin: 'shortcode-core',
  title: 'Font Size',
  button: {
    group: 'shortcode-core',
    label: 'Font Size',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 3.993H2a2 2 0 00-2 2v2a1 1 0 002 0v-1.75a.249.249 0 01.25-.25h4a.249.249 0 01.25.25v12.5a.25.25 0 01-.25.25H4.5a1 1 0 000 2h6a1 1 0 000-2H8.75a.25.25 0 01-.25-.25v-12.5a.249.249 0 01.25-.25h4a.249.249 0 01.25.25v1.75a1 1 0 102 0v-2a2 2 0 00-2-2zM23.5 18.493h-1.75a.25.25 0 01-.25-.25v-12.5a.249.249 0 01.25-.25h1.75a.5.5 0 00.4-.8l-3-4a.518.518 0 00-.8 0l-3 4a.5.5 0 00.4.8h1.75a.249.249 0 01.25.25v12.5a.25.25 0 01-.25.25H17.5a.5.5 0 00-.4.8l3 4a.5.5 0 00.8 0l3-4a.5.5 0 00-.4-.8z"/></svg>',
  },
  attributes: {
    size: {
      type: String,
      title: 'Size',
      bbcode: true,
      widget: 'input-text',
      default: '14',
    },
  },
  content({ attributes }) {
    const size = !Number.isNaN(+attributes.size)
      ? `${attributes.size}px`
      : attributes.size;

    return `<span style="font-size:${size}">{{content_editable}}</span>`;
  },
});
