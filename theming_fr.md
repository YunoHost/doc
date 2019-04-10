# Personnaliser l'apparence du portail utilisateur

## Utiliser un thème

Depuis YunoHost 3.5, il est possible de changer le thème du portail utilisateur - bien que pour l'instant il faille encore faire cette opération via la ligne de commande.

Vous pouvez lister les thèmes disponibles avec : 

```bash
ls /usr/share/ssowat/portal/assets/themes/
```

Ensuite, vous pouvez utiliser `nano /etc/ssowat/conf.json.persistent` pour activer le thème que vous choisissez comme ceci :

```json
{
    "theme" : "light",
    ...autres lignes.....
}
```

<div class="alert alert-info" markdown="1">
Vous devrez peut-être forcer le rafraîchissement du cache de votre navigateur pour que le thème se propage complètement. Vous pouvez le faire avec Ctrl+Maj+R sur Firefox.
</div>

## Ajouter le thème de quelqu'un d'autre

Vous pouvez ajouter des thèmes créés par d'autres personnes en téléchargeant et en extrayant les fichiers correspondants dans un nouveau dossier `nom_du_theme` dans `/usr/share/ssowat/portal/assets/themes/`.

<div class="alert alert-warning" markdown="1">
**Attention** : l'ajout de thèmes provenant d'inconnus sur Internet **est un risque de sécurité**. Cela équivaut à exécuter du code écrit par quelqu'un d'autre sur votre machine, et peut donc être utilisé à des fins malveillantes comme voler des mots de passe !
</div> 

## Créer votre propre thème

Vous pouvez créer votre propre thème en copiant le thème existant de votre choix. Par exemple à partir du thème `light` : 

```bash
cp -r /usr/share/ssowat/portal/assets/themes/{light,votre_theme}
```

Ensuite, éditez les fichiers css et js dans `/usr/share/ssowat/portal/assets/themes/votre_theme` selon ce que vous voulez faire : 

- `custom_portal.css` peut être utilisé pour ajouter des règles CSS personnalisées au portail utilisateur ;
- `custom_overlay.css` peut être utilisé pour personnaliser le petit bouton YunoHost, présent sur les apps qui l'intègre ;
- `custom_portal.js' peut être utilisé pour ajouter du code JS personnalisé à exécuter à la fois sur le portail utilisateur ou lors de l'injection du petit bouton YunoHost ("overlay").

Vous pouvez également ajouter vos propres images et ressources qui peuvent ensuite être utilisées par les fichiers CSS et JS.

### Exemple : personnaliser le logo

Vous pouvez créer votre propre thème simplement pour changer le "branding" du portail utilisateur Yunohost et remplacer le logo YunoHost par votre propre logo !

Pour ce faire, téléversez votre logo dans `/usr/share/ssowat/portal/assets/themes/votre_theme/`, et ajoutez les règles CSS suivantes : 

```css
/* Dans custom_portal.css */
#ynh-logo {
  background-image : url("./votre_logo.png");
}

/* Dans custom_overlay.css */
#ynh-overlay-switch {
  background-image : url("./votre_logo.png");
}
```
