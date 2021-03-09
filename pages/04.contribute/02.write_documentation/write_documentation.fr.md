---
title: Rédaction de la documentation
template: docs
taxonomy:
    category: docs
routes:
  default: '/write_documentation'
---

## Via GitHub

La documentation de YunoHost est gérée sur un [dépôt Git](https://github.com/YunoHost/doc).

Si vous n'êtes pas familier avec GitHub, il y a un bouton "Éditer" en haut de chaque page qui vous redirigera vers l'éditeur en ligne de GitHub et qui vous aidera à proposer vos modifications (appelées *Pull Requests*).

Directement sur GitHub, vous pouvez faire un *fork* du dépôt, y faire vos modifications, et envoyer vos *pull requests*.

Puisque l'éditeur en ligne ne permet pas d'ajouter des fichiers, utiliser Git par la ligne de commande est la méthode recommandée si vous voulez ajouter des médias (comme des images).

## Grav

Sous le capot, la documentation est déployée avec le [CMS Grav](https://getgrav.org/?target=_blank).

La structure du dépôt est décrite ici:

```bash
+-- config
   +-- site.yaml
   +-- system.yaml
   +-- themes
       +-- yunohost-docs.yaml
          # Quelques paramètres pour le thème de la documentation
+-- images
   # Contains the images used in the documentation pages.
+-- pages
   # The directory containing the documentation pages.
   # The pages hierarchy is reflected by the directory hierarchy.
   +-- 00.home
   +-- 01.administrate
   +-- 02.applications
   +-- 03.community
   +-- 04.contribute
+-- themes
    +-- learn4
    +-- yunohost-docs
       # Contient le code du thème, qui est une extension du thème Learn4
+-- .gitignore
    # Contient les instructions pour ne pas envoyer de fichier
    # sensible ou inutile vers le dépôt Git
+-- README.md
```

!!!! Pour en apprendre plus sur les fonctionnalités de Grav, vous pouvez consulter sa [documentation](https://learn.getgrav.org?target=_blank) (en anglais). Le reste de cette page donne quelques consignes spécifiques pour contribuer à la documentation de YunoHost.

## L'en-tête des pages Grav

Chaque page commence par un en-tête qui donne les instructions à Grav sur comment la traiter. Regardons l'en-tête de cette page :

```
---
title: Rédaction de la documentation
template: docs
taxonomy:
    category: docs
routes:
  default: '/write_documentation'
---

```

1. L'en-tête commence et finit par une ligne contenant `---` ;
2. La clé `title` gère le premier titre de la page, son nom dans le menu de navigation à gauche, et son nom dans l'onglet du navigateur ;
3. Les clés `template` et `taxonomy` doivent toujours être inclues et laissées telles quelles. Elles informent Grav sur quel thème appliquer aux pages, et permettent de les ordonner correctement.
4. La clé `routes` et son enfant `default` font que la page est accessible par défaut à l'adresse `https://yunohost.org/docs/write_documentation` au lieu de devoir la chercher à l'adresse `https://yunohost.org/docs/contribute/write_documentation`, qui correspond à son emplacement réel dans la hiérarchie des dossiers.

## Syntaxe

Vous pouvez utiliser la syntaxe Markdown, consultez la page de [documentation dédiée](/doc_markdown_guide) pour plus d'information.

! Notez qu'il ne faut pas préciser le code de langue au début des liens vers d'autres pages de la documentation : `/fr`, `/en`, etc. sont superflus.

Pour étendre les fonctionnalités de Markdown, des extensions ont été ajoutées à Grav. Vous pouvez consulter leur propre documentation sur GitHub pour découvrir comment vous en servir.
```text
anchors
external_links
flex-objects
highlight
image-captions
markdown-notices
presentation
presentation-deckset
shortcode-core
```

## Pages spéciales

Quelques pages de la documentation sont générées automatiquement ou dynamiquement.

| Page          | Chemin | Notes |
|---------------|--------|-------|
| Catalogue d'applications  | `/pages/02.applications/01.catalog/apps.md` | Récupère et traite le fichier [app.json](https://github.com/YunoHost/apps/blob/master/apps.json?target=_blank) |
| Apps helpers  | `pages/04.contribute/04.packaging_apps/11.helpers/packaging_apps_helpers.md` | Générée par ce [script](https://github.com/YunoHost/yunohost/blob/dev/doc/generate_helper_doc.py?target=_blank), à partir de ce [canevas](https://github.com/YunoHost/yunohost/blob/dev/doc/helper_doc_template.md?target=_blank) |
| Documentation des apps | `pages/02.applications/02.docs/docs.md` | Liste les sous-pages du même dossier qui ont les clés `taxonomy.category: docs, apps` dans leur en-tête |

## Hébergez votre propre documentation de test

! Ces instructions ne sont pas encore complètement testées. Aidez-nous en nous rapportant tout problème que vous rencontriez.

0. *Fork* le dépôt de la documentation YunoHost sur GitHub
1. Installez l'app Grav pour YunoHost : `yunohost app install grav`
2. Installez les extensions suivantes via l'admin ou la ligne de commande de Grav :
```text
anchors
breadcrumbs
external_links
feed
flex-objects
git-sync
highlight
image-captions
langswitcher
markdown-notices
presentation
presentation-deckset
shortcode-core
tntsearch
```
3. Paramétrez l'extension Git Sync.
   1. Choisissez `GitHub` et vos identifiants GitHub
   2. Entrez l'adresse de votre *fork*, par exemple `https://github.com/username/doc`
   3. Copiez l'URL du webhook, par exemple `https://grav.example/_git-sync-ca25c111f0de`
   4. "Basic settings" > "Folders to Sync" : `pages` `images` `themes`
   5. "Git Repo Settings" > "User not required" : Enabled
   6. "Git Repo Settings" > "Web Hooks secret" : Enabled
   7. "Advanced settings" > "local branch" : `master`
   8. "Advanced settings" > "remote branch" : `master`  
(vous pouvez changer `master` en une autre branche si vous le souhaitez, mais n'oubliez pas de la créer au préalable sur GitHub)
   9. "Advanced settings" > "Committer Name" : votre nom d'utilisateur sur GitHub
  10. "Advanced settings" > "Committer Email" : votre email renseigné sur GitHub
  11. Enregistrez et cliquez sur "Reset Local Copy"
  12. Renseignez les adresses dans les clés `commits` et `tree` dans `config/themes/yunohost-docs.yaml` pour quelles pointent vers l'adresse de votre *fork* sur GitHub
4. Assurez-vous que les dossiers `user/pages/01.home` et `user/pages/02.typography` sont supprimés.
5. Dans l'administration de Grav, dans "Configuration" > "System" :
   1. "Language" > "Supported" : `en` `fr` `de` `es` `ar`
   2. "Language" > "Override Default Language" : `en`
   3. "Language" > "Set language from browser" : `Yes`
   4. "HTTP Headers" > "Etag" : `Yes`
   5. "Advanced" > "Blueprint Compatibility" : `Yes`
   6. "Advanced" > "YAML Compatibility" : `Yes`
   7. "Advanced" > "Twig Compatibility" : `Yes`
