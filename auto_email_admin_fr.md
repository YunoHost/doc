Cet article recense les différents mails qui sont envoyés de façon automatique par différents traitements et processus automatisés depuis un serveur Yunohost.

# Prérequis - les alias mails

Dans l’espace d’administration de Yunohost, sur la fiche du premier utilisateur créé, il y a les alias mails suivants :

_Alias de courriel_

* root@mondomaine.fr
* admin@mondomaine.fr
* webmaster@mondomaine.fr
* postmaster@mondomaine.fr

Tout message envoyé à l’une de ces adresses est envoyé à l’adresse mail principale de l'utilisateur.

_Remarque : tous ces mails sont envoyés par le serveur de mail tournant sur Yunohost à lui-même (si les alias sont sur le domaine lié à la machine Yunohost), 
mais peuvent également être envoyés en copie à un mail extérieur, si le champ "Adresses de transfert" est également rempli._

# Les mails envoyés automatiquement par Yunohost

## Les mails de diagnostique automatique

* Expéditeur : Cron Daemon
* Sujet : ’Cron test -x /usr/sbin/anacron || ( cd / && run-parts —report /etc/cron.daily )’
* Destinataire : root@mondomaine.fr
* Corps du message : 
> Automatic diagnosis on mondomaine.fr ’Issues found by automatic diagnosis on mondomaine.fr’ The automatic diagnosis on your YunoHost server identified some issues on your server. You will find a description of the issues below. You can manage those issues in the ’Diagnosis’ section in your webadmin.

Depuis la version 3.8, Yunohost propose en graphique au sein de l’espace d’administration et en ligne de commande, un outil de diagnostique automatique assez complet
indiquant les décalages entre les réglages optimum pour un serveur et la situation réelle actuelle.

Ce rapport est envoyé par mail chaque 24h, si des erreurs ou des défauts sont trouvés, et qu'ils n'ont pas déjà été réglés à "ignorer".


## Renouvellement des certificats (Let’s Encrypt)

* Expéditeur : certmanager@mondomaine.fr
* Destinataire : root@mondomaine.fr
* Sujet : Certificate renewing attempt for mondomaine.fr failed !
* Corps du message : 
> An attempt for renewing the certificate for domain mondomaine.fr failed with the following
error : Certificate renewing for mondomaine.fr failed ! Here’s the tail of /var/log/yunohost/yunohost-cli.log, which might help to investigate :

Les domaines et sous-domaines pour lesquels le certificat autosigné a été remplacé par un certificat /Let’s Encrypt voient leurs certificats renouvellés de façon automatique. 
Parfois, le renouvellement peut présenter une erreur (temporaire ou  définitive) qui est ainsi envoyée à l'administrateur.

## Suite à l’installation d’une application

* Expéditeur : root
* Sujet :`etherpad_mypads` has just been installed
* Destinataire : root@mondomaine.fr
* Corps du message : 
> This is an automated message from your beloved YunoHost server. Specific information for the application etherpad_mypads.

Les outils de packaging de Yunohost permettent de proposer, à l’installation d’une nouvelle application, un envoi d'email sur le compte root avec les informations de l'opération.
A ce jour (Juillet 2020) seule l'application Etherpad_Mypads utilise cette fonction.

## Mail non envoyé

* Expéditeur : MAILER-DAEMON@mondomaine.fr
* Destinataire : genma@mondomaine.fr
* Sujet : Undelivered Mail Returned to Sender

Quand on utilise sa boite mail (et donc le serveur Yunohost comme serveur de mail) et qu’il y a eu un soucis à l’envoi du mail (destinataire inconnu ou autre...), celui-ci nous informe des erreurs.

# Les autres mails automatiques
## Message d’alerte connexion

* Expéditeur : user1@mondomaine.fr
* Sujet : *** SECURITY information for mondomaine.ynh.fr ***
* Corps du message : 
> yunohost : Apr 30 12:23:09 : user1 : 1 incorrect password attempt ; TTY=pts/1 ; PWD=/var/www/nextcloud/config ; USER=root ; COMMAND=/bin/nano config.php

Quand on tente de se connecter plusieurs fois via la commande `sudo` et que l’on fait une faute de frappe dans son mot de passe, le compte reçoit un mail pour informer de l’erreur (et de la potentielle tentative de bruteforce par exemple).

## Le bulletin de sécurité

* Expéditeur : daemon@mondomaine.fr
* Destinataire : root@mondomaine.fr
* Sujet : Debian security status of Yunohost

Non envoyé par défaut par Yunohost, ce mail est lié au paquet `Unattended Upgrades` qui peut être installé manuellement, pour avoir des mises à jour de sécurité automatique sur son serveur.
