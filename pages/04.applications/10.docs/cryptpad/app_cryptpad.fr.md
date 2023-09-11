---
title: CryptPad
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_cryptpad'
---

[![Installer CryptPad avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=cryptpad) [![Integration level](https://dash.yunohost.org/integration/cryptpad.svg)](https://dash.yunohost.org/appci/app/cryptpad)

*CryptPad* est une suite logicielle chiffrée de bout en bout et ouverte. Elle est conçue pour permettre un travail collaboratif, en synchronisant les modifications apportées aux documents en temps réel. Comme toutes les données sont chiffrées, le service et ses administrateurs n'ont aucun moyen de voir le contenu édité et stocké.

## Avertissements / informations importantes

#### Configuration

Une fois CryptPad installé, créez un compte via le bouton S'inscrire sur la page d'accueil. Pour faire de ce compte un administrateur d'instance :

    Copiez la clé publique trouvée dans le menu utilisateur (avatar en haut à droite) > Paramètres > Compte > Clé de signature publique
    Collez cette clé dans `/var/www/cryptpad/config/config.js` dans le tableau suivant (décommentez et remplacez l'espace réservé) :

```
adminKeys: [
        "[cryptpad-user1@my.awesome.website/YZgXQxKR0Rcb6r6CmxHPdAGLVludrAF2lEnkbx1vVOo=]",
],
```

    Redémarrer le service CryptPad (Dans webadmin YunoHost -> Services -> cryptpad -> Redémarrer)

## Liens utiles

+ Site web : [cryptpad.fr (fr)](https://cryptpad.fr/)
+ Démonstration : [Démo](https://cryptpad.fr/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/cryptpad](https://github.com/YunoHost-Apps/cryptpad_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/cryptpad/issues](https://github.com/YunoHost-Apps/cryptpad_ynh/issues)
