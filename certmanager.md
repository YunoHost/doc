
Certificate management
======================

Managing certificates with Yunohost
-----------------------------------

The main feature of the certificate manager is to allow you to install Let's
Encrypt certificate on your domains without pain. You can use it from the web
administration (*SSL certificate* on a given domain info page), or from the
command line with `yunohost domain cert-status`, `cert-install` and
`cert-renew`.

#### What is required to be able to have a Let's Encrypt certificate ?

Your server needs to be reachable from the rest of Internet on port 80 (and
443), and make your `domain.tld` points to your server's public IP in your DNS
configuration. See [this documentation](hdiagnostic) if you need help.

#### Will my certificate be automatically be renewed ?

Yes. Right now, Let's Encrypt certificates are valid 90 days. A cron job will
run every day and attempt to renew any certificate that will expire in less than
15 days. An email will be sent to the root user if a renewal fails.

#### I want/need to use a certificate from a different CA than Let's Encrypt.

This cannot be done automatically for now. You will need to manually create a 
Certificate Signing Request (CSR) to be given to your CA, and manually import 
the certificate you get from it. Check out [this page](certificate) for more 
info. This process might be made easier by Yunohost in the future.

Migration procedure
--------------------

> Because of the current [rate limits](https://letsencrypt.org/docs/rate-limits/)
on new Let's Encrypt certificate emissions, we recommend that you **do not
migrate** to the new built-in management feature **as long as you don't need to**. 
This is especially true for nohost.me / noho.st users (and other domains services
sharing a common subdomain). If too many people migrate during the same period
of time, you might get stuck with a self-signed certificate for a few days !

#### I used the *letsencrypt_ynh* app

You will be asked to uninstall the app before being able to use the new
management feature. You can do it from the web administration interface, or from
the command line with :

```bash
yunohost app remove letsencrypt
yunohost domain cert-install
```

Be aware that the first command will revert your domains to self-signed
certificate. The second command will attempt to reinstall a Let's Encrypt
certificate on all your domains which have a self-signed certificate.


#### I manually installed my Let's Encrypt certificates

You should go in your nginx configuration, and remove the `letsencrypt.conf` (or
whatever you called the file containing the `location
'/.well-known/acme-challenge'` block) for each of your domains. Remove your 
certificate renewer cron job in `/etc/cron.weekly/`, and backup and remove your
`/etc/letsencrypt/` folder.

Then run :

```bash
yunohost domain cert-install your.domain.tld --force
```

for each of your domains you want a Let's Encrypt certificate.

Troubleshooting
---------------
  
#### Admin interfaces says the letsencrypt app is installed, but it's not, and I can't access the certificate management interface !

Make sure you refresh the cache of your browser (Ctrl + Shift + R on Firefox),
and report the issue on the forum or on the bugtracker. You can work around the
issue by using `yunohost domain cert-install your.domain.tld` from the command
line.

#### I tried to uninstall the letsencrypt app, but it broke my nginx conf !

Sorry about that. Some user reported that this happens when the uninstallation
script fails to find a backup of your self-signed certificate. Running `yunohost 
domain cert-install` should work anyway...

#### I get "Too many certificates already issued", what's happening ?

Currently, Let's Encrypt has a rate limit of issuing no more than 20 new
certificates by period of 7 days for a given subdomains. For example, `nohost.me`
and `noho.st` are already considered as subdomains themselves, meaning all users
of the nohost.me / noho.st service share the same common limit. According to
Let's Encrypt, this applies for *new* certificates, but not for renewals or
duplicates. If you encounter this limit, there isn't much to do except retrying 
a few days later.

#### Certificate installation fails, says "Wrote file to 'some path', but couldn't download 'some url'" !

This should be fixed in the future, but for now you might need to manually add the
following line in your `/etc/hosts` :

```bash
127.0.0.1 your.domain.tld
```

About certificates and Let's Encrypt
------------------------------------

#### What is HTTPS ? What's the point of SSL certificates ?

HTTPS is the secure version of the HTTP protocol, which describes how a client
(e.g. a web browser) and a server (e.g. nginx running on your Yunohost
instance) can talk to each other. HTTPS heavily relies on [asymmetric
cryptography](https://en.wikipedia.org/wiki/Public-key_cryptography) to achieve
two things :
- confidentiality, meaning that an attacker will not be able to decrypt the content of the communication if it is intercepted ;
- server's identification, meaning that a server can prove he is who it says it is, thus protecting against [man-in-the-middle attacks](https://en.wikipedia.org/wiki/Man-in-the-middle_attack).

SSL certificates is the technology used for server to prove their identity. The
whole process relies on trust in third parties called Certification Authorities
(CA), whose role is to verify the server identity (e.g. that a given machine
effectively controls the domain `ilikecoffee.com`) before delivering
[cryptographic certificates](https://en.wikipedia.org/wiki/Public_key_certificate).

#### Why do browsers complain about self-signed certificates ?

Self-signed certificates are, as their name says, self-signed, meaning that you
were your own certification authority in the process. Such a certificate does
not allow to verify your server's identity, since it could have easily been
generated by an attacker on its own, attempting to perform man-in-the-middle
attacks.

#### What's up with Let's Encrypt ?

Historically, the process of verifying the identity of a server often required
human intervention, time and money.

In 2015, Let's Encrypt, developped a protocol called
[ACME](https://en.wikipedia.org/wiki/Automated_Certificate_Management_Environment),
which allows to automatically verify that a machine controls a domain, and deliver
certificates for free, drastically reducing the cost of setting up a SSL
certificate.

#### How does Let's Encrypt works ?

To verify your server's identity and deliver the certificate, Let's Encrypt uses
the [ACME
protocol](https://en.wikipedia.org/wiki/Automated_Certificate_Management_Environment). It
basically works as follow (it's simplified, but you'll get the idea) :
- A program running on your server contacts the Let's Encrypt CA server, ask for
  a certificate for domain `ilikecoffee.com`.
- The Let's Encrypt CA server generates a random string such as `A84F2D0B`, and
  tells the program on your server to prove it operates the domain
  `ilikecoffee.com` by making the URI `http://ilikecoffee.com/.well-known/acme-challenge/A84F2D0B` 
  accessible.
- The program on your server edit/creates files accordingly.
- The Let's Encrypt CA server attempt to access the URI. If it works, then it
  concludes the program indeed operates the domain `ilikecoffee.com`. It
  delivers a certificate.
- The program on your server obtains the certificate and setups it.

#### Do we really need Certification Authorities ? 

The reliance on Certification Authorities can be criticized, as they represent
points of failure in the security scheme. Some trusted CAs have been found to
issue rogue certificates in the past, sometimes with critical implications
[[1](http://www.darkreading.com/endpoint/authentication/fake-google-digital-certificates-found-and-confiscated/d/d-id/1297165),
[2](https://reflets.info/microsoft-et-ben-ali-wikileaks-confirme-les-soupcons-d-une-aide-pour-la-surveillance-des-citoyens-tunisiens/)].

Alternatives have been proposed, such as
[DANE/DNSSEC](https://en.wikipedia.org/wiki/DNS-based_Authentication_of_Named_Entities),
which is based on the DNS system does not require certification authorities.


