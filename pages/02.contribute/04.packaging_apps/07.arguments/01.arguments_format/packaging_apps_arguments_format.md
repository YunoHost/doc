---
title: YunoHost Arguments Format
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_arguments_format'
---

In YunoHost application developpement there are several places where you end up
writting questions for your user like in the `manifest.json/toml`, the
`config_panel.json/toml` or `actions.json/toml`.

This page documents this format and all available kind of questions you can ask
your user. Unless it's stated otherwise, this format applies to everyplace it's
usable (for now: installation arguments in `manifest.json/toml`,
`config_panel.json/toml` and `actions.json/toml`)

## YunoHost arguments general format

The general format for an argument looks like this in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "one_of_the_available_type"
ask.en = "the question in english"
ask.fr = "the question in french"
help.en = "some help text in english" # optional
help.fr = "some help text in french" # optional
example = "an example value" # optional
default = "some stuff" # optional, not available for all types
optional = true # optional, will skip if not answered
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "one_of_the_available_type",  // "sting" is not specified
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    },
    "help": {
        "en": "some help text in english",
        "fr": "some help text in french"
    },
    "example": "an example value", // optional
    "default", "some stuff", // optional, not available for all types
    "optional": true // optional, will skip if not answered
},
```

## All avaiable types

### string

This one is the simpliest one and is the default type if you don't specify one.

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "string"  # optional
ask.en = "the question in english"
ask.fr = "the question in french"
example = "an example value"  # optional
default = "some stuff" # optional
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "string",  // optional
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    },
    "default": "some stuff", // optional
    "example": "an example value"
},
```

### string with choices

Like string except the user needs to chose in a list of specifics strings.

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "string"
ask.en = "the question in english"
ask.fr = "la question en français"
example = "an example value"  # optional
choices = ["fr", "en"]
default = "en" # optional
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "string",
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    },
    "example": "an example value",
    "choices": ["fr", "en"],
    "default": "en" // optional
},
```

### domain

This type will ask the user to chose one of the domains of their YunoHost instance.

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "domain"
ask.en = "the question in english"
ask.fr = "the question in french"
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "domain",
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    }
},
```

### Path

This type will ask the user to chose an URL path (generally to happen it to a
domain) like "/path/to/my/app"

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "path"
ask.en = "the question in english"
ask.fr = "the question in french"
default = "/my_app"
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "path",
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    },
    "default": "/my_app"
},
```

### User

This type will ask the user to select a user in the list of users in their
YunoHost installation. Generally this is used to select who is going to be the
admin or who is going to have access to this application.

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "user"
ask.en = "the question in english"
ask.fr = "the question in french"
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "user",
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    }
},
```

### Password

This type will ask the user to input a password. This is generally used to
input the password for creating an account on the application.

In CLI it will behave like any password query and won't print any character on
type (not "\*\*\*...") for security reasons.

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "password"
ask.en = "the question in english"
ask.fr = "the question in french"
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "password",
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    }
},
```

### Boolean

This type will ask the user to answer true or false to a question.

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "boolean"
ask.en = "the question in english"
ask.fr = "the question in french"
default = true
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "boolean",
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    },
    "default": true
},
```

### Number

Like string except the user needs to enter a number

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "number"
ask.en = "the question in english"
ask.fr = "the question in french"
default = 0
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "number",
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    },
    "default": 0
},
```

### App

This type will ask the user to select an application in the list of installed
application on their YunoHost.

Example in toml:

```toml
[maybe.some.stuff.before.the_name]
type = "app"
ask.en = "the question in english"
ask.fr = "the question in french"
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "app",
    "ask": {
        "en": "the question in english",
        "fr": "the question in french"
    }
},
```

### display_text

This is a special type that allows the application packager to write some text
that will be simply displayed. This is useful to provide more context.

```toml
[maybe.some.stuff.before.the_name]
type = "display_text"
ask.en = "the text in english"
ask.fr = "the text in french"
```

And in json:

```javascript
{
    "name": "the_name",
    "type": "display_text",
    "ask": {
        "en": "the text in english",
        "fr": "the text in french"
    }
},
```
