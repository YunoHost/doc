#Certificate

Certificates are used to certify that your server is the genuine one and not a falsified one.

YunoHost provides a self-signed certificate.

Client software (web browser, email client, XMPP client, etc) typically requires you to manually add an exception for that self-signed certificate.

You can have a certificate signed by an authority, in which case you must upload the appropriate certificate KEY and CRT files to the following files:

* /etc/yunohost/certs/YourCertifiedDomain/crt.pem
* /etc/yunohost/certs/YourCertifiedDomain/key.pem

If you are buying your Certificate from a CA that provides you an intermediate CA, you might need to provide a crt file which is combined from your server crt and the intermediate crt.

`cat /path/to/your/ca.pem /path/to/your/server.pem > /etc/yunohost/certs/YourCertifiedDomain/bundle.pem`

You will need to change nginx crt in /etc/nginx/conf.d/YourCertifiedDomain.conf to:

`ssl_certificate /etc/yunohost/certs/YourCertifiedDomain/bundle.pem;`
