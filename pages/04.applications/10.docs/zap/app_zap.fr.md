---
title: Zap
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_zap'
---

[![Installer Zap avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=zap) [![Integration level](https://dash.yunohost.org/integration/zap.svg)](https://dash.yunohost.org/appci/app/zap)

*Zap* est une alternative éthique au Fediverse qui fournit des fonctionnalités puissantes pour créer des sites web interconnectés avec une identité décentralisée, des communications et un cadre de permissions construit en utilisant la technologie commune des serveurs web.

Compatible avec **Mastodon**, **Pleroma**, **Pixelfed**, **Friendica**, **Hubzilla**, **Funkwhale**, **Peertube**, **Plume**, **WriteFreely** et beaucoup, beaucoup d'autres.

### Caractéristiques uniques de ZAP

- **Groupes** : publics, privés, et modérés.
- **Événements** : Calendrier et présence ; notifications automatiques d'anniversaire pour les amis utilisant cette fonctionnalité.
- **Cloud**storage : Stockage de fichiers en réseau intégré avec accès aux réseaux sociaux.
- Éditeur** : Supporte à la fois markdown et bbcode. Utilisez l'un ou l'autre, ou les deux, si vous le souhaitez.
- **Partage** : Glissez-déposez un certain nombre de choses différentes comme des fichiers, des photos, des pages Web, des cartes, des numéros de téléphone pour les partager.
- Listes** : Parfois appelé cercles ou aspects, cela vous permet de définir vos propres groupes d'amis liés et de communiquer avec eux comme un groupe privé.
- **Extension** : Modifiez ou mettez à niveau les fonctionnalités de votre logiciel comme vous le souhaitez en installant des fonctions supplémentaires à partir de modules complémentaires et de la collection d'applications gratuites.

### Avertissements / informations importantes

### Installation

Avant de procéder à l'installation, lisez les [Instructions d'installation de Zap](https://codeberg.org/zot/zap/src/branch/release/install/INSTALL.txt) pour obtenir des informations importantes sur les points suivants

#### Enregistrer un nouveau domaine et l'ajouter à YunoHost

- Zap nécessite un domaine dédié, alors obtenez-en un et ajoutez-le en utilisant le panneau d'administration de YunoHost. **Domaines -> Ajouter un domaine**. Comme Zap utilise le domaine complet et est installé à la racine, vous pouvez créer un sous-domaine tel que `zap.domain.tld`. N'oubliez pas de mettre à jour vos DNS si vous les gérez manuellement.

### Droits d'utilisateur de l'administrateur LDAP, journaux et échecs de mise à jour de la base de données

- **Pour les droits d'administration** : Une fois l'installation terminée, vous devrez vous rendre sur la page de votre nouveau hub et vous connecter avec le **nom d'utilisateur du compte admin** qui a été saisi au moment de l'installation. Vous devriez alors être en mesure de créer votre premier canal et avoir les **droits d'administrateur** pour le hub.

- **Pour les utilisateurs normaux de YunoHost :** Les utilisateurs normaux de LDAP peuvent se connecter via l'authentification Ldap et créer leurs canaux.

- Si l'administrateur ne peut pas accéder aux paramètres d'administration à `https://zap.example.com/admin` ou si vous voulez accorder des droits d'administration à un autre utilisateur sur le hub, alors vous devez **ajouter manuellement 4096** aux **rôles_comptes** sous **comptes** pour cet utilisateur dans la **base de données via phpMYAdmin**.

- **Pour les logs:** Allez dans **admin->logs** et entrez le nom du fichier **php.log**.

- Échec de la base de données après la mise à jour:** Parfois, la mise à jour de la base de données échoue après la mise à jour de la version. Vous pouvez aller sur le hub, par exemple `https://zap.example.com/admin/dbsync/` et vérifier le nombre de mises à jour qui ont échoué. Ces mises à jour devront être exécutées manuellement par **phpMYAdmin**.

## Liens utiles

+ Site web : [codeberg.org/zot/zap](https://codeberg.org/zot/zap)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/zap](https://github.com/YunoHost-Apps/zap_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/zap/issues](https://github.com/YunoHost-Apps/zap_ynh/issues)
