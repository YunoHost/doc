# Ajouter un stockage externe à son serveur

## Introduction

Si vous n'avez pas dédié une grande partition à `/home` avant d'installer YunoHost, et que vos applications nécessitent beaucoup d'espace disque, vous pouvez toujours ajouter un disque externe *a posteriori*.

## Avant de commencer

Les étapes à réaliser, même si elles sont relativement simples, peuvent parfois paraître techniques et nécessitent dans tous les cas **de prendre son temps**.

Vous devez également être connecté en root sur votre système, par exemple via [SSH](/ssh). (Note : en étant connecté en tant qu'utilisateur `admin`, vous pouvez passer root avec `sudo su`)

Il peut être utile de [faire un backup](/backup) de votre installation.

Vous devez également disposer d'un disque dur supplémentaire (branché en USB ou en SATA).

## 1. Connecter et identifier le disque

Commencez par brancher ce disque dur à votre système. Il faut ensuite identifier sous quel nom est désigné le disque par le système.

Pour cela, utilisez la commande :

```bash
lsblk
```

Elle peut renvoyer quelque chose comme :

```bash
NAME        MAJ:MIN RM   SIZE RO TYPE MOUNTPOINT
sda           8:0    0 931.5G  0 disk
└─sda1        8:1    0 931.5G  0 part
mmcblk0     179:0    0  14.9G  0 disk
├─mmcblk0p1 179:1    0  47.7M  0 part /boot
└─mmcblk0p2 179:2    0  14.8G  0 part /
```

Ici, `mmcblk0` corresponds à une carte SD de 16Go (on voit que les partitions `mmcblk0p1` et `mmcblk0p2` correspondent à la partition de démarrage `/boot` et à la partition système `/`). Le disque dur branché corresponds à `sda` qui fait environ 1To, et contient une seule partition `sda1` qui n'est pas monté (pas de "MOUNTPOINT").

<div class="alert alert-warning" markdown="1">
<span class="glyphicon glyphicon-warning-sign"></span> Sur un autre système, il se peut que votre système soit installé sur `sda` et que votre disque soit alors `sdb` par exemple.
</div>

## 2. (Optionnel) Formater le disque

Cette opération est optionnelle si votre disque est déjà formaté.

Créons une nouvelle partition sur le disque :

```bash
fdisk /dev/VOTRE_DISQUE
```

puis entrez successivement `n`, `p`, `1`, `Entrée`, `Entrée`, et `w` pour créer une nouvelle partition.

Vérifiez avec `lsblk` que vous avez bien votre disque contenant une seule partition.

Avant de pouvoir utiliser votre disque, il doit être formaté.

Attention : **formater un disque implique de supprimer toutes les données inscrites dessus !** Si votre disque est déjà "propre", vous pouvez passer cette étape.

Pour formater la partition :

```bash
mkfs.ext4 /dev/VOTRE_DISQUE1
# puis 'y' pour valider
```

(Remplacez `VOTRE_DISQUE1` par le nom de la première partition sur le disque. Attention à ne pas vous tromper de nom, car cela peut avoir pour conséquence de formater un autre disque que celui voulu ! Dans l'exemple donné précédemment, il s'agissait de `sda`.)


## 3. Monter le disque

"Monter" un disque corresponds à le rendre effectivement accessible dans l'arborescence des fichiers. Nous allons choisir arbitrairement de monter le disque dans `/media/stockage` mais vous pouvez le nommer différement (par exemple `/media/mon_disque` ...).

Commençons par cŕeer le répertoire :
```bash
mkdir /media/stockage
```

Puis nous pouvons monter le disque manuellement avec :

```bash
mount /dev/VOTRE_DISQUE1 /media/stockage
```

(Ici, `/dev/VOTRE_DISQUE1` corresponds à la première partition sur le disque)

Ensuite, vous devriez pouvoir créer des fichiers dans `/media/stockage`, et, par exemple, ajouter `/media/stockage` comme périphérique externe dans Nextcloud.

## 4. Monter le disque automatiquement au démarrage

Jusqu'ici, nous avons monté manuellement le disque. Cependant, il peut être utile de configurer le système pour qu'il monte automatiquement le disque après un démarrage.

Pour commencer, trouvons l'UUID (identifiant universel) de notre disque avec :

```bash
blkid | grep "/dev/VOTRE_DISQUE1:"
# Retourne quelque chose comme :
# /dev/sda1:UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"
```

Ajoutons alors une ligne au fichier `/etc/fstab` qui gère le montage des disques au démarrage. On ouvre donc le fichier avec `nano` :

```bash
nano /etc/fstab
```

Puis on ajoute cette ligne :

```bash
UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" /media/stockage ext4 defaults,nofail 0 0
```

(il faut adapter cette ligne en fonction des informations et choix précédents)

Utiliser Ctrl+X puis `o` pour sauvegarder.

Vous pouvez ensuite tester de redémarrer le système pour voir si le disque est monté automatiquement.

