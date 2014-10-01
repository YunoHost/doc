#Certificate

Certificates are used to certify that your server is the genuine one and not a falsified one.

YunoHost provides a self-signed certificate.

Client software (web browser, email client, XMPP client, etc) typically requires you to manually add an exception for that self-signed certificate.

You can have a certificate signed by an authority, in which case you must upload the appropriate certificate KEY and CRT files to the following files:

* /etc/yunohost/certs/YourCertifiedDomain/crt.pem
* /etc/yunohost/certs/YourCertifiedDomain/key.pem
