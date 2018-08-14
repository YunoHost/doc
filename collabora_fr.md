# Installer Collabora avec Nextcloud

**Note :** la marche à suivre detaillée et realisée ici à partir d’une instance Yunohost  sur Debian 8 (celle-ci n'a pas été testée suite a la migration sur la version 3 de Yunohost)  et celle-ci part du principe que les domaines/sous-domaines sont correctement configurés au niveau des DNS et de votre instance Yunohost (voir [DNS](/dns_fr) , [DNS et installation d’une application sur un sous-domaine](/dns_subdomains_fr) ,[Configurer les enregistrements DNS](/dns_config_fr) et [Nom de domaine en noho.st / nohost.me](/dns_nohost_me_fr)  )

### Installer Nextcloud

Si Nexcloud n'est pas déja installée sur votre instance Yunohost, vous pouvez l’installer depuis le lien suivant :

[Installer nextcloud](https://install-app.yunohost.org/?app=nextcloud)


### Installer l'application Collabora dans yunohost
**dans l'interface d'Administration :**
  Applications > Installer > En bas de la page _Installer une application personnalisée_ > Renseigner l’url « https://github.com/aymhce/collaboradocker_ynh  » > Définir le nom de domaine secondaire/sous-domaine dédié à l'application Collabora .


### Configuration dans nextcloud

 **Ajouter l'application Collabora Online à Nextcloud :**

 Cliquer sur l'icone de l'utilisateur en haut à droite >  Applications  >  Bureautique & texte > Sous « Collabora Online » cliquer sur  Activer 

**Configurer Collabora sur Nextcloud :**

 Cliquer sur l'icone de l'utilisateur en haut à droite >  Paramètres > Sous _Administration_, _Collabora en ligne_ 
 Renseigner le « Serveur Collabora en ligne » par le nom de domaine choisi lors de l’installation de collabora dans yunohost (précédé de « https:// »).
