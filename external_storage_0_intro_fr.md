# Stockage externe

## Introduction

Si vous n'avez pas dédié une grande partition à `/home` avant d'installer YunoHost, et que vos applications nécessitent beaucoup d'espace disque, vous pouvez toujours ajouter un disque externe *a posteriori*.

Cet article prend l'exemple de la migration du répertoire `data` de Nextcloud. Il se veut cependant modulaire, et vous pouvez suivre les instructions qui suffisent à vos besoins. Vous pourrez ainsi suivre les étapes pour préparer un disque dur vierge, monter ce même disque dur ou un autre avec des données déjà présentes, et enfin migrer les données de Nextcloud.

## Préalables

Attention, les étapes à réaliser, même si elles sont relativement simples, peuvent parfois paraître techniques et nécessitent dans tous les cas **de prendre son temps**.

Vous devez également être root sur votre système (avec la commande su ou sudo -i).

Il est recommandé de **faire un backup** de votre installation https://yunohost.org/#/backup; ou alors de copier l'image de votre carte sd ou disque dur.

Vous devez également disposer d'un disque dur supplémentaire (branché en usb ou en sata).

## Etapes

1. [Préparer un disque dur](/external_storage_1_prep_fr)

2. [Monter un disque dur avec `/etc/fstab`](/external_storage_2_mount_fr)

3. [Migrer les données et modifier la configuration de Nextcloud](external_storage_3_migrate_fr)

**Sources**

[https://soozx.fr/deplacer-repertoire-donnees-data-nextcloud-sur-disque-externe/](https://soozx.fr/deplacer-repertoire-donnees-data-nextcloud-sur-disque-externe/)

[https://max-koder.fr/2017/07/19/yunohost-nextcloud-sur-un-disque-dur-externe/](https://max-koder.fr/2017/07/19/yunohost-nextcloud-sur-un-disque-dur-externe/)

[https://doc.ubuntu-fr.org/tutoriel/comment_ajouter_un_disque_dur](https://doc.ubuntu-fr.org/tutoriel/comment_ajouter_un_disque_dur)

[https://www.it-connect.fr/ajouter-un-disque-dur-sous-linux/](https://www.it-connect.fr/ajouter-un-disque-dur-sous-linux/)
