import { MultiColumnFooter, } from '@docusaurus/theme-common';

const footer: MultiColumnFooter = {
  logo: {
    alt: 'Yunohost Logo',
    src: 'img/icons/ynh_logo_roundcorner.png',
  },
  style: 'dark',
  links: [
    {
      title: 'Legal',
      items: [
        {
          label: 'License',
          href: 'https://github.com/YunoHost/yunohost/blob/dev/LICENSE',
        },
        {
          label: 'CGUs',
          href: '/community/terms_of_services'
        },
        {
          label: 'Organization',
          href: 'https://github.com/YunoHost/project-organization',
        },
      ],
    },
    {
      title: 'Follow us',
      items: [
        {
          label: 'Blog',
          href: 'https://forum.yunohost.org/c/announcement/8/none',
        },
        {
          label: 'Mastodon',
          href: 'https://toot.aquilenet.fr/@yunohost'
        },
        {
          label: 'Peertube',
          href: 'https://videos.globenet.org/a/yunohost/videos?s=1',
        },
      ],
    },
    {
      title: 'Use',
      items: [
        {
          label: 'Documentation',
          href: '/',
        },
        {
          label: 'Apps catalog',
          href: 'https://apps.yunohost.org/'
        },
        {
          label: 'Forum',
          href: 'https://forum.yunohost.org/',
        },
        {
          label: 'Ask for help',
          href: '/community/help',
        },
        {
          label: 'Service status',
          href: 'https://status.yunohost.org/',
        },
        {
          label: 'Changelog',
          href: 'https://github.com/YunoHost/yunohost/blob/dev/debian/changelog',
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
          label: 'Issues',
          href: 'https://github.com/YunoHost/issues/issues',
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
  copyright: `This documentation is powered by <a href='https://docusaurus.io/'>Docusaurus</a>`,
}

export default footer;
