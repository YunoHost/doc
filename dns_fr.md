# DNS : système de nom de domaine

La configuration des DNS est une étape cruciale pour que votre serveur soit accessible. En effet si vos DNS sont mal configurés, il y a toutes les chances pour que vous ayez des problèmes de connexion à votre serveur via votre nom de domaine.

*Bien que cette page de documentation paraisse longue et complexe, elle demeure très importante si vous souhaitez comprendre correctement les implications du nommage sur Internet via les noms de domaine, qui sont nécessaires au fonctionnement de votre serveur YunoHost.*

### Qu’est-ce que c’est ?

**N’hésitez pas à regarder la très bonne conférence de Stéphane Bortzmeyer :     
http://www.iletaitunefoisinternet.fr/dns-bortzmeyer/**

DNS signifie « Domain Name Server » en anglais, et est souvent employé pour désigner la configuration de vos noms de domaine. Vos noms de domaines doivent en effet pointer vers quelque chose (en général une adresse IP).

**Par exemple** : `yunohost.org` renvoie vers `88.191.153.110`.

Ce système a été créé pour pouvoir retenir plus facilement les adresses de serveur. Il existe donc des registres DNS dans lesquels il faut s’inscrire. Ceci peut être fait auprès de **registrars** qui vous feront louer ces noms de domaine contre une certaine somme (entre 5 et quelques centaines d’euros). Ces [registrars](registrar) sont des entités privées autorisées par l’[ICANN](http://fr.wikipedia.org/wiki/ICANN), telles que [Gandi](http://gandi.net), [OVH](http://ovh.com) ou [BookMyName](http://bookmyname.com).

Il est important de noter que les sous-domaines ne renvoient pas nécessairement au domaine principal.
Si `yunohost.org` renvoie vers `88.191.153.110`, ça ne signifie pas que `backup.yunohost.org` renvoie vers la même IP. Vous devez donc configurer **tous** les domaines et sous-domaines que vous souhaitez utiliser.

Il existe également des **types** d’enregistrement DNS, ce qui veut dire qu’un domaine peut renvoyer vers autre chose qu’une adresse IP.

**Par exemple** : `www.yunohost.org` renvoie vers `yunohost.org`


### Comment (bien) faire la configuration ?

Plusieurs choix s’offrent à vous. Notez que vous pouvez cumuler ces solutions si vous possédez plusieurs domaines : par exemple vous pouvez avoir `mon-serveur.nohost.me` en utilisant la solution **1.**, et `mon-serveur.org` en utilisant la solution **2.**, redirigeant vers le même serveur YunoHost.

1. Vous pouvez utiliser [le service de DNS de YunoHost](/dns_nohost_me_fr), qui s’occupera de configurer tout seul les DNS de votre instance YunoHost. Vous devrez en revanche choisir un domaine se terminant par `.nohost.me`, `.noho.st` ou `.ynh.fr`, ce qui peut être inconvenant (vous aurez alors des adresses email telles que `jean@mon-serveur.noho.st`).
**C’est la méthode recommandée si vous débutez.**

2. Vous pouvez utiliser le service de DNS de votre **registrar** (Gandi, OVH, BookMyName ou autre) pour configurer vos noms de domaine. Voici la [configuration DNS standard](/dns_config_fr). Il est aussi possible d'utiliser une redirection DNS locale, plus d'infos sur comment [Accéder à son serveur depuis le réseau local](/dns_local_network_fr).
Vous pouvez également consulter les documentations spécifiques à ces différents [bureaux d’enregistrement](/registrar_fr) : [Gandi](http://gandi.net), [OVH](/OVH_fr) ou [BookMyName](http://bookmyname.com).

**Attention** : Si vous choisissez ce mode de fonctionnement, vous aurez plus de flexibilité, mais rien ne sera automatique. Par exemple si vous souhaitez utiliser `webmail.mon-serveur.org`, vous devrez l’ajouter manuellement chez votre registrar.

3. Votre instance YunoHost possède un service DNS, ce qui veut dire qu’il configure automatiquement ses enregistrements DNS, et qu’il est possible de lui en déléguer la gestion. Pour ce faire, vous devez indiquer au **registrar** que c’est votre instance YunoHost qui est le serveur DNS de votre nom de domaine en créant un enregistrement glue (souvent appelé **glue record**) pointant vers l’IP de votre instance YunoHost.
<br><br>**Attention** : Si vous choisissez ce mode de fonctionnement, toutes les configurations seront automatiques, vous disposerez d’une grande flexibilité, mais la perte de votre serveur entraînera potentiellement beaucoup d’ennuis. **Choisissez cette méthode si vous êtes sûr de vous.**

4. Une fois votre service DNS opérationnel, votre serveur peut l’utiliser mais il faut le configurer, c’est le [résolveur DNS](/dns_resolver_fr).

### IP Dynamique
Si l’adresse IP publique change, suivez ce [tutoriel](dns_dynamicip_fr).
