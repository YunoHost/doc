---
title: Conditions Générales et spécifiques des Services opérés par le projet YunoHost
template: docs
taxonomy:
  category: docs
routes:
  default: '/terms_of_services'
  aliases: 
    - '/tos'
---

01/02/2024

## Préambule

Le projet YunoHost est animé par une équipe de personnes bénévoles qui ont fait cause commune pour créer un système d'exploitation libre pour les serveurs, appelé YunoHost. YunoHost est publié [sous licence GNU Affero General Public License v3](https://www.gnu.org/licenses/agpl-3.0.txt). En lien avec ce logiciel, le projet administre et met à disposition plusieurs services techniques et communautaires à des fins diverses.

En utilisant ces services, vous acceptez d’être lié·e par les conditions suivantes.

## Version courte (TL;DR)

- **Clause « Ceci est un projet communautaire »** : vous acceptez et respectez le fait que le projet est maintenu par une équipe bénévole, et que le temps et l'énergie bénévole sont la force motrice du projet. Les contributions au projet sont les bienvenues, ponctuelles ou dans la durée, par le moyen de votre choix (que ce soit en parler autour de vous, nous faire des retours constructifs, aider les autres, faire coucou, traduire, tester, coder, donner, ...).
- **Clause « On fait ce qu'on peut »** : vous acceptez que l'équipe bénévole fait du mieux qu'elle peut et n'est assujettie à aucune obligation, ni de moyen, ni de résultat. Le projet ne peut être tenu pour responsable des dommages ou préjudices indirects si un service cesse de fonctionner. L'équipe peut décider d'arrêter un service à tout moment.
- **Clause « On n'est pas un GAFAM »** : nous essayons de minimiser le plus possible les données personnelles qui peuvent transiter, être stockées sur notre infrastructure ou être transférée vers des tiers. Nous publions le code qui fait tourner nos services. Nous nous interdisons toute revente de données personnelles. Nous n'exploitons les données qu'à des fin de statistiques internes et anonymisées.
- **Clause « On n'aime pas les personnes toxiques »** : vous devez respecter les autres membres de la communauté en faisant preuve de civisme, de politesse et bienveillance.
- **Clause « Le logiciel libre, ce n'est pas des bénévoles à vos ordres »** : les messages se contentant de demander quand une fonctionnalité, correctif ou mise à jour sera disponible, volontairement ou involontairement insistants, sans aucune forme de politesse, de bienveillance ou d'intention de contribution, ne sont pas les bienvenus. Si vous souhaitez qu'un point en particulier soit traité, demandez-vous comment contribuer, ou a minima parlez-en avec bienveillance.
- **Clause « On ne lit pas dans les boules de cristal »** : le forum et chat d'entraide stipulent clairement que pour espérer obtenir de l'aide, il est nécessaire de fournir les informations de base (type de matériel, version de YunoHost), des éléments de contexte et les journaux complets. Ne pas le faire est extrêmement agaçant pour les bénévoles qui tentent de vous aider.
- **Clause « On ne veut pas finir en taule »** : vous devez respecter la loi (que celle-ci soit bien faite ou idiote).
- **Clause « Tout abus sera puni »** : abuser techniquement ou humainement des services peut entraîner la fermeture de vos comptes et l'interdiction de l'accès à une partie ou à l'ensemble des services, possiblement sans avertissement ni négociation.

## Distinction entre YunoHost en tant que projet, en tant que services, en tant que logiciel, et en tant que distribution

Ce document détaille les CGS qui s'appliquent **aux services fournis par le projet YunoHost**, mais **pas** à YunoHost en tant que logiciel **ni** aux applications proposées dans le catalogue de YunoHost.

