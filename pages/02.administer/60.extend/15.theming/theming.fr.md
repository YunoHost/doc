---
title: Personnaliser l'apparence du portail utilisateur
template: docs
taxonomy:
    category: docs
routes:
  default: '/theming'
---

## Utiliser un thème

Vous pouvez changer le thème du portail utilisateur depuis l'interface administrateur, dans l'onglet Outils > Paramètres de YunoHost > Other > Thème du portail.

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

!!! Vous devrez peut-être forcer le rafraîchissement du cache de votre navigateur pour que le thème se propage complètement. Vous pouvez le faire avec Ctrl+Maj+R sur Firefox.

## Ajouter le thème de quelqu'un d'autre

Vous pouvez ajouter des thèmes créés par d'autres personnes en téléchargeant et en extrayant les fichiers correspondants dans un nouveau dossier `nom_du_theme` dans `/usr/share/ssowat/portal/assets/themes/`.

! **Attention** : l'ajout de thèmes provenant d'inconnus sur Internet **est un risque de sécurité**. Cela équivaut à exécuter du code écrit par quelqu'un d'autre sur votre machine, et peut donc être utilisé à des fins malveillantes comme voler des mots de passe !

Quelques thèmes sont listés sur [GitHub](https://github.com/yunohost-themes).

## Créer votre propre thème

Vous pouvez créer votre propre thème en copiant le thème existant de votre choix. Par exemple à partir du thème `light` : 

```bash
cp -r /usr/share/ssowat/portal/assets/themes/{light,votre_theme}
```

Ensuite, éditez les fichiers CSS et JS dans `/usr/share/ssowat/portal/assets/themes/votre_theme` selon ce que vous voulez faire : 

- `custom_portal.css` peut être utilisé pour ajouter des règles CSS personnalisées au portail utilisateur ;
- `custom_overlay.css` peut être utilisé pour personnaliser le petit bouton YunoHost, présent sur les apps qui l'intègrent ;
- `custom_portal.js` peut être utilisé pour ajouter du code JS personnalisé à exécuter à la fois sur le portail utilisateur ou lors de l'injection du petit bouton YunoHost ("overlay").

Vous pouvez également ajouter vos propres images et ressources qui peuvent ensuite être utilisées par les fichiers CSS et JS.

!!! Partagez vos thèmes personnalisés avec la communauté ! https://github.com/yunohost-themes

### Exemple : personnaliser le logo

Vous pouvez créer votre propre thème simplement pour changer le "branding" du portail utilisateur YunoHost et remplacer le logo YunoHost par votre propre logo !

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
