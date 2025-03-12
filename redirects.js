// @ts-check

// This runs in Node.js - Don't use client-side code here (browser APIs, JSX...)

/** @type {import('@docusaurus/plugin-client-redirects').Options} */

const redirects = {
    redirects: [
        {
            from: '/introductiontoyunohost',
            to: '/overview/what_is_yunohost',
        }
    ],
};

export default redirects;
