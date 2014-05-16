# Installer YunoHost sur CubieBoard

### Pré-requis
* CubieBoard & µ-SD de 4Gb minimum
* Un accès internet
* Un accès à l'administration de la box
* Une image Debian 7 pour Cubieboard compatible avec YunoHost:
    * [Cubian](http://cubian.org/)
    * [Cubieez](http://www.cubieforums.com/index.php?topic=442.0)

### Copier l'image sur la carte µ-SD

#### Sur Windows
* Téléchargez et installez **[Win32 Disk Imager](http://sourceforge.net/projects/win32diskimager/)**
* Insérez votre carte µ-SD
* Copiez le fichier `raspberry-latest.img` sur votre carte µ-SD en utilisant Win32 Disk Imager

#### On GNU/Linux, BSD or Mac OS X
* Ouvrez un terminal
* Insérez votre carte SD
* Identifiez le nom système de la carte µ-SD en tapant:

```bash
sudo fdisk -l
```

Le nom devrait prendre la forme `/dev/diskN` sous Mac OS X, où `N` est un nombre, ou `/dev/sdX` sous GNU/Linux, ou `X` est une lettre.

* Copiez l'image en tapant:

```bash
sudo dd bs=1M if=/chemin/vers/raspberry-latest.img of=/nom/carteSD
```

N'oubliez pas de remplacer `/chemin/vers/raspberry-pi.img` et `/nom/carteSD` par les valeurs appropriées.

L'action peut durer quelques minutes.

Vous pouvez également étendre la taille de la partition à l'aide de Gparted.

---

### Démarrage
Mettez la µ-SD dans la CubieBoard et démarrer-la.

### Repérer l'adresse IP locale de votre CubieBoard
```bash
nmap 192.168.0.0/24 ou nmap 192.168.1.0/24
```
### Redirection du nom de domaine vers l'adresse IP locale de la CubieBoard
Réglages de /etc/hosts sur l'ordinateur de bureau :
```bash
(sudo) nano /etc/hosts
```
Ajouter une ligne de la forme :
```bash
adresse_ip_cubieboard      votre_domaine.org
```
### Connection ssh
```bash
ssh root@votre_domaine.org
```
### Installation de YunoHost

1. Installez git
```bash
apt-get install git
```

2. Clonez le répertoire du script d'installation YunoHost
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. Exécutez le script
```bash
cd /tmp/install_script && ./install_yunohostv2
```

### Post-installation

Lorsque l'installation se finit, le script vous propose de procéder à la post-installation. Celle-ci vous demandera deux paramètres: le **nom de domaine principal** et le **mot de passe d'administration**.

Plus d'informations ici : [yunohost.org/postinstall](/postinstall_fr)

### Mise à jour

Il est conseillé de procéder à la mise à jour de YunoHost **dès que possible**. Pour ce faire, rendez-vous sur l'interface d'administration Web, en allant sur `https://<votre_domaine.fr>/yunohost/admin` dans un navigateur, puis cliquez sur « **Outils** », et « **Mettre à jour le système** ».

L'opération peut durer quelques minutes, confirmez ensuite la mise à jour des paquets et patientez encore quelques minutes.

---

#### *Si vous rencontrez des problèmes lors de l'une de ces étapes, n'hésitez pas à nous le signaler via [les moyens de support](/support_fr)*

