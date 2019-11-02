# <img src="/images/nextcloud_logo.png" alt="logo de Nextcloud"> Nextcloud  

 - [Découverte de l'environnement de Nextcloud](#EnvironnementNextcloud)
 - [Logiciels Clients pour mobile et ordinateur](#LogicielsClients)
 - [Manipulations & Problèmes rencontrés utiles](#ManipulationsUtiles)
    - [Ajouter de l'espace à Nextcloud](#AjoutEspace)
 - [Applications tiers](#AppsTiers)
 - [Liens utiles](#liensutiles)

Nextcloud est un service d'hébergement de fichiers, de nombreuses applications peuvent être installées afin de lui offrir de nouvelles fonctionnalités tel qu'un agenda, un répertoire de contacts, des notes et pleins d'autres possibles (vous pouvez trouver quelques applications dans la partie [applications tiers](#AppsTiers) mais il en existe une multitude suivant vos besoins).

## Découverte de l'environnement de Nextcloud<a name="EnvironnementNextcloud" href=""></a>

Du fait de la constitution de Nextcloud, une base avec des applications tiers à installer, ce chapitre ne concernera que la base de nextcloud sans applications ajoutés. Plus d'informations sur les applications dans la partie dédiée ou sur le catalogue d'application de nextcloud : [apps.nextcloud.com](https://apps.nextcloud.com).  
Nextcloud est avant tout un service de cloud (comme Seafile et d'autres logiciels), il permet une synchronisation et le partage de fichiers sur internet et entre plusieurs terminaux (ordinateurs, smartphone) mais aussi avec plusieurs personnes.

## Logiciels Clients<a name="LogicielsClients" href=""></a>

Il existe des logiciels clients pour de nombreux terminaux. Vous pouvez les retrouver sur le site de nextcloud : [nextcloud.com/install/#install-clients](https://nextcloud.com/install/#install-clients)

## Manipulations utiles & problèmes rencontrés<a name="ManipulationsUtiles" href=""></a>

### Ajouter de l'espace à Nextcloud<a name="AjoutEspace" href=""></a>

La solution I. permet d'ajouter un lien vers un dossier local ou distant.  
La solution II. permet de déplacer l'espace de stockage principal de nextcloud.

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

Si vous utilisez Cloudflare pour vos DNS, *ce qui peut-être pratique si vous avez une IP dynamique*, vous aurez très probablement des problèmes d'authentification avec l'application Nextcloud. Sur Internet beaucoup de gens proposent de créer une règle ayant pour effet de désactiver toutes les options reliées à la sécurité et à la vitesse de Cloudflare pour l'URL pointant sur votre instance Nextcloud. Bien que cela fonctionne, ce n'est pas la solution optimale. Je vous propose, certes de créer une règle pour l'URL pointant sur votre instance Nextcloud, mais de désactiver seulement 2 options. Voici donc comment :

#### Cloudflare Page Rules

Dans le panneau de contrôle de Cloudflare, choisissez votre domaine et trouvez Page Rules
l'URL dans votre barre d'addresse ressemblera à : https://dash.cloudflare.com/*/domain.tld/page-rules

#### Ajouter une règle

La règle à ajouter doit s'appliquer pour l'URL de votre instance Nextcloud soit :
- `https://nextcloud.domain.tld/*` si vous utilisez un sous-domaine
- `https://domain.tld/nextcloud/*` si vous avez déployé Nextcloud dans un répertoire

Les options à désactiver (Off) sont :

- Rocket Loader
- Email Obfuscation

Sauvegarder et nettoyer vos caches (Cloudflare, navigateur, ...) et le tour est joué.

## Applications Tiers<a name="AppsTiers" href=""></a>

 + [Calendrier](app_nextcloud_calendar_fr)
 + [contact](app_nextcloud_contact_fr)
 + [KeeWeb](app_nextcloud_keeweb_fr)
 + [Carnet](app_nextcloud_carnet_fr)

## Quelques liens utiles<a name="liensutiles" href=""></a>

+ Site officiel : [nextcloud.com (en)](https://nextcloud.com/)
+ Catalogue d'application pour nextcloud : [apps.nextcloud.com](https://apps.nextcloud.com/)
