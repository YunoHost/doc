---
title: BlogoText
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_blogotext'
---

![logo de BlogoText](image://blogotext_logo.png?width=80)

[![Install BlogoText with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=blogotext) [![Integration level](https://dash.yunohost.org/integration/blogotext.svg)](https://dash.yunohost.org/appci/app/blogotext)

### Index

- [Fonctionnalités]( #fonctionnalités)
- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Liens utiles](#liens-utiles)

BlogoText n'est pas seulement un moteur de blog mais propose plutôt un portail dédié à l'écriture de contenu. En effet, l'interface administrateur propose, en plus des outils traditionnels dédiés au blog, un lecteur de flux RSS, un hébergeur de fichiers et un outil permettant de partager des liens.

L'avantage de ce CMS est qu'il est très léger et sera parfait pour s'occuper de la partie blog ou actualité de votre site web. BlogoText est écrit en PHP, exploite une base de données SQLite et à seulement besoin de 2Mo d'espace disque. [¹](#sources)

## Fonctionnalités

  + Blog avec commentaires et flux RSS
  + Partage de liens
  + Lecteur RSS
  + Téléversement et partage d'images/fichiers
  + import-export au format JSON/ZIP/HTML; import WordPress
  + Support Addons

## Limitations avec YunoHost

Les authentification HTTP et LDAP ne sont pas pris en charges. L'application n'est pas multi-utilisateurs⋅trices.

## Liens utiles

  + Site web : [blogotext.org](https://blogotext.org)
  + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/blogotext](https://github.com/YunoHost-Apps/blogotext_ynh)
  + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/blogotext/issues](https://github.com/YunoHost-Apps/blogotext_ynh/issues)

------

### Sources

¹ [framalibre.org - BlogoText](https://framalibre.org/content/blogotext)
