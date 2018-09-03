## Contribuer au cœur de YunoHost

Vous souhaitez ajouter une nouvelle fonctionnalité au cœur de YunoHost, mais ne
savez pas comment procéder ? Ce guide parcours les étapes du développement et du
processus de contribution.

Si vous chercher quelque chose à implémenter ou un bug à réparer, le
bug tracker est [ici](https://github.com/yunohost/issues/issues) !

**Venez dire coucou sur le [salon de
dev](xmpp:dev@conference.yunohost.org?join)** ! Si vous n'avez pas de client
XMPP, vous devriez pouvoir vous connecter à l'aide du widget en bas de la page.

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
   - **Cœur Python/ligne de comande** : allez dans `/vagrant/yunohost/`
   - **Interface d'administration web** : allez dans `/vagrant/yunohost-admin/`
   - Vous pouvez aussi travailler sur les autres projets liés sur lesquels
     s'appuie YunoHost (SSOwat, moulinette) de façon similaire.

### Travailler sur le cœur Python / ligne de commande

- Allez dans `/vagrant/yunohost/`.

- Exécutez `/vagrant/ynh-dev use-git yunohost`.

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

- Pour gérer les exceptions, il existe un type `MoulinetteError()`

- Pour aider avec l'internationalisation des messages, utilisez `m18n.n('some-message-id')`
  et mettez le message correspondant dans `locales/en.json`. Vous pouvez aussi
  utiliser des arguments pour construire les messages, avec `{{some-argument:s}}`. 
  Ne modifiez pas de fichiers de locales autres que en.json, la traduction sera
  faite avec [weblate](https://translate.yunohost.org/) !

- YunoHost essaye de suivre le style de code [pep8](http://pep8.org/). Des
  outils existent pour vérifier automatiquement la conformité du code.

- Mettre un `_` devant les noms des fonctions "privées".

##### N'oubliez pas

- (Peut-être plus nécessaire) À chaque fois que vous modifiez l'actionsmap, il
  faut forcer le rafraîchissement du cache avec :
  `rm /var/cache/moulinette/actionsmap/yunohost.pkl`

### Travailler sur l'interface d'administration web

- Allez dans `/vagrant/yunohost-admin/src/`.

- Exécutez `/vagrant/ynh-dev use-git yunohost-admin`. Ceci lance gulp, de sorte 
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
  - Pour une nouvelle fonctionnalité ou amélioration : `enh-TICKETREDMINE-description-fonctionnalité`
  - Pour une correction de bug : `fix-REDMINETICKET-description-correctif`
  - `TICKETREDMINE` est optionnel et correspond au numéro du ticket sur RedMine

- Une fois prêt, ouvrez une Pull Request (PR) sur Github. De préférence, inclure
  `[fix]` ou `[enh]` au début du titre de la PR.

- Après relecture, test et validation par les autres contributeurs, votre
  branche sera mergée dans `testing` (?) !


