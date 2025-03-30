// @ts-check
// `@type` JSDoc annotations allow editor autocompletion and type checking
// (when paired with `@ts-check`).
// There are various equivalent ways to declare your Docusaurus config.
// See: https://docusaurus.io/docs/api/docusaurus-config

import {themes as prismThemes} from 'prism-react-renderer';

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: 'Yunohost',
  tagline: 'Why you no host?',
  favicon: 'img/favicon.png',

  // Set the production url of your site here
  url: process.env.NEXT ? 'https://nextdoc.yunohost.org/' : 'https://doc.yunohost.org/',
  // Set the /<baseUrl>/ pathname under which your site is served
  // For GitHub pages deployment, it is often '/<projectName>/'
  baseUrl: '/',

  // GitHub pages deployment config.
  // If you aren't using GitHub pages, you don't need these.
  organizationName: 'YunoHost', // Usually your GitHub org/user name.
  projectName: 'doc', // Usually your repo name.

  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'throw',
  onBrokenAnchors: 'throw',
  onDuplicateRoutes: 'throw',

  future: {
    experimental_faster: true,
  },

  // Even if you don't use internationalization, you can use this field to set
  // useful metadata like html lang. For example, if your site is Chinese, you
  // may want to replace "en" with "zh-Hans".
  i18n: {
    defaultLocale: 'en',
    locales: ['ar', 'ca', 'de', 'en', 'es', 'fr', 'it', 'oc', 'ru'],
    localeConfigs: {
      ar: {
        direction: 'rtl',
      },
    },
  },

  presets: [
    [
      'classic',
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          sidebarPath: './sidebars.js',
          // To enable the editing of the *localized* files
          editLocalizedFiles : true,
          routeBasePath: '/',
          // TODO: Update this when merging the PR
          editUrl: 'https://github.com/YunoHost/doc/tree/docusaurus',
        },
        // blog: {
        //   showReadingTime: true,
        //   feedOptions: {
        //     type: ['rss', 'atom'],
        //     xslt: true,
        //   },
        //   // Please change this to your repo.
        //   // Remove this to remove the "edit this page" links.
        //   editUrl:
        //     'https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/',
        //   // Useful options to enforce blogging best practices
        //   onInlineTags: 'warn',
        //   onInlineAuthors: 'warn',
        //   onUntruncatedBlogPosts: 'warn',
        // },
        theme: {
          customCss: './src/css/custom.css',
        },
      }),
    ],
  ],

  plugins: [
    [
      '@docusaurus/plugin-client-redirects',
      require('./redirects.js'),
    ],
    require.resolve('docusaurus-lunr-search'),
  ],

  clientModules: [
    require.resolve("./src/YunoHostImagesListScript.js")
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      // Replace with your project's social card
      image: 'img/docusaurus-social-card.jpg',
      navbar: {
        title: 'Docs',
        hideOnScroll: true,
        logo: {
          alt: 'Yunohost Logo',
          src: 'img/icons/logo-ynh_horizontal.png',
        },
        items: [
          // {to: '/docs', label: 'Docs', position: 'left'},
          // {to: '/blog', label: 'Blog', position: 'left'},
          {
            type: "search",
            position: "right"
          },
          {
            href: 'https://github.com/yunohost/doc',
            label: 'GitHub',
            position: 'right',
          },
          {
            type: 'docsVersionDropdown',
            position: 'right',

          },
          {
            type: 'localeDropdown',
            position: 'right',
          },
        ],
      },
      footer: {
        style: 'dark',
        links: [
          {
            title: 'Community',
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
      },
      prism: {
        theme: prismThemes.github,
        darkTheme: prismThemes.dracula,
        additionalLanguages: [
          'bash',
          'c',
          'css',
          'markup-templating',
          'django',
          'lua',
          'nginx',
          'php',
          'ruby',
          'shell-session',
          'toml',
          'yaml'
        ],
      },
      colorMode: {
        respectPrefersColorScheme: true,
      },
      docs: {
        sidebar: {
          autoCollapseCategories: true,
        }
      }
    }),
};

export default config;
