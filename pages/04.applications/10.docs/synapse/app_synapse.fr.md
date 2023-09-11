---
title: Synapse
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_synapse'
---

[![Installer Synapse avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=synapse) [![Integration level](https://dash.yunohost.org/integration/synapse.svg)](https://dash.yunohost.org/appci/app/synapse)

*Synapse* est un serveurs de messagerie instantanée.
Chatroom de YunoHost avec Matrix : [https://matrix.to/#/#yunohost:matrix.org](https://matrix.to/#/#yunohost:matrix.org)

### Avertissements / informations importantes

### Configuration

#### Installation sur les architectures ARM (ou architectures lentes)

Pour toutes les architectures lentes ou ARM, il est recommandé de construire le fichier dh avant l'installation pour avoir une installation plus rapide.
Vous pouvez le construire par cette commande : `openssl dhparam -out /etc/ssl/private/dh2048.pem 2048 > /dev/null`
Après cela, vous pouvez l'installer sans problème.

Le paquet utilise un environnement virtuel python préétabli. Les binaires proviennent du dépôt suivant : https://github.com/Josue-T/synapse_python_build
Le script pour construire les binaires est également disponible.

#### Client Web

Si vous voulez un client web, vous pouvez aussi installer Element avec ce paquet : https://github.com/YunoHost-Apps/element_ynh.

#### Accès par une fédération

Si le nom de votre serveur est identique au domaine sur lequel Synapse est installé, et que le port par défaut 8448 est utilisé, votre serveur est normalement déjà accessible par la fédération.

Si ce n'est pas le cas, vous pouvez ajouter la ligne suivante dans la configuration dns mais vous n'en avez normalement pas besoin car un fichier .well-known est édité pendant l'installation pour déclarer le nom et le port de votre serveur à la fédération.

```
_matrix._tcp.<server_name.tld> <ttl> IN SRV 10 0 <port> <domain-or-subdomain-of-synapse.tld>
```

Par exemple :

```
_matrix._tcp.example.com. 3600    IN      SRV     10 0 SYNAPSE_PORT synapse.example.com.
```

Vous devez remplacer `SYNAPSE_PORT` par le port réel. Ce port peut être obtenu par la commande : `yunohost app setting SYNAPSE_INSTANCE_NAME synapse_tls_port`

Pour plus de détails, voir : https://github.com/matrix-org/synapse/blob/master/docs/federate.m

Si cela ne se fait pas automatiquement, vous devez l'ouvrir dans la box de votre FAI.

Vous avez également besoin d'un certificat TLS valide pour le domaine utilisé par synapse. Pour ce faire, vous pouvez vous référer à la documentation ici : https://yunohost.org/fr/certificate

#### Turnserver

Pour la VoIP et la vidéoconférence, un turnserver est également installé (et configuré). Le turnserver écoute sur deux ports UDP et TCP. Vous pouvez les obtenir avec ces commandes :

```
yunohost app setting synapse turnserver_tls_port
yunohost app setting synapse turnserver_alt_tls_port

```

Le turnserver choisira également un port de manière dynamique lorsqu'un nouvel appel est lancé. La plage est comprise entre 49153 et 49193.

Pour des raisons de sécurité, la plage de ports (49153-49193) n'est pas automatiquement ouverte par défaut. Si vous souhaitez utiliser le serveur synapse pour la voix ou la conférence, vous devrez ouvrir cette plage de ports manuellement. Pour ce faire, il suffit d'exécuter cette commande :

```
yunohost firewall allow Both 49153:49193
```

Vous devrez peut-être aussi ouvrir ces ports (si cela n'est pas fait automatiquement) sur la box de votre FAI.

Pour éviter la situation où le serveur est derrière un NAT, l'IP publique est écrite dans la configuration du turnserver. De cette façon, le turnserver peut envoyer son IP publique réelle au client. Pour plus d'informations, voir [l'exemple de fichier de configuration de coturn](https://github.com/coturn/coturn/blob/master/examples/etc/turnserver.conf#L102-L120). Donc si votre IP change, vous pouvez exécuter le script `/opt/yunohost/__SYNAPSE_INSTANCE_NAME__/Coturn_config_rotate.sh` pour mettre à jour votre configuration.

Si vous avez une adresse IP dynamique, vous pouvez aussi avoir besoin de mettre à jour cette configuration automatiquement. Pour cela, éditez simplement un fichier nommé `/etc/cron.d/coturn_config_rotate` et ajoutez le contenu suivant (adaptez juste le `__SYNAPSE_INSTANCE_NAME__` qui pourrait être `synapse` ou peut-être `synapse__2`).

```
*/15 * * * * root bash /opt/yunohost/__SYNAPSE_INSTANCE_NAME__/Coturn_config_rotate.sh;
```

##### OpenVPN

Dans le cas où vous avez un serveur OpenVPN, vous pouvez vouloir que `coturn-synapse` redémarre quand le VPN redémarre. Pour ce faire, créez un fichier nommé `/usr/local/bin/openvpn_up_script.sh` avec ce contenu :

```
#!/bin/bash

(
    sleep 5
    sudo systemctl restart coturn-synapse.service
) &
exit 0
```

Ajouter cette ligne dans le fichier de configuration sudo `/etc/sudoers`

```
openvpn    ALL=(ALL) NOPASSWD: /bin/systemctl restart coturn-synapse.service
```

Et ajoutez cette ligne dans votre fichier de configuration OpenVPN

```
ipchange /usr/local/bin/openvpn_up_script.sh
```

#### Remarque importante sur la sécurité

Nous ne recommandons pas d'exécuter Element à partir du même nom de domaine que votre serveur domestique Matrix (Synapse). La raison en est le risque de vulnérabilité XSS (cross-site-scripting) qui pourraient se produire si quelqu'un faisait en sorte que Element charge et rende contenu malveillant généré par l'utilisateur à partir d'une API Matrix qui a ensuite un accès de confiance à Element (ou à d'autres applications) en raison du partage du même domaine.

Nous avons mis en place des mesures d'atténuation sommaires pour essayer de nous protéger contre cette situation, mais ce n'est toujours pas une bonne pratique de le faire en premier lieu. Voir https://github.com/vector-im/element-web/issues/1977 pour plus de détails.

### Caractéristiques spécifiques à YunoHost

### Limitations

Synapse utilise beaucoup de ressources. Ainsi, sur une architecture lente (comme une petite carte ARM), cette application pourrait prendre beaucoup de CPU et de RAM.

Cette application ne fournit pas une bonne interface web. Il est donc recommandé d'utiliser le client Element pour se connecter à cette application. Cette application est disponible [ici] (https://github.com/YunoHost-Apps/element_ynh)

### Informations supplémentaires

#### Support multi-instan

Pour avoir la possibilité d'avoir plusieurs domaines, vous pouvez utiliser plusieurs instances de synapse. Dans ce cas, toutes les instances fonctionneront sur des ports différents, il est donc très important de mettre un enregistrement SRV dans votre domaine. Vous pouvez obtenir le port que vous devez mettre dans votre enregistrement SRV avec la commande suivante 

```
yunohost app setting synapse__<instancenumber> synapse_tls_port
```

Avant d'installer une deuxième instance de l'application, il est vraiment recommandé de mettre à jour toutes les instances existantes.

## Liens utiles

+ Site web : [matrix.org](https://matrix.org/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/synapse](https://github.com/YunoHost-Apps/synapse_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/synapse/issues](https://github.com/YunoHost-Apps/synapse_ynh/issues)
