# Vagrant et YunoHost

*Voici une petite page de documentation en guise de mémo sur la manière de tester/développer YunoHost avec Vagrant.*

*Toutes les autres façons d'installer YunoHost sont listées **[ici](/install_fr)**.*

<img src="https://yunohost.org/images/vagrant.png" width=250>

**Prérequis** : Un ordinateur x86 avec VirtualBox installé et assez de RAM disponible pour lancer une petite machine virtuelle.

---

## Initialisation

Créer un dossier pour le projet
```bash
mkdir YunoHost
cd YunoHost
```

La commande suivante va initialiser le projet avec un image Debian Wheezy de base
```bash
vagrant init chef/debian-7.4
```

Décommenter (Supprimer le # devant la ligne) la ligne suivante dans le fichier Vagrantfile nouvellement créé afin d'avoir un accès depuis le système hôte
```bash
  config.vm.network "private_network", ip: "192.168.33.10"
```

Clonez le dépôt du script d'installation de YunoHost
```bash
git clone https://github.com/YunoHost/install_script
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

Il est nécessaire de donner un mot de passe à l'utilisateur root
```bash
sudo passwd
```

Mettre à jour le système.
```bash
sudo apt-get update && sudo apt-get upgrade
```

Lancez le script d'installation
```bash
cd /vagrant/install_script && sudo ./install_yunohostv2
```

<br>

<p class="text-center">
<img src="https://yunohost.org/images/install_script.png">
</p>

---

*Une fois l'installation terminée, vous pouvez procéder à la post-installation : **[yunohost.org/postinstall](/postinstall_fr)** *
