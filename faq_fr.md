# Foire aux questions

#### Sous quelle licence est distribué YunoHost ?

Les paquets qui composent YunoHost sont sous licence libre GNU AGPL v.3.

YunoHost est basé sur Debian, donc sur les licences des éléments sur lesquels Debian est basé.

Les applications et les packages d’applications ont leurs licences respectives.

#### Peut-on héberger plusieurs sites indépendants avec des noms de domaines différents ?

On peut tout à fait héberger plusieurs sites web car YunoHost est multi-domaine et que certaines applications de gestion de sites web, comme *WordPress* ou *Web App Multi Custom*, sont multi-instances, c’est-à-dire que l’application peut-être installée plusieurs fois.

#### Pourquoi je ne peux pas accéder à mes applications avec l’adresse IP ?

Pour des raisons techniques, le [SSO](https://github.com/Kloadut/SSOwat/) ne permet pas aux utilisateurs de se logger à l'espace utilisateur lorsque l'on accède au serveur uniquement avec l'IP. Si vous ne pouvez réellement pas configurer un nom de domaine, une solution temporaire peut être de modifier le [fichier `hosts` (dernier §)](dns_local_network_fr) de son ordinateur.

#### Pouvez-vous porter YunoHost sur [ma distro préféré] ?

Réponse courte : Non. L'équipe n'a pas l'énergie et ce n'est pas pertinent pour le but recherché par YunoHost.

<a data-toggle="collapse" data-target="#willyouportyunohost" href="#">Réponse longue</a>
<div id="willyouportyunohost" class="collapse">
<p>Si vous vous préoccupez des guéguérres de distro, ou pensez que 'Debian c'est sale', vous n'êtes pas le public de YunoHost.</p>

<p>YunoHost vise un public de non-technophile ou de bidouilleurs qui veulent simplement que le serveur fonctionne sans devoir investir des semaines entières. Debian a propbablement des défauts, mais c'est une (la?) distribution la plus connue et utilisée pour gérer des serveurs. C'est une distribution stable. La plupart des services auto-hébergeables sont compatibles d'une manière ou d'une autre avec Debian. Elle est facilement bidouillable par quelqu'un qui a déjà utilisé la ligne de commande sur son ordinateur personnel. Il n'y a pas de "killer feature" particulière dans les autres distributions qui rendrait pertinent de porter YunoHost dessus.</p>

<p>Si cela ne vous conviens pas, il existe d'autres projets sous d'autres distributions ou avec d'autres philosophies.</p>
</div>

#### J'ai regardé comment le packaging des apps fonctionne. Pourquoi réinventez-vous [mon format de package préféré] ?

Réponse courte: Ce n'est pas ce que nous faisons.

Réponse moyenne: Par le passé, les apps étaient gérées via des .deb. C'était cauchemardesque. On est heureux maintenant ;).

<a data-toggle="collapse" data-target="#whyareyoureinventingpackaging" href="#">Long answer</a>
<div id="whyareyoureinventingpackaging" class="collapse">

<p>YunoHost cherche a garder un système de packaging simple. L'idée depuis le départ était que « si tu sais installer l'app à la main, alors tu peux facilement créer un package basique en copiant-collant les étapes, sans besoin de connaissances particulière ». Ce n'est pas le cas des paquets Debian.</p>

<p>Il se trouve que l'objectif des paquets d'application YunoHost est subtilement différent des paquets traditionnels (comme les .deb de Debian) qui remplissent le rôle d'installer des éléménts bas-niveaux tels que des fichiers, commandes, programmes ou services sur le système. Il est à la charge de l'administrateur de les configurer ensuite proprement, simplement parce qu'il n'existe pas d'environnement standard. Typiquement, les applications web requiert beaucoup de configuration car elles ont besoin de s'interfacer avec un serveur web et une base de données (et le système de connexion unique / SSO).</p>

<p>YunoHost manipule des abstractions haut-niveau (apps, domaines, utilisateurs, ...) et défini un environnement standard (Nginx, Postfix, Metronome, SSOwat, ...) et, grâce à cela, peut gérer la configuration à la place de l'administrateur.</p>

<p>Si vous restez persuadé que l'on peut néanmoins bricoler les paquets .deb pour gérer tout cela, voir les réponses précédentes.</p>
</div>
