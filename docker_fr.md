# Docker et YunoHost

Voici une petite page de documentation en guise de mémo sur la manière de test/développer YunoHost avec Docker.

<img src="https://yunohost.org/images/docker.png" width=250>

---

## Installer Docker

**Prérequis** : Une machine x86 qui tourne sous Ubuntu 12.04 ou supérieur, ou alors ArchLinux (sur Debian c'est plus chiant)

Sous ubuntu :
```bash
# 12.04 uniquement
sudo apt-get update
sudo apt-get install linux-image-generic-lts-raring linux-headers-generic-lts-raring
sudo reboot

# Puis dans tous les cas
curl -s https://get.docker.io/ubuntu/ | sudo sh
```

Sous ArchLinux :
```bash
sudo pacman -Sy docker
```

**Remarque :** Vous pourrez avoir besoin de lancer le démon docker (en root : `service docker start`, `systemctl start docker` ou simplement `docker -d`)

---

## Installer le conteneur YunoHost

La commande suivante va télécharger une image Debian Wheezy de base, y cloner le script et installer YunoHost.
```bash
docker build -t yunohost:init https://raw.githubusercontent.com/YunoHost/Kremlin/master/docker/Dockerfile
```

Vous pouvez vérifier que le conteneur est bien buildé avec la commande `docker images`

---

## Démarrer le conteneur

```bash
docker run -d -t yunohost:init /sbin/init
```

Cette commande lancera un conteneur sur la base de l'image `yunohost`, tag `init` que vous venez de créer, vous pourrez ensuite postinstaller tout ça en vous rendant en HTTP sur l'IP du conteneur (le premier conteneur a généralement comme IP 172.17.0.2)

**Remarque :** Vous pourrez avoir besoin de forwarder certains ports de votre conteneur docker, pour cela consultez les pages de doc suivantes :

* http://docs.docker.io/reference/commandline/cli/#run
* http://docs.docker.io/use/port_redirection/#port-redirection


---

## Usage avancé

Petit mémo des commandes utiles :

### Snapshoter l'état d'un container

```bash
docker commit <ID_de_mon_conteneur> LeNomQueJeVeux
# Exemple : docker commit 3e85317430db yunohost/27042014
```

### Assigner une IP à un container

```bash
# Vous avez besoin d'iptables, et avoir activé l'IP forwarding sur votre système
iptables -t nat -A PREROUTING -d <IP à allouer> -j DNAT --to-destination <IP conteneur docker>
iptables -t nat -A POSTROUTING -s '<IP conteneur docker>/32' -o eth0 -j SNAT --to-source <IP à allouer>
# Attention à l'interface (ici eth0)
```

### Se connecter à un conteneur démarré

```bash
# Vous avez besoin :
# * de votre ID de conteneur
docker ps -notrunc | grep yunohost
# * du PID de votre conteneur
cat /var/lib/docker/execdriver/native/<ID_de_mon_conteneur>/pid
# du paquet `util-linux`
apt-get install util-linux || pacman -S util-linux

# Lancez la commande nsenter avec les paramètre kivonbien©
nsenter --target <PID> --mount --uts --ipc --net --pid /bin/bash
```
