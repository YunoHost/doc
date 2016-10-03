## DNS et sous-domaines pour les applications

### Sous-domaines

YunoHost permet l’usage de sous-domaine. Il faut avoir un nom de domaine par exemple mon `domaine.fr` et créer au niveau de la configuration DNS (chez Gandi par exemple) des sous domaines.

### Configuration chez Gandi

Dans la configuration de son DNS, on aura donc une entrée A avec l’adresse IPv4, une entrée AAAA avec l’adresse IPv6 et ensuite différents CNAME pour le sous-domaines que l’on souhaite créer.
Nom Type Valeur
```bash
@         A         XYZ.XYZ.XYZ.XYZ
@         AAAA        1234:1234:1234:FFAA:FFAA:FFAA:FFAA:AAFF
*         CNAME         mondomaine.fr.
agenda         CNAME         mondomaine.fr.
blog         CNAME         mondomaine.fr.
rss         CNAME         mondomaine.fr.
```
permet d’avoir un `agenda.mondomaine.fr`, un `blog.mondomaine.fr` etc…

### Installer une application sur un sous-domaine

Pour installer une application sur un sous-domaine, par exemple `blog.mondomaine.fr`, dans YunoHost, tout ce fait via la partie administration. On ajoute tout d’abord le sous-domaine à la liste des domaines disponibles. La création d’un sous-domaine dans YunoHost créera les fichiers de configuration correspondant pour Nginx (le serveur web de YunoHost).

Puis dans la partie installation d’une application, on installe l’application de façon traditionnelle en en choisissant ce sous-domaine comme domaine (par exemple `blog.mondomaine.fr`) et en indiquant comme chemin `/` (et non `/wordpress` qui est le chemin par défaut). On a alors un message d’avertissement indiquant qu’on ne pourra plus installer d’applications sur ce sous-domaine. On valide. Ça s’installe.

L’application est alors accessible via `blog.mondomaine.fr` (et non via `mondomaine.fr/wordpress`).

### Déplacer une application sur un sous-domaine ?

Que ce passe-t-il si on a déjà installé l’application ? On veut par exemple passer de `mondomaine.fr/wordpress` à `blog.mondomaine.fr`.
Pour l’instant il n’y a pas de façon simple (via l’interface graphique de l’administration de YunoHost) pour déplacer une application sur un sous-domaine.

Solution : réinstaller l’application

### Réinstallation de l’application

On sauvegarde ses données (base de données etc. via un script sql par exemple, les fichiers etc.). On désinstalle l’application via l’interface graphique d’administration de YunoHost. Et on la réinstalle en suivant la procédure ci-dessus.
