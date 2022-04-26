---
title: Organisation du projet
template: docs
taxonomy:
    category: docs
routes:
  default: '/yunohost_project_organization'
  aliases:
    - '/project_organization'
---

! This page is outdated and should be reworked

# Objectif du document

Ce document a pour objectif de décrire la structure et le fonctionnement du collectif qui assure le développement et la maintenance du projet YunoHost.

En particulier, en accord avec les valeurs portées par le projet, il est important de :
- maintenir une transparence sur le fonctionnement du collectif et les valeurs du projet
- d'expliciter le caractère ouvert du projet, pour que les personnes extérieures se sentent légitimes à contribuer au projet, en rejoignant ou non le collectif
- permettre aux membres du collectif de se sentir légitimes à discuter, contribuer et acter des décisions
- assurer la pérennité du projet en partageant les connaissances et responsabilités, et en limitant le "*bus factor*"
- limiter les asymétries de pouvoir
- avoir un mécanisme de prise de décision formel, par exemple pour résoudre un conflit, ou pour faire évoluer le collectif ou le projet.


# Intention du projet YunoHost

Dans un contexte où l'évolution des outils technologiques posent des enjeux sociétaux majeurs, YunoHost défend un Internet décentralisé et où les personnes restent au contrôle de leurs données et de leurs outils numériques. L'une des pierres angulaires de la construction d'un tel Internet est de drastiquement simplifier, rendre accessible et démocratiser la gestion des serveurs, là où cette pratique est traditionellement réservée à une élite technicienne.

Ainsi, l'objectif du projet YunoHost est de construire un système d'exploitation et l'ensemble des outils nécessaires pour installer et gérer, en autonomie et sans trop de compétences techniques, un serveur et des services numériques dans un contexte privé (famille, groupe d'ami, ...) ou collectif (association, entreprise, école, ...).

Le collectif YunoHost est proche d'autres collectifs aux objectifs connexes tels que la FFDN, Framasoft, CHATONS, ou La Quadrature du Net. Le collectif est également sensible aux enjeux d'écologie et d'inclusivité.

## Esprit et valeurs du projet

0. **Commun numérique** : Tous les éléments logiciels conçus par le projet YunoHost sont sous licence libre et le resteront. YunoHost est développé et maintenu essentiellement par le bénévolat d'une communauté ouverte, horizontale, et qui fait de son mieux en fonction du temps, des moyens et de l'énergie dont elle dispose.

1. **Accessible** : La conception de YunoHost s'articule en priorité autour des personnes ayant peu de connaissances techniques, avec des procédures, des interfaces et des documentations simples et pédagogiques.

2. **Sécurité** : YunoHost doit fournir un système raisonnablement maintenu à jour et raisonnablement sécurisé par défaut, et à guider les utilisateurices sur comment renforcer la sécurité de leur système. 

3. **Bidouillabilité** : YunoHost doit permettre aux utilisateurices de s'approprier et modifier leur installation pour l'adapter à des besoins ou cas d'usages spécifiques ou qui ne sont pas encore bien gérés, ou pour personnaliser l'apparence.

# Organisation de YunoHost

YunoHost est développé et maintenu par une communauté bénévole, ouverte, horizontale.

Cette communauté est composée de : 

- les utilisateurices du projet
- les contributeurices occasionels
- les contributeurices réguliers

La communauté organise à intervalle régulier des réunions de coordination en ligne, qui sont publiquement annoncées et à laquelle n'importe quelle personne peut se joindre. <small>(Plus précisément, à l'heure de l'écriture de ce document, ces réunions ont lieu les 1er et 3ème mardi de chaque mois sur Mumble, et sont annoncées sur le forum.)</small> Le compte rendu de ces réunions est également rendu public.

## Les utilisateurices

Il s'agit des personnes qui utilisent YunoHost dans leur vie quotidienne, demandent de l'aide, rapportent des bugs et font des retours d'expérience.

