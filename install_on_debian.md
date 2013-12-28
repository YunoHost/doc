#Installer yunohost sur un server debian via le script d'installation

## Prérequis

Afin de pouvoir récupérer le script install_yunohost, il faut avoir git d'installé sur votre machine.

Pour l'installer sur une distribution Debian:
```bash
$ apt-get install git
```

## Récuperation du script

Placez vous tout d'abord dans le répertoire /tmp:
```bash
$ cd /tmp
```

Récupérez le script grâce à git:
```bash
$ git clone https://github.com/YunoHost/install_script.git
```

Déplacez vous dans le répertoire Script nouvellement cloné:
```bash
$ cd install_script/
```

Rendez le script install_yunohost exécutable:
```bash
$ chmod o+x install_yunohost
```

## Lancer l'installation
Exécutez le script d'installation
```bash
$ ./install_yunohostv2
```

Le script va automatiquement lancer l'installation de yunohost sur votre poste ainsi que tous les paquets nécessaires. Répondez simplement aux questions qui vous seront posées.
