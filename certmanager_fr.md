
Gestion du certificat
======================

Gérer les certificats avec YunoHost
-----------------------------------

La fonctionnalité principale du gestionnaire de certificat est de permettre l'installation
de certificat Let's Encrypt facilement sur vos domaines. Vous pouvez l'utiliser depuis
l'interface d'admin web (*Certificat SSL* sur la page d'info d'un domaine), ou avec
la ligne de commande avec `yunohost domain cert-status`, `cert-install` et `cert-renew`.

#### De quoi ai-je besoin pour avoir un certificat Let’s Encrypt ?

Votre serveur doit être accessible depuis le reste d'Internet sur le port 80 (et 443),
et le DNS de votre `nom.de.domaine.tld` doit être correctement configuré (i.e. le 
domaine doit pointer sur l'IP publique de votre serveur). Vous pouvez vous aider
de [cette documentation](diagnostic_fr) si vous avez besoin d'aide.

#### Est-ce que mon certificat sera renouvelé automatiquement ?

Oui. À l'heure actuelle, les certificats Let's Encrypt sont valides pendant 90 jours.
Une tâche automatique (cron job) sera exécutée tous les jours pour renouveler les certificats
qui expirent dans moins de 15 jours. Un email sera envoyé à l'utilisateur root si le
renouvellement échoue.

#### Je souhaite/j’ai besoin d’utiliser un certificat d’une autre autorité de certification

Ceci n'est pas géré automatiquement pour le moment. Il vous faudra créer manuellement
une demande de signature de certificat (CSR) qui devra être donné à votre CA, puis importer
le certificat obtenu. Plus d'informations sur [cette page](certificate_fr). Ce processus sera
peut-être rendu plus facile par YunoHost dans le futur.

Procédure de migration
--------------------

> À cause des [limitations actuelles](https://letsencrypt.org/docs/rate-limits/)
sur la fréquence d'émissions de nouveaux certificats Let's Encrypt, nous recommandons que
vous ne **migriez pas** vers cette nouvelle fonctionnalité **tant que vous n'en avez pas besoin**.
C'est en particulier vrai pour les utilisateurs de nohost.me / nohost.st (et d'autres services de
nom de domaine gratuit qui partagent un sous-domaine commun). Si trop de monde migrent 
pendant la même période, vous vous retrouverez peut-être bloqué avec un certificat auto-signé
pendant quelques jours !

#### J’ai utilisé l’application *letsencrypt_ynh*.

Il vous sera demandé de désinstaller l'application pour pouvoir utiliser la nouvelle gestion
de certificat. Vous pouvez procéder à la désinstallation depuis l'interface web, ou bien depuis
la ligne de commande avec :

```bash
yunohost app remove letsencrypt
yunohost domain cert-install
```

Soyez conscients que la première commande devrait remettre en place des certificats
auto-signés sur vos domaines. La deuxième commande tentera ensuite d'installer un certificat
Let's Encrypt sur chacun de vos domaines ayant un certificat auto-signé.

#### J’ai installé mes certificats Let’s Encrypt manuellement

Il vous faut aller dans la configuration nginx et retirer les fichiers `letsencrypt.conf` (ou le nom que
vous lui avez donné et qui contient un bloc `location '/.well-known/acme-challenge'`) pour chacun
de vos domaines. Retirez les liens symboliques vers vos certificats actuels :

```bash
rm /etc/yunohost/certs/your.domain.tld/key.pem
rm /etc/yunohost/certs/your.domain.tld/crt.pem
```

Puis tapez les commandes suivantes :

```bash
yunohost domain cert-install your.domain.tld --force --self-signed
yunohost domain cert-install your.domain.tld
```

pour chacun des domaines pour lesquels vous souhaitez avoir un certificat Let's Encrypt.

Finalement, supprimez la tâche automatique (certificateRenewer) dans `/etc/cron.weekly/`, 
et backupez puis supprimez le répertoire `/etc/letsencrypt/`.

Dépannage
---------------

#### L’interface d’admin bloque l’accès à l’interface de gestion du certificat en prétendant que l’app letsencrypt est installée, pourtant elle n’est pas là !

Assurez-vous que le cache du navigateur est bien rafraîchi (Ctrl + Shift + R sur Firefox).
Si cela ne résous pas le problème, rapportez votre expérience sur le bugtracker ou le forum.
Vous pouvez contourner le problème en utilisant la commande : 
`yunohost domain cert-install your.domain.tld`.

#### J’ai essayé de désinstaller l’application Let’s Encrypt, mais cela a cassé ma configuration nginx !

Désolé. Quelques utilisateurs ont rapporté que cela arrive lorsque le script de désinstallation ne trouve pas
de backup des certificats auto-signés. Utiliser `yunohost domain cert-install` devrait tout de même fonctionner…

#### J’obtiens "Too many certificates already issued", que se passe-t-il ?

Pour l'instant, Let's Encrypt a mis en place un taux limite d'émission de certificat, qui
est de 20 nouveaux certificats pendant une période de 7 jours pour un sous-domaine donné.
Par exemple, les domaines `nohost.me` et `noho.st` sont considérés comme des sous-domaines 
(des domaines `me` et `st`). ce qui veut dire que tous les utilisateurs du service nohost.me / noho.st
partagent une même limite commune. D'après Let's Encrypt, ceci s'applique aux *nouveaux* certificats,
mais pas aux renouvellements ou duplications. Si vous rencontrez ce message, il n'y a donc pas grand
chose à faire d’autre que ré-essayer dans quelques heures/jours.

#### L’installation du certificat échoue avec "Wrote file to 'un chemin', but couldn't download 'une url'" !

Cela devrait être réparé dans le futur, mais pour le moment vous pouvez tenter d'ajouter la ligne suivante
au fichier `/etc/hosts` du serveur :

```bash
127.0.0.1 your.domain.tld
```

À propos des certificats et de Let’s Encrypt
------------------------------------

#### Qu’est-ce que HTTPS ? À quoi servent les certificats SSL ?

HTTPS est la version sécurisée du protocole HTTP, qui décrit comment un client
(par ex. votre navigateur web) et un serveur (par ex. nginx qui tourne sur votre instance
YunoHost) peuvent discuter entre eux. HTTPS s'appuie fortement sur la [cryptographie
asymmétrique](https://en.wikipedia.org/wiki/Public-key_cryptography) pour garantir 
deux choses :
- la confidentialité, ce qui veut dire qu'un attaquant ne sera pas capable de déchiffrer le contenu d'une communication si elle est interceptée ;
- l'identification du serveur, ce qui veut dire qu'un serveur peut et doit prouver qui il prétend être, dans le but d'éviter les [attaques man-in-the-middle](https://en.wikipedia.org/wiki/Man-in-the-middle_attack).

Les certificats SSL sont utilisés par les serveurs pour prouver leur identité.
Le processus général repose sur la confiance en des tiers, appelés Autorité
de Certification (CA), dont le rôle est de vérifier l'identité d'un serveur (par ex.
qu'une machine donnée contrôle bien le domaine `jaimelecafe.com`) avant
de délivrer des [certificats cryptographiques](https://en.wikipedia.org/wiki/Public_key_certificate).

#### Pourquoi est-ce que les navigateurs se plaignent de mon certificat auto-signé ?

Les certificats auto-signés sont, comme leur nom l'indique, auto-signés, ce qui veut
dire que le serveur était sa propre autorité de certification lorsqu'il a créé le certificat.
Un tel certificat ne permet pas de vérifier et garantir l'identité du serveur, puisqu'il
aurait tout aussi pu être généré par un attaquant de son côté, dans le but de réaliser
une attaque man-in-the-middle.

#### Que se passe-t-il avec Let’s Encrypt ?

Historiquement, le processus de vérification de l'identité des serveurs demandait une
intervention humaine, donc du temps et de la monnaie.

En 2015, Let's Encrypt a développé un protocole nommé 
[ACME](https://en.wikipedia.org/wiki/Automated_Certificate_Management_Environment),
qui permet de vérifier automatiquement qu'une machine contrôle un domaine, et de
délivrer un certificat gratuitement, réduisant drastiquement le coût de mise en place
d'un certificat SSL.

#### Comment fonctionne Let’s Encrypt ?

Pour vérifier l'identité de votre serveur et délivrer un certificat, Let's Encrypt utilise
le [protocole ACME](https://en.wikipedia.org/wiki/Automated_Certificate_Management_Environment).
Il fonctionne grosso-modo de la manière suivante (simplifiée, mais vous comprendrez l'idée) :
- Un programme tourne sur votre serveur et contacte l'autorité de certification Let's Encrypt et
  lui demande un certificat pour le domaine `jaimelecafe.com`.
- L'autorité de certification Let's Encrypt génère une chaîne de caractères aléatoire comme `A84F2D0B`, et
  dit au programme sur votre serveur de prouver qu'il gère le domaine `jaimelecafe.com` en rendant l'URI 
  `http://jaimelecafe.com/.well-known/acme-challenge/A84F2D0B` accessible.
- Le programme sur votre serveur créé/modifie des fichiers en conséquence.
- La CA Let's Encrypt tente d'accéder à l'URI. Si cela fonctionne, elle conclue que le programme contrôle
  bien le domaine `jaimelecafe.com`, et lui délivre un certificat.
- Le programme sur votre serveur récupère le certificat et le met en place.

#### A-t-on vraiment besoin des autorités de certification ?

La dépendance aux autorités de certification peut être critiquée, car elles constituent des points centraux
vulnérables dans le schéma de sécurité. Certaines autorités ont été reconnues coupable d'avoir délivré
de faux certificats par le passé, parfois avec des implications sérieuses et très concrètes.
[[1](http://www.darkreading.com/endpoint/authentication/fake-google-digital-certificates-found-and-confiscated/d/d-id/1297165),
[2](https://reflets.info/microsoft-et-ben-ali-wikileaks-confirme-les-soupcons-d-une-aide-pour-la-surveillance-des-citoyens-tunisiens/)].

Des alternatives ont été proposées, comme [DANE/DNSSEC](https://en.wikipedia.org/wiki/DNS-based_Authentication_of_Named_Entities), 
qui repose sur les DNS et ne nécessite pas d'autorité de certification.
