# Docker et YunoHost

*Voici une page de documentation en guise de mémo sur la manière de tester/développer YunoHost avec Docker.*

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install_fr)**.*

<img src="https://yunohost.org/images/docker.png" width=250>

---

## Installer Docker

**Prérequis** : une machine x86 qui tourne sous Ubuntu 14.04 ou supérieur, ArchLinux ou Fedora (sur Debian c’est plus chiant).

Sous Ubuntu :
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

Passez **root** :
```bash
$ sudo -i
```

Lancer le démon docker avec une des commande ci-dessous :
```bash
service docker start
systemctl start docker
docker -d
```
---

## Installer le conteneur YunoHost

La commande suivante va télécharger l’image YunoHost pré-construite :
```bash
docker pull zamentur/yunohost-stable8
```

Vous pouvez également construire le conteneur manuellement :
```bash
docker build -t zamentur/yunohost-stable8 github.com/YunoHost/Dockerfile
```

Vous pouvez vérifier que le conteneur est bien téléchargé avec la commande `docker images`

---

## Démarrer le conteneur

Pour démarrer le conteneur, lancez la commande suivante en remplaçant DOMAIN par un domaine valide ex: mondomaine.org => yunohost.mondomaine.org
```bash
docker run -h yunohost.DOMAIN -v $(pwd):/yunohost -d zamentur/yunohost-stable8 /sbin/init
```

Si vous souhaitez démarrer le conteneur avec tous les ports forwardés sur l’hôte :

```bash
docker run -d -h yunohost.DOMAIN -v $(pwd):/yunohost \
 -p 25:25 \
 -p 53:53/udp \
 -p 80:80 \
 -p 443:443 \
 -p 465:465 \
 -p 993:993 \
 -p 5222:5222 \
 -p 5269:5269 \
 -p 5290:5290 \
 zamentur/yunohost-stable8 \
 /sbin/init
```

Plus d’information sur la documentation de Docker :
* http://docs.docker.com/reference/commandline/cli/#run
* http://docs.docker.com/userguide/dockerlinks/


---

## Post-installation
Entrer dans le container en remplaçant XXXX par l'id obtenu lors du docker run
```bash
docker exec -t -i XXXX /bin/bash
```
Puis lancez la postinstall avec le script dédié à docker
```bash
postinstall
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
# Exemple : docker commit 3e85317430db zamentur/yunohost-stable8:27042015
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
