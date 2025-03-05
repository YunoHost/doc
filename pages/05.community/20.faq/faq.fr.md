---
title: Foire aux questions
template: docs
taxonomy:
    category: docs
routes:
  default: '/faq'
---

#### Sous quelle licence est distribué YunoHost ?

Les paquets qui composent YunoHost sont sous licence libre GNU AGPL v.3.

YunoHost est basé sur Debian, donc sur les licences des éléments sur lesquels Debian est basé.

Les applications et leurs paquets ont leurs licences respectives.

#### Quel est l’objectif de YunoHost ?

Nous pensons que la décentralisation d’Internet, et la reprise du contrôle et de la responsabilité des données et services par les personnes est un enjeu crucial pour garantir une société libre et démocratique.

Le projet YunoHost cherche à démocratiser l’auto-hébergement.

Nous fournissons un logiciel qui cherche à rendre simple le fait de gérer et d’administrer un serveur soi-même, en minimisant les compétences et le temps requis.

#### Mais qu’est-ce que ça fait *vraiment* ?

YunoHost est à la fois une distribution, dans le sens où c'est une version de GNU/Linux-Debian dédié à un objectif précis et que YunoHost distribue un ensemble d'applications via son catalogue, mais c'est aussi un « simple » programme qui configure Debian de manière automatique, et gère les manipulations pénibles à votre place.

Par exemple, pour installer un WordPress à la main, il vous faudrait taper toute une série de commandes pour créer des utilisateurs, mettre en place un serveur web, mettre en place un serveur SQL, télécharger l’archive de WordPress, la décompresser, configurer le serveur web, configurer la base de données SQL, et finalement configurer WordPress. YunoHost gère toute cette partie technique et « tape les commandes à votre place », pour que vous puissiez vous concentrer sur ce qui compte vraiment.

Plus d’informations sur [cette page](/whatsyunohost) !

#### Puis-je gérer mon propre site web avec YunoHost ?

