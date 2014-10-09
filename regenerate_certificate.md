# Regenerate certificate

If you want to generate again -- not renewing -- a certificate for domain, you can follow those steps: 

(replace **example.org** with your domain)

```bash
# Save YunoHost's SSL directory location for readability
ssldir=/usr/share/yunohost/yunohost-config/ssl/yunoCA

# Backup current certificates for your domain
cp -a /etc/yunohost/certs/example.org /etc/yunohost/certs/example.org.back

# Remove certs and configuration file in it
rm /etc/yunohost/certs/example.org/{crt.pem,key.pem,openssl.cnf}

# Copy openSSL's configuration file
cp $ssldir/openssl.cnf /etc/yunohost/certs/

# Save the serial number of the new certificate
serial=$(cat "$ssldir/serial")

# Generate certificate and key
openssl req -new -config /etc/yunohost/certs/openssl.cnf -days 3650 -out $ssldir/certs/yunohost_csr.pem -keyout $ssldir/certs/yunohost_key.pem -nodes -batch

# Sign certificate with your server's CA
openssl ca -config /etc/yunohost/certs/openssl.cnf -days 3650 -in $ssldir/certs/yunohost_csr.pem -out $ssldir/certs/yunohost_crt.pem -batch

# Copy certificate and key to the right place
cp $ssldir/newcerts/$serial.pem /etc/yunohost/certs/crt.pem
cp $ssldir/certs/yunohost_key.pem /etc/yunohost/certs/key.pem

# Fix permissions
chmod 755 /etc/yunohost/certs
chmod 640 /etc/yunohost/certs/key.pem /etc/yunohost/certs/crt.pem
chmod 600 /etc/yunohost/certs/openssl.cnf

# Allow metronome to access those certificates
chown root:metronome /etc/yunohost/certs/key.pem /etc/yunohost/certs/crt.pem
```