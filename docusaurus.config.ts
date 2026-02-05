import {themes as prismThemes} from 'prism-react-renderer';
import type {Config} from '@docusaurus/types';
import type * as Preset from '@docusaurus/preset-classic';

import Footer from './footer.ts';

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)


function getUrl() : string {
  const isMain = process.env.BUILD_FOR === 'main';
  return isMain ? 'https://doc.yunohost.org/' : 'https://doc.next.yunohost.org/';
}

// NB: this list is auto-updated during build using statistics from Weblate,
// keeping the lang with at least 5% translations
const enabled_locales = [  "en",  "fr",  "gl",  "de",  "it",  "es"];

const config: Config = {
  title: 'Yunohost',
  tagline: 'Why you no host?',
  favicon: 'img/favicon.png',

  url: getUrl(),
  baseUrl: process.env.BASE_URL || '/',

  onBrokenLinks: 'throw',
  onBrokenAnchors: 'throw',
  onDuplicateRoutes: 'throw',

  future: {
    v4: true,
    experimental_faster: true,
  },

  i18n: {
    // en-GB to make possible to have english in the dropdown which redirect to /en
    // (as it’s a workaround, we don’t want to have it en-GB in the dropdown - Docusaurus will warn about it)
    defaultLocale: 'en-GB',
    locales: enabled_locales.concat(['en-GB']),
    localeConfigs: {
      en: {
        path: 'en',
      },
    },
  },

  markdown: {
    hooks: {
      onBrokenMarkdownLinks: 'throw',
      onBrokenMarkdownImages: 'throw',
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
        // JS lib 'lunr-language' doesn't support gl or kab
        languages: enabled_locales.filter(function (l) { return (l != "gl" && l != "kab") }),
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
      // Map 'fr' to '/fr/', 'de' to '/de/' etc.
      "data-language-redirect": JSON.stringify(enabled_locales.reduce(function(acc, locale) {
        acc[locale] = '/' + locale + '/';
        return acc;
      }, {})),
    },
  ],

  themeConfig: {
    // Replace with your project's social card
    image: 'https://yunohost.org/assets/img/portal_simple_dark.jpg',
    colorMode: {
      respectPrefersColorScheme: true,
    },
    // announcementBar: {
    //   id: 'beta-docusaurus',
    //   content: '🛠️ This doc is very new, please report any issues! The old doc <a target="_blank" href="https://doc.old.yunohost.org">is still accessible</a>. 🛠️',
    //   backgroundColor: 'darkOrange',
    // },
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
        {type: 'docSidebar', sidebarId: 'devpackaging', label: 'Contribute'},
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
