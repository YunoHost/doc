# Installer YunoHost sur Raspberry Pi

*Toutes les autres façons d'installer YunoHost sont listées **[ici](/install_fr)**.*

## Prérequis

* Un Raspberry Pi modèle B *(le modèle A devrait fonctionner, mais n'a jamais été testé)*
* Une carte SD : une capacité **4Go** (ou plus) et une certification **class10** sont recommandés
* Un autre ordinateur pour parcourir ce guide et accéder à votre Raspberry Pi
* Un écran et un clavier sont recommandés pour pouvoir contrôler votre Raspberry Pi si un problème apparaît
* Un [fournisseur d'accès correct](/isp_fr), de préférence avec une bonne vitesse d'upload
* L’**image YunoHost pour Raspberry Pi**, disponible ici :

    [http://build.yunohost.org/raspberry-latest.img.gz](http://build.yunohost.org/raspberry-latest.img.gz)

## <small>1.</small> Copier l'image sur la carte SD

#### Sur Windows
* Téléchargez et installez **[Win32 Disk Imager](http://sourceforge.net/projects/win32diskimager/)**
* Insérez votre carte SD
* Copiez le fichier `raspberry-latest.img` sur votre carte SD en utilisant Win32 Disk Imager

#### Sur GNU/Linux, BSD or Mac OS X
* Ouvrez un terminal
* Insérez votre carte SD
* Identifiez le nom système de la carte SD en tapant :

```bash
sudo fdisk -l
```

Le nom devrait prendre la forme `/dev/diskN` sous Mac OS X, où `N` est un nombre, ou `/dev/sdX` sous GNU/Linux, ou `X` est une lettre.

* Copiez l'image en tapant :

```bash
sudo dd bs=1M if=/chemin/vers/raspberry-latest.img of=/nom/carteSD
```

N'oubliez pas de remplacer `/chemin/vers/raspberry-pi.img` et `/nom/carteSD` par les valeurs appropriées.

L'action peut durer quelques minutes, votre carte SD sera ensuite prête à être utilisée **:-)**

## <small>2.</small> Démarrer le Raspberry Pi

* Placez la carte SD dans le Raspberry Pi et branchez le **câble Ethernet**
* N'oubliez pas de **brancher un écran** si vous souhaitez suivre le démarrage, et un clavier si vous souhaitez contrôler votre Raspberry Pi directement
* Branchez le câble d'alimentation USB et patientez jusqu’à voir apparaître un grand `Y` blanc

Vous devriez être en mesure de voir le champs `IP address` sur l'écran, écrivez cette adresse : C'est l'**adresse IP locale** de votre Raspberry Pi.

## <small>3.</small> Post-Installation

Vous avez deux manières distinctes de configurer YunoHost, vous n'avez besoin d’exécuter que l'une d'entre elles :

### Web

Sur votre autre ordinateur, ouvrez un navigateur Web et tapez l'adresse IP locale de votre Raspberry Pi dans la bar d'adresse. Elle devrait ressembler approximativement à `https://192.168.1.3`.

Un message d'erreur apparaît, ignorez-le en cliquant sur le bouton « **Poursuivre quand même** » ou « **Ajouter une exception** ».

Vous êtes à présent sur l'écran de post-installation, suivez les instructions et continuez. Rappelez-vous que le Raspberry Pi est une machine peu puissante, l'opération peut prendre **plusieurs minutes**.

### Ligne de commande

Si vous choisissez de faire l'opération de post-installation directement depuis votre Raspberry Pi, identifiez-vous sur l'écran de démarrage avec l'identidiant **root** et le mot de passe **yunohost**, et exécutez la commande:

```bash
yunohost tools postinstall
```

Le mot de passe d'administration et un nom de domaine vous seront demandés. Pour plus de précisions, renseignez-vous sur **[la page appropriée](/postinstall_fr)**


## <small>4.</small> Mise à jour

Il est conseillé de procéder à la mise à jour de YunoHost **dès que possible**. Pour ce faire, rendez-vous sur l'interface d'administration Web, en allant sur `https://<votre_domaine.fr>/yunohost/admin` dans un navigateur, puis cliquez sur « **Outils** », et « **Mettre à jour le système** ».

L'opération peut durer quelques minutes, confirmez ensuite la mise à jour des paquets et patientez encore quelques minutes.

---

#### *Si vous rencontrez des problèmes lors de l'une de ces étapes, n'hésitez pas à nous le signaler via [les moyens de support](/support_fr)*
