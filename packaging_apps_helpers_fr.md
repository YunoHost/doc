<a class="btn btn-lg btn-default" href="packaging_apps_fr">Packaging d’application</a>

## Commandes pratiques
Il est conseillé d’utiliser les commandes pratiques.

#### Shell
À partir de YunoHost 2.4, des [helpers en shell](https://github.com/YunoHost/yunohost/tree/unstable/data/apps/helpers.d) sont disponible.

Pour pouvoir les utiliser il faut ajouter les lignes suivantes :
```bash
# Source app helpers
. /usr/share/yunohost/apps/helpers
```
<br />

#### Moulinette
La CLI [moulinette](/moulinette) fournit quelques outils pour faciliter le packaging :

```bash
sudo yunohost app checkport <port>
```
<blockquote>
Cette commande vérifie le port et retourne une erreur si le port est déjà utilisé.
</blockquote>

<br>

```bash
sudo yunohost app setting <id> <key> [ -v <value> ]
```
<blockquote>
C'est la commande la plus importante. Elle vous permet de stocker des réglages d’une application spécifique, afin de les réutiliser plus tard (typiquement dans le script ```upgrade```) ou pour que YunoHost puisse se configurer automatiquement (par exemple pour le SSO).
<br><br>
La commande définit la valeur si vous ajoutez ```-v <valeur>```, sinon la récupère.
<br><br>

** Quelques paramètres pratiques **<br><br>
```skipped_uris```<br><br>
Indique à SSOwat de ne pas s’occuper de la liste d’uris fournies séparées par des virgules. Celles-ci ne seront donc pas protégées et ne pourront pas utiliser le mécanisme d’authentification centralisée.<br><br>

```protected_uris```<br><br>
Protège la liste d’uris fournies séparées par des virgules. Seul un utilisateur connecté y aura accès.<br><br>

```unprotected_uris```<br><br>
Indique à SSOwat de ne pas s’occuper de la liste d’uris fournies séparées par des virgules que si l’utilisateur est connecté. Ces uris sont donc publiquement accessibles mais peuvent utiliser le mécanisme d’authentification centralisée.<br><br>

Il existe aussi `skipped_regex`, `protected_regex`, `unprotected_uris`, `unprotected_regex`.<br><br>

**Attention** : il est nécessaire de lancer `yunohost app ssowatconf` pour appliquer les effets. Les uris seront alors converties en urls et écrites dans le fichier /etc/ssowat/conf.json.<br><br>

Exemple :<br>
```yunohost app setting myapp unprotected_urls -v "/"```<br>
```yunohost app ssowatconf```<br>
Ces commandes vont désactiver le SSO sur la racine de l’aplication soit domain.tld/myapp, ceci est utile pour une application publique.
</blockquote>

<br>

```bash
sudo yunohost app checkurl <domain><path> -a <id>
```
<blockquote>
Cette commande est utile pour les applications web et vous permet d’être sûr que le chemin n’est pas utilisé par une autre application. Si le chemin est inutilisé, elle le « réserve ».
<br><br>
**Remarque** : ne pas préfixer par `http://` ou par `https://` dans le `<domain><path>`.
</blockquote>

<br>

```bash
sudo yunohost app initdb [ -d  <db_name> ]  [ -s <SQL_file> ] [ -p <db_pwd> ] user
```
<blockquote>
Cette commande crée une base de donnée `db_name` et un utilisateur `user` associé à cette base, possédant les permissions nécessaires à manipuler la base de donnée.
<br>
Si vous ne définissez pas de nom de base de donnée avec `-d <db_name>`, `user` est utilisé comme nom de base de donnée.
<br>
Si vous ne définissez pas de mot de passe avec `-p`, la commande en génère un et le retourne.
<br>
Si vous ajoutez un fichier SQL avec `-s`, la commande initialise la base de donnée avec les commandes SQL du fichier.
</blockquote>

<br>

```bash
sudo yunohost app ssowatconf
```
<blockquote>
Cette commande régénère la configuration du SSO. Vous devez l’appeler à la fin des scripts lorsque vous packagez une application Web.
</blockquote>