---
title: Installation sur ordinateur
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_iso'
---

*Trouvez d’autres moyens d’installer YunoHost **[ici](/install)**.*

## Prérequis

[center]
![Laptop](image://laptop.png?resize=200,200&class=inline)
![Desktop](image://desktop.jpg?resize=200,200&class=inline)
![Nettop](image://nettop.jpg?resize=200,200&class=inline)
[/center]

* Un matériel compatible x86 dédié à YunoHost : portable, netbook, ordinateur. Vous pouvez réutiliser n’importe quelle machine avec **256 Mo de RAM minimum**
* Un autre ordinateur pour parcourir ce guide et accéder à votre serveur
* Un [fournisseur d’accès correct](/isp), de préférence avec une bonne vitesse de téléversement (débit montant)
* Une **clé USB** d’une capacité minimum d’1 Go **OU** un **CD vierge** standard
* ***Cas particulier*** : Si votre serveur n'a pas de carte graphique, il faut [préparer un ISO qui démarre sur le port série](https://github.com/luffah/debian-mkserialiso).

---

## Étapes d’installation

<a class="btn btn-lg btn-default" href="/images">0. Télécharger l'image ISO de YunoHost</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">1. Flasher l’image ISO sur une clef USB</a>

<a class="btn btn-lg btn-default" href="/boot_and_graphical_install">2. Démarrer la machine et installer YunoHost</a>

<a class="btn btn-lg btn-default" href="/postinstall">3. Effectuer la configuration initiale (post-installation)</a>

---

Pour se connecter directement sur l’ordinateur (uniquement en local) :
* Utilisateur : **root**
* Mot de passe : **yunohost**


## Cas spécifiques / avancés

Si l'ordinateur n'a pas de carte graphique mais a un port série : il faut modifier l'ISO pour démarrer avec la console série. Une solution est d'utiliser [un script qui modifie les options de démarrage](https://github.com/luffah/debian-mkserialiso).
