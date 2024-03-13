---
title: Actionmap
template: docs
taxonomy:
    category: docs
routes:
  default: '/dev/yunohost/actionmap'
---

!!! The actionmap is generally a good entry point if you want to discover the YunoHost API/CLI. Alternatively you can explore the api through our [swagger API documentation](/admin_api)

## Introduction

The [actionmap](https://github.com/YunoHost/yunohost/blob/dev/share/actionsmap.yml) is a YAML file based on [moulinette framework](/dev/moulinette) syntax that describe each endpoints of the CLI/API. This syntax is derivated from python [argparse](https://docs.python.org/3/library/argparse.html) syntax.

## CLI and API are identic
Yunohost API endpoints and yunohost CLI commands take same arguments and are running the same python function. Moulinette is totaly designed in that way, and it feet perfectly to the need of YunoHost because we want that a yunohost instance administrator to be able to retrieve in CLI what he or she could do on the webadmin.

## Retrieve the python code binded to an action

You can see that the action is organize in categories/subcategories, actions and parameters. Each actions is preceded by a comment that give you the name of the function you need to search. This function is located in a file named as the category of this action.

```
user:
    category_help: Manage users and groups
    actions:
        [...]

        ### user_info()
        info:
            action_help: Get user information
            api: GET /users/<username>
            arguments:
                username:
                    help: Username or email to get information
```

So here you could find the function `user_info` inside the file `src/user.py`. The moulinette framework will provide one parameter called `username` to this function.

## Supported HTTP verbs
Moulinette supports `GET`, `PUT`, `POST` and `DELETE`. Note that with the paradigm of using the same functions for CLI and API, it means our API is not really a REST API.

The framework can also return OPTIONS to allow the usage of the API through an other domain in a web browser.

## Properties

TODO (maybe inside moulinette)

 - ask
 - password
 - metavar
 - pattern
 - nargs
 - type
 - required
 - action
 - help
 - choices
 - default
 - full
 - authentication
 - deprecated_alias




## Regenerate the OpenAPI documentation

When you change the API, you should regenerate the API documentation JSON `doc/openapi.json` and `doc/openapi.js`.

```
cd /ynh-dev/yunohost/doc
python3 ./generate_api_doc.py
```


