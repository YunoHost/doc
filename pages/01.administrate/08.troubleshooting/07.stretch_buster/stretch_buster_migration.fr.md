---
title: Migrer vers Buster
template: docs
taxonomy:
    category: docs
routes:
  default: '/stretch_buster_migration'
---

L'objectif cette page est de décrire le processus de migration d'une instance en YunoHost 3.8.x (tournant sous Debian Stretch/9.x) vers YunoHost 4.x (tournant sous Debian Buster/10.x)

## Notes importantes

- L'équipe de YunoHost a fait de son mieux pour que cette migration se passe autant en douceur que possible. Elle a été testée durant plusieurs mois et sur plusieurs types d'installations.

- Néanmoins, vous devez être conscient qu'il s'agit d'une opération délicate. L'administration système est un sujet compliqué et couvrir tous les cas particuliers n'est pas chose aisée. En conséquence, si vous hébergez des données et des systèmes critiques, [faites des sauvegardes](/backup). Et dans tous les cas, soyez patients et attentifs durant la migration.

- Ne vous précipitez pas à vouloir faire une réinstallation de votre système en pensant que cela serait "plus simple" (sigh). (Une attitude qui revient régulièrement est de vouloir réinstaller son système à la moindre complication...). À la place, si vous rencontrez des problèmes, nous vous encourageons à investiguer, chercher à comprendre et [trouver de l'aide sur le chat ou le forum](/help).

## Procédure de migration

#### Depuis la webadmin

Après avoir mis à jour vers la version en 3.8.5.x, allez dans Outils > Migrations pour accéder à l'interface de migration. Il vous faudra ensuite lire l'avertissement attentivement et l'accepter pour lancer la migration.

#### Depuis la ligne de commande

Après avoir mis à jour vers la version 3.8.5.x, lancez : 

```bash
sudo yunohost tools migrations migrate
```

puis lisez attentivement l'avertissement et les instructions.

## Pendant la migration

En fonction de votre matériel et des paquets installés, la migration peut prendre jusqu'à une ou deux heures.

Les logs seront affichés dans la barre de message en haut (vous pouvez approcher la souris dessus pour voir l'historique en entier). Ils seront également consultable après coup (comme les autres opérations) dans Outils > Journaux. 

Notez que même si vous fermez la page d'admin, la migration continuera (par contre l'interface d'admin sera partiellement indisponible).

#### Si la migration a crashé / échoué à un moment.

Si la migration a échoué a un moment donné, la première chose à faire est de tenter de la relancer. Si cela ne fonctionne toujours pas, il vous faut [trouver de l'aide](/help) (prière de fournir le/les messages correspondants ou tout élément qui vous fait penser que ça n'a pas marché).

## Choses à vérifier après la migration

#### Vérifiez que vous êtes véritablement sous Debian Buster / YunoHost 4.x

Pour cela, vous pouvez aller dans la partie Diagnostic (section Système de base). (Vous pouvez aussi regarder ce qui est affiché à droite dans le pied de page de la webadmin). En ligne de commande, vous pouvez aussi utiliser `lsb_release -a` et `yunohost --version`.

#### Vérifiez que le diagnostic ne rapporte pas de problème particulier

Également dans la section Diagnostic de la webadmin, vérifiez qu'il n'y a pas de problème apparu suite à la migration (par exemple un service qui ne tournerais plus...)

#### Vérifiez que les applications fonctionnent

Vérifiez que vos applications installées fonctionnent... Si elles ne fonctionnent pas, il est recommandé de tenter de les mettre à jour. (ou bien de manière générale, il est recommandé de les mettre à jour même si elles fonctionnent !).

## Soucis (mineurs) connus après la migration

- Quelques fichiers de configurations (`/etc/nsswitch.conf` et `/etc/nslcd.conf`) apparaîtrons comme manuellement modifiés. Vous pouvez appliquer la regen-conf en toute sécurité pour régler le problème avec la commande:

```bash
yunohost tools regen-conf nsswitch nslcd --force
```

(nous allons essayer de corriger ceci automatiquement)

- Il se peut que la migration postgresql (censée s'effectuer automatiquement après la migration à Buster) ne fonctionne pas correctement... Certains utilisateurs ont rapporté que relancer la migration suffisait à résoudre le problème. (Nous allons voir pour comprendre et corriger ce soucis)
