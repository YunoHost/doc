<div class="alert alert-warning" markdown="1" style="margin-right: 120px; margin-top: 12px">La page demandée n'est pour le moment pas disponible en français. Voici à la place la version en anglais. Si vous souhaitez commencer une traduction de cette page, vous pouvez vous rendre sur [cette page](https://yunohost.org/#/groups_and_permissions_fr).</div>

Groupes utilisateurs et permissions
===========================

Vous pouvez accédez à l'interface de gestion des groupes et des permissions à partir de webmin en allant dans la section 'Users' et en cliquant sur le bouton suivant:

![](./images/button_to_go_to_permission_interface.png)

Gestion des groupes
---------------

Le mécanisme de groupe peut être utiliser pour définir les groupes d'utilisateurs qui peuvent utiliser pour restreindre les permissions pour les applications et les autres services tel que mail ou XMPP. Notez qu'il n'est * pas * obligatoire de créer un groupe pour cela : vous pouvez également restreindre l'accès à une application ou à un service à juste une liste spécifique d'utilisateurs.

L'utilisation de groupes est cependant utile pour la sémantique, par exemple si vous hébergez de nombreux groupes d'amis, d'associations ou d'entreprises sur votre serveur, vous voudrez peut-être créer des groupes comme `association1` et `association2` et ajouter des membres de chaque association au groupe concerné.

### Liste des groupes existants

Pour lister les groupes actuellement existants :

```bash
$ yunohost user group list
groups:
  all_users:
    members:
      - alice
      - bob
      - charlie
      - delphine
```

Par défaut, un groupe spécial appelé `all_users` existe et contient tout les utilisateurs enregistrés sur YunoHost. Ce groupe ne peut pas être modifier.

### Création d'un nouveau groupe 

Pour créer un nouveau groupe appelé `yolo_crew`

```bash
$ yunohost user group create yolo_crew
```

Ajoutons Charlie et Delphine à ce groupe :

```bash
$ yunohost user group update yolo_crew --add charlie delphine
```

