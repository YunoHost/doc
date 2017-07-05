#Régénérer un certificat auto signé

Si vous désirez générer à nouveau — et non renouveler — un certificat pour un domain, suivre les étapes suivantes :

(remplacer **example.org** avec votre domaine)

```bash
# Sauvegarde du répertoire SSL de YunoHost, pour la lisibilité
ssldir=/usr/share/yunohost/yunohost-config/ssl/yunoCA

# Sauvegarde du chemin final SSL (ne pas oublier de modifier avec votre domaine)
finalpath=/etc/yunohost/certs/example.org

# Sauvegarde du numéro de série du nouveau certificat
serial=$(cat "$ssldir/serial")

# Sauvegarde du certificat actuel du domaine
cp -a $finalpath $finalpath.back

# Suppression des certificats et des fichiers de configuration
rm $finalpath/{crt.pem,key.pem,openssl.cnf}

# Copie du fichier de configuration d’openSSL
cp $ssldir/openssl.cnf $finalpath/

# Changement de la configuration yunohost.org avec votre domaine
# NE PAS OUBLIER DE REMPLACER example.org !
sed -i "s/yunohost.org/example.org/g" $finalpath/openssl.cnf

# Generation du certificat et de la clé
openssl req -new -config $finalpath/openssl.cnf -days 3650 -out $ssldir/certs/yunohost_csr.pem -keyout $ssldir/certs/yunohost_key.pem -nodes -batch

# Signature du certificat avec le CA du serveur
openssl ca -config $finalpath/openssl.cnf -days 3650 -in $ssldir/certs/yunohost_csr.pem -out $ssldir/certs/yunohost_crt.pem -batch

# Copie du certificat et de la clé au bon endroit
cp $ssldir/newcerts/$serial.pem $finalpath/crt.pem
cp $ssldir/certs/yunohost_key.pem $finalpath/key.pem

# Réparation des permissions
chmod 755 $finalpath
chmod 640 $finalpath/key.pem $finalpath/crt.pem
chmod 600 $finalpath/openssl.cnf

# Autoriser metronome à accéder aux certificats
chown root:metronome $finalpath/key.pem $finalpath/crt.pem
```
