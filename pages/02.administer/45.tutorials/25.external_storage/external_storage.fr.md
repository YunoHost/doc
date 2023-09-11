---
title: Ajouter un stockage externe à son serveur
template: docs
taxonomy:
    category: docs
routes:
  default: '/external_storage'
  aliases:
    - '/moving_app_folder'
---

## Introduction

En dehors du système de monitoring qui s'assure que les partitions de votre système ne sont pas trop petites, YunoHost ne s'occupe pour l'instant pas de l'organisation de vos partitions et de vos disques.

Si vous vous hébergez sur une carte ARM avec une carte SD ou sur un serveur avec un petit disque SSD, vous pourriez, pour des raisons de fiabilité ou de manque de place, vouloir ajouter un ou des disques à votre serveur.

! Si vous n'avez plus du tout de place sur votre serveur, vous pouvez dès à présent taper `apt clean` pour essayer d'en gagner un peu le temps de faire le ménage ou suivre les opérations qui vont suivre.

Ci-dessous, vous trouverez des explications pour parvenir à déplacer vos données sur un disque dur de façon correcte avec un minimum d'impact vis-à-vis du fonctionnement de YunoHost. Cette opération peut se faire lors de l'installation ou, a posteriori, lorsque vos besoins de stockage ont augmenté ou lorsque vous n'avez plus confiance dans votre carte SD.

!!! La méthode présentée ici va d'abord monter l'unique partition du disque dur, puis utiliser un ou des sous-dossiers de ce disque pour créer différents points de montage sur l'arborescence de votre système. Cette méthode est préférable à l'usage de liens symboliques, car ces derniers peuvent perturber certaines applications dont le système de sauvegarde de YunoHost. On pourrait aussi choisir de monter des partitions plutôt que des sous-dossiers, mais il est parfois difficile d'estimer à l'avance l'évolution du poids d'un dossier à l'avance.

## [fa=list-alt /] Pré-requis

* Avoir un peu de temps à un moment où les utilisateurs de votre serveur peuvent accepter un arrêt des services. Les étapes à réaliser, même si elles sont relativement simples, peuvent parfois paraître techniques et nécessitent dans tous les cas **de prendre son temps**.

