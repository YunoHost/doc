# Les sauvegardes

**Prérequis :** vérifier que le dossier "archives" existe bien dans le dossier "/home/yunohost.backup/" 
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
- home (car les données d'owncloud se trouvent dans /home/yunohost.apps/owncloud par exemple)
- ldap
- mail
- mysql
- nginx
- ssh
- ssowat
- xmpp
- yunohost

Cette sauvegarde sous forme d'archive est à copier sur un autre support (disque dur externe, répertoire réseau...)