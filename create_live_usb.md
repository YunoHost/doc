# Create a YunoHost Live ISO

<div class="alert alert-danger">This page is deprecated / obsolete / outdated. Information
it contains should be updated (or should be removed).</div>

Tested on Debian Wheezy (should work on Ubuntu as well).    
Original tutorial here: http://willhaley.com/blog/create-a-custom-debian-live-environment/

**Warning**: I have **highlighted** all the places you should be in the **chroot** environment.

1. Install applications we need to build the environment. 
```bash
sudo apt-get install debootstrap syslinux squashfs-tools genisoimage memtest86+ rsync
```

2. Setup the base Debian environment.  I am using wheezy for my distribution and i386 for the architecture.  Please do change your mirror if you are not in the Netherlands or know of a mirror close to you.
```bash
mkdir live_boot && cd live_boot
sudo debootstrap --arch=i386 --variant=minbase wheezy chroot http://ftp.nl.debian.org/debian/
```

3. A couple of important steps before we chroot.
```bash
sudo mount -o bind /dev chroot/dev && sudo cp /etc/resolv.conf chroot/etc/resolv.conf
```

4. Chroot to our Debian environment.
```bash
sudo chroot chroot
```

5. **chroot**
Set a few required variables and system settings in our Debian environment.
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

6. **chroot** Set the root password to **yunohost**
```bash
passwd root
```

7. **chroot** Install the required packages, replace the kernel version if needed.
```bash
apt-get install --no-install-recommends \
linux-image-3.2.0-4-486 live-boot \
net-tools wireless-tools wpagui tcpdump wget openssh-client \
xserver-xorg-core xserver-xorg xinit xterm \
pciutils usbutils gparted ntfsprogs hfsprogs rsync dosfstools syslinux partclone nano pv \
chromium-browser libnss3-tools openbox git ca-certificates openssl
```

8. **chroot** NetworkManager can break your network configuration in the chroot environment. You can install it afterward, and CTRL-C during the installation
```bash
apt-get --no-install-recommends install network-manager
```

9. **chroot** Install YunoHost
```bash
git clone https://github.com/YunoHost/install_script /tmp/yunohost_install
cd /tmp/yunohost_install && ./install_yunohost -a
```

10. **chroot** Set parameters in order to launch everything right
```bash
echo "127.0.0.1 yunohost.org" >> /etc/hosts
echo "chromium --user-data-dir=/root/.config/chromium --app=https://yunohost.org/yunohost/admin/" >> /etc/xdg/openbox/autostart
echo -e "if [ -z \"\$DISPLAY\" ] && [ \$(tty) == /dev/tty1 ]; \nthen \n    startx \nfi" >> /root/.bashrc
certutil -d sql:$HOME/.pki/nssdb -A -t "C,," -n YunoHostCA  -i /etc/yunohost/certs/yunohost.org/ca.pem
certutil -d sql:$HOME/.pki/nssdb -A -t "P,," -n YunoHostCrt -i /etc/yunohost/certs/yunohost.org/crt.pem
```

11. **chroot** Edit `/etc/inittab` to login automatically
```bash
nano /etc/inittab
# Replace the following line
1:2345:respawn:/sbin/getty 38400 tty1
# by this one
1:2345:respawn:/bin/login -f root tty1 </dev/tty1 >/dev/tty1 2>&1
```

12. **chroot** Clean up our Debian environment before leaving.
```bash
rm -f /var/lib/dbus/machine-id && 
apt-get clean && 
rm -rf /tmp/* && 
rm /etc/resolv.conf && 
umount -lf /proc && 
umount -lf /sys && 
umount -lf /dev/pts
# Then exit
exit
```

13. Unmount dev from the chroot 
```bash
sudo umount -lf chroot/dev
```

14. Make directories that will be copied to our bootable medium. 
```bash
mkdir -p image/{live,isolinux}
```

15. Compress the chroot environment into a Squash filesystem.
```bash
sudo mksquashfs chroot image/live/filesystem.squashfs -e boot
```

16. Prepare our USB/CD bootloader.
```bash
cp chroot/boot/vmlinuz-3.2.0-4-486 image/live/vmlinuz1 && 
cp chroot/boot/initrd.img-3.2.0-4-486 image/live/initrd1
```

17. Create `image/isolinux/isolinux.cfg` menu for the bootloader.

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

### Build the .iso

Copy files necessary for the ISO to boot and then create the ISO

```bash
cp /usr/lib/syslinux/isolinux.bin image/isolinux/ && 
cp /usr/lib/syslinux/menu.c32 image/isolinux/
cd image && genisoimage -rational-rock -volid "YunoHost Live" -cache-inodes -joliet -full-iso9660-filenames -b isolinux/isolinux.bin -c isolinux/boot.cat -no-emul-boot -boot-load-size 4 -boot-info-table -output ../yunohost-live.iso . && cd ..
```

Great success! Now you can burn the .iso or use [Unetbootin](http://unetbootin.sourceforge.net/) to copy it on a USB stick.
