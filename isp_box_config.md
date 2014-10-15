#Configuration box/router

####Access to box/routeur administration
In the URL bar of your web navigator put:
```bash
192.168.0.1 or 192.168.1.1
```
Then you will need to authentificate.

####Opening ports
Opening following ports are necessary to make works differents services.

TCP : 22, 25, 53, 80, 443, 465, 993, 5222, 5269, 5290

#####UPnP

L’UPnP permit opening automatically ports.

In some case, after changing your box configuration (ex: add IPv6, or unlock SMTP ... ) and a reboot. It happens that ports are no onger opened. So you have to reload your firewall configuration :

```sudo yunohost firewall reload```

#####Manual opening ports

In the case that UPnP doesn’t works, manual opening ports are necessary.

#####Email

Internet service porviders blocks port 25 to avoid spam. To send mails, you’ll need to open port 25.
