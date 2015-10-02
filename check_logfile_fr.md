#Consulter les fichiers de log du système

## Accéder à un fichier de log

### Accéder aux logs par l'interface d'administration

[admin_fr]

### En ligne de commande
Un fichier de log est un simple fichier texte utilisé par certains programmes du système (et notamment les services) pour écrire des messages tout au long de leur fonctionnement. Consulter un fichier de log consiste donc à afficher son contenu pour lire les messages qui s'y trouve.

Pour accéder aux fichiers de log, la méthode traditionnelle consiste à [accéder au serveur en ligne de commande grace à ssh](ssh_fr). Un fois connecté, uilisez la commande [tail] qui affiche seulement la fin du fichier : les fichiers de log sont très long et seules les commandes finales nous intéressent car ce sont les plus récentes.

```bash
sudo tail -f chemin/du/fichier/log
```bash
Par exemple pour le fichier de log concernant les services de messagerie électronique:
```
sudo tail -f /var/log/mail.log
```
affiche une sortie dans laquelle chaque ligne est un message écrit par un service lié aux mail:
```bash
Oct  2 14:45:56 gwatary dovecot: imap(elie): Warning: autocreate plugin is deprecated, use mailbox { auto } setting instead
Oct  2 14:45:56 gwatary dovecot: imap(elie): Disconnected: Logged out in=92 out=949
Oct  2 14:46:56 gwatary dovecot: imap-login: Login: user=<elie>, method=PLAIN, rip=::1, lip=::1, mpid=4738, secured, session=<+f+AliMh4wAAAAAAAAAAAAAAAAAAAAAB>
Oct  2 14:46:56 gwatary dovecot: imap(elie): Warning: autocreate plugin is deprecated, use mailbox { auto } setting instead
Oct  2 14:46:56 gwatary dovecot: imap(elie): Disconnected: Logged out in=92 out=949
```


## Liste des services

### Services courriels

postfix

dovecot

mail.log

amavis

### Serveur web

nginx

php5-fpm

### Serveur XMPP metronome

metronome

### Surveillance du serveur

glances

### Bases de données

mysql

postgrey

### ssh

### yunohost-api

### Torrents

transmission-daemon

### LDAP

slapdStatut

### DNS

bind9



