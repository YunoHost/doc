window.nextgenEditor.addShortcode('color', {
  type: 'inline',
  plugin: 'shortcode-core',
  title: 'Color',
  button: {
    group: 'shortcode-core',
    label: 'Color',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M9.3 24a1 1 0 00.756-.345L22.523 9.277a2 2 0 00-.212-2.822l-2.45-2.105a1 1 0 00-1.3 1.517l2.072 1.775a.5.5 0 01.052.707l-7.8 9a.25.25 0 01-.423-.251l4.671-12.614a2 2 0 00-1.181-2.57L12.609.675a1 1 0 10-.7 1.875l2.876 1.065a.5.5 0 01.295.643l-4.602 12.419a.25.25 0 01-.485-.087V1.5a1.5 1.5 0 00-1.5-1.5h-6a1.5 1.5 0 00-1.5 1.5v21a1.5 1.5 0 001.5 1.5zM3.493 9.75a.5.5 0 01.5-.5h3a.5.5 0 01.5.5v3a.5.5 0 01-.5.5h-3a.5.5 0 01-.5-.5zm0-3.75V3a.5.5 0 01.5-.5h3a.5.5 0 01.5.5v3a.5.5 0 01-.5.5h-3a.5.5 0 01-.5-.5zm0 10.5a.5.5 0 01.5-.5h3a.5.5 0 01.5.5v3a.5.5 0 01-.5.5h-3a.5.5 0 01-.5-.5z"/></svg>',
  },
  attributes: {
    color: {
      type: String,
      title: 'Color',
      bbcode: true,
      widget: 'input-text',
      default: '',
    },
  },
  content({ attributes }) {
    return `<span style="color:${attributes.color}">{{content_editable}}</span>`;
  },
});
