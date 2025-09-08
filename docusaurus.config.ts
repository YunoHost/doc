import {themes as prismThemes} from 'prism-react-renderer';
import type {Config} from '@docusaurus/types';
import type * as Preset from '@docusaurus/preset-classic';

import Footer from './footer.ts';

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)


function getUrl() : string {
  const isMain = process.env.BUILD_FOR === 'main';
  return isMain ? 'https://doc.yunohost.org/' : 'https://doc.next.yunohost.org/';
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
    v4: true,
    experimental_faster: true,
  },

  i18n: {
    // en-GB to make possible to have english in the dropdown which redirect to /en (as it’s a workaround, we don’t want to have it en-GB in the dropdown - Docusaurus will warn about it)
    defaultLocale: 'en-GB',
    locales: ['ar', 'ca', 'de', 'en', 'es', 'fr', 'it', 'oc', 'ru'],
    localeConfigs: {
      ar: {
        direction: 'rtl',
      },
      en: {
        path: 'en',
      }
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
          editUrl: 'https://github.com/YunoHost/doc/tree/main',
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

  scripts: [
    {
      src: '/js/language-detect.js',
      async: true,
      "data-language-redirect": JSON.stringify({
        ar: '/ar/',
        ca: '/ca/',
        de: '/de/',
        en: '/en/',
        es: '/es/',
        fr: '/fr/',
        it: '/it/',
        oc: '/oc/',
        ru: '/ru/',
      }),
    },
  ],

  themeConfig: {
    // Replace with your project's social card
    image: 'https://yunohost.org/assets/img/portal_simple_dark.jpg',
    colorMode: {
      respectPrefersColorScheme: true,
    },
    announcementBar: {
      id: 'beta-docusaurus',
      content: '🛠️ This doc is very new, please report any issues! The old doc <a target="_blank" href="https://doc.old.yunohost.org">is still accessible</a>. 🛠️',
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
        {label: 'Apps catalog', href: 'https://apps.yunohost.org/'},

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
          queryString: '?persistLocale=true',
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
