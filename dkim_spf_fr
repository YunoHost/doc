

Bonjour,

Veuillez noter les points suivants :

    Ceci est la 2eme version de ce travail en cours concernant l'activation de DKIM et SPF dans Yunohost 
    En attendant que tout ceci soit intégré nativement dans YnH, cela necessitera une modif de la conf de postfix dans /etc/postfix/main.cf
    Pour fonctionner correctement, DKIM ncécessite une modification de vos DNS. N'oubliez pas que la propagation de l'information DNS une fois modifiée peut prendre jusqu'à 24h !
    CREDIT : Ce document a été initialement basé sur : http://sealedabstract.com/code/nsa-proof-your-e-mail-in-2-hours/ from Drew Crawford
    CREDIT : Cette 2ème révision s'appuie lourdement de : https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-dkim-with-postfix-on-debian-wheezy from Popute Sebastian Armin
    Dans la suite de ce document, replacez DOMAIN.TLD par votre propre nom de domaine.

Changement dans la rev 2 :

    La config s'adapte très facilement à plusieurs noms de domaines simultanés
    Mise à jour des paramètres de configuration avec la dernière version de opendkim disponible dans Debian 7

Rentrons maintenant dans le coeur du sujet :

    On commence par installer les logiciels : 

sudo aptitude install opendkim opendkim-tools

    Ensuite on configure opendkim 

sudo nano /etc/opendkim.conf
(Texte à insérer dans le document: )

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

    On connecte ensuite le milter à Postfix:

sudo nano /etc/default/opendkim

(Texte à insérer dans le document: )
SOCKET="inet:8891@localhost"

    Configurer postfix pour utiliser ce milter:

sudo nano /etc/postfix/main.cf

(Texte à insérer A LA FIN du document: )
milter_protocol = 2
milter_default_action = accept
smtpd_milters = inet:127.0.0.1:8891
non_smtpd_milters = inet:127.0.0.1:8891

    Créer la structure de dossiers qui contiendra la clé, les hotes connues et quelques tableaux de données :

sudo mkdir -pv /etc/opendkim/keys/DOMAIN.TLD

    On précise les hôtes de confiance :

sudo nano /etc/opendkim/TrustedHosts

(Texte à insérer dans le document: )
127.0.0.1
localhost
192.168.0.1/24
*.DOMAIN.TLD

    Créer le tableau des clés :

sudo nano /etc/opendkim/KeyTable

(Texte à insérer dans le document:  Faites très attention, ça doit rester SUR UNE SEULE LIGNE pour chaque domaine)
mail._domainkey.DOMAIN.TLD DOMAIN.TLD:mail:/etc/opendkim/keys/DOMAIN.TLD/mail.private

    Créer un tableau des signatures :

sudo nano /etc/opendkim/SigningTable

(Texte à insérer dans le document: )
*@DOMAIN.TLD mail._domainkey.DOMAIN.TLD

    Maintenant on peut générer nos clés ! 

sudo cd /etc/opendkim/keys/DOMAIN.TLD
sudo opendkim-genkey -s mail -d DOMAIN.TLD

    On affiche les paramètres DNS de DKIM générés par opendkim dans le terminal.
    Ensuite, on installera la clé DKIM dans notre DNS. Ma zone DNS ressemble à l'exemple ci-dessous. 
    (Faites très attention à la casse, le "p=...." doit rester sur une seule ligne dans le DNS et pas sur plusieurs, sinon cela ne sera pas accepté ni reconnu)

cat mail.txt

mail._domainkey IN TXT "v=DKIM1; k=rsa; p=AAAKKUHGCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDPFrBM54eXlZPXLJ7EFphiA8qGAcgu4lWuzhzxDDcIHcnA/fdklG2gol1B4r27p87rExxz9hZehJclaiqlaD8otWt8r/UdrAUYNLKNBFGHJ875467jstoAQAB" ; ----- DKIM key mail for DOMAIN.TLD

    Et surtout, on oublie pas de donner les bons droit d'accès à opendkim aux fichiers créés par root...

chown -Rv opendkim:opendkim /etc/opendkim*

    Et enfin, on redémarre le tout :

sudo service opendkim restart
sudo service postfix restart

    Pour tester que tout fonctionne bien (n'oubliez pas que la propagation DNS peut prendre jusqu'à 24h...) vous pouvez tout simplement envoyer un email à check-auth@verifier.port25.com . VOus recevrez une reponse automatiquement. Si tout se passe bien, vous verrez DKIM check: pass dans la section Summary of Results.

