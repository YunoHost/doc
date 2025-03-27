# YunoHost Documentation

This repository contains the code for [the YunoHost documentation](https://doc.yunohost.org).

It is built using [Docusaurus 2](https://docusaurus.io), a modern static website generator.

Please report issues on [the YunoHost bugtracker](https://github.com/YunoHost/issues/issues).

> [!WARNING]  
> Package documentation should be done in the package repository itself, under the `/doc` folder.  
> You can learn about it here: <https://doc.yunohost.org/packaging_app_doc>

## Usage

### Installation

```bash
$ yarn
```

### Local Development

```bash
$ yarn start
```

This command starts a local development server and opens up a browser window. Most changes are reflected live without having to restart the server.

### Build

```bash
$ yarn build
```

This command generates static content into the `build` directory and can be served using any static contents hosting service.

### Deployment

Using SSH:

```bash
$ USE_SSH=true yarn deploy
```

Not using SSH:

```bash
$ GIT_USER=<Your GitHub username> yarn deploy
```

If you are using GitHub pages for hosting, this command is a convenient way to build the website and push to the `gh-pages` branch.

### Regenerate the CSS

FIXME: not relevant for docusaurus? But it can use scss

We use scss to manage the CSS. If you want to change it, you must rebuild it.

First install npm, then in the root folder of this repo, install sass: `npm install sass`

Finally you can rebuild the CSS with (You can replace `expanded` by `compressed` if you want):

```bash
./node_modules/sass/sass.js themes/yunohost-docs/scss:themes/yunohost-docs/css --style expanded
```

Source:
<https://sass-lang.com/guide>

## Contributing

You can refer to the page on [writing documentation](https://doc.yunohost.org/doc).
