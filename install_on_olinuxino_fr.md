# Installation sur une carte OlinuXino

<div class="alert alert-info" markdown="1">
Pour installer YunoHost sur une carte OLinuXino, le plus simple est d'utiliser l'image du projet [Site du projet *La Brique Internet*](http://labriqueinter.net). Il s'agit d'une image YunoHost qui est actuellement spécifiquement destinée aux cartes OLinuXino.
</div>

<div class="alert alert-warning" markdown="1">
Si vous souhaitez mettre en place ou obtenir une Brique Internet complète (Carte Olimex + YunoHost + VPN associatif neutre + Hotspot Wifi), nous vous conseillons de contacter [le FAI associatif le plus proche de chez vous](https://labriqueinter.net/#obtenir-une-brique), la Brique Internet déconseillant **fortement** de faire l'installation vous-même. Si vous voulez néanmoins le faire, vous pouvez utiliser [la procédure d'installation du projet La Brique Internet](https://install.labriqueinter.net).

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

Pour préparer la carte SD, un ordinateur sous GNU/Linux ou BSD est préférrable. Vous devriez pouvoir suivre les mêmes instructions avec MacOS/OSX. Sous Windows, il vous faudra utiliser l'outil décrit [ici](/copy_image_fr).

---

## Télécharger l’image

Télécharger l’image ([lime1](http://repo.labriqueinter.net/labriqueinternet_A20LIME_latest_jessie.img.tar.xz) ou [lime2](http://repo.labriqueinter.net/labriqueinternet_A20LIME2_latest_jessie.img.tar.xz)), vérifier son intégrité (somme de contrôle MD5), puis la décompresser :
```bash
cd /tmp/
# Télécharger l'image
wget https://repo.labriqueinter.net/labriqueinternet_A20LIME_latest_jessie.img.tar.xz

# Verifier l'intégrite (optionel, mais recommandé)
wget -q -O - https://repo.labriqueinter.net/MD5SUMS | grep "labriqueinternet_A20LIME_latest_jessie.img.tar.xz$" > MD5SUMS
md5sum -c MD5SUMS

# Décompresser l'image
tar -xf labriqueinternet_*.img.tar.xz
mv labriqueinternet_*.img labriqueinternet.img
```

## Copier l’image sur la carte SD

1. Identifier le nom de la carte micro-SD : 
   - Assurez-vous que la carte n'est *pas* insérée dans l'ordinateur
   - Tapez `ls -1 /sys/block/`
   - Insérez la carte
   - Retaper `ls -1 /sys/block/`
   - Le nom de la carte correspond au nom qui apparaît en plus dans la deuxième commande. Il s'agit généralement de quelque chose comme `sdb` ou `mmcblk0`.

2. Copier l’image sur la carte (remplacer *SDNAME* par le nom trouvé lors de l’étape précédente). La copie peut prendre un certain temps.
```bash
sudo dd if=/tmp/labriqueinternet.img of=/dev/SDNAME bs=1M status=progress
sync
```

## Brancher & démarrer

Insérer la carte micro-SD dans la carte OLinuXino, connecter la carte OLinuXino à votre routeur avec le câble Ethernet, puis brancher l’alimentation. La carte démarre normalement toute seule, et les LEDs du port Ethernet se mettent à clignoter au bout de dix secondes maximum.
<div class="alert alert-warning" markdown="1">
Le premier démarrage peut prendre un peu plus d’une minute car la partition est redimensionnée et le serveur est redémarré automatiquement.
</div>

## Trouver l'ip locale de votre mini-serveur
Récupérer l’adresse IP locale :

 * soit avec une commande comme `sudo arp-scan --local | grep -P '\t02'`;
 * soit via l’interface du routeur listant les clients DHCP ;
 * soit en branchant un écran en HDMI au mini-serveur, et en exécutant `ifconfig`.

<div class="alert alert-info" markdown="1">
Pour les commandes suivantes, nous utiliser **192.168.x.y** pour désigner l'IP du serveur. Remplacez-la par l’adresse IP déterminée précédemment.
</div>

## Changer le mot de passe root en se connectant en SSH

Se connecter en SSH en root au mini-serveur, le mot de passe par défaut est **olinux** :
```bash
ssh root@192.168.x.y
```
À la première connexion, il sera demandé de changer le mot de passe : entrer à nouveau **olinux**, puis saisir deux fois le nouveau mot de passe.

## Mettre à jour le serveur

Mettre à jour le système (environ 15 minutes) :
```bash
apt-get update && apt-get dist-upgrade
```

## Procéder à la postinstallation

Procéder à la [postinstallation](/postinstall_fr) en se connectant à la carte avec votre navigateur web sur https://192.168.x.y (votre navigateur vous avertira que le certificat est auto-signé, ceci est normal : vous pouvez ajouter une exception de sécurité pour ce certificat).
<div class="alert alert-info" markdown="1">
**Note :** il est également possible de réaliser la post-installation ligne de commande via SSH en exécutant `yunohost tools postinstall`.
</div>

## (Optionel) Installer DoctorCube

Si vous souhaitez bénéficier automatiquement des corrections de l'image du projet La Brique Internet, vous pouvez installez l'application dédiée DoctorCube.

1. Ajoutez le dépôt d'application du projet La Brique Internet
```bash
yunohost app fetchlist -n labriqueinternet -u https://labriqueinter.net/apps/labriqueinternet.json
```
2. Dans l'administration web, cliquez sur la catégorie "Applications", puis installez l'application DoctorCube qui fournie des configurations et des fixs spécifiques à la brique. L'installation de DoctorCube peut prendre de nombreuses minutes. Vous n'êtes pas obligé de rester sur la page web.
