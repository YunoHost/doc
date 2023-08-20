---
title: Config panels
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_config_panels'
---

# Configuration panel for apps
Configuration panels for apps allows to let instances adminitrators manage some parameters or runs some actions for which the upstream doesn't provide any configuration panels itself. It's a good way to reduce manual change on config files and avoid conflicts on it.

Those panels could aslo be used as interface generator to extend quickly capabilities of YunoHost (e.g. VPN Client, Hotspost, Borg, etc.).

! Please: Keep in mind the YunoHost spirit, and try to build your panels in such a way as to expose only really useful parameters, and if there are many of them, to relegate those corresponding to rarer use cases to "Advanced" sub-sections.

## How does `config_panel.toml` work

Basically, configuration panels for apps uses at least a `config_panel.toml` at the root of your package. For advanced usecases, this TOML file could also be paired with a `config` script inside the scripts directory of your package.

The `config_panel.toml` file describes one or several panels, containing some sections, containing some questions generally binded to a params in a configuration file.

We supposed we have an upstream app with this simple config.yml file:
```yaml
title: 'My dummy apps'
theme: 'white'
max_rate: 10
max_age: 365
```

We could for example create a simple configuration panel for it like this one, by following the syntax `\[PANEL.SECTION.QUESTION\]`:
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
For performance reasons, questions short keys should be unique in all the `config_panel.toml` file, not just inside its panel or its section.

So you can't have
```toml
[manual.vpn.server_ip]
[advanced.dns.server_ip]
```
Indeed the real variable name is server_ip and here you have a conflict.

## Panels, sections and questions properties
See [the full list of questions types and properties](/dev/forms)


## Read and write values
You can read and write values with 2 mechanisms: the `bind` property in the `config_panel.toml` and for complex use cases the getter/setter in a `config` script.

### `bind` property
The `bind` property allows to define where read and write the value bind to the question.

#### Default behaviour

If you have not defined a specific getter/setter (see bellow), and without `bind` argument it will read and save the value in app settings yaml file.

#### Read / write into a var of a configuration file

If you want to read and save the value into a variable (called like the option name) of a file (json, yaml, ini, php, py ...) you can do:

```toml
bind = ":__INSTALL_DIR__/config.yml"
```

If you want to read and save the value into an other variable than the `config_panel.toml` question short key (email in the example) of a file (json, yaml, ini, php, py ...) you can do:
```toml
bind = "email:__FINALPATH__/config.yml"
```

!!!! Note: This mechanism is quasi language agnostic, however it's monoline: you can't save multiline text or file in a variable with this method. If you need to save multiline content in a configuration variable, you should do it via a specific getter/setter.

Sometimes, you want to read and save a value in a variable name that appears several time in the configuration file (for example variables called `max`). The `bind` property allows you to change the value on the variable following a regex in a the file:

```toml
bind = "importExportRateLimiting>max:__INSTALL_DIR__/conf.json"
```

#### Read / write an entire file

If you have a question of type file or text you could want to save the content into a specific path on the system.
```toml
bind = "__INSTALL_DIR__/img/logo.png"
```

### Specific getter / setter
Sometimes the `bind` mechanism is not enough:
 * the config file format is not supported (e.g. xml, csv)
 * the data is not contained in a config file (e.g. database, directory, web resources...)
 * the data should be writen but not read (e.g. password)
 * the data should be read but not writen (e.g. status information)
 * we want to change other things than the value (e.g. the choices list of a select)
 * the question answer contains several values to dispatch in several places
 * and so on

For all of those use cases, there are the specific getter or setter mechanism for a question !

To create specific getter / setter, you first need to create a `config` script inside the `scripts` directory

scripts/config
```bash
#!/bin/bash
source /usr/share/yunohost/helpers

ynh_abort_if_errors

# Put your getter, setter and validator here

# Keep this last line
ynh_app_config_run $1
```

#### Getter

A getter is a bash function called `getter_QUESTION_SHORT_KEY()` which returns data through stdout. 

Returns could have 2 formats:
 * a raw format, in this case the return is binded directly to the value of the question
 * a yaml format, in this case you can rewrite several properties of your question (like the `style` of an `alert`, the list of `choices` of a `select`, etc.)

[details summary="<i>Basic example : Get the login inside the first line of a file </i>" class="helper-card-subtitle text-muted"]
scripts/config
```bash
get__login_user() {
    if [ -s /etc/openvpn/keys/credentials ]
    then
        echo "$(sed -n 1p /etc/openvpn/keys/credentials)"
    else
        echo ""
    fi
}
```

config_panel.toml
```toml
[main.auth.login_user]
ask = "Username"
type = "string"
```
[/details]

[details summary="<i>Advanced example 1 : Display a list of available plugins</i>" class="helper-card-subtitle text-muted"]
scripts/config
```bash
get__plugins() {
    echo "choices: [$(ls $install_dir/plugins/ | tr '\n' ',')]"
}
```

config_panel.toml
```toml
        [main.plugins.plugins]
        ask = "Plugin to activate"
        type = "tags"
        choices = []
```
[/details]

[details summary="<i>Example 2 : Display the status of a VPN</i>" class="helper-card-subtitle text-muted"]
scripts/config
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

config_panel.toml
```toml
        [main.cube.status]
        ask = "Custom getter alert"
        type = "alert"
        style = "info"
        bind = "null" # no behaviour on
```
[/details]

#### Setter

A setter is a bash function called `setter_QUESTION()`. This function could access new values defined by the users by using bash variable with the same name as the short key of a question.

You probably should use `ynh_print_info` in order to display info for user about change that has been made to help them to understand a bit what's going.

[details summary="<i>Basic example : Set the login into the first line of a file </i>" class="helper-card-subtitle text-muted"]
scripts/config
```bash
set__login_user() {
    if [ -z "${login_user}" ]
    then
        echo "${login_user}" > /etc/openvpn/keys/credentials
        ynh_print_info "The user login has been registered in /etc/openvpn/keys/credentials"
    fi
}
```

config_panel.toml
```toml
[main.auth.login_user]
ask = "Username"
type = "string"
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
        choices.option1 = "Plop1"
        choices.option2 = "Plop2"
        choices.option3 = "Plop3"
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
    if [[ "${#login_user}" -lt 4 ]]; then echo 'Too short user login'; fi
}
```

## Other actions than read, validate and save

### Restart a service at the end

You can use the services key to specify which service need to be reloaded or restarted

```toml
services = [ 'nginx', '__APP__' ]
```

This argument could be on panel, section, or question.

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
 * ynh_app_config_get
 * ynh_app_config_show
 * ynh_app_config_validate
 * ynh_app_config_apply
 * ynh_app_config_run

More info on this could be found by reading [vpnclient_ynh config script](https://github.com/YunoHost-Apps/vpnclient_ynh/blob/master/scripts/config)
