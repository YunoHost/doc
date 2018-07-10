#Installer Collabora avec Nextcloud

** Note : ** la marche à suivre detailler ici et realiser à partir d’une instance Yunohost  sur Debian 8 (celle ci n'a pas etait tester suite a la migration sur la version 3 de Yunohost)  et celle-ci part du principe que les domaines/sous-domaine sont correctement configurés au niveau des DNS et de votre instance Yunohost ( voir [DNS](/dns_fr) , [DNS et installation d’une application sur un sous-domaine](/dns_subdomains_fr) ,[Configurer les enregistrements DNS](/dns_config_fr) et [Nom de domaine en noho.st / nohost.me](/dns_nohost_me_fr)  )

### installer Nextcloud

Si Nexcloud n'est pas déja installer sur votre instance de Yunohost vous pouvais l’installer avec le lien suivant :

[instaler nextcloud](https://install-app.yunohost.org/?app=nextcloud)


###installer l'application Collabora dans yunohost
** dans l'interface d'Administration : **
  Applications > Installer > En bas de la page _ Installer une application personnalisée _ > Renseigner l’url « https://github.com/aymhce/collaboradocker_ynh  » > Définir le nom de domaine secondaire/sous-domaine dédier a l'application colabora .


### configuration dans nextcloud

 ** Ajouter l'application Collabora Online à Nextcloud : **

 Cliquer sur l'icone de l'utilisateur en haut à droite >  Applications  >  Bureautique & texte > Sous « Collabora Online » cliquer sur  Activer 

** Configurer Collabora sur Nextcloud : **

 Cliquer sur l'icone de l'utilisateur en haut à droite >  Paramètres > Sous _ Administration _, _ Collabora en ligne _ 
 Renseigner le « Serveur Collabora en ligne » par votre nom de domaine renseigner lors de l’installation de collabora dans yunohost précédé de « https:// »
