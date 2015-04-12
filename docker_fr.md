# Docker et YunoHost

*Voici une petite page de documentation en guise de mémo sur la manière de tester/développer YunoHost avec Docker.*

*Toutes les autres façons d'installer YunoHost sont listées **[ici](/install_fr)**.*

<img src="https://yunohost.org/images/docker.png" width=250>

---

## Installer Docker

**Prérequis** : une machine x86 qui tourne sous Ubuntu 14.04 ou supérieur, ou alors ArchLinux (sur Debian c'est plus chiant)

Sous Ubuntu :
```bash
curl -s https://get.docker.io/ubuntu/ | sudo sh
```

Sous ArchLinux :
```bash
sudo pacman -Sy docker
```

**Remarque :** vous pourrez avoir besoin de lancer le démon docker (en root : `service docker start`, `systemctl start docker` ou simplement `docker -d`)

---

## Installer le conteneur YunoHost

La commande suivante va télécharger l’image YunoHost pré-construite :
```bash
docker pull yunohost/full
```

Vous pouvez également construire le conteneur manuellement :
```bash
docker build -t yunohost/full github.com/YunoHost/Dockerfile
```

Vous pouvez vérifier que le conteneur est bien téléchargé avec la commande `docker images`

---

## Démarrer le conteneur

```bash
docker run -d yunohost/full /sbin/init
```

Si vous souhaitez démarrer le conteneur avec tous les ports forwardé sur l’hôte :

```bash
docker run -d \
 -p 25:25 \
 -p 53:53/udp \
 -p 80:80 \
 -p 443:443 \
 -p 465:465 \
 -p 993:993 \
 -p 5222:5222 \
 -p 5269:5269 \
 -p 5290:5290 \
 yunohost/full \
 /sbin/init
```

Plus d'information sur la documentation de Docker :
* http://docs.docker.com/reference/commandline/cli/#run
* http://docs.docker.com/userguide/dockerlinks/


---

## Post-installation

Récupérez l'adresse IP du conteneur (normalement quelque chose comme 172.17.0.x)

```bash
docker inspect --format '{{ .NetworkSettings.IPAddress }}' <CONTAINER_ID>
```

Rendez-vous ensuite sur https://ip.du.conteneur et procédez à la [post-installation](/postinstall_fr)

---

## Commandes utiles

Snapshoter l'état d'un container

```bash
docker commit <ID_de_mon_conteneur> LeNomQueJeVeux
# Exemple : docker commit 3e85317430db yunohost/full:27042015
```

Assigner une IP à un container

```bash
# Vous avez besoin d'iptables, et avoir activé l'IP forwarding sur votre système
iptables -t nat -A PREROUTING -d <IP à allouer> -j DNAT --to-destination <IP conteneur docker>
iptables -t nat -A POSTROUTING -s '<IP conteneur docker>/32' -o eth0 -j SNAT --to-source <IP à allouer>
# Attention à l'interface (ici eth0)
```

Se connecter à un conteneur démarré

```bash
docker exec -t -i <ID_de_mon_conteneur> /bin/bash
```
