import collapse from './collapse';
import uncollapse from './uncollapse';

const Command = window.nextgenEditor.classes.core.command.class;

window.nextgenEditor.addPlugin('GravShortcodeCoreCommand', {
  init() {
    Object.values(window.nextgenEditor.shortcodes).forEach((shortcode) => {
      const commandName = `shortcode_${shortcode.name}`;

      class GravShortcodeCoreCommand extends Command {
        execute(args) {
          this.editor.model.change((modelWriter) => {
            let dataShortcode = '';
            const argsForUncollapse = {};

            const wrapOnInsert = !shortcode.child && !shortcode.parent
              ? shortcode.wrapOnInsert !== undefined
                ? shortcode.wrapOnInsert
                : true
              : false;

            const selectedBlocks = [...this.editor.model.document.selection.getSelectedBlocks()];
            const selectedItems = [...this.editor.model.document.selection.getFirstRange().getItems({ shallow: true })];

            const firstSelectedBlock = selectedBlocks[0];
            const firstBlockSelectedItems = selectedItems.filter((item) => item.parent === firstSelectedBlock);

            const attributes = Object.keys(shortcode.attributes).reduce((acc, attrName) => {
              acc[attrName] = shortcode.attributes[attrName].default.value;
              return acc;
            }, {});

            dataShortcode += `<shortcode-${shortcode.type} name="${shortcode.name}" attributes="${encodeURIComponent(JSON.stringify(attributes))}">`;

            if (wrapOnInsert) {
              if (shortcode.type === 'block') {
                const modelSelectedBlocks = modelWriter.createDocumentFragment();
                selectedBlocks.forEach((block) => modelWriter.append(modelWriter.cloneElement(block), modelSelectedBlocks));

                const viewSelectedBlocks = this.editor.data.toView(modelSelectedBlocks);
                const dataSelectedBlocks = this.editor.data.processor.toData(viewSelectedBlocks);

                dataShortcode += collapse(dataSelectedBlocks);
              }

              if (shortcode.type === 'inline') {
                const modelSelectedBlocks = modelWriter.createDocumentFragment();

                firstBlockSelectedItems.forEach((item) => {
                  const block = item.textNode
                    ? modelWriter.createText(item.data)
                    : modelWriter.cloneElement(item);

                  modelWriter.append(block, modelSelectedBlocks);
                });

                const viewSelectedBlocks = this.editor.data.toView(modelSelectedBlocks);
                const dataSelectedBlocks = this.editor.data.processor.toData(viewSelectedBlocks);

                dataShortcode += collapse(dataSelectedBlocks);
              }
            }

            if (shortcode.parent) {
              dataShortcode += '<p>&nbsp;</p>';
            }

            dataShortcode += `</shortcode-${shortcode.type}>`;

            if (shortcode.parent) {
              if (args && args.modelParentShortcode) {
                argsForUncollapse.parentAttributes = JSON.parse(decodeURIComponent(args.modelParentShortcode.getAttribute('attributes')));
              }
            }

            dataShortcode = uncollapse(dataShortcode, argsForUncollapse);

            const convertContext = shortcode.type === 'inline'
              ? '$block'
              : '$root';

            const viewShortcode = this.editor.data.processor.toView(dataShortcode).getChild(0);
            const modelShortcode = this.editor.data.toModel(viewShortcode, convertContext).getChild(0);

            let insertPosition = modelWriter.createPositionAt(this.editor.model.document.getRoot(), 0);

            if (!args || !args.insertPosition) {
              if (shortcode.type === 'block') {
                const firstBlock = selectedBlocks[0];
                const lastBlock = selectedBlocks[selectedBlocks.length - 1];

                if (wrapOnInsert) {
                  insertPosition = modelWriter.createPositionBefore(firstBlock);

                  modelWriter.remove(
                    modelWriter.createRange(
                      modelWriter.createPositionBefore(firstBlock),
                      modelWriter.createPositionAfter(lastBlock),
                    ),
                  );
                } else {
                  insertPosition = modelWriter.createPositionAfter(lastBlock);

                  if (lastBlock && lastBlock.name === 'paragraph' && lastBlock.childCount === 0) {
                    insertPosition = modelWriter.createPositionBefore(lastBlock);
                    modelWriter.remove(lastBlock);
                  }
                }
              }

              if (shortcode.type === 'inline') {
                const firstItem = firstBlockSelectedItems.length
                  ? firstBlockSelectedItems[0]
                  : null;

                const lastItem = firstBlockSelectedItems.length
                  ? firstBlockSelectedItems[firstBlockSelectedItems.length - 1]
                  : null;

                if (wrapOnInsert) {
                  insertPosition = firstItem
                    ? modelWriter.createPositionBefore(firstItem)
                    : this.editor.model.document.selection.getFirstPosition();

                  if (firstItem) {
                    modelWriter.remove(
                      modelWriter.createRange(
                        modelWriter.createPositionBefore(firstItem),
                        modelWriter.createPositionAfter(lastItem),
                      ),
                    );
                  }
                } else {
                  insertPosition = lastItem
                    ? modelWriter.createPositionAfter(lastItem)
                    : this.editor.model.document.selection.getFirstPosition();
                }
              }
            } else {
              insertPosition = args.insertPosition;
            }

            modelWriter.insert(modelShortcode, insertPosition);
            modelWriter.setSelection(modelShortcode, 'on');
          });
        }
      }

      this.editor.commands.add(commandName, new GravShortcodeCoreCommand(this.editor));
    });
  },
});
