# Installer YunoHost sur VirtualBox

*Trouvez d’autres moyens d’installer YunoHost **[ici](/install_fr)**.*

## Prérequis

<img src="/images/virtualbox.png" width=200>

* Un ordinateur x86 avec VirtualBox installé et assez de RAM disponible pour lancer une petite machine virtuelle.
* La dernière **image ISO YunoHost** stable, disponible [ici](https://build.yunohost.org).

---

## <small>1.</small> Créer une nouvelle machine virtuelle

<img src="/images/virtualbox_1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* 256MB de RAM est le minimum requis, 512MB est recommandé.

* 4GB de stockage minimum requis.

---

## <small>2.</small> Modifier la configuration réseau

Allez dans **Réglages** > **Réseau** :

<img src="/images/virtualbox_2.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Sélectionnez `Accès par pont`

* Choisissez votre interface selon son nom :

    **wlan0** si vous êtes connecté sans-fil, **eth0** sinon.

---

## <small>3.</small> Lancer votre machine virtuelle

Démarrez votre machine virtuelle

<img src="/images/virtualbox_2.1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

Vous devez sélectionner ici l’image ISO `yunohostv2-latest-amd64.iso`, puis vous devriez voir cet écran d’accueil YunoHost.

<br>
   
<img src="/images/virtualbox_3.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Choisissez `Installation graphique`

* Sélectionnez votre langue, votre emplacement, la disposition de votre clavier et laissez l’installeur faire le reste :-)

---

## <small>4.</small> Effectuer la post-installation

Après le redémarrage, vous devriez voir cet écran :

<img src="/images/virtualbox_4.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Vous pouvez obtenir plus d’information sur la post-installation ici : **[yunohost.org/postinstall_fr](/postinstall_fr)**
* Le mot de passe root est "yunohost"

