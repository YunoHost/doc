#Mettre à jour ses applications

Une fois que vous avez installé des applications il est nécessaire de les mettre à jour. 

** Attention : ** il est recommandé de faire une sauvegarde de la base de donnée (par exemple via l'application phpmyadmin) ainsi que des fichiers avant une opération de mise à jour.

### Mise à jour par l'interface web
Pour cela, il faut aller dans Outils > Mettre à jour le système.

Une fois la liste des paquets d'applications récupérées la page proposera de mettre à jour les applications officiels qui ont une mise à jour.

### Mise à jour par la ligne de commande
Il faut d’abord se connecter sur le serveur en ssh puis taper cette commande (dans le cas d'une mise à jour wordpress).
```bash
yunohost app upgrade wordpress
```
** Note : ** dans le cas où plusieurs applications du même type (ex: 2 wordpress) sont installés, il est nécessaire de spécifier le nom d'instance (ex: wordpress ou wordpress__2 ).

#### Mise à jour d'une application non officiel
Il faut pour cela indiquer le dépôt git qui contient la mise à jour. 

Par exemple pour mettre à jour wordpress
```bash
yunohost app upgrade -u https://github.com/zamentur/limesurvey_ynh.git limesurvey
```

** Note : ** faites attention aux applications/mises à jour non officiels que vous installez. Assurez vous que ces mises à jour sont stable et ne constituent pas une étape de développement. Si une app ou une mise à jour n'est pas intégrée au dépôt officiel, il y a peut être une raison. 

** Attention : ** assurez vous du contenu de cette mise à jour; l'installation ou la mise à jour d'une app non officiel permet à cette application d’exécuter des scripts avec les privilèges les plus hauts.
