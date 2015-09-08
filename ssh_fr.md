#SSH
Le **SSH** permet de commander à distance son serveur en ligne de commande (CLI).

##### Pour se connecter à son serveur :
```bash
ssh admin@mon-serveur.org
```
Ensuite, il est demandé le mot de passe administrateur, celui créé à [l’étape de post-installation](postinstall_fr).

##### Se connecter à un port différent du port par défaut 22
Éditer la ligne `Port 22` du fichier `/etc/ssh/sshd_config`, puis connectez-vous :
```bash
ssh -p <port> admin@mon-serveur.org
```