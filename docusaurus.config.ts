import {themes as prismThemes} from 'prism-react-renderer';
import type {Config} from '@docusaurus/types';
import type * as Preset from '@docusaurus/preset-classic';

import Footer from './footer.ts';

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)


function getUrl() : string {
  const isMain = process.env.BUILD_FOR === 'main';
  return isMain ? 'https://doc.yunohost.org/' : 'https://nextdoc.yunohost.org/';
}

const config: Config = {
  title: 'Yunohost',
  tagline: 'Why you no host?',
  favicon: 'img/favicon.png',

  url: getUrl(),
  baseUrl: '/',

  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'throw',
  onBrokenAnchors: 'throw',
  onDuplicateRoutes: 'throw',

  future: {
    experimental_faster: true,
  },

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
      {
        docs: {
          sidebarPath: './sidebars.ts',
          editLocalizedFiles: true,
          routeBasePath: '/',
          editUrl: 'https://github.com/YunoHost/doc/tree/docusaurus',
        },
        theme: {
          customCss: './src/css/custom.css',
        },
      } satisfies Preset.Options,
    ],
  ],

  plugins: [
    [
      '@docusaurus/plugin-client-redirects',
      require('./redirects.ts'),
    ],
    [
      require.resolve('docusaurus-lunr-search'),
      {
        languages: ['ar', 'de', 'en', 'es', 'fr', 'it', 'ru'],
      }
    ],
  ],

  clientModules: [
    require.resolve("./src/YunoHostImagesListScript.js")
  ],

  themeConfig: {
    // Replace with your project's social card
    image: 'https://yunohost.org/assets/img/portal_simple_dark.jpg',
    colorMode: {
      respectPrefersColorScheme: true,
    },
    announcementBar: {
      id: 'beta-docusaurus',
      content: '🛠️ This doc is in beta, please report any issues!',
      backgroundColor: 'darkOrange',
    },
    navbar: {
      title: 'Docs',
      hideOnScroll: true,
      logo: {
        alt: 'Yunohost Logo',
        src: 'img/icons/logo-ynh_horizontal.png',
      },
      items: [
        // {type: 'docSidebar', sidebarId: 'user', label: 'User guide'},
        {type: 'docSidebar', sidebarId: 'admin', label: 'Administration'},
        {type: 'docSidebar', sidebarId: 'devpackaging', label: 'Development and packaging'},
        {type: 'docSidebar', sidebarId: 'community', label: 'Community'},

        {
          type: "search",
          position: "right",
        },
        // {
        //   type: 'docsVersionDropdown',
        //   position: 'right',
        // },
        {
          type: 'localeDropdown',
          position: 'right',
        },
      ],
    },
    footer: Footer,
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
        'yaml',
      ],
    },
  } satisfies Preset.ThemeConfig,
};

export default config;