La communauté est consciente de l'importance de demander et de prendre en compte les retours d'expérience et les cas d'utilisation des utilisateurices dans l'évolution du projet.

## Les contributeurices occasionels (OC)

Il s'agit des personnes qui contribuent ponctuellement au projet. Toute personne le souhaitant est, sans accord prélable, bienvenue et légitime à contribuer au projet (sous couvert de ne pas aller à l'encontre des valeurs portées par le projet).

La communauté met à disposition autant que possible de la documentation et des outils pour guider les nouvelles contributeurices dans leurs premières contributions dans un esprit de bienveillance.

Les contributions se concrétisent souvent la forme de *Pull Request* (PR) (par exemple, sur le *core*, sur les apps, sur la doc, ...) mais peuvent aussi constituer des traductions, des éléments graphiques, des audits de sécurité, etc...

Sauf exception, les contributeurices occasionels peuvent aider aux revues, mais n'actent pas elleux-même l'intégration de leurs travaux dans le projet. Iels n'ont également pas non plus de droit de vote lors des prises de décisions formelles. Iels sont cependant les bienvenues pour exprimer leur avis si iels le souhaitent.

## Les contributeurices réguliers (RC)

Il s'agit des personnes qui contribuent régulièrement au projet sous la forme de travaux, assurent la revue et actent l'intégration des travaux d'autres contributeurices, ainsi que la maintenance à court et long terme du projet dans son ensemble.

Les contributeurices réguliers sont organisés en groupes de travail : 

- **Groupe Core**: travaille sur la partie "système central" du projet (principalement les dépôts YunoHost, YunoHost-Admin, Moulinette, SSOwat), ainsi que des outils de distribution (paquets .deb, images préinstallées), de développement (ynh-dev).
- **Groupe Apps**: se concentre sur le packaging de nouvelles applications et assurent collectivement la maintenance de l'écosystème d'applications existants, ainsi que l'indexation dans le catalogue, la définition des bonnes pratiques de packaging, et des outils et métriques de contrôle qualité.
- **Groupe Infra**: déploie, administre, maintient et sauvegarde les différents services dont a besoin le projet (documentation, forum, chatrooms, demo, paste, stack mail, CI, diagnostique, dynette, dashboard, ...)
- **Groupe support / doc / comm**: anime l'entraide sur le forum et les salons de support, assure la maintenance et mise à jour de la doc, communique sur les évolutions du projet sur le forum, les réseaux sociaux, ou en conférence.

Les connexions étant multiples entre ces différentes thématiques, il n'est pas rare qu'une personne soit membre de plusieurs de ces groupes. Néanmoins il est nécessaire et suffisant d'être membre d'un de ces groupe pour obtenir la qualité de contributeurice régulier.

N'importe quelle personne ayant déjà contribué au moins une fois au projet peut demander le statut de contributeurices régulier. Cette demande est ensuite sujette à un vote d'acceptation par l'ensemble des autres contributeurices réguliers.

Le fait d'être membre d'un groupe ouvre le droit à certains droits d'administration détaillés dans l'annexe A, typiquement le droit de valider et d'intégrer ses propres travaux ou les travaux d'autres contributeurices. Il convient de faire un bon usage de ces droits tels que décrit dans la section suivante. Être contributeurices réguliers permet également de proposer un vote lorsqu'il est nécessaire d'acter formellement une décision pour le projet.

Il est attendu des contributeurices réguliers de se coordonner régulièrement avec le reste de l'équipe, par exemple en participant aux réunions ou bien via le chat et le forum.

La perte de la qualité de membre d'un groupe s'opère par départ volontaire de la personne, ou suite à un vote de radiation pour inactivité, non-respect des chartes ou des valeurs du projet, ou abus des droits d'administration.


# Validation et d'intégration des PR

