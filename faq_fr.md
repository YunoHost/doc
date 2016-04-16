# Foire aux questions

#### Est-ce que YunoHost est porté sous Ubuntu ?
L’équipe de YunoHost n’a pas l’énergie de porter ni de maintenir YunoHost sur Ubuntu.

#### YunoHost est distribuée sous quelle licence ?
Les paquets qui composent YunoHost sont sous licence libre GNU AGPL v.3.

YunoHost est basé sur Debian, donc sur les licences des éléments sur lesquels Debian est basé.

Les applications et les packages d’applications ont leurs licences respectives.

#### Peut-on héberger plusieurs sites indépendants avec des noms de domaines différents ?
On peut tout à fait héberger plusieurs sites web car YunoHost est multi-domaine et que certaines applications de gestion de sites web, comme *WordPress* ou *Web App Multi Custom*, sont multi-instances, c’est-à-dire que l’application peut-être installée plusieurs fois.

#### Pourquoi je ne peux pas accéder à mes applications avec l’adresse IP ?
Le [SSO](https://github.com/Kloadut/SSOwat/) ne permet pas d’accéder à la partie utilisateur (applications incluses) avec une adresse IP. Pour cela, il faut utiliser un nom de domaine. Une des astuces consiste à modifier le [fichier `hosts` (dernier §)](dns_local_network_fr) de son ordinateur de bureau avec un nom de domaine que l’on n’est pas obligé de posséder.
