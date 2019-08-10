# Installation sur ordinateur

*Trouvez d’autres moyens d’installer YunoHost **[ici](/install_fr)**.*

## Prérequis

<img src="/images/laptop.png" width=200>
<img src="/images/desktop.jpg">
<img src="/images/nettop.jpg">

* Un matériel compatible x86 dédié à YunoHost : portable, netbook, ordinateur. Vous pouvez réutiliser n’importe quelle machine avec **256 Mo de RAM minimum**
* Un autre ordinateur pour parcourir ce guide et accéder à votre serveur
* Un [fournisseur d’accès correct](/isp_fr), de préférence avec une bonne vitesse de téléversement (débit montant)
* Une **clé USB** d’une capacité minimum d’1Go **OU** un **CD vierge** standard
* ***Cas particulier*** : Si votre serveur n'a pas de carte graphique, il faut [préparer un iso qui démarre sur le port série](https://github.com/luffah/debian-mkserialiso).

<div class="alert alert-error" markdown="1">
L'installation à l'aide de notre ISO Virtualbox / x86 est actuellement cassée ... Nous investiguons le problème [ici](https://github.com/YunoHost/issues/issues/1382). En attendant, il est possible de contourner le problème est d'utiliser l'ISO officielle Debian 9.x (pas 10 !) et d'installer YunoHost par dessus comme expliqué [ici](https://yunohost.org/#/install_on_debian)
</div>

---

## Étapes d’installation

<a class="btn btn-lg btn-default" href="/images_fr">0. Télécharger l'image ISO</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso_fr">1. Copier l’image ISO</a>

<a class="btn btn-lg btn-default" href="/boot_and_graphical_install_fr">2. Démarrer & installer</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">3. Post-installation</a>

---

Pour se connecter directement sur l’ordinateur (uniquement en local) :
* Utilisateur : **root**
* Mot de passe : **yunohost**


## Cas spécifiques / avancés

Si l'ordinateur n'a pas de carte graphique mais a un port série : il faut modifier l'ISO pour démarrer avec la console série. Une solution est d'utiliser [un script qui modifie les options de démarrage](https://github.com/luffah/debian-mkserialiso).
