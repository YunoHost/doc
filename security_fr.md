# Securité

YunoHost a été développé dans l'optique de fournir une sécurité maximale tout en restant accessible et facilement installable.

Tous les protocoles servis via YunoHost sont **chiffrés**, les mots de passe ne sont pas stockés en clair, et par défaut chaque utilisateur n'accède qu'à son répertoire personnel.

Deux points sont néanmoins importants à noter :

* L'installation d'applications supplémentaires **augmente le nombre de faille** potentielle. Il est donc conseillé de se renseigner sur chacune d'elle **avant l'installation**, d'en comprendre le fonctionnement et juger ainsi l'impact que provoquerait une potentielle attaque. N'installez **que** les applications qui semblent importantes pour votre usage.

* Le fait que YunoHost soit un logiciel répandu augmente les chances de subir une attaque. Si une faille est découverte, elle peut potentiellement **toucher toutes les instances YunoHost** à un temps donné. Nous nous efforçons de corriger ces failles le plus rapidement possible, pensez donc à **mettre à jour régulièrement** votre système.

*Si vous avez besoin de conseil, n'hésitez pas à [nous demander](/support_fr).*

---

## Améliorer la sécurité

Si votre serveur YunoHost est dans un environnement de production critique ou que vous souhaitez améliorer sa sécurité, il est bon de suivre quelques bonnes pratiques.

**Attention :** *L'application des conseils suivants nécessite une connaissance avancée du fonctionnement et de l'administration d'un serveur. Pensez à vous renseigner avant de procéder à cette mise en place.*

### Authentification SSH par clé

Par défaut, l'authentification SSH se fait avec le mot de passe d'administration. Il est conseillé de désactiver ce type d'authentification et de le remplacer par un mécanisme de clé de chiffrement.

**Sur votre client** :

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

Pour éviter que yunohost écrase la configuration du serveur SSH il faut modifier le fichier `/etc/yunohost/yunohost.conf` et passer la ligne ssh à yes

```bash
ssh=yes
```

Sauvegardez et relancez le démon SSH.

---

### Modifier le port ssh

Pour éviter de tentatives de connexion ssh par des robots qui scannent tout internet pour tenter des connexion ssh avec tout serveur accessible on peux modifier le port ssh.

**Sur votre serveur**, éditez le fichier de configuration SSH, pour modifier le port ssh.

```bash
nano /etc/ssh/sshd_config

# Recherchez la ligne "Port" et remplacez le numéro du port (par défaut 22) par un autre numéro non utilisé
Port 22 # a remplacer par exemple par 9777
```

Pour éviter que yunohost écrase la configuration du serveur SSH il faut modifier le fichier `/etc/yunohost/yunohost.conf` et passer la ligne ssh à yes

```bash
ssh=yes
```

Sauvegardez et relancez le démon SSH.

**Pour les prochaines connexions ssh** il faudra ajouter l'option -p suivit du numéro de port ssh.

**Exemple** :

```bash
ssh -p <votre_numero_de_port_ssh> admin@<votre_serveur_yunohost>
``` 

---

### Désactivation de l'API YunoHost

YunoHost est administrable via une **API HTTP**, servie sur le port 6787 par défaut. Elle permet d'administrer une grande partie de votre serveur, et peut donc être utilisée à des **fins malveillantes**. La meilleure chose à faire si vous êtes habitués aux lignes de commande est de désactiver le service `yunohost-api`, et **utiliser la [moulinette](/moulinette_fr)** en SSH.

```bash
sudo service yunohost-api stop
```
