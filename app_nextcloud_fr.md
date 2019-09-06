# <img src="/images/nextcloud-logo.png" alt="logo de Nextcloud"> Nextcloud  

 - [Découverte de l'environnement de Nextcloud](#EnvironnementNextcloud)
 - [Logiciels Clients pour mobile et ordinateur](#LogicielsClients)
 - [Manipulations & Problèmes rencontrés utiles](#ManipulationsUtiles)
    - [Ajouter de l'espace à Nextcloud](#AjoutEspace)
 - [Applications tiers](#AppsTiers)
 - [Liens utiles](#liensutiles)

Nextcloud est un service d'hébergement de fichiers, de nombreuses applications peuvent être installés afin de lui offrir de nouvelles fonctionnalités tel que un agenda, un répertoire, des notes et pleins d'autres (vous pouvez trouver quelques applications dans la partie [applications tiers](#AppsTiers) mais il en existe pleins d'autres suivant vos besoins).

## <a name="EnvironnementNextcloud">Découverte de l'environnement de Nextcloud</a>

Du fait de la constitution de Nextcloud, une base avec des applications tiers à installer, cette découverte de nextcloud ne concernera que la base de nextcloud sans applications ajoutés. Plus d'informations sur les applications dans la partie dédiée ou sur le catalogue d'application de nextcloud : https://apps.nextcloud.com/

## <a name="LogicielsClients">Logiciels Clients</a>
Il existe des logiciels client pour l'ensemble plateformes. Vous pouvez les retrouver sur le site officiel de nextcloud : https://nextcloud.com/install/#install-clients

## <a name="ManipulationsUtiles"> Manipulations utiles & Problèmes rencontrés</a>

### <a name="AjoutEspace">Ajouter de l'espace à Nextcloud</a>

La solution I) permet d'ajouter un lien vers un dossier local ou distant.  
La solution II) permet de déplacer l'espace de stockage principal de nextcloud.

#### I. Ajouter un espace de stockage externe

Paramètre => [Administration] Stockages externe.

En bas de la liste vous pouvez rajouter un dossier (Il est possible de définir un sous dossier en utilisant la convention `dossier/sousDossier`.)  
Sélectionner un type de stockage et indiquez les information de connexion demandés.  
Vous pouvez restreindre ce dossier à un ou plusieurs utilisateurs nextcloud avec la colonne `Disponible pour`.  
Avec l'engrenage vous pouvez autoriser ou interdire la prévisualisation et le partage des fichiers.  
Enfin cliquer sur la coche pour valider le dossier.

#### II. Migrer les données de Nextcloud dans une partition plus grosse

**Remarque** : Ce qui suit suppose que vous avez un disque dur monté sur `/media/stockage`. Référez-vous à [cet article](/external_storage_fr) pour préparer votre système.

**Remarque** : Remplacez `nextcloud` par le nom de son instance, si vous avez plusieurs apps Nextcloud installées.

Commencez par éteindre le serveur web avec la commande:
```bash
systemctl stop nginx  
```

##### Choix de l'emplacement

**Cas A : Stockage vierge, exclusif à Nextcloud**

Pour l'instant seul root peut y écrire dans `/media/stockage`; ce qui signifie que nginx et nextcloud ne pourront donc pas l'utiliser.

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

Pour vérifier que tout s'est bien passé, comparer ce qu'affichent ces deux commandes (le contenu doit être identique):

```bash
ls -la /home/yunohost.app/nextcloud

Cas A : ls -al /media/stockage
Cas B : ls -al /media/stockage/nextcloud_data/nextcloud
```

##### Configurer Nextcloud

Pour informer Nextcloud de son nouveau répertoire, modifiez le fichier `/var/www/nextcloud/config/config.php` avec la commande:

```bash
nano /var/www/nextcloud/config/config.php
```

Cherchez la ligne:

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
cd /var/www/nextcloud
sudo -u nextcloud php occ files:scan --all
```

C'est terminé. À présent testez si tout va bien, essayez de vous connecter à votre instance Nextcloud, envoyer un fichier, vérifiez sa bonne synchronisation.


### Nextcloud et Cloudflare

Si vous utilisez Cloudflare pour vos DNS, *ce qui peut-être pratique si vous avez une IP dynamique*, vous aurez très probablement des problèmes d'authentification avec l'application Nextcloud. Sur Internet beaucoup de gens propose de créer une règle ayant pour effet de désactivé tous les options relié à la sécurité et à la vitesse de Cloudflare pour l'url pointant sur votre instance Nextcloud. Malgré que cela fonctionne, ce n'est pas la solution optimial. Je vous propose, certes de créé une règle pour l'url pointant sur votre instance Nextcloud mais de désactivé seulement 2 options. Voici donc comment:

#### Cloudflare Page Rules

Dans le panneau de controle de Cloudflare choisissez votre domaine et trouver Page Rules
l'url dans votre barre d'addresse ressemblera à : https://dash.cloudflare.com/*/domain.tld/page-rules

#### Ajouter une règle

La règle à ajouter doit s'appliquer pour l'url de votre instance Nextcloud soit:

- `https://nextcloud.domain.tld/*` si vous utilisez un sous domain
- `https://domain.tld/nextcloud/*` si vous avez déployé Nextcloud dans un répertoire

Les options à désactiver (Off) sont :

- Rocket Loader
- Email Obfuscation

Sauvegarder et nettoyer vos caches (Cloudflare, navigateur, ...) et le tour est joué.

## <a name="AppsTiers">Les applications Tiers</a>

### L'application KeeWeb

L'application KeeWeb est un gestionnaire de mots de passe incorporé à Nextcloud. Elle permet par exemple de lire un fichier de type KeePass (*.kdbx*) stocké sur votre instance Nextcloud. 
Mais il arrive parfois que Nextcloud ne laisse pas l'application prendre en charge ces fichiers, ce qui rend alors impossible leur lecture de KeeWeb. Pour remédier à cela, 
[une solution](https://github.com/jhass/nextcloud-keeweb/issues/34) existe.

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

A présent, le problème est corrigé.

## <a name="liensutiles">Quelques liens utiles</a>
+ Site officiel : [nextcloud.com (En anglais)](https://nextcloud.com/)
+ Catalogue d'application pour nextcloud : [apps.nextcloud.com](https://apps.nextcloud.com/)
+ Trouver de l'aide et poser toutes vos questions : [forum.yunohost.org](https://forum.yunohost.org/c/support)
