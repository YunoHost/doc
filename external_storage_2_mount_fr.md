# Monter un disque dur

**Remarque** : vous pouvez nommer votre point de montage comme vous le souhaitez, cet article prend l'exemple de `/media/stockage`.

Choisissez où votre système accédera au stockage externe. Créez un répertoire de montage avec la commande:

```
    mkdir /media/stockage
```

Pour faire le lien entre ce répertoire de montage et le disque externe, nous avons besoin de l'identifier.

```
    blkid
```

Cette commande renvoit quelque chose de ce genre:

```
    root@bureauM2P:~# blkid
    /dev/mmcblk0p1: SEC_TYPE="msdos" LABEL="boot" UUID="DF8E-C7AE" TYPE="vfat" PARTUUID="34e4b02c-01"
    /dev/mmcblk0p2: UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"
    /dev/sdX:UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"
```

Le ligne qui concerne le disque à monter est celle qui est sous la forme de:

```
    /dev/sdX:UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"
```

Utilisez l'UUID pour modifier le fichier `/etc/fstab` qui gère le montage des partitions.

```
    nano /etc/fstab
```

Dans ce fichier, ajouter à la fin cette ligne (adaptez bien l'UUID avec celui de VOTRE disque, `/media/data` avec le répertoire créé plus tôt, et `ext4` le type de partition relevé par `blkid`):

```
    UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" /media/stockage ext4 defaults,nofail 0 0
```

Faites `ctrl+x` puis `o` pour sauvegarder.

Testez le montage avec la commande:

```
    mount /media/stockage
```

Terminez en redémarrant votre système.

```
    reboot now
```

La suite du tutoriel : [migrer les données de Nextcloud](/app_nextcloud_fr).
