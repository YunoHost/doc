---
title: Certificati personalizzati
template: docs
taxonomy:
    category: docs
routes:
  default: '/certificate_custom'
---

! **Nota:** dalla versione 2.5 YunoHost integra la gestione automatizzata dei certificati Let's Encrypt. Potete quindi facilmente e gratuitamente  [installare un certificato Let's Encrypt](/certificate). Questa guida descrive la procedura per installare un certificato, a pagamento, di una diversa autorità di certificazione (**Gandi**, **RapidSSL**, **StartSSL**, **Cacert**).

Nel corso delle versioni, sono state introdotte delle modifiche che possono impattare sulle procedure descritte di seguito:

- Il gruppo metronome non è più utilizzato direttamente ma viene usato ssl-cert.
- La directory `/etc/yunohost/certs/DOMAIN.LTD-history/stamp` viene utilizzata per salvare le configurazioni create e viene creato un link simbolico.

### Installazione di un certificato firmato da un'autorità diversa da Let's Encrypt 

Dopo aver creato il certificato presso l'autorità di certificazione scelta, sarete in possesso di una chiave privata, il file key e di un certificato pubblico, il file crt.
! Attenzione! il file key contiene dati sensibili, è strettamente personale e deve essere conservato in un luogo sicuro.

Questi due file devono essere copiati sul server.

```bash
scp CERTIFICAT.crt admin@DOMAIN.TLD:ssl.crt
scp CLE.key admin@DOMAIN.TLD:ssl.key
```

Nelle versioni precedenti Windows 10, per utilizzare scp dovrete installare Putty e il plugin [pscp](http://the.earth.li/~sgtatham/putty/latest/x86/pscp.exe).

```bash
pscp -P 22 CERTIFICATE.crt admin@DOMAIN.TLD:ssl.crt
pscp -P 22 KEY.key admin@DOMAIN.TLD:ssl.key
```

Una volta copiati i file, i passi successivi si faranno sul server via [ssh](/ssh) o in locale.
Per prima cosa create una directory per salvare i certificati in vostro possesso.


```bash
sudo mkdir /etc/yunohost/certs/DOMAIN.TLD/ae_certs
sudo mv ssl.key ssl.crt /etc/yunohost/certs/DOMAIN.TLD/ae_certs/
```

Spostatevi nella directory superiore

```bash
cd /etc/yunohost/certs/DOMAIN.TLD/
```

Eseguite un backup dei certificati auto firmati di YunoHost.

```bash
sudo mkdir yunohost_self_signed
sudo mv *.pem *.cnf yunohost_self_signed/
```

Per alcune autorità di certificazione, è necessario ottenere di altri certificati (intermediate e root).

#### StartSSL

```bash
sudo wget http://www.startssl.com/certs/ca.pem -O ae_certs/ca.pem
sudo wget http://www.startssl.com/certs/sub.class1.server.ca.pem -O ae_certs/intermediate_ca.pem
```

#### Gandi

```bash
sudo wget https://www.gandi.net/static/CAs/GandiStandardSSLCA2.pem -O ae_certs/intermediate_ca.pem
```

#### RapidSSL

```bash
sudo wget https://knowledge.rapidssl.com/library/VERISIGN/INTERNATIONAL_AFFILIATES/RapidSSL/AR1548/RapidSSLCABundle.txt -O ae_certs/intermediate_ca.pem
```

#### Cacert

```bash
sudo wget http://www.cacert.org/certs/root.crt -O ae_certs/ca.pem
sudo wget http://www.cacert.org/certs/class3.crt -O ae_certs/intermediate_ca.pem
```

I certificati intermedi e root devono essere collegati con il certificato "principale" a creare una unica catena di certificati.

```bash
cat ae_certs/ssl.crt ae_certs/intermediate_ca.pem ae_certs/ca.pem | sudo tee crt.pem
```

La chiave privata deve esser convertita nel formato `.pem`.

```bash
sudo openssl rsa -in ae_certs/ssl.key -out key.pem -outform PEM
```

Controllate la sintassi dei certificati, verificando il contenuto dei file.

```bash
cat crt.pem key.pem
```

I certificati e la chiave privata, devono assomigliare a questo:

```text
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

Infine mettete al sicuro i file del vostro certificato.

```bash
sudo chown root:metronome crt.pem key.pem
sudo chmod 640 crt.pem key.pem
sudo chown root:root -R ae_certs
sudo chmod 600 -R ae_certs
```

Adesso i certificati (i due files con estensione `.pem`) devono essere copiati in `/etc/yunohost/certs/DOMAIN.TLD`.

```bash
cp ae_certs/*.pem ./
```

Ricaricate la configurazione di NGINX per rendere effettive le modifiche effettuate.

```bash
sudo service nginx reload
```

Il certificato è pronto. Potete controllare la corretta configurazione e installazione utilizzando il servizio di [geocerts](https://www.geocerts.com/ssl_checker).
