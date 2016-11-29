# Organisation du projet YunoHost

## Objectif du document
Ce document a pour objectif de permettre aux contributeurs de se sentir légitimes d’effectuer une contribution dans le projet YunoHost avec un avis collectif.
Le projet étant communautaire, les décisions prises hâtivement par un groupe restreint de contributeurs peuvent entraîner des frustrations postérieures.
Pour pallier à ce problème, la solution proposée ici est de faire en sorte que les décisions soient prises collectivement et qu’elles soient suffisamment réfléchies.
Un conseil oriente l’évolution du projet YunoHost, et des groupes d’intérêts permettent de contribuer plus efficacement en fonction des domaines de prédilection de chacun.

## Définition de YunoHost

###  Objectifs
Le but de YunoHost est de rendre accessibles au plus grand nombre l’installation et l’administration d’un serveur, sans délaisser la qualité et la fiabilité du logiciel.

###  Valeurs

#### Un logiciel libre et communautaire

YunoHost est un logiciel sous licence libre, entièrement communautaire, et reposant sur des applications elles-mêmes communautaires et souvent libres (roundcube, baikal, etc...).


#### Que chacun peut s'approprier

Historiquement, le projet est très proche des initiatives visant à la création d'un internet neutre et décentralisé. Cette proximité, notamment avec la FFDN, a amené une partie des contributeurs de YunoHost à créer la Brique Internet dont la mission est de faciliter l'auto-hébergement en fournissant une solution complète incluant service (via un VPN) et matériel. Cet aspect militant n'entrave pas des initiatives commerciales du logiciel pour lequel des entreprises pourraient proposer du support ou de l'hébergement.


## Organisation de YunoHost

