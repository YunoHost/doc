---
title: Certificats personnalisés
template: docs
taxonomy:
    category: docs
routes:
  default: '/certificate_custom'
---

**Note :** depuis la version 2.5, YunoHost intègre la gestion automatisée de certificats Let's Encrypt. Vous pouvez donc facilement et gratuitement [installer un certificat Let's Encrypt](/certificate). Le document suivant décrit la méthodologie pour installer un certificat, payant, d'une autre autorité de certification (**Gandi**, **RapidSSL**, **StartSSL**, **Cacert**).

Quelques changements ont eu lieu qui impactent les procédures indiquées ci-dessous :

* Le groupe metronome n'est plus utilisé directement mais ssl-cert.
* Un repertoire `/etc/yunohost/certs/DOMAIN.LTD-history/stamp` est utilisé pour conserver chaque configuration créée et un lien symbolique est créé dessus.

### Ajout d’un certificat signé par une autorité (autre que Let's Encrypt)

Après création du certificat auprès de votre autorité d’enregistrement, vous devez être en possession d’une clé privée, le fichier *key* et d’un certificat public, le fichier *crt*.
> Attention, le fichier *key* est très sensible, il est strictement personnel et doit être très bien sécurisé.

Ces deux fichiers doivent être copiés sur le serveur, s’ils ne s’y trouvent pas déjà.

```bash
scp CERTIFICAT.crt admin@DOMAIN.TLD:ssl.crt
scp CLE.key admin@DOMAIN.TLD:ssl.key
```

Depuis Windows, scp est exploitable avec Putty, en téléchargeant l’outil [pscp](http://the.earth.li/~sgtatham/putty/latest/x86/pscp.exe)

```bash
pscp -P 22 CERTIFICAT.crt admin@DOMAIN.TLD:ssl.crt
pscp -P 22 CLE.key admin@DOMAIN.TLD:ssl.key
```

Dès lors que les fichiers sont sur le serveur, le reste du travail se fera sur celui-ci. En [ssh](/ssh) ou en local.

Tout d’abord, créez un dossier pour stocker les certificats obtenus.

```bash
sudo mkdir /etc/yunohost/certs/DOMAIN.TLD/ae_certs
sudo mv ssl.key ssl.crt /etc/yunohost/certs/DOMAIN.TLD/ae_certs/
```

Puis allez dans le dossier parent pour poursuivre.

```bash
cd /etc/yunohost/certs/DOMAIN.TLD/
```

Faites une sauvegarde des certificats d’origine de YunoHost, par précaution.

```bash
sudo mkdir yunohost_self_signed
sudo mv *.pem *.cnf yunohost_self_signed/
```

En fonction de l’autorité d’enregistrement, des certificats intermédiaires et racines doivent être obtenus.

> **StartSSL**
> ```bash
> sudo wget http://www.startssl.com/certs/ca.pem -O ae_certs/ca.pem
> sudo wget http://www.startssl.com/certs/sub.class1.server.ca.pem -O ae_certs/intermediate_ca.pem
>```

> **Gandi**
> ```bash
> sudo wget https://www.gandi.net/static/CAs/GandiStandardSSLCA2.pem -O ae_certs/intermediate_ca.pem
>```

> **RapidSSL**
> ```bash
> sudo wget https://knowledge.rapidssl.com/library/VERISIGN/INTERNATIONAL_AFFILIATES/RapidSSL/AR1548/RapidSSLCABundle.txt -O ae_certs/intermediate_ca.pem
>```

> **Cacert**
> ```bash
> sudo wget http://www.cacert.org/certs/root.crt -O ae_certs/ca.pem
> sudo wget http://www.cacert.org/certs/class3.crt -O ae_certs/intermediate_ca.pem
>```

Les certificats intermédiaires et root doivent être réunis avec le certificat obtenu pour créer une chaîne de certificats unifiés.

```bash
cat ae_certs/ssl.crt ae_certs/intermediate_ca.pem ae_certs/ca.pem | sudo tee crt.pem
```

La clé privée doit être, elle, convertie au format `.pem`.

```bash
sudo openssl rsa -in ae_certs/ssl.key -out key.pem -outform PEM
```

Afin de s’assurer de la syntaxe des certificats, vérifiez le contenu des fichiers.

```bash
cat crt.pem key.pem
```

Les certificats et la clé privée doivent ressembler à cela :

```plaintext
-----BEGIN CERTIFICATE-----
MIICVDCCAb0CAQEwDQYJKoZIhvcNAQEEBQAwdDELMAkGA1UEBhMCRlIxFTATBgNV
BAgTDENvcnNlIGR1IFN1ZDEQMA4GA1UEBxMHQWphY2NpbzEMMAoGA1UEChMDTExC
MREwDwYDVQQLEwhCVFMgSU5GTzEbMBkGA1UEAxMSc2VydmV1ci5idHNpbmZvLmZy
MB4XDTA0MDIwODE2MjQyNloXDTA0MDMwOTE2MjQyNlowcTELMAkGA1UEBhMCRlIx
FTATBgNVBAgTDENvcnNlIGR1IFN1ZDEQMA4GA1UEBxMHQWphY2NpbzEMMAoGA1UE
ChMDTExCMREwDwYDVQQLEwhCVFMgSU5GTzEYMBYGA1UEAxMPcHJvZi5idHNpbmZv
LmZyMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDSUagxPSv3LtgDV5sygt12
kSbN/NWP0QUiPlksOkF2NkPfwW/mf55dD1hSndlOM/5kLbSBo5ieE3TgikF0Iktj
BWm5xSqewM5QDYzXFt031DrPX63Fvo+tCKTQoVItdEuJPMahVsXnDyYHeUURRWLW
wc0BzEgFZGGw7wiMF6wt5QIDAQABMA0GCSqGSIb3DQEBBAUAA4GBALD640iwKPMf
pqdYtfvmLnA7CiEuao60i/pzVJE2LIXXXbwYjNAM+7Lov+dFT+b5FcOUGqLymSG3
kSK6OOauBHItgiGI7C87u4EJaHDvGIUxHxQQGsUM0SCIIVGK7Lwm+8e9I2X0G2GP
9t/rrbdGzXXOCl3up99naL5XAzCIp6r5
-----END CERTIFICATE-----
```

Enfin, sécurisez les fichiers de votre certificat.

```bash
sudo chown root:metronome crt.pem key.pem
sudo chmod 640 crt.pem key.pem
sudo chown root:root -R ae_certs
sudo chmod 600 -R ae_certs
```

Maintenant les certificats (les deux fichiers avec l'extension `.pem`) doivent être recopiés dans `/etc/yunohost/certs/DOMAIN.TLD`.

```bash
cp ae_certs/*.pem ./
```

Rechargez la configuration de NGINX pour prendre en compte le nouveau certificat.

```bash
sudo service nginx reload
```

Votre certificat est prêt à servir. Vous pouvez toutefois vous assurer de sa mise en place en testant le certificat à l’aide du service de <a href="https://www.geocerts.com/ssl_checker" target="_blank">geocerts</a>. 
