import { MultiColumnFooter, } from '@docusaurus/theme-common';

const footer: MultiColumnFooter = {
  style: 'dark',
  links: [
    {
      title: 'Commauieunity',
      items: [
        {
          label: 'Website',
          href: 'https://yunohost.org/',
        },
        {
          label: 'Forum',
          href: 'https://forum.yunohost.org/',
        },
      ],
    },
    {
      title: 'Contribute',
      items: [
        {
          label: 'Donate',
          href: 'https://donate.yunohost.org/',
        },
        {
          label: 'GitHub (core)',
          href: 'https://github.com/YunoHost',
        },
        {
          label: 'GitHub (apps)',
          href: 'https://github.com/YunoHost-Apps',
        },
        {
          label: 'Translate',
          href: 'https://translate.yunohost.org/',
        },
      ],
    },
  ],
  copyright: `Build with Docusaurus for YunoHost`,
}

export default footer;
