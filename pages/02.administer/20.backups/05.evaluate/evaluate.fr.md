---
title: Stratégies de sauvegarde
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup_strategies'
page-toc:
  active: true
  depth: 3
---

Dans le contexte de l'auto-hébergement, les sauvegardes (backup) sont un élément important pour pallier les événements inattendus (incendies, corruption de base de données, perte d'accès au serveur, serveur compromis...). La politique de sauvegardes à mettre en place dépend de l'importance des services et des données que vous gérez. Par exemple, sauvegarder un serveur de test aura peu d'intérêt, tandis que vous voudrez montrer beaucoup plus de prudence si vous gérez des données critiques pour une association ou une entreprise - et dans ce genre de cas, vous souhaiterez stocker les sauvegardes *dans un ou des endroits différents*.

## Qu'est-ce qu'une bonne sauvegarde ?
Une bonne sauvegarde est constituée d'au moins **3 copies des données** (en comptant les données originales), sur au moins **2 stockages distincts**, dans au moins **2 lieux distincts** (suffisamment éloignés) et idéalement avec 2 méthodes distinctes. Si vos sauvegardes sont chiffrées **ces règles s'appliquent aussi à la phrase/clé de déchiffrement**.

Une bonne sauvegarde est aussi dans de nombreux cas, une sauvegarde récente, il faut donc soit beaucoup de rigueur, soit **automatiser** le processus.

Une bonne sauvegarde est vérifiée régulièrement afin de s'assurer de l'effectivité et de l'intégrité des données.

Enfin, une bonne sauvegarde est une sauvegarde **restaurable dans des délais acceptables** pour vous. Pensez notamment à documenter votre méthode de restauration et à estimer le temps de transfert d'une copie notamment si les connexions internet en jeu ne sont pas symétriques.

!!! Exemple d'**une combinaison** robuste et comfortable:
* une sauvegarde distante et automatique avec borg
* une sauvegarde sur disque externe et automatique avec borg
* un snapshot/image régulier (et avant les mises à jour)
* une grappe RAID 1 monitorée (ou un VPS du commerce qui sera aussi sur une grappe)
* une passphrase de déchiffrement stockée sur 3 supports dans 2 lieux


## Quelques méthodes possibles

* [générer une archive et la télécharger manuellement (méthode par défaut de YunoHost)](/backup#sauvegarde-manuelle)
* [sauvegarder automatiquement (méthode conseillée)](/backup#sauvegarde-automatique-ou-distante)
* [générer une archive directement sur un autre disque](/external_storage)
* [faire une image du disque ou un snapshot](/backup/clone_filesystem)
* [sauvegarder les données utiles via une méthode personnalisée](/backup/custom_backup_methods) 

## Risques
Ci-dessous, une liste de risques triés du plus au moins probable, dont la probabilité reste à adapter selon votre situation (lieu du serveur, qualité des installations, profils d'usagers, etc.). À vous de mettre le curseur là où il faut, notamment en considérant les conséquences d'une perte de données. 

!!! Gardez en tête que les vrais accidents sont liés à la survenue de 2 événements de façon simultanée. 

* **Manque de rigueur**: les stratégies à base de sauvegardes manuelles nécessitent beaucoup de rigueur dans la régularité
* **Mauvaise manipulation**: il peut arriver d'effacer une sauvegarde par erreur lors d'une restauration ou si vous comptez sur un système de synchronisation, vous pourriez supprimer un fichier et que la suppression soit synchronisée de façon instantanée
* **Cryptolocker**: il s'agit de virus qui chiffrent les fichiers et réclament une rançon. Si vos utilisateurs ou utilisatrices utilisent nextcloud et windows, un windows infecté pourrait synchroniser des fichiers chiffrés et ainsi vous perdriez votre copie.
* **Panne matérielle**: les cartes SD sont les supports les moins fiables dans le temps (~2ans de vie dans un serveur), viennent ensuite les disques SSD (environ 3 ans de vie) et les disques durs (3 ans). À noter qu'un équipement neuf a aussi une probabilité non nulle de tomber en panne lors des 6 premiers mois. Dans tous les cas, vos copies ne devraient pas être sur le même support physique.
* **Panne logicielle/bug**: un bug logiciel peut aboutir à la suppression de données ou vous pourriez ne pas savoir réparer un problème et souhaiter restaurer votre système.
* **Panne d'électricité ou d'internet**: avez-vous un plan si ça arrive ? Quid si vous êtes en vacances ?
* **Catastrophe ou événement naturel ou non**: un petit enfant, un chat, la foudre ou une simple fuite peuvent détruire votre matériel. Les incendies ou inondations peuvent aussi mettre à mal votre copie de sauvegarde à l'autre bout de votre logement...
* **Compromission du serveur**: une personne malveillante ou un robot pourrait attaquer votre serveur et supprimer vos données.
* **Vol de machine**: un cambriolage ou le vol d'un ordinateur sur lequel se trouve votre gestionnaire de mots de passe pour déchiffrer vos sauvegardes.
* **Perquisition**: que vous soyez coupable ou non, une perquisition peut aboutir à la saisie entière du matériel informatique d'un lieu (voir de plusieurs lieux).
* **Décès/problème de santé**: vous pourriez ne plus être en mesure de taper votre phrase de passe.

## À propos de la synchronisation Nextcloud ou Thunderbird (IMAP)
Une méthode qui permet une sauvegarde partielle consiste à sauvegarder les fichiers et les emails via des logiciels de synchronisation comme Nextcloud client ou ThunderBird. De cette façon, vous évitez le risque de panne matérielle. 

Si cette méthode est simple à mettre en place, elle n'est pas sans risque du fait de la synchronisation elle-même. Par exemple, si vous êtes sur windows ou mac, vous augmentez de façon non négligeable le risque de perte de données suite au chiffrement des fichiers par un virus de type [cryptolocker](https://fr.wikipedia.org/wiki/Ran%C3%A7ongiciel). Sur tout type de système, une fausse manipulation peut supprimer l'ensemble de vos copies sur le serveur et sur les équipements qui synchronisent. Ce souci est aggravé par le fait que la synchronisation de suppression est en général plutôt instantanée.

Si le risque de fausse manipulation peut être atténué via des logiciels de sauvegarde pour PC de bureau comme TimeShift, seule une sauvegarde sur un disque dur externe déconnecté vous protège vraiment des rançongiciels.


