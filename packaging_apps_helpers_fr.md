<a class="btn btn-lg btn-default" href="packaging_apps_fr">Packaging d’application</a>


## Commandes pratiques en Shell

À partir de YunoHost 2.4, de **nouvelles commandes pratiques *(helpers)* en shell** sont disponible pour faciliter le *packaging*, particulièrement pour des tâches répétitives comme la génération de mot de passe, la création de base de données MySQL…

Des exemples sont disponibles dans l’[application d’exemple](https://github.com/YunoHost/example_ynh/blob/master/scripts/install). Il est conseillé d’utiliser les commandes pratiques.

Vous pourrez les retrouver dans ce [dépôt](https://github.com/YunoHost/yunohost/blob/stable/data/helpers.d).

Pour pouvoir utiliser les helpers, il faudra ajouter les lignes suivantes au début des scripts shell :
```bash
# Source app helpers
source /usr/share/yunohost/helpers
```

Le script helpers va exécuter tout les scripts présent dans helpers.d et donc charger les fonctions des helpers. Afin qu'elles puissent être appelées simplement.


### Liste non exhaustive des helpers disponibles
#### Base de données
```bash
ynh_mysql_execute_as_root SQL DB
```
> Exécute la commande SQL `SQL` en tant que l'utilisateur root sur la base de données `DB` (ce dernier argument est optionnel).


```bash
ynh_mysql_execute_file_as_root FILE DB
```
> Exécute les commandes SQL contenues dans le fichier `FILE` en tant que l'utilisateur root sur la base de données `DB` (ce dernier argument est optionnel).


```bash
ynh_mysql_create_db DB USER PWD
```
> Crée la base de données `DB` et donne tous les droits sur celle-ci à l'utilisateur `USER` (automatiquement créé) identifié par le mot de passe `PWD`.


```bash
ynh_mysql_drop_db DB
```
> Supprime la base de données `DB`.


```bash
ynh_mysql_dump_db DB > ./FILE
```
> Exporte la base de données `DB` dans le fichier `FILE`.


#### Gestion des paquets Debian
```bash
ynh_package_is_installed PACKAGE
```
> Détermine si le paquet `PACKAGE` est installé sur le système.
> La sortie de la commande doit être testée pour en connaître le résultat. Par exemple :
> ```bash
> if ! ynh_package_is_installed "yunohost" ; then
>   echo "Oups, le paquet n'est pas installé."
> else
>   echo "Le paquet est installé !"
> fi
> ```


```bash
ynh_package_version PACKAGE
```
> Retourne la version du paquet `PACKAGE` installé sur le système.


```bash
ynh_package_update
```
> Met à jour la liste des paquets disponibles de manière silencieuse et non interactive.
> C'est un `apt-get update` avec les options -y -qq et noninteractive.


**Attention, les commandes suivantes sont à éviter autant que possible. Il n'est pas sain d'installer et encore moins de supprimer un paquet sans en gérer les conflits et dépendances. Ceci sera bientôt facilité dans les prochaines versions de YunoHost...**

```bash
ynh_package_install PACKAGE1 PACKAGE2
```
> Installe les paquets `PACKAGE1`, `PACKAGE2`, etc de manière non interactive et silencieuse.
> C'est un `apt-get install` avec les options -y -qq et noninteractive.


```bash
ynh_package_remove PACKAGE1 PACKAGE2
```
> Supprime les paquets `PACKAGE1`, `PACKAGE2`, etc de manière non interactive et silencieuse.
> C'est un `apt-get remove` avec les options -y -qq et noninteractive.


```bash
ynh_package_autoremove PACKAGE1 PACKAGE2
```
> Supprime les paquets `PACKAGE1`, `PACKAGE2`, etc ainsi que tous les paquets qui ne semblent plus utilisé, de manière non interactive et silencieuse.
> C'est un `apt-get autoremove` avec les options -y -qq et noninteractive.


#### Configuration des applications
```bash
ynh_app_setting_set APP KEY VALUE
```
> Stocke le réglage nommé `KEY` dont la valeur est `VALUE` pour l'application `APP `, afin de le réutiliser plus tard (typiquement dans le script `upgrade`) ou pour que YunoHost puisse se configurer automatiquement (par exemple pour le SSO).
> Les réglages sont stockés dans le fichier /etc/yunohost/apps/${APP}/settings.yml.
> Par exemple, pour stocker le paramètre de visibilité, privé ou public, d'une application, on notera ainsi :
> ```bash
> ynh_app_setting_set nom_app is_public "yes"
> ```

Le SSO fait appel aux réglages stockés pour l'application afin de déterminer si cette dernière peux être accessible publiquement ou non.
Pour cela, 6 clés différents sont disponible :

Tout d'abord `skipped_uris`, `unprotected_uris` et `protected_uris`. Ces 3 clés sont relatives au chemin (ou *path*) de l'application.
> Par exemple :
> ```bash
> ynh_app_setting_set nom_app skipped_uris "/"
> ```
> concernera la racine de l'application, soit https://domain.tld/path_app/ ainsi que tout ce qui suivra.
> Alors que :
> ```bash
> ynh_app_setting_set nom_app skipped_uris "/blog"
> ```
> concernera le path /blog de l'application, soit https://domain.tld/path_app/blog et ce qui suivra, mais pas https://domain.tld/path_app/.

**skipped_uris**
Une url ajoutée avec la clé *skipped_uris* sera totalement ignorée par le SSO, donc l'accès sera publique et ne prendra pas en compte un utilisateur déjà connecté.

**unprotected_uris**
Une url ajoutée avec la clé *unprotected_uris* sera accessible publiquement, mais un utilisateur connecté au SSO pourra se connecter en utilisant le header HTTP.

**protected_uris**
Une url ajoutée avec la clé *protected_uris* sera bloquée par le SSO et accessible uniquement aux utilisateurs authentifiés.

Les clés `skipped_regex`, `unprotected_regex` et `protected_regex` sont les équivalents en "expressions régulières" des 3 clés précédentes.
> Il est important de noter que ce ne sont pas véritablement des expressions régulières qui seront interprétés, mais des patterns lua, dont la syntaxe différe légèrement.
> [Plus d'infos sur la syntaxe des patterns lua.](http://wxlua.free.fr/Tutoriel_Lua/Tuto/Strings/strings6.php) [Ainsi que quelques exemples.](http://wxlua.free.fr/Tutoriel_Lua/Tuto/Strings/strings7.php)
Le pattern étant recherché sur l'ensemble des urls soumises, afin d'éviter des débordements on préfera ajouter au pattern l'url complète qui doit être prise en compte par ssowat.
> Par exemple, si on souhaite placer *skipped_regex* sur /blog en considérant une suite de chiffres indéfinie en argument. On indiquera ceci :
> ```bash
> ynh_app_setting_set nom_app skipped_regex "$domain$path/blog%?%d+$"
> ```
> Cela pose toutefois un éventuel problème, si les variables $domain ou $path contiennent un tiret (-), celui-ci sera interprété comme étant un caractère magique du pattern. Il faut donc échapper les éventuels tirets avec un %.
> ```bash
> domainregex=$(echo "$domain" | sed 's/-/\%&/g')
> pathregex=$(echo "$path" | sed 's/-/\%&/g')
> ynh_app_setting_set nom_app skipped_regex "$domainregex$pathregex/blog%?%d+$"
> ```


```bash
ynh_app_setting_get APP KEY
```
> Récupère le paramètre `KEY` stocké précémment pour l'application `APP`.
> Par exemple :
> ```bash
> is_public=$(ynh_app_setting_get nom_app is_public)
> ```


```bash
ynh_app_setting_delete APP KEY
```
> Supprime le paramètre `KEY` enregistré pour l'application `APP`.


#### Gestion des utilisateurs
```bash
ynh_user_exists USERNAME
```
> Vérifie l'existence de l'utilisateur `USERNAME` dans Yunohost.
> La sortie de la commande doit être testée pour en connaître le résultat. Par exemple :
> ```bash
> if ynh_user_exists "johndoe" ; then
>   echo "L'utilisateur existe !"
> fi
> ```


```bash
ynh_user_get_info USERNAME KEY
```
> Récupère l'information `KEY` sur l'utilisateur `USERNAME`.
> Les valeurs possibles de `KEY` sont :
> - firstname
> - fullname
> - lastname
> - mail
> - mail-aliases
> - mailbox-quota
> Par exemple :
> ```bash
> mailadmin=$(ynh_user_get_info $admin mail)
> ```


```bash
ynh_system_user_exists USERNAME
```
> Détermine si l'utilisateur `USERNAME` existe sur le système.
> La sortie de la commande doit être testée pour en connaître le résultat. Par exemple :
> ```bash
> if ynh_system_user_exists "www-data" ; then
>   echo "L'utilisateur existe sur le système !"
> fi
> ```


#### Autres commandes
```bash
ynh_string_random LENGTH
```
> Génère une chaine de caractères aléatoires de longueur `LENGTH` (par défaut 24).


```bash
ynh_die MSG RETCODE
```
> Affiche le message `MSG` (sur stderr) et termine le script avec le code `RETCODE` (par défaut 1).


**Les commandes suivantes sont amenées à être remplacées (voir supprimées) dans les prochaines versions de YunoHost.**


```bash
sudo yunohost app checkport PORT
```
> Cette commande vérifie le `PORT` et retourne une erreur si il est déjà utilisé.
> La sortie de la commande doit être testée pour en connaître le résultat. Par exemple :
> ```bash
> port=PORT_PAR_DEFAUT
> sudo yunohost app checkport $port
> while [[ ! $? -eq 0 ]]; do
>     port=$((port+1))
>     sudo yunohost app checkport $port
> done
> ```


```bash
sudo yunohost app checkurl DOMAINPATH -a APP
```
> Cette commande vérifie la disponibilité du chemin DOMAIN/PATH. Il est utile pour les applications web et vous permet d’être sûr que le chemin n’est pas utilisé par une autre application. Si le chemin est inutilisé, elle le « réserve » pour l'application APP.
> **Remarque** : ne pas préfixer par `http://` ou par `https://` dans le `DOMAINPATH`.


```bash
sudo yunohost app ssowatconf
```
> Cette commande régénère la configuration du SSO. Elle est appelée automatiquement à la fin du script.
> Mais peux être appelée avant si nécessaire.