### Une structure ouverte, organisée par thèmes
L'objectif de l'organisation de YunoHost est de permettre au plus grand nombre de contribuer à l'amélioration du logiciel, que ce soit d'un point de vue technique (développement, packaging d'application) ou non (communication, assistance aux utilisateurs, documentation, etc.). Inspiré par différents projets passés en revue lors de l'événement (Kodi, Debian, Django, Fedora, Wikipédia, etc.) et des idées de contributeur de YunoHost (Jérôme, Bram, opi, scith, ju), il a été décidé d'une organisation en groupes spécialisés, fédérés par un conseil de contributeurs clés.

Schéma d’organisation du projet YunoHost :

![Schéma d’organisation du projet YunoHost](organization_schema.jpg?raw=true "Schéma d’organisation du projet YunoHost")


#### Définition et constitution des groupes
La constitution de groupes part du constat que YunoHost compte beaucoup de sous-projets (treize au total), mais que l'on ne sait pas toujours qui en est en charge ou qui y est compétent. Il est donc proposé une simplification de l'organisation des sous-projet en groupes thématiques :

- Groupe Core Dev
 - Core YunoHost
 - Moulinette
 - Admin web
 - SSOwat
 - Dynette
 - YNH-Dev

- Groupe Distribution
 - Création et maintenance des images d'installation sur diverses architectures
 - Distribution des images
 - Gestion de la distribution des paquets Debian.

- Groupe Infra/Adminsys
 - Infrastructure
 - Site web (wiki, forum, salon de discussion, redmine, mumble)
 - Démo
 - Services
    - [ip.yunohost.org](https://ip.yunohost.org/) et ip6.yunohost.org
    - [yunoports](http://ports.yunohost.org/)
    - nohost.me et noho.st
    - [yunodash](https://dash.yunohost.org/)
    - [yunopaste](http://paste.yunohost.org/)

- Groupe Apps
 - Apps Officielles
 - Apps Communautaires
 - outils de développements d'app (package_checker, package linter)

- Groupe Communication
 - Documentation
 - Communication (annonce évolutions du projet sur le forum, réseaux sociaux)
 - Traduction
 - Entraide (support)

Les groupes sont ouverts à tous les contributeurs souhaitant participer au développement de YunoHost. Chacun peut s'inscrire aux canaux de communication associés aux groupes auxquels il souhaite prendre part. Chaque inscrit est libre d'échanger avec le reste du groupe et de proposer une prise de décision à la suite d'une étape d'échange et d'amélioration de la proposition. 
Afin de faciliter sa gestion, chaque groupe nomme donc un coordinateur (et un remplaçant) dont le rôle est :  

- d'accueillir et fédérer les nouveaux contributeurs réguliers de son groupe
- de tenir informé le conseil des décisions prises au sein du groupe (cf. point suivant)

Le choix d'un outil de communication est laissé à chaque groupe en fonction de sa pertinence (forum, chat, ML, etc.).

#### Définition et constitution du Conseil

YunoHost grandissant, il est important de maintenir une cohérence entre tous les groupes, néanmoins il est impossible d'imposer à chacun des membres des groupes de s'intéresser ou de s'impliquer sur tous les aspects du projet (pour des raisons de temps et de compétence). Pour pallier à cela, il est proposé de créer un meta-groupe, où chaque groupe sera représenté par au moins un de ses membres : le Conseil.
Le Conseil est indépendant des groupes et réuni les contributeurs souhaitant s'impliquer le plus dans le projet, son rôle est de : 

- prendre les décisions importantes sur YunoHost qui ne dépendent pas d'un seul groupe (par exemple changer le moteur du wiki)
- faire des points réguliers sur l'ensemble du projet pour assurer sa cohésion. (réunion Mumble)
- solliciter l'ensemble de la communauté des contributeurs (ou même des utilisateurs) quand une décision divise les groupes et/ou le conseil

Le choix d'un outil de communication est laissé au conseil, ses décisions doivent néanmoins être consultable par l'ensemble de la communauté de contributeur.
Pour participer aux votes du conseil, il faut avoir contribué au projet et avoir obtenu un droit de vote (ou d'entrée) au sein du conseil. Ce droit est délivré par le conseil (éventuellement sur demande). Le conseil est libre à tout moment de modifier le processus de décision.
Être membre du conseil n'implique pas forcément d'avoir l'ensemble des accès (infra, dépôt etc...).

### Un processus de prises de décision basé sur un consensus mou

Les décisions à prendre peuvent être de deux ordres : 

1. pour un groupe (par "exemple merger une PR" serait affecté au groupe Dev tandis que "poster un tweet" serait de la responsabilité du groupe Communication)
2. pour l'ensemble du projet (par exemple décider d'une release avec des nouvelles fonctionnalités)

Si un consensus sur une décision à prendre n'est pas trouvée au sein d'un groupe, ce dernier devra se tourner vers le conseil pour en débattre. Si aucun consensus n'est trouvé, la proposition sera soumise au vote de tous les contributeurs.

#### Le processus de prise de décision en détail

##### 1) Initiation d'une décision à prendre
 - peut-être initiée par n'importe qui suivant les mediums définis au sein de chacun des groupes (exemple : ouvrir une PR déclenche automatiquement ce processus)
 - forcément publique à l'exception de situations bien définies (bug relatif à la sécurité critique ou vote sur les personnes)
  - une date de clôture est automatiquement définie par type de proposition. La définition de la date remplie plusieurs fonctions :
    - pouvoir laisser le temps à tout le monde de s'exprimer et ne pas prendre la décision trop vite
    -  maintenir un rythme car si le quota des réponses est rempli avant le temps imparti, il n'y a pas besoin d'attendre l'avis de tout les membres du groupe 
       - le quota est à évaluer en fonction des personnes inscrites au groupe (ou au conseil selon la situation) qui ont manifesté leurs souhaits d'être considéré comme votant régulier => exemple kload peut vouloir donner son avis ponctuellement, mais à priori il ne souhaitera pas être considéré comme membre votant actif du conseil
    - pouvoir être repoussable sur simple demande d'une des personnes du groupe. Et seulement du groupe, pas tous les contrib.

##### 2) Ouverture de la discussion, plusieurs réponses possibles :
Tout le monde peut changer de positions à n'importe quel moment, mais il est de bon ton de laisser au groupe le temps de réagir si cela est nécessaire (pas passer de positif à négatif puis rejeter la proposition 3 min après par exemple.)

- réponses dites "simple"
   - "je suis d'accord" -> vaut pour un avis positif
 - "ça me semble bon, mais je préfère m'en remettre aux autres" -> si jamais il n'y a que des avis comme cela (ou le suivant) et au moins un avis positif et que la date est passé, la proposition est acceptée
 - "pas d'avis" / "je ne suis pas en position de donner un avis pertinent (exemple: je sais pas coder en X)"
-  réponses délayantes/différées
 - demande de précisions, dans ce cas la décision est suspendue
-  refus: tout refus doit être argumenté et justifié

##### 3) Suspension/Repoussement
 - tant qu'il n'y a pas de réponse, la décision est suspendue, au moment de la réponse, la date de clôture est automatiquement repoussé (si besoin) (pour une durée, à définir, moins longue que la première fois)
 -  situation où il y a des avis positifs et négatifs ou situation où il y a un choix à faire entre plusieurs propositions

##### 4) Demande de modifications
 - mais il se peut qu'il y ai discussion autour de ces modifications, si c'est le cas, cela devient une nouvelle décision à adjoindre à la liste des décisions à prendre et le processus s'y applique alors (et cela repousse la date)
 - dans le cas contraire, un membre du groupe peut demander à ce que l'on fasse un vote qui portera sur la liste des possibilités qui font conflits + "ce vote est mal formulé, reformulons le"
 - s'il n'y a pas assez de monde d'accord, la date est repoussée et un rappel doit être envoyé
 - si le résultat est vraiment serré, le groupe est invité à rediscuter de la question si elle est importante, car cela pourrait être source de division et de tension à l'avenir

##### 5) Clôture
 -  si le groupe est unanime dans sa décision
   - que des avis positifs
   - que des refus
   - sans avis (s'en remet aux autres)
 - Pour une décison mineure ou moyenne/standard, si le quota de réponse est atteint à la durée minimale et que le consensus est obtenu.
 - s'il n'est pas possible d'avoir assez de monde (vacances, plus assez de membres du groupe pouvant avoir un avis) il est possible pour le groupe de demander la clôture même si le quota d'avis n'est pas atteint, il y a alors un nouveau décalage de la date et si cette nouvelle date est franchie, la proposition est clôturée selon les avis donnés.

###### Micro décision:
- Décision prise et appliquée par un seul membre sans délai. Ce type de décision doit impérativement pouvoir être réversible, et peut être remise en question par n'importe quel membre du groupe.

###### Décision Mineure:
- Durée initiale: 1 semaine.
- Durée minimale: 3 jours.
- Décalage, si nécessaire: 3 jours.
- Avis nécessaires: 3 dont au moins 2 membres du groupe (celui qui a initié cette prise de décision peux donner son avis). 4, dont 3 membres du groupe pour anticiper.
- Validation par vote (le cas échéant): 66% de votes positifs.

###### Décision Standard/Moyenne:
- Durée initiale: 2 semaines.
- Durée minimale: 1 semaine.
- Décalage, si nécessaire: 1 semaine.
- Avis nécessaires: 50% des membres du groupe (celui qui a initié cette prise de décision peux donner son avis). 66% des membres du groupe pour anticiper.
- Validation par vote (le cas échéant): 75% de votes positifs.

###### Décision Majeure :
- Durée initiale: 1 mois.
- Décalage, si nécessaire: 2 semaines.
- Avis nécessaires: 75% des membres du groupe (celui qui a initié cette prise de décision peux donner son avis).
- Validation par vote (le cas échéant): 90% de votes positifs.

##### 6) Application
Alors un membre du groupe peut annoncer la décision comme effective (et procéder aux actions nécessaires comme releaser, merger, annonce, autre ...). Il est important que s'il y a besoin de certaines actions, des personnes se soient engagées à les faire, une décision sans désigner est moyennement utile

## Plan de migration
Il est proposé d'appliquer dés à présent ce processus décisionnel, toutefois vu que ce n'est qu'un brouillon, chaque personne est invitée à publier des propositions de modifications/améliorations/précisions et à les soumettre. Les décisions pourront s'appuyer sur le [système de vote via Discourse](https://blog.discourse.org/2015/08/improved-polls-in-discourse).

Conseil : Bram, ju, ljf, Maniack, Moul, opi, theodore.

 - Representants des groupes d’intérêts :
  - Dev : opi, Bram, ju, ljf, AlexAubin, Moul
  - Apps : Bram, Ju, Ljf, Maniack C, Moul, Scith, Tostaki
  - Infra : opi, Bram, ju, Moul
  - Com
    - Com : Bram, Moul
    - Doc : Moul, theodore
    - Trad : Jean-Baptiste

### Décisions à venir pour les groupes
#### Conseil
- Faut-il élire les membres du conseil plutôt que de les coopter ? Risque de se transformer en "campagne politique"!
- Faut-il limiter l'ouverture des groupes d'intérêts par cooptation comme pour le conseil ?
- Proposition de changer Conseil en Collégiale
- Migrer le serveur d’infrastructure du projet sous YunoHost. (avec apps déjà packagées pad, gogs, mumble?)
- Let's Encrypt
- Nouveau système pour la documentation
- Amélioration de la documentation
- Migration du serveur XMPP
- Hébergement de notre forge git
- Revoir système de build : stable <— testing <— branches
- Gel de nohost.me et question de l'abandon des services

#### Groupe Dev
 - Comment gérer les pull request ?
   - Chaque ticket fait l'objet d'une branche et d'un ticket, tu fais une pull/merge request, la communauté vérifie que ça fonctionne, une décision est prise d'intégrer.


#### Groupe Apps
 -  Pour les apps communautaires, les issues sont bien sur Github, les discussions sur le forum

#### Groupe Communication
- Rapport de bug à partir du forum
- Faire en sorte de nettoyer le forum pour éviter le bruit
- Proposition de supprimer le salon de support
- Comment rendre le forum plus actif et central
- Comment s'organiser pour les privilèges sur le forum (si les groupes veulent voter sur le forum)

#### Autres
- Demande sur le forum avec notification des membres du conseil et des représentants des groupes d’intérêts concernés.
- Vote sur deux semaines par un post sur le forum
- Créer quatre canaux pour le Dev, les Apps, la Communication et l'Infrastructure
- La release devrait être validée par l'ensemble des 4 (ou 5) groupes d’intérêts
- Communication en français et en anglais
- Annuaire ou contact des groupes pour les nouveaux arrivants. Voir peut-être annuaire tout court pour savoir qui fait quoi. https://yunohost.org/#/contribs_fr à compléter. Et à mettre en avant.
- Proposition de laisser les membres YunoHost s'auto déterminer -> Comment gérer les accès ?


## Notes
Moyens de communication actuel : 

- IRL
- Réunion Mumble
- [Forum](https://forum.yunohost.org)
- Listes de diffusion : [contrib](https://list.yunohost.org/cgi-bin/mailman/listinfo/contrib) et [apps](https://list.yunohost.org/cgi-bin/mailman/listinfo/apps)
- [Bugtracker Redmine](https://dev.yunohost.org)
- [Forge git](http://github.com/yunohost/) pour les review de code
- Salon de discussions XMPP
