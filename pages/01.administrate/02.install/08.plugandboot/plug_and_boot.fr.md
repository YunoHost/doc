---
title: Brancher et démarrer votre serveur
template: docs
taxonomy:
    category: docs
---

* Mettez la carte SD dans le serveur (pour le cas des cartes ARM)
* Branchez le cable ethernet
* Branchez l'alimentation
* Laissez quelques minutes à votre serveur pour démarrer

### Se connecter à son serveur

* Assurez vous que votre ordianteur (de bureau ou portable) est connecté au même réseau local (c'est-à-dire la même box internet) que votre serveur.
* Ouvrez un navigateur internet et tapez `https://yunohost.local` dans la barre d'adresse.
* Si votre serveur est actif, vous rencontrerez très probablement un avertissement de sécurité. Cet avertissement viens du fait que votre serveur utilise pour le moment ce qui s'appelle un "certificat auto-signé" - et que nous utisons un domaine spécial en `.local`. Vous pourrez plus tard ajouter 'vrai' domaine et un certificat automatiquement reconnus par les navigateurs comme décrit dans la page sur les [Certificats](/certificate). En attendant, ajoutez une exception de sécurité pour accepter le certificat actuel.
* Si vous n'arrivez pas à contacter votre serveur avec `yunohost.local`, essayez de [trouver l'IP locale de votre serveur](/finding_the_local_ip) - puis dans la barre d'adresse de votre navigateur, tapez `https://192.168.x.y`
* [Effectuer la configuration initiale (post-installation)](/postinstall)

--- 

#### [Optionnel] Connecter le serveur à internet en WiFi

* Vous pouvez aussi configurer la connexion wifi comme expliqué [ici](http://raspbian-france.fr/connecter-wifi-raspberry-pi-3/). 
* La configuration wifi peut aussi se faire sans avoir booté sur la carte, en "montant" la deuxième partition de la carte et enfin éditer le fichier `wpa-supplicant.conf`. Sur Windows vous pouvez utiliser [Paragon ExtFS](https://www.paragon-software.com/home/extfs-windows/). Ne pas oublier de "unmount" pour que les changements soient pris en compte. 

---

#### [Optionnel] Accès direct avec un écran et clavier

* Il est possible de brancher un écran et clavier sur votre serveur pour vérifier que le processus de démarrage (boot) se passe bien et pour avoir un accès direct en console.

<div class="text-center"><img src="/images/boot_screen.png"></div>
