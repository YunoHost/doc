window.nextgenEditor.addHook('hookInit', () => {
  window.nextgenEditor.addButtonGroup('shortcode-core-align', {
    icon: '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2.75 1h-.01c-.56 0-1 .44-1 1v20c0 .55.44.99 1 .99.55-.01.99-.45.99-1.01v-20c0-.56-.45-1-1-1z"/><rect style="width:11px;height:6px;" x="5.25" rx="1.5" y="5"/><rect style="width:17px;height:6px;" x="5.25" rx="1.5" y="13"/></svg>',
    label: 'SC Align',
  });
});

window.nextgenEditor.addShortcode('left', {
  type: 'block',
  plugin: 'shortcode-core',
  title: 'Align Left',
  button: {
    group: 'shortcode-core-align',
    label: 'Align Left',
  },
  content() {
    return '<div style="text-align:left">{{content_editable}}</div>';
  },
});

window.nextgenEditor.addShortcode('center', {
  type: 'block',
  title: 'Align Center',
  button: {
    group: 'shortcode-core-align',
    label: 'Align Center',
  },
  content() {
    return '<div style="text-align:center">{{content_editable}}</div>';
  },
});

window.nextgenEditor.addShortcode('right', {
  type: 'block',
  title: 'Align Right',
  button: {
    group: 'shortcode-core-align',
    label: 'Align Right',
  },
  content() {
    return '<div style="text-align:right">{{content_editable}}</div>';
  },
});

window.nextgenEditor.addShortcode('justify', {
  type: 'block',
  title: 'Justify',
  button: {
    group: 'shortcode-core-align',
    label: 'Justify',
  },
  content() {
    return '<div style="text-align:justify">{{content_editable}}</div>';
  },
});
