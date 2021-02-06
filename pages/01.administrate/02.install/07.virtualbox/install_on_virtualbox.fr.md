---
title: Installer YunoHost sur VirtualBox
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_on_virtualbox'
---

*Trouvez d’autres moyens d’installer YunoHost **[ici](/install)**.*

## Prérequis

![](image://virtualbox.png?resize=200)

* Un ordinateur x86 avec VirtualBox installé et assez de RAM disponible pour lancer une petite machine virtuelle.
* La dernière **image ISO YunoHost** stable, disponible [ici](/images).

<div class="alert alert-warning" markdown="1">
N.B. : Installer YunoHost dans une VirtualBox est utile pour tester la
distribution. Pour réellement s'autohéberger sur le long terme, il vous faudra
probablement une machine physique (vieil ordinateur, carte ARM...) ou un VPS en
ligne.
</div>

---

## <small>1.</small> Créer une nouvelle machine virtuelle

![](image://virtualbox_1.png)

<br>

* Ce n'est pas grave si seulement la version 32-bit est dispo, mais dans ce cas soyez sur d'avoir téléchargé l'image 32 bit précédemment.
* 256Mo de RAM est le minimum requis, 512Mo est recommandé (1Go ou plus si vous pouvez).
* 8Go de stockage minimum requis pour le système, y ajouter l'espace pour vos applications.

---

## <small>2.</small> Modifier la configuration réseau

Allez dans **Réglages** > **Réseau** :

![](image://virtualbox_2.png)

<br>

* Sélectionnez `Accès par pont`

* Choisissez votre interface selon son nom :

    **wlan0** si vous êtes connecté sans-fil, **eth0** sinon.

---

## <small>3.</small> Lancer votre machine virtuelle

Démarrez votre machine virtuelle

![](image://virtualbox_2.1.png)

<br>

Vous devez sélectionner ici l’image ISO, puis vous devriez voir cet écran d’accueil YunoHost.

<br>

Si vous rencontrez l'erreur "VT-x is not available", il vous faut probablement activer (enable) la virtualisation dans les options du BIOS de votre ordinateur.

<br>
   
![](image://virtualbox_3.png)

<br>

* Choisissez `Installation graphique`

* Sélectionnez votre langue, votre emplacement, la disposition de votre clavier et laissez l’installeur faire le reste :-)

---

## <small>4.</small> Effectuer la post-installation

Après le redémarrage, la machine devrait vous proposer d'effectuer la
post-installation :

<a class="btn btn-lg btn-default" href="/postinstall">Post-install
documentation</a>
