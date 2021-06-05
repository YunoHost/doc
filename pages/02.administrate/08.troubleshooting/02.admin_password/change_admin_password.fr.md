---
title: Changer le mot de passe d'administration
template: docs
taxonomy:
    category: docs
routes:
  default: '/change_admin_password'
---

Vous voudrez peut-être changer votre mot de passe d'administrateur pour des raisons de sécurité ou parce que vous l'avez oublié.

Si vous avez oublié votre mot de passe ou si vous ne pouvez pas vous connecter en utilisant l'utilisateur `admin`, vous
pouvez peut-être encore changer le mot de passe en vous connectant en tant que "root" sur
SSH (à partir de votre réseau local ! ou en utilisant un mode rescure si vous êtes sur un VPS...)

## Sur l'interface d'administration web

1. Connectez-vous à l'interface web d'administration.
2. Allez dans la section Outis > Changer le mot de passe d’administration.


## En ligne de commande


```bash
yunohost tools adminpw
```

