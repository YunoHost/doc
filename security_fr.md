
# Sécurité

YunoHost a été développé dans l’optique de fournir une sécurité maximale tout en restant accessible et facilement installable.

Tous les protocoles que YunoHost utilise sont **chiffrés**, les mots de passe ne sont pas stockés en clair, et par défaut chaque utilisateur n’accède qu’à son répertoire personnel.

Deux points sont néanmoins importants à noter :

* L’installation d’applications supplémentaires **augmente le nombre de failles** potentielles. Il est donc conseillé de se renseigner sur chacune d’elle **avant l’installation**, d’en comprendre le fonctionnement et juger ainsi l’impact que provoquerait une potentielle attaque. N’installez **que** les applications qui semblent importantes pour votre usage.

* Le fait que YunoHost soit un logiciel répandu augmente les chances de subir une attaque. Si une faille est découverte, elle peut potentiellement **toucher toutes les instances YunoHost** à un temps donné. Nous nous efforçons de corriger ces failles le plus rapidement possible, pensez donc à **mettre à jour régulièrement** votre système.

*Si vous avez besoin de conseil, n’hésitez pas à [nous demander](/help_fr).*

*Pour discuter d'une faille de sécurité, contactez l'[équipe sécurité de YunoHost](/security_team_fr).*

---

## Améliorer la sécurité

Si votre serveur YunoHost est dans un environnement de production critique ou que vous souhaitez améliorer sa sécurité, il est bon de suivre quelques bonnes pratiques.

**Attention :** *l’application des conseils suivants nécessite une connaissance avancée du fonctionnement et de l’administration d’un serveur. Pensez à vous renseigner avant de procéder à cette mise en place.*

### Authentification SSH par clé

