# Documentation My_webapp

En complément du Readme.md de l'application, voici des astuces utiles.

## Mise à jour automatique du contenu du site.

L'application créée un nouvel utilisateur avec des droits limités : il peut se connecter (avec un mot de passe) en SFTP pour accéder au dossier `/var/www/my_webapp` (ou `/var/www/my_webapp__<numero>` s'il y a plusieurs installations de cette appli).

Cette configuration oblige à mettre à jour le contenu du site à la main, avec une connexion à mot de passe.

Si vous souhaitez automatiser des choses, il vous faut une possibilité de connexion sans mot de passe à taper (dite "non-interactive"). Voici les étapes à suivre pour y arriver :
- Activer la connexion par clé publique, dans `/etc/ssh/sshd_config`, sur le serveur
- Créer une paire clé publique/privée pour votre script, sur l'ordinateur "de rédaction" - sans mettre de phrase de passe de protection.
- Copier la clé publique sur le serveur, dans `/var/www/my_webapp(__#)/.ssh/authorized_keys`
- Rentre l'utilisateur `webapp#` propriétaire du fichier et du dossier
- Vous pouvez maintenant vous connecter sans mot de passe, avec `sftp -b`, `lftp` ou bien d'autres clients SFTP.

NB : Le numéro de port à utiliser pour la connection SFTP est celui utilisé pour le SSH, et configuré dans `/etc/ssh/sshd_config`.

Cette asctuce vous permet de mettre à jour automatiquement votre site. Par exemple, le makefile de l'outil Pelican vous permet d'utiliser `make ftp_upload`.


---------------------------

# <img src="/images/yunohost_package.png" height="80px" alt="Package"> Custom Webapp

[![Install Custom Webapp with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=my_webapp) [![Integration level](https://dash.yunohost.org/integration/my_webapp.svg)](https://dash.yunohost.org/appci/app/my_webapp)

### Index

- [Configuration](#configuration)
- [Limitations avec Yunohost](#limitations-avec-yunohost)
- [Applications clientes](#applications-clients)
- [Liens utiles](#liens-utiles)

**Présentation générale de l'application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**Si la configuration de l'application ne se fait pas avec le panel admin de YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations avec Yunohost

**Explication des limitations actuelles en utilisation l'application avec YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Applications clientes

| Nom de l'applications | Plateforme | Multi-comptes | Autre réseaux supportés | Play Store | F-Droid | Apple Store | *Autres* |
|-----------------------|------------|---------------|-------------------------|------------|---------|-------------|----------|
|                       |            |               |                         |            |         |             |          |

## Liens utiles

 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/my_webapp](https://github.com/YunoHost-Apps/my_webapp_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/my_webapp/issues](https://github.com/YunoHost-Apps/my_webapp_ynh/issues)
