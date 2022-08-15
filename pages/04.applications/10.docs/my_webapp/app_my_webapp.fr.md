---
title: My_webapp
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_my_webapp'
---
En complément du [Readme_fr.md](https://github.com/YunoHost-Apps/my_webapp_ynh/blob/testing/README_fr.md) de l'application, voici des astuces utiles.

## Mise à jour automatique du contenu du site.
L'application crée un nouvel utilisateur avec des droits limités : il peut se connecter (avec un mot de passe) en SFTP pour accéder au dossier `/var/www/my_webapp` (ou `/var/www/my_webapp__<numero>` s'il y a plusieurs installations de cette application).

Cette configuration oblige à mettre à jour le contenu du site à la main, avec une connexion à mot de passe.
Si vous souhaitez automatiser la mise à jour de votre site, il vous faut une possibilité de connexion sans mot de passe à taper (dite "non-interactive").

Voici les étapes à suivre pour y parvenir :

### Sur votre ordinateur
- Créez une paire de clés publique/privée, sur l'ordinateur client et SANS mettre de passphrase de protection. (exemple pour une clé RSA `ssh-keygen -t rsa -b 4096`)

>Par défaut vos clés sont dans `~/.ssh/votre_cle` pour la clé privée et `~/.ssh/votre_cle.pub` pour la clé publique.

- Ouvrez un terminal
- Connectez-vous en SSH sur votre serveur YunoHost `ssh -p XXX admin@ndd` (`-p` est optionnel, si vous avez changé le port SSH par défaut)
- Activez la connexion par clé publique, dans `/etc/ssh/sshd_config` (si ce n'est pas déja fait), avec la commande `nano /etc/ssh/sshd_config`
```
PubkeyAuthentication yes
```
- Entrez CTRL+X pour sauvegarder
- Entrez `sudo service sshd restart` pour prendre en compte les nouveaux paramètres
- Passez en `root` via la commande `sudo -i`

>ATTENTION : Vous avez maintenant tous les droits sur votre serveur.

- Créez un dossier `.ssh` dans `/var/www/my_webapp(__#)` ou `/var/www/my_webapp` (si votre site est à la racine de votre nom de domaine) (ex : `mkdir /var/www/my_webapp/.ssh`)
- Placez-vous dans ce dossier (ex: `cd /var/www/my_webapp/.ssh`)
- Créez un fichier `authorized_keys` via la commande `nano authorized_keys`
- Collez le contenu de `votre_cle.pub` générée à la première étape
- Replacez-vous dans le dossier `my_webapp` (`cd ./..` ou `cd /var/www/my_webapp`)
- Rendez l'utilisateur `my_webapp` propriétaire du fichier et du dossier `chown -hR my_webapp .ssh`
- Vérifiez, avec la commande `ls -l -a`, que vous obtenez :
```
root@ndd:/var/www/my_webapp# ls -l -a
total 16
drwxr-x---+  4 root      root     4096 Jan 12 10:56 .
drwxr-xr-x+ 14 root      root     4096 Jan 12 10:47 ..
drwxr-xr-x   2 my_webapp root     4096 Jan 12 10:57 .ssh
drwxr-xr-x   2 my_webapp www-data 4096 Jan 12 10:47 www

```
- Ouvrez un autre terminal et testez la connexion via la commande `sftp -i ~/.ssh/votre_cle -P XXXX my_webapp@ndd`
```
user@pc_client:~$ sftp -i ~/.ssh/votre_cle -P XXXXX my_webapp@ndd
Debian GNU/Linux 11
Connected to ndd.
sftp>
```

>Les options `-i` et `-P` ne sont pas obligatoires si vous avez une seule clé générée et/ou si votre port est le port 22, c'est-à-dire le port par défaut.

Vous pouvez maintenant vous connecter sans mot de passe, avec `sftp -b`, `lftp` ou bien d'autres clients SFTP.

>NB : Le numéro de port à utiliser pour la connection SFTP est celui utilisé pour le SSH, et configuré dans `/etc/ssh/sshd_config`.

Cette astuce vous permet de mettre à jour automatiquement votre site. Par exemple, le Makefile de l'outil Pelican vous permet d'utiliser `make ftp_upload`.