De par la nature du projet, les contributions se concrétisent principalement sous la forme de "demandes d'intégration" (en anglais *Pull Request* (PR) ou *Merge Request* (MR)). La réalisation, la revue, et la validation collective des PR sont des enjeux importants, puisqu'ils s'agit précisément de ce qui rend le projet vivant d'un point de vue purement technique.

Derrière chaque demande d'intégration peut se cacher des problématiques humaines et techniques variées parmis lesquelles la stabilité (ne pas tout casser à cause d'une ramification imprévue), la sécurité (ne pas introduire de faille ou de code malveillant), la pérennité (limiter le *bus factor* et la dette technique), le pragmatisme ("good enough"), l'accord avec l'esprit du projet (UX, ..), l'évolution sur le court et long terme. Le processus de revue et de validation d'une PR est lui en aussi un exercice compliqué dans la mesure où il est couteux en temps, et peut être source de tension ou de frustration. L'un des freins à la validation d'une PR est aussi souvent lié à un sentiment de manque de légitimité à acter l'intégration d'une PR, ou à l'impact psychologique d'être la personne qui a acté l'intégration d'une PR.

Un enjeu crucial de l'organisation du projet est donc de trouver un ensemble de règles et de bonne pratiques qui permettent un fonctionnement fluide, équilibré, avec une validation autant que possible par consensus, et qui répartisse la responsabilité sur le collectif plutôt que les individus.

## Bonnes pratiques et recommendations

- Lorsque un travail a des implications importantes (ou, pour les contributeurs occasionels), il est fortement encouragé de discuter en amont avec le reste de l'équipe pour s'assurer que l'implémentation imaginée convienne avec l'esprit du projet et avec les autres travaux de l'équipe.
- Décrire correctement sa PR et le problème auquel elle répond (et le cas échéant, les détails techniques nécessaires pour tester)
- Veiller à corriger les problèmes remontés par les outils de tests automatique (CI)

## Processus de validation

Cette section détaille le processus de validation des PR dans les différents dépôts du projet. L'objectif de ce processus est d'obtenir un « consensus mou ».

Les contributeurices ont la responsabilité individuelle et collective de jauger de l'importance d'une PR pour définir à quel point elle doit faire l'objet d'une validation légère ou approfondie par d'autres membres du groupe.

- Les PR "micro": il s'agit d'une correction typographique, d'un correctif pour un bug évident... Ces PR peuvent être intégrées par son auteur sans validation explicite par un autre membre du groupe.
- Les PR "moyennes": il s'agit d'opération de maintenance (par ex. mise à jour d'une application, nettoyage/refactoring mineur, ajout d'une petite fonctionnalité, ...). Il est généralement mieux d'obtenir une validation d'un autre membre du groupe.
- Les PR "gros chantier" : il s'agit de nouvelles fonctionnalités ou de refactorings importants, ayant des conséquences majeures pour le futur du projet ou de l'app. Il est alors fortement conseillé d'obtenir une validation approfondie par au moins un autre membre du groupe, et un accord de principe des autres membres.

Les autres contributeurices peuvent librement prendre part à la revue d'une PR. L'auteur d'une PR peut également solliciter ou rappeler aux autres contributeurices que sa PR est en attente d'une revue. Au bout d'un certain délai, s'il s'avère qu'aucune contributeurice n'a de temps ou d'énergie disponible pour participer à la revue d'une PR, alors elle peut tout de même être mergée par son auteur.

Si un désaccord émerge pendant ou après la validation d'une PR, une discussion cordiale doit être privilégiée avec le reste de l'équipe dans le but de dégager un consensus sur la marche à suivre. Si aucun consensus n'est trouvé, un vote est organisé pour prendre une décision, auquel peuvent prendre part toutes les contributeurices régulier du projet.

# Prises de décision collective

