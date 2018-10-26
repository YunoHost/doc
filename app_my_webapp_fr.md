# Documentation My_webapp
En complément du Readme.md de l'application, voici des astuces utiles.
## login non-interactif
L'application crée un nouvel utilisateur, avec des droits très limités : utilisation de sftp, et accès au dossier `/var/www/my_webapp(__#)` (où # est un numéro s'il y a plusieurs installations de cette appli).
Le login par mot de passe est activé, avec un Chroot vers le dossier. Cette configuration oblige à mettre à jour le contenu du site à la main, avec une connexion à mot de passe.
Pour utiliser une connextion sans mot de passe (dite "non-interactive"), voilà les étapes à suivre :
- Activer la connexion par clé publique, dans `/etc/ssh/sshd_config`, sur le serveur
- Créer une paire clé publique/privée pour votre script, sur l'ordinateur "de rédaction".
- Copier la clé publique sur le serveur, dans `/var/www/my_webapp(__#)/.ssh/authorized_keys`
- Changer le propriétaire du fichier et du dossier à l'utilisateur `webapp#` 
- Vous pouvez maintenant vous connecter sans mot de passe, avec `sftp -b`, `lftp` ou bien d'autres clients SFTP.

NB : Le numéro de port à utiliser pour la connection SFTP est celui utilisé pour le SSH, et configuré dans `/etc/ssh/sshd_config`.

Cette asctuce vous permet de mettre à jour automatiquement votre site. Par exemple, le makefile de l'outil Pelican vous permet d'utiliser `make ftp_upload`.
