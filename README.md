# YunoHost Documentation

* [Web Site](https://yunohost.org)
* Based on [Simone](https://github.com/YunoHost/Simone)

Please report [issues on YunoHost bugtracker](https://github.com/YunoHost/issues/issues).

You can live test any changes by adding `/edit` to the URL on
[yunohost.org](https://yunohost.org). For example, if you make changes to
[apps.md](./apps.md), you can test them on [yunohost.org/#/apps/edit](https://yunohost.org/#/apps/edit).

## Regenerate the css

We use scss to manage the css. If you want to change it, you must rebuild it.

First install npm, then in the root folder of this repo, install sass: `npm install sass`

Finally you can rebuild the css with (You can replace `expanded` by `compressed` if you want):

```bash
./node_modules/sass/sass.js themes/yunohost-docs/scss:themes/yunohost-docs/css --style expanded
```

Source:
https://sass-lang.com/guide

