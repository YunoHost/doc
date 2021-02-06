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
