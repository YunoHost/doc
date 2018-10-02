#Baïkal

Baïkal est un serveur de calendriers et de contacts accessible par les protocoles CalDAV (calendriers) et CardDAV (carnets d’adresses), autorisant ainsi la synchronisation avec de nombreux clients (Thunderbird + Lightning par exemple).

**AVERTISSEMENT** : Baikal ne fonctionnera pas si vous avez installé un **Nextcloud** ( leurs fonctions cardav/caldav entrent en conflit).

## Connexion à l’interface d’admin
Sur le portail SSO, si on clique sur la tuile « Baïkal », on tombe sur une page bien peu conviviale qui explique que le service fonctionne. Pour accéder à l’admin, il faut rajouter `/admin`. Par exemple :

https://example.com/baikal/admin

Le nom d’utilisateur à spécifier est « admin » suivi du mot de passe spécifique que vous avez choisi lors de l’installation de Baïkal. Attention, le mot de passe ne doit pas contenir de carractères spéciaux.

### Exemple de création d'un nouvel utilisateur :

Aller dans l'onglet « settings », sélectionner « Digest » dans « WebDAV authentication type ». 
Ajouter les utilisateurs dans  l'onglet « Users and  resources ».

## Connexion CalDAV

### Connexion de Thunderbird + Lightning

Ajoutez un nouvel agenda de type « Réseau » puis « CalDAV ».

L’URL à entrer est la suivante :

`https://example.com/baikal/cal.php/calendars/username/default`

*En prenant soin de remplacer « example.com » par votre domaine puis « username » par votre nom d’utilisateur*

### Connexion de AgenDAV

AgenDAV est un client web permettant de manipuler vos calendriers. Il est packagé pour YunoHost et vous pouvez donc l’installer juste après avoir installé Baïkal.

AgenDAV est déjà connecté à Baïkal, aucune manipulation n’est nécessaire. Si vous créez une entrée dans le calendrier Thunderbird + Lightning, il vous suffit d’actualiser votre page AgenDAV pour voir les modifications apparaître.

AgenDAV vous permet également de créer de nouveaux calendriers très simplement.

##Connexion CardDAV

### Connexion de Roundcube

Ajoutez un nouveau carnet d’adresses en allant dans Paramètres > Préférences > CardDAV.

Renseigner :
* Nom du carnet d’adresses : `default`
* Nom d’utilisateur : `username`
* Mot de passe : `leMotDePasseAssociéAUusername`
* URL : `https://example.com/baikal/card.php/addressbooks/username/default`

*En prenant soin de remplacer « example.com » par votre domaine et « username » par votre nom d’utilisateur*

Enregistrer

Le carnet d’adresses est maintenant accessible.
