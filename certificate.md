#Certificate

Certificates are used to certify that your server is the genuine one and not a falsified one.

YunoHost provides a **self-signed** certificate, it means that your server guaranty the certificate validity. It's enough **for personal usage**, because you trust your own server. But this could be a problem if you want to open access to anonymous like web user for a website.
Concretely users will go throw a screen like this:

<img src="/images/postinstall_error.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

This screen ask to the user : **"Do you trust this server that host this website?"**
It could afraid a lot of users (rightly).

To avoid this confusion, it's possible to get a signed certificate  by a "known" authority : **Gandi**, **RapidSSL**, **StartSSL**, **CaCert**.
In these cases, the point is to replace the self-signed certificate with the one that has been certified by a certificate authority, and the users won't have this warning screen anymore.

### Add a signed certificate by an authority

Get your certificate from your CA, you must get a private key, file key and a public certificate (file .crt)
> Be carefull, the key file is very critical, it's strictly personal and have to be secured.

Copy this two files on the server, if not.

```bash
scp CERTIFICAT.crt admin@DOMAIN.TLD:ssl.crt
scp CLE.key admin@DOMAIN.TLD:ssl.key
```

From Windows, scp can be used with putty, download [pscp](http://the.earth.li/~sgtatham/putty/latest/x86/pscp.exe)

```bash
pscp -P 22 CERTIFICAT.crt admin@DOMAIN.TLD:ssl.crt
pscp -P 22 CLE.key admin@DOMAIN.TLD:ssl.key```

Now the files are in the server. Open a shell on the server use [ssh](https://yunohost.org/#/ssh_fr) or locally.

First, create a directory for archive the certificates.

```bash
sudo mkdir /etc/yunohost/certs/DOMAIN.TLD/ae_certs
sudo mv ssl.key ssl.crt /etc/yunohost/certs/DOMAIN.TLD/ae_certs/```

Then go to the parent directory and go on.

```bash
cd /etc/yunohost/certs/DOMAIN.TLD/```

Make a backup of the YunoHost original certificates , to be safe!

```bash
sudo mkdir yunohost_self_signed
sudo mv *.pem *.cnf yunohost_self_signed/```

Depends on the CA, intermediate certificates and root have to be downloaded.

> **StartSSL**
> ```bash
> sudo wget http://www.startssl.com/certs/ca.pem -O ae_certs/ca.pem
> sudo wget http://www.startssl.com/certs/sub.class1.server.ca.pem -O ae_certs/intermediate_ca.pem```

> **Gandi**
> ```bash
> sudo wget https://www.gandi.net/static/CAs/GandiStandardSSLCA.pem -O ae_certs/intermediate_ca.pem```

> **RapidSSL**
> ```bash
> sudo wget https://knowledge.rapidssl.com/library/VERISIGN/INTERNATIONAL_AFFILIATES/RapidSSL/AR1548/RapidSSLCABundle.txt -O ae_certs/intermediate_ca.pem```

> **Cacert**
> ```bash
> sudo wget http://www.cacert.org/certs/root.crt -O ae_certs/ca.pem
> sudo wget http://www.cacert.org/certs/class3.crt -O ae_certs/intermediate_ca.pem```

Intermediate certificates and root must be merged with certificates obtained to create a unified chain certificates.

If you use a root certificate (Cacert):

```bash
cat ae_certs/ssl.crt ae_certs/intermediate_ca.pem ae_certs/ca.pem | sudo tee crt.pem```

If you use only an intermediate certificate (StartSSL).

```bash
cat ae_certs/ssl.crt ae_certs/intermediate_ca.pem | sudo tee crt.pem```

The private key have to be converted in PEM format.

```bash
sudo openssl rsa -in ae_certs/ssl.key -out key.pem -outform PEM```

Check certificates syntaxe, check file contents.

```bash
cat crt.pem key.pem```

Certificates and private key look like this :

`-----BEGIN CERTIFICATE-----`    
`MIICVDCCAb0CAQEwDQYJKoZIhvcNAQEEBQAwdDELMAkGA1UEBhMCRlIxFTATBgNV`
`BAgTDENvcnNlIGR1IFN1ZDEQMA4GA1UEBxMHQWphY2NpbzEMMAoGA1UEChMDTExC`
`MREwDwYDVQQLEwhCVFMgSU5GTzEbMBkGA1UEAxMSc2VydmV1ci5idHNpbmZvLmZy`
`MB4XDTA0MDIwODE2MjQyNloXDTA0MDMwOTE2MjQyNlowcTELMAkGA1UEBhMCRlIx`
`FTATBgNVBAgTDENvcnNlIGR1IFN1ZDEQMA4GA1UEBxMHQWphY2NpbzEMMAoGA1UE`
`ChMDTExCMREwDwYDVQQLEwhCVFMgSU5GTzEYMBYGA1UEAxMPcHJvZi5idHNpbmZv`
`LmZyMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDSUagxPSv3LtgDV5sygt12`
`kSbN/NWP0QUiPlksOkF2NkPfwW/mf55dD1hSndlOM/5kLbSBo5ieE3TgikF0Iktj`
`BWm5xSqewM5QDYzXFt031DrPX63Fvo+tCKTQoVItdEuJPMahVsXnDyYHeUURRWLW`
`wc0BzEgFZGGw7wiMF6wt5QIDAQABMA0GCSqGSIb3DQEBBAUAA4GBALD640iwKPMf`
`pqdYtfvmLnA7CiEuao60i/pzVJE2LIXXXbwYjNAM+7Lov+dFT+b5FcOUGqLymSG3`
`kSK6OOauBHItgiGI7C87u4EJaHDvGIUxHxQQGsUM0SCIIVGK7Lwm+8e9I2X0G2GP`    
`9t/rrbdGzXXOCl3up99naL5XAzCIp6r5`  
`-----END CERTIFICATE-----`

At last, secure files of your certificate

```bash
sudo chown root:metronome crt.pem key.pem
sudo chmod 640 crt.pem key.pem
sudo chown root:root -R ae_certs
sudo chmod 600 -R ae_certs```

Reload Nginx configuration to take into account the new certificate.

```bash
sudo service nginx reload```

Your certificate is ready to serve. You can check that every thing is correct byan external service like <a href="https://www.geocerts.com/ssl_checker" target="_blank">geocerts</a>