Lorsque les contributeurices régulier ont besoin de prendre une décision formelle relative au projet ("résolution"), ou pour résoudre un conflit après qu'une recherche de consensus ait échoué, n'importe quel contributeurices régulier peut déclencher un processus de vote formel. Toutes les contributeurices régulier peuvent prendre part à ce vote.

# Annexe A. Droits d’administration afférents aux groupes

Cette partie liste les droits d’administration pour les différents groupes du projet YunoHost.

N.B. il ne s’agit pas des droits de prises de décisions, mais des droits d'accès et de modification sur les différentes plateformes utilisées par le projet.

Les membres de ces groupes s'engagent à respecter [la charte d'administration système du projet](adminsys_charter.md).


### Core

- GitHub : membre de l’[équipe `Devs` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/devs)
    - permission de créer des branches, merger des PR (en respectant les règles énoncées plus haut)
- Intégration continue : droits d'accès au Gitlab pour interagir avec la CI core ?
- Forum : membre du [groupe `Dev`](https://forum.yunohost.org/groups/Dev).
- Chatrooms: admin sur la chatroom Dev

### Apps

- GitHub : propriétaire (Owner) [de l’organisation YunoHost-Apps](https://github.com/orgs/YunoHost-Apps/people?utf8=%E2%9C%93&query=%20role%3Aowner)
    - permission de créer des branches et de merger des PR sur tous les dépôts d'app (en respectant les règles énoncées plus haut)
- Github : membre de l’[équipe `Apps` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/apps)
    - permission de créer des branches et de merger des PR sur le dépôt du catalog (apps), example_ynh, package_linter, package_check, ... (en respectant les règles énoncées plus haut)
- Forum : membre du [groupe `Apps`](https://forum.yunohost.org/groups/Apps).
- Chatrooms: admin sur la chatroom Apps

### Infra

- Serveurs : accès SSH par clé sur certains (selon les besoins) ou sur la totalité des serveurs,
- GitHub : membre de l’[équipe `Infra` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/infra),
- Forum, Weblate, XMPP, CI: administrateur,
- Forum : membre du [groupe `Infra`](https://forum.yunohost.org/groups/Infra).
- Chatrooms: admin sur la chatroom Dev et Infra

### Support, Doc, Communication, Traduction

- GitHub : membre de l’[équipe `Doc` de l’organisation `YunoHost`](https://github.com/orgs/YunoHost/teams/doc).
   - permission de créer des branches et de merger des PR sur le dépôt "doc" (en respectant les règles énoncées plus haut)
- Forum : statut de modérateur, membre du [groupe `Support & Doc`](https://forum.yunohost.org/groups/Support_Doc), possibilité d'avoir le badge du groupe visible à côté de l'avatar.
- Diaspora* : accès au compte [YunoHost](https://framasphere.org/people/01868d20330c013459cf2a0000053625),
- Twitter : accès au compte [YunoHost](https://twitter.com/yunohost),
- Weblate : administrateur sur l’[outil de traduction](https://translate.yunohost.org/projects/yunohost/).
- Chatrooms: admin sur la chatroom Doc

# Annexe B. Composition des différents groupes

Dernière mise à jour le 2022-03-15

- **Core** : Aleks, Bram, Kayou, ljf, Tagadda, axolotle, tituspijean
- **Apps** : Ericg, Josue, Kayou, tituspijean, yalh76, frju365, Tagadda
- **Infra** : Aleks, Bram, Kayou, ljf, yalh76, tituspijean
- **Support/doc/comm/trad/bureaucracy** : Aleks, Ericg, ljf, tituspijean, Tagadda, JimboJoe, wbk

# Annexe C. Résolutions

- Sur le fait que la vente commerciale de services liés à YunoHost, tels que la distribution, le support, ou l'infogérance, est autorisée.
- Sur les bonnes pratiques de packaging d'app, en particulier de respecter la pratique commune définie dans example_ynh plutôt que de factoriser
- Dates des réunions
- Sur les critères d'intégration des apps dans le catalogue