Voici un [tutoriel plus détaillé](http://doc.ubuntu-fr.org/ssh#authentification_par_un_systeme_de_cles_publiqueprivee).

Par défaut, l’authentification SSH se fait avec le mot de passe d’administration. Il est conseillé de désactiver ce type d’authentification et de le remplacer par un mécanisme de clé de chiffrement.

**Sur votre ordinateur de bureau :**

```bash
ssh-keygen
ssh-copy-id -i ~/.ssh/id_rsa.pub <votre_serveur_yunohost>
```
<div class="alert alert-info" markdown="1">
Si vous êtes sur Ubuntu 16.04 vous devez faire  `ssh-add` pour initialiser l'agent ssh
</div>

Entrez le mot de passe d’administration et votre clé publique devrait être copiée sur votre serveur.

**Sur votre serveur**, éditez le fichier de configuration SSH, pour désactiver l’authentification par mot de passe.
```bash
nano /etc/ssh/sshd_config

# Modifiez ou ajoutez la ligne suivante
PasswordAuthentication no
```

Sauvegardez et relancez le démon SSH.
```bash
systemctl restart ssh
```

---

### Modifier le port SSH

Pour éviter des tentatives de connexion SSH par des robots qui scannent tout Internet pour tenter des connexions SSH avec tout serveur accessible, on peut modifier le port SSH.

**Sur votre serveur**, éditez le fichier de configuration SSH, pour modifier le port SSH.

```bash
nano /etc/ssh/sshd_config
```

**Recherchez la ligne « Port »** et remplacez le numéro du port (par défaut 22) par un autre numéro non utilisé

```bash
Port 22 # à remplacer par exemple par 9777
```

**Ouvrez le port** choisi dans le parefeu (vous pouvez utiliser l'option `-6` pour interdire la connexion via ipv4)

```bash
yunohost firewall allow TCP <votre_numero_de_port_ssh>
```

Sauvegardez et relancez le démon SSH.

```bash
systemctl restart ssh
```

Ensuite redémarrez le firewall iptables et fermez l’ancien port dans iptables.

```bash
yunohost firewall reload
yunohost firewall disallow TCP <votre numéro de port> # port par défaut 22
``` 

Il convient également de donner à `fail2ban` le nouveau port SSH à bloquer en cas de bannissement d'une adresse IP.

Pour cela il suffit de créer le fichier de configuration `my_ssh_port.conf` avec

```bash
nano /etc/fail2ban/jail.d/my_ssh_port.conf
``` 

et de le compléter ainsi :

```bash
[sshd]
port = <votre_numero_de_port_ssh>

[sshd-ddos]
port = <votre_numero_de_port_ssh>
```

Il reste enfin à relancer `fail2ban` pour prendre en compte la nouvelle configuration 

```bash
systemctl restart fail2ban
``` 

**Pour les prochaines connexions SSH**, il faudra ajouter l’option `-p` suivie du numéro de port SSH.

**Exemple** :

```bash
ssh -p <votre_numero_de_port_ssh> admin@<votre_serveur_yunohost>
``` 

---

### Changer l’utilisateur autorisé à se connecter par SSH

Afin d’éviter de multiples tentatives de forçage du login admin par des robots, on peut éventuellement changer l’utilisateur autorisé à se connecter.

<div class="alert alert-info" markdown="1">
Dans le cas d’une authentification par clé, la force brute n’a aucune chance de réussir. Cette étape n’est donc pas vraiment utile dans ce cas
</div>

**Sur votre serveur**, ajoutez un utilisateur.
```bash
sudo adduser nom_utilisateur
```
Choisissez un mot de passe fort, puisque c’est l’utilisateur qui sera chargé d’obtenir des droits root.
Ajoutez l’utilisateur au groupe sudo, afin justement de l’autoriser à effectuer des tâches de maintenance nécessitant les droits root.
```bash
sudo adduser nom_utilisateur sudo
```

À présent, modifiez la configuration SSH pour autoriser ce nouvel utilisateur à se connecter.
**Sur votre serveur**, éditez le fichier de configuration SSH
```bash
sudo nano /etc/ssh/sshd_config

# Recherchez le paragraphe « Authentication » et ajoutez à la fin de celui-ci :
AllowUsers nom_utilisateur
```
Seuls les utilisateurs mentionnés dans la directive AllowUsers seront alors autorisés à se connecter via SSH, ce qui exclut donc l’utilisateur admin.

Sauvegardez et relancez le démon SSH.
```bash
systemctl restart ssh
```

---

### Durcir la sécurité de la configuration des services

La configuration TLS par défaut des services tend à offrir une bonne compatibilité avec les vieux appareils. Vous pouvez régler cette politique pour les services SSH et NGINX. Par défaut, la configuration du NGINX suit la [recommandation de compatibilité intermédiaire] (https://wiki.mozilla.org/Security/Server_Side_TLS#Intermediate_compatibility_.28default.29) de Mozilla. Vous pouvez choisir de passer à la configuration "moderne" qui utilise des recommandations de sécurité plus récentes, mais qui diminue la compatibilité, ce qui peut poser un problème pour vos utilisateurs et visiteurs qui utilisent de vieux appareils. Plus de détails peuvent être trouvés sur [cette page](https://wiki.mozilla.org/Security/Server_Side_TLS#Modern_compatibility).

Changer le niveau de compatibilité n'est pas définitif et il est possible de rechanger le paramètre si vous concluez qu'il faille revenir en arrière.

**Sur votre serveur**, modifiez la politique pour NGINX :
```bash
sudo yunohost settings set security.nginx.compatibility -v modern
```

**Sur votre serveur**, modifiez la politique pour SSH :
```bash
sudo yunohost settings set security.ssh.compatibility -v modern
```

### Désactivation de l’API YunoHost

YunoHost est administrable via une **API HTTP**, servie sur le port 6787 par défaut (seulement sur `localhost`). Elle permet d’administrer une grande partie de votre serveur, et peut donc être utilisée à des **fins malveillantes**. La meilleure chose à faire si vous êtes habitués aux lignes de commande est de désactiver le service `yunohost-api`, et **utiliser la [ligne de commande](/commandline_fr)** en SSH.

```bash
sudo systemctl disable yunohost-api
sudo systemctl stop yunohost-api
```

### Tests d’intrusion de YunoHost

Des [pentests](https://fr.wikipedia.org/wiki/pentest) ont été effectués sur une instance de YunoHost 2.4 :

- [1) Préparation](https://exadot.fr/blog/2016-07-03-pentest-dune-instance-yunohost-1-preparation)
- [2) Le fonctionnement](https://exadot.fr/blog/2016-07-12-pentest-dune-instance-yunohost-2-le-fonctionnement)
- [3) Audit en Black Box](https://exadot.fr/blog/2016-08-26-pentest-dune-instance-yunohost-3-audit-en-black-box)
- [4) Audit en Grey Box](https://exadot.fr/blog/2016-11-03-pentest-dune-instance-yunohost-4-audit-en-grey-box)
