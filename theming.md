# Customize the appearance of the user portal

## Using a theme

Since YunoHost 3.5, you can change the theme of the user portal - though for now it requires tweaking via the command line.

You can list the available themes with : 

```bash
$ ls /usr/share/ssowat/portal/assets/themes/
```

Then you can use `nano /etc/ssowat/conf.json.persistent` to enable the theme you choose like this :

```json
{
    "theme": "light",
    ...other lines...
}
```

<div class="alert alert-info" markdown="1">
You might need to force the refresh of your browser's cache for the theme to fully propagate. You can do so with Ctrl+Shift+R on Firefox.
</div>

## Adding someone else's theme

You may add themes created by other people by downloading and extracting the corresponding files in a new folder `the_theme_name` in `/usr/share/ssowat/portal/assets/themes/`.

<div class="alert alert-warning" markdown="1">
**Beware** that adding third-party themes from random strangers on the internet **is a security risk**. It is equivalent to running someone's else code on your machine, which can be used for malicious purpose such as stealing credentials !
</div>

## Creating your own theme

You can create your own theme by copying the existing theme of your choice. For instance starting from the light theme : 

```bash
cp -r /usr/share/ssowat/portal/assets/themes/{light,your_own_theme}
```

Then, edit the files the css and js files in `/usr/share/ssowat/portal/assets/themes/your_own_theme` according to what you want to do : 

- `custom_portal.css` can be used to add custom CSS rules to the user portal ;
- `custom_overlay.css` can be used to customize the small YunoHost button overlay, displayed on apps page which includes it ;
- `custom_portal.js` can be used to add custom JS code to be ran both on the user portal or when injecting the small YunoHost button / overlay.

You can also add your own images and assets which can then be used by the CSS and JS files.

### Example : customizing the logo

You may create your own theme simply to change the "branding" of the Yunohost user portal and replace the YunoHost logo with you own !

To do so, upload your logo to `/usr/share/ssowat/portal/assets/themes/your_own_theme/`, and use the following CSS rules : 

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
