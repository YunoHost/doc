---
title: Configuration panel
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_config_panel'
---

<div class="alert alert-warning">For now, all those features are <b>EXPERIMENTAL</b>
and aren't ready for production and are probably going to change again, if you
still decide to use them don't expect them to be stable and follow to core
development of YunoHost otherwise <b>they might randomly breaks on your apps</b>
</div>

Configuration panel, or "config_panel", is a way for an application to ship a
custom configuration panel available in the YunoHost's admin interface for the
application. This is generally used to replace the "you need to manually edit
this configuration file (or files) in whatever format/language for this
application in cli and do all those complex commands" to "just use to
configuration panel to change the options of the application".

Yes, this is one place to add this so asked "how can I make my application from
public to private and vice versa" user request.

config_panel is probably the most complex YunoHost apps feature as you'll need
to write both a description of the panel in toml and a script that will need to
both work in a "display mode" and "handle inputs" mode. But this is still very
doable and very worth it if you need it.

Here how it looks like in the admin interface:

![actions admin screenshot](image://config_panel_example.png)

## Usage

### Admin interface

The configuration panel for an application can be accessed with this URL:

    https://my_domain.tld/yunohost/admin/#/apps/$app_id/config-panel

<div class="alert alert-warning">For now since those features are still
experimental you won't find any direct links to the app actions on the app
page</div>

### CLI

For now the CLI API for the config panel is not very good at all, you can still
use it but it's really impracticable.

* `yunohost app config show-panel $app_id` will show the panel. **But for now
it's very broken and will ask question for unfilled value of the panel**.

* `yunohost app config apply` will call the script with apply and... no values
  since you aren't passing them, except if you are ready to play with the `-a`
  flag and pass every global value in the HTTP POST format (protip: you don't)

In conclusion: don't use the CLI for now, we need to design something better.

## How to add a config_ panel to your application

### config_panel.toml

First, you need to write a `config_panel.toml` (or `config_panel.json` if you
REALLY want to but we really don't recommend it as it is very error prone and
frustrating to write by hand) that will be located at the root of you
application, next to the manifest.json/toml. It looks like this:

<div class="alert alert-info">
The options are written in **[YunoHost Arguments
Format](/packaging_apps_arguments_format)** like in `manifest.toml/json`
</div>

```toml
version = "0.1"  # version number, not used yet but important
name = "name that will be displayed on the admin"

[section_id]
name = "name of the section that will be displayed"

    [section_id.sub_section_id]
    name = "sub section"

        # those arguments are in yunohost argument format like manifest.json
        [section_id.sub_section_id.option_id]
        ask.en = "the text displayed for the option"
        type = "argument_option"
        default = true
        help = "A public Leed will be accessible for third party apps.<br>By turning on 'anonymous readers' in Leed configuration, you can made your feeds public."

        [section_id.sub_section_id.another_option_id]
        ...

    [section_id.another_sub_section_id]
    name = "stuff"

[another_section_id]
name = "stuff"

...
```


And a real world example with the rendered admin:

![config_panel_toml_example](image://config_panel_toml_example.png)

As a text format:

```toml
version = "0.1"
name = "Leed configuration panel"

[main]
name = "Leed configuration"

    [main.is_public]
    name = "Public access"

        # those arguments are in yunohost argument format
        [main.is_public.is_public]
        ask.en = "Is it a public website ?"
        type = "boolean"
        default = true
        help = "A public Leed will be accessible for third party apps.<br>By turning on 'anonymous readers' in Leed configuration, you can made your feeds public."


    [main.overwrite_files]
    name = "Overwriting config files"

        [main.overwrite_files.overwrite_nginx]
        ask.en = "Overwrite the nginx config file ?"
        type = "boolean"
        default = true
        help = "If the file is overwritten, a backup will be created."

        [main.overwrite_files.overwrite_phpfpm]
        ask.en = "Overwrite the php-fpm config file ?"
        type = "boolean"
        default = true
        help = "If the file is overwritten, a backup will be created."

...
```

### the scripts/config script

To make your configuration panel functional you need write a "config" script
that will be located in the "script" folder (like the "install" script). This
script will be called in two different occasions:

* when the configuration panel is displayed and yunohost needs to fill the values
* when the configuration is modified by the user

Every option of the configuration panel will be sent to the script
following this naming convention:

```bash
YNH_{section_id}_{sub_section_id}_{option_id} (everything in upper case)
```

For example, this option value:

```toml
[main]
name = "Leed configuration"

    [main.is_public]
    name = "Public access"

        # those arguments are in yunohost argument format
        [main.is_public.is_public]
        ...
```

Will be available under this name in the config script:

```bash
YNH_CONFIG_MAIN_IS_PUBLIC_IS_PUBLIC
```

Also, the same "scripts/config" script is called in both situation. To differentiate
those situation the first argument passed to the config script is either "show"
or "apply".

A common pattern to handle that is to write your script following this pattern:

```bash
show_config() {
    # do stuff
}

apply_config() {
    # do stuff
}

case $1 in
    show) show_config;;
    apply) apply_config;;
esac
```

#### The "show" part

The show part is when the user ask to see the current state of the
configuration panel (like opening to configuration panel page on the admin
interface). The role of the scripts/config script here is to gather all the
relevant information, by for example parsing a configuration file or querying a
database, and communicate it to YunoHost. To do so, you need to use the helper
`ynh_return` like so:

```bash
ynh_return "YNH_CONFIG_SOME_VARIABLE_NAME=some_value"
```

For example, for this config_panel:

```toml
[main]
name = "Leed configuration"

    [main.is_public]
    name = "Public access"

        # those arguments are in yunohost argument format
        [main.is_public.is_public]
        ...
```

You would do:

```bash
ynh_return "YNH_CONFIG_MAIN_IS_PUBLIC_IS_PUBLIC=1"
```

If you don't provide any value for a configuration **the default value will be used**.

Expanding our previous example you would have this scripts/config script:

```bash
show_config() {
    ynh_return "YNH_CONFIG_MAIN_IS_PUBLIC_IS_PUBLIC=1"
}

apply_config() {
    # do stuff
}

case $1 in
    show) show_config;;
    apply) apply_config;;
esac
```

#### The "apply" part

The "apply" part is called when the user click on "submit" on the configuration
page on the admin interface. This part is simpler to write:

- the scripts/config will be called with "apply"
- all the values in the config panel (modified or not) are available as global
  variables in the script following the format `YNH_{section_id}_{sub_section_id}_{option_id}`
  (exactly the same than for show)
- the script is responsible for doing whatever it wants with those information
- once the script has succeeded, the admin interface displays the config panel
  again and triggers the same script in "show" mode

Expanding the previous script that could look like that:

```bash
show_config() {
    ynh_return "YNH_CONFIG_MAIN_IS_PUBLIC_IS_PUBLIC=1"
}

apply_config() {
    value=$YNH_CONFIG_MAIN_IS_PUBLIC_IS_PUBLIC
    # do some stuff with value
}

case $1 in
    show) show_config;;
    apply) apply_config;;
esac
```

Or if you want a full useless simple script that store the value in a file,
this can look like this:

```bash
dummy_config_file="dummy_config_file.ini"

show_config() {
    if [ -e $dummy_config_file ]
    then
        ynh_return "YNH_CONFIG_MAIN_IS_PUBLIC_IS_PUBLIC=$(cat $dummy_config_file)"
    fi

    # the default value will be used
}

apply_config() {
    echo $YNH_CONFIG_MAIN_IS_PUBLIC_IS_PUBLIC > $dummy_config_file
}

case $1 in
    show) show_config;;
    apply) apply_config;;
esac
```
