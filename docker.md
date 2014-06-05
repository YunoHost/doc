# Docker and YunoHost

*Here is a small memo-documentation page on how to test/develop YunoHost with Docker.*

*Find other ways to install YunoHost **[here](/install)**.*

<img src="https://yunohost.org/images/docker.png" width=250>

---

## Install Docker

**Pre-requisite** : A x86 computer under Ubuntu 12.04 (or above), or ArchLinux.

Under Ubuntu :
```bash
# 12.04 only
sudo apt-get update
sudo apt-get install linux-image-generic-lts-raring linux-headers-generic-lts-raring
sudo reboot

# In every cases
curl -s https://get.docker.io/ubuntu/ | sudo sh
```

Under ArchLinux :
```bash
sudo pacman -Sy docker
```

**Note:** You may have to start Docker's daemon manually (as root: `service docker start`, `systemctl start docker` or simply `docker -d`)

---

## Build the YunoHost container

The following command will fetch a Debian Wheezy base image, clone the YunoHost's install script in it, and run it.
```bash
docker build -t yunohost:init https://raw.githubusercontent.com/YunoHost/Kremlin/master/docker/Dockerfile
```

You can check that the container is successfully built with the `docker images` command.

---

## Run the container

```bash
docker run -d -t yunohost:init /sbin/init
```

This command will start a container based on the `yunohost` image (tag `init`) that you just created.    
You will then be able to [postinstall](/postinstall) all this by entering the container's IP address (`172.17.0.2` by default) into a web browser.

**Notice:** You may want to forward some of your container's ports, find more information or these pages:

* http://docs.docker.io/reference/commandline/cli/#run
* http://docs.docker.io/use/port_redirection/#port-redirection


---

## Advanced usage

Some useful commands:

### Snapshot container's state

```bash
docker commit <container_ID> yunohost:TheTagIWant
# Example : docker commit 3e85317430db yunohost:03052014
```

### Assign an IP to a container

```bash
# You will need iptables, and to activate IP forwarding on your system
iptables -t nat -A PREROUTING -d <IP.to.assign> -j DNAT --to-destination <container.IP>
iptables -t nat -A POSTROUTING -s '<container.IP>/32' -o eth0 -j SNAT --to-source <IP.to.assign>
# Be careful on the network interface (here eth0)
```

### Log in a YunoHost running container

```bash
# You will need:
# * your container's ID
docker ps -notrunc | grep yunohost
# * your container's PID
cat /var/lib/docker/execdriver/native/<container_ID>/pid
# * `util-linux` package
apt-get install util-linux || pacman -S util-linux

# Run the nsenter command with the right parameters
nsenter --target <PID> --mount --uts --ipc --net --pid /bin/bash
```
