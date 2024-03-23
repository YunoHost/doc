---
title: Hooks
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_hooks'
---
YunoHost comprend un mécanisme de hooks déclenchés lors de nombreuses opérations modifiant le système. Vous pouvez utiliser ce mécanisme afin d'étendre le comportement d'une commande YunoHost.

Le cas le plus évident est l'ajout d'un utilisateur. Si vous aviez un hook `post_user_create`, ce hook sera déclenché dès qu'un utilisateur sera ajouté.

## Comment ajouter un hook personnalisé sur une instance spécifique

!!! Nous imaginons ci-dessous que nous voulons lancer une commande après chaque création d'utilisateur pour ajouter l'utilisateur à l'utilisateur samba.

Vous devez créer un répertoire avec le nom des hooks dans `/etc/yunohost/hooks.d/` :

```bash
mkdir -p /etc/yunohost/hooks.d/post_user_create
```

Créez ensuite un script bash à l'intérieur de ce répertoire, préfixé par 2 chiffres et un tiret :

```bash
nano /etc/yunohost/hooks.d/post_user_create/05-add-user-to-samba
```

## Comment ajouter un hook dans un paquetage d'application

Si vous empaquetez une application, vous ne devez pas mettre vous-même le hook dans `/etc/yunohost/hooks.d` mais vous devez créer un répertoire hooks à la racine de votre paquet.

```text
.
├─── conf
├─── hooks
├── scripts
```

Dans le dossier des hooks, créer un script bash appelé avec le type de hook que vous voulez créer par exemple `post_create_user`.

## -> [Liste des hooks et leurs variables](https://yunohost.org/en/packaging_apps_hooks)
