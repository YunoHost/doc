## Contribuer au cœur de YunoHost

Vous souhaitez ajouter une nouvelle fonctionnalité au cœur de YunoHost, mais ne
savez pas comment procéder ? Ce guide parcours les étapes du développement et du
processus de contribution.

Si vous chercher quelque chose à implémenter ou un bug à réparer, le
bug tracker est [ici](https://github.com/yunohost/issues/issues) !

**Venez dire coucou sur le [salon de dev](/chat_rooms)** !

### Mettre en place un environnement de développement

- **Utilisez [ynh-dev](https://github.com/YunoHost/ynh-dev)** (voir le README)
  pour mettre en place un environnement de développement - en local sur une
  machine virtuelle, ou bien sur un VPS.
  Ceci installera une instance fonctionelle de YunoHost, en utilisant
  directement les dépôts git à l'aide de liens symboliques. De cette façon, il
  vous sera possible de modifier les fichiers, de tester les changements en
  temps réel, et de commiter et push/pull directement depuis cet environnement.

- **Implémentez et testez votre fonctionnalité**. Suivant ce sur quoi vous
  voulez travailler :
   - **Cœur Python/ligne de comande** : allez dans `/ynh-dev/yunohost/`
   - **Interface d'administration web** : allez dans `/ynh-dev/yunohost-admin/`
   - Vous pouvez aussi travailler sur les autres projets liés sur lesquels
     s'appuie YunoHost (SSOwat, moulinette) de façon similaire.

### Vue d'ensemble des 4 morceaux principaux de YunoHost

##### Moulinette

C'est un petit framework "fait maison". [Son rôle principal](https://moulinette.readthedocs.io/en/latest/actionsmap.html) 
est de permettre de construire une API Web et une API en ligne de commande à partir d'un même code Python et d'un schéma YAML que nous appelons 
[l'actionmap] (https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/actionsmap/yunohost.yml).

Il prend en charge d'autres mécanismes tels que l'authentification, l'internationalisation
et des petites fonctions utilitaires techniques (par ex. lecture/écriture de fichiers json).

Moulinette dispose de sa propre documentation [ici](https://moulinette.readthedocs.io/en/latest/).

##### Yunohost

C'est le coeur même de YunoHost. Il contient :
- [le code python](https://github.com/YunoHost/yunohost/tree/stretch-unstable/src/yunohost) qui gère les utilisateurs, domaines, applications, services et autres
- des [helpers bash](https://github.com/YunoHost/yunohost/tree/stretch-unstable/data/helpers.d) principalement utilisés par les packageurs d'applications dans les scripts de ces applications
- des [hooks](https://github.com/YunoHost/yunohost/tree/stretch-unstable/data/hooks) et [templates](https://github.com/YunoHost/yunohost/tree/stretch-unstable/data/templates) qui sont utilisés pour configurer les différents éléments de l'écosystème tels que nginx, postfix, ....
- des [chaînes internationalisées](https://github.com/YunoHost/yunohost/tree/stretch-unstable/locales)
- des [tests](https://github.com/YunoHost/yunohost/tree/stretch-unstable/src/yunohost/tests)

##### SSOwat

C'est le système de connexion unique (single sign-on) de YunoHost. Il contient principalement:
- [du code LUA](https://github.com/YunoHost/ssowat) interfacé directement avec nginx et qui gère tous les aspects "techniques" de l'authentification et de la gestion des accès aux ressources.
- le [portail web utilisateur](https://github.com/YunoHost/SSOwat/tree/stretch-unstable/portal) qui est l'interface finale visible pour les utilisateurs de YunoHost

SSOwat est configuré via `/etc/ssowat/conf.json` qui est généré par YunoHost.

##### Yunohost-admin

C'est une dépendance *optionnelle* de YunoHost et correspond à une interface pour l'API web créée par YunoHost et Moulinette (service `yunohost-api`).

Il contient essentiellement :
- [des templates pour les vues](https://github.com/YunoHost/yunohost-admin/tree/stretch-unstable/src/views)
- les [contrôleurs javascript](https://github.com/YunoHost/yunohost-admin/tree/stretch-unstable/src/js/yunohost/controllers) correspondants, qui interagissent avec l'API Yunohost
- et es [chaînes internationalisées](https://github.com/YunoHost/yunohost-admin/tree/stretch-unstable/src/locales)

### Travailler sur le cœur Python / ligne de commande

- Allez dans `/ynh-dev/yunohost/`.

- Exécutez `cd /ynh-dev && ./ynh-dev use-git yunohost`.

- Le fichier actionsmap (`data/actionsmap/yunohost.yml`) définit les différentes
  catégories, actions et arguments de la ligne de commande YunoHost. Choisissez
  comment vous voulez que les utilisateurs utilisent votre fonctionnalité, et
  ajoutez/éditez les catégories, actions et arguments correspondants. Par
  exemple, dans `yunohost domain add some.domain.tld`, la catégorie est
  `domain`, l'action est `add` et `some.domain.tld` est un argument.

- Moulinette va automatiquement faire le lien entre les commandes de
  l'actionsmap et les fonctions python (ainsi que leurs arguments) dans
  `src/yunohost/`. Par exemple, `yunohost domain add some.domain.tld`
  déclenchera un appel de `domain_add(domainName)` dans `domain.py`, avec l'argument 
  `domainName` qui vaudra `"some.domain.tld"`.

##### Helpers / style de code

- Pour gérer les exceptions, il existe un type `YunohostError()`

- Pour aider avec l'internationalisation des messages, utilisez `m18n.n('some-message-id')`
  et mettez le message correspondant dans `locales/en.json`. Vous pouvez aussi
  utiliser des arguments pour construire les messages, avec `{{some-argument:s}}`. 
  Ne modifiez pas de fichiers de locales autres que en.json, la traduction sera
  faite avec [weblate](https://translate.yunohost.org/) !

- YunoHost essaye de suivre le style de code [pep8](http://pep8.org/). Des
  outils existent pour vérifier automatiquement la conformité du code.

- Mettre un `_` devant les noms des fonctions "privées".

### Travailler sur l'interface d'administration web

- Allez dans `/ynh-dev/yunohost-admin/src/`.

- Exécutez `cd /ynh-dev && ./ynh-dev use-git yunohost-admin`. Ceci lance gulp, de sorte 
  qu'à chaque fois que vous modifiez les sources, il recompilera le code
  (js) et vous pourrez voir les changements dans le navigateur web (Ctrl+F5).
  Pour stopper la commande, faites simplement Ctrl+C.

- L'interface web utilise une API pour communiquer avec YunoHost. Les
  commandes/requêtes de l'API sont également définies dans l'actionsmap. Par
  exemple, accéder à la page ```https://domain.tld/yunohost/api/users```
  correspond à une requete `GET /users` vers l'API YunoHost. Cette requête
  est mappée sur `user_list()`. Accéder à cette URL devrait afficher le json
  retourné par cette fonction. Les requêtes 'GET' sont typiquement destinées à
  demander de l'information au serveur, tandis que les requêtes 'POST' sont
  destinées à demander au serveur de modifier/changer des informations ou de
  réaliser des actions.

- `js/yunohost/controllers` contiens les parties javascript, et définit quelles
  requêtes faire à l'API pendant le chargement d'une page donnée de l'interface,
  et comment traiter les données récupérées pour générer la page, en utilisant
  des templates.

- `views` contient les templates des pages de l'interface. Dans le template,
  les données venant du javascript peuvent êtres utilisées avec la syntaxe
  `{{some-variable}}`, qui sera remplacée pendant la construction de la page.
  Il est également possible d'avoir des conditions avec la syntaxe 
  d'[handlebars.js](http://handlebarsjs.com) : ```{{#if
  some-variable}}<p>du HTML conditionnel ici !</p>{{/if}}```

- Pour l'internationalisation des messages, utilisez `y18n.t('some-string-code')` 
  dans le javascript, ou `{{t 'some-string-code'}}` dans le template HTML, et 
  mettez votre message dans `locales/en.json`. Ne modifiez pas de fichiers de 
  locales autres que en.json, la traduction sera faite avec 
  [weblate](https://translate.yunohost.org/) !

##### N'oubliez pas

- À chaque modification de l'actionsmap, il faut redémarrer l'API yunohost :
  ```service yunohost-api restart```
  (Il faudra retaper le mot de passe administrateur dans l'interface web)

- Il faudra peut-être régulièrement forcer le rafraîchissement du cache
  navigateur pour propager correctement le javascript et/ou HTML (à chaque fois
  que l'on change quelque chose dans `js` ou `views`, donc).


### Votre fonctionnalité est prête et vous souhaitez qu'elle soit intégrée dans YunoHost 

- Forkez le dépòt correspondant sur Github, et commitez vos changements dans
  une nouvelle branche, Il est recommandé de nommer la branche avec la
  convention :
  - Pour une nouvelle fonctionnalité ou amélioration : `enh-ISSUENUMBER-description-fonctionnalité`
  - Pour une correction de bug : `fix-REDMINETICKET-description-correctif`
  - `ISSUENUMBER` est optionnel et correspond au numéro du ticket sur le bug tracker

- Une fois prêt, ouvrez une Pull Request (PR) sur Github. De préférence, inclure
  `[fix]` ou `[enh]` au début du titre de la PR.

- Après relecture, test et validation par les autres contributeurs, votre
  branche sera mergée dans `unstable` !


