#Chat, VoIP y red local con <img src="/images/XMPP_logo.png" width=100>

Yunohost está instalado con un servidor de mensajería instantánea Metronome que implementa el [protocolo  XMPP](https://es.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol).

XMPP es un protocolo abierto y extensible que también permite crear salones de discusión, compartir status y datos, echar llamadas en VoIP y hacer videoconferencias. 

Todas las aplicaciones basadas en XMPP son compatibles entre ellas : cuando utilizas un cliente XMPP puedes discutir con cualquier persona que tenga una cuenta XMPP/Jabber. Este protocolo ya es utilizado por millones de personas en el mundo. 

### Cuenta XMPP/Jabber

Una cuenta XMPP/Jabber está basada en un ID bajo la forma `usuario@dominio.tld`, así como una contraseña. La contraseña es la de la cuenta del usuario de Yunohost.

### Conectarse a XMPP

Existen varios clientes web de tipo red social, como :
- [Movim](https://pod.movim.eu)
- [Libervia/Salut à Toi](http://salut-a-toi.org/).

También puedes utilizar un cliente Desktop como : 
- [Pidgin](http://pidgin.im/) (multiplataformas), 
- [Gajim](http://gajim.org/index.fr.html) (Linux, Windows),
- [Dino](https://dino.im) (Linux),
- [Thunderbird](https://www.mozilla.org/fr/thunderbird/) (multiplataformas), 
- [Jitsi](http://jitsi.org/) (multiplataformas) 
- [Adium](https://adium.im/) (Mac OS).

... o un cliente smartphone :
* [Xabber](http://xabber.com) (Android)
* [Conversations](https://conversations.im/) (Android)
* [Movim sous Android](https://movim.eu)
* [Monal](https://itunes.apple.com/us/app/monal-free-xmpp-chat/id317711500?mt=8) (iOS)

Aquí tienes una lista más exhaustiva de clientes XMPP (fr) : https://fr.wikipedia.org/wiki/Liste_de_clients_XMPP

### Cifrar tu conversaciones con OMEMO :

Es posible cifrar tu conversaciones XMPP con la ayuda de [OMEMO](https://xmpp.org/extensions/xep-0384.html), por ejemplo utilizando Gajim :
* Instalar `gajim` y el plugin `gajim-omemo`
* Activar el plugin en `Tools > Plugins`
* Activar el cifrado en una conversación con un contacto que también tiene OMEMO activado.

### Salón de discusión 

Para crear un salón de discusión (Multi-user chat) en tu servidor Yunohost, utiliza el ID nombredelsalon@muc.dominio.tld (donde dominio.tld es el dominio principal de tu servidor).

Si utilizas un nombre de dominio personal, es necesario [añadir una redirección de tipo CNAME para el subdominio `muc.`](dns_config_es) en tu servidor DNS.

### VoIP y videoconferencias

Un buen medio de llamar a un contacto XMPP en VoIP o en llamada video, es utilizar el cliente [Jitsi](http://jitsi.org/).
