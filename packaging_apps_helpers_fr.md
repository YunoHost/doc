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
ynh_mysql_setup_db USER NAME [PWD]
```
> Créer l'utilisateur sql `USER` et lui octroie tout les droits sur une nouvelle base de donnée `NAME`.  
Si aucun mot de passe n'est indiqué, un nouveau est généré et stocké dans la variable $db_pwd ainsi que dans la configuration de l'application sous le nom "mysqlpwd"  
**Nécessite YunoHost version 2.6.4**


```bash
ynh_mysql_remove_db USER NAME
```
> Supprime l'utilisateur sql `USER` et sa base de donnée `NAME`.  
**Nécessite YunoHost version 2.6.4**


```bash
ynh_sanitize_dbid NAME
```
> Corrige le nom d'une base de donnée pour s'assurer qu'il ne contient pas de caractères interdits.  
Et renvoi ce nom corrigé.
> ```bash
> dbname=$(ynh_sanitize_dbid $app)
> ```
> **Nécessite YunoHost version 2.6.4**


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
ynh_mysql_drop_user USERNAME
```
> Supprime l'utilisateur MySQL `USERNAME` MySQL.

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


```bash
ynh_install_app_dependencies DEPENDANCE1 DEPENDANCE2 ...
```
> Installe les paquets requis par une app sous forme de dépendance. De cette manière les paquets supplémentaires installés sont gérés en tant que dépendances par apt.  
Il est préférable d'installer les paquets nécessaire par ce helper plutôt que par apt directement.  
**Nécessite YunoHost version 2.6.4**


```bash
ynh_remove_app_dependencies
```
> Supprime les dépendances de l'application, précédemment installées avec ynh_install_app_dependencies.  
Les paquets ne seront supprimés que si aucune application ou paquet ne les utilisent encore, selon apt.  
**Nécessite YunoHost version 2.6.4**


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
Pour cela, 6 clés différentes sont disponible :

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
Une url ajoutée avec la clé *skipped_uris* sera totalement ignorée par le SSO, donc l'accès sera public et ne prendra pas en compte un utilisateur déjà connecté.

**unprotected_uris**  
Une url ajoutée avec la clé *unprotected_uris* sera accessible publiquement, mais un utilisateur connecté au SSO pourra se connecter en utilisant le header HTTP.

**protected_uris**  
Une url ajoutée avec la clé *protected_uris* sera bloquée par le SSO et accessible uniquement aux utilisateurs authentifiés.

