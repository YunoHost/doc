---
title: Grafana
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_grafana'
---

[![Installer Grafana with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=grafana) [![Integration level](https://dash.yunohost.org/integration/grafana.svg)](https://dash.yunohost.org/appci/app/grafana)

*Grafana* is a metric & analytic dashboards for monitoring.

### Screenshots

![Screenshots Grafana](https://github.com/YunoHost-Apps/grafana_ynh/blob/master/doc/screenshots/Grafana8_Kubernetes.jpg)

### Avertissements / informations importantes

#### Configuration

**Important at first login:**

* you have to go the Grafana Menu (Grafana icon), select your account menu and select Switch to Main Org.
* you can now access the default NetData dashboard via the Home menu

**Don't hesitate to create new dashboards**: the default dashboard contains metrics from NetData, but only generic ones that are generated on every machine. NetData dynamically detects services and applications (e.g. Redis, NGINX, etc.) and enriches its dashboard and generated metrics. Many NetData metrics don't appear in the provided default Grafana dashboard!

### YunoHost specific features

* installs InfluxDB as time series database
* if the NetData package is installed, configures NetData to feed InfluxDB every minute
* installs Grafana as dashboard server
* creates a Grafana Data Source to fetch data from InfluxDB (and hence NetData!)
* creates a default dashboard to plot some data from NetData (doesn't cover every metric, can be greatly enhanced!)

**General architecture**

![image](https://cloud.githubusercontent.com/assets/2662304/20649711/29f182ba-b4ce-11e6-97c8-ab2c0ab59833.png)

#### Limitations

* The default dashboard may be updated in a further release of this package, so please make sure you create your own dashboards!
* Organizations creation doesn't play well with LDAP integration; it is disabled for standard users, but can't be disabled for administrators: **please do not create organizations!**

## Useful links

+ Website: [grafana.com](https://grafana.com/)
+ Demonstration: [Demo](https://play.grafana.org/)
+ Application software repository: [github.com - YunoHost-Apps/grafana](https://github.com/YunoHost-Apps/grafana_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/grafana/issues](https://github.com/YunoHost-Apps/grafana_ynh/issues)
