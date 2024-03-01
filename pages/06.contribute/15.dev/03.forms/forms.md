---
title: Forms
template: docs
taxonomy:
    category: docs
routes:
  default: '/dev/forms'
---

# Forms

YunoHost uses a lot of forms. You can found here information on supported types question and properties.

## Questions
!!! Questions are called `Options` in the code.

### Generic properties

| Property | Scope        | Description | Example |
|----------|--------------|-------------|---------|
| `type`   | Everywhere   | Specify the type of the question (see bellow for the list) | `type = "string"` |
| `ask`    | Everywhere   | The title of the question            | `ask.en = "Cats or dogs ?"` | 
| `help`    | Everywhere  | An help message            | `help.en = "Think carefully!"` |
| `optional`| Everywhere  | Set true if the question is not mandatory  | `optional = true` |
| `readonly`| Everywhere  | Avoid user to be able to change the value | `readonly = true` |
| `example` | Everywhere  | Give an example to help to understand the format of the answer| `example = "camille@example.com"` |
| `pattern.regexp` | Everywhere  | Regex to validate the new value| `pattern.regexp = "^.+@.+$"` |
| `pattern.error` | Everywhere  | Error to display if the pattern doesn't match | |
| `redact` | Everywhere  | Avoid a confidential value to be logged | `redact = true` |
| `default` | Install     | A default value for the question            | |
| `visible` | ConfigPanel | A simple js expression based on other short keys questions to hide or display dynamically the question| `visible = "login && ! private_key"` |
| `bind` | AppConfigPanel | See [App configuration panel doc](/packaging_config_panels) | `bind = "__INSTALL_DIR__/config.yml"` |

 * `help`, `optional`, `readonly` and `visible` are also available on panels and sections entities.
 *  Long help messages could not to be correctly displayed for user using yunohost CLI
 * For the moment `default` properties are not supported in app config panel and you have to initialize the value by yourself in config file or settings.


### `display_text` (readonly)
Display a simple text.

### `markdown` (readonly)
Display a markdown (if you don't use markdown features, prefer display_text)

### `alert` (readonly)
Display an alert box with different style.

| Property | Description  | Default |
|----------|--------------|---------|
| `style`    | Style of the alert box (success, info, warning, danger) | info |

### `button`
Display a button with different style (useful for custom actions).

| Property | Description  | Default |
|----------|--------------|---------|
| `style`    | Style of the alert box (success, info, warning, danger) | success|
| `enabled`    | Enable or disable the button | True        |

### `string`
Input text monoline.

### `text`
Input text multilines

| Property | Description  | Default |
|----------|--------------|---------|
| `redact`    | Style of the alert box (success, info, warning, danger) | success|

### `password`
Password input. `{}` chars are forbidden and value is not added to logs.

### `color`
Hexadecimal color starting with # with a color picker.

### `number`
An integer.

| Property | Description  | Example |
|----------|--------------|---------|
| `min`    | Minimal value             |         |
| `max`    | Maximum value |         |
| `step`   | Steps between each next possible value |         |

### `range`
| Property | Description  | Example |
|----------|--------------|---------|
| `min`    | Minimal value             |         |
| `max`    | Maximum value |         |
| `step`   | Steps between each next possible value |         |

### `boolean`
| Property | Description  | Example |
|----------|--------------|---------|
| `yes`    |              |         |
| `no`     |              |         |

### `date`
A date picker with date in the format YYYY-MM-DD

### `time`
A time picker

### `email`
An email input

### `path`
### `url`
By default it ask for a web URL but you can change the `pattern` if you want to.

### `file`
File question

| Property | Description  | Example |
|----------|--------------|---------|
| `accept`    | Same format than HTML file input |         |

! This file type is not made for big files transfer, it's just for small logo, or config files.

### `select`
Dropdown

| Property | Description  | Example |
|----------|--------------|---------|
| `choices`  | list or dictionary of choices |         |

### `tags`
Multi choices selection.

| Property | Description  | Example |
|----------|--------------|---------|
| `choices` | List or dictionary of choices |        |

### `domain`
List all added domains

### `app`
List all installed apps

### `user`
List all users

### `group`
List all groups
