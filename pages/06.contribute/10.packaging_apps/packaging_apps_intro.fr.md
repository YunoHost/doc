---
title: Introduction au packaging
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_intro'
  aliases:
    - '/packaging_apps'
---

Cette documentation a pour but de fournir tous les concepts de base et le vocabulaire nécessaire pour comprendre le packaging d'applications.

Nous détaillerons ce qu'est un paquet d'applications YunoHost, comment il fonctionne, comment créer votre propre paquet et comment trouver de l'aide si vous en avez besoin.


## 1. La Philosophie du Packaging

La possibilité d'installer facilement des applications à partir d'un catalogue est une caractéristique clé de YunoHost. Alors que vous vous plongez dans le processus de packaging d'applications de YunoHost, vous devez vous souvenir de ces principes clés :

- **L'administrateur ne doit pas avoir un doctorat en informatique pour pouvoir installer, configurer et utiliser votre application** : partez du principe que l'administrateur ne connaît pas les concepts informatiques avancés;

- **Less is more**, **Keep it simple!**: ne surchargez pas l'administrateur avec une douzaine de questions techniques ;

- **Les choses doivent être opérationnelles dès le départ** : par exemple, l'administrateur ne doit pas avoir à terminer manuellement le processus d'installation en remplissant manuellement les informations d'identification de la base de données;

- Le packaging d'une application YunoHost **ne se limite pas à l'installation** des sources et des dépendances : il concerne également la maintenance (mise à jour, sauvegarde...) et l'intégration de l'application dans l'écosystème YunoHost (NGINX, SSO/LDAP, Fail2Ban, catalogue d'applications, UI/UX...).


## 2. Prérequis

Avant d'entrer dans le vif du sujet, cette documentation part du principe que :

