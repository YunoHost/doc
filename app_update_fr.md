#Mettre à jour ses applications

Une fois que vous avez installé des applications, il est nécessaire de les mettre à jour. Plusieurs méthodes existent et sont détaillées ci-dessous.

** Attention : ** il est recommandé de faire une sauvegarde de la base de données (par exemple via l’application [phpmyadmin](https://github.com/YunoHost-apps/phpmyadmin_ynh) ([installer](https://install-app.yunohost.org/?app=phpmyadmin))) ainsi que des fichiers avant une opération de mise à jour.

### Mise à jour par l’interface web
Pour cela, il faut aller dans l’onglet "Mettre à jour le système".

Une fois la liste des paquets et des applications rafraîchie, il sera proposé de mettre à jour les applications et paquets qui peuvent l’être.


### Mise à jour en ligne de commande
Il faut d’abord se connecter sur le serveur en ssh, puis entrer la commande suivante (dans le cas d’une mise à jour WordPress) :
```bash
yunohost app upgrade wordpress
```
** Note : ** dans le cas où plusieurs applications du même type (ex : deux WordPress) sont installées sur le serveur, il est nécessaire de spécifier le nom d’instance (ex : wordpress ou wordpress__2).

#### Mise à jour d’une application non officielle
Il faut pour cela indiquer le dépôt git qui contient la mise à jour.

Par exemple, pour mettre à jour LimeSurvey, entrer :
```bash
yunohost app upgrade limesurvey -u https://github.com/zamentur/limesurvey_ynh
```

** Note : ** faites attention aux applications/mises à jour non officielles que vous installez. Assurez-vous que ces mises à jour sont stables et ne constituent pas une étape de développement. Si une application ou une mise à jour n’est pas intégrée au dépôt officiel, il y a sûrement une raison.

** Attention : ** assurez-vous du contenu de cette mise à jour ; l’installation ou la mise à jour d’une application non officielle permet à cette dernière d’exécuter des scripts avec les privilèges les plus élevés. Si le script est malicieux, il pourrait nuire à votre vie privée en communiquant à des tiers toute donnée présente sur le serveur, ou bien les détruire irrémédiablement.

##### Options de ligne de commande

Lorsque vous mettez à jour des applications à partir de la ligne de commande, vous pouvez spécifier des options spécifiques pour modifier le comportement du script d'upgrade.
Pour définir ces options, définissez la variable correspondante avant la commande d'upgrade: `sudo OPTION_TO_SET=1 yunohost app upgrade wordpress`

Les options disponibles sont:
- `NO_BACKUP_UPGRADE`: Ne pas effectuer le backup avant la mise à jour. Ce qui veut dire que la mise à jour se fera sans sauvegarde de sécurité.
- `YNH_FORCE_UPGRADE`: Force la mise à jour de l'application et du package, même si l'application est déjà à jour.

----------------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="logo de APPLICATION"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

### Index

- [Configuration](#configuration)
- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Applications clientes](#applications-clientes)
- [Liens utiles](#liens-utiles)

**Présentation générale de l'application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**Si la configuration de l'application ne se fait pas avec le panel admin de YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations avec YunoHost

**Explication des limitations actuelles en utilisation l'application avec YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Applications clientes

| Nom de l'applications | Plateforme | Multi-comptes | Autre réseaux supportés | Play Store | F-Droid | Apple Store | *Autres* |
|-----------------------|------------|---------------|-------------------------|------------|---------|-------------|----------|
|                       |            |               |                         |            |         |             |          |

## Liens utiles

 + Site web : [SITE WEB](#)
 + Documentation officielle : [DOCUMENTATION](#)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/APPLICATION](https://github.com/YunoHost-Apps/APPLICATION_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/APPLICATION/issues](https://github.com/YunoHost-Apps/APPLICATION_ynh/issues)
