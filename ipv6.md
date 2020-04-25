# Guide to setup IPv6 on your server.

## With a VPS from OVH

OVH give one IPv4 address and one IPv6 address for VPS but by default, only IPv4 is OK.
The OVH's documentation is here : https://docs.ovh.com/gb/en/vps/configuring-ipv6/

### Configure the DNS server
Here : https://yunohost.org/#/dns_subdomains

### Configure the server

On the OVH panel, you will copy two element :
- the IPv6 address
- the IPv6 gateway address
And you need the prefix. On OVH's VPS SSD, prefix are /128 because you have only one IPv6 address.

On you're VPS create a backup of the file with : ''cp /etc/network/interfaces ~/interfaces'' in home directory.
Then, you can edit the configuration file (''/etc/network/interfaces) :

    iface <you're interface name, e.g 'eth0'> inet6 static
    address <you're IPv6 address>
    netmask <you're IPv6 prefix>
    post-up /sbin/ip -6 route add <the IPv6 gateway> dev <you're interface name, e.g 'eth0'>
    post-up /sbin/ip -6 route add default via <the IPv6 gateway> dev <you're interface name, e.g 'eth0'>
    pre-down /sbin/ip -6 route del default via <the IPv6 gateway> dev <you're interface name, e.g 'eth0'>
    pre-down /sbin/ip -6 route del <the IPv6 gateway> dev <you're interface name, e.g 'eth0'>

Now, save the file and restart the network service with : ''service networking restart''.

Check your configuration with these commands :
- ''ip a'' to display address with interfaces
- ''hostname -I'' to display address of the system
- do a ping to a IPv6 serveur (for example you can use yunohost.org)
- do a ping on your PC to your serveur

If it's ok, it's ok !
