# Rainloop

Rainloop est un webmail simple et léger. 
 
Pour le configurer après l'installation, veuillez vous rendre sur http://DOMAIN.TLD/rainloop/app/?admin 
 
- Le nom d'utilisateur admin par défaut est : admin
- Le mot de passe admin par défaut est : Mot de passe choisi lors de l'installation 
- Si vous avez oublié votre mot de passe, vous pouvez le retrouver avec ``sudo yunohost app settings rainloop password``
 
Chaque utilisateur peut ajouter un carnet d'adresse distant CardDav via leur propre paramètres.
 
- Si vous utilisez Baikal, l'adresse à renseigner est du type : https://DOMAIN.TLD/baikal/card.php/addressbooks/UTILISATEUR/default/ 
- Si vous utilisez NextCloud, l'adresse à renseigner est du type : https://DOMAIN.TLD/nextcloud/remote.php/carddav/addressbooks/USER/contacts

Rainloop stocke les clés PGP privées dans le stockage de navigateur. Cela implique que vos clés seront perdues quand vous videz le stockage de navigateur (navigation incognito, changement d'ordinateur, ...). Ce paquet intègre [PGPback de chtixof](https://github.com/chtixof/pgpback_ynh) pour que vous puissiez stocker vos clés privées PGP de manière sécurisée sur le serveur. Rendez-vous **http://DOMAIN.TLD/rainloop/pgpback** pour stocker vos clés privées PGP sur le serveur ou les restaurer dans un nouveau navigateur.

Pour mettre à jour rainloop lorsqu'une nouvelle version est disponible, lancez en console locale (ssh ou autre) :
``sudo yunohost app upgrade -u https://github.com/YunoHost-Apps/rainloop_ynh rainloop
