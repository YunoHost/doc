# Docker and YunoHost

*Here is a small memo-documentation page on how to test/develop YunoHost with Docker.*

*Find other ways to install YunoHost **[here](/install)**.*

<img src="/images/docker.png" width=250>

---

## Install Docker

**Pre-requisite**:
* a computer under Ubuntu, Debian, or ArchLinux ...
* ... **with systemd**
* a AMD64 (classic PC) or ARMHF computer (Raspberry PI V2 or V3)

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

## Get the YunoHost image

The following command will fetch the latest YunoHost built image for **amd64**:
```bash
docker pull domainelibre/yunohost
```

The following command will fetch the latest YunoHost built image for **armhf** (ex : Raspberry PI 2 ou 3):
```bash
docker pull domainelibre/yunohost-arm
```

## Build the YunoHost image

You can also build the image manually:

Please follow *Building* section [here](https://github.com/aymhce/YunohostDockerImage)

---

## Run the container

> **The linux docker host must run systemd**

> **WARN : --privileged mod is required for systemd**

To start the container, run the next command by replacing DOMAIN by a valid domain e.g.: example.com => yunohost.example.com
```bash
docker run -h yunohost.DOMAIN -v $(pwd):/yunohost -d --privileged \
-v /sys/fs/cgroup:/sys/fs/cgroup:ro domainelibre/yunohost /bin/systemd
```

If you want to run the container and forward all the interesting ports to the host:

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
yunohost tools postinstall
```


---

## Useful commands


Find your container's IP address (should looks like 172.17.0.x)

```bash
docker inspect --format '{{ .NetworkSettings.IPAddress }}' <CONTAINER_ID>
```


Snapshot container's state

```bash
docker commit <container_ID> yunohost:tag
# E.g.: docker commit 3e85317430db yunohost:20160530
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
