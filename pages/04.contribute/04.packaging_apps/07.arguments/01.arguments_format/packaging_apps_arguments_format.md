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

The general format for an argument looks like this:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "one_of_the_available_type"
ask.en = "the question in english"
ask.fr = "la question en français"
help.en = "some help text in english" # optional
help.fr = "un peu d aide en français" # optional
example = "an example value" # optional
default = "some stuff" # optional, not available for all types
optional = true # optional, will skip if not answered
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "one_of_the_available_type",  // "sting" is not specified
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    },
    "help": {
        "en": "some help text in english",
        "fr": "un peu d aide en français"
    },
    "example": "an example value", // optional
    "default", "some stuff", // optional, not available for all types
    "optional": true // optional, will skip if not answered
},
```
[/ui-tab]
[/ui-tabs]

## All avaiable types

### string

This one is the simpliest one and is the default type if you don't specify one.

Example in toml:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "string"  # optional
ask.en = "the question in english"
ask.fr = "la question en français"
example = "an example value"  # optional
default = "some stuff" # optional
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "string",  // optional
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    },
    "default": "some stuff", // optional
    "example": "an example value"
},
```
[/ui-tab]
[/ui-tabs]

### string with choices

Like string except the user needs to chose in a list of specifics strings.
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "string"
ask.en = "the question in english"
ask.fr = "la question en français"
example = "an example value"  # optional
choices = ["fr", "en"]
default = "en" # optional
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "string",
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    },
    "example": "an example value",
    "choices": ["fr", "en"],
    "default": "en" // optional
},
```
[/ui-tab]
[/ui-tabs]

### domain

This type will ask the user to chose one of the domains of their YunoHost instance.
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "domain"
ask.en = "the question in english"
ask.fr = "la question en français"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "domain",
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Path

This type will ask the user to chose an URL path (generally to happen it to a
domain) like "/path/to/my/app"

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "path"
ask.en = "the question in english"
ask.fr = "la question en français"
default = "/my_app"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "path",
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    },
    "default": "/my_app"
},
```
[/ui-tab]
[/ui-tabs]

### User

This type will ask the user to select a user in the list of users in their
YunoHost installation. Generally this is used to select who is going to be the
admin or who is going to have access to this application.

Example in toml:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]

```toml
[maybe.some.stuff.before.the_name]
type = "user"
ask.en = "the question in english"
ask.fr = "la question en français"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "user",
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Password

This type will ask the user to input a password. This is generally used to
input the password for creating an account on the application.

In CLI it will behave like any password query and won't print any character on
type (not "\*\*\*...") for security reasons.

Example in toml:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]

```toml
[maybe.some.stuff.before.the_name]
type = "password"
ask.en = "the question in english"
ask.fr = "la question en français"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "password",
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Boolean

This type will ask the user to answer true or false to a question.

Example in toml:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]

```toml
[maybe.some.stuff.before.the_name]
type = "boolean"
ask.en = "the question in english"
ask.fr = "la question en français"
default = true
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "boolean",
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    },
    "default": true
},
```
[/ui-tab]
[/ui-tabs]

### Number

Like string except the user needs to enter a number

Example in toml:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]

```toml
[maybe.some.stuff.before.the_name]
type = "number"
ask.en = "the question in english"
ask.fr = "la question en français"
default = 0
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "number",
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    },
    "default": 0
},
```
[/ui-tab]
[/ui-tabs]

### App

This type will ask the user to select an application in the list of installed
application on their YunoHost.

Example in toml:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]

```toml
[maybe.some.stuff.before.the_name]
type = "app"
ask.en = "the question in english"
ask.fr = "la question en français"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "app",
    "ask": {
        "en": "the question in english",
        "fr": "la question en français"
    }
},
```
[/ui-tab]
[/ui-tabs]

### display_text

This is a special type that allows the application packager to write some text
that will be simply displayed. This is useful to provide more context.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "display_text"
ask.en = "the text in english"
ask.fr = "le text en français"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "display_text",
    "ask": {
        "en": "the text in english",
        "fr": "le text en français"
    }
},
```
[/ui-tab]
[/ui-tabs]
