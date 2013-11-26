#Guide d'installation

Vous disposez de deux moyens pour installer YunoHost:

1. Installation via CD-ROM ou USB (guide ci-dessous)
2. [Installation sur Debian](/#/install_on_debian_fr)

### Prérequis

* Une [machine compatible](/#/compatible_hardware_fr) qui sera dédiée à YunoHost. Vérifiez donc de ne plus avoir de données importantes dessus.
* Une autre machine pour consulter ce guide et accéder à votre serveur.
* Une [connexion Internet correcte](/#/isp_fr), un débit montant raisonnable, et un fournisseur d’accès tolérant l'auto-hébergement.
* Avoir téléchargé l’image iso de YunoHost en [32bit](http://build.yunohost.org/yunohostv2-beta2-i386.iso) ou [64bit](http://build.yunohost.org/yunohostv2-beta2-amd64.iso) (prenez 32bit dans le doute)
* Avoir gravé l’image iso sur un CD ou copié le contenu sur une clé USB (via [Unetbootin](http://unetbootin.net/more-infos-and-get-it/))

### Démarrer sur le CD-ROM/la clé USB

Démarrez votre machine en ayant préalablement inséré votre CD-ROM YunoHost ou votre clé USB, et choisissez-le comme prériphérique de démarrage, généralement via les touches ```<ESC>```, ```<F8>```, ```<F10>```, ```<F11>```, ```<F12>``` ou ```<SUPPR>```


### Déroulement de l'installation

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

1. **Nom de domaine**: Vous devez choisir un nom de domaine qui pointera vers l'adresse IP de votre instance YunoHost. Si vous choisissez un nom de domaine terminant par **.nohost.me** ou **.noho.st**, l'étape de configuration des DNS se fera automatiquement et vous n'aurez qu'à attendre 3 minutes à la fin de la post-installation. Si vous optez pour pour un autre nom de domaine, vous devrez l’avoir préalablement acheté et [configuré](∕#/dns_fr) pour qu'il pointe vers votre **adresse IP**.

2. **Mot de passe administrateur**: C’est le mot de passe qui vous permettra d’administrer votre instance YunoHost, **choisissez-le avec attention**, il ne doit pas être divulgué ni être devinable, sinon vous pourrez perdre votre système.

La post-install se déroulera ensuite automatiquement et pourrez accéder à l'interface d'administration via **https://votre-domaine.org/ynhadmin**