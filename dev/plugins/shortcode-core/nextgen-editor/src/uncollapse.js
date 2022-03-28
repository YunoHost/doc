export default function uncollapse(input, args) {
  const domOutput = new DOMParser().parseFromString(input, 'text/html');
  [...domOutput.querySelectorAll('shortcode-block, shortcode-inline')].forEach((domShortcode) => {
    domShortcode.setAttribute('sc-rendered', false);
  });

  let domShortcode = domOutput.querySelector('shortcode-block[sc-rendered], shortcode-inline[sc-rendered]');

  while (domShortcode) {
    const name = domShortcode.getAttribute('name');
    const shortcode = window.nextgenEditor.shortcodes[name];
    const attributes = JSON.parse(decodeURIComponent(domShortcode.getAttribute('attributes')));

    domShortcode.classList.add('ck-shortcode');
    domShortcode.classList.add(`ck-shortcode-${shortcode.type}`);
    domShortcode.removeAttribute('sc-rendered');

    const argsForRender = {
      shortcode,
      attributes,
      innerHTML: domShortcode.innerHTML,
      parentAttributes: null,
      childAttributes: null,
    };

    let innerHTML = '';

    if (shortcode.type === 'block') {
      if (shortcode.parent) {
        domShortcode.classList.add('ck-shortcode-child');

        const domParentShortcode = domShortcode.closest(`shortcode-block[name="${shortcode.parent.name}"]`);

        argsForRender.parentAttributes = !args || !args.parentAttributes
          ? domParentShortcode
            ? JSON.parse(decodeURIComponent(domParentShortcode.getAttribute('attributes')))
            : {}
          : args.parentAttributes;
      }

      if (shortcode.child) {
        argsForRender.childAttributes = [];
        domShortcode.classList.add('ck-shortcode-parent');

        const childNodes = [...domShortcode.querySelectorAll(`shortcode-block shortcode-block[name="${shortcode.child.name}"]`)];
        const deepChildNodes = [...domShortcode.querySelectorAll(`shortcode-block shortcode-block shortcode-block[name="${shortcode.child.name}"]`)];

        childNodes
          .filter((domChildShortcode) => !deepChildNodes.includes(domChildShortcode))
          .forEach((domChildShortcode) => {
            const childAttributes = JSON.parse(decodeURIComponent(domChildShortcode.getAttribute('attributes')));
            argsForRender.childAttributes.push(childAttributes);
          });
      }

      /* eslint-disable indent, no-multi-spaces */
      innerHTML += '<div class="sc-header">';
      innerHTML +=   `<div class="sc-title">Shortcode - <span class="sc-value">${shortcode.title}</span></div>`;
      innerHTML +=   `<div class="sc-titlebar">${shortcode.titlebar(argsForRender)}</div>`;
      innerHTML +=   '<div class="sc-settings">';
      innerHTML +=     '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none">';
      innerHTML +=       '<path d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>';
      innerHTML +=     '</svg>';
      innerHTML +=   '</div>';
      innerHTML += '</div>';
      innerHTML += '<div class="sc-content">';
      innerHTML +=    shortcode.content(argsForRender)
                        .replace('{{content_editable}}', `<shortcode-block-editable>${domShortcode.innerHTML}</shortcode-block-editable>`)
                        .replace('{{content_readonly}}', `<shortcode-block-readonly>${domShortcode.innerHTML}</shortcode-block-readonly>`);
      innerHTML += '</div>';

      if (shortcode.child) {
        const visible = !domShortcode.innerHTML ? ' sc-visible' : '';
        innerHTML += `<div class="sc-add-child${visible}" title="Insert new ${shortcode.child.title}">`;
        innerHTML +=   '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none">';
        innerHTML +=     '<path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"></path>';
        innerHTML +=   '</svg>';
        innerHTML += '</div>';
      }

      if (shortcode.parent) {
        ['before', 'after'].forEach((where) => {
          innerHTML += `<div class="sc-add sc-add-${where}" title="Insert new ${shortcode.title} ${where}">`;
          innerHTML +=   '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none">';
          innerHTML +=     '<path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"></path>';
          innerHTML +=   '</svg>';
          innerHTML += '</div>';
        });

        ['up', 'down'].forEach((where) => {
          innerHTML += `<div class="sc-move sc-move-${where}" title="Move ${shortcode.title} ${where}">`;
          innerHTML +=   '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none">';
          innerHTML +=     '<path fill-rule="evenodd" clip-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>';
          innerHTML +=   '</svg>';
          innerHTML += '</div>';
        });
      }
      /* eslint-enable indent, no-multi-spaces */
    }

    if (shortcode.type === 'inline') {
      /* eslint-disable indent, no-multi-spaces */
      innerHTML += '<span class="sc-content">';
      innerHTML +=    shortcode.content(argsForRender)
                        .replace('{{content_editable}}', `<shortcode-inline-editable>${domShortcode.innerHTML}</shortcode-inline-editable>`)
                        .replace('{{content_readonly}}', `<shortcode-inline-readonly>${domShortcode.innerHTML}</shortcode-inline-readonly>`);
      innerHTML += '</span>';
      innerHTML += '<span class="sc-settings">';
      innerHTML +=   '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none">';
      innerHTML +=     '<path d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>';
      innerHTML +=   '</svg>';
      innerHTML += '</span>';
      /* eslint-enable indent, no-multi-spaces */
    }

    domShortcode.innerHTML = innerHTML;
    domShortcode = domOutput.querySelector('shortcode-block[sc-rendered], shortcode-inline[sc-rendered]');
  }

  return domOutput.body.innerHTML;
}

document.addEventListener('click', (event) => {
  const { target } = event;
  const list = ['sc-settings', 'sc-move', 'sc-add', 'sc-add-child'];
  const action = { element: null, className: null };
  const isAction = list.some((item) => {
    let match = target.classList.contains(item);

    if (match) {
      action.element = target;
      action.className = item;

      return true;
    }

    match = target.closest(`.${item}`);
    if (match) {
      action.element = match;
      action.className = item;

      return true;
    }

    return false;
  });

  if (isAction) {
    switch (action.className) {
      case 'sc-move':
        window.scBlockMoveChild.call(action.element, event, action.element.classList.contains('sc-move-up') ? 'up' : 'down');
        break;
      case 'sc-add':
        window.scBlockAddChild.call(action.element, event, action.element.classList.contains('sc-add-before') ? 'before' : 'after');
        break;
      case 'sc-add-child':
        window.scBlockAddChildFromParent.call(action.element, event);
        break;
      case 'sc-settings':
      default:
        window.scDisplaySettings.call(action.element, event);
    }
  }
});
