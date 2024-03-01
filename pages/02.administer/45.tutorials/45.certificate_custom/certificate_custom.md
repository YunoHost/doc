---
title: Custom certificates
template: docs
taxonomy:
    category: docs
routes:
  default: '/certificate_custom'
---

! **Note:** since version 2.5, YunoHost integrates Let's Encrypt certificates automated management. You can easily and freely [install a Let's Encrypt certificate](/certificate). The following document describes the steps for installing a paid certificate from a certification authority (**Gandi**, **RapidSSL**, **StartSSL**, **Cacert**).

Some changes have taken place which impact the procedures indicated below:

* Metronome group is no longer used directly but ssl-cert.
* A `/etc/yunohost/certs/DOMAIN.LTD-history/stamp` directory is used to keep each configuration created and a symlink is created.

### Adding a signed certificate by an authority (other than Let's Encrypt)

After the certificate creation with your registration authority, you must have a private key, the key file, and a public certificate, the crt file.
> Note that the key file is very sensitive, it is strictly personal and must be very well secured.

These two files should be copied to the server, if they are not already there.

```bash
scp CERTIFICATE.crt admin@DOMAIN.TLD:ssl.crt
scp KEY.key admin@DOMAIN.TLD:ssl.key
```

From Windows, scp can be used with Putty, by downloading the tool [pscp](http://the.earth.li/~sgtatham/putty/latest/x86/pscp.exe)

```bash
pscp -P 22 CERTIFICATE.crt admin@DOMAIN.TLD:ssl.crt
pscp -P 22 KEY.key admin@DOMAIN.TLD:ssl.key
```

As soon as the files are on the server, the rest of the work will be done on it. In [ssh](/ssh) or locally.
First, create a folder to store the obtained certificates.

```bash
sudo mkdir /etc/yunohost/certs/DOMAIN.TLD/ae_certs
sudo mv ssl.key ssl.crt /etc/yunohost/certs/DOMAIN.TLD/ae_certs/
```

Then, go to the parent folder to continue.

```bash
cd /etc/yunohost/certs/DOMAIN.TLD/
```

As a caution, back up the certificates of origin from YunoHost.

```bash
sudo mkdir yunohost_self_signed
sudo mv *.pem *.cnf yunohost_self_signed/
```

Depending on the registration authority, intermediate and root certificates must be obtained.

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

Intermediate and root certificates must be combined with the obtained certificate to create a unified certificate chain.

```bash
cat ae_certs/ssl.crt ae_certs/intermediate_ca.pem ae_certs/ca.pem | sudo tee crt.pem
```

The private key must be converted to `.pem` format.

```bash
sudo openssl rsa -in ae_certs/ssl.key -out key.pem -outform PEM
```

To ensure the certificates syntax, check the files contents.

```bash
cat crt.pem key.pem
```

The certificates and private key should look like this:

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

Finally, secure your certificate files.

```bash
sudo chown root:metronome crt.pem key.pem
sudo chmod 640 crt.pem key.pem
sudo chown root:root -R ae_certs
sudo chmod 600 -R ae_certs
```

Now the certificates (two files with the extension `.pem`) must be copied in `/etc/yunohost/certs/DOMAIN.TLD`.

```bash
cp ae_certs/*.pem ./
```

Reload NGINX configuration to take into account the new certificate.

```bash
sudo service nginx reload
```

Your certificate is ready. However, you can ensure that it is in place by testing the certificate using the <a href="https://www.geocerts.com/ssl_checker" target="_blank">geocerts</a>. 

