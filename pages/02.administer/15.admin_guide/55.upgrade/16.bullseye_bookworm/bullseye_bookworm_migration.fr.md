---
title: Migrer de 11.x vers 12.x
template: docs
taxonomy:
    category: docs
routes:
  default: '/bullseye_bookworm_migration'
---

L'objectif cette page est de décrire le processus de migration d'une instance en YunoHost 11.x (tournant sous Debian Bullseye) vers YunoHost 12.x (tournant sous Debian Bookworm). Les outils Yunohost se chargent de la migration du système Debian ET des paquetages Yunohost. N'utilisez pas les outils de migration Debian (sauf à savoir ce que vous faites).

## Notes importantes

- L'équipe de YunoHost a fait de son mieux pour que cette migration se passe autant en douceur que possible. Elle a été testée durant plusieurs mois et sur plusieurs types d'installations.

- [Faites des sauvegardes](/backup) de votre serveur et de vos données ! Cette migration est une opération complexe et éviter tous les problèmes possibles est difficile. Dans tous les cas, soyez patients et attentifs durant la migration.

- Ne vous précipitez pas à vouloir faire une réinstallation de votre système en pensant que cela serait "plus simple" (sigh). (Une attitude qui revient régulièrement est de vouloir réinstaller son système à la moindre complication...). À la place, si vous rencontrez des problèmes, nous vous encourageons à investiguer, chercher à comprendre et [trouver de l'aide sur le chat ou le forum](/help).

## Procédure de migration

Vous devez d'abord vous assurer que votre système est à jour. La migration est disponible à partir de la version 11.3.

Il est recommendé de lancer la migration depuis la ligne de commande, mais elle peut très bien être effectuée depuis la webadmin.

### Depuis la webadmin

Allez dans Outils > Migrations pour accéder à l'interface de migration. Il vous faudra ensuite lire l'avertissement attentivement et l'accepter pour lancer la migration.

Notez que même si vous fermez la page d'admin, la migration continuera (par contre l'interface d'admin sera partiellement indisponible).

### Depuis la ligne de commande

Lancez simplement :

```bash
sudo yunohost tools migrations migrate
```

puis lisez attentivement l'avertissement et les instructions.

## Pendant la migration

En fonction de votre matériel et des paquets installés, la migration peut prendre jusqu'à une ou deux heures.

Les logs seront affichés dans la barre de message au centre de la page (vous pouvez approcher la souris dessus pour voir l'historique en entier). Ils seront également consultable après coup (comme les autres opérations) dans Outils > Journaux.

### Si la migration a crashé / échoué à un moment

Si la migration a échoué a un moment donné, la première chose à faire est de tenter de la relancer. Si cela ne fonctionne toujours pas, il vous faut [trouver de l'aide](/help) (prière de fournir le/les messages correspondants ou tout élément qui vous fait penser que ça n'a pas marché).

## Choses à vérifier après la migration

### Vérifier la version de Debian et YunoHost

Pour cela allez dans l'outil de diagnostics ou regardez en bas de la page de la webadmin. En ligne de commande vous pouvez utiliser `lsb_release -a` et `yunohost --version`.

### Exécuter les nouvelles migrations

Après la mise à niveau, de nouvelles migrations sont apparues :

- La recréation des virtualenvs de vos applis Python
- La migration de PostgreSQL 13 à 15

Vous devez les lances le plus tôt possible pour garantir le bon fonctionnement de vos applis.

### Vérifiez que le diagnostic ne rapporte pas de problème particulier

Dans l'outil de diagnostics de la webadmin, vérifiez qu'il n'y a pas de problème apparu suite à la migration (par exemple un service qui ne tournerais plus...)

### Vérifiez que les applications fonctionnent

Vérifiez que vos applications installées fonctionnent... Si elles ne fonctionnent pas, il est recommandé de tenter de les mettre à jour. (ou bien de manière générale, il est recommandé de les mettre à jour même si elles fonctionnent !).

Si votre app est cassée et que vous étiez déjà sur la dernière version d'une application, vous pouvez relancer la mise à jour grâce à l'option `--force`:

```bash
yunohost app upgrade --force NOM_APP
```

## Soucis connus après la migration

Veuillez consulter [la FAQ des problèmes de migration](/bookworm_migration_issues_faq) (en anglais).