(De même, `--remove` peut être utiliser pour retirer des membres d'un groupe)

Maintenant dans la liste du groupe nous devrions voir :

```bash
$ yunohost user group list
groups:
  all_users:
    members:
      - alice
      - bob
      - charlie
      - delphine
  yolo_crew:
    members:
      - charlie
      - delphine
```

### Suppression des groupes 

Pour supprimer le groupe `yolo_crew`, vous pouvez saisir

```bash
$ yunohost user group delete yolo_crew
```

Gestions des permissions
--------------------

Le mécanisme de permission permet de restreindre l'accès aux services (par exemple mail, XMPP, ...) et aux applications, ou même à certaines parties des applications (par exemple à l'interface d'administration de Wordpress).


### Liste des permissions

Pour lister les permissions et les accès correspondants :

```bash
$ yunohost user permission list
permissions:
  mail.main:
    allowed: all_users
  wordpress.admin:
    allowed:
  wordpress.main:
    allowed: all_users
  xmpp.main:
    allowed: all_users
```

Here, we find that all registered users can use mails, xmpp, and access the wordpress blog. However, nobody can access the wordpress admin interface.
Ici, nous trouvons tout les utilisateurs qui peuvent utiliser mails, xmpp, et accéder au blog Wordpress. Pourtant, personne n'est autorisé à accéder à l'interface d'administration de Wordpress.

Plus de détails peuvent être afficher en ajoutant l'option `--full` qui affichera la liste des utilisateurs correspondant aux groupes autorisés, ainsi que les URLs associées aux permissions (pertinent pour les applications Web).


### Ajouter les accès aux groupes ou utilisateurs

Pour autoriser un groupe à accéder à l'interface d'administration de Worspress :

```bash
$ yunohost user permission update wordpress.admin --add yolo_crew
```

Notez que vous pouvez également autoriser un seul utilisateur:

```bash
$ yunohost user permission update wordpress.admin --add alice
```

Et maintenat nous pouvons voir que le YoloCrew and Alice ont accès à l'interface d'administration de Worspress :

```bash
$ yunohost user permission list
  [...]
  wordpress.admin:
    allowed:
      - yolo_crew
      - alice
  [...]
```
Notez que, par exemple, if nous voulons restreindre la permission pour les emails pour que seulement Bob y ait accès, nous devons également retirer `all_users` dans les permissions : 

```bash
$ yunohost user permission update mail --remove all_users --add bob
```

Note pour les empaqueteurs d’applications (apps packagers)
------------------------

L'installation d'une application créée une permission `app.main` avec `all_users` autorisés par défaut.

Si vous souhaitez rendre une application disponible publiquement, au lieu de l'ancien mécanisme `unprotected_urls`, vous devez donner l'accès au groupe spécial `visitors`:

```bash
ynh_permission_update --permission "main" --add visitors
```

Si vous souhaitez créer une permission personnalisée pour votre application (par exemple: restreindre l'accès à l'interface d'administration) vous pouvez utiliser les aides suivantes :

```bash
ynh_permission_create --permission "admin" --url "/admin" --allowed "$admin_user"
```

Vous n'avez pas besoin de prendre en compte la suppression des permissions ou de les sauvegarder / restaurer car elles sont gérées par le noyau de YunoHost.

### Migration hors de la gestion des permissions héritées

Lors de la migration / correction d'une application utilisant toujours le système de permissions hérité, il faut comprendre que les accès doivent maintenant être gérés par des fonctionnalités du noyau, en dehors des scripts d'application!

Les scripts d'application devraient uniquement:

- le cas échéant, pendant le script d'installation, initialisez la permission principale de l'application en tant que public («visiteurs») ou privé («tous les utilisateurs») ou uniquement accessible à des groupes / utilisateurs spécifiques;
- le cas échéant, créez et initialisez toute autre permission spécifique (par exemple, sur l'interface d'administration) dans le script d'installation (et *peut-être* dans certaines migrations se produisant dans le script de mise à niveau).


Les scripts d'applications ne doivent absolument ** PAS ** altérer les accès aux applications déjà existantes (y compris les paramètres `unprotected`/`skipped_uris`) car dans tous les autres cas, *cela réinitialiserait toute règle d'accès définie par l'administrateur*!

Lors de la migration hors des permissions héritées, vous devez:
- retirer toute gestion des paramètres ressemblant à `$is_public`-like ou `$admin_user`, à l'exception de toute question manifeste destinée à *initialiser* l'application en tant que publique/privée ou spécifier des permissions;

- retirer toute gestion des paramètres de `skipped_`, `unprotected_` et `protected_uris` (et `_regex`) qui sont désormais obsolètes et dépréciés. (Notez que vous devez ***explicitement les supprimés dans le script de mise à jour***). Désormais, vous devez utiliser le nouveau mot clé `ynh_permission_*`. Si vous avez toujours besoin de les utilisés, contacter s'il vous plaît la Team pour fournir vos remarques et nous vous dirons quoi faire ;
Par exemple, dans le script de mise à jour si vous avez utiliser précédemment la clé `protected_uris`, vous devrez utiliser dans la section `DOWNWARD COMPATIBILITY` ce code :


```bash
protected_uris=$(ynh_app_setting_get --app=$app --key=protected_uris)

# Unused with the permission system
if [ ! -z "$protected_uris" ]; then
	ynh_app_setting_delete --app=$app --key=protected_uris
fi
```

- supprimer tout appel à `yunohost app addaccess` et aux actions similaires qui sont maintenant obsolètes et dépréciées.

- si votre application utilise LDAP et qu'elle supporte les filtres, utilisez le filtre `'(&(objectClass=posixAccount)(permission=cn=YOUR_APP.main,ou=permission,dc=yunohost,dc=org))'` pour autoriser les utilisateurs qui ont ces permissions. (Une documentation complète de LDAP est disponible [ici] 
(https://moulinette.readthedocs.io/en/latest/ldap.html) si vous voulez comprendre comment cela fonctionne avec YunoHost)

Ici vous avez un exemple de comment migrer le code à partir de l'ancien système au nouveau système de permission: [example](https://github.com/YunoHost/example_ynh/pull/111/files)

#### Cas particulier : la protection des expressions régulières

Si vous avez encore besoin d'utiliser des expressions régulières pour protéger ou déprotéger des URLs, vous ne pouvez pas utiliser le nouveau système de permission (pour l'instant).
Mais vous pouvez créer une permission fictive et utiliser les hooks pour gérer s'il y un changement dans la permission fictive.

Dans le script d'installation, créer une permission fictive (sans URL):

`ynh_permission_create --permission="create poll" --allowed "visitors" "all_users"`

Ensuite utilisez l'ancienne protection:

```bash
# Rendre l'application publique si nécessaire
if [ $is_public -eq 1 ]
then
	if [ "$path_url" == "/" ]; then
	    # Si le chemin est /, le nettoyer pour éviter toute erreur avec l'expression régulière.
	    path_url=""
	fi
	# Modifier le domaine à utiliser dans une expression régulière
	domain_regex=$(echo "$domain" | sed 's@-@.@g')
	ynh_app_setting_set --app=$app --key=unprotected_regex --value="$domain_regex$path_url/create_poll.php?.*$","$domain_regex$path_url/adminstuds.php?.*"
else
	ynh_permission_update --permission="create poll" --remove="visitors"
fi
```

Dans cet exemple, si l'application est publique, le groupe `visitors` a accès à la permission `create poll`, le groupe est supprimé de cette permisssion sinon.

Ensuite créez deux profiles dans le répertoire `hooks` à la racine du répertoire git:
`post_app_addaccess` et `post_app_removeaccess`. Dans ces hooks, vous supprimerez ou lirez la protection de l'expression régulière, si le groupe `visitors` est ajouté ou retiré de cette permission.

`post_app_addaccess`:

```bash
#!/bin/bash

# Source de l'application helpers
source /usr/share/yunohost/helpers

app=$1
added_users=$2
permission=$3
added_groups=$4

if [ "$app" == __APP__ ]; then
    if [ "$permission" = "create poll" ]; then # La permission "create poll" est modifiée.
        if [ "$added_groups" = "visitors" ]; then # Comme c'est une permission fictive, nous pouvons seulement définir/supprimer le groupe "visitors".
            domain=$(ynh_app_setting_get --app=$app --key=domain)
            path_url=$(ynh_app_setting_get --app=$app --key=path)

            if [ "$path_url" == "/" ]; then
                # Si le chemin est /, le nettoyer pour éviter toute erreur avec l'expression régulière.
                path_url=""
            fi
            # Modifiez le domaine qui doit être utlisier dans l'expression régulière
            domain_regex=$(echo "$domain" | sed 's@-@.@g')
            ynh_app_setting_set --app=$app --key=unprotected_regex --value="$domain_regex$path_url/create_poll.php?.*$","$domain_regex$path_url/adminstuds.php?.*"

            # Syncronisez la variable 'is_public' selon la permission
            ynh_app_setting_set --app=$app --key=is_public --value=1

            yunohost app ssowatconf
        else
            ynh_print_warn --message="Cette application ne prend pas en charge cette autorisation, vous pouvez uniquement ajouter ou supprimer un groupe de visiteurs."
        fi
    fi
fi
```

`post_app_removeaccess`

```bash
#!/bin/bash

# Source app helpers
source /usr/share/yunohost/helpers

app=$1
removed_users=$2
permission=$3
removed_groups=$4

if [ "$app" == __APP__ ]; then
    if [ "$permission" = "create poll" ]; then # La permission "create poll" est modifiée.
        if [ "$removed_groups" = "visitors" ]; then # Comme c'est une permission fictive, nous pouvons seulement définir/supprimer le groupe "visitors".
            
            # Nous retirions l'expression régulière, la protection n'est plus nécessaire.
            ynh_app_setting_delete --app=$app --key=unprotected_regex

            # Syncronisez la variable 'is_public' selon la permission
            ynh_app_setting_set --app=$app --key=is_public --value=0

            yunohost app ssowatconf
        else
            ynh_print_warn --message="This app doesn't support this authorisation, you can only add or remove visitors group."
        fi
    fi
fi
```

N'oubliez pas de remplacer `__APP__` pendant l'installation/la mise à jour du script;

Ici quelques applications qui utlisie ce cas spécifique: [Lutim](https://github.com/YunoHost-Apps/lutim_ynh/pull/44/files) et [Opensondage](https://github.com/YunoHost-Apps/opensondage_ynh/pull/59/files)

Si vous avez question, veuillez contacter quelqu'un du groupe applications.
