# Stockage externe

## Préalables

Attention, les étapes à réaliser, même si elles sont relativement simples, peuvent parfois paraître techniques et nécessitent dans tous les cas **de prendre son temps**.

Vous devez également être root sur votre système (avec la commande su ou sudo -i).

Il est recommandé de **faire un backup** de votre installation https://yunohost.org/#/backup; ou alors de copier l'image de votre carte sd ou disque dur.

Vous devez également disposer d'un disque dur supplémentaire (branché en usb ou en sata).

## Les objectifs de ce tutoriel

YunoHost installe le répertoire `data` de Nextcloud dans `/home/yunohost.app/nextcloud/`.

L'objet de cet article est de copier l'intégralité de ces données ailleurs pour augmenter son espace de stockage de données.

## Etapes

##### **1. Préparer un disque dur**

##### **2. Monter un disque dur avec `/etc/fstab`**

##### **3. Migrer les données et modifier la configuration de Nextcloud**

** Sources **

https://soozx.fr/deplacer-repertoire-donnees-data-nextcloud-sur-disque-externe/

https://max-koder.fr/2017/07/19/yunohost-nextcloud-sur-un-disque-dur-externe/

https://doc.ubuntu-fr.org/tutoriel/comment_ajouter_un_disque_dur

https://www.it-connect.fr/ajouter-un-disque-dur-sous-linux/