YunoHost en tant que logiciel est publié [sous licence AGPLv3](https://www.gnu.org/licenses/agpl-3.0.txt) et est donc fourni sans garantie d'aucune sorte et n'est pas responsable des dommages résultant de son utilisation, ni de l'utilisation des applications qu'il permet d'installer.

*Si vous utilisez YunoHost pour fournir des services à d'autres personnes, il est de votre responsabilité de définir et publier les conditions générales d'utilisation de votre souhait pour vos propres services à l'attention de ces personnes, et de vous renseigner sur toutes les implications légales des applications que vous installez.*

## Évolution des conditions générales et spécifiques de service

Le projet YunoHost se réserve le droit de mettre à jour et modifier ces conditions. Dans ce cas, le projet YunoHost informe les personnes concernées par un affichage sur le forum ou à défaut sur le site.

Un historique daté des versions de ces conditions peut être récupéré sur <https://github.com/YunoHost/project-organization/commits/master/yunohost_project_tos_fr.md>

## Vue d'ensemble des services

Les services administrés et maintenus par le projet sont, à ce jour :

- un site web public, destiné à présenter le projet et à fournir de la documentation ;
- l'hébergement de scripts d'installation, d'images, de paquets et de clés cryptographiques liés à l'installation et à la mise à jour de YunoHost ;
- un forum communautaire public, destiné à s'entraider et discuter des problèmes ou de tout autre sujet lié au projet ;
- un catalogue d'application public pour permettre de présenter et voter pour les applications disponibles, et une API permettant à des programmes de récupérer cette liste ;
- un service pastebin, destiné à partager facilement les logs et autres informations techniques ;
- un service de nom de domaine gratuit, destiné à réduire les frictions pour les personnes qui ne possèdent pas encore de nom de domaine ou qui souhaitent une solution simple et rapide dans le contexte de YunoHost ;
- des services d'auto-diagnostic utilisés par le logiciel YunoHost et destinés à aider les utilisateurices à diagnostiquer de manière autonome les problèmes techniques ;
- un service de démonstration d'un serveur YunoHost en libre service ;
- d'autres services liés au développement et à la maintenance.

En outre, le projet dépend, utilise, ou encourage l'utilisation de services gérés par des tiers, tels que :

- des briques logicielles et recettes d'installations automatiques (apps) hébergées chez des tiers tels que (liste non-exhaustive) `github.com`, `npmjs.org`, `pypi.org`, `debian.org`, `sury.org`, …
- plusieurs salons de discussion communautaires publics utilisant les protocoles Matrix, XMPP et IRC, hébergés par des tiers tels que (liste non-exhaustive) `matrix.org` et `libera.chat` ;
- l'autorité de certification Let's Encrypt ;
- une interface de dons, dont les paiements sont gérés par Stripe et à destination de Support Self-Hosting, l'association qui récolte et gère les dons.
Le cas échéant, il est de votre responsabilité de consulter les conditions d'utilisations de ces services gérés par des tiers.

## Accès aux services

### Périmètre géographique

Les services du projet YunoHost s’adressent à l'ensemble des utilisateurices et contributeurices de YunoHost dans le monde tant que la réglementation de leur pays ne contrevient pas à leur usage ou fourniture.

### Permission d'utilisation des services

Sauf mentions contraires, l'usage des services du projet YunoHost est limité à une utilisation dans le cadre attendu :

- découverte ou utilisation du système d'exploitation YunoHost
- contribution au projet YunoHost

Tout autre usage (par exemple: utilisation dans une autre distribution, création d'intelligence artificielle, etc.) doit être préalablement validé par le projet YunoHost, à moins qu'il ne soit explicitement permis dans les conditions spécifiques du service ci-dessous.

### Services accessibles via un compte et résiliation

Les fonctionnalités suivantes sont accessibles via un compte :

- l'écriture sur le forum ;
- le vote pour les applications du catalogue (sur `apps.yunohost.org`) ;
- la réservation et la gestion de noms de domaines dynamiques fournit par le projet YunoHost (`nohost.me`, `noho.st` et `ynh.fr`).

Le compte sur le forum et le compte gérant votre nom de domaine peuvent être résiliés grâce aux identifiants associés.

## Fonctionnement

### Conditions financières

**L’ensemble des services est fournie gratuitement. N’hésitez pas à soutenir le projet YunoHost en faisant un don.**

### Intervention en cas de panne

**En cas de panne constatée, et si aucun message n’atteste sur le forum que le projet YunoHost est en train de corriger le dysfonctionnement, nous vous encourageons à faire un signalement via le chat ou le forum.**

Le projet YunoHost propose l’ensemble de ces services grâce à des bénévoles qui feront de leur mieux pour résoudre les problèmes techniques qui pourraient subvenir. Les bénévoles n'ont aucune obligation à réparer un service cassé.

En cas d’incapacité à résoudre un problème technique, le projet YunoHost pourra prendre la décision de fermer le service.

### Devenir des services

Le projet YunoHost ne garanti pas que les services continueront à fonctionner éternellement, et peut choisir d’arrêter des services si le projet estime ne plus être en mesure de fournir lesdits services.

Si le collectif qui anime le projet YunoHost en a la possibilité, il fera de son mieux pour laisser un délai suffisant pour permettre à tout le monde de migrer ou de s'adapter sereinement.

### Responsabilité du projet YunoHost

**En aucun cas, un ou une utilisatrice ne pourra se prévaloir de dommages ou indemnités résultant de problèmes techniques de quelque nature que ce soit.**

Le projet YunoHost n'est assujetti à aucune obligation (ni de moyen, ni de résultat). En cas de défaillance ou d'arrêt des services, le projet YunoHost ne peut être tenu pour responsable des dommages indirects tels que pertes de données, pertes d’exploitation, préjudices commerciaux, perte de clientèle, de chiffre d’affaires, de bénéfices ou d’économies prévus, ou de tout autre préjudice indirect.

En particulier, le projet YunoHost ne pourra être tenu responsable si vous avez fait dépendre de ses services des intérêts vitaux.

## Mésusage des services

**Tout abus peut entraîner la fermeture de vos comptes et l'interdiction de l'accès à une partie ou à l'ensemble des services.**

Le projet se réserve le droit de mettre en place les mesures jugées nécessaires pour mettre fin aux abus constatés. Le projet YunoHost reste seul juge de cette notion « d’abus » dans le but de fournir le meilleur service possible à l’ensemble des usagers et usagères. Le projet YunoHost pourra décider d'agir sans avertissement ni négociation.

### Usage illégal des services

**Le projet YunoHost n’est pas là pour vous couvrir et prendre des risques légaux à votre place. Même si votre action est légitime, vous êtes entièrement responsable de ce que vous faites.**

Vous devez respecter les lois et réglementations en vigueur lors de l’usage des services proposés par le projet YunoHost (notamment sur le forum, les chats, le paste et le service de noms de domaines) que ce soit en matière de respect de la vie privée, d’envoi de mails en grande quantité, de propriété intellectuelle, de propos discriminatoires, d’appel à la haine, de harcèlement, d’atteinte aux libertés fondamentales de personnes, etc.

En cas d’usage prohibé, le projet YunoHost peut se trouver dans l’obligation de déclencher la suspension totale ou partielle du service, le retrait de contenu, ou toute autre mesure que les lois et réglementations lui imposent.

### Respect de la communauté et des bénévoles

Vous acceptez et respectez le fait que le projet YunoHost est un projet communautaire maintenu par une équipe bénévole, et que le temps et l'énergie bénévole sont la force motrice du projet. Vous comprenez que les bénévoles du projet font de leur mieux, et qu'abuser de leur temps ou de leur énergie équivaut à saboter le projet.

Vous devez respecter les autres utilisateurices et l'équipe du projet en faisant preuve de civisme, de politesse et bienveillance. Toute forme de pression, insistance, harcèlement ou toxicité est prohibée. Le projet YunoHost se réserve le droit de vous bannir et de supprimer tout contenu paraissant non pertinent ou contrevenant à ces principes, selon son seul jugement et sans qu'un avertissement préalable ne soit nécessaire.

En particulier, le projet YunoHost sera intransigeant dès lors que votre comportement consommera trop d'énergie des contributeur⋅ices régulier⋅es du projet.

### Utilisation raisonnable

**Les services et ressources étant partagées avec le reste des utilisateurices, leur utilisation doit être raisonnable et prendre en compte l'aspect mutualisé.**

Si vous abusez du service, par exemple en monopolisant des ressources machines partagées, son contenu ou son accès pourra être supprimé.

## Nos engagements

### Charte CHATONS

**Le projet YunoHost vise à long-terme à respecter la charte du Collectif des Hébergeurs, Alternatifs, Transparents, Ouverts, Neutres et Solidaires dans le cadre de son activité de fourniture de services.**

Compte tenu de sa portée internationale, le projet YunoHost n'est pas, à ce jour, candidat à l’intégration au sein de ce collectif. Toutefois à ce jour des membres du collectif C.H.A.T.O.N.S utilisent YunoHost.

Plus d’information sur la charte C.H.A.T.O.N.S. : <https://chatons.org/charte>

### Respect de vos données personnelles et de votre vie privée

Nous essayons de minimiser le plus possible les données personnelles qui peuvent transiter, être stockées sur notre infrastructure ou être transférée vers des tiers.

Le projet YunoHost s'interdit toute revente ou transfert de données personnelles à des tiers.

Ci-dessous, le détail des informations personnelles susceptibles de transiter ou d'être stockées sur les services du projet YunoHost:

- informations techniques (IP, User agent) utilisées pour interagir avec les services. Elles sont utilisées dans le but de fournir le service, d'en assurer la maintenance et la sécurité et de créer des statistiques agrégées très basiques ;
- email et pseudonyme utilisés sur le forum ;
- informations personnelles figurant dans les messages échangées via le forum ou le chat ;
- informations personnelles incluses dans les noms de domaines fournit par le projet ;
- informations figurant dans des logs que vous avez partagés via l'outil dédié ;
- informations bancaires et personnelles dans le cadre d'un don via Stripe ou Liberapay.

Sauf mentions contraires dans les conditions spécifiques, ces données se trouvent à Paris, Strasbourg et Toulouse.

Pour plus d'informations, se référer aux conditions spécifiques de services.

### Exercice de vos droits

Conformément à l’article 34 de la loi « Informatique et Libertés », vous pouvez exercer les droits suivant en envoyant un mail à `data CHEZ yunohost.org` :

- droits d’accès, de rectification, d’effacement et d’opposition ;
- droit à la limitation du traitement ;
- droit à la portabilité des données ;
- droit de ne pas faire l’objet d’une décision individuelle automatisée.

### Règlement général sur la protection des donnée (RGPD)

Le projet YunoHost s’engage, vis à vis des services qu'il met à disposition, à respecter la réglementation en vigueur applicable au traitement de données à caractère personnel et, en particulier, le règlement (UE) 2016/679 du Parlement européen et du Conseil du 27 avril 2016 applicable à compter du 25 mai 2018, dite RGPD.

Néanmoins ceci ne signifie en aucun cas que *le logiciel YunoHost*, ni les applications proposées à l'installation, seraient certifiés avec une quelconque conformité au RGPD (quoi que cela puisse signifier pour vous).

## Litige et juridiction compétente

Le droit applicable aux présentes est le droit français. En cas de différend, les parties recherchent une solution amiable. Si la démarche échoue, le litige sera tranché par le Tribunal de Grande Instance de Toulouse (FRANCE).

Le fait que l’usager ou le projet YunoHost ne se prévale pas à un moment donné de l’une des présentes conditions générales et/ou tolère un manquement par l’autre partie ne peut être interprété comme valant renonciation par l’usager ou le projet YunoHost à se prévaloir ultérieurement de ces conditions.

La nullité d’une des clauses de ces conditions en application d’une loi, d’une réglementation ou d’une décision de justice n’implique pas la nullité de l’ensemble des autres clauses. Par ailleurs l’esprit général de la clause sera à conserver en accord avec le droit applicable.

---

## Conditions Spécifiques de Services

### Site web et documentation

#### Adresse du service

`yunohost.org`

#### Contribution

Si vous repérez une erreur, n'hésitez pas à proposer une correction, via le bouton "Éditer" (nécessite un compte GitHub) ou via un message sur le forum.

#### Données personnelles

A notre connaissance, aucune page de ce site web ne comporte de traqueurs.

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

### Dons

#### Adresse du service

`donate.yunohost.org`

#### Arrêt d'un don récurent

Pour demander l'arrêt de votre don récurrent, merci d'envoyer un mail à `donate-5542 CHEZ yunohost.org` et d'indiquer les informations qui permettront d'identifier votre don (email utilisé, nom, montant).

#### Données personnelles

Pour fournir ce service, l'association Support Self-Hosting utilise Stripe comme infrastructure de paiement.

Il est nécessaire d'utiliser une carte bancaire ainsi que de son identité, mais ces données ne sont pas stockées, ni même ne transite, par l'infrastructure du projet YunoHost, sauf dans les mails échangés dans le cadre d'une résiliation de don récurent.

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

### Supports d'installations (image ISO, ARM, script d'installation, ...)

Vous utilisez ce service dans 2 situations:

- installation ou restauration de YunoHost ;
- (plus rare) installation, mise à jour, ou restauration d'une app dont le binaire n'est pas fournis par son éditeur et dont sa compilation sur votre propre machine est jugée trop longue ou trop coûteuse en ressources.

#### Adresse du service

`build.yunohost.org`

#### Données personnelles

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

### IP

Ce service est utilisé automatiquement par vos instances YunoHost pour déterminer leurs IP publiques et permettre ainsi l'automatisation et le diagnostique de certaines opérations.

#### Adresses des services

`ip.yunohost.org` et `ip6.yunohost.org`

#### Service en libre accès

Exceptionnellement, le service de récupération d'IP publiques peut être utilisé dans d'autres cadres tant que la charge induite est minime relativement à celle de YunoHost.

#### Données personnelles

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

### Noms de domaines gratuits et dynamiques

Il s'agit du service utilisé si vous demandez un nom de domaine terminant par `nohost.me`, `noho.st` ou `ynh.fr` dans l'interface de YunoHost.

#### Adresses des services

`dyndns.yunohost.org`, `dynette.yunohost.org`, `ns0.yunohost.org`, `ns1.yunohost.org`

#### Limite d'usage

Ce service est proposé dans la limite d'un seul domaine par serveur YunoHost (bien qu'il soit possible de configurer des sous-domaine de ce domaine). Si des abus sont constatés (par exemple création de trop nombreux domaines depuis la même machine ou IP, ou création automatisée à large échelle), le projet se réserve le droit de supprimer les domaines concernés sans prévenir.

### Suppression automatique

Le projet YunoHost se réserve le droit de supprimer le domaine si aucun serveur ne semble y être associé et que l'adresse IP n'a pas été mise à jour depuis 1 an.

### Résiliation

Vous pouvez supprimer votre domaine à l'aide du mot de passe choisi lors de sa création.

#### Données personnelles

Si votre nom contient des données personnelles, celles-ci se retrouveront forcément sur les serveurs faisant fonctionner le service.

Notez que, pour fonctionner, ce service stocke et transmet nécessairement les adresses IP publiques de votre serveur.

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

### Diagnostique

Il s'agit d'un service permettant de tester automatiquement si vos services semblent correctement exposés sur internet et ainsi résoudre en autonomie les problèmes liés à la configuration réseau.

Ce service est utilisé automatiquement deux fois par jour, dès lors que vous activez la fonctionnalité de diagnostique.

#### Adresse du service

`diagnosis.yunohost.org`

#### Limite d'usage

En raison de la consommation de ressources induites, le service de diagnostique est limités à 60 domaines à diagnostiquer par requêtes.

Si vous dépassez cette limite, le projet recommande de diagnostiquer le bon fonctionnement de vos domaines par vos propres moyens.

#### Données personnelles

Pour fonctionner ce service transmet les noms de domaines et les ports à diagnostiquer. Toute donnée personnelle figurant dans les noms de domaines est donc transférée également, mais n'est pas conservée.

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

### Catalogue d'applications

Ce service permet de consulter (via un navigateur ou un programme) la liste des applications disponibles à l'installation dans YunoHost. Il permet également de voter pour les apps afin d'orienter les efforts de contribution.

De plus, les serveurs fonctionnant sous YunoHost récupèrent automatiquement le catalogue d'application une fois par jour.

#### Adresses du service

`apps.yunohost.org` et `app.yunohost.org`

#### Mésusage des services

Toute tentative de falsifier les votes sur les apps du catalogue ou de la liste de souhaits sera considéré comme un abus et peut faire l'objet d'annulation, de bannissement et de suppression de compte.

#### Données personnelles

Pour participer à la popularité des apps, il est nécessaire d'utiliser son compte sur le forum. Voir le service Forum.

Le stockage de vos votes est lié à votre identité sur le forum.

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

#### Statistiques

Afin de dimensionner nos services et planifier les nouvelles versions, nous utilisons le logs techniques de téléchargement de la liste des apps pour estimer le nombre d'instances YunoHost en fonctionnement dans la nature, et le ratio des versions majeures.

### Dépôt de paquet Debian

Il s'agit du canal par lequel les mises à jour de YunoHost en tant que logiciel sont mises à disposition. Le projet YunoHost maintient également des "builds" de certaines briques logicielles dont YunoHost dépends ou à la périphérie du projet.

#### Adresse du service

`forge.yunohost.org`

#### Autorisation de créer des dépôts miroirs

Il est autorisé (et même encouragé) de créer des dépôts miroirs du dépôt de paquet Debian de YunoHost.

#### Données personnelles

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

### Tickets et contributions au code

En l'état, le développement, les rapports de bug et les demandes de fonctionnalités s'effectuent sur les dépôts des organisations "YunoHost" et "YunoHost-Apps" sur la plateforme GitHub.

#### Respect des bénévoles

Nous ne pouvons que ré-insister sur ce qui est déjà mentionné dans la section 'Respect de la communauté et des bénévoles' plus haut : le projet est maintenu par une équipe bénévole, le temps et l'énergie bénévole est la force motrice du projet, et les bénévoles font de leur mieux. Vous êtes les bienvenues pour contribuer au projet (et le cas échéant à poser des questions sur comment contribuer) à l'équipe.

En revanche, abuser de leur temps ou de leur énergie équivaut à saboter le projet. En particulier, YunoHost n'est *pas* une communauté de bénévoles à vos ordres sur les priorités de correctifs, fonctionnalités ou mises à jour, ni pour YunoHost en tant que logiciel, ni pour le catalogue d'applications maintenues par le projet. Les bénévoles ne promettent ni support, ni correctifs, ni fonctionnalités, ni mise à jour, et ne fournissent pas non plus d'estimation sur "quand" une fonctionnalité, correctif ou mise à jour sera disponible. Les messages se contentant de demander quand une fonctionnalité, correctif ou mise à jour sera disponible, sans aucune forme de politesse, de bienveillance ou d'intention de contribution, ne sont pas les bienvenus et sapent le moral des bénévoles. Tout abus pourra être sanctionné par un bannissement des organisations GitHub du projet, voir de l'entièreté des services du projet.

### Paste

Ce service sert à partager les journaux des opérations réalisées avec YunoHost pour permettre l'étude et la résolution des problèmes.

#### Adresse du service

`paste.yunohost.org`

#### Données personnelles

Les logs que vous partagez sont susceptible de contenir des informations personnelles ou, dans le pire des cas, des secrets qui peuvent compromettre la sécurité d'une partie ou de l'entièreté de votre serveur. Lors de la publication, le logiciel YunoHost essaie de retirer automatiquement et du mieux qu'il peut ces informations. Néanmoins, le système est loin d'être parfait, et il est de votre responsabilité de relire les informations avant de partager le lien généré avec d'autres personnes.

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.

### Forum (et chat) d'entraide

#### Adresse du service

`forum.yunohost.org` et chats listés sur <https://yunohost.org/chat_rooms>

#### Demander de l'aide

Le forum et chat d'entraide stipulent clairement (par exemple [ici](https://yunohost.org/fr/help-me), [ici](https://forum.yunohost.org/t/asking-for-support-demander-de-laide/7795) et [ici](https://forum.yunohost.org/t/how-to-get-help-efficiently-comment-obtenir-de-laide-efficacement/27)) que pour espérer obtenir de l'aide, il est **nécessaire** de fournir les informations de base (type de matériel, version de YunoHost), des éléments de contexte et les journaux complets. Ne pas le faire est extrêmement agaçant pour les personnes qui tentent de vous aider, d'autant plus que nous nous efforçons de simplifier au maximum le partage de ces informations. De plus c'est contre-productif car cela fait perdre du temps à tout le monde : on ne peux pas résoudre un problème qu'on ne peut diagnostiquer.

Si ces règles ne sont pas respectées, l'équipe se réserve le droit de fermer votre sujet sans préavis.

#### Données personnelles

Le forum permet d'indiquer des informations personnelles (email, compte GitHub, pseudo). À partir de l'interface du forum, vous avez la main pour modifier et supprimer ces données.

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes. De plus, le forum est susceptible d'envoyer ou recevoir des emails, qui sont également journalisés.

#### Localisation des données

Paris

### Service de démonstration

#### Adresse du service

`demo.yunohost.org`

#### Objectif et fonctionnement

Ce service permet de tester les interfaces de YunoHost (webadmin et portail utilisateur) pour découvrir et se faire une idée de YunoHost sans l'installer. Les données de ce serveur sont détruites et réinitialisées toutes les 30 minutes environ.

#### Données personnelles

Comme n'importe quel service web, un journal technique existe enregistrant l'IP et le User Agent des requêtes.
