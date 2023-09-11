---
title: Neutrinet
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_neutrinet'
---

[![Installer Neutrinet avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=neutrinet) [![Integration level](https://dash.yunohost.org/integration/neutrinet.svg)](https://dash.yunohost.org/appci/app/neutrinet)

*Neutrinet* est destinée aux membres Neutrinet qui ont un VPN Neutrinet. Elle vérifie et renouvelle automatiquement les certificats VPN. Ce package contient également une page web avec des informations de contact et d'autres liens utiles.

### Avertissements / informations importantes

**Pour les contributeurs**

**Déboguer**

Vous pouvez exécuter manuellement la tâche cron qui tente de renouveler les certificats :
```
sudo /etc/cron.daily/neutrinet-renew-cert
```
Ceci exécute le script qui est dans `/opt/neutrinet/renew_cert/` :
```
cd /opt/neutrinet/renew_cert
sudo ./renew_cert_cron.sh
```
Vous pouvez augmenter la verbosité avec l'option `-v` :
```
sudo ./renew_cert_cron.sh -v
```
Pour installer l'application sans vérifier les certificats : `export PACKAGE_CHECK_EXEC=1`.

## Liens utiles

+ Site web : [gitlab.domainepublic.net/Neutrinet/neutrinet_ynh](https://gitlab.domainepublic.net/Neutrinet/neutrinet_ynh)
+ Dépôt logiciel de l'application : [gitlab.domainepublic.net - Neutrinet/neutrinet - YunoHost-Apps/neutrinet](https://gitlab.domainepublic.net/Neutrinet/neutrinet_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [gitlab.domainepublic.net - Neutrinet/neutrinet - YunoHost-Apps/neutrinet/issues](https://git.domainepublic.net/Neutrinet/neutrinet_ynh/-/issues)
