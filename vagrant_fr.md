# Vagrant et YunoHost

*Voici une petite page de documentation en guise de mémo sur la manière de tester/développer YunoHost avec Vagrant.*

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install_fr)**.*

<img src="https://yunohost.org/images/vagrant.png" width=250>

**Prérequis** : Un ordinateur x86 avec VirtualBox installé et assez de RAM disponible pour lancer une petite machine virtuelle.

---

## Initialisation

Créer un dossier pour le projet
```bash
mkdir YunoHost
cd YunoHost
```

La commande suivante va initialiser le projet avec une image Debian Wheezy de base
```bash
vagrant init yunohost/stable8
```
<blockquote>
<span class="text-warning">/!\</span> Vous devez avoir une box `yunohost/stable8`. Si ce n'est pas le cas, ajoutez-la
`vagrant box add yunohost/stable8 https://atlas.hashicorp.com/yunohost/boxes/stable8/versions/1.0.0/providers/virtualbox.box`
</blockquote>

---

## Installation

Démarrer la machine virtuelle
```bash
vagrant up
```

Se connecter à la machine virtuelle démarrée
```bash
vagrant ssh
```

Mettre à jour le système.
```bash
sudo apt-get update && sudo apt-get upgrade
```

Vous pouvez accéder à votre vm via l'ip 192.168.33.80

---

*Une fois l’installation terminée, vous pouvez procéder à la post-installation : **[yunohost.org/postinstall](/postinstall_fr)** *


## Image avec wheezy or testing/unstable repository

Si vous avez besoin d'une vm pour tester quelque chose avec wheezy ou la version testing/unstable de Yunohost. Il y a un Vagrantfile et 5 autres box en préparation. Pour le moment, vous pouvez construire les images en suivant les instructions sur ce dépôt: https://github.com/zamentur/yunohost-vagrant

| Box | IP | 
| --- | --- | 
| stable8 | 192.168.33.80 |
| testing8 | 192.168.33.81 |
| unstable8 | 192.168.33.82 |
| stable7 | 192.168.33.70 |
| testing7 | 192.168.33.71 |
| unstable7 | 192.168.33.72 |

Les adresses IPs sont assignées par défaut mais peuvent être changées dans les paramètres réseau du Vagrantfile.


