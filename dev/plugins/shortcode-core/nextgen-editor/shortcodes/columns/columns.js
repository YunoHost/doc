window.nextgenEditor.addShortcode('columns', {
  type: 'block',
  plugin: 'shortcode-core',
  title: 'Columns',
  button: {
    group: 'shortcode-core',
    label: 'Columns',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 0H2a2 2 0 00-2 2v20a2 2 0 002 2h20a2 2 0 002-2V2a2 2 0 00-2-2zm-7 2.5v19a.5.5 0 01-.5.5h-5a.5.5 0 01-.5-.5v-19a.5.5 0 01.5-.5h5a.5.5 0 01.5.5zM2.5 2h4a.5.5 0 01.5.5v19a.5.5 0 01-.5.5h-4a.5.5 0 01-.5-.5v-19a.5.5 0 01.5-.5zm19 20h-4a.5.5 0 01-.5-.5v-19a.5.5 0 01.5-.5h4a.5.5 0 01.5.5v19a.5.5 0 01-.5.5z"/></svg>',
  },
  attributes: {
    count: {
      type: Number,
      title: 'Count',
      widget: {
        type: 'input-number',
        min: 1,
        max: 12,
      },
      default: 2,
    },
    width: {
      type: String,
      title: 'Width',
      widget: 'input-text',
      default: 'auto',
    },
    gap: {
      type: String,
      title: 'Gap',
      widget: 'input-text',
      default: 'normal',
    },
    rule: {
      type: String,
      title: 'Rule',
      widget: 'input-text',
      default: '',
    },
  },
  titlebar({ attributes }) {
    return `columns: <strong>${attributes.count}</strong>`;
  },
  content({ attributes }) {
    const styles = []
      .concat([
        `columns:${attributes.count} ${attributes.width}`,
        `-moz-columns:${attributes.count} ${attributes.width}`,
        `column-gap:${attributes.gap}`,
        `-moz-column-gap:${attributes.gap}`,
        attributes.rule ? `column-rule:${attributes.rule}` : null,
        attributes.rule ? `-moz-column-rule:${attributes.rule}` : null,
      ])
      .filter((item) => !!item)
      .join(';');

    return `<div style="${styles}">{{content_editable}}</div>`;
  },
});
