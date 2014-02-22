# Installation de YunoHost sur CubieBoard

### Pré-requis
* CubieBoard & µ-SD de 4Gb minimum
* Un accès internet
* Un accès à l'administration de la box

### Images de Debian 7 Wheezy adaptées aux CubieBoard 1 et 2 :

* [Cubian](http://cubian.org/)
* [Cubieez](http://www.cubieforums.com/index.php?topic=442.0)

### Copie de l'image sur la µ-SD
#### Via l'interface graphique (recommandé)
Avec le logiciel "Disques" présent dans Debian et ses dérivés, sélectionner la µ-SD et faite "restauré l'image disque".

#### Via la ligne de console
Repérer le nom de la µ-SD (/dev/…) avec :
```bash
df -h
```
Copier l'image à partir du répertoire à laquelle elle se trouve sur la µ-SD :
```bash
(sudo) dd if=/image/debian/ of=/dev/<µ-SD> bs=1M && sync
```
### Augmentation de la taille de la partition
À l'aide de GParted redimentionner la partition.

### Démarrage
Mettez la µ-SD dans la CubieBoard et démarrer-la.

### Repérer l'adresse IP locale de votre CubieBoard
```bash
nmap 192.168.0.0/24 ou nmap 192.168.1.0/24
```
### Redirection du nom de domaine vers l'adresse IP locale de la CubieBoard
Réglages de /etc/hosts sur l'ordinateur de bureau :
```bash
(sudo) nano /etc/hosts
```
Ajouter une ligne de la forme :
```bash
adresse_ip_cubieboard      votre_domaine.org
```
### Connection ssh
```bash
ssh root@votre_domaine.org
```
### Installation de YunoHost

1. Installez git
```bash
apt-get install git
```

2. Clonez le répertoire du script d'installation YunoHost
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. Exécutez le script
```bash
cd /tmp/install_script && ./install_yunohostv2
```

### Post-installation

Lorsque l'installation se finit, le script vous propose de procéder à la post-installation. Celle-ci vous demandera deux paramètres:

1. **Nom de domaine**: Vous devez choisir un nom de domaine qui pointera vers l'adresse IP de votre instance YunoHost. Si vous choisissez un nom de domaine terminant par **.nohost.me** ou **.noho.st**, l'étape de configuration des DNS se fera automatiquement et vous n'aurez qu'à attendre 3 minutes à la fin de la post-installation. Si vous optez pour pour un autre nom de domaine, vous devrez l’avoir préalablement acheté et [configuré](/dns_fr) pour qu'il pointe vers votre **adresse IP**.

2. **Mot de passe administrateur**: C’est le mot de passe qui vous permettra d’administrer votre instance YunoHost, **choisissez-le avec attention**, il ne doit pas être divulgué ni être devinable, sinon vous pourrez perdre votre système.

La post-install se déroulera ensuite automatiquement et pourrez accéder à l'interface d'administration via **https://votre-domaine.org/ynhadmin**

### Mettre à jour YunoHost
```bash
apt-get update && apt-get upgrade && apt-get dist-upgrade
```
### Ouverture des ports
Upnp ne fonctionne pas encore, il faut donc ouvrir manuellement les ports sur la box.
Pour connaître les ports à ouvrir :
```bash
yunohost firewall list
```


