#Installation guide

You have to ways to install YunoHost:

1. With an USB key or a CD-ROM (below guide)
2. [On an existing Debian](/#/install_on_debian)

### Pre-requisite

* An x86 [compatible machine](/#/compatible_hardware) dedicated to YunoHost. Be careful not to have any unsaved data on it.
* Another computer to read this guide and access to your server.
* A [reasonable ISP](/#/isp), with a good upload bandwidth, unlimited download/upload, and tolerant to self-hosting.
* A USB key (via [Unetbootin](http://unetbootin.net/more-infos-and-get-it/)) or a CD burned with the latest YunoHost ISO: http://build.yunohost.org

### Boot on CD-ROM drive or USB key

Boot up your server with you USB key or your CD-ROM inserted, and choose it as bootable device by pressing one of the following key (hardware specific): ```<ESC>```, ```<F8>```, ```<F10>```, ```<F11>```, ```<F12>``` ou ```<SUPPR>```


### Installation process

**TODO**: English !

Branchez la machine en **ethernet** sur votre routeur.

Sélectionnez «**Graphical Install**», puis suivez les instructions. Vous aurez à choisir la langue du système ainsi que l’agencement du clavier, puis vous devrez confirmer le formatage **complet** du disque dur.

L'installation se déroulera ensuite toute seule, en téléchargeant automatiquement les paquets requis.

Si cette étape ne se déroule pas correctement, vous avez probablement un problème de connexion. Vérifiez alors que votre connexion Internet fonctionne.


### Post-installation

Votre machine devrait redémarrer automatiquement après l'installation. À la fin du démarrage de votre nouveau système YunoHost, l'**adresse IP** de votre serveur devrait s'afficher, ainsi qu'une proposition de post-installation (en anglais «**proceed to post-installation ?**»).

Vous pouvez alors soit:
* vous connecter sur http://x.x.x.x (**x.x.x.x** correspondant à votre **adresse IP**) depuis une autre machine et suivre les instructions de post-installation.
* exécuter la post-installation en ligne de commande en tapant sur la touche entrée sur votre serveur.

Deux paramètres vous seront demandés:

1. **Nom de domaine**: Vous devez choisir un nom de domaine qui pointera vers l'adresse IP de votre instance YunoHost. Si vous choisissez un nom de domaine terminant par **.nohost.me** ou **.noho.st**, l'étape de configuration des DNS se fera automatiquement et vous n'aurez qu'à attendre 3 minutes à la fin de la post-installation. Si vous optez pour pour un autre nom de domaine, vous devrez l’avoir préalablement acheté et [configuré](#/dns_fr) pour qu'il pointe vers votre **adresse IP**.

2. **Mot de passe administrateur**: C’est le mot de passe qui vous permettra d’administrer votre instance YunoHost, **choisissez-le avec attention**, il ne doit pas être divulgué ni être devinable, sinon vous pourrez perdre votre système.

La post-install se déroulera ensuite automatiquement et pourrez accéder à l'interface d'administration via **https://votre-domaine.org/ynhadmin**