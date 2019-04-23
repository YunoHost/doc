# DNS avec une IP dynamique

<div class="alert alert-warning">Avant d’aller plus loin, assurez-vous que votre adresse IP publique est dynamique à l’aide de : [ip.yunohost.org](http://ip.yunohost.org/). L’adresse IP publique de votre box change à peu près tous les jours.</div>

Ce tutoriel a pour but de contourner le problème d’IP dynamique qui est le suivant : lorsque l’adresse IP publique de la box change, la zone DNS n’est pas mise à jour pour pointer vers la nouvelle adresse IP.

Après avoir mis en place la solution proposée dans ce tutoriel, la redirection du nom de domaine vers l’adresse IP ne sera plus perdue.

La méthode qui sera mise en place consiste à rendre automatique le fait que la box annonce au DNS dynamique qu’elle a changée d’adresse IP publique, et qu’ensuite la zone DNS soit automatiquement changée.

Si vous possédez un nom de domaine chez **OVH**, vous pouvez aller à l’étape 4 et suivre ce [tutoriel](OVH_fr) étant donné qu’OVH propose un service de DynDNS.

#### 1. Créer un compte pour un service de DNS dynamique

Voici des sites qui proposent un service de DynDNS gratuitement :
* [DNSexit](https://www.dnsexit.com/Direct.sv?cmd=dynDns)
* [No-IP](https://www.noip.com/remote-access)
* [ChangeIP](https://changeip.com)
* [DynDNS (en italien)](https://dyndns.it)
* [Duck DNS](https://www.duckdns.org/)

Créer un compte chez l’un d’eux.

#### 2. Déplacer les zones DNS
Déplacer les [zones DNS](dns_config), à l’exception des champs NS, du [bureau d’enregistrement](registrar_en) où vous avez acheté votre nom de domaine vers le DNS dynamique où vous avez créé un compte à l’étape 1.

#### 3. Basculer la gestion de votre nom de domaine vers le serveur DNS dynamique
Cette étape consiste à faire savoir au [bureau d’enregistrement](registrar_en) que le service de DNS sera assuré par le service de DynDNS.
Redirigez le champ NS vers l’adresse IP donnée par le service de DynDNS.

Ensuite, supprimez les [zones DNS](dns_config), à l’exception des champs NS, du [bureau d’enregistrement](registrar_en).

#### 4. Créer un identifiant de DNS dynamique
Sur le service de DNS dynamique créer un identifiant qui sera entré dans un client de DNS dynamique.
Ce client peut-être votre box ou un paquet installé sur votre serveur comme `ddclient`.
Nous allons utiliser le client de la box qui est plus simple à mettre en place.

#### 5. Configurer la box
Mettez l’identifiant du DNS dynamique et l’[adresse IP publique](http://ip.yunohost.org/) dans votre box.

<img src="/images/dns_dynamic-ip_box_conf.png" width=600>
