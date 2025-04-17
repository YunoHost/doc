---
title: Migrer de 4.x vers 11.x
template: docs
taxonomy:
    category: docs
routes:
  default: '/buster_bullseye_migration'
---

L'objectif cette page est de décrire le processus de migration d'une instance en YunoHost 4.4.x (tournant sous Debian Buster/10.x) vers YunoHost 11.x (tournant sous Debian Bullseye/11.x). Les outils Yunohost se chargent de la migration du système Debian ET des paquetages Yunohost. N'utilisez pas les outils de migration Debian (sauf à savoir ce que vous faites). Notez que nous avons décidé de sauter les numéros de versions de 5 à 10 pour suivre les numéros de versions de Debian.

## Notes importantes

- L'équipe de YunoHost a fait de son mieux pour que cette migration se passe autant en douceur que possible. Elle a été testée durant plusieurs mois et sur plusieurs types d'installations.

- Néanmoins, vous devez être conscient qu'il s'agit d'une opération délicate. L'administration système est un sujet compliqué et couvrir tous les cas particuliers n'est pas chose aisée. En conséquence, si vous hébergez des données et des systèmes critiques, [faites des sauvegardes](/backup). Et dans tous les cas, soyez patients et attentifs durant la migration.

- Ne vous précipitez pas à vouloir faire une réinstallation de votre système en pensant que cela serait "plus simple" (sigh). (Une attitude qui revient régulièrement est de vouloir réinstaller son système à la moindre complication...). À la place, si vous rencontrez des problèmes, nous vous encourageons à investiguer, chercher à comprendre et [trouver de l'aide sur le chat ou le forum](/help).

## Procédure de migration

### Depuis la webadmin

Après avoir mis à jour vers la version en 4.4.x, allez dans Outils > Migrations pour accéder à l'interface de migration. Il vous faudra ensuite lire l'avertissement attentivement et l'accepter pour lancer la migration.

### Depuis la ligne de commande

Après avoir mis à jour vers la version 4.4.x, lancez :

```bash
sudo yunohost tools migrations migrate
```

puis lisez attentivement l'avertissement et les instructions.

## Pendant la migration

En fonction de votre matériel et des paquets installés, la migration peut prendre jusqu'à une ou deux heures.

Les logs seront affichés dans la barre de message au centre de la page (vous pouvez approcher la souris dessus pour voir l'historique en entier). Ils seront également consultable après coup (comme les autres opérations) dans Outils > Journaux.

Notez que même si vous fermez la page d'admin, la migration continuera (par contre l'interface d'admin sera partiellement indisponible).

### Si la migration a crashé / échoué à un moment

Si la migration a échoué a un moment donné, la première chose à faire est de tenter de la relancer. Si cela ne fonctionne toujours pas, il vous faut [trouver de l'aide](/help) (prière de fournir le/les messages correspondants ou tout élément qui vous fait penser que ça n'a pas marché).

## Choses à vérifier après la migration

### Exécuter la migration pour réparer votre application python

Après la mise à jour, vos applications python devraient être indisponibles car leur environnement virtuel doit être reconstruit.

Pour ce faire, vous pouvez exécuter les migrations en cours dans `Webadmin > Mises à jour`. Les applications ci-dessous ne seront pas réparées automatiquement, vous devez les mettre à jour manuellement avec `yunohost app upgrade -F APP`.

Les applications qui ne seront pas réparées automatiquement et nécessitent une mise à jour forcée :

- calibreweb
- django-for-runners
- ffsync (cette application est en python2 et n'est plus maintenue, aucune garantie)
- jupiterlab
- librephotos
- mautrix
- mediadrop
- mopidy
- pgadmin
- tracim
- synapse
- weblate

! !! Si nécessaire, vous pouvez désactiver la reconstruction automatique pour une application python spécifique, en supprimant le fichier dédié terminé par `.requirements_backup_for_bullseye_upgrade.txt` avant d'appliquer la migration. Vous pouvez trouver ce fichier près du venv de votre application dans `/opt` ou `/var/www`.

### Vérifiez que vous êtes véritablement sous Debian Bullseye et YunoHost 11.x

Pour cela, vous pouvez aller dans la partie Diagnostic (section Système de base). (Vous pouvez aussi regarder ce qui est affiché à droite dans le pied de page de la webadmin). En ligne de commande, vous pouvez aussi utiliser `lsb_release -a` et `yunohost --version`.

### Vérifiez que le diagnostic ne rapporte pas de problème particulier

Également dans la section Diagnostic de la webadmin, vérifiez qu'il n'y a pas de problème apparu suite à la migration (par exemple un service qui ne tournerais plus...)

### Vérifiez que les applications fonctionnent

Vérifiez que vos applications installées fonctionnent... Si elles ne fonctionnent pas, il est recommandé de tenter de les mettre à jour. (ou bien de manière générale, il est recommandé de les mettre à jour même si elles fonctionnent !).

Si votre app est cassée et que vous étiez déjà sur la dernière version d'une application, vous pouvez relancer la mise à jour grâce à l'option `--force`:

```bash
yunohost app upgrade --force NOM_APP
```

## Soucis (mineurs) connus après la migration

Voir la [page anglaise](https://yunohost.org/en/buster_bullseye_migration#current-known-minor-issues-after-the-migration)
