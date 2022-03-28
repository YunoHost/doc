window.nextgenEditor.addShortcode('section', {
  type: 'block',
  plugin: 'shortcode-core',
  title: 'Section',
  button: {
    group: 'shortcode-core',
    label: 'Section',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.242 18.827a6.523 6.523 0 10-1.414 1.414l3.465 3.465a1.014 1.014 0 001.414 0 1 1 0 000-1.414zM15 10.5a4.5 4.5 0 11-4.5 4.5 4.505 4.505 0 014.5-4.5z"/><path d="M13 15.749h1.25V17a.75.75 0 001.5 0v-1.25H17a.75.75 0 000-1.5h-1.25V13a.75.75 0 00-1.5 0v1.25H13a.75.75 0 000 1.5zM3.933 0H1.957A1.959 1.959 0 000 1.956v1.977a1 1 0 002 0L1.957 2h1.976a1 1 0 000-2zM3.933 22L2 22.042v-1.976a1 1 0 00-2 0v1.976A1.959 1.959 0 001.957 24h1.976a1 1 0 000-2zM1 11.533a1 1 0 001-1V7.6a1 1 0 00-2 0v2.934a1 1 0 001 .999zM1 17.4a1 1 0 001-1v-2.934a1 1 0 00-2 0V16.4a1 1 0 001 1zM23 6.6a1 1 0 00-1 1v2.934a1 1 0 102 0V7.6a1 1 0 00-1-1zM7.6 2H10a1 1 0 000-2H7.6a1 1 0 000 2zM14 2h2.4a1 1 0 000-2H14a1 1 0 000 2zM20.067 2L22 1.956v1.977a1 1 0 002 0V1.956A1.959 1.959 0 0022.043 0h-1.976a1 1 0 000 2zM10.533 22H7.6a1 1 0 100 2h2.933a1 1 0 000-2z"/></svg>',
  },
  attributes: {
    name: {
      type: String,
      title: 'Name',
      widget: 'input-text',
      default: '',
    },
  },
  titlebar({ attributes }) {
    return attributes.name
      ? `name: <strong>${attributes.name}</strong>`
      : '';
  },
  content() {
    return '{{content_editable}}';
  },
});