1. Vous êtes déjà administrateur YunoHost et vous savez déjà à quoi ressemble le processus d'installation ;)
2. Vous êtes familiarisé avec l'administration système et la programmation bash (ou vous êtes prêt à les apprendre) ;
3. Vous êtes familier avec Git (ou vous êtes prêt à l'apprendre) ;
4. Vous êtes à l'aise avec le bricolage et le débogage de matériel informatique en général.

Nous vous encourageons également à rejoindre le [salon de discussion sur le packaging](/chat_rooms) pour poser toutes les questions que vous pourriez avoir !

À un moment donné, vous voudrez aussi avoir un environnement de développement/test, soit en utilisant [VirtualBox](/packaging_apps_virtualbox) ou [LXC/ynh-dev](https://github.com/yunohost/ynh-dev) qui est destiné au noyau mais peut tout à fait être utilisé pour le développement d'applications. Vous pouvez également mettre en place un VPS de développement/test sur votre hébergeur préféré, ou même développer sur votre prod si vous aimez vivre dangereusement ;).

## 3. Notes sur l'histoire du packaging des applications de YunoHost

Beaucoup de choses dans YunoHost, et dans le format d'emballage de l'application YunoHost, sont historiques ou ont été conçues de manière organique. Certains aspects peuvent donc légitimement sembler anciens.

La **"v0" du packaging d'applications** consistait à écrire des scripts bash bruts sans réelle standardisation/contrainte.

Au fil du temps, les étapes récurrentes (comme l'installation des dépendances avec apt, ou la configuration de NGINX) ont été formalisées dans des fonctions bash standardisées, appelées "helpers". Cela a marqué **le début de l'ère de la "v1" packaging**.

Divers outils ont été mis en place pour tester l'application et normaliser son comportement.

Après un certain temps, un ensemble de pratiques et de conventions communes a émergé et est en quelque sorte reflété et maintenu dans l'application modèle `example_ynh`. Bien qu'il soit tentant pour les développeurs de changer les schémas de nommage des variables ou de refactoriser la structure des scripts, il s'avère qu'il est encore plus important de s'en tenir à l'ensemble des pratiques communes (même si elles sont arbitraires et peu élégantes) pour faciliter la maintenance de toutes les applications par n'importe quel membre de la communauté du packaging à travers tous les dépôts !

Néanmoins, même si les aides existaient, la structure inhérente des applications était difficile et ennuyeuse à maintenir avec trop de morceaux de code redondants ou remplis de conventions historiques bizarres. **Un nouveau format v2** [a été conçu et ajouté à YunoHost 11.1 début 2023] (https://github.com/YunoHost/yunohost/pull/1289) dans l'espoir de moderniser et de simplifier l'emballage des applications et d'améliorer l'UI/UX de YunoHost.

Cependant, [**un futur format v3** est encore à venir] (https://github.com/YunoHost/issues/issues/2136) pour simplifier davantage l'empaquetage des applications (comme la prise en charge des configurations NGINX/systemd/..., l'élimination du besoin d'écrire manuellement des scripts de suppression/sauvegarde/restauration, etc.)


## 4. Aperçu général de la structure d'une application YunoHost

Une application YunoHost est construite dans un dépôt Git. Nous vous encourageons à jeter un coup d'oeil à ces dépôts de code pour vous familiariser avec les structures des dépôts d'applications :
- [l'application `helloworld_ynh`](https://github.com/YunoHost-Apps/helloworld_ynh) 
- [l'application `example_ynh`](https://github.com/YunoHost/example_ynh) qui contient toutes les fonctionnalités générales et le formattage recommandé
- votre application "réelle" préférée dans la liste des dépots [YunoHost-Apps](https://github.com/orgs/YunoHost-Apps/repositories)

Parmi les fichiers contenus dans un paquet, les plus importants sont les suivants :

- le **manifeste de l'application** `manifest.toml` <small>(ou `.json` dans le passé)</small>
    - Il peut être considéré comme la carte d'identité de l'application, contenant diverses métadonnées. 
    - Il contient également les questions posées lors de l'installation de l'application.
    - ainsi qu'un ensemble de "ressource" à initialiser, telles que les sources de l'app à télécharger ou les dépendances apt à installer
- **scripts/** contient un ensemble de scripts bash correspondant aux actions exposées dans YunoHost
   - `_common.sh`: common variables or custom functions included in other scripts
    - `install`/`remove` : la procédure d'installation et de suppression
   - `upgrade` : la procédure de mise à niveau
   - `backup`/`restore` : les procédures de sauvegarde/restauration 
   - (`change_url`) : changer l'endroit où l'application est installée en termes de son url d'accès web
- **conf/** contient un ensemble de modèles de configuration utilisés lors de l'installation de l'application. Voici quelques exemples de fichiers couramment trouvés :
   - `nginx.conf` : le modèle de configuration de NGINX (=serveur web) pour cette application
   - `systemd.service` : le modèle de configuration du service systemd pour cette application
   - `config.json/yaml/???` : le modèle de configuration de l'application

Grosso modo, l'installation proprement dite se compose généralement des opérations suivantes (qui peuvent toutefois varier en fonction de la complexité et des technologies utilisées par l'application) - pas nécessairement dans cet ordre exact :

1. YunoHost récupère le dépôt Git du paquet.
2. YunoHost pose à l'administrateur les questions d'installation définies dans `manifest.toml`.
3. L'administrateur remplit le formulaire et démarre l'installation.
4. YunoHost fournit un ensemble de pré-requis techniques (appelés 'ressources') tels que :
    - initialise le magasin de clés/valeurs de l'application `settings.yml` avec les réponses de l'administrateur au formulaire d'installation
    - crée un utilisateur UNIX pour cette application
    - installe les dépendances apt nécessaires à cette application
    - choisit un port pour le reverse-proxying interne
    - initialise une base de données SQL vide
    - configure les permissions SSOwat
    - ...
5. Le script `install` de l'application est exécuté et ses fonctions typiques sont de :
    - récupérer et déployer les sources de l'application
    - configurer l'application (typiquement les identifiants de la base de données, le port interne du reverse-proxy...)
    - ajouter la configuration de NGINX
    - ajoute la configuration systemd du daemon de l'application
    - démarre le daemon de l'application
    - divers réglages de finalisation
6. ???
7. L'application est prête à l'emploi !


## 5. Créer votre tout premier paquet YunoHost

A moins que vous ne souhaitiez vraiment partir de zéro ou de [`example_ynh`] (https://github.com/YunoHost/example_ynh), une pratique courante consiste à identifier une application similaire à celle que vous essayez d'empaqueter - typiquement parce qu'elle repose sur les mêmes technologies - à cloner le dépôt de code correspondant, et à adapter les différents fichiers.

TODO/FIXME : here we should list a bunch of well-knowh apps for classic technologies

- Applications PHP :
- Applications NodeJS :
- Applications Python :
- ???
