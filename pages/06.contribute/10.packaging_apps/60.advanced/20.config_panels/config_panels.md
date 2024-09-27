---
title: Config Panels
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_config_panels'
---

From a practical point of view, one of the main purpose of config panel is to "expose" settings from the app's configuration files to YunoHost's admins which are therefore able to manipulate them from a nice web ui. This is especially relevant for apps which do not provide any sort of admin UI and expect admins to manually edit the configuration files.

Technically speaking, config panels are used both for apps packaging and also core features (domain configuration, global settings)

! Please: Keep in mind the YunoHost spirit, and try to build your panels in such a way as to expose only really useful, "high-level" parameters, and if there are many of them, to relegate those corresponding to rarer use cases to "Advanced" sub-sections. Keep it simple, focus on common needs, don't expect the admins to have 3 PhDs in computer science.

## Community examples

- [Check the basic example at the end of this doc](#basic-example)
- [Check the example_ynh app toml](https://github.com/YunoHost/example_ynh/blob/master/config_panel.toml.example) and the [basic `scripts/config` example](https://github.com/YunoHost/example_ynh/blob/master/scripts/config)
- [Check config panels of other apps](https://grep.app/search?q=version&filter[repo.pattern][0]=YunoHost-Apps&filter[lang][0]=TOML)
- [Check `scripts/config` of other apps](https://grep.app/search?q=ynh_app_config_apply&filter[repo.pattern][0]=YunoHost-Apps&filter[lang][0]=Shell)


## Overview

From an app packager perspective, config panels are defined in `config_panel.toml` at the root of the app repository. It is coupled to the `scripts/config` script, which may be used to define custom getters/setters/validations/actions. However, most use cases should be covered automagically by the core, thus it may not be necessary to define such a `config` script at all!

The `config_panel.toml` describes one or several panels, containing sections, each containing questions generally binded to a params in the app's actual configuration files.

Let's imagine that the upstream app is configured using this simple `config.yml` file stored in the app's install directory (typically `/var/www/$app/config.yml`):

```yaml
title: 'My dummy app'
theme: 'white'
max_rate: 10
max_age: 365
```

A simple configuration panel can be created with this syntax:
```toml
version = "1.0"
[main]

    [main.main]
        [main.main.title]
        ask.en = "Title"
        type = "string"
        bind = ":__INSTALL_DIR__/config.yml"

        [main.main.theme]
        ask.en = "Theme"
        type = "select"
        choices = ["white", "dark"]
        bind = ":__INSTALL_DIR__/config.yml"

    [main.limits]
        [main.limits.max_rate]
        ask.en = "Maximum display rate"
        type = "number"
        bind = ":__INSTALL_DIR__/config.yml"

        [main.limits.max_age]
        ask.en = "Duration of a dummy"
        type = "number"
        bind = ":__INSTALL_DIR__/config.yml"
```

Here, a `main` panel is created, containing the `main` and `limits` sections, containing questions corresponding to app options in `config.yml` file. Thanks to the `bind` property, all those questions are read/written to their values in the actual `config.yml` file.

## Supported questions types and properties

You can learn more about the full list of option types and their properties in [their dedicated page](/dev/forms).


## The "`bind`" statement

Without any `bind` statement attached to a config panel property, values are only read/written from/to the app's settings file (`/etc/yunohost/$app/settings.yml`). This is usually not very useful in practice.

Using `bind = ":/some/config/file"`, one declares that the actual truth used by the app lives in `/some/config/file`. The config panel will read/write the value from/to this file. YunoHost will automagically adapt to classic formats such as YAML, TOML, JSON, INI, PHP, `.env`-like and `.py`. (At least, assuming we're dealing with simple key<->value mappings)

A simple real-life example looks like:

```toml
[main.main.theme]
type = "string"
bind = ":__INSTALL_DIR__/config.yml"
```

In which case, YunoHost will look for something like a key/value, with the key being `theme` inside the app's `config.yml`.

If the question id in the config panel (here, `theme`) differs from the key in the actual conf file (let's say it's not `theme` but `css_theme`), then the syntax becomes:

```toml
[main.main.theme]
type = "string"
bind = "css_theme:__FINALPATH__/config.yml"
```

You may also encounter situations such as:
```json
{
    "foo": {
        "max": 123
    },
    "bar": {
        "max": 456
    }
}
```

In which case if we want to interface with foo's `max` value, let's write:

```toml
bind = "foo>max:__INSTALL_DIR__/conf.json"
```

### "Binding" to an entire file

Useful when using a question `file` or `text` for which you want to save the raw content directly as a file on the system.

For example to be able to manipulate an image:

```toml
[panel.section.logo]
type = "file"
bind = "__INSTALL_DIR__/assets/logo.png"
```

Or an entire text file:

```toml
[panel.section.config_content]
type = "text"
bind = "__INSTALL_DIR__/config.ini"
default = "This is the default content"
```


### Custom getters/setters/validators (a.k.a `bind=null`)

More complex use-case may appear, such as:
- you want to expose some "dynamic" information in the config panel, such as computed health status, computed disk usage, dynamic list of options, ...
- password handling, where the data may be written but can't be read
- the config file format is not supposed (e.g. xml, csv, ...)
- ...

You can create specific getter/setters functions inside the `config` script of the app to customize how the information is read/written. The basic structure of the script is:

```bash
#!/bin/bash
source /usr/share/yunohost/helpers

ynh_abort_if_errors

# Put your getter, setter, validator or action here

# Keep this last line
ynh_app_config_run $1
```

#### Custom getters

A question's getter is the function used to read the current value/state. Custom getters are defined using bash functions called `getter__QUESTION_SHORT_KEY()` which returns data through stdout.

Stdout can generated using one of those formats:
 1) either just the raw value,
 2) or a yaml, containing the value and other metadata and properties (for example the `style` of an `alert`, the list of available `choices` of a `select`, etc.)


[details summary="<i>Basic example with raw stdout: get the timezone on the system</i>" class="helper-card-subtitle text-muted"]

`config_panel.toml`

```toml
[main.main.timezone]
ask = "Timezone"
type = "string"
```

`scripts/config`

```bash
get__timezone() {
    echo "$(cat /etc/timezone)"
}
```

[/details]

[details summary="<i>Basic example with yaml-formated stdout : Display a list of available plugins</i>" class="helper-card-subtitle text-muted"]

`config_panel.toml`

```toml
[main.plugins.plugins]
ask = "Plugin to activate"
type = "tags"
choices = []
```

`scripts/config`

```bash
get__plugins() {
    echo "choices: [$(ls $install_dir/plugins/ | tr '\n' ',')]"
}
```

[/details]

[details summary="<i>Advanced example with yaml-formated stdout : Display the status of a VPN</i>" class="helper-card-subtitle text-muted"]

`config_panel.toml`

```toml
[main.cube.status]
ask = "Custom getter alert"
type = "alert"
style = "info"
bind = "null" # no behaviour on
```

`scripts/config`
```bash
get__status() {
    if [ -f "/sys/class/net/tun0/operstate" ] && [ "$(cat /sys/class/net/tun0/operstate)" == "up" ]
    then
        cat << EOF
style: success
ask:
  en: Your VPN is running :)
EOF
    else
        cat << EOF
style: danger
ask:
  en: Your VPN is down
EOF
    fi
}
```

[/details]


#### Custom setters

A question's setter is the function used to set new value/state. Custom setters are defined using bash functions called `setter__QUESTION_SHORT_KEY()`. In the context of the setter function, variables named with the various quetion's short keys are avaible ... for example the user-specified date for question `[main.main.theme]` is available as `$theme`.

When doing non-trivial operations to set a value, you may want to use `ynh_print_info` to inform the admin about what's going on.


[details summary="<i>Basic example : Set the system timezone</i>" class="helper-card-subtitle text-muted"]

`config_panel.toml`

```toml
[main.main.timezone]
ask = "Timezone"
type = "string"
```

`scripts/config`

```bash
set__timezone() {
    echo "$timezone" > /etc/timezone
    ynh_print_info "The timezone has been changed to $timezone"
}
```

[/details]



## User input validations

You will sometimes need to validate data provided by the user before saving it.

Simple validation can be achieved using a regex pattern:
```toml
pattern.regexp = '^.+@.+$'
pattern.error = 'An email is required for this field'
```

You can also restrict the accepted values using a choices list.
```toml
choices.foo = "Foo (some explanation)"
choices.bar = "Bar (moar explanation)"
choices.loremipsum = "Lorem Ipsum Dolor Sit Amet"
```

Some other type specific argument exist like
| type | validation arguments |
| -----  | --------------------------- |
| `number`, `range` | `min`, `max`, `step` |
| `file` | `accept` |
| `boolean` | `yes` `no` |

See also : custom validators

### Custom validators

In addition to the "simple" validation mechanism (see the 'option' doc), custom validators can be defined in a similar fashion as custom getters/setters:


```bash
validate__login_user() {
    if [[ "${#login_user}" -lt 4 ]]
    then
        echo 'User login is too short, should be at least 4 chars'
    fi
}
```






## `visible` & `enabled` expression evaluation

Sometimes we may want to conditionaly display a message or prompt for a value, for this we have the `visible` prop.
And we may want to allow a user to trigger an action only if some condition are met, for this we have the `enabled` prop.

Expressions are evaluated against a context containing previous values of the current section's options. This quite limited current design exists because on the web-admin or on the CLI we cannot guarantee that a value will be present in the form if the user queried only a single panel/section/option.
In the case of an action, the user will be shown or asked for each of the options of the section in which the button is present.

The expression has to be written in javascript (this has been designed for the web-admin first and is converted to python on the fly on the cli).

Available operators are: `==`, `!=`, `>`, `>=`, `<`, `<=`, `!`, `&&`, `||`, `+`, `-`, `*`, `/`, `%` and `match()`.

#### Examples

```toml
# simple "my_option_id" is thruthy/falsy
visible = "my_option_id"
visible = "!my_option_id"
# misc
visible = "my_value >= 10"
visible = "-(my_value + 1) < 0"
visible = "!!my_value || my_other_value"
```

For a more complete set of examples, [check the tests at the end of the file](https://github.com/YunoHost/yunohost/blob/dev/src/tests/test_questions.py).

#### match()

For more complex evaluation we can use regex matching.

```toml
[my_string]
default = "Lorem ipsum dolor et si qua met!"

[my_boolean]
type = "boolean"
visible = "my_string && match(my_string, '^Lorem [ia]psumE?')"
```

Match the content of a file.

```toml
[my_file]
type = "file"
accept = ".txt"
bind = "/etc/random/lorem.txt"

[my_boolean]
type = "boolean"
visible = "my_file && match(my_file, '^Lorem [ia]psumE?')"
```

with a file with content like:
```txt
Lorem ipsum dolor et si qua met!
```


## Actions

"Actions" correspond to config panel buttons triggering specific pieces of code. For example, one could implement an action to trigger a scan of Nextcloud files, or install a plugin inside an app that does not already provide an interface to do so. In core config panels, buttons are for example used to trigger certificate renewal.

The most basic example looks like this, using `type = 'button'`:

```toml
[panel.section.my_action]
type = "button"
ask = "Run action"
# (NB: no need to set `bind` to "null")
```

And then defining the controller, prefixed by `run__` inside the app's `config` script:
```bash
run__my_action() {
    ynh_print_info "Running 'my_action'..."
}
```

You may build more complex actions, where the actions uses other form inputs:

```toml
[panel.my_action_section]
name = "Action section"
    [panel.my_action_section.my_repo]
    type = "url"
    bind = "null" # this value won't be saved as a setting, it's ephemeral and only relevant for the action
    ask = "gimme a repo link"

    [panel.my_action_section.my_repo_name]
    type = "string"
    bind = "null" # this value won't be saved as a setting, it's ephemeral and only relevant for the action
    ask = "gimme a custom folder name"

    [panel.my_action_section.my_action]
    type = "button"
    ask = "Clone the repo"
    # the button is clickable only once the previous values are provided
    enabled = "my_repo && my_repo_name"
```

```bash
run__my_action() {
    ynh_print_info "Cloning '$my_repo'..."
    cd /tmp
    git clone "$my_repo" "$my_repo_name"
}
```

## Overwrite config panel mechanism

All main configuration helpers are overwritable, example:

```bash
ynh_app_config_apply() {

    # Stop vpn client
    touch /tmp/.ynh-vpnclient-stopped
    systemctl stop ynh-vpnclient

    _ynh_app_config_apply

    # Start vpn client
    systemctl start ynh-vpnclient
    rm -f /tmp/.ynh-vpnclient-stopped

}
```

List of main configuration helpers:

- `ynh_app_config_get`
- `ynh_app_config_show`
- `ynh_app_config_validate`
- `ynh_app_config_apply`
- `ynh_app_config_run`

More info on this can be found by reading [vpnclient_ynh config script](https://github.com/YunoHost-Apps/vpnclient_ynh/blob/master/scripts/config)



## Important technical notes

### Options short keys have to be unique

For performance reasons, questions short keys have to be unique in all the `config_panel.toml` file, not just inside its panel or its section. Hence it's not possible to have:
```toml
[manual.vpn.server_ip]
[advanced.dns.server_ip]
```
In which two questions have "real variable name" `is server_ip` and therefore conflict with each other.

! Some short keys are forbidden cause it can interfer with config scripts (`old`, `file_hash`, `types`, `binds`, `formats`, `changed`) and you probably should avoid to use common settings name to avoid to bind your question to this settings (e.g. `id`, `install_time`, `mysql_pwd`, `path`, `domain`, `port`, `db_name`, `current_revision`, `admin`)

### `bind` versus app settings

! IMPORTANT: with the exception of `bind = "null"` options, options ids should almost **always** correspond to an app setting initialized/reused during install/upgrade.
Not doing so may result in inconsistencies between the config panel mechanism and the use of ynh_add_config. See also discussions in https://github.com/YunoHost/issues/issues/1973
