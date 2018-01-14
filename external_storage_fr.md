# **Préalables**

Attention, les étapes à réaliser, même si elles sont relativement simple, peuvent parfois paraitre technique et nécessite dans tous les cas **de prendre son temps**.
Vous devez également être root sur votre système (avec la commande su ou sudo -i).

Ensuite je vous recommande de **faire un backup** de votre installation https://yunohost.org/#/backup; Ou alors de copier l'image de votre carte sd / disque dur.

Vous devez également disposer d'un disque dur supplémentaire (branché en usb ou en sata);
Dont vous **ne comptez pas conserver les données qu'il contient** (important!).

# **Les objectifs de ce tuto**

Yunohost installe le répertoire data de nextcloud dans /home/yunohost.app/nextcloud/;
L'objet de cet article est de copier l'intégralité de ces données ailleurs pour augmenter son espace de stockage de données.

## **Cela nécessite plusieurs étapes:**

##### **1. Ajouter un disque dur**

##### **2. Migrer les données**

##### **3. Modifier la configuration de Nextcloud**


## **1. Ajouter un disque dur**

Commencez par brancher ce disque dur à votre système. Si vous ne l'avez pour encore fait il va falloir formater puis monter ce disque dur au système. Pour se faire il faut commencer par trouver le nom de son disque avec la commande:

    fdisk -l

Vous devriez avoir un retour sous la forme de:

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

Le ligne qui concerne le nouveau disque est celle qui est sous la forme de:

    /dev/sdaX

Pour créer une partition, faites *(adaptez le X par la lettre plus possiblement le chiffre que vous avez chez vous exemple: sda, sdb, sdc)*:

    fdisk /dev/sdaX

Il faudra ensuite entrez les réponses:

    "m"
    "n"
    "p"
    "w"

Pour formatez votre disque:

    mkfs.ext4 /dev/sdX

*Pour plus de détail sur le formatage, je vous renvoie à cet article [1](https://doc.ubuntu-fr.org/tutoriel/comment_ajouter_un_disque_dur) ou à celui-là [2](https://www.it-connect.fr/ajouter-un-disque-dur-sous-linux/). L'important pour la suite est de bien formater son disque en ext4, quand au nombre de partition, il est laissé à votre discrétion.*

Pour terminer cet étape, on va programmer le montage de ce disque au démarrage de la machine.
Ce qui nécessite de créez un répertoire de montage avec la commande:

    mkdir /media/data

C'est ici que vous allez monter votre disque dur à votre système.
Puis de connaitre l'UUID du disque avec:

    blkid

Qui doit vous renvoyer quelque chose de ce genre:

    root@bureauM2P:~# blkid
    /dev/mmcblk0p1: SEC_TYPE="msdos" LABEL="boot" UUID="DF8E-C7AE" TYPE="vfat" PARTUUID="34e4b02c-01"
    /dev/mmcblk0p2: UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"
    /dev/sdX:UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"

Le ligne qui concerne le disque à monter est celle qui est sous la forme de:

    /dev/sdX:UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"

On va utiliser l'UUID pour modifier le fichier /etc/fstab qui gère le montage des partitions.

    nano /etc/fstab

Dans se fichier ajouter à la fin cet ligne (adaptez bien l'UUID avec celui de VOTRE disque):

    UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" /media/data ext4 defaults,nofail 0 0

Faites ctrl+x puis o pour sauvegarder.

Maintenant testez le montage avec la commande:

    mount /media/data

Terminez est redémarrant votre système.

    reboot now


## **2. Migrer les données**

Il faut commencer par éteindre le serveur web avec la commande:

    systemctl stop nginx  

Puis il faut modifier les droits d'écriture sur le répertoire /media/data. En effet, pour l'instant seul root peut y écrire; ce qui signifie que nginx et nextcloud ne pourront donc pas l'utiliser. Changez ça avec:

    chmod 775 -R /media/data/

Tout est à présent près pour migrer vos données vers le nouveau disque. Pour se faire, faites *(soyez patient  ça peut être long)*:

    sync -avx /home/yunohost.app/nextcloud/ /media/data/

Pour vérifier que tout s'est bien passé comparer ce qu'affiche ces deux commandes (le contenu doit être identique):

    ls -al /home/yunohost.app/nextcloud/
    ls -al /media/data/

Voilà, vous avez fait le plus dur, on peut passer à la dernière étape.

## **3. Modifier la configuration de Nextcloud**

Pour informer Nextcloud de son nouveau répertoire, il faut modifier le fichier /var/www/nextcloud/config/config.php avec la commande:

    nano /var/www/nextcloud/config/config.php

Cherchez la ligne:

      'datadirectory' => '/home/yunohost.app/nextcloud/data',

Que vous modifiez en écrivant:

       'datadirectory' => '/media/data/',

Relancez le serveur web:

    systemctl start nginx

Lancez un scan du nouveau répertoire par Nextcloud:

    cd /var/www/nextcloud
    sudo -u www-data php console.php files:scan --all
    sudo -u www-data php occ maintenance:repair

C'est terminé. À présent testez si tout va bien, essayez de vous connecter à votre instance Nextcloud, envoyer un fichier, vérifiez sa bonne synchronisation.

###### Pour rédiger cet article, l'auteur remercie les différentes sources sur lesquelles il s'est appuyé:

https://soozx.fr/deplacer-repertoire-donnees-data-nextcloud-sur-disque-externe/

https://max-koder.fr/2017/07/19/yunohost-nextcloud-sur-un-disque-dur-externe/

https://doc.ubuntu-fr.org/tutoriel/comment_ajouter_un_disque_dur

https://www.it-connect.fr/ajouter-un-disque-dur-sous-linux/