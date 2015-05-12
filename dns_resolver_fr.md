# Configurer et utiliser le service DNS de votre serveur Yunohost

## Description
Yunohost est installé avec un service DNS pour la résolution des noms de domaine. En général, votre serveur n'est pas configuré, c'est celui de votre FAI.
Par exemple pour une Freebox la résolution se fait par 192.168.0.254. Comment savoir: visualiser le contenu du fichier /etc/resolv.conf. Ce fichier n'est pas modifiable car réécrit par le service DHCP.
Un client DHCP est configuré, celui-ci intéroge votre routeur pour les adresses IP de vos serveurs de résolution de DNS. Ces IPs sont fournis par votre FAI.

##Modification
Afin d'utiliser votre DNS resolver de votre Yunohost (votre serveur), il faut modifier la configuration DHCP pour ne pas requeter votre routeur. Il faut donc mettre de façon statique la nouvelle adresse à savoir dans ce cas *127.0.0.1*
Editer le fichier */etc/dhcp/dhclient.conf*, ajouter une ligne *supersede* et supprimer de la ligne *request* le mot *domain-name-servers*
<code>
...
supersede domain-name-servers 127.0.0.1, 192.168.0.254;
request subnet-mask, broadcast-address, time-offset, routers,
        domain-name, domain-search, host-name,
        dhcp6.name-servers, dhcp6.domain-search,
        netbios-name-servers, netbios-scope, interface-mtu,
        rfc3442-classless-static-routes, ntp-servers;
...
</code>
Afin de prendre en compte la modification rebooter le serveur. (TODO: il doit être possible de reconfigurer à chaud, mais ca n'a pas marcher)
Il est possible de faire la meme modification sur toutes vos machines du réseau local en remplacant 127.0.0.1 par l'IP de votre serveur.
