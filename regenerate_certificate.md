# Regenerate certificate

If you want to generate again -- not renewing -- a certificate for a domain, you can follow those steps: 

(replace **example.org** with your domain)

```bash
# Save YunoHost's SSL directory location for readability
ssldir=/usr/share/yunohost/yunohost-config/ssl/yunoCA

# Save the final SSL path (do not forget to change your domain)
finalpath=/etc/yunohost/certs/example.org

# Save the serial number of the new certificate
serial=$(cat "$ssldir/serial")

# Backup current certificates for your domain
cp -a $finalpath $finalpath.back

# Remove certs and configuration file in it
rm $finalpath/{crt.pem,key.pem,openssl.cnf}

# Copy openSSL's configuration file
cp $ssldir/openssl.cnf $finalpath/

# Change yunohost.org with your domain in the configuration
sed -i "s/yunohost.org/example.org/g" $finalpath/openssl.cnf

# Generate certificate and key
openssl req -new -config $finalpath/openssl.cnf -days 3650 -out $ssldir/certs/yunohost_csr.pem -keyout $ssldir/certs/yunohost_key.pem -nodes -batch

# Sign certificate with your server's CA
openssl ca -config $finalpath/openssl.cnf -days 3650 -in $ssldir/certs/yunohost_csr.pem -out $ssldir/certs/yunohost_crt.pem -batch

# Copy certificate and key to the right place
cp $ssldir/newcerts/$serial.pem $finalpath/crt.pem
cp $ssldir/certs/yunohost_key.pem $finalpath/key.pem

# Fix permissions
chmod 755 $finalpath
chmod 640 $finalpath/key.pem $finalpath/crt.pem
chmod 600 $finalpath/openssl.cnf

# Allow metronome to access those certificates
chown root:metronome $finalpath/key.pem $finalpath/crt.pem
```