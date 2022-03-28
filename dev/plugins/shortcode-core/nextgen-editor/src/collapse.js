export default function collapse(input) {
  let output = input;

  output = output.replace(/<figure class="image">((((?!(<\/figure>)).)|\n)*)<\/figure>/gm, '$1');

  const domOutput = new DOMParser().parseFromString(output, 'text/html');

  [...domOutput.querySelectorAll('shortcode-block, shortcode-inline')].forEach((domShortcode) => {
    domShortcode.setAttribute('sc-rendered', false);
  });

  let domShortcode = domOutput.querySelector('shortcode-block[sc-rendered], shortcode-inline[sc-rendered]');

  while (domShortcode) {
    const name = domShortcode.getAttribute('name');
    const shortcode = window.nextgenEditor.shortcodes[name];

    domShortcode.removeAttribute('class');
    domShortcode.removeAttribute('sc-rendered');

    const domInnerContent = domShortcode.querySelector(`shortcode-${shortcode.type}-editable, shortcode-${shortcode.type}-readonly`);
    domShortcode.innerHTML = (domInnerContent && domInnerContent.innerHTML) || '';

    domShortcode = domOutput.querySelector('shortcode-block[sc-rendered], shortcode-inline[sc-rendered]');
  }

  output = domOutput.body.innerHTML;

  return output;
}
