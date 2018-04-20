# Organisation du projet YunoHost

## Objectif du document
Ce document a pour objectif de permettre aux contributeurs de se sentir légitimes d’effectuer une contribution dans le projet YunoHost avec un avis collectif. Il vise également à renforcer le projet en le structurant autour de groupes de travail autonomes pouvant résister au départ ou à l'absence de certains contributeurs.
Le projet étant communautaire, les décisions prises hâtivement et discrètement par un groupe restreint de contributeurs peuvent entraîner des frustrations postérieures.
Pour pallier ce problème, la solution proposée ici est de faire en sorte que les décisions soient prises collectivement, qu’elles soient suffisamment réfléchies, et qu'elles soient documentées ou rendues publiques.
Un conseil oriente l’évolution du projet YunoHost, et des groupes d’intérêts permettent de contribuer plus efficacement en fonction des domaines de prédilection de chacun.

## Définition de YunoHost

###  Objectifs
Le but de YunoHost est de rendre accessibles au plus grand nombre l’installation et l’administration d’un serveur, sans délaisser la qualité et la fiabilité du logiciel.

###  Valeurs

#### Un logiciel libre et communautaire

YunoHost est un logiciel sous licence libre, entièrement communautaire, et reposant sur des applications elles-mêmes communautaires et souvent libres (roundcube, baikal, etc...).


#### Que chacun peut s'approprier

Historiquement, le projet est très proche des initiatives visant à la création d'un internet neutre et décentralisé. Cette proximité, notamment avec la [FFDN](https://www.ffdn.org/), a amené une partie des contributeurs de YunoHost à créer la Brique Internet dont la mission est de faciliter l'auto-hébergement en fournissant une solution complète incluant service (via un VPN) et matériel. Cet aspect militant n'entrave pas des initiatives commerciales du logiciel pour lequel des entreprises pourraient proposer du support ou de l'hébergement.


## Organisation de YunoHost

