# Créer un environnement de développement avec VirtualBox

Cette page de documentation va vous expliquer comment mettre en place un serveur YunoHost virtuel, avec VirtualBox, pour travailler sur le packaging d'application.

## Pourquoi utiliser VirtualBox plutôt qu’un serveur YunoHost de production pour packager une application ?

Il y a principalement deux raisons pour préférer l'usage d'un serveur virtuel plutôt que votre propre serveur :

- Vous pouvez torturer à loisir un serveur virtuel sans courir le risque de le casser, puisque vous pourrez toujours restaurer un état précédent. Alors qu'il serait dommage de casser son propre serveur !
- Un serveur virtuel sera restauré avant de travailler dessus, pour garder en permanence un système sans résidus d'une précédente installation. Cela permet de se rapprocher au plus près d'une première installation par un utilisateur.

Nous parlerons ici de VirtualBox, pour son approche graphique facile à utiliser. Si vous préférez une interface en ligne de commande pour la gestion de la machine virtuelle, tournez-vous de préférence vers [ynh-dev](/dev_fr).

## Installer VirtualBox

Depuis un système GNU Linux, installer simplement le paquet `virtualbox-qt`. 
Depuis un système Windows ou macOS, il faudra se référer à la page de [téléchargement de VirtualBox](https://www.virtualbox.org/wiki/Downloads) pour récupérer le fichier d'installation adéquat. Le paquet virtualbox est déprécié depuis debian 9, un fichier d'installation .deb est disponible sur la même page.

Quel que soit votre système, il ne devrait pas être nécessaire d'installer l'extension pack ou les additions invités.

## Installer YunoHost sur VirtualBox

Suivez simplement la documentation idoine pour l'[installation sur VirtualBox](/install_on_virtualbox_fr) puis la documentation sur la [post-installation](/postinstall_fr).

Lors de la post-installation, il est inutile d'utiliser un nom de domaine en `.nohost.me` ou `.noho.st`, votre serveur virtuel ne sera pas accessible depuis l'extérieur de votre réseau local.  
Nous préférerons l'usage d'un faux nom de domaine qui restera cantonné au réseau local. Par exemple, `yunohost.packaging`.

Ce nom de domaine n'étant enregistré dans aucun serveur DNS, on l'enregistrera dans le fichier `hosts` de l'ordinateur qui y accédera. Voir la documentation sur le [DNS local](/dns_local_network_fr).

Votre serveur virtuel est à présent installé. Avant de commencer à l'utiliser, nous allons voir comment créer un premier instantané et comment les utiliser.

## Utiliser les instantanés

VirtualBox prend tout son intérêt avec l'usage des instantanés, qui permettent d'enregistrer l'état de la machine à un moment donné et d'y revenir rapidement.  
Nous verrons également par la suite comment utiliser plusieurs branches d'instantanés pour travailler sur des apps différentes sur une même machine.

#### Tout d'abord, créons un premier instantané

Avant de commencer à jouer avec la machine virtuelle, il convient de faire un premier instantané, pour ne pas avoir à recommencer le processus d'installation à chaque fois.  
Arrêtez la machine virtuelle avant tout.

La gestion des instantanés se fait dans l'onglet "Instantanés"  
<img src="/images/virtualbox_packaging1.jpg" width=80%>

Et on crée un premier instantané  
<img src="/images/virtualbox_packaging2.jpg" width=30%>

À présent on peut commencer à travailler sur la machine virtuelle et créer autant d'instantanés que souhaité pour jalonner le travail.

<img src="/images/virtualbox_packaging3.jpg" width=80%>

Dans cet exemple, on pourra facilement revenir en arrière, après avoir testé la suppression du package par exemple et restaurer la machine virtuelle dans l'état précédent avec le package encore installé avec succès.  
Et lorsque le package sera pleinement fonctionnel, il suffira de supprimer les instantanés liés à ce package pour revenir à l'état initial de la machine virtuelle.  
Nous disposerons ainsi d'un serveur YunoHost vierge de toute installation d'application pour notre prochain test.

#### Utiliser plusieurs branches d'instantanés

En plus de l'usage d'instantanés successifs, il est également possible de dériver un nouvel état actuel et de nouveaux instantanés depuis un instantané plus ancien que le dernier.

<img src="/images/virtualbox_packaging4.jpg" width=80%>

Dans cet exemple, j'ai dérivé deux branches depuis mon installation réussie du package, pour tester indépendamment la suppression simple de l'application, l'upgrade et le backup/restore.  
Finalement je suis reparti de la base de la machine virtuelle pour démarrer un nouveau test sur un autre package, sans pour autant abandonner le précédent test.  
À tout moment, il est possible de revenir sur un instantané précédent en le restaurant.  
La machine démarrera toujours sur l'"État actuel".

<img src="/images/virtualbox_packaging5.jpg" width=80%>

> Il est toujours possible de créer un nouvel instantané, que la machine soit à l'arrêt ou non.  
Mais pour restaurer un instantané, la machine ne doit pas être en cours d'exécution.

## Comment se connecter à la machine virtuelle ?

On se connecte à la machine virtuelle comme à n'importe quel serveur YunoHost, en utilisant ssh.

```bash
ssh admin@mon.domain
```
Ou, si le domaine n'a pas été ajouté dans le hosts, en utilisant son ip.

```bash
ssh admin@11.22.33.44
```

À présent, on peut travailler sur la machine virtuelle en CLI.

Pour copier facilement les fichiers du package ou utiliser un éditeur de texte graphique, on peut également se connecter en sftp avec un explorateur de fichier.

Il suffit de se connecter à l'adresse `sftp://admin@mon.domain/` avec l'explorateur.  
<img src="/images/virtualbox_packaging6.jpg" width=80%>

> Sur Windows ou macOS, l'explorateur de fichier ne supporte pas nativement le protocole sftp…
