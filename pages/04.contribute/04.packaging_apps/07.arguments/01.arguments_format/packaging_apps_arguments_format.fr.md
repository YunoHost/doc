---
title: YunoHost Arguments Format
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_arguments_format'
---

Dans le développement d'applications YunoHost, il y a plusieurs endroits où vous pouvez écrire des questions pour votre
utilisateur comme dans `manifest.json/toml`, `config_panel.json/toml` ou `actions.json/toml`.

Cette page documente ce format et tous les types de questions disponibles que vous pouvez poser à votre utilisateur.
Sauf indication contraire, ce format s'applique partout où il est utilisable ( à l'heure actuelle :
les arguments d'installation dans `manifest.json/toml`, `config_panel.json/toml` et `actions.json/toml`)

Pour aider à la comprehension, les titres sont en français.i Cependant dans le code toml ou javascript,
le type doit être en anglais (comme dans les exemples).

## Format général des arguments Yunohost

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

## Tous les types disponibles

### Chaîne de caractères

C'est le type le plus simple et le type par défaut si vous n'en spécifiez pas.

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

### Chaîne de caractères avec choix

Comme la chaine de caractères, sauf que l'utilisateur doit choisir dans une liste de chaîne de caractères spécifiques. 

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

### Domaine

Ce type demandera à l'utilisateur de choisir l'un des domaines de son instance YunoHost. 

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

### Chemin (en: Path)

Ce type demandera à l'utilisateur de choisir le chemin de l'url (généralement pour arriver à un domaine)
comme "chemin/vers/mon/application"

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
    "default": "/my_app"cd

},
```
[/ui-tab]
[/ui-tabs]

### Utilisateur

Ce type demandera à l'utilisateur de selectionner un utilisateur dans la liste des utilisateurs
de son instance Yunohost. Généralement, cela est utilisé pour sélectionner celui qui va être l'administrateur
ou qui va avoir accès à cette application.

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

### Mot de passe

Ce type demande à l'utilisateur de saisir un mot de passe.
Celui-ci est généralement utilisé pour saisir le mot de passe permettant
de créer un compte sur l'application.

En ligne de command, il s comporte comme n'importe quelle demande de mot de passe
et n'affichera aucun caractère (pas de "\*\*\*...") pour des questions de sécurité.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "password"
ask.en = "the password"
ask.fr = "le mot de passe"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "password",
    "ask": {
        "en": "the password",
        "fr": "le mot de passe"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Booléen
Ce type demande à l'utilisateur de répondre à question par Vrais ou Faux

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

### Nombre

Comme le type string mais uniquement pour les nombres.

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

### Application

Ce type demande à l'utilisateur de selectionner une application dans la liste
des apllications installées sur l'instance Yunohost.

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

### Information

C'est un type spécial qui permet au packageur de l'application à écrire un text
qui est simplement affiché. C'est utile pour spécifier un peu le context.

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

### Plage de valeurs

Ce type demande à l'utilisateur de choisir une valeur numérique entre de bornes.
Une valeur précise n'est cependant pas concidérée comme importante.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "email"
ask.en = "Put a range"
ask.fr = "Indiquer "
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "email",
    "ask": {
        "en": "the email address",
        "fr": "l adresse courriel"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Adresse courriel (email)

Ce type demande à l'utilisateur de renseigner une adresse courriel.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "email"
ask.en = "the email address"
ask.fr = "l adresse courriel"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "email",
    "ask": {
        "en": "the email address",
        "fr": "l adresse courriel"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Url

Ce type demande à l'utilisateur de renseigner une url.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "email"
ask.en = "the url"
ask.fr = "l url"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "url",
    "ask": {
        "en": "the url",
        "fr": "l url"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Date
Ce type demande à l'utilisateur de renseigner une date.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "date"
ask.en = "the date"
ask.fr = "la date "
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "date",
    "ask": {
        "en": "the date",
        "fr": "la date"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Temps | Horaire

Ce type demande à l'utilisateur de renseigner un horaire.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = "time"
ask.en = "time"
ask.fr = "l horaire"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "date",
    "ask": {
        "en": "time",
        "fr": "l horaire"
    }
},
```
[/ui-tab]
[/ui-tabs]

### Fichier

Ce type demande à l'utilisateur d'ajouter un fichier.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="in toml"]
```toml
[maybe.some.stuff.before.the_name]
type = file""
ask.en = "the file"
ask.fr = "le fichier"
```
[/ui-tab]
[ui-tab title="in json"]
```javascript
{
    "name": "the_name",
    "type": "file",
    "ask": {
        "en": "the file",
        "fr": "le fichier"
    }
},
```
[/ui-tab]
[/ui-tabs]
