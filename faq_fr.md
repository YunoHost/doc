# Foire aux questions

#### Sous quelle licence est distribué YunoHost ?

Les paquets qui composent YunoHost sont sous licence libre GNU AGPL v.3.

YunoHost est basé sur Debian, donc sur les licences des éléments sur lesquels Debian est basé.

Les applications et leurs paquets ont leurs licences respectives.


#### Quel est l’objectif de YunoHost ?

Nous pensons que la décentralisation d’Internet, et la reprise du contrôle et
de la responsabilité des données et services par les citoyens est un enjeu
crucial pour garantir une société libre et démocratique.

Le projet YunoHost cherche à démocratiser l’auto-hébergement.

Nous fournissons un logiciel qui cherche à rendre simple le fait de gérer et
d’administrer un serveur soi-même, en minimisant les compétences et le temps
requis.


#### Mais qu’est-ce que ça fait *vraiment* ?

YunoHost peut être appelé une distribution ou un système d’exploitation, mais
dans les faits, c’est une « simple » sur-couche à Debian, qui gère les
manipulations pénibles à votre place.

Par exemple, pour installer un Wordpress à la main, il vous faudrait taper
toute une série de commande pour créer des utilisateurs, mettre en place un
serveur web, mettre en place un serveur SQL, télécharger l’archive de Wordpress,
la décompresser, configurer le serveur web, configurer la base de données SQL, et finalement configurer Wordpress. YunoHost gère toute cette partie technique et « tape les commandes à votre place », pour que vous puissiez vous concentrer sur ce qui compte vraiment.

Plus d’informations sur [cette page](whatsyunohost) !


#### Puis-je gérer mon propre site web avec YunoHost ?

Oui ! Il faut regarder du côté de [cette app](https://github.com/YunoHost-Apps/my_webapp_ynh).
Elle fournit une « coquille vide » : après l’installation, il suffit d’envoyer vos fichiers (via SSH/SCP ou SFTP) au bon endroit. Il est aussi possible 
d’avoir du PHP et une base de donnée SQL si besoin.


#### Peut-on héberger plusieurs sites indépendants avec des noms de domaines différents ?

On peut tout à fait héberger plusieurs sites web car YunoHost est multi-domaine et que certaines applications de gestion de sites web, comme *WordPress* ou *Web App Multi Custom*, sont multi-instances, c’est-à-dire que l’application peut-être installée plusieurs fois.

#### Pourquoi je ne peux pas accéder à mes applications avec l’adresse IP ?

Pour des raisons techniques, le [SSO](https://github.com/YunoHost/SSOwat/) ne permet pas aux utilisateurs de se connecter à l’espace utilisateur lorsque l’on accède au serveur uniquement avec l’IP. Si vous ne pouvez réellement pas configurer un nom de domaine, une solution temporaire peut être de modifier le [fichier `hosts` (dernier §)](dns_local_network_fr) de son ordinateur.


#### Quel est le modèle économique de YunoHost ?

À l’heure actuelle, YunoHost est maintenu uniquement par une équipe de bénévole
travaillant pendant leur temps libre. Il n’y a pas d’argent impliqué dans le
projet (hormis quelques frais de serveurs et stickers :P), ce qui signifie
également que nous sommes indépendants de toute préoccupations économiques.

Pour le moment, l’équipe est assez peu enthousiaste à l’idée d’inclure de
l’argent dans le projet. Cependant, certains contributeurs mènent des activités professionelles liées à YunoHost.


#### Puis-je faire un don au projet ?

Pour le moment, nous n’avons pas mis en place de moyen pour recevoir des dons.
Cependant, nous bénéficions de contributions en nature apportées par des associations,
comme des serveurs.


#### Comment puis-je contribuer au projet ?

Il y existe [plusieurs façons de contribuer](contribute) :).

N’hésitez pas à venir nous parler de vos idées!

Une idée répandue parmi les nouveaux contributeurs aux logiciels libres est
de ne pas être « assez compétent ». En pratique, croyez-le, personne n’est
compétent :). Ce qui compte vraiment est : [d’aimer ce que vous faites](https://www.youtube.com/watch?v=zIbR5TAz2xQ&t=113s),
être sympathique avec les autres êtres humains du projet, être patient et têtu
avec les machines, et avoir du temps libre. À part ça, juste faire ce que vous
pouvez, c’est déjà trop cool !


#### Quel est le modèle politique de YunoHost ?

Il est décrit dans [ce document](https://github.com/YunoHost/project-organization/blob/master/yunohost_project_organization.md) :).



#### Pouvez-vous porter YunoHost sur [ma distro préféré] ?

Réponse courte : non. L’équipe n’a pas l’énergie et ce n’est pas pertinent pour le but recherché par YunoHost.

<a data-toggle="collapse" data-target="#willyouportyunohost" href="#">Réponse longue</a>
<div id="willyouportyunohost" class="collapse">
<p>Si vous vous préoccupez des guéguerres de distro, ou pensez que « Debian c’est sale », vous n’êtes pas le public de YunoHost.</p>

<p>YunoHost vise un public de non-technophile ou de bidouilleurs qui veulent simplement que le serveur fonctionne sans devoir investir des semaines entières. Debian a probablement des défauts, mais c’est une (la ?) distribution la plus connue et utilisée pour gérer des serveurs. C’est une distribution stable. La plupart des services auto-hébergeables sont compatibles d’une manière ou d’une autre avec Debian. Elle est facilement bidouillable par quelqu’un qui a déjà utilisé la ligne de commande sur son ordinateur personnel. Il n’y a pas de « killer feature » particulière dans les autres distributions qui rendrait pertinent de porter YunoHost dessus.</p>

<p>Si cela ne vous convient pas, il existe d’autres projets sous d’autres distributions ou avec d’autres philosophies.</p>
</div>

#### J’ai regardé comment le packaging des apps fonctionne. Pourquoi réinventez-vous [mon format de paquet préféré] ?

Réponse courte : ce n’est pas ce que nous faisons.

Réponse moyenne : Par le passé, les apps étaient gérées via des .deb. C’était cauchemardesque. Nous sommes heureux maintenant ;).

<a data-toggle="collapse" data-target="#whyareyoureinventingpackaging" href="#">Long answer</a>
<div id="whyareyoureinventingpackaging" class="collapse">

<p>YunoHost cherche à garder un système de packaging simple. L’idée depuis le départ était que « si tu sais installer l’app à la main, alors tu peux facilement créer un package basique en copiant-collant les étapes, sans besoin de connaissances particulière ». Ce n’est pas le cas des paquets Debian.</p>

<p>Il se trouve que l’objectif des paquets d’application YunoHost est subtilement différent des paquets traditionnels (comme les .deb de Debian) qui remplissent le rôle d’installer des éléments bas-niveaux tels que des fichiers, commandes, programmes ou services sur le système. Il est à la charge de l’administrateur de les configurer ensuite proprement, simplement parce qu’il n’existe pas d’environnement standard. Typiquement, les applications web requièrent beaucoup de configuration car elles ont besoin de s’interfacer avec un serveur web et une base de données (et le système de connexion unique / SSO).</p>

<p>YunoHost manipule des abstractions haut-niveau (apps, domaines, utilisateurs…) et défini un environnement standard (Nginx, Postfix, Metronome, SSOwat…) et, grâce à cela, peut gérer la configuration à la place de l’administrateur.</p>

<p>Si vous restez persuadé que l’on peut néanmoins bricoler les paquets .deb pour gérer tout cela, voir les réponses précédentes.</p>
</div>
