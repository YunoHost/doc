## Créer un environnement de développement

Ce document a pour but de donner les clés pour créer un environnement de développement correct afin de développer sur le cœur de YunoHost. Il peut également vous permettre de tester vos applications que ce soit avec les versions `stable`, `testing`, `unstable` ou même des versions customisées issues des branches des dépôts.

### Installation de l’environnement de développement
#### Installation du système de virtualisation
Installer, avec le gestionnaire de paquet de votre système d’exploitation, Vagrant.

```bash
# Debian, Ubuntu, Mint
sudo apt-get install vagrant
# Fedora
sudo dnf install vagrant
```

#### Télécharger `ynh-dev`
<div class="alert alert-warning">
<b>Attention :</b> Cette partie est en cours de rédaction. La ligne de commande `ynh-dev` vient juste d’être créée il est possible qu’il y ait des manques.
</div>

Une ligne de commande `ynh-dev` a été créée afin de simplifier la gestion de votre environnement de développement.

```bash
wget https://raw.githubusercontent.com/yunohost/ynh-dev/master/ynh-dev
chmod u+x ynh-dev
```
Pour créer votre environnement, commencez par faire un `create-env`
```bash
./ynh-dev create-env ~/project/my/yunohost/env
```
Cette sous commande va cloner les dépôts principaux au fonctionnement de YunoHost et les positionner en `unstable`. Si vous avez vos propres fork, vous pouvez ensuite faire ce qu’il faut pour changer l’origine et le remote repository.

#### Usage
##### Lancer un container
Positionner vous dans votre environnement, puis créer et entrer dans une vm à l’aide de `ynh-dev run`
```bash
cd ~/project/my/yunohost/env
./ynh-dev run exemple.local docker stable8
root@yunohost:/# cd yunohost
root@yunohost:/yunohost/# ls
Dockerfile  LICENSE  README.md	SSOwat	apps  backup  moulinette  ynh-dev  yunohost  yunohost-admin  yunohost-vagrant
```

##### Mettre à jour un container
Si la vm n’est pas à jour lancez un `ynh-dev upgrade` :
```bash
root@yunohost:/yunohost/# ./ynh-dev upgrade
```

##### Déployer les sources présentes dans votre environnement
Pour déployer les sources se trouvant dans votre environnement de développement faites :
```bash
root@yunohost:/yunohost/# ./ynh-dev deploy
```

<div class="alert alert-warning">
<b>Attention :</b> pour yunohost-admin vous devez avoir compilé le js avec gulp au préalable
</div>

<div class="alert alert-warning">
<b>Note :</b> vous pouvez sélectionner les paquets à déployer exemple : `./ynh-dev deploy yunohost yunohost-admin`
</div>

##### Lancer la postinstall
Avec VirtualBox/Vagrant
```bash
root@yunohost:/yunohost/# yunohost tools postinstall
```

##### Récupérer l’IP de la vm et paramétrer son `/etc/hosts`
si vous ne connaissez pas l’IP de votre vm :
```bash
root@yunohost:/yunohost/# ./ynh-dev ip
172.17.0.1
```

Pour tester dans votre navigateur vous pouvez modifier votre fichier `/etc/hosts` afin de faire pointer votre domaine sur la bonne adresse IP. Par exemple en y ajoutant une ligne semblable à celle-ci :
```bash
172.17.0.1   exemple.local
```

##### Déployer les sources au fur et à mesure des modifications
```bash
root@yunohost:/yunohost/# ./ynh-dev watch
```

Astuce : dans le cas de modification sur yunohost-admin, cette commande est très pratique couplée avec un `gulp watch` sur la machine hôte.
