# Orange
*Trouvez la liste d’autres fournisseurs d’accès Internet **[ici](/isp_fr)**.*

#### Le courrier électronique

La box d’Orange bloque le port 25 pour limiter l’envoi de spam.

La solution restante pour héberger son courrier chez soi consiste à le faire passer par les serveurs SMTP d’Orange.

Pour cela, il faut éditer le fichier de configuration de postfix avec la commande :

```bash
sudo nano /etc/postfix/main.cf
```

puis, rajouter à la ligne le relai SMTP d’Orange :

```bash
relayhost = smtp.orange.fr
```

redémarrez Postfix :

```bash
sudo service postfix restart
```

##### Problèmes

Si vous avez une erreur "Authentification requise", la solution est la suivante : **[source](http://viruslocker.free.fr/?page_id=1749)**.

Éditer le fichier de configuration de postfix

```bash
sudo nano /etc/postfix/main.cf
```
puis, rajouter à la ligne :

```bash
smtp_sasl_password_maps = hash:/etc/postfix/sasl/mdp_fai.conf
smtp_sasl_auth_enable = yes
smtp_sasl_security_options = noanonymous
relayhost = [smtp.orange.fr]:25
```

créer le fichier `mdp_fai.conf` :

```bash
sudo nano /etc/postfix/sasl/mdp_fai.conf
```

ajouter

```bash
# mdp_fai.conf
[smtp.orange.fr]:25  adresseemail@chez.orange:son-mot-de-passe
```
avec votre mot de passe du compte d'orange.

Intégrer le mot de passe à Postfix :

```bash
sudo postmap /etc/postfix/sasl/mdp_fai.conf
sudo postconf -e smtp_sasl_password_maps=hash:/etc/postfix/sasl/mdp_fai.conf
```

Si vous avez une erreur "(SASL authentication failed; cannot authenticate to server smtp-auth.nowhere.com[38.123.22.160]: no mechanism available)"

Vérifier la présence de libsasl2-modules et de sasl2-bin :

```bash
apt search libsasl2-modules
apt search sasl2-bin
```

Si ils ne sont pas présents, installez-les :

```bash
apt install libsasl2-modules sasl2-bin
```

Il est possible que postfix ne prenne pas en compte tout de suite vos modifications. Pour le forcer à le faire, exécutez 
```bash
systemctl restart postfix
```
