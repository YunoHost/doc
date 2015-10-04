
# Securité

YunoHost a été développé dans l’optique de fournir une sécurité maximale tout en restant accessible et facilement installable.

Tous les protocoles que YunoHost utilise sont **chiffrés**, les mots de passe ne sont pas stockés en clair, et par défaut chaque utilisateur n’accède qu’à son répertoire personnel.

Deux points sont néanmoins importants à noter :

* L’installation d’applications supplémentaires **augmente le nombre de failles** potentielles. Il est donc conseillé de se renseigner sur chacune d’elle **avant l’installation**, d’en comprendre le fonctionnement et juger ainsi l’impact que provoquerait une potentielle attaque. N’installez **que** les applications qui semblent importantes pour votre usage.

* Le fait que YunoHost soit un logiciel répandu augmente les chances de subir une attaque. Si une faille est découverte, elle peut potentiellement **toucher toutes les instances YunoHost** à un temps donné. Nous nous efforçons de corriger ces failles le plus rapidement possible, pensez donc à **mettre à jour régulièrement** votre système.

*Si vous avez besoin de conseil, n’hésitez pas à [nous demander](/support_fr).*

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

Entrez le mot de passe d’administration et votre clé publique devrait être copiée sur votre serveur.

**Sur votre serveur**, éditez le fichier de configuration SSH, pour désactiver l’authentification par mot de passe.

```bash
nano /etc/ssh/sshd_config

# Modifiez ou ajoutez la ligne suivante
PasswordAuthentication no
```

Pour éviter que YunoHost écrase la configuration du serveur SSH il faut modifier le fichier `/etc/yunohost/yunohost.conf` et passer la ligne ssh à yes

```bash
ssh=yes
```

Sauvegardez et relancez le démon SSH.

---

### Modifier le port SSH

Pour éviter des tentatives de connexion SSH par des robots qui scannent tout Internet pour tenter des connexions SSH avec tout serveur accessible, on peut modifier le port SSH.

**Sur votre serveur**, éditez le fichier de configuration SSH, pour modifier le port SSH.

```bash
nano /etc/ssh/sshd_config

# Recherchez la ligne « Port » et remplacez le numéro du port (par défaut 22) par un autre numéro non utilisé
Port 22 # à remplacer par exemple par 9777
```

Pour éviter que yunohost écrase la configuration du serveur SSH il faut modifier le fichier `/etc/yunohost/yunohost.conf` et passer la ligne ssh à yes

```bash
ssh=yes
```

Sauvegardez et relancez le démon SSH.

Ensuite redémarrez le firewall iptables et fermez l’ancien port dans iptables.

```bash
yunohost firewall reload
yunohost firewall disallow <votre numéro de port> # port par défaut 22
yunohost firewall disallow --ipv6 TCP <votre numéro de port> # pour ipv6
``` 

**Pour les prochaines connexions SSH** il faudra ajouter l’option -p suivie du numéro de port SSH.

**Exemple** :

```bash
ssh -p <votre_numero_de_port_ssh> admin@<votre_serveur_yunohost>
``` 

---

### Changer l’utilisateur autorisé à se connecter par SSH

Afin d’éviter de multiples tentatives de forçage du login admin par des robots, on peut éventuellement changer l’utilisateur autorisé à se connecter.

<div class="alert alert-info" markdown="1">
Dans le cas d'une authentification par clé, la force brute n'a aucune chance de réussir. Cette étape n'est donc pas vraiment utile dans ce cas
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

# Recherchez le paragraphe « Authentication » et ajoutez à la fin de celui-ci :
AllowUsers nom_utilisateur
```
Seuls les utilisateurs mentionnés dans la directive AllowUsers seront alors autorisés à se connecter via SSH, ce qui exclut donc l’utilisateur admin.

Pour éviter que YunoHost écrase la configuration du serveur SSH il faut modifier le fichier `/etc/yunohost/yunohost.conf` et passer la ligne ssh à yes

```bash
ssh=yes
```

Sauvegardez et relancez le démon SSH.

---

### Désactivation de l’API YunoHost

YunoHost est administrable via une **API HTTP**, servie sur le port 6787 par défaut. Elle permet d’administrer une grande partie de votre serveur, et peut donc être utilisée à des **fins malveillantes**. La meilleure chose à faire si vous êtes habitués aux lignes de commande est de désactiver le service `yunohost-api`, et **utiliser la [moulinette](/moulinette_fr)** en SSH.

```bash
sudo service yunohost-api stop
```
