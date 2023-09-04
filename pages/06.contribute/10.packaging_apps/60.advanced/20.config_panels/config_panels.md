---
title: Configuration panel for apps
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_config_panels'
---

Configuration panels allow to let admins manage parameters or runs actions for which the upstream's app doesn't provide any appropriate UI itself. It's a good way to reduce manual change on config files and avoid conflicts on it.

Those panels can also be used to quickly create interfaces that extend the capabilities of YunoHost (e.g. VPN Client, Hotspost, Borg, etc.).

! Please: Keep in mind the YunoHost spirit, and try to build your panels in such a way as to expose only really useful, "high-level" parameters, and if there are many of them, to relegate those corresponding to rarer use cases to "Advanced" sub-sections. Keep it simple, focus on common needs, don't expect the admins to have 3 PhDs in computer science.

## `config_panel.toml`'s principle and general format

To create configuration panels for apps, you should at least create a `config_panel.toml` at the root of the package. For more complex cases, this TOML file can be paired with a `config` script inside the scripts directory of your package, which will handle specific controller logic.

The `config_panel.toml` describes one or several panels, containing sections, each containing questions generally binded to a params in the app's actual configuration files.

Let's imagine that the upstream app is configured using this simple `config.yml` file stored in the app's install directory (typically `/var/www/$app/config.yml`):
```yaml
title: 'My dummy app'
theme: 'white'
max_rate: 10
max_age: 365
```

We could for example create a simple configuration panel for it like this one, by following the syntax `[PANEL.SECTION.QUESTION]`:
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

Here we have created one `main` panel, containing the `main` and `limits` sections, containing questions according to params name of our `config.yml` file. Thanks to the `bind` properties, all those questions are bind to their values in the `config.yml` file.

### Questions short keys have to be unique

For performance reasons, questions short keys have to be unique in all the `config_panel.toml` file, not just inside its panel or its section. Hence it's not possible to have:
```toml
[manual.vpn.server_ip]
[advanced.dns.server_ip]
```
In which two questions have "real variable name" `is server_ip` and therefore conflict with each other.

! Some short keys are forbidden cause it can interfer with config scripts (`old`, `file_hash`, `types`, `binds`, `formats`, `changed`) and you probably should avoid to use common settings name to avoid to bind your question to this settings (e.g. `id`, `install_time`, `mysql_pwd`, `path`, `domain`, `port`, `db_name`, `current_revision`, `admin`)

### Supported questions types and properties

See [the full list of questions types and properties](/dev/forms)


### Reading and writing values

You can read and write values with 2 mechanisms: the `bind` property in the `config_panel.toml` and for complex use cases the getter/setter in a `config` script.

### `bind` property

The `bind` property allows to define where read and write the value bind to the question.

#### Default behaviour

If you did not define a specific getter/setter (see below), and no `bind` argument was defined, YunoHost will read/write the value from/to the app's `/etc/yunohost/$app/settings.yml` file.

#### Read / write into a var of an actual configuration file

If you want to read/write the value from/to the app's actual configural file (be it `.env`-like, JSON, YAML, INI, PHP, `.py`, ...):

```toml
[main.main.theme]
# (other properties ommited)
bind = ":__INSTALL_DIR__/config.yml"
```

In which case, YunoHost will look for something like a key/value, with the key being `theme`.

If the question id in the config panel (here, `theme`) differs from the key in the actual conf file (let's say it's not `theme` but `css_theme`), then you can write:
```toml
[main.main.theme]
# (other properties ommited)
bind = "css_theme:__FINALPATH__/config.yml"
```

!!!! Note: This mechanism is quasi language agnostic and will use regexes to find something that looks like a key=value or common variants. However, it does assume that the key and value are stored on the same line. It doesn't support multiline text or file in a variable with this method. If you need to save multiline content in a configuration variable, you should create a custom getter/setter (see below).

Nested syntax is also supported, which may be useful for example to remove ambiguities about stuff looking like: 
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

which we can `bind` to using: 

```toml
bind = "foo>max:__INSTALL_DIR__/conf.json"
```

#### Read / write an entire file

Useful when using a question `file` or `text` for which you want to save the raw content directly as a file on the system.
```toml
[main.main.logo]
# (other properties ommited)
bind = "__INSTALL_DIR__/img/logo.png"
```

### Custom getter / setter

Sometimes the `bind` mechanism is not enough:
 * the config file format is not supported (e.g. xml, csv)
 * the data is not contained in a config file (e.g. database, directory, web resources...)
 * the data should be written but not read (e.g. password)
 * the data should be read but not written (e.g. fetching status information)
 * we want to change other things than the value (e.g. the choices list of a select)
 * the question answer contains several values to dispatch in several places
 * and so on

You can create specific getter/setters functions inside the `scripts/config` of your app to customize how the information is read/written.

```bash
#!/bin/bash
source /usr/share/yunohost/helpers

ynh_abort_if_errors

# Put your getter, setter and validator here

# Keep this last line
ynh_app_config_run $1
```

#### Getter

A question's getter is the function used to read the current value/state. Custom getters are defined using bash functions called `getter__QUESTION_SHORT_KEY()` which returns data through stdout. 

Stdout can generated using one of those formats:
 1) either a raw format, in which case the return is binded directly to the value of the question
 2) or a yaml format, in this case you dynamically provide properties for your question (for example the `style` of an `alert`, the list of available `choices` of a `select`, etc.)

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

#### Setter

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

## Validation

You will often need to validate data answered by the user before to save it somewhere.

Validation can be made with regex through `pattern` argument
```toml
        pattern.regexp = '^.+@.+$'
        pattern.error = 'An email is required for this field'
```

You can also restrict several types with a choices list.
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

Finally, if you need specific or multi variable validation, you can use custom validators function:
```bash
validate__login_user() {
    if [[ "${#login_user}" -lt 4 ]]; then echo 'User login is too short, should be at least 4 chars'; fi
}
```

## Other actions than read, validate and save

### Restart a service at the end

You can use the services key to specify which service need to be reloaded or restarted.

```toml
services = [ 'nginx', '__APP__' ]
```

This argument can be set on a single question, to a section, or to an entire panel.

### Overwrite config panel mechanism

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

List of main configuration helpers
 * `ynh_app_config_get`
 * `ynh_app_config_show`
 * `ynh_app_config_validate`
 * `ynh_app_config_apply`
 * `ynh_app_config_run`

More info on this can be found by reading [vpnclient_ynh config script](https://github.com/YunoHost-Apps/vpnclient_ynh/blob/master/scripts/config)
