# Préparer un disque dur

Commencez par brancher ce disque dur à votre système. Si vous souhaitez partir de zéro, si votre disque n'est pas formaté, il faut le formater.

**Attention** : Ne faites pas ces étapes s'il y a des données sur ce disque que vous souhaitez conserver. Passez directement à [l'étape de montage](/external_storage_2_mount_fr).

Commencez par trouver le nom de son disque avec la commande:

```
    fdisk -l
```

Vous devriez avoir un retour sous la forme de:

```
    Device         Boot    Start      End  Sectors   Size Id Type
    /dev/mmcblk0p1          8192   131071   122880    60M  c W95 FAT32 (LBA)
    /dev/mmcblk0p2        131072 30716288 30585217  14,6G 83 Linux
    /dev/mmcblk0p3      30716289 31116287   399999 195,3M 83 Linux

    Disk /dev/sda: 14,9 GiB, 16013852672 bytes, 31277056 sectors
    Units: sectors of 1 * 512 = 512 bytes
    Sector size (logical/physical): 512 bytes / 512 bytes
    I/O size (minimum/optimal): 512 bytes / 512 bytes
    Disklabel type: dos
    Disk identifier: 0x0975cb23

    Device     Boot  Start     End Sectors  Size Id Type
    /dev/sda1            0 3053567 3053568  14    0 Empty
```

La ligne qui concerne le nouveau disque est celle qui se présente sous la forme

```
    /dev/sdaX
```

Pour créer une partition, faites *(changez le X par la lettre et le chiffre que vous avez chez vous, par exemple `sda1, sdb1, sdc1`)*:

```
    fdisk /dev/sdaX
```

Il faudra ensuite entrer les réponses:

```
    "m"
    "n"
    "p"
    "w"
```

Pour formater votre disque:

    mkfs.ext4 /dev/sdX

*Pour plus de détail sur le formatage, référez-vous à cet article [1](https://doc.ubuntu-fr.org/tutoriel/comment_ajouter_un_disque_dur) ou à celui-là [2](https://www.it-connect.fr/ajouter-un-disque-dur-sous-linux/). L'important pour la suite est de bien formater son disque en ext4, quand au nombre de partition, il est laissé à votre discrétion.*

La suite du tutoriel : [monter un disque](/external_storage_2_mount_fr).
