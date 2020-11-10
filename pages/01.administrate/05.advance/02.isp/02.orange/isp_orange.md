# Orange

*Find the list of other Internet service providers **[here](/isp)**.*

#### Email

The Orange box has port 25 closed so as to limit the amount of spam that could be sent from a compromised home connection.

The remaining solution to host one own's email at home is to route it through the Orange SMTP servers.

To that end, one has to edit the postfix configuration file with the following command:

```bash
sudo nano /etc/postfix/main.cf
```

then, add the SMTP Orange server as a relay on the associated line:

```bash
relayhost = smtp.orange.fr
```

restart Postfix :

```bash
sudo service postfix restart
```

##### Problems

If you are having an "Authentication required" error, the solution is as follows (note: french website): **[source](http://viruslocker.free.fr/?page_id=1749)**.

Edit the postfix configuration file

```bash
sudo nano /etc/postfix/main.cf
```
then, add the following lines:

```bash
smtp_sasl_password_maps = hash:/etc/postfix/sasl/mdp_fai.conf
smtp_sasl_auth_enable = yes
smtp_sasl_security_options = noanonymous
relayhost = [smtp.orange.fr]:25
```

Create the `mdp_fai.conf` file :

```bash
sudo nano /etc/postfix/sasl/mdp_fai.conf
```

add

```bash
# mdp_fai.conf
[smtp.orange.fr]:25  emailaddress@at.orange:my-own-password
```
with your Orange account password.

Integrate the password into Postfix :

```bash
sudo postmap /etc/postfix/sasl/mdp_fai.conf
sudo postconf -e smtp_sasl_password_maps=hash:/etc/postfix/sasl/mdp_fai.conf
```

If you are having an "(SASL authentication failed; cannot authenticate to server smtp-auth.nowhere.com[38.123.22.160]: no mechanism available)" error

Check that `libsasl2-modules` and `sasl2-bin` are present :

```bash
apt search libsasl2-modules
apt search sasl2-bin
```

If they are not present, do install them :

```bash
apt install libsasl2-modules sasl2-bin
```

It is possible that postfix does not immediately take into account your modifications. To force it to do so, run
```bash
systemctl restart postfix
```
