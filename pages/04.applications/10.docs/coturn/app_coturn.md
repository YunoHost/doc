---
title: Coturn
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_coturn'
---

[![Install Coturn with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=coturn) [![Integration level](https://dash.yunohost.org/integration/coturn.svg)](https://dash.yunohost.org/appci/app/coturn)

*Coturn* is a Free open source implementation of TURN and STUN Server.
The TURN Server is a VoIP media traffic NAT traversal server and gateway. It can be used as a general-purpose network traffic TURN server and gateway, too.

### Disclaimers / important information

#### Configuration

You need to install TURN server in a root or subdomain like turn.domain.tld
How to configure this app: a plain file with SSH.

#### Testing

For testing we can use Trickle-Ice testing tool. Go to [trickle-ice page](https://webrtc.github.io/samples/src/content/peerconnection/trickle-ice/) and enter following details.

TURN URI     : turn:<YOUR_PUBLIC_IP_ADDRESS>:5349
TURN username: <YOUR_USERNAME>
TURN password: <YOUR_PASSWORD>

## Useful links

+ Website: [github.com/coturn/coturn](https://github.com/coturn/coturn)
+ Application software repository: [github.com - YunoHost-Apps/coturn](https://github.com/YunoHost-Apps/coturn_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/coturn/issues](https://github.com/YunoHost-Apps/coturn_ynh/issues)
