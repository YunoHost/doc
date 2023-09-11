---
title: Neutrinet
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_neutrinet'
---

[![Installer Neutrinet with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=neutrinet) [![Integration level](https://dash.yunohost.org/integration/neutrinet.svg)](https://dash.yunohost.org/appci/app/neutrinet)

*Neutrinet* is for Neutrinet members that have a Neutrinet VPN. It automatically checks and renews the VPN certificates. This package also contains a web page with contact information and other useful links.

### Disclaimers / important information

**For contributers**

**Debugging**

You can manually run the cron job that attempts to renew the certificates:
```
sudo /etc/cron.daily/neutrinet-renew-cert
```
This actually runs the script in `/opt/neutrinet/renew_cert/`:
```
cd /opt/neutrinet/renew_cert
sudo ./renew_cert_cron.sh
```
You can increase the verbosity with the option `-v`:
```
sudo ./renew_cert_cron.sh -v
```
To install the app without checking for certificates, run `export PACKAGE_CHECK_EXEC=1`.

## Useful links

+ Website: [gitlab.domainepublic.net/Neutrinet/neutrinet_ynh](https://gitlab.domainepublic.net/Neutrinet/neutrinet_ynh)
+ Application software repository: [gitlab.domainepublic.net - Neutrinet/neutrinet - YunoHost-Apps/neutrinet](https://gitlab.domainepublic.net/Neutrinet/neutrinet_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [gitlab.domainepublic.net - Neutrinet/neutrinet - YunoHost-Apps/neutrinet/issues](https://git.domainepublic.net/Neutrinet/neutrinet_ynh/-/issues)
