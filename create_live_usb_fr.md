# Créer une Live ISO de YunoHost

<div class="alert alert-danger">This page is deprecated / obsolete / outdated. Information
it contains should be updated (or should be removed).</div>

Testé sur Debian Wheezy (devrait marcher sur Ubuntu également).
Tutoriel original : http://willhaley.com/blog/create-a-custom-debian-live-environment/

**Attention** : toutes les sections où vous devrez être dans un environnement **chroot** sont **surlignées**.

1. Installation des applications nécessaires à la compilation de l’environnement
```bash
sudo apt-get install debootstrap syslinux squashfs-tools genisoimage memtest86+ rsync
```

2. Configuration de l’environnement de base Debian. Debian wheezy et une architecture i386 ont été utilisés pour effectuer les tests. 
Changer le miroir si vous n’êtes pas aux Pays-Bas ou que vous connaissez un miroir plus proche.

```bash
mkdir live_boot && cd live_boot
sudo debootstrap --arch=i386 --variant=minbase wheezy chroot http://ftp.nl.debian.org/debian/
```

3. Deux étapes importantes avant de chroot :
```bash
sudo mount -o bind /dev chroot/dev && sudo cp /etc/resolv.conf chroot/etc/resolv.conf
```

4. Chroot l’environnement Debian :
```bash
sudo chroot chroot
```

5. **chroot**
Configuration de variables et d’options système de l’environnement Debian :
```bash
mount none -t proc /proc && 
mount none -t sysfs /sys && 
mount none -t devpts /dev/pts && 
export HOME=/root && 
export LC_ALL=C && 
apt-get install dialog dbus --yes && 
dbus-uuidgen > /var/lib/dbus/machine-id && 
apt-get update
```

6. **chroot** Configuration du mot de passe root de **yunohost** :
```bash
passwd root
```

7. **chroot** Installation des paquets requis, remplacement du noyau si nécessaire :
```bash
apt-get install --no-install-recommends \
linux-image-3.2.0-4-486 live-boot \
net-tools wireless-tools wpagui tcpdump wget openssh-client \
xserver-xorg-core xserver-xorg xinit xterm \
pciutils usbutils gparted ntfsprogs hfsprogs rsync dosfstools syslinux partclone nano pv \
chromium-browser libnss3-tools openbox git ca-certificates openssl
```

8. **chroot** Le NetworkManager peut casser la configuration de votre environnement chroot. Il est possible de l’installer a posteriori et d’annuler en pressant CTRL-C pendant l’installation.
```bash
apt-get --no-install-recommends install network-manager
```

9. **chroot** Installation de YunoHost :
```bash
git clone https://github.com/YunoHost/install_script /tmp/yunohost_install
cd /tmp/yunohost_install && ./install_yunohost -a
```

10. **chroot** Configuration des paramètres :
```bash
echo "127.0.0.1 yunohost.org" >> /etc/hosts
echo "chromium --user-data-dir=/root/.config/chromium --app=https://yunohost.org/yunohost/admin/" >> /etc/xdg/openbox/autostart
echo -e "if [ -z \"\$DISPLAY\" ] && [ \$(tty) == /dev/tty1 ]; \nthen \n    startx \nfi" >> /root/.bashrc
certutil -d sql:$HOME/.pki/nssdb -A -t "C,," -n YunoHostCA  -i /etc/yunohost/certs/yunohost.org/ca.pem
certutil -d sql:$HOME/.pki/nssdb -A -t "P,," -n YunoHostCrt -i /etc/yunohost/certs/yunohost.org/crt.pem
```

11. **chroot** Éditer `/etc/inittab` pour se connecter automatiquement :
```bash
nano /etc/inittab
# Remplacer la ligne suivante :
1:2345:respawn:/sbin/getty 38400 tty1
# par :
1:2345:respawn:/bin/login -f root tty1 </dev/tty1 >/dev/tty1 2>&1
```

12. **chroot** Nettoyage de l’environnement Debian avant de quitter :
```bash
rm -f /var/lib/dbus/machine-id && 
apt-get clean && 
rm -rf /tmp/* && 
rm /etc/resolv.conf && 
umount -lf /proc && 
umount -lf /sys && 
umount -lf /dev/pts
# Puis exit
exit
```

13. Démonter dev du chroot :
```bash
sudo umount -lf chroot/dev
```

14. Créer les répertoires qui seront copiés dans le média bootable :
```bash
mkdir -p image/{live,isolinux}
```

15. Compresser l’environnement chroot dans un système de fichier Squash :
```bash
sudo mksquashfs chroot image/live/filesystem.squashfs -e boot
```

16. Préparer le bootloader USB/CD :
```bash
cp chroot/boot/vmlinuz-3.2.0-4-486 image/live/vmlinuz1 && 
cp chroot/boot/initrd.img-3.2.0-4-486 image/live/initrd1
```

17. Créer le menu `image/isolinux/isolinux.cfg` pour le bootloader.

```bash
UI menu.c32

prompt 0
menu title YunoHost Live

timeout 300

label YunoHost Live
menu label ^YunoHost Live
menu default
kernel /live/vmlinuz1
append initrd=/live/initrd1 boot=live
```

### Compiler le .iso

Copier les fichiers nécessaires au démarrage de l’ISO et créer l’ISO :

```bash
cp /usr/lib/syslinux/isolinux.bin image/isolinux/ && 
cp /usr/lib/syslinux/menu.c32 image/isolinux/
cd image && genisoimage -rational-rock -volid "YunoHost Live" -cache-inodes -joliet -full-iso9660-filenames -b isolinux/isolinux.bin -c isolinux/boot.cat -no-emul-boot -boot-load-size 4 -boot-info-table -output ../yunohost-live.iso . && cd ..
```

Félicitations ! L’ISO peut désormais être gravée ou utilisée avec [Unetbootin](http://unetbootin.sourceforge.net/) pour la copier sur une clé USB.
