---
title: Jirafeau
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_jirafeau'
---

![logo de Jirafeau](image://Jirafeau_logo.jpg?width=80)

[![Install Jirafeau with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=jirafeau) [![Integration level](https://dash.yunohost.org/integration/jirafeau.svg)](https://dash.yunohost.org/appci/app/jirafeau)

### Index

- [Configuration](#configuration)
  - [Changer les conditions d'utilisation du service](#changer-les-conditions-d'utilisation-du-service)
  - [Administration](#administration)
- [Liens utiles](#liens-utiles)

Jirafeau offre la possibilité d'héberger et de partager vos fichiers, le tout en toute simplicité. Choisissez un fichier, Jirafeau vous fournira un lien avec beaucoup d'options.
Il est possible de protéger vos liens avec mot de passe ainsi que de choisir la durée de rétention du fichier sur le serveur. Le fichier et le lien s'autodétruiront passé ce délai.
Les téléchargements des fichiers transmis peuvent être limités à une certaine date, et chaque fichier peut s'autodétruire après le premier téléchargement.
Jirafeau permet de configurer les temps maximum de rétention ainsi que la taille maximale par fichier. Le chiffrement est disponible en option.[¹](#sources)

## Configuration

### Changer les conditions d'utilisation du service

Le texte de la licence sur la page "Conditions d'utilisation du service", qui est livrée avec l'installation par défaut, est basé sur les "Conditions d'utilisation du service de l'Initiative Open Source".
Pour modifier ce texte, il suffit de copier le fichier `/lib/tos.original.txt`, de le renommer en `/lib/tos.local.txt` et de l'adapter à vos propres besoins.
Si vous mettez à jour l'installation, alors seul le fichier `tos.original.txt` peut changer éventuellement, et non votre fichier `tos.local.txt`.

### Administration

Pour administrer les fichiers présents au sein de Jirafeau il suffit de se rendre à l'adresse `jirafeau.domaine.tld/admin.php`.

## Liens utiles

 + Site web : [jirafeau.net](https://jirafeau.net/)
 + Documentation officielle : [gitlab.com - mojo42/Jirafeau](https://gitlab.com/mojo42/Jirafeau)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/jirafeau](https://github.com/YunoHost-Apps/jirafeau_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/jirafeau/issues](https://github.com/YunoHost-Apps/jirafeau_ynh/issues)

------

### Sources

¹ [framalibre.org](https://framalibre.org/content/jirafeau)
