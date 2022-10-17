---
title: Créer une image du système
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/clone_filesystem'
page-toc:
  active: true
  depth: 3
---

!! Les images de cette page sont manquantes

L'outil de sauvegarde de YunoHost ne sauvegarde que les fichiers utiles et se base sur des scripts de restauration pour réinstaller les dépendances de vos applications. Autrement dit, le mécanisme de YunoHost revient à réinstaller, puis réincorporer les données.

Réaliser des images complètes du système peut être un moyen complémentaire ou alternatif de sauvegarder votre machine. L'intérêt est que votre système pourra être restauré dans l'état exact du moment de la sauvegarde.

Selon votre type d'installation, vous pouvez soit créer un snapshot, soit cloner le support de stockage en le retirant de votre serveur (éteint).

## Déclencher un snapshot
Un snapshot permet de figer une image du système de fichiers. Les snapshots sont très pratiques lorsque l'on fait une mise à jour ou des essais, car ils vous permettent de revenir facilement en arrière en cas de pépin. En revanche, en dehors de quelques clusters de très haute disponibilité, les snapshots ne vous protègent pas vraiment face à des pannes matérielles ou des catastrophes (cf. incendie d'OVH à Strasbourg en 2021).

En général, les snapshots sont assez économes en espace disque, le principe est que votre système de fichier va stocker les différences survenues depuis votre snapshot. Ainsi, seules les modifications consomment de l'espace.

! Pensez à supprimer les anciens snapshots pour éviter de gâcher votre espace de stockage en stockant toutes les différences depuis cette date !

Vous pouvez utiliser cette méthode avec la plupart des VPS (souvent payant), des gestionnaires de machines virtuelles ou si vous avez installé YunoHost avec un filesystem avancé comme btrfs, ceph ou ZFS, vous pouvez aussi créer des snapshots via la ligne de commande

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="VPS"]
Ci-dessous, quelques documentations pour les fournisseurs les plus connus:
 * [DigitalOcean (EN)](https://docs.digitalocean.com/products/images/snapshots/)
 * [Gandi](https://docs.gandi.net/fr/simple_hosting/operations_courantes/snapshots.html)
 * [OVH](https://docs.ovh.com/fr/vps/snapshot-vps/)
 * [Scaleway (EN)](https://www.scaleway.com/en/docs/backup-your-data-with-snapshots/)
[/ui-tab]
[ui-tab title="VirtualBox"]
Sélectionner la machine virtuelle et cliquer sur `Snapshots`, puis spécifier le nom du snapshot et cliquer sur `OK`.
![Le bouton snapshot se trouve en haut à droite](image://virtualbox-snapshot2.webp)

Pour restaurer, sélectionner la machine virtuelle, cliquer sur `Snapshots` puis `Restore Snapshot option`.
![](image://virtualbox-snapshot3.webp)

Ensuite cliquer sur `Restore Snapshot`.
![](image://virtualbox-snapshot4.webp)
[/ui-tab]
[ui-tab title="Proxmox"]

 * Sélectionner la machine virtuelle
 * Aller dans l'onglet `Backup`
 * Cliquer sur `Backup now`
 * Choisir le mode `Snapshot`
 * Valider
[/ui-tab]
[ui-tab title="BTRFS"]
Ci-dessous on considère que `/pool/volume` est le volume à snapshoter.

Créer un snapshot en lecture seule
```
btrfs subvolume snapshot /pool/volume /pool/volume/$(date +"%Y-%m-%d_%H:%M")
```

Lister les snapshots
```
btrfs subvolume show /pool/volume
```

Restaurer un snapshot
```
btrfs sub del /pool/volume
btrfs sub snap /pool/volume/2021-07-22_16:12 /pool/volume
btrfs sub del /pool/volume/2021-07-22_16:12
```

Supprimer un snapshot
```
btrfs subvolume delete /pool/volume/2021-07-22_16:12
```
!! Attention de ne pas supprimer le volume original

!!! Voir [ce tutoriel](https://www.linux.com/training-tutorials/how-create-and-manage-btrfs-snapshots-and-rollbacks-linux-part-2/) pour plus d'info
[/ui-tab]
[ui-tab title="CEPH"]
Ci-dessous on considère que `pool/volume` est le volume à snapshoter.

Créer un snapshot
```
rbd snap create pool/volume@$(date +"%Y-%m-%d_%H:%M")
```

Lister les snapshots
```
rbd snap ls pool/volume
```

Restaurer un snapshot
```
rbd snap rollback pool/volume@2021-07-22_16:22
```

Supprimer un snapshot
```
rbd snap rm pool/volume@2021-07-22_16:12
```
[/ui-tab]
[ui-tab title="ZFS"]
Ci-dessous on considère que `pool/volume` est le volume à snapshoter.

Créer un snapshot
```
zfs snapshot pool/volume@$(date +"%Y-%m-%d_%H:%M")
```

Lister les snapshots
```
zfs list -t snapshot -o name,creation
```

Restaurer un snapshot
```
zfs rollback pool/volume@2021-07-22_16:22
```

Supprimer un snapshot
```
zfs destroy pool/volume@2021-07-22_16:12
```

[/ui-tab]
[/ui-tabs]


## Créer une image du système de fichier à froid

Vous pouvez cloner votre support (carte SD, disque ssd, volume de VPS...) pour créer une image disque. Cette image avant compression sera de la taille exacte de votre support, c'est pourquoi cette méthode s'applique plutôt aux machines de moins de 64Go.

À moins de pouvoir lire un snapshot, cette méthode nécessite d'arrêter le serveur le temps de créer l'image. Avec un VPS, il faut redémarrer en mode rescue depuis l'interface de votre fournisseur.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Avec USBimager"]
Ceci peut être effectué avec [USBimager](https://bztsrc.gitlab.io/usbimager/) (N.B. : assurez-vous de télécharger la version 'Read-write' ! Pas la version 'Write-only' !). Le processus consiste ensuite à "l'inverse" du processus de flashage de la carte SD:
- Éteignez votre serveur
- Récupérez la carte SD et branchez-la dans votre ordinateur
- Dans USBimager, cliquez sur "Read" pour créer une image ("photographie") de la carte SD. Vous pouvez utiliser le fichier obtenu pour plus tard restaurer le système en entier.

Plus de détails dans [la doc d'USBimager](https://gitlab.com/bztsrc/usbimager/#creating-backup-image-file-from-device)
[/ui-tab]
[ui-tab title="En ligne de commande avec dd"]

Il est possible d'obtenir la même chose avec `dd` si vous êtes à l'aise avec la ligne de commande:

```bash
dd if=/dev/mmcblk0 | gzip > ./my_snapshot.gz
```

(remplacez `/dev/mmcblk0` par le vrai nom de votre carte SD ou disque dur)

[/ui-tab]
[/ui-tabs]

