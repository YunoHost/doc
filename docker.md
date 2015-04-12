# Docker and YunoHost

*Here is a small memo-documentation page on how to test/develop YunoHost with Docker.*

*Find other ways to install YunoHost **[here](/install)**.*

<img src="https://yunohost.org/images/docker.png" width=250>

---

## Install Docker

**Pre-requisite** : A x86 computer under Ubuntu 14.04 (or above), or ArchLinux.

On Ubuntu :
```bash
curl -s https://get.docker.io/ubuntu/ | sudo sh
```

On ArchLinux :
```bash
sudo pacman -Sy docker
```

**Note:** You may have to start Docker's daemon manually (as root: `service docker start`, `systemctl start docker` or simply `docker -d`)

---

## Build the YunoHost container

The following command will fetch the latest YunoHost built image:
```bash
docker pull yunohost/full
```

You can also build the image manually:
```bash
docker build -t yunohost/full github.com/YunoHost/Dockerfile
```

You can check that the container is successfully built with the `docker images` command.

---

## Run the container

```bash
docker run -d yunohost/full /sbin/init
```

If you want to run the container and forward all the interesting ports to the host:
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

You can find more information on these steps on the Docker's documentation:
* http://docs.docker.com/reference/commandline/cli/#run
* http://docs.docker.com/userguide/dockerlinks/

---

## Post-installation

Find your container's IP address (should looks like 172.17.0.x)

```bash
docker inspect --format '{{ .NetworkSettings.IPAddress }}' <CONTAINER_ID>
```

Then reach https://ip.du.conteneur on your web browser, and proceed to the [post-installation](/postinstall) step.

---

## Useful commands

Snapshot container's state

```bash
docker commit <container_ID> yunohost/full:tag
# E.g.: docker commit 3e85317430db yunohost/full:03052014
```

Assign an IP to a container

```bash
# You will need iptables, and to activate IP forwarding on your system
iptables -t nat -A PREROUTING -d <IP.to.assign> -j DNAT --to-destination <container.IP>
iptables -t nat -A POSTROUTING -s '<container.IP>/32' -o eth0 -j SNAT --to-source <IP.to.assign>
# Be careful on the network interface (here eth0)
```

Log in a YunoHost running container

```bash
# Otherwise, with docker
docker exec -t -i <container_ID> /bin/bash
```
