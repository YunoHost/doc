## Créer un environnement de développement

Ce document a pour but de donner les clés pour créer un environnement de développement correct afin de développer sur le cœur de YunoHost. Il peut également vous permettre de tester vos applications que ce soit avec les versions `stable`, `testing`, `unstable` ou même des versions customisées issues des branches des dépôts.

### Présentation des branches de développement de YunoHost
Afin de mettre en place un système automatisé de compilation des paquets Debian, le développement de YunoHost progresse désormais autour de trois branches principales :
- stable : il s'agit du code des paquets Debian utilisés en live par les utilisateurs de YunoHost.
- testing : il s'agit du code éligible pour la création d'une nouvelle version de YunoHost, il est supposé stable mais manque de test. La branche testing peut notamment servir pour corriger rapidement certains bugs.
- unstable : il s'agit là des derniers codes ajoutés au dépôt mais qui sont connus pour être instables voir inachevés. C'est à destination de cette branche que vous devez faire vos pull request. Si votre travail est conséquent mais inachevé, il convient d'envisager de créer une branche à part thématique (exemple : backup).

Les numéros de version des paquets stable sont pairs, les numéros de version des paquets testing sont impairs. Ainsi, la version 2.3 de YunoHost est une version de test qui sera peut être transformée en version 2.4 si les tests sont concluants.

### Présentation des paquets YunoHost
Avant d'aller plus loin, il convient de rappeler le rôle des différents paquets YunoHost.

#### Paquet moulinette
La moulinette est un framework qui permet de créer une API web ainsi qu'une API en ligne de commande à partir d'un même code Python et d'un schéma en yaml.

La ligne de commande `yunohost` est écrite avec ce framework, La moulinette est donc une dépendance de YunoHost. 

La moulinette est un code écrit par les développeurs YunoHost. À l'origine, la moulinette était fusionnée avec le code YunoHost, mais il a été décidé de scinder les deux afin de permettre l'utilisation de la moulinette pour d'autres projets.

#### Paquet SSOwat
SSOwat est un système de Single Sign On pour Nginx écrit en Lua. C'est ce système qui génére l'interface que les utilisateurs YunoHost voit. Il permet de protéger des URLs et d'autoriser des utilisateurs à accéder ou non à ces ressources.

SSOwat est comme la moulinette une dépendance de YunoHost, mais peut aussi être utilisée séparément sur d'autres projets. 

#### Paquet yunohost
Le paquet yunohost est le cœur de YunoHost, ce paquet contient depuis la version 2.3 (testing) le code du programme en ligne de commande `yunohost`. Il contient également des helpers qui peuvent être utilisées par les scripts des apps YunoHost, ainsi que les templates de configuration des dépendances de YunoHost.

<div class="alert alert-info">
<b>Note :</b> à partir de la version 2.3 (testing), le code de la ligne de commande `yunohost` initialement dans le paquet moulinette-yunohost a été rapatrié dans le paquet yunohost. Un système 2.2 contient donc deux paquets au lieu d'un seul : yunohost et moulinette-yunohost.
</div>

#### Paquet yunohost-admin (optionnel)
Ce paquet contient l'interface d'administration web de YunoHost, obligatoire dans la version 2.2, il est optionnel depuis la version 2.3 (testing).

L'interface d’administration n'est en réalité qu'un client qui se connecte à l'API web généré par la moulinette et le paquet yunohost.

Le service yunohost-api doit donc être start pour utiliser l'administration web.

### Installation de l’environnement de développement
<div class="alert alert-warning">
<b>Attention :</b> Cette partie est en cours de rédaction. La ligne de commande `ynh-dev` vient juste d'être créée il est possible qu'il y ai des manques.
</div>

Une ligne de commande `ynh-dev` a été créé afin de simplifier la gestion de votre environnement de developpement.

```bash
wget https://raw.githubusercontent.com/zamentur/yunohost-development/master/ynh-dev
chmod u+x ynh-dev
```
Pour créer votre environnement, commencez par faire un `create-env`
```bash
./ynh-dev create-env ~/project/my/yunohost/env
```
Cette sous commande va cloner les dépots principaux et les positionner en `unstable`. Si vous avez vos propres fork, vous pouvez ensuite faire ce qu'il faut pour changer l'origine et le remote repository.

#### Usage


##### Lancer un container
Positionner vous dans votre environnement, puis créer et entrer dans une vm à l'aide de `ynh-dev run`
```bash
cd ~/project/my/yunohost/env
./ynh-dev run exemple.local docker stable8
root@yunohost:/# cd yunohost
root@yunohost:/yunohost/# ls
Dockerfile  LICENSE  README.md	SSOwat	apps  backup  moulinette  ynh-dev  yunohost  yunohost-admin  yunohost-vagrant
```

##### Mettre à jour un container

Si la vm n'est pas à jour lancez un `ynh-dev upgrade`:
```bash
root@yunohost:/yunohost/# ./ynh-dev upgrade
```

##### Déployer les sources présentes dans votre environnement
Pour déployer les sources se trouvant dans votre environement de developpement faites:
```bash
root@yunohost:/yunohost/# ./ynh-dev deploy
```
<div class="alert alert-warning">
<b>Attention :</b> pour yunohost-admin vous devez avoir compiler le js avec gulp au préalable
</div>

<div class="alert alert-info">
<b>Note :</b> vous pouvez sélectionner les paquets à déployer exemple: `./ynh-dev deploy yunohost yunohost-admin`
</div>

##### Lancer la postinstall
Avec Docker
```bash
root@yunohost:/yunohost/# postinstall
```
Avec VirtualBox/Vagrant
```bash
root@yunohost:/yunohost/# yunohost tools postinstall
```

##### Récupérer l'ip de la vm et parametrer son /etc/hosts
Si vous ne connaissez pas l'ip de votre vm:
```bash
root@yunohost:/yunohost/# ./ynh-dev ip
172.17.0.1
```

Pour tester dans votre navigateur vous pouvez modifier votre fichier /etc/hosts afin de faire pointer votre domaine sur la bonne ip. Par exemple en y ajoutant une ligne semblable à celle ci
```
172.17.0.1   exemple.local
```

##### Déployer les sources au fur et à mesure des modifications
```bash
root@yunohost:/yunohost/# ./ynh-dev watch
```
<div class="alert alert-info">
<b>Astuce :</b> dans le cas de modification sur yunohost-admin, cette commande est trés pratique couplée avec un `gulp watch` sur la machine hôte.
</div>