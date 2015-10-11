# Docker and YunoHost

*Here is a small memo-documentation page on how to test/develop YunoHost with Docker.*

*Find other ways to install YunoHost **[here](/install)**.*

<img src="https://yunohost.org/images/docker.png" width=250>

---

## Install Docker

**Pre-requisite**: a x86 computer under Ubuntu 14.04 (or above), or ArchLinux.

On Ubuntu :
```bash
curl -s https://get.docker.io/ubuntu/ | sudo sh
```

On ArchLinux :
```bash
sudo pacman -Sy docker
```

**Note:** you may have to start Docker's daemon manually (as root: `service docker start`, `systemctl start docker` or simply `docker -d`)

---

## Build the YunoHost container

The following command will fetch the latest YunoHost built image:
```bash
docker pull zamentur/yunohost-stable8
```

You can also build the image manually:
```bash
docker build -t zamentur/yunohost-stable8 github.com/YunoHost/Dockerfile
```

You can check that the container is successfully built with the `docker images` command.

---

## Run the container
To start the container, run the next command by replacing DOMAIN by a valid domain eg: exemple.com => yunohost.exemple.com
```bash
docker run -h yunohost.DOMAIN -v $(pwd):/yunohost -d zamentur/yunohost-stable8 /sbin/init
```

If you want to run the container and forward all the interesting ports to the host:

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

You can find more information on these steps on the Docker's documentation:
* http://docs.docker.com/reference/commandline/cli/#run
* http://docs.docker.com/userguide/dockerlinks/

---

## Post-installation
Go in the container by replacing XXXX by the id obtained when `docker run`
```bash
docker exec -t -i XXXX /bin/bash
```
Next run postinstall with the dedicated script to docker
```bash
postinstall
```


---

## Useful commands


Find your container's IP address (should looks like 172.17.0.x)

```bash
docker inspect --format '{{ .NetworkSettings.IPAddress }}' <CONTAINER_ID>
```


Snapshot container's state

```bash
docker commit <container_ID> zamentur/yunohost-stable8:tag
# E.g.: docker commit 3e85317430db zamentur/yunohost-stable8:03052014
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
