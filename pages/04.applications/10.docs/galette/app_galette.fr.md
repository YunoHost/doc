---
title: Galette
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_galette'
---

![logo de Galette](https://galette.eu/site/assets/img/galette.png?resize=,80)

[![Installer Galette avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=galette) [![Integration level](https://dash.yunohost.org/integration/galette.svg)](https://dash.yunohost.org/appci/app/galette)

*Galette* est une application web de gestion d’adhérents et de cotisations en ligne à destination des associations. C’est avant toute chose un logiciel libre, communautaire, et gratuit ! Galette fonctionne sur n’importe quel serveur web qui prend en charge PHP.

### Mise à jour de l'application

Une fois la mise à jour de l'application faite, vous devez vous rendre sur la page de l'installeur qui par défaut est de la forme `https://domaine/galette/installer.php`.

Une fois sur cette page, une vérification des prérequis est affiché.
À l'étape suivante vous allez devoir choisir le type d'installation : ici `Mise à jour`.

![Galette MAJ](https://github.com/YunoHost/doc/raw/master/images/Galette_1_fr_MAJ.png)

C'est à cette nouvelle étape, où les champs sont pré-remplis, qu'il va falloir renseigner le mot de passe de la base de données.

![Galette MdP](https://github.com/YunoHost/doc/raw/master/images/Galette_2_fr_MdP.png)

Vous allez pouvoir le retrouver en vous connectant en SSH à votre serveur. Il faudra passer en root et afficher le fichier `config.inc.php` dans lequel se trouve le mot de passe de l'application :

```
sudo su

cat /var/www/galette/galette/config/config.inc.php
```

## Liens utiles

+ Site web : [galette.eu (fr)](https://galette.eu/site/fr/)
+ Démonstration : [Démo](https://demo.galette.eu/login)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/galette](https://github.com/YunoHost-Apps/galette_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/galette/issues](https://github.com/YunoHost-Apps/galette_ynh/issues)
