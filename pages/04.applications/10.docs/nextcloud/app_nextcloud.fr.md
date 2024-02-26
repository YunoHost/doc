---
title: Nextcloud
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_nextcloud'
---

![logo de Nextcloud](image://nextcloud_logo.png)

Nextcloud est un service d'hébergement de fichiers. De nombreuses applications peuvent être installées afin d'offrir à Nextcloud de nouvelles fonctionnalités telles qu'un agenda, un répertoire de contacts, des notes et plein d'autres possibles (vous pouvez trouver quelques applications dans la section [applications tierces](#applications-tierces), il en existe une multitude suivant vos besoins).


## Découverte de l'environnement de Nextcloud
Du fait de la constitution de Nextcloud, une base avec des applications tierces à installer, ce chapitre ne concernera que la base de Nextcloud sans applications ajoutés. Plus d'informations sur les applications dans la partie dédiée ou sur le catalogue d'application de Nextcloud : [apps.nextcloud.com](https://apps.nextcloud.com).  
Nextcloud est avant tout un service de cloud (comme Seafile et d'autres logiciels), il permet une synchronisation et le partage de fichiers sur internet et entre plusieurs terminaux (ordinateurs, smartphone) mais aussi avec plusieurs personnes.


## Logiciels clients
Il existe des logiciels clients pour de nombreux terminaux. Vous pouvez les retrouver sur le site de Nextcloud : [nextcloud.com/install/#install-clients](https://nextcloud.com/install/#install-clients)


## Manipulations utiles & problèmes rencontrés

### Ajouter de l'espace à Nextcloud
La solution I. permet d'ajouter un lien vers un dossier local ou distant.  
La solution II. permet de déplacer l'espace de stockage principal de Nextcloud.

#### I. Ajouter un espace de stockage externe

Paramètre => [Administration] Stockages externe.

En bas de la liste vous pouvez rajouter un dossier (Il est possible de définir un sous dossier en utilisant la convention `dossier/sousDossier`.)  
Sélectionner un type de stockage et indiquez les informations de connexion demandées.  
Vous pouvez restreindre ce dossier à un ou plusieurs utilisateurs nextcloud avec la colonne `Disponible pour`.  
Avec l'engrenage vous pouvez autoriser ou interdire la prévisualisation et le partage des fichiers.  
Enfin cliquer sur la coche pour valider le dossier.

#### II. Migrer les données de Nextcloud dans une partition plus grosse

**Remarque** : Ce qui suit suppose que vous avez un disque dur monté sur `/media/stockage`. Référez-vous à [cet article](/external_storage) pour préparer votre système.

**Remarque** : Remplacez `nextcloud` par le nom de son instance, si vous avez plusieurs apps Nextcloud installées.

Commencez par éteindre le serveur web avec la commande :
```bash
systemctl stop nginx  
```

##### Choix de l'emplacement

**Cas A : Stockage vierge, exclusif à Nextcloud**

Pour l'instant seul root peut y écrire dans `/media/stockage` ; ce qui signifie que NGINX et Nextcloud ne pourront donc pas l'utiliser.

```bash
chown -R nextcloud:nextcloud /media/stockage
chmod 775 -R /media/stockage
```

**Cas B : Stockage partagé, données déjà présentes, données Nextcloud dans un sous-dossier**

Si vous souhaitez utiliser ce disque pour d'autres applications, vous pouvez créer un sous-dossier appartenant à Nextcloud.

```bash
mkdir -p /media/stockage/nextcloud_data
chown -R nextcloud /media/stockage/nextcloud_data
chmod 775 -R /media/stockage/nextcloud_data
```

##### Migrer les données

Migrez vos données vers le nouveau disque. Pour ce faire *(soyez patient, cela peut être long)* :

```bash
Cas A : cp -ir /home/yunohost.app/nextcloud /media/stockage
Cas B : cp -ir /home/yunohost.app/nextcloud /media/stockage/nextcloud_data
```

L'option `i` permet de vous demander quoi faire en cas de conflit de fichier, notamment si vous écrasez un ancien dossier de données Owncloud ou Nextcloud.  
Pour vérifier que tout s'est bien passé, comparer ce qu'affichent ces deux commandes (le contenu doit être identique) :

```bash
ls -la /home/yunohost.app/nextcloud

Cas A : ls -al /media/stockage
Cas B : ls -al /media/stockage/nextcloud_data/nextcloud
```

##### Configurer Nextcloud

Pour informer Nextcloud de son nouveau répertoire, modifiez le fichier `/var/www/nextcloud/config/config.php` avec la commande :

```bash
nano /var/www/nextcloud/config/config.php
```

Cherchez la ligne :

```bash
'datadirectory' => '/home/yunohost.app/nextcloud/data',
```

Que vous modifiez :

```bash
CAS A : 'datadirectory' => '/media/stockage',
CAS B : 'datadirectory' => '/media/stockage/nextcloud_data/nextcloud/data',
```

Sauvegardez avec `ctrl+x` puis `y` ou `o` (dépend de la locale de votre serveur).

Relancez le serveur web :

```bash
systemctl start nginx
```

Ajouter le fichier .ocdata
```bash
CAS A : nano /media/stockage/.ocdata
CAS B : nano /media/stockage/nextcloud_data/nextcloud/data/.ocdata
```
Ajouter un espace au fichier pour pouvoir le sauvegarder

Sauvegardez avec `ctrl+x` puis `y` ou `o` (dépend de la locale de votre serveur).

Lancez un scan du nouveau répertoire par Nextcloud:

```bash
sudo -u nextcloud php8.2 --define apc.enable_cli=1 /var/www/nextcloud/occ files:scan --all
```

C'est terminé. À présent testez si tout va bien, essayez de vous connecter à votre instance Nextcloud, envoyer un fichier, vérifiez sa bonne synchronisation.

### Partager un dossier entre Nextcloud et une application
Il est relativement simple de monter des dossiers accessibles depuis Nextcloud en lecture/écriture et de les 
partager avec d'autres applications (par exemple [Jellyfin](app_jellyfin), [Funkwhale](app_funkwhale), [Transmission](app_transmission), ...)

Il vous faut commencer par monter un dossier qui sera disponible pour votre application (je prends jellyfin dans mon 
exemple). Je commence donc par créer un nouveau dossier.
```bash
mkdir /media/data/jellyfin
```

Il nous faut maintenant créer un groupe qui pourra faire la liaison entre les applications. Ici mon groupe se nomme 
`multimedia`
```bash
sudo su

groupadd multimedia

usermod nextcloud -a -G multimedia
usermod jellyfin -a -G multimedia

chown nextcloud:multimedia -R /media/data/jellyfin
```

Dans l'interface de vos applications vous pouvez ajouter ce chemin, il sera accessible pour les 2 applications, dans 
`Nextcloud` > `Paramètres` > `Administration` > `Stockage externe`

### Nextcloud et Cloudflare

Si vous utilisez Cloudflare pour vos DNS, *ce qui peut-être pratique si vous avez une IP dynamique*, vous aurez très probablement des problèmes d'authentification avec l'application Nextcloud. Sur Internet beaucoup de gens proposent de créer une règle ayant pour effet de désactiver toutes les options reliées à la sécurité et à la vitesse de Cloudflare pour l'URL pointant sur votre instance Nextcloud. Bien que cela fonctionne, ce n'est pas la solution optimale. Je vous propose, certes de créer une règle pour l'URL pointant sur votre instance Nextcloud, mais de désactiver seulement 2 options. Voici donc comment :

#### Cloudflare Page Rules

Dans le panneau de contrôle de Cloudflare, choisissez votre domaine et trouvez Page Rules
l'URL dans votre barre d'adresse ressemblera à : https://dash.cloudflare.com/*/domain.tld/page-rules

#### Ajouter une règle

La règle à ajouter doit s'appliquer pour l'URL de votre instance Nextcloud soit :
- `https://nextcloud.domain.tld/*` si vous utilisez un sous-domaine
- `https://domain.tld/nextcloud/*` si vous avez déployé Nextcloud dans un répertoire

Les options à désactiver (Off) sont :

- Rocket Loader
- Email Obfuscation

Sauvegarder et nettoyer vos caches (Cloudflare, navigateur...) et le tour est joué.

# Applications Tierces
Certaines applications sont disponibles directement depuis Nextcloud.
![image](image://nextcloud_menu_parameter.jpg)

## Collabora online

Collabora permet d'éditer en ligne les documents stockés sur Nextcloud.

### Architectures autres qu'ARM

Pour les serveurs ayant une architecture autre qu'ARM (x86...), le plus simple est d'utiliser l'application [Collabora](https://yunohost.org/fr/app_collabora), présente dans le catalogue d'applications de YunoHost.

Cette application n'est cependant pas compatible avec les architectures ARM. Le projet Collabora a bien développé une version spécifique ARM, mais celle-ci n'est compatible qu'avec Ubuntu, pas Debian, donc ne fonctionne pas sous YunoHost.

### Architectures ARM

Il existe une solution pour faire tourner Collabora Online Document Server sur des architectures ARM (Raspberry Pi...), via Nextcloud.

#### 1. Télécharger et activer le Collabora Online Document Server

#### Attention : cette étape doit être réalisée depuis un terminal, et non depuis l'interface graphique de Nextcloud

Dans un terminal, se placer en super user

```bash
sudo su
```

puis lancer la commande d'installation du CODE :

```bash
sudo -u nextcloud php --define apc.enable_cli=1 -d memory_limit=512M /var/www/nextcloud/occ app:install richdocumentscode_arm64
```

#### 2. Corriger la configuration de Nginx pour Nextcloud

Pour que le CODE soit connecté à Nextcloud, le proxy doit faire le lien entre CODE (richdocumentscode_arm64) et Nextcloud.
Or le fichier config par défaut de NGINX pour Nextcloud fait référence à richdocumentscode au lieu de rich documentscode_arm64, qui est le nom de l'application dans notre cas des architectures ARM.

Il faut donc faire :

```bash
cd /etc/nginx/conf.d/[nextcloud.votredomaine.com].d
```

```bash
sudo nano nextcloud.conf
```
Dans le fichier, repérer la ligne comportant "richdocumentscode", puis ajouter "_arm64" juste après, enregistrer (Ctrl+S) et sortir (Ctrl+X).

Puis redémarrer NGINX (par exemple en redémarrant le serveur depuis l'interface d'aministration de YunoHost).

#### 3. Télécharger et activer l'application Nextcloud Collabora, sous le nom de "Nextcloud Office"

Dès lors, on peut télécharger l'application "Nextcloud Office" dans Nextcloud, et normalement le serveur CODE est choisi par défaut (sinon voir les paramètres de Nextcloud).


## À propos de Keeweb

L'application Keeweb sur le catalogue de Nextcloud - [apps.nextcloud.com/keeweb](https://apps.nextcloud.com/apps/keeweb)

L'application KeeWeb est un gestionnaire de mots de passe incorporé à Nextcloud. Elle permet par exemple de lire un fichier de type KeePass (*.kdbx*) stocké sur votre instance Nextcloud.

Mais il arrive parfois que Nextcloud ne laisse pas l'application prendre en charge ces fichiers, ce qui rend alors impossible leur lecture de KeeWeb. Pour remédier à cela,
[une solution](https://github.com/jhass/nextcloud-keeweb/blob/master/README.md#mimetype-detection) existe.

Se rendre dans le répertoire de configuration de Nextcloud :

```bash
cd /var/www/nextcloud/config/
```

S'il n'existe pas, créer le fichier *mimetypemapping.json* dont le propriétaire est l'utilisateur *nextcloud* :

```bash
sudo su nextcloud -c "nano mimetypemapping.json"
```

Puis ajouter dans ce fichier le texte suivent :

```bash
{
    "kdbx": ["x-application/kdbx"]
}
```

Enregistrer le fichier (**CTRL** + **o**) et quitter nano (**CTRL** + **c**).

Ensuite lancer un scan en tant que root :

```bash
sudo -u nextcloud php8.2 --define apc.enable_cli=1 /var/www/nextcloud/occ files:scan --all
```

À présent, le problème est corrigé.

## Quelques liens utiles<a name="liensutiles" href=""></a>

+ Site officiel : [nextcloud.com (en)](https://nextcloud.com/)
+ Catalogue d'application pour Nextcloud : [apps.nextcloud.com](https://apps.nextcloud.com/)
