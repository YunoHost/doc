---
title: Collabora
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_collabora'
---

![logo de collabora](image://collabora_logo.png?height=80)

[![Install collabora with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=collabora) [![Integration level](https://dash.yunohost.org/integration/collabora.svg)](https://dash.yunohost.org/appci/app/collabora)

Collabora est une suite bureautique en ligne basée sur LibreOffice et utilisable avec Nextcloud ou ownCloud. Elle permet d'éditer des documents textes, des tableaux, des diaporamas. L'édition en ligne peut se faire en simultanée et permet d'exporter et d'imprimer des documents grâce au format PDF généré.

Cette application n'est pas compatible avec les architectures ARM. Le projet Collabora a bien développé une version spécifique ARM, mais celle-ci n'est compatible qu'avec Ubuntu, pas Debian, donc ne fonctionne pas sous YunoHost.

### Architectures ARM

Il existe une solution pour faire tourner Collabora Online Document Server sur des architectures ARM (Raspberry Pi...), via Nextcloud.

#### 1. Télécharger et activer le Collabora Online Document Server

#### Attention : cette étape doit être réalisée depuis un terminal, et non depuis l'interface graphique de Nextcloud

Dans un terminal, se placer en super user

```bash
sudo su
```

puis lancer la commande d'installation du CODE :

```bash
sudo -u nextcloud php --define apc.enable_cli=1 -d memory_limit=512M /var/www/nextcloud/occ app:install richdocumentscode_arm64
```

#### 2. Corriger la configuration de NGINX pour Nextcloud

Pour que le CODE soit connecté à Nextcloud, le proxy doit faire le lien entre CODE (richdocumentscode_arm64) et Nextcloud.
Or le fichier config par défaut de NGINX pour Nextcloud fait référence à richdocumentscode au lieu de rich documentscode_arm64, qui est le nom de l'application dans notre cas des architectures ARM.

Il faut donc faire :

```bash
cd /etc/nginx/conf.d/[nextcloud.votredomaine.com].d
```

```bash
sudo nano nextcloud.conf
```
Dans le fichier, repérer la ligne comportant "richdocumentscode", puis ajouter "_arm64" juste après, enregistrer (Ctrl+S) et sortir (Ctrl+X).

Puis redémarrer NGINX (par exemple en redémarrant le serveur depuis l'interface d'aministration de YunoHost).

#### 3. Télécharger et activer l'application Nextcloud Collabora, sous le nom de "Nextcloud Office"

Dès lors, on peut télécharger l'application "Nextcloud Office" dans Nextcloud, et normalement le serveur CODE est choisi par défaut (sinon voir les paramètres de Nextcloud).

## Liens utiles

+ Site web : [www.collaboraoffice.com](https://www.collaboraoffice.com/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/collabora](https://github.com/YunoHost-Apps/collabora_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com -YunoHost-Apps/collabora/issues](https://github.com/YunoHost-Apps/collabora_ynh/issues)
