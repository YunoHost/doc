# Docker et YunoHost

*Voici une page de documentation en guise de mémo sur la manière de tester/développer YunoHost avec Docker.*

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install_fr)**.*

<img src="/images/docker.png" width=250>

---

## Installer Docker

**Prérequis** :
* une machine qui tourne sous Ubuntu 14.04 ou supérieur, ArchLinux ou Fedora (sur Debian c’est un peu plus compliqué) ...
* ... **avec systemd**
* une machine sous architecture processeur AMD64 (PC classique) ou ARMHF (comme Raspberry PI V2 ou V3)

Sous Ubuntu :
```bash
$ curl -s https://get.docker.io/ubuntu/ | sudo sh
```

Sous ArchLinux :
```bash
$ sudo pacman -Sy docker
```

Sous Fedora :
```bash
$ sudo dnf install docker
```
---

Passez **root** :
```bash
$ sudo -i
```

Lancer le démon docker avec une des commandes ci-dessous :
```bash
service docker start
systemctl start docker
docker -d
```
---

## Récupérer l'image YunoHost

La commande suivante va télécharger l’image YunoHost pré-construite pour **AMD 64**  :
```bash
docker pull domainelibre/yunohost
```

La commande suivante va télécharger l’image YunoHost pré-construite pour **ARMHF** (ex : Raspberry PI 2 ou 3):
```bash
docker pull domainelibre/yunohost-arm
```

## Construire l'image YunoHost

Vous pouvez également construire le conteneur manuellement :

Merci de suivre la section *Building* [ici](https://github.com/aymhce/YunohostDockerImage)

---

## Démarrer le conteneur

> **L'hôte linux de docker doit fonctionner avec systemd**

> **ATTENTION : le mode --privileged est nécessaire pour systemd**

Pour démarrer le conteneur, lancez la commande suivante en remplaçant DOMAIN par un domaine valide ex : mondomaine.org => yunohost.mondomaine.org
```bash
docker run -h yunohost.DOMAIN -v $(pwd):/yunohost -d --privileged \
-v /sys/fs/cgroup:/sys/fs/cgroup:ro domainelibre/yunohost /bin/systemd
```

Si vous souhaitez démarrer le conteneur avec tous les ports forwardés sur l’hôte :

```bash
docker run -d -h yunohost.DOMAIN -v $(pwd):/yunohost \
 --privileged \
 -p 25:25 \
 -p 53:53/udp \
 -p 80:80 \
 -p 443:443 \
 -p 465:465 \
 -p 993:993 \
 -p 5222:5222 \
 -p 5269:5269 \
 -p 5290:5290 \
 -v /sys/fs/cgroup:/sys/fs/cgroup:ro \
 domainelibre/yunohost \
 /bin/systemd
```

Plus d’information sur la documentation de Docker :
* http://docs.docker.com/reference/commandline/cli/#run
* http://docs.docker.com/userguide/dockerlinks/


---

## Post-installation
Entrer dans le container en remplaçant XXXX par l’id obtenu lors du docker run
```bash
docker exec -t -i XXXX /bin/bash
```
Puis lancez la postinstall avec le script dédié à docker
```bash
yunohost tools postinstall
```


---

## Commandes utiles


Récupérez l’adresse IP du conteneur (normalement quelque chose comme 172.17.0.x)

```bash
docker inspect --format '{{ .NetworkSettings.IPAddress }}' <CONTAINER_ID>
```

Snapshoter l’état d’un container

```bash
docker commit <ID_de_mon_conteneur> LeNomQueJeVeux
# Exemple : docker commit 3e85317430db yunohost:20160530
```

Assigner une IP à un container

```bash
# Vous avez besoin d’iptables, et avoir activé l’IP forwarding sur votre système
iptables -t nat -A PREROUTING -d <IP à allouer> -j DNAT --to-destination <IP conteneur docker>
iptables -t nat -A POSTROUTING -s '<IP conteneur docker>/32' -o eth0 -j SNAT --to-source <IP à allouer>
# Attention à l’interface (ici eth0)
```

Se connecter à un conteneur démarré

```bash
docker exec -t -i <ID_de_mon_conteneur> /bin/bash
```
