window.nextgenEditor.addShortcode('notice', {
  type: 'block',
  plugin: 'shortcode-core',
  title: 'Notice',
  button: {
    group: 'shortcode-core',
    label: 'Notice',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.5 14a1 1 0 00-.665.252L5 16.773V15a1 1 0 00-1-1H2.25a.251.251 0 01-.25-.253V2.25A.249.249 0 012.251 2h18a.25.25 0 01.25.25v10.007a.248.248 0 00.028.116l1.316 2.509a.25.25 0 00.445 0A1.939 1.939 0 0022.5 14V2a2 2 0 00-2-2H2a2 2 0 00-2 2v12.053A1.953 1.953 0 002 16h1v3a1 1 0 001.664.748L8.881 16h3.537a.251.251 0 00.221-.134l.787-1.5a.249.249 0 00-.007-.245.252.252 0 00-.214-.121z"/><path d="M18.782 12.271a1.45 1.45 0 00-2.562 0l-5.055 9.634a1.433 1.433 0 00.048 1.409 1.457 1.457 0 001.232.686h10.111a1.459 1.459 0 001.234-.687 1.434 1.434 0 00.047-1.408zM17.5 15.25a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm0 7a1 1 0 111-1 1 1 0 01-1 1z"/></svg>',
  },
  attributes: {
    notice: {
      type: String,
      title: 'Type',
      bbcode: true,
      widget: {
        type: 'radios',
        values: [
          { value: 'info', label: 'Info' },
          { value: 'warning', label: 'Warning' },
          { value: 'note', label: 'Note' },
          { value: 'tip', label: 'Tip' },
        ],
      },
      default: 'info',
    },
  },
  titlebar({ attributes }) {
    const notice = attributes.notice
      ? this.attributes.notice.widget.values.find((item) => item.value === attributes.notice)
      : '';

    const type = notice
      ? notice.label
      : '';

    return `type: <strong>${type}</strong>`;
  },
  content({ attributes }) {
    return `<div class="sc-notice sc-notice-${attributes.notice}"><div class="sc-notice-wrapper">{{content_editable}}</div></div>`;
  },
});
