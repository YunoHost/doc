---
title: Matrix Signal bridge
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_mautrix_signal'
---

[![Installer Matrix Signal bridge with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=mautrix_signal) [![Integration level](https://dash.yunohost.org/integration/mautrix_signal.svg)](https://dash.yunohost.org/appci/app/mautrix_signal)

*Matrix Signal bridge* is a membership management web application towards non profit organizations. This is before all a free software (as in free speech), community and free (as in beer)! Matrix Signal bridge works on any web server that handle PHP.

### Disclaimers / important information

#### List of known public services

* Ask on one of the following rooms: #mautrix_yunohost:matrix.fdn.fr or #signal:maunium.net

### Bridging usage
** Note that several Signal and Matrix users can be bridged, each Signal account has its own bot administration room. If they are in a same Signal group, only one matrix room will be created. **

#### Bridge a Signal user and a Matrix user
* First your Matrix user or Synapse Server has to be authorized in the Configuration of the bridge (see below)
* Then, invite the bot (default @signalbot:yoursynapse.domain) in this new Mautrix-Signal bot administration room.
  * If the Bot does bot accept, see the [troubleshooting page](https://docs.mau.fi/bridges/general/troubleshooting.html)
* Send ``!sg help`` to the bot in the created room to know how to control the bot.
See also [upstream wiki Authentication page](https://docs.mau.fi/bridges/python/signal/authentication.html)

#### Linking the Bridge as a secondary device
* Type ``!sg link``
* Open Signal App of your primary device
* Open Settings => Linked Devices => + => Capture the QR code with the camera
* By defaults, only conversations with very recent messages will be bridged
* Accept invitations to the bridged chat rooms

#### Registering the Bridge as a primary device
* Type ``!sg register <phone>``, where ``<phone>`` is your phone number in the international format with no space, e.g. ``!sg register +33612345678``
* Answer in the bot room with the verification code that you reveived in SMS.
* Set a profile name with ``!sg set-profile-name <name>``

### Double puppeting
* Log in with ``login-matrix <access token>``
* After logging in, the default Matrix puppet of your Signal account should leave rooms and your account should join all rooms the puppet was in automatically.


### Relaybot: Bridge a group for several Matrix and several Signal users to chat together
* Create a room on the signal side
* Your bridged users will be invited on the Matrix side once they are invited on the Signal side
* You can invite more people over on the Matrix side
* Have one of the bridged users (who has the right permission) type `!sg set-relay` on the Matrix side. Their signal account will relay messages from other Matrix users
It is not yet possible to bridge to an existing signal room, or create a new signal room from the Matrix side.

## Configuration of the bridge

The bridge is [roughly configured at installation](https://github.com/YunoHost-Apps/mautrix_signal_ynh/blob/master/conf/config.yaml), e.g. allowed admin and user of the bot. Finer configuration can be done by modifying the
following configuration file with SSH: 
```
/opt/yunohost/mautrix_signal/config.yaml
```
and then restarting the mautrix_signal service.

## Useful links

+ Website: [mautrix_signal.eu (en)](https://mautrix_signal.eu/site/)
+ Demonstration: [Demo](https://demo.mautrix_signal.eu/login)
+ Application software repository: [github.com - YunoHost-Apps/mautrix_signal](https://github.com/YunoHost-Apps/mautrix_signal_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/mautrix_signal/issues](https://github.com/YunoHost-Apps/mautrix_signal_ynh/issues)
