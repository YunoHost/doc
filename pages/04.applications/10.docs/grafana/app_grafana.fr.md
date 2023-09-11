---
title: Grafana
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_grafana'
---

[![Installer Grafana avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=grafana) [![Integration level](https://dash.yunohost.org/integration/grafana.svg)](https://dash.yunohost.org/appci/app/grafana)

*Grafana* est un tableaux de bord de supervision.

### Captures d'écran

![Capture d'écran de Grafana](https://github.com/YunoHost-Apps/grafana_ynh/blob/master/doc/screenshots/Grafana8_Kubernetes.jpg)

### Avertissements / informations importantes

#### Configuration

**Important lors de la première connexion :**

* vous devez aller dans le menu Grafana (icône Grafana), sélectionner le menu de votre compte et sélectionner Switch to Main Org.
* vous pouvez maintenant accéder au tableau de bord NetData par défaut via le menu Accueil

**N'hésitez pas à créer de nouveaux tableaux de bord** : le tableau de bord par défaut contient des métriques de NetData, mais uniquement des métriques génériques qui sont générées sur chaque machine. NetData détecte dynamiquement les services et applications (par exemple Redis, NGINX, etc.) et enrichit son tableau de bord et les métriques générées. De nombreuses métriques NetData n'apparaissent pas dans le tableau de bord Grafana fourni par défaut !

### Caractéristiques spécifiques à YunoHost

* installe InfluxDB comme base de données de séries chronologiques
* si le paquet NetData est installé, il est configuré pour qu'il alimente InfluxDB toutes les minutes
* installe Grafana comme serveur de tableaux de bord
* crée une source de données Grafana pour récupérer les données d'InfluxDB (et donc de NetData !)
* crée un tableau de bord par défaut pour tracer certaines données de NetData (il ne couvre pas toutes les métriques, il peut être considérablement amélioré !)

**Architecture générale**

![image](https://cloud.githubusercontent.com/assets/2662304/20649711/29f182ba-b4ce-11e6-97c8-ab2c0ab59833.png)

#### Limitations

* Le tableau de bord par défaut peut être mis à jour dans une prochaine version de ce paquet, alors assurez-vous de créer vos propres tableaux de bord !
* La création d'organisations ne fonctionne pas bien avec l'intégration LDAP ; elle est désactivée pour les utilisateurs standard, mais ne peut pas être désactivée pour les administrateurs : **veuillez ne pas créer d'organisations !**

## Liens utiles

+ Site web : [grafana.com](https://grafana.com/)
+ Démonstration : [Démo](https://demo.grafana.eu/login)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/grafana](https://github.com/YunoHost-Apps/grafana_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/grafana/issues](https://github.com/YunoHost-Apps/grafana_ynh/issues)