* Savoir se connecter en root sur votre système, par exemple via [SSH](/ssh). (Note : en étant connecté en tant qu'utilisateur `admin`, vous pouvez passer root avec `sudo su`)

* Connaître les commandes basiques `cd`, `ls`, `mkdir`, `rm`

* Avoir une sauvegarde au cas où ça ne se passe pas comme prévu

* Disposer d'un stockage supplémentaire (disque SSD, disque dur, clé USB) branché à votre serveur en USB ou en SATA

## 1. Identifier les dossiers à déplacer

La commande `ncdu /` vous permet de naviguer dans les dossiers de votre serveur afin de constater leurs tailles. 

Ci-dessous, une explication de certains chemins qui peuvent prendre du poids avec quelques commentaires pour vous aider à réduire leur poids ou à choisir de les déplacer.

| Chemin | Contenu  | Conseils |
|--------|---|---|
| `/home`                       | Dossiers utilisateurs accessibles via SFTP | Déplaçable sur un disque dur  |
| `/home/yunohost.backup`       | Sauvegardes YunoHost  | Selon votre stratégie de sauvegarde, il peut être préférable de placer ce dossier sur un disque distinct de celui où se trouvent vos données ou vos bases de données |
| `/home/yunohost.app`          | Données lourdes des applications yunohost (nextcloud, matrix...) | Déplaçable sur un disque dur |
| `/home/yunohost.multimedia`   | Données lourdes partagées entre plusieurs applications | Déplaçable sur un disque dur |
| `/var/lib/mysql`              | Base de données utilisées par les applications | A laisser idéalement sur le SSD pour des raisons de performances |
| `/var/lib/postgresql`         | Base de données utilisées par les applications | A laisser idéalement sur le SSD pour des raisons de performances  |
| `/var/mail`                   | Mails des usagers  | Déplaçable sur un disque dur |
| `/var/www`                    | Programme des applications web installées  | A laisser idéalement sur le SSD pour des raisons de performances |
| `/var/log`                    | Journaux des évènements (pages consultées, tentative de connexion, erreurs matériels...). | Ce dossier ne devrait pas prendre trop de place, si il gonfle rapidement, il peut s'agir d'une erreur inscrite en boucle qu'il est préférable de résoudre  |
| `/opt`                        | Programme et dépendance de certaines applications YunoHost. | A laisser idéalement sur le SSD pour des raisons de performances. Pour les applications nodejs il est possible de faire un peu de nettoyage des versions non utilisées.  |
| `/boot`                       | Noyaux et fichiers de démarrage | Ne pas déplacer sauf si vous savez ce que vous faites. Il peut arriver que trop de noyaux soient conservés, il est possible de faire du nettoyage. |

## 2. Connecter et identifier le disque

Commencez par brancher votre disque à votre système. Il faut ensuite identifier sous quel nom est désigné le disque par le système.

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

Ici, `mmcblk0` correspond à une carte SD de 16Go (on voit que les partitions `mmcblk0p1` et `mmcblk0p2` correspondent à la partition de démarrage `/boot` et à la partition système `/`). Le disque dur branché correspond à `sda` qui fait environ 1To, et contient une seule partition `sda1` qui n'est pas monté (pas de "MOUNTPOINT").

! [fa=exclamation-triangle /] Sur un autre système, il se peut que votre système soit installé sur `sda` et que votre disque soit alors `sdb` par exemple.

!!! Astuce: si la taille du disque ne vous suffit pas pour le reconnaître, vous pouvez débrancher le disque lancer la commande `lsblk`, puis rebrancher le disque, lancer `lsblk` et en déduire les différences.

## 3. (Optionnel) Formater le disque

Cette opération est optionnelle si votre disque est déjà formaté avec un système de fichiers supportés par linux (donc pas NTFS ou FAT32).

Créons une partition sur le disque :

```bash
fdisk /dev/VOTRE_DISQUE
```

puis entrez successivement `n`, `p`, `1`, `Entrée`, `Entrée`, et `w` pour créer une nouvelle partition.

Vérifiez avec `lsblk` que vous avez bien votre disque contenant une seule partition.

Avant de pouvoir utiliser votre disque, il doit être formaté.

! [fa=exclamation-triangle /] **Formater un disque implique de supprimer toutes les données inscrites dessus !**. Attention à ne pas vous tromper de nom, car cela peut avoir pour conséquence de formater un autre disque que celui voulu ! Dans l'exemple donné précédemment, il s'agissait de `/dev/sda`. Si votre disque est déjà "propre", vous pouvez passer cette étape.

Pour formater la partition :

```bash
mkfs.ext4 /dev/VOTRE_DISQUE1
# puis 'y' pour valider
```

Remplacez `VOTRE_DISQUE1` par le nom de la première partition sur le disque par exemple `sda1`.

!!! Il est possible d'adapter cette étape, pour par exemple créer un volume raid 1 (disques en miroir) ou chiffrer le dossier. 

## 4. Monter le disque

Contrairement à Windows où les disques sont accessibles avec des lettres (C:/), sous linux, les disques sont rendus accessibles via l'arborescence. "Monter" un disque signifie le rendre effectivement accessible dans l'arborescence des fichiers. Nous allons choisir arbitrairement de monter le disque dans `/mnt/hdd` mais vous pouvez le nommer différemment (par exemple `/mnt/disque` ...).

Commençons par créer le répertoire :
```bash
mkdir /mnt/hdd
```

Puis nous pouvons monter le disque manuellement avec :

```bash
mount /dev/VOTRE_DISQUE1 /mnt/hdd
```

(Ici, `/dev/VOTRE_DISQUE1` correspond à la première partition sur le disque)


## 5. Monter un dossier de /mnt/hdd sur un des dossiers dont on veut déplacer les données

Ici on va considérer que vous souhaitez déplacer les grosses données des applications qui se trouvent dans `/home/yunohost.app` ainsi que les mails sur votre disque dur.

### 5.1 Création des sous-dossiers sur le disque
Pour commencer, on crée un dossier dans le disque dur

```bash
mkdir -p /mnt/hdd/home/yunohost.app
mkdir -p /mnt/hdd/var/mail
```

### 5.2 Passage en mode maintenance
Puis, idéalement on passe en maintenance les applications qui pourraient être en train d'écrire des données.

Exemple, pour nextcloud:

```bash
sudo -u nextcloud /var/www/nextcloud/occ maintenance:mode --on
```

Exemple, pour le mail:

```bash
systemctl stop postfix
systemctl stop dovecot
```

! Si vous souhaitez déplacer les base de données comme mariadb (mysql), il est impératif de stopper les services de ces bases de données sans quoi il est presque sûr que vos données seront corrompues.

### 5.3 Création des points de montages

Ensuite, on va renommer le dossier d'origine et créer un dossier vide éponyme.

```bash
mv /home/yunohost.app /home/yunohost.app.bkp
mkdir /home/yunohost.app
mv /var/mail /var/mail.bkp
mkdir /var/mail
```

On peut alors grâce à la commande `mount --bind` monter le dossier de notre disque dur sur le nouvel emplacement vide de l'arborescence.

```bash
mount --bind /mnt/hdd/home/yunohost.app /home/yunohost.app
mount --bind /mnt/hdd/var/mail /var/mail
```

### 5.4 Copie des données

Puis, on copie les données en conservant toutes les propriétés des dossiers et des fichiers. Cette opération peut prendre un peu de temps, avec un autre terminal, vous pourrez controler l'évolution en observant le poids associé au point de montage avec `df -h`

```bash
cp -a /home/yunohost.app.bkp/. /home/yunohost.app/
cp -a /var/mail.bkp/. /var/mail/
```

Une fois que c'est fini, vérifiez avec `ls` que le contenu est bien là:

```bash
ls -la /home/yunohost.app/
ls -la /var/mail/
```

### 5.5 Sortir du mode maintenance

A partir de là vous pouvez arréter le mode maintenance, la commande ci-dessous est à adapter selon les services que vous avez arrétés.

```bash
sudo -u nextcloud /var/www/nextcloud/occ maintenance:mode --off
systemctl start postfix
systemctl start dovecot
```

A partir de cette étape, vos services tournent avec leurs données sur le disque, il est donc temps de tester pour voir dans quelle mesure il y a un impact sur les performances (notamment si vus utilisez de l'USB 2.0).

## 6. Monter automatiquement au démarrage


Jusqu'ici, nous avons monté manuellement le disque et les sous-dossiers. Cependant, il est nécessaire de configurer le système pour qu'il monte automatiquement le disque après un démarrage.

Si vos tests sont concluants, il faut pérenniser les points de montages, sinon dépêchez-vous de faire machine arrière en commençant par remettre en maintenance.

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

Puis on ajoute ces lignes à la fin du fichier :

```bash
UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" /mnt/hdd ext4 defaults,nofail 0 0
/mnt/hdd/home/yunohost.app /home/yunohost.app none defaults,bind 0 0
/mnt/hdd/var/mail /var/mail none defaults,bind 0 0
```

(il faut adapter cette ligne en fonction des informations et choix précédents)

Utiliser Ctrl+X puis `o` pour sauvegarder.

Vous pouvez ensuite tester de redémarrer le système pour vérifier si le disque et les sous-dossiers sont montés automatiquement.

## 7. Nettoyer les anciennes données
Dès que votre nouveau setup est validé, vous pouvez procéder à la suppression des anciennes données issues de l'étape 6.3:

```bash
rm -Rf /home/yunohost.app.bkp
rm -Rf /var/mail.bkp
```

## ![](image://tada.png?resize=32&classes=inline) Félicitations !

Si vous êtes arrivé jusqu'ici sans dommage, vous avez désormais un serveur qui tire parti d'un ou de plusieurs disques de stockage.
