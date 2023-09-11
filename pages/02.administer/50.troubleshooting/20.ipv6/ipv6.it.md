---
title: Impostare IPv6
template: docs
taxonomy:
    category: docs
routes:
  default: '/ipv6'
---

IPv6 dovrebbe funzionare automaticamente in molti casi ma in alcune situzioni o con alcuni provider può essere necessario configurare alcune impostazioni direttamante per abilitarlo.

## Usando una VPS di OVH

OVH fornisce un indirizzo IPv4 e uno IPv6 ma di default funziona solo il primo.
La documentazione di OVH la puoi trovare qui: https://docs.ovh.com/gb/en/vps/configuring-ipv6/

### Configurare il server DNS

Qui : https://yunohost.org/#/dns_subdomains

### Configurare il server

Nella pagina di configurazione di OVH dovrai copiare questi 3 elementi:
- l'indirizzo IPv6
- l'indirizzo del gateway IPv6
- il prefisso IPv6. Nelle VPS SSD di OVH i prefissi sono `/128` perché hai a disposizione solo *uno* indirizzo IPv6.

Nella tua VPS crea un backup  della configurazione di rete con il comando: `cp /etc/network/interfaces ~/interfaces` nella directory home.
Poi puoi modificare il file di configurazione (`/etc/network/interfaces`) come indicato di seguito. Considera però che:

! In questo esempio si assume che il nome della tua interfaccia di rete sia `eth0`. Nel caso invece che sia differente (controlla con il comando `ip a`) devi adattare di conseguenza l'esempio qui sotto.

```plaintext
iface eth0 inet6 static
address <your IPv6 address>
netmask <your IPv6 prefix>
post-up /sbin/ip -6 route add <the IPv6 gateway> dev eth0
post-up /sbin/ip -6 route add default via <the IPv6 gateway> dev eth0
pre-down /sbin/ip -6 route del default via <the IPv6 gateway> dev eth0
pre-down /sbin/ip -6 route del <the IPv6 gateway> dev eth0
```

Now, save the file and restart the network service with : `service networking restart`. (TODO : ideally we should find a way to validate the content of the configuration, otherwise it could fuck up the network stack and get disconnected from the VPS ?)

Check your configuration with these commands :
- `ip a` to display network interfaces and addresses
- `hostname -I` to display the system IP addresses
- try to ping an IPv6 server (for example you can use `ping6 ip6.yunohost.org`)
- try to ping your server from your PC (assuming your PC has IPv6 enabled)

If it's ok, it's ok !
