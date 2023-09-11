---
title: Customize the appearance of the user portal
template: docs
taxonomy:
    category: docs
routes:
  default: '/theming'
---

## Globally disable the overlay

You can disable the overlay by changing the dedicated settings:

```
yunohost settings set ssowat.panel_overlay.enabled -v 0
```

## Using a theme

You can change the theme of the user portal in the admin panel, under Tools > YunoHost settings > Other > User portal.

You can list the available themes with: 

```bash
$ ls /usr/share/ssowat/portal/assets/themes/
```

Then you can use `nano /etc/ssowat/conf.json.persistent` to enable the theme you choose like this:

```json
{
    "theme": "light",
    ...other lines...
}
```

!!! You might need to force the refresh of your browser's cache for the theme to fully propagate. You can do so with Ctrl+Shift+R on Firefox.

## Adding someone else's theme

You may add themes created by other people by downloading and extracting the corresponding files in a new folder `the_theme_name` in `/usr/share/ssowat/portal/assets/themes/`.

! **Beware** that adding third-party themes from random strangers on the internet **is a security risk**. It is equivalent to running someone's else code on your machine, which can be used for malicious purpose such as stealing credentials!

There are a handful of themes listed [on Github](https://github.com/yunohost-themes).

## Creating your own theme

You can create your own theme by copying the existing theme of your choice. For instance starting from the light theme: 

```bash
cp -r /usr/share/ssowat/portal/assets/themes/{light,your_own_theme}
```

Then, edit the files the CSS and JS files in `/usr/share/ssowat/portal/assets/themes/your_own_theme` according to what you want to do: 

- `custom_portal.css` can be used to add custom CSS rules to the user portal;
- `custom_overlay.css` can be used to customize the small YunoHost button overlay, displayed on apps page which includes it;
- `custom_portal.js` can be used to add custom JS code to be ran both on the user portal or when injecting the small YunoHost button / overlay.

You can also add your own images and assets which can then be used by the CSS and JS files.

!!! Share your custom theme with the community! https://github.com/yunohost-themes

### Example : customizing the logo

You may create your own theme simply to change the "branding" of the YunoHost user portal and replace the YunoHost logo with you own!

To do so, upload your logo to `/usr/share/ssowat/portal/assets/themes/your_own_theme/`, and use the following CSS rules: 

```css
/* Inside custom_portal.css */
#ynh-logo {
  background-image: url("./your_logo.png");
}

/* Inside custom_overlay.css */
#ynh-overlay-switch {
  background-image: url("./your_logo.png");
}
```
