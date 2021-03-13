---
title: Déplacer un dossier d'application vers un autre espace de stockage
template: docs
taxonomy:
    category: docs
routes:
  default: '/moving_app_folder'
---

Les dossiers d'application se trouvent (*habituellement*) dans `/var/www/$nom_application`

Lorsqu'un dossier d'application devient trop volumineux il peut être intéressant de le déplacer vers un autre espace de stockage (comme un disque dur externe, une carte sd, etc.)

Partant du principe que [le stockage externe est déjà monté](/external_storage), voici un guide pour déplacer le dossier de l'application wordpress :


#### 1. Déplacer le dossier wordpress et tout son contenu vers le stockage externe

```shell
mv /var/www/wordpress /media/externalharddrive/
```
___

#### 2. Créer un lien symbolique 

Le programme qui va chercher des informations dans le dossier /var/www/wordpress sera redirigé vers le stockage externe.

```shell
ln -s /media/externalharddrive/wordpress /var/www/wordpress
```
___

#### 3. (peut être) bidouiller les permissions

Après tout ça, il est possible que vous ayez à modifier les permissions de `/media/externalharddrive` pour que `www-data` (ou l'utilisateur de l'app) puisse y accéder. Quelque chose comme :
 
```shell
chgrp www-data /media/externalharddrive
chmod g+rx /media/externalharddrive

```

(À préciser par un expert)
