# Les sauvegardes

**Pr�requis :** v�rifier que le dossier "archives" existe bien dans le dossier "/home/yunohost.backup/" 
sinon le cr�er via un 
```bash
sudo mkdir /home/yunohost.backup/archives
```
Lancer la sauvegarde via 
```bash
sudo yunohost backup create
```
Un fichier portant un num�ro et une extension .tar.gz est cr�e
(exemple 1452694078.tar.gz)

Cette archive contient une copie des dossiers suivants et fichiers de configurations dans les r�pertoires suivants
- cron
- home (car les donn�es d'owncloud se trouvent dans /home/yunohost.apps/owncloud par exemple)
- ldap
- mail
- mysql
- nginx
- ssh
- ssowat
- xmpp
- yunohost

Cette sauvegarde sous forme d'archive est � copier sur un autre support (disque dur externe, r�pertoire r�seau...)