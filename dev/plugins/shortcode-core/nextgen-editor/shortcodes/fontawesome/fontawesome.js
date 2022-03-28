window.nextgenEditor.addShortcode('fa', {
  type: 'inline',
  plugin: 'shortcode-core',
  title: 'Font Awesome',
  wrapOnInsert: false,
  button: {
    group: 'shortcode-core',
    label: 'Font Awesome',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.093 18.527a1.5 1.5 0 01-.65.382.25.25 0 00-.181.212l-.227 1.941a1.03 1.03 0 001.752.849l2.671-2.671a7.688 7.688 0 001.622-2.446 12.4 12.4 0 00.366-3.007.25.25 0 00-.427-.186zM5.484 12.92l4.952-4.964a.251.251 0 00-.184-.427 12.988 12.988 0 00-3.087.349A7.687 7.687 0 004.75 9.531l-2.662 2.662a1.031 1.031 0 00.727 1.759c.035 0 1.572-.185 2.091-.248a.251.251 0 00.209-.174 1.5 1.5 0 01.369-.61zM6.038 16.536c-.845-.847-2.125-.7-3.183.353-.749.75-1.519 3.166-2.033 5.062a1 1 0 001.23 1.226c1.889-.52 4.3-1.3 5.046-2.045 1.057-1.057 1.2-2.337.354-3.182zM22.62.8c-1.248.252-3.756.838-4.534 1.616-.648.643-9.961 9.984-11.364 11.384a.25.25 0 000 .353l3.134 3.137a.25.25 0 00.353 0L21.587 5.913c.779-.779 1.365-3.287 1.616-4.534A.495.495 0 0022.62.8z"/></svg>',
  },
  attributes: {
    icon: {
      type: String,
      title: 'Icon',
      bbcode: true,
      widget: 'input-text',
      default: 'grav',
    },
    extras: {
      type: String,
      title: 'Extras',
      widget: 'input-text',
      default: '',
    },
  },
  content({ attributes }) {
    let faclass = 'fa';

    let icon = attributes.icon && !attributes.icon.startsWith('fa-')
      ? `fa-${attributes.icon}`
      : attributes.icon;

    if (attributes.extras) {
      attributes.extras.split(',').forEach((extra) => {
        if (extra) {
          if (['fab', 'fal', 'fas', 'far', 'fad'].includes(extra)) {
            faclass = extra;
            return;
          }

          icon += !extra.startsWith('fa-')
            ? ` fa-${extra}`
            : ` ${extra}`;
        }
      });
    }

    return `<span class="${faclass} ${icon}" style="margin:4px"></span>`;
  },
});