Les clés `skipped_regex`, `unprotected_regex` et `protected_regex` sont les équivalents en "expressions régulières" des 3 clés précédentes.
> Il est important de noter que ce ne sont pas véritablement des expressions régulières qui seront interprétés, mais des patterns lua, dont la syntaxe différe légèrement.  
> [Plus d'infos sur la syntaxe des patterns lua.](http://wxlua.free.fr/Tutoriel_Lua/Tuto/Strings/strings6.php) [Ainsi que quelques exemples.](http://wxlua.free.fr/Tutoriel_Lua/Tuto/Strings/strings7.php)  
Les patterns utilisant des regex, contrairement aux précédents, sont recherchés sur la totalité de l'URL, et non uniquement sur la partie spécifique à l'application. Il convient donc d'écrire des patterns qui englobent l'URL entière (incluant *domaine* et *chemin*).
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
> Récupère le paramètre `KEY` stocké précédemment pour l'application `APP`.  
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


```bash
ynh_system_user_create USER_NAME [HOME_DIR]
```
> Créer l'utilisateur système `USER_NAME`, si il n'existe pas déjà.  
> Si aucun dossier home n'est mentionné, l'utilisateur sera créé sans home.  
> **Nécessite YunoHost version 2.6**


```bash
ynh_system_user_delete USER_NAME
```
> Supprime l'utilisateur système `USER_NAME`.  
> **Nécessite YunoHost version 2.6**


#### Gestion des ports
```bash
ynh_find_port BEGIN_PORT
```
> Cherche un port libre en commençant par `BEGIN_PORT`  
> Le numéro de port trouvé est renvoyé en fin de commande.
> ```bash
> port=$(ynh_find_port 8080)
> ```
> **Nécessite YunoHost version 2.6**


#### Configuration système
```bash
ynh_use_logrotate [LOGFILE] [--non-append]
```
> Créer un fichier de configuration logrotate pour cette application.  
Si `LOGFILE` est renseigné, ce fichier de log sera utilisé. Sinon, la configuration concernera le dossier de log /var/log/${app}.  
Si `--non-append` est ajouté, le fichier de configuration logrotate sera effacé puis recréé.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_remove_logrotate
```
> Supprime la configuration logrotate pour cette application.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_add_systemd_config
```
> Utilise la configuration systemd présente dans conf/systemd.service pour configurer un service.  
Les termes `__APP__` et `__FINALPATH__` sont remplacés respectivement par $app et $final_path.  
Le fichier de configuration est copié dans /etc/systemd/system/$app.service et le service est activé.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_remove_systemd_config
```
> Supprime la configuration systemd pour cette application.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_add_nginx_config
```
> Utilise la configuration nginx présente dans conf/nginx.conf.  
Les termes suivant sont remplacés `__PATH__` par $path_url, `__DOMAIN__` par $domain, `__PORT__` par $port, `__NAME__` par $app et `__FINALPATH__` par $final_path.  
Le fichier de configuration est copié dans /etc/nginx/conf.d/$domain.d/$app.conf et nginx est rechargé.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_remove_nginx_config
```
> Supprime la configuration nginx pour cette application.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_add_fpm_config
```
> Utilise la configuration phpfpm présente dans conf/php-fpm.conf.  
Les termes suivant sont remplacés `__NAMETOCHANGE__` par $app, `__FINALPATH__` par $final_path et `__USER__` par $app.  
Le fichier de configuration est copié dans /etc/php5/fpm/pool.d/$app.conf.  
Le fichier conf/php-fpm.ini est copié dans /etc/php5/fpm/conf.d/20-$app.ini et php-fpm est rechargé.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_remove_fpm_config
```
> Supprime la configuration php-fpm pour cette application.  
> **Nécessite YunoHost version 2.6.4**


#### Backup/restore
```bash
ynh_backup DEST
```
> Ajoute le fichier ou dossier `DEST` à la liste des fichiers à ajouter au backup de l'application.  
`DEST` doit être un chemin absolu.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_restore_file DEST
```
> Restaure le fichier ou dossier `DEST`.  
`DEST` doit être un chemin absolu.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_restore
```
> Restaure tous les fichiers archivés par le script backup.  
> **Nécessite YunoHost version 2.6.4**


#### Gestion des erreurs
```bash
ynh_abort_if_errors
```
> Stop immédiatement l'exécution du script si une commande échoue ou si une variable non initialisée est utilisée.  
> **Nécessite YunoHost version 2.6.4**  
> Si le script risque de laisser des résidus lors de son arrêt, il est possible d'utiliser la fonction `ynh_clean_setup` pour exécuter des commandes avant l'arrêt effectif du script.  
> ```bash
> ynh_clean_setup () {
>        instructions...
> }
> ```


```bash
ynh_backup_before_upgrade
```
> Créer un backup de l'application avant de démarrer l'upgrade.  
> **Nécessite YunoHost version 2.6.4**
```bash
ynh_restore_upgradebackup
```
> Restaure le backup créé par ynh_backup_before_upgrade en cas d'échec de l'upgrade.  
> **Nécessite YunoHost version 2.6.4**  
> Ces 2 helpers s'utilisent de la manière suivante:  
> ```bash
> ynh_backup_before_upgrade
> ynh_clean_setup () {
> 	ynh_restore_upgradebackup
> }
> ynh_abort_if_errors
> ```


#### Vérification du path
```bash
ynh_normalize_url_path PATH
```
> Corrige le path et renvoi le résultat.
> ```bash
> url_path=$(ynh_normalize_url_path $url_path)
> ```
> Le path est corrigé de la manière suivante  
> example -> /example  
> /example -> /example  
> /example/ -> /example  
> / -> /  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_webpath_available DOMAIN PATH
```
> Vérifie la disponibilité du path demandé.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_webpath_register APP DOMAIN PATH
```
> Réserve le path demandé pour cette application.  
> **Nécessite YunoHost version 2.6.4**


#### Autres commandes
```bash
ynh_string_random LENGTH
```
> Génère une chaine de caractères aléatoires de longueur `LENGTH` (par défaut 24).


```bash
ynh_die MSG RETCODE
```
> Affiche le message `MSG` (sur stderr) et termine le script avec le code `RETCODE` (par défaut 1).


```bash
ynh_store_file_checksum FILE
```
> Calcule la somme de contrôle du fichier FILE et la stocke dans la configuration de l'app.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_backup_if_checksum_is_different FILE
```
> Compare la somme de contrôle du fichier FILE avec la somme de contrôle précédemment stockée par ynh_store_file_checksum.  
> Si la somme de contrôle est différente, un backup du fichier est fait.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_secure_remove FILE
```
> Supprime le fichier ou dossier FILE en vérifiant que ce n'est pas un dossier système sensible.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_replace_string MATCH_STRING REPLACE_STRING TARGET_FILE
```
> Remplace toute les occurences de la chaine `MATCH_STRING` par `REPLACE_STRING` dans le fichier `TARGET_FILE`.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_local_curl URL KEY1=VALUE1 KEY2=VALUE2 ...
```
> Effectue une requête curl sur la page `URL` et renseigne les champs POST `KEY1`, `KEY2`, etc par `VALUE1`, `VALUE2`, etc.  
> Ce helper est surtout utilisé pour remplir les formulaires d'installation des applications.  
> `URL` ne doit pas contenir le domaine et le path.  
> **Nécessite YunoHost version 2.6.4**


```bash
ynh_setup_source DEST_DIR [SOURCE_ID]
```
> Télécharge la source de l'application, vérifie la somme de contrôle, la décompresse et la copie dans le dossier `DEST_DIR`.  
> Si SOURCE_ID n'est pas renseigné, il prend la valeur `app`.  
> Ce helper nécessite un fichier [conf/SOURCE_ID.src](https://github.com/YunoHost/example_ynh/blob/master/conf/app.src) indiquant les informations sur la source à télécharger.  
> **Nécessite YunoHost version 2.6.4**

<br/>

**Les commandes suivantes sont amenées à être remplacées (voir supprimées) dans les prochaines versions de YunoHost.**


```bash
sudo yunohost firewall allow [--no-upnp] {TCP,UDP,Both} PORT
```
> Ouvre le port `PORT` sur le parefeu en TCP, UDP ou les deux.
> L'ouverture automatique des ports via upnp peux être désactivé sur ce port en spécifiant l'option `--no-upnp`.


```bash
sudo yunohost firewall disallow {TCP,UDP,Both} PORT
```
> Ferme le port `PORT` sur le parefeu en TCP, UDP ou les deux.


```bash
sudo yunohost app checkurl DOMAINPATH -a APP
```
> Vérifie la disponibilité du chemin DOMAIN/PATH. Il est utile pour les applications web et vous permet d’être sûr que le chemin n’est pas utilisé par une autre application. Si le chemin est inutilisé, elle le « réserve » pour l'application APP.  
> **Remarque** : ne pas préfixer par `http://` ou par `https://` dans le `DOMAINPATH`.


```bash
sudo yunohost app addaccess [--users=USER] APP
```
> Autorise l'utilisateur `USER` à accéder à l'application `APP`.
> Si l'option `--users` n'est pas spécifiée, l'accès à l'application `APP` est accordé à tout les utilisateurs.


```bash
sudo yunohost app removeaccess --users=USER APP
```
> Retire l'autorisation d'accès de l'utilisateur `USER` à l'application `APP`.


```bash
sudo yunohost service add NAME [-l LOG]
```
> Ajoute le service `NAME` dans l'interface de gestion admin de YunoHost.
> Le fichier de log du service peux être ajouté avec l'option `-l` en indiquant son chemin absolu.


```bash
sudo yunohost service remove NAME
```
> Retire le service `NAME` dans l'interface de gestion admin de YunoHost.


```bash
sudo yunohost app ssowatconf
```
> Cette commande régénère la configuration du SSO. Elle est appelée automatiquement à la fin du script.  
> Mais peux être appelée avant si nécessaire.
