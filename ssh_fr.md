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

##### Quels utilisateurs?
Seul l’utilisateur admin peut se connecter en ssh aux serveur YunoHost. 

Les utilisateurs crées via l'interface d'administration de YunoHost sont gérés par l'annuaire LDAP et ne peuvent pas se connecter en ssh.

Si vous souhaitez avoir un autre utilisateur qu'admin pour vous connectez en ssh, il faut le créer depuis la ligne de commande (via l'utilisateur admin) comme n'importe quel utilisateur (commande adduser).

Rq : cet utilisateur ne sera pas utilisable depuis YunoHost. Il aura son propre répértoire /home, son propre groupe (cf les principes d'un utilisateur Linux classique et les différents tutoriaux sur le sujet dans toute bonne documentation sur l'administration sous Debian).

##### Sécurité et SSH

Voir la page dédiée [Sécurité et SSH](/security_fr)

