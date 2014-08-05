#Configuration box/routeur

####Accès à l’administration de la box/routeur
Dans la barre d’URL de votre navigateur web entrez :
```bash
192.168.0.1 ou 192.168.1.1
```
Il faut ensuite s’authentifier.

####L’ouverture des ports
L’ouverture des ports suivants sont nécessaire au fonctionnement des différents services.

TCP : 22, 25, 53, 80, 443, 465, 993, 5222, 5269, 5290

#####UPnP

L’UPnP permet d’ouvrir automatiquement les ports.
#####Ouverture manuelle de ports

Dans le cas où l’UPnP ne fonctionne pas l’ouverture manuelle des ports est nécessaire.

#####Le courrier électronique

Les Fournisseurs d’accès à Internet bloquent le port 25 pour éviter le spam. Pour pouvoir envoyer des emails, il faut donc l’ouvrir le port 25.