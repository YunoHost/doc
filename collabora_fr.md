# Installer Collabora avec Nextcloud via Docker

**Note :** la marche à suivre detaillée est réalisée ici à partir d’une instance Yunohost sur Debian 8 (celle-ci n'a pas été testée suite à la migration vers la version 3 de Yunohost). Ces instructions ont pour pré-requis que les domaines/sous-domaines sont correctement configurés au niveau des DNS et de votre instance Yunohost (voir [DNS](/dns_fr), [DNS et installation d’une application sur un sous-domaine](/dns_subdomains_fr), [Configurer les enregistrements DNS](/dns_config_fr) et [Nom de domaine en noho.st / nohost.me / ynh.fr](/dns_nohost_me_fr)).

### 0. Installer Nextcloud

Si l'application Nexcloud n'est pas déja installée sur votre instance Yunohost, vous pouvez l’installer depuis le lien suivant : [Installer Nextcloud](https://install-app.yunohost.org/?app=nextcloud)


### 1. Installer l'application Collabora dans yunohost
**dans l'interface d'administration :**

Applications > Installer > En bas de la page _Installer une application personnalisée_ > Renseigner l’url « https://github.com/aymhce/collaboradocker_ynh  » > Définir le nom de domaine secondaire/sous-domaine dédié à l'application Collabora.


### 2. Configuration dans Nextcloud

 **Ajouter l'application Collabora Online à Nextcloud :**

Cliquer sur l'icône de l'utilisateur en haut à droite >  Applications  >  Bureautique & texte > Sous « Collabora Online » cliquer sur  `Activer` .

**Configurer Collabora sur Nextcloud :**

 Cliquer sur l'icone de l'utilisateur en haut à droite >  Paramètres > Sous _Administration_, _Collabora en ligne_ .
 Renseigner le « Serveur Collabora en ligne » par le nom de domaine choisi lors de l’installation de collabora dans yunohost (précédé de « https:// »).

### 3. Reboot
Pour permettre la mise en marche du lien collabora-Nextcloud, le système doit être rebooté. Faisable depuis l'interface d'administration : Outils > Arrêter/redémarrer > `Redémarrer`. Ou depuis la ligne de commande : ``sudo reboot now``.

## Débug
Suite à certaines mises à jour du système, de yunohost ou des applications, Collabora peut afficher un message d'erreur du type "c'est embarrassant...". Pour remettre les choses en marche, il suffit de redémarrer la machine docker, avec la commande ``systemctl restart docker``.
