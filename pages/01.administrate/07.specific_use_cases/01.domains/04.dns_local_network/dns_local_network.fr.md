---
title: Accéder à son serveur depuis le réseau local
template: docs
taxonomy:
  category: docs
routes:
  default: '/dns_local_network'
---

Après installation de votre serveur, il est possible que votre nom de domaine ne soit pas accessible depuis le réseau local où se trouve le serveur. Ceci est un problème connu sous le nom de [hairpinning](http://fr.wikipedia.org/wiki/Hairpinning) - une fonctionnalité mal supportée par certaines box internet.

Pour résoudre ce problème:
- il est nécessaire de configurer le DNS de votre routeur 
- à défaut, il est possible de modifier le ou les fichiers /etc/hosts de vos ordinateurs clients.

### Trouver l’adresse IP locale du serveur

Tout d'abord il vous faut trouver l'adresse IP locale du serveur
- soit en utilisant l'une de astuces expliquées [ici](/finding_the_local_ip)
- ou en utilisant la webadmin, dans l'écran Diagnostic, section Connexion Internet, IPv4, cliquer sur 'Détails' et vous devriez trouver une entrée pour 'IP locale'.
- ou en ligne de commande sur le serveur: `hostname -I`

## Configurer le DNS de la box

L'idée ici est de créer une redirection qui sera active sur tout votre réseau. Le but est de créer une redirection DNS vers l'ip de votre serveur YunoHost dans votre box. Il faut donc accéder à l'interface de configuration de votre box et aux paramétrages DNS, puis créer la redirection locale (par exemple, `yunohost.local` renvoi sur `192.168.1.21`).

### Box SFR

Si vous ne disposez toujours pas de l’adresse IP privée de votre serveur, vous pouvez la trouver sur l’interface de votre box SFR :  
    Dans l’onglet Réseau puis Général
<img src="/images/ip_serveur.png" width=800>

#### Configurer le DNS de la box SFR
Rendez-vous dans l’onglet Réseau puis DNS pour ajouter votre nom de domaine au DNS de la box.
<img src="/images/dns_9box.png" width=800>

## Configurer le fichier [hosts](http://fr.wikipedia.org/wiki/Hosts) de l’ordinateur client

La modification du fichier hosts devrait être effectuée seulement si vous ne pouvez pas modifier le DNS de votre box ou de votre routeur, car le fichier hosts impactera uniquement l’ordinateur sur lequel le fichier est modifié.

- Sous Windows, vous trouverez le fichier hosts ici :
    `%SystemRoot%\system32\drivers\etc\`
    > Il est nécessaire d’afficher les fichiers cachés et systèmes pour voir le fichier hosts.
- Sous les systèmes UNIX (GNU/Linux, macOS), vous le trouverez ici :
    `/etc/hosts`
    > Les droits root sont nécessaires pour modifier le fichier.

Ajoutez simplement à la fin du fichier hosts une ligne contenant l’adresse IP privée du serveur suivi de votre nom de domaine

```bash
192.168.1.62	domain.tld
```
