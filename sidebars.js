// @ts-check

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)

/**
 * Creating a sidebar enables you to:
 - create an ordered group of docs
 - render a sidebar for each doc of that group
 - provide next/previous navigation

 The sidebars can be generated from the filesystem, or explicitly defined here.

 Create as many sidebars as you want.

 @type {import('@docusaurus/plugin-content-docs').SidebarsConfig}
 */

const sidebars = {
  // By default, Docusaurus generates a sidebar from the docs folder structure
  docsSidebar: [
    {
      type: 'autogenerated',
      dirName: '.'
    },

    {
      type: 'link',
      label: 'Applications',
      href: 'https://apps.yunohost.org',
    },

    {
      type: 'link',
      label: 'Forum',
      href: 'https://forum.yunohost.org',
    },
  ],
};

export default sidebars;