### Une structure ouverte, organisée par thèmes
L'objectif de l'organisation de YunoHost est de permettre au plus grand nombre de contribuer à l'amélioration du logiciel, que ce soit d'un point de vue technique (développement, packaging d'application) ou non (communication, assistance aux utilisateurs, documentation, etc.). Inspiré par différents projets passés en revue lors de l'événement (Kodi, Debian, Django, Fedora, Wikipédia, etc.) et des idées de contributeur de YunoHost (Jérôme, Bram, opi, scith, ju), il a été décidé d'une organisation en groupes spécialisés, fédérés par un conseil de contributeurs clés.

Schéma d’organisation du projet YunoHost :

<img src="https://raw.githubusercontent.com/YunoHost/yunohost-project-organization/master/organization_schema.png" height="600px" />


#### Définition et constitution des groupes
La constitution de groupes part du constat que YunoHost compte beaucoup de sous-projets (treize au total), mais que l'on ne sait pas toujours qui en est en charge ou qui y est compétent. Il est donc proposé une simplification de l'organisation des sous-projets en groupes thématiques :

- ##### Groupe Core Dev
 - Core YunoHost
 - Moulinette
 - Admin web
 - SSOwat
 - Dynette
 - YNH-Dev

- ##### Groupe Distribution
 - Création et maintenance des images d'installation sur diverses architectures
 - Distribution des images
 - Gestion de la distribution des paquets Debian.

- ##### Groupe Infra/Adminsys
 - Infrastructure
 - Site web (wiki, forum, salon de discussion, redmine, mumble)
 - Démo
 - Services
    - [ip.yunohost.org](https://ip.yunohost.org/) et ip6.yunohost.org
    - [yunoports](http://ports.yunohost.org/)
    - nohost.me et noho.st
    - [yunodash](https://dash.yunohost.org/)
    - [yunopaste](http://paste.yunohost.org/)

- ##### Groupe Apps
 - Apps Officielles
 - Apps Communautaires
 - outils de développements d'app (package_checker, package linter)

- ##### Groupe Communication
 - Documentation
 - Communication (annonce évolutions du projet sur le forum, réseaux sociaux)
 - Traduction
 - Entraide (support)

Les groupes sont ouverts à tous les contributeurs souhaitant participer au développement de YunoHost. Chacun peut s'inscrire aux canaux de communication associés aux groupes auxquels il souhaite prendre part. Chaque inscrit est libre d'échanger avec le reste du groupe et de proposer une prise de décision à la suite d'une étape d'échange et d'amélioration de la proposition. Il est recommandé aux contributeurs de documenter au maximum leurs décisions et leurs contributions. Ceci permet de renforcer l'autonomie des groupes en cas de départs ou d'absences de certains de leurs membres.
Afin de faciliter sa gestion, chaque groupe nomme donc un coordinateur (et un remplaçant) dont le rôle est :  

- d'accueillir et de fédérer les nouveaux contributeurs réguliers de son groupe
- de tenir informé le Conseil des décisions prises au sein du groupe (cf. point suivant)

Le choix d'un outil de communication est laissé à chaque groupe en fonction de sa pertinence (forum, chat, ML, etc.).

#### Définition et constitution du Conseil

YunoHost grandissant, il est important de maintenir une cohérence entre tous les groupes, néanmoins il est impossible d'imposer à chacun des membres des groupes de s'intéresser ou de s'impliquer sur tous les aspects du projet (pour des raisons de temps et de compétences). Pour pallier à cela, il est proposé de créer un méta-groupe, où chaque groupe sera représenté par au moins un de ses membres : le Conseil.
Le Conseil est indépendant des groupes et réunit les contributeurs souhaitant s'impliquer le plus dans le projet, son rôle est de :

- prendre les décisions importantes sur YunoHost qui ne dépendent pas d'un seul groupe (par exemple changer le moteur du wiki)
- faire des points réguliers sur l'ensemble du projet pour assurer sa cohésion. (réunion Mumble)
- solliciter l'ensemble de la communauté des contributeurs (ou même des utilisateurs) quand une décision divise les groupes et/ou le Conseil

Le choix d'un outil de communication est laissé au Conseil, ses décisions doivent néanmoins être consultables par l'ensemble de la communauté de contributeurs.
Pour participer aux votes du Conseil, il faut avoir contribué au projet et avoir obtenu un droit de vote (ou d'entrée) au sein du Conseil. Ce droit est délivré par le Conseil (éventuellement sur demande). Le Conseil est libre à tout moment de modifier le processus de décision.
Être membre du Conseil n'implique pas forcément d'avoir l'ensemble des accès (infrastructure, dépôt etc...).

### Processus de validation des pull requests

Cette section détaille le processus de validation des pull requests dans les différents dépôts du projet. L'objectif de ce processus est de dégager un « consensus mou ». Il est important de préciser que ce processus est *recommandé* mais ne représente pas un impératif. En particulier, il ne couvre pas toutes les situations qui peuvent se présenter. Il est donc légitime de l'adapter (avec l'accord du groupe concerné) lorsqu'il n'est pas adapté au contexte.

Si un consensus ne peut être trouvé au sein d'un groupe en suivant le processus décrit, il est invité à se tourner vers le Conseil pour en débattre. Si aucun consensus n'est trouvé, la proposition sera soumise au vote de tous les contributeurs.

#### 1. Proposition

N'importe quel contributeur peut proposer une pull request (abrégée PR dans la suite) dans les divers dépôts liés au projet YunoHost (core, apps, infra, ...).

L'auteur est vivement encouragé à décrire sa proposition en donnant le maximum  des informations
pertinentes. Le groupe peut, à cette fin, proposer un modèle des informations à
inclure, comme par exemple :
- status actuel de la PR (ex. : non terminé, en attente de revues, choix techniques à faire...)
- problème auquel réponds la PR (et références liées, par ex. : ticket sur le bugtracker, post sur le forum...)
- solution, stratégie, résumé des changements, et/ou choix techniques utilisés dans la PR
- comment tester la PR

L'auteur est vivement encouragé à respecter les bonnes pratiques suivantes :
- une PR doit concerner exclusivement un sujet précis. Par exemple, elle ne doit pas à la fois résoudre un bug et ajouter une fonctionnalité (à moins que l'un implique l'autre) ;
- avant de débuter l'implémentation d'une fonctionnalité qui fait intervenir des choix de conception (nom et format de commande ou d'option, nouvelle API, interface utilisateur, ...), discuter en amont de manière informelle avec le groupe pour s'assurer que l'implémentation imaginée convienne au plus grand nombre et reste dans l'esprit du projet ;
- nommer sa PR avec un titre explicite, et la branche associée avec un nom explicite ;
- donner les références vers d'autres éléments liés à la PR (rapport de bug sur le bugtracker, message sur le forum, ...)

Une PR peut être créée même si son auteur juge qu'elle n'est pas encore terminée. Dans ce cas, il doit déclarer explicitement dans le fil de discussion de la PR lorsqu'il juge la PR prête. Cela n'empêche pas les autres contributeurs d'émettre des avis sur la PR pendant ce temps.

Il appartient aussi à l'auteur de la PR de juger de son importance. (Ce jugement pourra cependant être contesté par les autres membres du groupe concerné par la PR.) Les niveaux d'importance utilisés sont les suivants :
- **micro** : concerne uniquement un détail de forme et/ou qui ne nécessite pas d'être débattue et testée. Elle doit être facilement réversible.
- **mineure** : impacte de manière légère le projet (e.g. refactoring d'une petite partie de code, réparation d'un bug, ...)
- **moyenne** : impacte de manière significative l'architecture d'une partie du code (e.g. refactoring de tout un aspect ou de tout un fichier, ajout d'une fonctionnalité importante, sortie d'une version testing, ...)
- **majeure** : impacte lourdement l'ensemble du projet (e.g. migration d'une dépendance critique, changement de version de Debian, sortie d'une version stable,  ...)


#### 2. Revue et validation collective

(Cette section ne s'applique pas aux PR "micro" qui peuvent être validées directement par leur auteur.)

Une fois la PR déclarée comme terminée, les contributeurs sont invités à donner leurs avis, relire et tester les changements proposés pour les valider. Lorsque des bugs ou des implémentations mauvaises ou incomplètes sont trouvées, les relecteurs rapportent cordialement le problème à l'auteur de la PR sur le fil de discussion. Si le problème trouvé est simple à corriger (e.g. typo ou détail de forme), le relecteur est encouragé à amender la PR pour corriger le problème lui-même. Sinon, l'auteur fait de son mieux pour corriger les problèmes soulevés.

Les relecteurs rapportent également le degré de relecture et de tests effectués (c.f. liste ci-dessous). Selon l'importance de la PR (mineure, moyenne ou majeure), différents quotas de tests et approbations sont à remplir pour que celle-ci soit validée. Les relecteurs peuvent valider une fois chaque type de relecture/test nécessaire (par exemple, un relecteur peut donner un point d'accord sur le principe, un autre point de relecture en diagonale, et un autre point de test dans des cas simples.). L'auteur de la PR ne compte pas dans ces quotas de validation. La proposition doit aussi passer les tests automatiques disponibles dans le groupe (CI, tests unitaires/fonctionnels, linter, ...).  

|                                   | **Mineure** | **Moyenne**  | **Majeure** |
|-----------------------------------|-------------|--------------|-------------|
| **Accord sur le principe**        |     2       |     3        |    4        |
| **Relecture en diagonale**        |     1       |     2        |    3        |
| **Testé dans les cas simples**    |     1       |     2        |    3        |
| **Relecture attentive**           |     0       |     1        |    2        |
| **Testé dans des cas compliqués** |     0       |     1        |    2        |

Si l'auteur ne fait pas parti du groupe concerné par la PR, tous ces quotas sont augmentés de 1. Dans tous les cas, ces quotas doivent être remplis au moins à 50% par des relecteurs membres du groupe concerné par la PR. (Ainsi, par exemple, un non-membre peut donner son accord sur le principe pour une PR mineure. Mais deux avis de non-membres pour une PR moyenne comptent uniquement pour un seul avis).


#### 3. Merge d'une pull request

Une fois les quotas de relecture remplis, et si aucun refus n'a été prononcé et qu'aucune demande de changement n'est en attente, n'importe quel membre du groupe peut alors déclarer et marquer la PR comme "prête à être mergée".

Pendant une durée de 3 jours suivant cette déclaration, les membres du groupe peuvent encore relire, demander des changements ou émettre un refus vis-à-vis de la PR. Dans ce cas, le merge est interrompu et le processus retourne à la partie 2). Pour les PRs moyennes et majeures, la durée est augmentée jusqu'à ce qu'il se soit écoulé au moins une semaine par rapport au moment où la PR a été déclarée comme prête par son auteur.

À l'issue de cette durée, n'importe quel membre du groupe peut merger la PR. Lorsque celle-ci comporte plusieurs commits, il est recommandé d'utiliser la fonction "squash and merge" pour garder l'historique de commit propre.

#### Cas particuliers

Plusieurs cas particuliers peuvent se présenter et dont la résolution est décrite ci-après.

##### Refus d'une PR

Une PR peut être refusée et clôturée par n'importe quel membre du groupe concerné si :
- la PR a été créée au moins depuis deux semaines
- au moins deux membres du groupe ont manifesté un désaccord avec le principe de la PR
- aucun autre membre du groupe n'a manifesté son accord avec le principe de la PR


##### Co-création

Une PR peut être développée par plusieurs personnes. Chacun est invité à y faire des commits en se concertant avec l'auteur initial ou le nouveau gestionnaire de PR si l'auteur est indisponible, manque de temps ou souhaite se consacrer à d'autres travaux. 

Si ces commits sont conséquents, dans ce cas on peut prendre **partiellement** en compte l'avis des auteurs dans les quotas de relectures et de tests. 

Exemple: si une PR est écrite par A et B (50/50), A et B pourront relire le code de l'autre. Dans ce cas, on pourra par exemple compter une relecture pour ces 2 relectures partielles.


##### Validation "allégé" en cas de manque de relecteurs

En cas de manque de relecteurs, l'auteur d'une PR peut déclencher une procédure de validation alternative si : 
- l'auteur est membre du groupe concerné par la PR
- il s'agit d'une PR mineure ou moyenne
- la PR a été déclarée comme prête
- il n'y a pas de demande de changement en attente
- les quotas de relecture "standards" n'ont pas été remplis
- une semaine s'est écoulée depuis le dernier commentaire ou commit

Dans ce cas, l'auteur annonce sur le fil de discussion de la PR qu'il souhaite engager cette prodécure ainsi que sur la liste de diffusion (ou lors d'une réunion du mardi). À partir de ce moment, les quotas d'accord, relecture et tests pour valider cette PR sont diminués de 1. Au minimum une semaine devra s'écouler avant que cette PR ne soit effectivement mergée. Un autre membre du groupe peut à tout moment mettre fin à cette procédure si il juge la PR trop critique pour être mergée de la sorte.

## Composition des groupes

- Conseil : Bram, ju, ljf, Maniack, Moul, opi, theodore.
- Core Dev : AlexAubin, Bram, JimboJoe, Ju, ljf, Moul, opi
- Apps : Bram, cyp, frju365, JimboJoe, Josue-T, Ju, ljf, Maniack C, Maxime, Moul, Scith, Tostaki
- Infra : Bram, Ju, Maniack C, Moul, opi
- Communication
  - Com : Bram, Moul, korbak, ljf, opi, frju365
  - Doc : Moul, Theodore
  - Trad : Jean-Baptiste
- Distribution : Heyyounow


## Droits d’administration afférents aux groupes
Cette partie liste les kits de droits d’administration pour les différents groupes du projet YunoHost :

(Attention, il ne s’agit pas des droits de prises de décisions dans ce cas).

### Conseil
- Aucun droits d’administration. Les droits sont complétés avec le fait d’être présents dans les autres groupes,
- Forum : membre du [groupe `Conseil`](https://forum.yunohost.org/groups/Conseil).

### Dev
- GitHub : membre de l’[équipe `Devs` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/devs),
- Redmine : membre des projets [`YunoHost`](https://dev.yunohost.org/projects/yunohost) et [`Moulinette`](https://dev.yunohost.org/projects/moulinette),
- Intégration continue : droits sur les outils d’intégrations continue CI-core,
- XMPP : modérateur du salon [`dev`](xmpp:dev@conference.yunohost.org?join),
- Forum : membre du [groupe `Dev`](https://forum.yunohost.org/groups/Dev).

### Infra
- Serveurs : accès SSH par clé sur certains (selon les besoins) ou sur la totalité des serveurs,
- GitHub : membre de l’[équipe `Infra` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/infra),
- Redmine: membre du [projet `Infra`](https://dev.yunohost.org/projects/y-u-no-infra/),
- Forum, Weblate, Redmine, XMPP, CI: administrateur,
- Forum : membre du [groupe `Infra`](https://forum.yunohost.org/groups/Infra).

### Apps
- GitHub : propriétaire (Owner) [de l’organisation YunoHost-Apps](https://github.com/orgs/YunoHost-Apps/people?utf8=%E2%9C%93&query=%20role%3Aowner),
- Redmine : membre du [projet `Apps`](https://dev.yunohost.org/projects/apps),
- GitHub : membre de l’[équipe `Apps` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/apps),
- Intégration continue : accès à [CI-Apps](https://ci-apps.yunohost.org),
- XMPP : modérateur sur le [salon `Apps`](xmpp:apps@conference.yunohost.org?join),
- Forum : membre du [groupe `Apps`](https://forum.yunohost.org/groups/Apps).

### Communication
- Forum : membre du [groupe `Com`](https://forum.yunohost.org/groups/Communication).

#### Doc
- GitHub : membre de l’[équipe `Doc` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/doc).

#### Communication
- Diaspora* : accès au compte [YunoHost](https://framasphere.org/people/01868d20330c013459cf2a0000053625),
- Twitter : accès au compte [YunoHost](https://twitter.com/yunohost),
- Forum : accès au compte [`YunoHost`](https://forum.yunohost.org/users/yunohost/activity).

#### Traduction
- Weblate : administrateur sur l’[outil de traduction](https://translate.yunohost.org/projects/yunohost/).

#### Entraide
- Forum : statut de modérateur,
- XMPP : statut de modérateur sur le salon [`support`](xmpp:support@conference.yunohost.org?join).

### Distribution
- GitHub : membre de l’[équipe `Distrib` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/distribution),
- Information : la diffusion des images (ISO…) doit se faire en collaboration avec le groupe `Infra` (et `Doc`),
- Publication : un accès SFTP peut être mis en place,
- Forum : membre du [groupe `Distribution`](https://forum.yunohost.org/groups/Distribution).

## Décisions à venir pour les groupes
### Conseil
- Faut-il élire les membres du Conseil plutôt que de les coopter ? Risque de se transformer en "campagne politique"!
- Faut-il limiter l'ouverture des groupes d'intérêts par cooptation comme pour le Conseil ?
- Proposition de changer Conseil en Collégiale
- Migrer le serveur d’infrastructure du projet sous YunoHost. (avec apps déjà packagées pad, gogs, mumble?)
- Nouveau système pour la documentation
- Amélioration de la documentation
- Migration du serveur XMPP
- Hébergement de notre forge git
- Revoir système de build : stable <— testing <— branches
- Gel de nohost.me et question de l'abandon des services

### Groupe Dev
 - Comment gérer les pull request ?
   - Chaque ticket fait l'objet d'une branche et d'un ticket, tu fais une pull/merge request, la communauté vérifie que ça fonctionne, une décision est prise d'intégrer.

### Groupe Apps
 -  Pour les apps communautaires, les issues sont bien sur Github, les discussions sur le forum

### Groupe Communication
- Rapport de bug à partir du forum
- Faire en sorte de nettoyer le forum pour éviter le bruit
- Proposition de supprimer le salon de support
- Comment rendre le forum plus actif et central
- Comment s'organiser pour les privilèges sur le forum (si les groupes veulent voter sur le forum)

### Autres
- Demande sur le forum avec notification des membres du Conseil et des représentants des groupes d’intérêts concernés.
- Vote sur deux semaines par un post sur le forum
- Créer quatre canaux pour le Dev, les Apps, la Communication et l'Infrastructure
- La release devrait être validée par l'ensemble des 4 (ou 5) groupes d’intérêts
- Communication en français et en anglais
- Annuaire ou contact des groupes pour les nouveaux arrivants. Voir peut-être annuaire tout court pour savoir qui fait quoi. https://yunohost.org/#/contribs_fr à compléter. Et à mettre en avant.
- Proposition de laisser les membres YunoHost s'auto déterminer -> Comment gérer les accès ?

## Moyens de communication actuels

- Rencontres à des évènements.
- Réunions hebdomadaires Mumble.
- [Forum](https://forum.yunohost.org).
- Listes de diffusion : [contrib](https://list.yunohost.org/cgi-bin/mailman/listinfo/contrib) et [apps](https://list.yunohost.org/cgi-bin/mailman/listinfo/apps)
- [Bugtracker Redmine](https://dev.yunohost.org).
- Forge git pour la review de code : [YunoHost](https://github.com/YunoHost) [YunoHost-Apps](https://github.com/YunoHost-Apps).
- [Salons de discussions XMPP](https://yunohost.org/#/chat_rooms_fr)
