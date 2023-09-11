---
title: Domoticz
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_domoticz'
---

[![Installer Domoticz with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=domoticz) [![Integration level](https://dash.yunohost.org/integration/domoticz.svg)](https://dash.yunohost.org/appci/app/domoticz)

*Domoticz* is a very light weight open sources home automation system that lets you monitor and configure miscellaneous devices.

### Disclaimers/important information

Domoticz is a Home Automation system design to control various devices and receive input from various sensors. For example this system can be used with:

    Light switches
    Door sensors
    Doorbells
    Security devices
    Weather sensors like: UV/Rain/Wind Meters
    Temperature Sensors
    Pulse Meters
    Voltage/AD Meters and more

Shipped version: Always the last stable one. The last compiled version is retrieved from this directory during install. Once installed, updates from the uptream app are managed from within the app. YunoHost upgrade script will only upgrade the YunoHost package.

The MQTT broker Mosquitto is integrated into the package. It requires its own domain or subdomain. It's an optional setting: during install if you set the same domaine as your main app domain, it won't be installed.

### Configuration

#### Broker Mosquitto

During installation, a MQTT broker, Mosquitto, is installed at the same time as Domoticz. The installed version is the one from the official project repo and not from Debian ones. This broker requires a dedicated domain or subdomain to work (ex : mqtt.your.domain.tld): creating this domain prior installation is a prerequisite.

##### Adding in Domoticz

To use Mosquitto, you need to customize the communication between Domoticz and the broker by following the Domoticz documentation, part Add hardware "MQTT Client Gateway". User and password are automatically generated during installation, you may retrieve them with
``` 
sudo yunohost app setting domoticz mqtt_user
sudo yunohost app setting domoticz mqtt_pwd
```

##### Publish/Subscribe

By default, Mosquitto will listen on two ports:

    1883 on localhost using mqtt protocol
    8883 using websocket protocol. NGINX redirect external port 443 to this internal port.

Hence, To publish/subscribe on a topic from the outside, you have to use a software supporting WebSocket protocol (ex: paho-mqtt Python library).

##### Mosquitto_pub et mosquitto_sub

These two tools do not support WebSocket protocol, only direct MQTT: base settings will not allow communication from an outside device. If you're using them directly from your server, this kind of syntax should work:
```
mosquitto_pub -u *user* -P *password* -h mqtt.your.domain.tld -p 1883 -t 'domoticz/in' -m '{ "idx" : 1, "nvalue" : 0, "svalue" : "25.0" }'
```
In the same way:

```
mosquitto_sub -u *user* -P *password* -h mqtt.your.domain.tld -p 1883 -t 'domoticz/out'
```

If you wish to open direct MQTT protocol from an outside device, you'll need to:

    open port 1883 on Yunohost firewall (Attention, security risk)
    Allows IP addresses in mosquitto configuration for this listener
    Set the TLS setting in mosquitto configuration by giving access to crt.pem and key.pem from your MQTT domain by setting respective certfile et keyfile variables. This is mandatory to ensure a secure connection.

##### Upgrade from version without Mosquitto

If you have package ynh3 or below, Mosquitto is not installed by default. If you have chosen to not set a domain during initial installation also. So, if you need to activate mosquitto in retrospect, do following actions:

    Create a domain or a subdomain (for example : 'mqtt.your.domain.tld')
    Connect to your server in command line
    Type following command: `yunohost app setting domoticz mqtt_domain -v mqtt.your.domain.tld`
    Upgrade domoticz to last package. If you're already on the last package version, use the following command: `yunohost app upgrade domoticz --force`

### Configuration

Sensors, language...

Main configuration of the app take place inside the app itself.

#### Access and API

By default, access for the JSON API is allowed on following path `/yourdomain.tld/api_/domoticzpath`. So if you access domoticz via `https://mydomainname.tld/domoticz`, use the following webpath for the api: `/mydomainname.tld/api_/domoticz/json.htm?yourapicommand`

By default, only sensor updates and switch toogle are authorized. To authorized a new command, you have (for now) to manually update the NGINX config file:

sudo nano `/etc/nginx/conf.d/yourdomain.tld.d/domoticz.conf`

Then edit the following block by adding the regex of the command you want to allow:

  #set the list of authorized json command here in regex format
  #you may retrieve the command from https://www.domoticz.com/wiki/Domoticz_API/JSON_URL's
  #By default, sensors updates and toggle switch are authorized
  ```
  if ( $args ~* type=command&param=udevice&idx=[0-9]*&nvalue=[0-9]*&svalue=.*$|type=command&param=switchlight&idx=[0-9]*&switchcmd=Toggle$) {
    set $api "1";
    }
  ```
For example, to add the JSON command to retrieve the status of a device (`/json.htm?type=devices&rid=IDX`),modify the line as this:

  #set the list of authorized json command here in regex format
  #you may retrieve the command from https://www.domoticz.com/wiki/Domoticz_API/JSON_URL's
  #By default, sensors updates and toggle switch are authorized
  ```
  if ( $args ~* type=command&param=udevice&idx=[0-9]*&nvalue=[0-9]*&svalue=.*$|type=command&param=switchlight&idx=[0-9]*&switchcmd=Toggle$|type=devices&rid=[0-9]* ) {
    set $api "1";
    }
  ```

All IPv4 addresses within the local network (192.168.0.0/24) and all IPv6 addresses are authorized as API. As far as I know, there is no way to filter for IPv6 address on local network: You may remove the authorization by removing or commenting this line in `/etc/nginx/conf.d/yourdomain.tld.d/domoticz.conf`:

`allow ::/1;`

This will authorized only IPv4 within local network to access your Domoticz API. You may add individual IPv6 address in the same way.

### Limitations

    No user management nor LDAP integration This function is not planned to be implemented into the app, hence it's not planned into the package neither.
    Backup cannot be restored on a different machine type (arm, x86...) as compiled sources are different


## Useful links

+ Website: [domoticz.eu (en)](https://domoticz.eu/site/)
+ Application software repository: [github.com - YunoHost-Apps/domoticz](https://github.com/YunoHost-Apps/domoticz_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/domoticz/issues](https://github.com/YunoHost-Apps/domoticz_ynh/issues)
