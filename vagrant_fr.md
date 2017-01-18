# Vagrant et YunoHost

*Si vous avez besoin d’une vm pour tester du code, il vaut mieux utiliser directement [ynh-dev](https://github.com/yunohost/ynh-dev)*

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install_fr)**.*

<img src="/images/vagrant.png" width=250>

**Prérequis** : Un ordinateur x86 avec VirtualBox installé et assez de RAM disponible pour lancer une petite machine virtuelle.

---

## Initialisation

Créer un dossier pour le projet :
```bash
mkdir YunoHost
cd YunoHost
```

La commande suivante va initialiser le projet avec une image YunoHost de base
```bash
vagrant box add yunohost/jessie-stable https://build.yunohost.org/yunohost-jessie-stable.box --provider virtualbox
vagrant init yunohost/jessie-stable
```
<blockquote>
<span class="text-warning">/!\</span>Si vous préférez utiliser la version beta https://build.yunohost.org/yunohost-jessie-testing.box
</blockquote>

Puis, il faut activer le réseau pour l'instance YunoHost:
```bash
sed -i 's/# config\.vm\.network "private_network"/config.vm.network "private_network"/' Vagrantfile
```

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

Vous pouvez accéder à votre vm via l’ip 192.168.33.10.

Les adresses IP sont assignées par défaut mais peuvent être changées dans les paramètres réseau du Vagrantfile.

---

*Une fois l’installation terminée, vous pouvez procéder à la post-installation : **[yunohost.org/postinstall](/postinstall_fr)** *



