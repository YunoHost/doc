import collapse from './collapse';
import uncollapse from './uncollapse';

const { showSettingsPopup } = window.nextgenEditor.exports;

export default function displaySettings(domShortcode) {
  const { editors } = window.nextgenEditor;
  const editor = (editors.filter((instance) => instance.ui.view.element.contains(domShortcode)) || []).shift();

  const name = domShortcode.getAttribute('name');
  const shortcode = window.nextgenEditor.shortcodes[name];
  const plugin = window.nextgenEditor.shortcodePlugins[shortcode.plugin];

  if (editor) {
    const viewShortcode = editor.editing.view.domConverter.mapDomToView(domShortcode);
    let modelShortcode = editor.editing.mapper.toModelElement(viewShortcode);

    const currentAttributes = JSON.parse(decodeURIComponent(domShortcode.getAttribute('attributes')));

    const domDisplayPoint = shortcode.type === 'block'
      ? domShortcode.querySelector('.sc-header > .sc-settings')
      : domShortcode;

    const title = []
      .concat([
        (plugin && plugin.title) || '',
        (shortcode.parent && shortcode.parent.title) || '',
        shortcode.title || '',
      ])
      .filter((item) => !!item)
      .join(' / ');

    const argsForPopup = {
      title,
      domDisplayPoint,
      debounceDelay: 1000,
      attributes: shortcode.attributes,
      currentAttributes,
      parentAttributes: null,
      childAttributes: null,
    };

    if (shortcode.parent) {
      const domParentShortcode = domShortcode.closest(`shortcode-block[name="${shortcode.parent.name}"]`);

      argsForPopup.parentAttributes = domParentShortcode
        ? JSON.parse(decodeURIComponent(domParentShortcode.getAttribute('attributes')))
        : {};
    }

    if (shortcode.child) {
      argsForPopup.childAttributes = [];

      const childNodes = [...domShortcode.querySelectorAll(`shortcode-block shortcode-block[name="${shortcode.child.name}"]`)];
      const deepChildNodes = [...domShortcode.querySelectorAll(`shortcode-block shortcode-block shortcode-block[name="${shortcode.child.name}"]`)];

      childNodes
        .filter((domChildShortcode) => !deepChildNodes.includes(domChildShortcode))
        .forEach((domChildShortcode) => {
          const childAttributes = JSON.parse(decodeURIComponent(domChildShortcode.getAttribute('attributes')));
          argsForPopup.childAttributes.push(childAttributes);
        });
    }

    argsForPopup.deleteItem = () => editor.execute('delete');

    argsForPopup.changeAttributes = () => {
      editor.model.change((modelWriter) => {
        modelWriter.setAttribute('attributes', encodeURIComponent(JSON.stringify(currentAttributes)), modelShortcode);

        const convertContext = shortcode.type === 'inline'
          ? '$block'
          : '$root';

        if (shortcode.parent) {
          const viewOldShortcode = editor.editing.mapper.toViewElement(modelShortcode);
          const domOldShortcode = editor.editing.view.domConverter.mapViewToDom(viewOldShortcode);

          if (!domOldShortcode) {
            return;
          }

          const domOldParentShortcode = domOldShortcode.parentNode.closest('shortcode-block');
          const viewOldParentShortcode = editor.editing.view.domConverter.mapDomToView(domOldParentShortcode);
          const modelOldParentShortcode = editor.editing.mapper.toModelElement(viewOldParentShortcode);

          const childNodes = [...domOldParentShortcode.querySelectorAll('shortcode-block shortcode-block')];
          const deepChildNodes = [...domOldParentShortcode.querySelectorAll('shortcode-block shortcode-block shortcode-block')];

          const childIndex = childNodes
            .filter((domChildShortcode) => !deepChildNodes.includes(domChildShortcode))
            .indexOf(domOldShortcode);

          const insertPosition = modelWriter.createPositionBefore(modelOldParentShortcode);
          const modelOldParentClonedShortcode = modelWriter.cloneElement(modelOldParentShortcode);

          const modelOldParentFragment = modelWriter.createDocumentFragment();
          modelWriter.append(modelOldParentClonedShortcode, modelOldParentFragment);

          const viewOldParentClonedShortcode = editor.data.toView(modelOldParentFragment).getChild(0);
          const dataOldParentClonedShortcode = editor.data.processor.toData(viewOldParentClonedShortcode);

          const dataNewParentShortcode = uncollapse(collapse(dataOldParentClonedShortcode));
          const viewNewParentShortcode = editor.data.processor.toView(dataNewParentShortcode).getChild(0);
          const modelNewParentShortcode = editor.data.toModel(viewNewParentShortcode, convertContext).getChild(0);

          modelWriter.remove(modelOldParentShortcode);
          modelWriter.insert(modelNewParentShortcode, insertPosition);

          setTimeout(() => {
            const viewParentShortcode = editor.editing.mapper.toViewElement(modelNewParentShortcode);
            const domParentShortcode = editor.editing.view.domConverter.mapViewToDom(viewParentShortcode);

            const childNewNodes = [...domParentShortcode.querySelectorAll('shortcode-block shortcode-block')];
            const deepNewChildNodes = [...domParentShortcode.querySelectorAll('shortcode-block shortcode-block shortcode-block')];

            const domNewShortcode = childNewNodes.filter((domChildShortcode) => !deepNewChildNodes.includes(domChildShortcode))[childIndex];
            const viewNewShortcode = editor.editing.view.domConverter.mapDomToView(domNewShortcode);
            const modelNewShortcode = editor.editing.mapper.toModelElement(viewNewShortcode);

            editor.model.change((modelWriter2) => {
              modelWriter2.setSelection(modelNewShortcode, 'on');
              modelShortcode = modelNewShortcode;
            });
          });

          return;
        }

        const insertPosition = modelWriter.createPositionBefore(modelShortcode);
        const modelOldShortcode = modelWriter.cloneElement(modelShortcode);

        const modelOldFragment = modelWriter.createDocumentFragment();
        modelWriter.append(modelOldShortcode, modelOldFragment);

        const viewOldShortcode = editor.data.toView(modelOldFragment).getChild(0);
        const dataOldShortcode = editor.data.processor.toData(viewOldShortcode);

        const dataNewShortcode = uncollapse(collapse(dataOldShortcode));
        const viewNewShortcode = editor.data.processor.toView(dataNewShortcode).getChild(0);
        const modelNewShortcode = editor.data.toModel(viewNewShortcode, convertContext).getChild(0);

        modelWriter.remove(modelShortcode);
        modelWriter.insert(modelNewShortcode, insertPosition);
        modelWriter.setSelection(modelNewShortcode, 'on');

        modelShortcode = modelNewShortcode;
      });
    };

    showSettingsPopup(argsForPopup);
  }
}
