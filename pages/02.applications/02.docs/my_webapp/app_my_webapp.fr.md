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
L'application créée un nouvel utilisateur avec des droits limités : il peut se connecter (avec un mot de passe) en SFTP pour accéder au dossier `/var/www/my_webapp` (ou `/var/www/my_webapp__<numero>` s'il y a plusieurs installations de cette appli).

Cette configuration oblige à mettre à jour le contenu du site à la main, avec une connexion à mot de passe.
Si vous souhaitez automatiser des choses, il vous faut une possibilité de connexion sans mot de passe à taper (dite "non-interactive").

Voici les étapes à suivre pour y arriver :

### Sur votre ordinateur
- Créer une paire clé publique/privée, sur l'ordinateur "de rédaction" ET sans mettre de passphrase de protection. (exemple pour une clé RSA `ssh-keygen -t rsa -b 4096`)

>Par défaut vos clés sont dans `~/.ssh/votre_cle` pour la clé privée et `~/.ssh/votre_cle.pub` pour la clé publique.

- Ouvrir un terminal,
- connecter vous en SSH sur votre serveur Yunohost `ssh -p XXX admin@ndd` (`-p` est optionnel, si vous avez changé le port SSH par défaut),
- Activer la connexion par clé publique, dans `/etc/ssh/sshd_config` (si ce n'est pas déja fait), avec la commande `nano /etc/ssh/sshd_config`,
```
PubkeyAuthentication yes
```
- CTRL+X pour sauvegarder
- `sudo service sshd restart` pour prendre en compte les nouveaux paramètres.

- Passer en `root` via la commande `sudo -i`,

>ATTENTION : Vous avez maintenant tous les droits sur votre serveur.

- Créer un dossier `.ssh` dans `/var/www/my_webapp(__#)` ou `/var/www/my_webapp` (si votre site est à la racine de votre ndd) (ex : `mkdir /var/www/my_webapp/.ssh`),
- placez vous dans ce dossier (ex: `cd /var/www/my_webapp/.ssh`),
- Créer un fichier `authorized_keys` via la commande `nano authorized_keys`,
- Coller le contenu de `votre_cle.pub` généré à l'étape XX,
- Replacez-vous dans le dossier `my_webapp` (`cd ./..` ou `cd /var/www/my_webapp`),
- Rentre l'utilisateur `my_webapp` propriétaire du fichier et du dossier `chown -hR my_webapp .ssh`,
- Vérifier avec la commande suivante `ls -l -a` vous devriez obtenir :
```
root@ndd:/var/www/my_webapp# ls -l -a
total 16
drwxr-x---+  4 root      root     4096 Jan 12 10:56 .
drwxr-xr-x+ 14 root      root     4096 Jan 12 10:47 ..
drwxr-xr-x   2 my_webapp root     4096 Jan 12 10:57 .ssh
drwxr-xr-x   2 my_webapp www-data 4096 Jan 12 10:47 www

```
- Ouvrer un autre terminal et tester la connexion via la commande `sftp -i ~/.ssh/votre_cle -P XXXX my_webapp@ndd`.
```
user@pc_de_redaction:~$ sftp -i ~/.ssh/votre_cle -P XXXXX my_webapp@ndd
Debian GNU/Linux 10
Connected to ndd.
sftp>
```

>Les options `-i` et `-P` ne sont pas obligatoires si vous avez une seule clé générée et/ou si votre port et le 22 par défaut.

Vous pouvez maintenant vous connecter sans mot de passe, avec `sftp -b`, `lftp` ou bien d'autres clients SFTP.

>NB : Le numéro de port à utiliser pour la connection SFTP est celui utilisé pour le SSH, et configuré dans `/etc/ssh/sshd_config`.

Cette astuce vous permet de mettre à jour automatiquement votre site. Par exemple, le Makefile de l'outil Pelican vous permet d'utiliser `make ftp_upload`.
