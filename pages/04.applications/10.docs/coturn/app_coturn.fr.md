---
title: Coturn
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_coturn'
---

[![Installer Coturn avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=coturn) [![Integration level](https://dash.yunohost.org/integration/coturn.svg)](https://dash.yunohost.org/appci/app/coturn)

*Coturn* est une implémentation libre et open source de serveurs TURN et STUN.
Le serveur TURN est un serveur et une passerelle de traversée NAT pour le trafic VoIP. Il peut également être utilisé comme serveur TURN et passerelle de trafic réseau à usage général.

### Avertissements / informations importantes

#### Configuration

Vous devez installer le serveur TURN dans un domaine principal ou un sous-domaine comme turn.domain.tld.
Comment configurer cette application : un simple fichier avec SSH.

#### Testing

Pour les tests, vous pouvez utiliser l'outil de test Trickle-Ice. Accédez à la page trickle-ice [trickle-ice page](https://webrtc.github.io/samples/src/content/peerconnection/trickle-ice/) et entrez les détails suivants.

TURN URI     : turn:<YOUR_PUBLIC_IP_ADDRESS>:5349
TURN username: <YOUR_USERNAME>
TURN password: <YOUR_PASSWORD>

## Liens utiles

+ Site web : [github.com/coturn/coturn](https://github.com/coturn/coturn)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/coturn](https://github.com/YunoHost-Apps/coturn_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/coturn/issues](https://github.com/YunoHost-Apps/coturn_ynh/issues)
