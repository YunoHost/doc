# Les sauvegardes

**Prérequis :** vérifier que le dossier `archives` existe bien dans le dossier `/home/yunohost.backup/`
sinon le créer via un 
```bash
sudo mkdir /home/yunohost.backup/archives
```
Lancer la sauvegarde via 
```bash
sudo yunohost backup create
```
Un fichier portant un numéro et une extension .tar.gz est crée
(exemple 1452694078.tar.gz)

Cette archive contient une copie des dossiers suivants et fichiers de configurations dans les répertoires suivants
- cron
- home (car les données d’owncloud se trouvent dans `/home/yunohost.apps/owncloud` par exemple)
- ldap
- mail
- mysql
- nginx
- ssh
- ssowat
- xmpp
- yunohost

Cette sauvegarde sous forme d’archive est à copier sur un autre support (support mémoire, répertoire réseau…)

Pour récupérer une sauvegarde depuis son serveur vers le /home de son ordinateur (avec 1234 comme port SSH ; avec IP_ou_NDD comme adresse IP [locale ou pas] ou NDD son Nom De Domaine ; avec $USER son nom d'utilisateur ; avec aaaammjj-hhmmss comme par exemple 20161002-084907 [nom de la sauvegarde YunoHost]) :
```bash
scp -P 1234 root@IP_ou_NDD:/home/yunohost.backup/archives/aaaammjj-hhmmss.tar.gz /home/$USER
scp -P 1234 root@IP_ou_NDD:/home/yunohost.backup/archives/aaaammjj-hhmmss.info.json /home/$USER
```

Sur le même principe que précédemment, envoyer une sauvegarde depuis le /home de son ordinateur vers son serveur (s'assurer que le dossier archive existe bien sinon lancer une première sauvegarde ou bien en dernier recours créer le dossier en root : mkdir /home/yunohost.backup/archives) :
```bash
scp -P 1234 /home/$USER/aaaammjj-hhmmss.info.json root@IP_ou_NDD:/home/yunohost.backup/archives
scp -P 1234 /home/$USER/aaaammjj-hhmmss.tar.gz root@IP_ou_NDD:/home/yunohost.backup/archives
```

# Pour restaurer une sauvegarde :
```bash
yunohost backup restore nom_de_la_sauvegarde
```
