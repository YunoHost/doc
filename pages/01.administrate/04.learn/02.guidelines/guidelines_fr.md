# Conseil généraux

Cette page énumère quelques conseils et lignes directrices que tout administrateur de YunoHost devrait connaître pour prendre soin de son serveur :).

## Ne cassez pas YunoHost

En d'autres termes : votre serveur est soit un "serveur de production" (destiné à fonctionner), soit un serveur de test sur lequel vous vous permettez d'expérimenter.

Si votre but est d'avoir un serveur de production, alors s'il vous plaît.. :
- soyez conscient qu'un serveur est un système fragile : restez prudent, méthodique et patient ;
- limitez les expérimentations et la personnalisation - notamment des fichiers de config ;
- n'installez pas des douzaines d'applications juste pour voir de quoi elles ont l'air ;
- utilisez les applications non-officielles avec prudence, et interdisez vous d'utiliser celles 'in progress', 'not working' ou qui on un niveau 0 ;
- si quelque chose casse, réfléchissez à deux fois avant de tenter de le réparer vous-même si vous ne savez pas ce que vous faites. <small>(Par exemple, n'essayez pas de recréer vous-même l'utilisateur admin juste parce qu'il a mystérieusement disparu...)</small>

## Keep it simple !

YunoHost est conçu pour fonctionner avec des cas d'utilisation généraux et simples. S'écarter de ces conditions rendra les choses plus difficiles et vous aurez besoin de connaissances techniques pour les faire fonctionner. Par exemple,
- n'essayez pas d'exécuter YunoHost dans un contexte où vous ne pouvez pas avoir le contrôle des ports 80 et 443 (ou pas d'Internet du tout) ;
- n'essayez pas d'héberger cinq serveurs derrière la même connexion Internet si vous n'êtes pas déjà un utilisateur avancé ;
- ne tombez pas dans des caprices de nerd tels que vouloir remplacer nginx par Apache (ou faire tourner les deux à la fois) ;
- n'essayez pas d'utiliser des certificats SSL personnalisés si vous n'en avez pas vraiment besoin ;
- ...

Gardez les choses aussi simples que possible !

## Ne réinstallez pas tous les jours

Certaines personnes ont tendance à tomber dans la "spirale de la réinstallation" - où chaque fois que quelque chose casse dans le serveur et qu'il n'est pas évident comment le réparer, ou parce que le serveur est devenu "sale", l'administrateur finit par réinstaller le serveur entier à partir de zéro car cela semble une solution "facile" et rapide pour remettre les choses à plat.

Ne faites pas ça. La réinstallation est une opération lourde et n'est pas une bonne stratégie à long terme pour résoudre les problèmes. Vous vous fatiguerez et n'apprendrez rien. Oubliez le rêve d'avoir un serveur "propre" : un serveur de la vraie vie fini toujours par être "sale". De plus, vous devez apprendre (progressivement) à résoudre les problèmes lorsque vous les rencontrez. [Demandez de l'aide](/help) en fournissant des détails sur les symptômes, ce que vous essayez de faire et de ce qu'il se passe, et corrigez les problèmes. Avec le temps, vous aurez un bien meilleur contrôle sur votre serveur plutôt que réinstaller aveuglément à chaque fois.

## Faites des sauvegardes

Si vous hébergez des services et des données qui sont importants pour vos utilisateurs, il est important que vous mettiez en place une politique de sauvegarde. Les sauvegardes peuvent être facilement créées à partir de l'interface d'administration web - bien qu'elles ne puissent actuellement pas être téléchargées à partir de celle-ci (mais elles peuvent être téléchargées par d'autres moyens). Vous devez effectuer régulièrement des sauvegardes et les conserver dans un endroit sûr et physiquement différent de votre serveur. Plus d'infos dans [la documentation des sauvegardes](/backup).

## Lisez les emails envoyés à root

En tant qu'administrateur, vous devriez configurer un client de messagerie pour vérifier les e-mails envoyés à `root@your.domain.tld` (qui doit être un alias pour le premier utilisateur que vous avez ajouté) ou les transférer à une autre adresse que vous vérifiez activement. Ces courriels peuvent contenir des informations sur ce qui se passe sur votre serveur, comme les tâches périodiques automatisées.

## YunoHost est un logiciel gratuit, maintenu par des bénévoles.

Enfin, gardez à l'esprit que YunoHost est un logiciel libre maintenu par des volontaires - et que le but de YunoHost (démocratiser l'auto-hébergement) n'est pas simple ! Le logiciel n'est fourni sans aucune garantie. L'équipe de bénévoles fait de son mieux pour maintenir et fournir la meilleure expérience possible - pourtant les fonctionnalités, les applications et YunoHost dans son ensemble sont loin d'être parfaits et vous ferez face tôt ou tard à de petit ou gros problèmes. Lorsque cela se produit, venez gentiment [demander de l'aide sur le chat ou le forum, ou signaler le problème](/help) :) !

Si vous aimez YunoHost et que vous voulez que le projet soit maintenu en vie et progresse, n'hésitez pas à laisser une note de remerciement et à [faire un don](https://liberapay.com/YunoHost) au projet et à en parler autour de vous !

Pour finir, puisque YunoHost est un projet de logiciel libre, vous êtes légitime et bienvenu pour [venir contribuer](/contribute) au projet, que ce soit sur les aspects techniques (c.-à-d. code) et moins techniques (comme par exemple contribuer à cette documentation ;)) !

