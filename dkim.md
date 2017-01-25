# DKIM

<div class="alert alert-danger">This page is deprecated. DKIM is now by default integrated in YunoHost with [Rspamd](https://rspamd.com)/rmilter.</div>
Now you just need to add a zone in your DNS configuration according to the file /etc/dkim/yourdomainname.tld.mail.txt</div>


##### Note:
* This is the 2nd revision of this Work In Progress How-To activate [DKIM](https://en.wikipedia.org/wiki/DomainKeys_Identified_Mail) and [SPF](https://en.wikipedia.org/wiki/Sender_Policy_Framework) in YunoHost.
* Le DKIM and SPF prevent emails which could be sent with your domain name from a non legitim server. This avoid spam.
* Untill, this is not natively integrated in YunoHost core, it will mean to that Postfix configuration will be blocked (or each time there is a change some configuration lines will need to be added to the end of `/etc/postfix/main.cf`).
* To be fully functionnal DKIM requires a modification of your [DNS zone](/dns_config_en), which propagantion can take up to 24h.

##### Sources:
* This tutorial has been initially based on the DKMI section of: http://sealedabstract.com/code/nsa-proof-your-e-mail-in-2-hours/ from Drew Crawford.
* This tutorial has been reviewed based on https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-dkim-with-postfix-on-debian-wheezy from Popute Sebastian Armin

Replace `DOMAIN.TLD` by your own domain name.

Changes in 2n revision:
Much easier to manage more than one DOMAIN.TLD (future proof).
Updated configuration as it seemed that the previous one was based on old software.

So, here is the thing:
### With a script
Fully automatic script: (single domain)
```bash
git clone https://github.com/polytan02/yunohost_auto_config_basic
cd yunohost_auto_config_basic
sudo ./5_opendkim.sh
```

### Manually
We start by installing the right software: 
```bash
sudo aptitude install opendkim opendkim-tools
```

Then we configure opendkim 
```bash
sudo nano /etc/opendkim.conf
```

Text to be placed in the text file:
```bash
AutoRestart Yes
AutoRestartRate 10/1h
UMask 022
Syslog yes
SyslogSuccess Yes
LogWhy Yes

Canonicalization relaxed/simple

ExternalIgnoreList refile:/etc/opendkim/TrustedHosts
InternalHosts refile:/etc/opendkim/TrustedHosts
KeyTable refile:/etc/opendkim/KeyTable
SigningTable refile:/etc/opendkim/SigningTable

Mode sv
PidFile /var/run/opendkim/opendkim.pid
SignatureAlgorithm rsa-sha256

UserID opendkim:opendkim

Socket inet:8891@127.0.0.1

Selector mail
```

Connect the milter to Postfix:
```bash
sudo nano /etc/default/opendkim
```

Text to be placed in the text file:
```bash
SOCKET="inet:8891@localhost"
```

Configure Postfix to use this milter:
```bash
sudo nano /etc/postfix/main.cf
```

Text to be placed **at the end** in the text file: 
```bash
# OpenDKIM milter 

milter_protocol = 2
milter_default_action = accept
smtpd_milters = inet:127.0.0.1:8891
non_smtpd_milters = inet:127.0.0.1:8891
```

Create a directory structure that will hold the trusted hosts, key tables, signing tables and crypto keys:
```bash
sudo mkdir -pv /etc/opendkim/keys/DOMAIN.TLD
```

Specify trusted hosts:
```bash
sudo nano /etc/opendkim/TrustedHosts
```

Text to be placed in the text file: 
```bash
127.0.0.1
localhost
192.168.0.1/24
*.DOMAIN.TLD
```

Create a key table:
```bash
sudo nano /etc/opendkim/KeyTable
```

Text to be placed in the text file: be very careful, it needs to be on a **single line** for each domain.
```bash
mail._domainkey.DOMAIN.TLD DOMAIN.TLD:mail:/etc/opendkim/keys/DOMAIN.TLD/mail.private
```

Create a signing table:
```bash
sudo nano /etc/opendkim/SigningTable
```

Text to be placed in the text file: 
```bash
*@DOMAIN.TLD mail._domainkey.DOMAIN.TLD
```

Now we generate the keys! smile 
```bash
sudo cd /etc/opendkim/keys/DOMAIN.TLD
sudo opendkim-genkey -s mail -d DOMAIN.TLD
```

Output the DKIM DNS line to the terminal. Then, we install it on our DNS server. My ZONE file looks like this. (Be very careful with the formatting, the "p=...." needs to be in a single line.)
```bash
cat mail.txt

mail._domainkey IN TXT "v=DKIM1; k=rsa; p=AAAKKUHGCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDPFrBM54eXlZPXLJ7EFphiA8qGAcgu4lWuzhzxDDcIHcnA/fdklG2gol1B4r27p87rExxz9hZehJclaiqlaD8otWt8r/UdrAUYNLKNBFGHJ875467jstoAQAB" ; ----- DKIM key mail for DOMAIN.TLD
```

And we don't forget to put the right rights otherwise opendkim will get grumpy...
```bash
chown -Rv opendkim:opendkim /etc/opendkim*
```

And finally, we restart everything:
```bash
sudo service opendkim restart
sudo service postfix restart
```

To test if it is all working well (don't forget that the DNS propagation can take a bit of take…) you can simply go to [mail-tester.com](http://www.mail-tester.com) and send an e-mail to the address indicated. Then follow the link and the result will appear.
 
# SPF
Lastly, don't forget to add a SPF key in your [DNS zone](/dns_config_en) such as:
```bash
DOMAIN.TLD 300 TXT "v=spf1 a:DOMAIN.TLD ip4:<server public IPv4> ip6:<server public IPv6> mx ?all"
 ```

As reminder, the SPF field shows that the only machine using the IP address shows in your DNS zone are authorized to send emails.
If you don't have IPv6 on your email server, simply delete le ip6:<...> section
