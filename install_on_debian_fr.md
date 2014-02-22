#Guide d'installation sur Debian

Vous disposez de deux moyens pour installer YunoHost:

1. [Installation via CD-ROM ou USB](/install_fr)
2. Installation sur Debian (guide ci-dessous)

### Prérequis
Une machine, un VPS, ou un serveur dédié:

* Avec Debian 7 (Wheezy, Raspbian, Cubian, etc.) installé
* Connecté à Internet
* Accessible en root ou sudoer via SSH

### Installation

1. Connectez-vous en SSH à votre système Debian
```bash
ssh root@monserveur.org
```

2. /!\ Pour Raspbian uniquement /!\

A priori, le script doit supprimer l'utilisateur root.
Sur une Raspbian, l'utilisateur root n'est pas activé par défaut.
Pour ne pas avoir de message d'erreur et poursuivre l'installation de yunohost v2 beta3 sur un Raspberry Pi avec Raspbian, faire ces deux manipulations : activer l'utilisateur root et créez lui un mot de passe.
```bash
sudo -i
passwd root
```

3. Installez git
```bash
apt-get install git
```

4. Clonez le répertoire du script d'installation YunoHost
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

5. Exécutez le script
```bash
cd /tmp/install_script && ./install_yunohostv2
```

### Post-installation

Lorsque l'installation se finit, le script vous propose de procéder à la post-installation. Celle-ci vous demandera deux paramètres:

1. **Nom de domaine**: Vous devez choisir un nom de domaine qui pointera vers l'adresse IP de votre instance YunoHost. Si vous choisissez un nom de domaine terminant par **.nohost.me** ou **.noho.st**, l'étape de configuration des DNS se fera automatiquement et vous n'aurez qu'à attendre 3 minutes à la fin de la post-installation. Si vous optez pour pour un autre nom de domaine, vous devrez l’avoir préalablement acheté et [configuré](/dns_fr) pour qu'il pointe vers votre **adresse IP**.

2. **Mot de passe administrateur**: C’est le mot de passe qui vous permettra d’administrer votre instance YunoHost, **choisissez-le avec attention**, il ne doit pas être divulgué ni être devinable, sinon vous pourrez perdre votre système.

La post-install se déroulera ensuite automatiquement et pourrez accéder à l'interface d'administration via **https://votre-domaine.org/ynhadmin**
