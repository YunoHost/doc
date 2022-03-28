window.nextgenEditor.addPlugin('GravShortcodeCoreRemove', {
  init() {
    const deleteBackwardCommand = this.editor.commands.get('delete');
    const deleteForwardCommand = this.editor.commands.get('forwardDelete');

    const preDelete = (event) => {
      const selectedElement = this.editor.model.document.selection.getSelectedElement();

      if (selectedElement && selectedElement.name === 'shortcode-block') {
        const name = selectedElement.getAttribute('name');
        const shortcode = window.nextgenEditor.shortcodes[name];

        if (shortcode.parent) {
          const viewShortcode = this.editor.editing.mapper.toViewElement(selectedElement);
          const domShortcode = this.editor.editing.view.domConverter.mapViewToDom(viewShortcode);
          const domParentShortcode = domShortcode.closest(`shortcode-block[name="${shortcode.parent.name}"]`);

          event.childShortcodeDeleted = true;
          event.modelShortcodeBlockReadOnly = selectedElement.parent;
          event.domParentShortcode = domParentShortcode;
        }
      }
    };

    const postDelete = (event) => {
      if (event.childShortcodeDeleted) {
        const { domParentShortcode, modelShortcodeBlockReadOnly } = event;

        const children = [...modelShortcodeBlockReadOnly.getChildren()];
        const scChildren = children.filter((child) => child.name === 'shortcode-block');
        const otherChildren = children.filter((child) => child.name !== 'shortcode-block');

        setTimeout(() => {
          this.editor.model.change((modelWriter) => {
            otherChildren.forEach((modelChild) => {
              if (modelChild.name === 'paragraph' && modelChild.childCount === 0) {
                modelWriter.remove(modelChild);
              }
            });
          });
        });

        if (!scChildren.length) {
          domParentShortcode.querySelector('shortcode-block > .sc-add-child').classList.add('sc-visible');
        }
      }
    };

    deleteBackwardCommand.on('execute', preDelete, { priority: 'highest' });
    deleteForwardCommand.on('execute', preDelete, { priority: 'highest' });

    deleteBackwardCommand.on('execute', postDelete, { priority: 'lowest' });
    deleteForwardCommand.on('execute', postDelete, { priority: 'lowest' });
  },
});
