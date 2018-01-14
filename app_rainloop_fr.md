## English
Rainloop is a lightweight webmail. 
 
To configure it, go to http://DOMAIN.TLD/rainloop/app/?admin 
 
- The default login is : admin 
- The default password is : Password chosen during install 
- If you lost the admin password, you can retrieve it using ``sudo yunohost app settings rainloop password``
 
Each user can add a remote carddav server from their own parameters interface. 

- If you use baikal, the CardDav address is: https://DOMAIN.TLD/baikal/card.php/addressbooks/USER/default/
- If you use NextCloud, the CardDav address is: https://DOMAIN.TLD/nextcloud/remote.php/carddav/addressbooks/USER/contacts
 
Rainloop saves your PGP private keys in the browser storage. This means that you will loose your private keys if you clear your browser storage (e.g., private browsing, different computer...). This packages integrates [PGPback by chtixof](https://github.com/chtixof/pgpback_ynh) so you can store your PGP private keys on the server securely. Go to **http://DOMAIN.TLD/rainloop/pgpback** to backup your PGP keys on the server or restore them.

To upgrade the app once a new rainloop version is available, simply run in a local shell via ssh or otherwise :
``sudo yunohost app upgrade -u https://github.com/YunoHost-Apps/rainloop_ynh rainloop``

 
## Français 
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
``sudo yunohost app upgrade -u https://github.com/YunoHost-Apps/rainloop_ynh rainloop``