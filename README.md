# YunoHost Documentation

This repository contains the code for [the YunoHost documentation](https://doc.yunohost.org).

It is built using [Docusaurus 3](https://docusaurus.io), a modern static website generator.

Please report issues on [the YunoHost bugtracker](https://github.com/YunoHost/issues/issues).

> [!WARNING]  
> Package/apps documentation should be done in the package/app repository itself, under the `/doc` folder.  
> You can learn about it here: <https://doc.yunohost.org/packaging/doc/>

The how-to of this repository is [available online](https://doc.yunohost.org/dev/doc/)
and also [in this repository](./docs/dev/05.doc/index.mdx).

# Run locally

Requirements: npm, yarn

```bash
# clone the doc repository, go in the doc repository folder, then:
npm install
npm run build
npm run serve
```