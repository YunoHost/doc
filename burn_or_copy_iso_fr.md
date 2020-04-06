# Flasher l'ISO YunoHost sur une clef USB ou un CD/DVD

Maintenant que vous avez téléchargé l’image ISO de YunoHost, vous devez la mettre sur un support physique. Classiquement, il s'agit d'une **Clé USB** mais pour certaines raisons vous pouvez aussi utiliser un **CD/DVD**.

<img src="/images/usb_key.png" width=150>
<img src="/images/cd.jpg" width=150>

---

## Clé USB

### Avec Etcher

Téléchargez <a href="https://etcher.io/" target="_blank">Etcher</a> pour votre système d'exploitation et installez-le.

<img src="/images/etcher.gif">

Branchez votre clef USB, selectionnez l'ISO YunoHost puis cliquez sur 'Flash'

### Avec UNetbootin

Téléchargez <a href="https://unetbootin.github.io/">UNetbootin</a> pour votre système d'exploitation et installez-le.

<img src="/images/unetbootin.png">

Branchez votre clef USB, selectionnez l'ISO YunoHost puis cliquez sur 'OK'

### Avec `dd`

Si vous êtes familier avec la ligne de commande, il est possible de flasher la
clef USB avec `dd`. En supposant que votre clef USB soit `/dev/sdz` (faites
attention !!), vous pouvez exécuter :

```bash
dd if=/chemin/de/yunohost.iso of=/dev/sdz
```

---

## CD/DVD

Le logiciel à utiliser est différent suivant votre système d’exploitation.

* Sur Windows, utilisez [ImgBurn](http://www.imgburn.com/) pour écrire l’image sur le disque

* Sur Mac OS, utilisez [Disk Utility](http://support.apple.com/kb/ph7025)

* Sur GNU/Linux, vous avez plusieurs choix, tels que [Brasero](https://wiki.gnome.org/Apps/Brasero) ou [K3b](http://www.k3b.org/)
