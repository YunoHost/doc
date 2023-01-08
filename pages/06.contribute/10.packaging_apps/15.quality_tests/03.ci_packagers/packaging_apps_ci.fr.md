---
title: Intégration continue
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_ci'
---

Le projet Yunohost fournit un [Serveur D'Integration Continue](https://ci-apps-dev.yunohost.org/ci/) que tout le monde peut utiliser pour tester son application.
Il execute [package_check](https://github.com/YunoHost/package_check) sur votre repository.

Pour l'utiliser, il faut:
- Que votre repository soit transféré à [YunoHost-Apps repository](https://github.com/YunoHost-Apps)
- Avoir un fichier check_process correct [Sa description est ici](https://github.com/YunoHost/package_check#syntax-of-check_process)
- Il est recommandé d'avoir fait les tests au préalable en local avec l'outil [Outil Package_check](https://github.com/YunoHost/package_check) 

Il est très facile de demander un nouveau test, grâce à un bot github:
- Il vous suffit de créer un Pull Request dans votre repository github, avec un commentaire contenant le texte suivant: !testme
- Immédiatement, le bot va ajouter un commentaire vous informant que la demande de test a été prise en compte:
![image](https://user-images.githubusercontent.com/771800/211145536-6f84c5f4-5172-4498-83cb-9acd5b96ba21.png)
- Parfois le bot ne semble pas écouter... Il faut juste recommencer, avec le sourire si possible !
- Si vous cliquez sur ce commentaire, vous verez le déroulement de votre test sur le serveur d'integration continue.

Le test sera mis dans une file d'attente, une fois exécuté complètement, il va:
- Ajouter le résultat du test and le Pull Request comme commentaire.
- Mettre à jour le score d'intégration de votre application dans votre repository ainsi que dans votre fichier README.


A tout moment vous pouvez regarder la [page d'accueil du Serveur d'Integration Continue](https://ci-apps-dev.yunohost.org/ci/) pour vous informer des différents tests en cours.

! La suite de cette page est obsolète et doit être changé

Un serveur d'intégration continue est disponible pour tout packager souhaitant tester une application avec [Package_check](https://github.com/YunoHost/package_check).

[ci-apps-dev](https://ci-apps-dev.yunohost.org?classes=btn,btn-lg,btn-primary)

Ce serveur est libre d'accès pour chacun d'entre vous, vous avez juste besoin d'un compte.  
Pour ce faire, demandez à un membre du groupe Apps sur notre [chatroom Applications](/chat_rooms)

Pour créer un compte sur ce CI, vous aurez besoin de deux choses:
- Un nom (Pour créer un utilisateur et lui donner un répertoire).
- Une clé ssh publique (Pour votre accès au serveur).

Une fois cela fait, vous pourrez accéder au serveur et y déposer vos applications.  
Pour vous connecter au serveur, utilisez :
```bash
ssh USER@ci-apps-dev.yunohost.org -i YOUR_PRIVATE_KEY
```

Vous trouverez un répertoire vide, prêt à recevoir vos applications.  
Dès que vous déposer une application dans votre répertoire, dans un délai maximum de 5 minutes, un nouveau job sera créé pour cette application et exécuté par le CI.  
Chaque fois que vous mettrez à jour cette application, un nouveau test sera exécuté.

Cependant, pour éviter tout problème de sécurité, votre connexion ssh sera très limitée.  
Vous ne pouvez utiliser que `sftp` ou `rsync` pour copier vos applications dans ce répertoire. `Git` n'est pas disponible, ni la plupart des commandes bash habituelles.  
Pour faciliter votre utilisation de ce CI, un petit script peut être utilisé pour copier vos applications dans votre répertoire.

Copiez ce [script](https://raw.githubusercontent.com/YunoHost/CI_package_check/master/dev_CI/send_to_dev_ci.sh) dans votre répertoire de travail habituel et indiquez vos informations.

---

# Autres serveurs d'intégration continue

Pour votre information, voici la liste de tous nos serveurs d'intégration continue.  
Ces CI sont automatiques, vous ne pouvez pas les utiliser directement. Ils travaillent seuls.

- [Official CI](https://ci-apps.yunohost.org): Notre CI officiel, travaillant sur un système x86-64. Il est chargé de déterminer les niveaux pour toutes les applications notées 'working'.
- [ARM CI](https://ci-apps-arm.yunohost.org): Ce CI travaille avec plusieurs Raspberry-Pi, appartenant à des membres de la communauté YunoHost. Les tests sont exécutés sur Raspberry-Pi pour déterminer si les applications fonctionnent sur cette architecture.
- [Unstable/Testing CI](https://ci-apps-unstable.yunohost.org): CI conçu pour effectuer des tests sur les branches Unstable et Testing de YunoHost. Son rôle est de tester ces branches avant une sortie officielle.
- [Jessie CI](https://ci-stretch.nohost.me): CI fonctionnant sur un système Debian Jessie. Ce CI détermine si les applications fonctionnent toujours avec la version précédente de Debian et YunoHost avant la version 3.
- [HQ CI](https://ci-apps-hq.yunohost.org): **A venir...** Ce CI exécute des tests automatiques sur les branches des applications High Quality. A l'exception de la branche master, qui est exclue de ce CI, toutes les branches ajoutées à une application High Quality seront ajoutées à ce CI pour être testées.
