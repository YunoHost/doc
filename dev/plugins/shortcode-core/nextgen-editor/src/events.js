import displaySettings from './settings';

window.scDisplaySettings = function scDisplaySettings() {
  const domShortcode = this.closest('shortcode-block, shortcode-inline');

  if (domShortcode) {
    displaySettings(domShortcode);
  }
};

window.scBlockAddChildFromParent = function scBlockAddChildFromParent() {
  const { editors } = window.nextgenEditor;

  const domShortcode = this.parentNode;
  const editor = (editors.filter((instance) => instance.ui.view.element.contains(domShortcode)) || []).shift();

  const name = domShortcode.getAttribute('name');
  const shortcode = window.nextgenEditor.shortcodes[name];

  if (editor) {
    const viewShortcode = editor.editing.view.domConverter.mapDomToView(domShortcode);
    const modelShortcode = editor.editing.mapper.toModelElement(viewShortcode);

    const domShortcodeBlockReadOnly = domShortcode.querySelector('shortcode-block-readonly');
    const viewShortcodeBlockReadOnly = editor.editing.view.domConverter.mapDomToView(domShortcodeBlockReadOnly);
    const modelShortcodeBlockReadOnly = editor.editing.mapper.toModelElement(viewShortcodeBlockReadOnly);

    editor.model.change((modelWriter) => {
      const insertPosition = modelWriter.createPositionAt(modelShortcodeBlockReadOnly, 0);
      editor.execute(`shortcode_${shortcode.child.name}`, { insertPosition, modelParentShortcode: modelShortcode });

      domShortcode.querySelector('.sc-add-child').classList.remove('sc-visible');
    });
  }
};

window.scBlockAddChild = function scBlockAddChild(event, where) {
  const { editors } = window.nextgenEditor;

  const domShortcode = this.parentNode;
  const editor = (editors.filter((instance) => instance.ui.view.element.contains(domShortcode)) || []).shift();

  const name = domShortcode.getAttribute('name');
  const shortcode = window.nextgenEditor.shortcodes[name];

  if (editor) {
    const viewShortcode = editor.editing.view.domConverter.mapDomToView(domShortcode);
    const modelShortcode = editor.editing.mapper.toModelElement(viewShortcode);

    editor.model.change((modelWriter) => {
      let modelParentShortcode = modelShortcode.parent;
      const insertPosition = modelWriter.createPositionAt(modelShortcode, where);

      while (modelParentShortcode && modelParentShortcode.name !== 'shortcode-block') {
        modelParentShortcode = modelParentShortcode.parent;
      }

      if (modelParentShortcode) {
        editor.execute(`shortcode_${shortcode.name}`, { insertPosition, modelParentShortcode });
      }
    });
  }
};

window.scBlockMoveChild = function scBlockMove(event, where) {
  const { editors } = window.nextgenEditor;

  const domShortcode = this.parentNode;
  const editor = (editors.filter((instance) => instance.ui.view.element.contains(domShortcode)) || []).shift();

  if (editor) {
    const viewShortcode = editor.editing.view.domConverter.mapDomToView(domShortcode);
    const modelShortcode = editor.editing.mapper.toModelElement(viewShortcode);

    const domSiblingShortcode = where === 'up'
      ? domShortcode.previousSibling
      : domShortcode.nextSibling;

    const viewSiblingShortcode = editor.editing.view.domConverter.mapDomToView(domSiblingShortcode);
    const modelSiblingShortcode = editor.editing.mapper.toModelElement(viewSiblingShortcode);

    editor.model.change((modelWriter) => {
      modelWriter.move(modelWriter.createRangeOn(modelShortcode), modelSiblingShortcode, where === 'up' ? 'before' : 'after');
    });
  }
};
