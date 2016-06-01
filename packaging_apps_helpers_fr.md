<a class="btn btn-lg btn-default" href="packaging_apps_fr">Packaging d’application</a>


## Commandes pratiques en Shell

À partir de YunoHost 2.4, de **nouvelles commandes pratiques *(helpers)* en shell** sont disponible pour faciliter le *packaging*, particulièrement pour des tâches répétitives comme la génération de mot de passe, la création de base de donnés MySQL…

Des exemples sont disponibles dans l’[application d’exemple](https://github.com/YunoHost/example_ynh/blob/master/scripts/install). Il est conseillé d’utiliser les commandes pratiques.

Vous pourrez les retrouver dans ce [dépôt](https://github.com/YunoHost/yunohost/blob/stable/data/helpers.d).

Pour pouvoir utiliser les helpers, il faudra ajouter les lignes suivantes au début des scripts shell :
```bash
# Source app helpers
source /usr/share/yunohost/helpers
```

Le script helpers va exécuter tout les scripts présent dans helpers.d et donc charger les fonctions des helpers. Afin qu'elles puissent être appelées simplement.


### Liste non exhaustive des helpers disponibles:
#### Base de données:
```bash
ynh_mysql_execute_as_root SQL DB
```
>Cette commande exécute la commande SQL `SQL` sur la base de donnée `DB` avec les droit de l'utilisateur root de mysql.


```bash
ynh_mysql_execute_file_as_root FILE DB
```
>Cette commande éxecute un ensemble de commande SQL contenu dans le fichier `FILE` sur la base de donnée `DB` avec les droit de l'utilisateur root de mysql.


```bash
ynh_mysql_create_db DB USER PWD
```
>Cette commande créer la base de donnée `DB` et  l'utilisateur `USER` qui a comme mot de passe `PWD`.  
>L'utilisateur créé dispose de droits administrateur sur cette seule base de donnée.


```bash
ynh_mysql_drop_db DB
```
>Cette commande supprime la base de donnée `DB`.


```bash
ynh_mysql_dump_db DB > ./FILE
```
>Cette commande exporte la base de donnée `DB` dans le fichier `FILE`.



#### Gestion des paquets debian:
```bash
ynh_package_is_installed PACKAGE
```
>Cette commande vérifie si le paquet `PACKAGE` est installé sur le système.  
>La sortie de la commande doit être testée pour en connaître le résultat.  
>```bash
>ynh_package_is_installed "yunohost"
>if [[ $? -eq 0 ]]; then
>	echo "Le package est installé."
>fi
>```


```bash
ynh_package_version PACKAGE
```
>Cette commande renvoie le numéro de version du paquet `PACKAGE` installé sur le système.


```bash
ynh_package_update
```
>Cette commande met à jour la liste des applications disponible de façon silencieuse et non interactive.  
>C'est un apt-get update avec les options -y -qq et noninteractive.


```bash
ynh_package_install PACKAGE1 PACKAGE2
```
>Cette commande installe les paquets `PACKAGE1`, `PACKAGE2`, etc de manière non interactive et silencieuse.  
>C'est un apt-get install avec les options -y -qq et noninteractive.


```bash
ynh_package_remove PACKAGE1 PACKAGE2
```
>Cette commande supprime les paquets `PACKAGE1`, `PACKAGE2`, etc de manière non interactive et silencieuse.  
>C'est un apt-get remove avec les options -y -qq et noninteractive.


```bash
ynh_package_autoremove PACKAGE1 PACKAGE2
```
>Cette commande supprime les paquets `PACKAGE1`, `PACKAGE2`, etc ainsi que leurs dépendances, si elles ne sont plus utilisées, de manière non interactive et silencieuse.  
>C'est un apt-get autoremove avec les options -y -qq et noninteractive.



#### Configuration des applications:
```bash
ynh_app_setting_set APP KEY VALUE
```
>Cette commande permet de stocker le réglage nommé `KEY` dont la valeur est `VALUE` pour l'application `APP `, afin de le réutiliser plus tard (typiquement dans le script `upgrade`) ou pour que YunoHost puisse se configurer automatiquement (par exemple pour le SSO).  
>Les réglages sont stockés dans le fichier /etc/yunohost/apps/${APP}/settings.yml.  
>Par exemple, pour stocker le paramètre de visibilité, privé ou public, d'une application, on notera ainsi:
>```bash
>ynh_app_setting_set nom_app is_public "yes"
>```

Le SSO fait appel aux réglages stockés pour l'application afin de déterminer si cette dernière peux être accessible publiquement ou non.  
Pour cela, 6 *key* différents sont disponible:

Tout d'abord les *key* `skipped_uris`, `unprotected_uris` et `protected_uris`. Ces 3 *key* sont relatif au *path* de l'application.
>Par exemple
>```bash
>ynh_app_setting_set nom_app skipped_uris "/"
>```
>concernera la racine de l'application. Soit https://domain.tld/path_app/ ainsi que tout ce qui suivra.
>Alors que 
>```bash
>ynh_app_setting_set nom_app skipped_uris "/blog"
>```
>concernera le path /blog de l'application. Soit https://domain.tld/path_app/blog et ce qui suivra. Mais pas https://domain.tld/path_app/

**skipped_uris**  
Une url ajoutée avec le *key* *skipped_uris* sera totalement ignorée par le SSO, donc l'accès sera publique et ne prendra pas en compte un utilisateur déjà connecté.

**unprotected_uris**  
Une url ajoutée avec le *key* *unprotected_uris* sera accessible publiquement, mais un utilisateur connecté au SSO pourra se connecter en utilisant le header HTTP.

**protected_uris**  
Une url ajoutée avec le *key* *protected_uris* sera bloquée par le SSO et accessible uniquement aux utilisateurs authentifiés.

Les *key* `skipped_regex`, `unprotected_regex` et `protected_regex` sont les équivalents en "expressions régulières" des 3 *key* précédentes
> Il est important de noter que ce ne sont pas véritablement des expressions régulières qui seront interprétés, mais des patterns lua, dont la syntaxe différe légèrement.  
> [Plus d'infos sur la syntaxe des patterns lua.](http://wxlua.free.fr/Tutoriel_Lua/Tuto/Strings/strings6.php) [Ainsi que quelques exemples.](http://wxlua.free.fr/Tutoriel_Lua/Tuto/Strings/strings7.php)  
Le pattern étant recherché sur l'ensemble des urls soumises, afin d'éviter des débordements on préfera ajouter au pattern l'url complète qui doit être prise en compte par ssowat.
>Par exemple, si on souhaite placer *skipped_regex* sur /blog en considérant une suite de chiffres indéfinie en argument. On indiquera ceci:
>```bash
>ynh_app_setting_set nom_app skipped_regex "$domain$path/blog%?%d+$"
>```
>Cela pose toutefois un éventuel problème, si les variables $domain ou $path contiennent un tiret (-), celui-ci sera interprété comme étant un caractère magique du pattern. Il faut donc échapper les éventuels tirets avec un %.
>```bash
>domainregex=$(echo "$domain" | sed 's/-/\%&/g')
>pathregex=$(echo "$path" | sed 's/-/\%&/g')
>ynh_app_setting_set nom_app skipped_regex "$domainregex$pathregex/blog%?%d+$"
>```


```bash
ynh_app_setting_get APP KEY
```
> Cette commande récupère le paramètre `KEY` stocké précémment pour l'application `APP` à l'aide de *ynh_app_setting_set*  
>Par exemple
>```bash
>is_public=$(ynh_app_setting_get nom_app is_public)
>```


```bash
ynh_app_setting_delete APP KEY
```
> Cette commande supprime le paramètre `KEY` enregistré pour l'application `APP`.



#### Gestion des utilisteurs:
```bash
ynh_user_exists USERNAME
```
> Cette commande vérifie l'existence de l'utilisateur `USERNAME` dans Yunohost.  
>La sortie de la commande doit être testée pour en connaître le résultat.  
>```bash
>ynh_user_exists "johndoe"
>if [[ $? -eq 0 ]]; then
>	echo "L'utilisateur existe."
>fi
>```


```bash
ynh_user_get_info USERNAME KEY
```
> Cette commande récupère l'information `KEY` sur l'utilisateur `USERNAME`.
> Les informations pouvant être récupérés sur un utilisateur sont:
> - firstname
> - fullname
> - lastname
> - mail
> - mail-aliases
> - mailbox-quota  
>Par exemple
>```bash
>mailadmin=$(ynh_user_get_info $admin mail)
>```


```bash
ynh_system_user_exists USERNAME
```
> Cette commande vérifie l'existence de l'utilisateur `USERNAME` sur le système.  
>La sortie de la commande doit être testée pour en connaître le résultat.  
>```bash
>ynh_system_user_exists "www-data"
>if [[ $? -eq 0 ]]; then
>	echo "L'utilisateur existe sur le système."
>fi
>```



#### Autres commandes:
```bash
ynh_string_random LENGTH
```
> Cette commande génère une chaine de caractères aléatoires de longueur `LENGTH`.


```bash
ynh_die MSG RETCODE
```
> Cette commande affiche le message `MSG` sur stderr et exécute la commande exit avec le code de sortie `RETCODE`


```bash
sudo yunohost app checkport PORT
```
>Cette commande vérifie le `PORT` et retourne une erreur si il est déjà utilisé.  
>La sortie de la commande doit être testée pour en connaître le résultat.  
```bash
port=PORT_PAR_DEFAUT
sudo yunohost app checkport $port
while [[ ! $? -eq 0 ]]; do
    port=$((port+1))
    sudo yunohost app checkport $port
done
```


```bash
sudo yunohost app checkurl DOMAINPATH -a APP
```
>Cette commande vérifie la disponibilité du chemin DOMAIN/PATH. Il est utile pour les applications web et vous permet d’être sûr que le chemin n’est pas utilisé par une autre application. Si le chemin est inutilisé, elle le « réserve » pour l'application APP.

>**Remarque** : ne pas préfixer par `http://` ou par `https://` dans le `DOMAINPATH`.


```bash
sudo yunohost app ssowatconf
```
>Cette commande régénère la configuration du SSO. Elle est appelée automatiquement à la fin du script.  
>Mais peux être appelée avant si nécessaire.
