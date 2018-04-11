# Build ARM image

Le but de ce tutoriel est de créer une image YunoHost prête à l'emploi pour les cartes ARM.
Elle pourra être utilisée sur de nombreuses cartes (Rasberry Pi, Olimex, Cubieboard…).

Ce tutoriel est basé sur [Yunocubian](https://github.com/M5oul/Yunocubian).

Vous pouvez trouvez le script [ARM image builder from Debian Jessie](https://github.com/YunoHost/install_script/pull/36).


**Toutes ces étapes peuvent être exécutées en utilisant des variations de [ce script](https://github.com/likeitneverwentaway/rpi_buildbot/blob/master/build_image.sh).**

### Téléchargez une version minimale de Debian Jessie
Téléchargez une image Debian Jessie compatible avec la carte **sans environnement graphique** installé:

* [ARMbian](http://www.armbian.com/download/) (Olimex, Cubieboard, Banana Pi…)
* [Raspbian Jessie Lite](https://www.raspberrypi.org/downloads/raspbian/)

### Copiez l'image et installez YunoHost
<a class="btn btn-lg btn-default" href="/copy_image_fr">Copie de l'image sur la carte SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">Plug & boot</a>

* Connexion via [SSH](ssh): **pi@exemple.tld/ip_address** avec le mot de passe **raspberry** (ou toute autre variation pour des distros différentes de Raspbian).
* Mettez un mot de passe root :

```bash
sudo passwd
```

et se connecter en tant que root:
```bash
su
```


* Vous devriez être **root** pour les étapes suivantes.

<a class="btn btn-lg btn-default" href="/install_on_raspberry_fr">Installez manuellement YunoHost sur un Raspberry Pi</a>

Si vous rencontrez des problèmes durant l'installation regardez [ce guide d'installation](http://avignu.wiki.tuxfamily.org/doku.php?id=documentation:yunohost-jessie) pour le Raspberry Pi, sur les suggestions [de ce thread](https://forum.yunohost.org/t/installation-de-yunohost-2-4-sur-raspbian-jessie-minimal-sur-un-raspberry-pi-3/1597).

<div class="alert alert-danger">Ne pas faire la **post-installation**.</div>

### Nettoyage de l'image
* Mise à jour de l'image:
```bash
apt-get update && apt-get dist-upgrade && apt-get autoremove
```
* Changez l'hostname:
```bash
sed -i "s/$(hostname)/YunoHost/g" /etc/hosts
sed -i "s/$(hostname)/YunoHost/g" /etc/hostname
```
* Permettre les connections SSH en tant que root:
```bash
sed -i '0,/without-password/s/without-password/yes/g' /etc/ssh/sshd_config
``` 
* Supprimer l'user pi (cette étape doit être effectuer directement en tant que root, pas connecté avec l'user pi puis root):
```bash
deluser –remove-all-files pi
``` 
* Mise en place du script de premier boot:

```bash
wget https://raw.githubusercontent.com/likeitneverwentaway/rpi_buildbot/master/yunohost-firstboot -P /etc/init.d/

# Droit d'exécution au script
chmod a+x /etc/init.d/yunohost-firstboot

# Exécute le script au prochain boot
insserv /etc/init.d/yunohost-firstboot
```
* Mise en place du script boot promtp:
```bash
wget https://raw.githubusercontent.com/likeitneverwentaway/rpi_buildbot/master/boot_prompt.service -P /etc/systemd/system/
wget https://raw.githubusercontent.com/likeitneverwentaway/rpi_buildbot/master/boot_prompt.sh -P /usr/bin/
chmod a+x /usr/bin/boot_prompt.sh
systemctl enable boot_prompt.service
```

* Dites au script boot_promt que le prochain boot est le premier boot:
```bash
touch /etc/yunohost/firstboot
``` 

* Éteindre la carte:
```bash
shutdown
```


Ne pas oublier de reset le fichier **wpa-supplicant.conf** si vous l'avez modifié. Vous pouvez aussi supprimer l'historique des commandes avec

```bash
history -c
```
ou en éditant **/root/.bash_history**.

### Copie de l'image
Branchez la carte SD à votre ordinateur et faites en une copie:
<div class="alert alert-danger">Faites attention de ne pas supprimer vos données.</div>

```bash
sudo dd bs=1M if=/dev/sdd of=~/yunohost-jessie-board-year-month-day.img
```

Vous pouvez aussi utiliser la fonction **Read** de [Win32 Disk Imager](https://sourceforge.net/projects/win32diskimager/).


### Vérifier l' image
<a class="btn btn-lg btn-default" href="/copy_image_fr">Copier l'image sur la carte SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">Plug & boot</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">Post-install</a>

<div class="alert alert-info">Si tout va bien, vous pouvez publiez votre image.</div>

### Publier l'image
* Réduire la taille en zippant l'image:
```bash
zip yunohost-jessie-board-year-month-day.img.zip yunohost-jessie-board-year-month-day.img
```

* Publication: vous pouvez publier l'image sur le [forum](https://forum.yunohost.org/).
