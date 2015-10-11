#Se créer un environnement de développement

Ce document a pour but de vous donner les clés pour créer un environnement de développement correcte afin de développer sur le cœur de YunoHost. Il peut également vous permettre de tester vos applications que ce soit avec les versions stable, testing, unstable ou même des versions customisées issues des branches des dépôts.

## Présentation des branches de développement de YunoHost
Afin de mettre en place un système automatisé de compilation des paquets debian, le développement de YunoHost progresse désormais autour de 3 branches principales:
- stable : il s'agit du code des paquets debian utilisés en live par les utilisateurs de YunoHost
- testing : il s'agit du code éligible pour la création d'une nouvelle version de YunoHost, il est supposé stable mais manque de test. La branche testing peut notamment servir pour corriger rapidement certains bugs.
- unstable : il s'agit là des derniers codes ajoutés au dépôt mais qui sont connus pour être instables voir inachevés. C'est à destination de cette branche que vous devez faire vos pull request. Si votre travail est conséquent mais inachevé, il convient d'envisager de créer une branche à part thématique (exemple: backup).

Les numéros de version des paquets stable sont pairs, les numéros de version des paquets testing sont impairs. Ainsi, la version 2.3 de YunoHost est une version de test qui sera peut être transformée en version 2.4 si les tests sont concluants.

## Présentation des paquets YunoHost
Avant d'aller plus loin, il convient de rappeler le rôle des différents paquets YunoHost.

### Paquet moulinette
La moulinette est un framework qui permet de créer une API Web ainsi qu'une API en ligne de commande à partir d'un même code python et d'un schéma en yaml.

La ligne de commande `yunohost` est écrite avec ce framework, La moulinette est donc une dépendance de YunoHost. 

La moulinette est un code écrit par les développeurs YunoHost. A l'origine, la moulinette était fusionnée avec le code YunoHost, mais il a été décidé de scinder les 2 afin de permettre l'utilisation de la moulinette pour d'autres projets.

### Paquet SSOwat
SSOwat est un système de Single Sign On pour nginx écrit en lua. C'est ce système qui génére l'interface que les utilisateurs YunoHost voit. Il permet de protéger des URLs et d'autoriser des utilisateurs à accéder ou non à ces ressources.

SSOwat est comme la moulinette une dépendance de YunoHost, mais peut aussi être utilisée séparément sur d'autres projets. 

### Paquet yunohost
Le paquet yunohost est le cœur de YunoHost, ce paquet contient depuis la version 2.3 (testing) le code de la ligne de commande `yunohost`. Il contient également des helpers qui peuvent être utilisées par les scripts des apps YunoHost, ainsi que les templates de configuration des dépendances de YunoHost.

<div class="alert alert-info">
<b>Note :</b> A partir de la version 2.3 (testing), le code de la ligne de commande `yunohost` initialement dans le paquet moulinette-yunohost a été rapatrié dans le paquet yunohost. Un système 2.2 contient donc 2 paquets au lieu d'un seul: yunohost et moulinette-yunohost
</div>

### (Optionnel) Paquet yunohost-admin
Ce paquet contient l'interface d'administration web de YunoHost, obligatoire dans la version 2.2, il est optionnel depuis la version 2.3 (testing).

L'interface d’administration n'est en réalité qu'un client qui se connecte à l'API Web généré par la moulinette et le paquet yunohost.

Le service yunohost-api doit donc être start pour utiliser l'adminweb.

## Installation de l'environnement de dev
<div class="alert alert-warning">
<b>Attention :</b> Cette partie est en cours de rédaction
</div>

Afin de vous simplifier la tache un dépôt dédié a été créé afin de créer un environnement de développement.

```bash
git clone --recursive https://github.com/zamentur/yunohost-development
```






