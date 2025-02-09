---
title: SSO/LDAP integration
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_sso_ldap_integration'
---

Un aspect puissant de YunoHost est que les applications sont destinées à être intégrées à la pile SSO/LDAP, de sorte que les utilisateurs connectés sur le portail utilisateur de YunoHost puissent être directement connectés à chaque application sans avoir à créer un compte dans chacune d'elles ni à avoir à recréer un compte. -connectez-vous à chaque application à chaque fois.

Il convient de souligner qu’il y a ici deux aspects différents :

- l'intégration LDAP, ce qui signifie que les comptes d'utilisateurs de l'application sont directement mappés aux comptes d'utilisateurs YunoHost
- l'intégration SSO, ce qui signifie qu'un utilisateur connecté sur le portail utilisateur YunoHost est également automatiquement connecté sur l'application.

Parfois, l'intégration LDAP est possible, mais pas l'intégration SSO (même si l'inverse serait vraiment étrange car l'intégration LDAP est quelque peu requise pour que le SSO fonctionne)


Le système SSO est géré par [SSOwat](https://github.com/YunoHost/ssowat) et gère également le système de « permissions » qui définit si un utilisateur (ou un visiteur anonyme) peut ou non accéder à l'application.

## LDAP integration

LDAP est un standard de facto lorsqu'il s'agit de partager une base de données de comptes d'utilisateurs commune entre plusieurs applications, d'où son utilisation dans le contexte de YunoHost.

Cependant, chaque application implémente la prise en charge LDAP à sa manière (ou non) et doit être dotée de paramètres pour communiquer réellement avec la base de données LDAP de YunoHost, généralement via son fichier de configuration. Il est conseillé de rechercher des exemples concrets d'applications les mettant en œuvre (telles que Nextcloud, Wekan...), mais vous devrez généralement fournir :


- LDAP host: `localhost` / `127.0.0.1`
- LDAP port: `389`
- Base DN : `dc=yunohost,dc=org`
- User DN : `ou=users,dc=yunohost,dc=org`
- Search filter: `(&(|(objectclass=posixAccount))(uid=%uid)(permission=cn=__APP__.main,ou=permission,dc=yunohost,dc=org))` (this makes sure that only people with the appropriate YunoHost/SSowat permission can access the app)
- Username attribute: `uid`
- Display name attribute: `displayname`
- Email attribute: `mail`

TO-DO/FIX-ME: plus d'explications ? Que manque-t-il?

## SSO integration

En interne, SSOwat injectera à la volée [HTTP Basic Auth Headers](https://en.wikipedia.org/wiki/Basic_access_authentication) tel que `Authorization: Basic <base64credentials>`. 
Certaines applications peuvent inclure la prise en charge de l'authentification de base prête à l'emploi... Les applications PHP nécessitent souvent cette ligne dans la configuration NGINX :

```
fastcgi_param REMOTE_USER     $remote_user;
```

`$remote_user` étant une variable spéciale dans NGINX qui correspond à l'utilisateur fourni dans les en-têtes HTTP Basic Auth.
L'application PHP utilisera alors l'information `HTTP_REMOTE_USER` dans son code.

TO-DO/FIX-ME: Plus d'explications sur la façon dont cela se fait pour les applications non PHP ?

## Configuring SSOwat permissions for the app

Les autorisations SSOwat sont configurées à l'aide de la ressource « autorisation » dans le fichier manifest.toml de votre application.

Le cas échéant, vous pouvez créer des autorisations « secondaires » pour votre application, par exemple pour autoriser uniquement un groupe spécifique de personnes à accéder à l'interface utilisateur d'administration de l'application. Par exemple :

```toml
[resources.permissions]

# This configures the main permission, i.e. general access to `https://domain.tld/$app/`
# Initial access is defined using the `init_main_permission` install question.
main.url = "/"

# This configures an additional "admin" permission regarding access to `https://domain.tld/$app/admin`
admin.url = "/admin"
admin.show_tile = false    # This means that this permission won't correspond to a tile in YunoHost's user portal
admin.allowed = "admins"   # Initialize the access for the "admins" group ... You can also use an install question called `init_admin_permission` to let the server admin choose this.
```

Consultez la page sur les ressources de l'application pour la description complète du comportement et des propriétés.

## Déconnexion de l'application ou déconnexion de YunoHost

Un [problème connu](https://github.com/YunoHost/issues/issues/501) est que parfois, la déconnexion des applications YunoHost ne déconnectera pas les utilisateurs de chaque application. C'est par exemple le cas de [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh/issues/19), car il utilise ses propres cookies d'authentification qui ne sont pas effacés lorsque les gens se déconnectent de YunoHost. Ce n’est pas anodin à corriger.

De même, la déconnexion de l'application ne déconnecte pas nécessairement entièrement les personnes de YunoHost (ce qui est plus acceptable que de cliquer sur "*Se déconnecter*" et... de ne pas être déconnecté du tout car vous êtes toujours connecté sur le SSO, donc connecté sur l'application). Certaines applications YunoHost intègrent des correctifs personnalisés de sorte que le processus de déconnexion de l'application redirige automatiquement vers `https://main.domain.tld/yunohost/sso/?action=logout` qui les déconnecte (il est important que la redirection soit faite vers le [domaine principal](https://doc.yunohost.org/fr/dev/maindomain) pour fonctionner).
