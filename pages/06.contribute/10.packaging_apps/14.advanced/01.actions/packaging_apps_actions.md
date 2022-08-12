---
title: Actions
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_actions'
---

<div class="alert alert-warning">For now, all those features are <b>EXPERIMENTAL</b>
and aren't ready for production and are probably going to change again, if you
still decide to use them don't expect them to be stable and follow to core
development of YunoHost otherwise <b>they might randomly breaks on your apps</b>
</div>

Applications "actions" is a packaging feature that allow you to ship with your
application a list of "actions" executable from both the cli and the admin
interfaces.

"actions" are a list of custom commands that, optionally, has arguments (like
the installation script of an application has arguments) and once called will
called a specific selected command with those arguments. Like an "actions"
restart service with a argument "service name" could called the command
`systemctl restart $some_service` (but don't that specific action in your app,
it's just for example purpose).

Like the installation page generated from the manifest those actions can accept
a list of arguments.

Their main purpose is to expose procedures that a sysadmin would normally do on
CLI but that your application user would want to do but don't have the
knowledge to do by themselves via ssh (or are just too lazy for that).

For example those could be:

* importing data in a application
* generate a custom backup
* start a procedure like synchronising file with the file system (nextcloud for example)
* purge a local cache
* restart some services
* modify a theme

Actions looks like this in the admin interface:

![actions admin screenshot](image://actions_example.png)

## How to add actions to your application

Adding actions to your application is pretty simple as it is very similar to
writing your manifest for the application installation.

You need to write an `actions.toml` file in your application at the root level
like the `manifest.toml`/`manifest.json`.

<div class="alert alert-info">
The arguments are written in **[YunoHost Arguments
Format](/packaging_apps_arguments_format)** like in `manifest.toml/json`
</div>

The general pattern looks like this:

```toml
[first_action]
name = "some name"
description = "some description that will be displayed"

# can be a bash command like so:
command = "echo pouet $YNH_ACTION_FIRST_ARGUMENT"
# or a path to a script like
command = "/path/to/some/stuff --some-flag $YNH_ACTION_FIRST_ARGUMENT"

user = "root"  # optional
cwd = "/" # optional, "current working directory", by default it's "/etc/yunohost/apps/the_app_id"
          # also the variable "$app" is available in this variable and will be replace with the app id
          # for example you can write "/var/www/$app"
accepted_return_codes = [0, 1, 2, 3]  # optional otherwise only "0" will be a non enorous return code

    [first_action.arguments]
        # here, you put a list of arguments exactly like in manifest.toml/json
        [first_action.arguments.first_argument]
        type = "string"
        ask.en = "service to restart"
        example = "nginx"

        ...  # add more arguments here if needed
        # you can also have actions without arguments

[another_action]
name = "another name"
command = "systemctl restart some_service"

    [another_action.arguments]
        [another_action.arguments.argument_one]
        type = "string"
        ask.en = "some stuff"
        example = "stuff"

        ...  # add more arguments here if needed
        # you can also have actions without arguments
```

You can have as much actions as you want and from zero to as many arguments you want.

If you prefer, you can also write your actions in JSON like manifest.json:

```json
[{
        "id": "restart_service",
        "name": "Restart service",
        "command": "echo pouet $YNH_ACTION_SERVICE",
        "user": "root",  # optional
        "cwd": "/", # optional
        "accepted_return_codes": [0, 1, 2, 3],  # optional
        "description": {
            "en": "a dummy stupid exemple or restarting a service"
        },
        "arguments": [
            {
                "name": "service",
                "type": "string",
                "ask": {
                    "en": "service to restart"
                },
                "example": "nginx"
            }
        ]
},
{
    ...  # other action
}]
```

## How to use actions

### In the admin

<div class="alert alert-warning">For now since those features are still
experimental you won't find any direct links to the app actions on the app
page</div>

The actions are located on https://some_domain.tld/yunohost/admin/#/apps/$app_id/actions

## With the CLI

The CLI API is very similar to application installation. You have 2 commands:

* `yunohost app list $app`
* `yunohost app run $app $action_id` ("$action_id" is the this between "[]"
  like "[another_action]" in the example)

`list` will obviously give you all actions for an application.

`run` will run an existing action for an application and will ask, if needed,
values for arguments. Like with `yunohost app install` you can use the `-a` and
pass arguments in the HTTP POST arguments format (like
`&path=/app&domain=domain.tld&other_value=stuff`)
