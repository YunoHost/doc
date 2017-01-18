# Installation sur une carte OlinuXino

<div class="alert alert-info" markdown="1">
Pour installer YunoHost sur une carte OLinuXino, le plus simple est d'utiliser l'image du projet [Site du projet *La Brique Internet*](http://labriqueinter.net). Il s'agit d'une image YunoHost qui est actuellement spécifiquement destinée aux cartes OLinuXino.
</div>

<div class="alert alert-warning" markdown="1">
Si vous souhaitez mettre en place ou obtenir une Brique Internet complète (Carte Olimex + YunoHost + VPN associatif neutre + Hotspot Wifi), il est dans ce cas préférable d'utiliser [la procédure d'installation du projet La Brique Internet](https://install.labriqueinter.net).

Pour faire votre choix, nous vous conseillons de rencontrer votre FAI associatif local et de consulter [les avantages d'un VPN neutre dans le cadre de l'auto-hébergement](/vpn_advantage_fr).
</div>

## Prérequis

Le matériel nécessaire :
* Un mini-serveur Olimex :
 * [A20-OLinuXino-LIME](https://www.olimex.com/Products/OLinuXino/A20/A20-OLinuXino-LIME/open-source-hardware)
 * [A20-OLinuXino-LIME2](https://www.olimex.com/Products/OLinuXino/A20/A20-OLinuXino-LIME2/open-source-hardware)
* Une carte micro-SD (des [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO) pour des raisons de performance/stabilité).
* Un adaptateur secteur [européen](https://www.olimex.com/Products/Power/SY0605E/) pour alimenter la carte olimex. L’alimentation via USB semble peu stable.
* Un câble Ethernet/RJ-45 pour brancher la Brique à son routeur.

Et évidemment, **un ordinateur sous GNU/Linux ou BSD**.

---

## Télécharger l'image

Télécharger l’image ([lime1](http://repo.labriqueinter.net/labriqueinternet_A20LIME_latest_jessie.img.tar.xz) ou [lime2](http://repo.labriqueinter.net/labriqueinternet_A20LIME2_latest_jessie.img.tar.xz)), valider son *checksum MD5*, puis la décompresser :
```bash
% cd /tmp/
% wget http://repo.labriqueinter.net/labriqueinternet_A20LIME_latest_jessie.img.tar.xz
% wget http://repo.labriqueinter.net/MD5SUMS
% md5sum -c MD5SUMS
% tar -xf labriqueinternet_*.img.tar.xz
% mv labriqueinternet_*.img labriqueinternet.img
```
## Copier l'image sur la carte SD

1. Identifier le nom de la carte micro-SD (SDNAME) en tapant la commande `ls -1 /sys/block/`, en insérant la carte micro-SD (éventuellement à l’aide d’un adaptateur) dans son ordinateur, puis en retapant la commande `ls -1 /sys/block/`. Le nom de la carte micro-SD (SDNAME) correspond à la ligne qui apparaît en plus après la seconde saisie (e.g. *sdb* ou *mmcblk0*).

2. Copier l’image sur la carte (remplacer *SDNAME* par le nom trouvé lors de l’étape précédente) :
```bash
sudo dd if=/tmp/labriqueinternet.img of=/dev/SDNAME bs=1M
sync
```

## Brancher & démarrer

Insérer la carte micro-SD dans la carte OLinuXino, connecter la carte OLinuXino à votre routeur avec le câble Ethernet, puis brancher l’alimentation. La carte démarre normalement toute seule, et les LEDs du port Ethernet se mettent à clignoter au bout de dix secondes maximum.
<div class="alert alert-warning" markdown="1">
Le premier démarrage peut prendre un peu plus d’une minute car la partition est redimensionnée et le serveur est redémarré automatiquement.
</div>

## Trouver l'ip locale de votre mini-serveur
Récupérer l’adresse IP locale :

 * soit avec une commande comme `sudo arp-scan --local | grep -P '\t02'` ou bien avec la commande `sudo arp-scan --local -I wlan0 | grep -P '\t02'` si votre ordinateur est connecté en WiFi.
 * soit via l’interface du routeur listant les clients DHCP,
 * soit en branchant un écran en HDMI au mini-serveur, et en exécutant `ifconfig`.

<div class="alert alert-info" markdown="1">
Pour les commandes suivantes, nous admettons que l’adresse IP locale du mini-serveur est **192.168.4.2**. Remplacer par l’adresse IP précédemment déterminée.
</div>

## Changer le mot de passe root en se connectant en SSH

Se connecter en SSH en root au mini-serveur, le mot de passe par défaut est **olinux** :
```bash
ssh root@192.168.4.2
```
À la première connexion, il sera demandé de changer le mot de passe : entrer à nouveau **olinux**, puis saisir deux fois le nouveau mot de passe.

## Mettre à jour le serveur

Mettre à jour le système (environ 15 minutes) :
```bash
apt-get update && apt-get dist-upgrade
```

## Fixer le fichier host
<div class="alert alert-info" markdown="1">
Nous installons ici le mini-serveur de **michu.nohost.me**. Remplacer ce nom par le nom de domaine choisi (et comme précédemment l’IP 192.168.4.2 par celle du mini-serveur)
</div>

Mettre à jour le fichier `/etc/hosts` de son ordinateur client pour pouvoir accéder au mini-serveur en local via **michu.nohost.me**, en ajoutant à la fin :
```bash
192.168.4.2 michu.nohost.me
```

## Procéder à la postinstallation

Procéder à la [postinstallation](/postinstall_fr) en se connectant au mini-serveur sur https://michu.nohost.me (accepter l’exception de sécurité du certificat).
<div class="alert alert-info" markdown="1">
**Note :** il est également possible de réaliser cette étape en ligne de commande via SSH en exécutant `yunohost tools postinstall`.
</div>

## (Optionnel) Installer DoctorCube

Si vous souhaitez bénéficier automatiquement des corrections de l'image du projet La Brique Internet, vous pouvez installez l'application dédiée DoctorCube.

1. Ajoutez le dépôt d'application du projet La Brique Internet
```bash
yunohost app fetchlist -n labriqueinternet -u https://labriqueinter.net/apps/labriqueinternet.json
```
2. Dans l'administration web, cliquez sur la catégorie "Applications", puis installez l'application DoctorCube qui fournie des configurations et des fixs spécifiques à la brique. L'installation de DoctorCube peut prendre de nombreuses minutes. Vous n'êtes pas obligé de rester sur la page web.
