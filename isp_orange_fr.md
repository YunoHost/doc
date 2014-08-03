#Orange
*Trouvez la liste d'autres fournisseurs d’accès Internet **[ici](/isp_fr)**.*

####Le courrier électronique

La box d’Orange bloque le port 25 pour limiter l’envoi de spam.

La solution restante pour héberger son courrier chez soi consiste à le faire passer par les serveurs SMTP d’Orange.

Pour cela, il faut éditer le fichier de configuration de postfix avec la commande :

```bash
sudo nano /etc/postfix/main.cf
```

puis rajouter à la ligne le relai SMTP d’Orange :
```bash
relayhost = smtp.orange.fr```

redémarrez Postfix :
```bash
sudo service postfix restart```