Oui ! Il faut regarder du côté de [cette app](https://github.com/YunoHost-Apps/my_webapp_ynh).
Elle fournit une « coquille vide » : après l’installation, il suffit d’envoyer vos fichiers (via SSH/SCP ou SFTP) au bon endroit. Il est aussi possible d’avoir du PHP et une base de donnée SQL si besoin.

#### Peut-on héberger plusieurs sites indépendants avec des noms de domaines différents ?

On peut tout à fait héberger plusieurs sites web car YunoHost est multi-domaine et que certaines applications de gestion de sites web, comme *WordPress* ou *My Webapp*, sont multi-instances, c’est-à-dire que l’application peut-être installée plusieurs fois.

#### Pourquoi je ne peux pas accéder à mes applications avec l’adresse IP ?

Pour des raisons techniques, le [SSO](https://github.com/YunoHost/SSOwat/) ne permet pas aux utilisateurs de se connecter à l’espace utilisateur lorsque l’on accède au serveur uniquement avec l’IP. Si vous ne pouvez réellement pas configurer un nom de domaine, une solution temporaire peut être de modifier le [fichier `hosts` (dernier §)](/dns_local_network) de son ordinateur.

#### Quel est le modèle économique de YunoHost ?

YunoHost est maintenu par une équipe de bénévoles travaillant pendant leur temps libre. Le projet reçoit régulièrement des dons qui financent principalement des frais de serveurs et de communication (stickers ;P). Le projet a reçu dans le passé (ou continue de recevoir) des subventions de la part d'organismes comme [NLnet](https://nlnet.nl/) ou [CodeLutin](https://www.codelutin.com/) pour financer des développements précis.

Les dons au projet étant de plus en plus important, des initiatives sont en cours pour tenter de redistribuer l'argent aux contributeur·ice·s principales et ainsi aider à pérenniser le projet. Des contributeur·ice·s mènent par ailleurs des activités professionnelles basées partiellement sur YunoHost.

#### Puis-je faire un don au projet ?

Oui, c'est possible ! YunoHost a besoin de payer des serveurs et noms de domaine, et nous souhaitons permettre aux contributeur·ice·s de continuer à développer YunoHost plutôt que de chercher un emploi ailleurs.

Pour faire un don ça se passe via [notre interface de don](https://donate.yunohost.org)

Si vous le pouvez, vous pouvez aussi faire des contributions en nature (une partie de notre infrastructure vient d'associations qui nous fournissent des serveurs).

#### Comment puis-je contribuer au projet ?

Il existe [plusieurs façons de contribuer](/contribute) :).

N’hésitez pas à venir nous parler de vos idées !

Le syndrome de l'imposteur (ne pas se sentir « assez compétent·e ») est assez répandu, mais en pratique, croyez-le, personne ne se sent compétent même 10 ans après sa première contrib' :). Ce qui compte vraiment est : [d’aimer ce que vous faites](https://www.youtube.com/watch?v=zIbR5TAz2xQ&t=113s), être sympathique avec les autres êtres humains du projet, être patient et têtu avec les machines, et avoir du temps libre. À part ça, juste faire ce que vous pouvez, c’est déjà trop cool !

#### Quelle est l'organisation politique du projet YunoHost ?

Elle est décrite dans [ce document](/project_organization) :).

#### Pouvez-vous porter YunoHost sur [ma distro préférée] ?

Si vous vous préoccupez des guéguerres de distro, ou pensez que « Debian c’est sale », vous n’êtes pas le public de YunoHost.

YunoHost vise un public de non-technophiles ou de bidouilleur·euse·s qui veulent simplement que « ça marche » sans devoir investir des semaines entières. Debian a probablement des défauts, mais c’est une (la ?) distribution la plus connue et utilisée pour gérer des serveurs. C’est une distribution stable. La plupart des services auto-hébergeables sont compatibles d’une manière ou d’une autre avec Debian. Elle est facilement bidouillable par quelqu’un qui a déjà utilisé la ligne de commande sur son ordinateur personnel. Il n’y a pas de « killer feature » particulière dans les autres distributions qui rendrait pertinent de porter YunoHost dessus.

Si cela ne vous convient pas, il existe d’autres projets sous d’autres distributions ou avec d’autres philosophies.

#### J’ai regardé comment le packaging des apps fonctionne. Pourquoi réinventez-vous [mon format de paquet préféré] ?

Des personnes ont été tentées de comparer le système de packaging de YunoHost aux `.deb` de Debian. Pourtant, l’objectif des paquets d’application YunoHost est de celui des paquets traditionnels (comme les .deb de Debian) qui remplissent le rôle d’installer des éléments bas-niveau tels que des fichiers, commandes, programmes ou services sur le système. Il est à la charge de l’administrateur de les configurer ensuite proprement, simplement parce qu’il n’existe pas d’environnement standard. Typiquement, les applications web requièrent beaucoup de configuration car elles ont besoin de s’interfacer avec un serveur web et une base de données (et le système de connexion unique / SSO).

YunoHost manipule des abstractions haut-niveau (apps, domaines, utilisateurs…) et définit un environnement standard (NGINX, Postfix, Metronome, SSOwat...) et, grâce à cela, peut gérer la configuration à la place de l’administrateur.

#### Quand est-ce que [cette fonctionnalité] sera ajoutée ? Pourquoi [cette app] n'a pas encore été packagée ? Je n'en reviens pas que vous ne fassiez pas encore [cela] !

Nous ne donnons pas de calendrier.

Nous sommes une poignée de volontaires travaillant sur notre temps libre pour maintenir et développer YunoHost. Nous n'avons pas de responsable produit ou de chef de projet, nous ne sommes pas une entreprise. Nous faisons ce que nous pouvons, parce que nous aimons ce logiciel, quand nous le pouvons.

Si vous souhaitez vraiment voir une fonctionnalité codée ou documentée, ou une application packagée, [envisagez de contributer](/contribute)! Nous adorerions vous aider à vous mettre en selle.

#### Quelle est la politique d'inclusion des apps dans le catalogue officiel ?

Voir [cette page](/packaging_policy)

#### Why won't you include [feature X] ?

YunoHost is primarily designed for not-so-tech-savvy users and aims to remain relatively simple in terms of UI/UX. At the same time, the project has limited time and energy available to be maintained and developed. Therefore we may lower the priority of features, or refuse entirely the inclusion of features, based on the criteria that they:

- would only be meaningful for advanced / power-users stuff which is out of the scope of the project ;
- would introduce too much UI/UX bloat ;
- would only cover unrealistic threat models ;
- would be there only to satisfy purists ;
- or overall would not be worth it in terms of development/maintenance time/energy for what it brings to the project.

#### Pourquoi n'incluez-vous pas [fonctionnalité X] ?

YunoHost est principalement conçu pour un public peu technicien et vise à rester relativement simple en termes d'UI/UX. En même temps, le projet dispose d'un temps et d'une énergie limités pour sa maintenance et son développement. C'est pourquoi nous pouvons réduire la priorité de certaines fonctionnalités, ou refuser complètement de les inclure, au titre des critères suivants :

- ne seraient utiles qu'à des personnes expérimentées/avancées et vont au dela du périmètre visé par le projet ;
- introduiraient trop de bloat dans l'UI/UX ;
- ne couvriraient que des modèles de menace irréalistes ;
- ne seraient là que pour satisfaire les puristes ;
- ou globalement ne vaudrait pas la peine en termes de temps de développement/maintenance/énergie pour ce qu'elles apportent au projet.
