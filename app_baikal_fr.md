#Baikal

Baikal est un serveur de calendriers et contacts accessible par les protocoles Caldav et Carddav, autorisant ainsi la synchronisation avec de nombreux clients (Thunderbird + Lightning par exemple).

### Connexion à l'interface d'admin
Sur le portail SSO, si on clique sur la tuile "Baikal", on tombe sur une page bien peu conviviale qui explique que le service fonctionne. Pour accéder à l'admin, il faut rajouter /admin. Exemple :

https://domain.org/baikal/admin

Le nom d'utilisateur a spécifier est "admin" suivi du mot de passe de l'utilisateur qui a été indiqué comme administrateur lors de l'installation de Baikal.

### Connexion de Thunderbird + Lightning

Ajoutez un nouvel agenda de type "Réseau" puis "Caldav".
L'URL à entrer est la suivante :

https://domain.org/baikal/cal.php/calendars/username/default

En prenant soin de remplacer "domain.org" par votre domaine puis "username" par votre nom d'utilisateur

### Connexion de AgentDav

AgentDav est déjà connecté à Baikal, aucune manipulation n'est nécessaire. Si vous créez une entrée dans le calendrier Thunderbird + Lightning, il vous suffit d'actualiser votre page AgentDav pour voir les modifications apparaitre.