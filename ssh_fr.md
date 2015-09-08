#SSH
Le **SSH** permet de commander à distance son serveur en ligne de commande (CLI).

##### Pour se connecter à son serveur :
```bash
ssh admin@mon-serveur.org
```

Ensuite, il est demandé le mot de passe administrateur, celui créé à [l’étape de post-installation](postinstall_fr).

#### Variable si port SSH autre que le port par défaut 22
#### remplacer 'XXXX' par le chiffre du port concerné
```bash
ssh -p XXXX admin@mon-serveur.org
```
