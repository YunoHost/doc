# YunoHost Documentation

* [Web Site](https://yunohost.org)
* Based on [Grav](https://getgrav.org/)

Please report [issues on YunoHost bugtracker](https://github.com/YunoHost/issues/issues).

# Contributing

This repo use a **submodule** to provide the theme. So when you clone use: 

```shell
git clone --recursive https://github.com/YunoHost/doc.git
```


You can refer to the page on [writing documentation](https://yunohost.org/write_documentation).

If you know docker, you can run:
```
docker-compose up
```

## Regenerate the css

We use scss to manage the css. If you want to change it, you must rebuild it.

First install npm, then in the root folder of this repo, install sass: `npm install sass`

Finally you can rebuild the css with (You can replace `expanded` by `compressed` if you want):

```bash
./node_modules/sass/sass.js themes/yunohost-docs/scss:themes/yunohost-docs/css --style expanded
```

Source:
https://sass-lang.com/guide

