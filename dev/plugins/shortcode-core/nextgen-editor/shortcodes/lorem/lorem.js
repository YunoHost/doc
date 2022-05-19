const sentence = 'Lorem ipsum dolor sit amet consectetur adipiscing elit, molestie tortor cubilia eu facilisi ex varius, convallis pretium dapibus fusce porta ligula.';
const words = [].concat(...Array(1000).fill(sentence.toLowerCase().replace(/[.|,]/g, '').split(' ')));
const paragraph = Array(2).fill(sentence).join(' ');

window.nextgenEditor.addShortcode('lorem', {
  type: 'block',
  plugin: 'shortcode-core',
  title: 'Lorem',
  wrapOnInsert: false,
  button: {
    group: 'shortcode-core',
    label: 'Lorem',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7.54 9a.48.48 0 00.172-.031A14.327 14.327 0 0112 8a14.327 14.327 0 014.288.969.507.507 0 00.172.031H19a.454.454 0 00.394-.678 8.553 8.553 0 00-4.206-3.685.5.5 0 00-.688.463v.4a.5.5 0 01-1 0v-4a1.5 1.5 0 00-3 0v4a.5.5 0 01-1 0v-.4a.5.5 0 00-.688-.463 8.555 8.555 0 00-4.206 3.684A.454.454 0 005 9zM20.5 12a1.5 1.5 0 00-1.5-1.5h-2.813a.493.493 0 01-.178-.033A14 14 0 0012 9.5a14 14 0 00-4.009.967.493.493 0 01-.178.033H5A1.5 1.5 0 003.5 12v6.639a3.5 3.5 0 001.2 2.633l2.87 2.512A.866.866 0 009 23.136V17a1.5 1.5 0 00-1.5-1.5H6.25a.75.75 0 010-1.5H9a1.5 1.5 0 011.5 1.5v2.793a.993.993 0 00.293.707l.5.5a1 1 0 001.414 0l.5-.5a.993.993 0 00.293-.707V15.5A1.5 1.5 0 0115 14h2.75a.75.75 0 010 1.5H16.5A1.5 1.5 0 0015 17v6.137a.864.864 0 001.432.649l2.873-2.514a3.5 3.5 0 001.2-2.633z"/></svg>',
  },
  attributes: {
    p: {
      type: Number,
      title: 'Paragraphs',
      bbcode: true,
      widget: {
        type: 'input-number',
        min: 0,
        max: 10,
      },
      default: 2,
    },
    tag: {
      type: String,
      title: 'Tag',
      widget: 'input-text',
      default: 'p',
    },
    s: {
      type: Number,
      title: 'Sentences',
      widget: 'input-number',
      default: 0,
    },
    w: {
      type: Number,
      title: 'Words',
      widget: 'input-number',
      default: 0,
    },
  },
  titlebar({ attributes }) {
    if (attributes.w) {
      return `words: <strong>${attributes.w}</strong>`;
    }

    if (attributes.s) {
      return `sentences: <strong>${attributes.s}</strong>`;
    }

    if (attributes.p) {
      return `paragraphs: <strong>${attributes.p}</strong>`;
    }

    return '';
  },
  content({ attributes }) {
    let output = '';

    output += '<div style="margin:16px 16px">';

    if (attributes.w) {
      output += words.slice(0, attributes.w).join(' ');
    } else if (attributes.s) {
      output += Array(attributes.s).fill(sentence).join(' ');
    } else if (attributes.p) {
      [...Array(attributes.p)].forEach(() => {
        output += `<p>${paragraph}</p>`;
      });
    }

    output += '</div>';

    return output;
  },
});
