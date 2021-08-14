---
title: User groups and permissions
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_permissions'
---

Lors de l'installation d'une nouvelle application par défaut tout les utilisateurs présent sur l'instance Yunohosti y ont accès.
Autrement dit, la permission `app.main` et attribuer à tout les utilisateurs.

```shell
ynh_permission_update --permission "main" --add visitors
```

Si vous souhaitez créer une autorisation personnalisée pour votre application (par ex. pour restreindre l’accès à une interface d’administration), vous pouvez utiliser les helpers suivants :

```shell
ynh_permission_create --permission "admin" --url "/admin" --allowed "$admin_user" --label "Label for your permission"
```

Vous n’avez pas besoin de prendre soin de supprimer les permissions ou de les sauvegarder/restaurer puisque cela est géré par le noyau de YunoHost.

### Migration depuis l'ancien système de permission

Lors de la migration ou réparation d'une application utilisant toujours l'ancien système d'autorisation, il faut comprendre que les accès doivent désormais être gérés par les fonctionnalités du noyau, en dehors des scripts de application !

Les scripts de l'application doivent uniquement :
- le cas échéant, dans le script d'installation, initialisez la permission principale de l'application comme publique (`groupe "visitors"`) ou privée (`groupe "all_users"`) ou uniquement accessible à des groupes/utilisateurs spécifiques ;
- le cas échéant, créez et initialisez toute autre autorisation spécifique (par exemple pour une interface d'administration) dans le script d'installation (et *peut-être* dans certaines migrations se produisant dans le script de mise à niveau).

Les scripts d'applications ne doivent absolument ** PAS ** modifier les accès aux applications déjà existantes (y compris les paramètres « non protégés »/« skiped_uris ») dans tous les autres cas, car * cela réinitialiserait toute règle d'accès définie par l'administrateur * !

Lors de la migration depuis l'ancienne autorisation, vous devez :
- supprimer toute gestion des paramètres de type `$is_public` ou `$admin_user`, à l'exception de toute question dans le manifeste destinée à *initialiser* l'application avec les autorisations publiques/privées ou spécifiques ;
- supprimer les anciennes autorisations héritées. Découvrez comment il est recommandé de procéder dans l'application example_ynh (en particulier [cet extrait de code](https://github.com/YunoHost/example_ynh/pull/111/files#diff-57aeb84da86cb7420dfedd8e49bc644fb799d5413d01927a0417bde753e8922f))


Cela devrait se résumer à : 
```bash
if ynh_legacy_permissions_exists; then
	ynh_legacy_permissions_delete_all

	ynh_app_setting_delete --app=$app --key=is_public

	# Create the permission using the new framework (if your app has relevant additional permissions)
	ynh_permission_create --permission="admin" --url="/admin" --allowed=$admin
fi
```
- supprimer tout appel à `yunohost app addaccess` et actions similaires sont désormais obsolètes et dépréciées.
- si votre application utilise LDAP et prend en charge les filtres, utilisez le filtre
`'(&(objectClass=posixAccount)(permission=cn=YOUR_APP.main,ou=permission,dc=yunohost,dc=org))'`
pour autoriser les utilisateurs qui ont ces permissions. ( Une complete documentation du fonctionnement de LDAP est disponible [ici](https://moulinette.readthedocs.io/en/latest/ldap.html) si vous voulez comprendre comment cela fonctionne avec YunoHost.

#### Fonctionnalités supplémentaires de 4.1

- Personnalisation de l'étiquette : c'est le nom affiché aux utilisateurs finaux dans le portail utilisateur. Vous pouvez fournir une étiquette par défaut (par exemple, app.admin peut être étiqueté « interface d'administration »). L'étiquette peut être modifiée ultérieurement par l'administrateur après l'installation.
- Activation/désactivation de la vignette : elle permet choisir si une application est affichée ou non dans le portail utilisateur (si l'utilisateur a l'autorisation correspondante). L'option correspondante s'appelle `show_tile` qui peut être `True` ou `False`. Une seule application peut avoir plusieurs vignettes dans le SSO. L'URL de chaque vignettes correspond au paramètre 'url' de l'autorisation.
- Prise en charge d'URL multiples : une autorisation peut être associée à des URL supplémentaires. Cela donne la possibilité de protéger de nombreuses URL avec la même permission - en particulier pour les cas d'utilisation délicats (par exemple plusieurs parties de l'interface d'administration réparties sur différents sous-pages).
- Autorisation de protection : en tant qu'empaqueteur, vous pouvez choisir de « protéger » une autorisation si vous pensez qu'il n'est pas pertinent
pour l'administrateur d'ajouter/supprimer cette autorisation au groupe de visiteurs. C'est par exemple le cas pour l'autorisation API de Nextcloud, qui dans la grande majorité des cas devrait être conservée publiquement car le client mobile ne passera pas par le SSO. Notez que lors de l'utilisation de l'assistant `ynh_permission_update`, il est toujours possible d'ajouter/supprimer le groupe `visitor` de cette permission.
- Désactivation de l'en-tête d'authentification : certains mécanismes d'authentification d'application n'apprécient pas que SSOwat injecte l'en-tête d'autorisation (qui est un mécanisme essentiel pour le mécanisme de connexion unique). Vous pouvez maintenant choisir de désactiver l'injection de l'en-tête d'authentification de SSOwat pour résoudre ce problème (au lieu du hack précédent consistant à utiliser `skiped_uris`)


##### Correspondance entre le ancien et le nouvau système de permission

|             | with auth header | no auth header |
| :---------- | :--------------- | :------------- |
| **public**  | unprotected_uris | skipped_uris   |
| **private** | protected_uris   | N/A            |


|             | with auth header                            | no auth header                               |
| :---------- | :------------------------------------------ | :------------------------------------------- |
| **public**  | auth_header=True, visitor group allowed     | auth_header=False, visitor group allowed     |
| **private** | auth_header=True, visitor group not allowed | auth_header=False, visitor group not allowed |


Toutes ces fonctionnalitées sont managable via les helper suivant:
- `ynh_permission_create`
- `ynh_permission_url`
- `ynh_permission_update`

Si vous avez des question, merci de contacter l'équipe app.
