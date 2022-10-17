---
title: Auto-alojamiento
template: docs
taxonomy:
    category: docs
routes:
  default: '/selfhosting'
---
<!--
L'auto-hébergement est le fait d'avoir et d'administrer son propre serveur, typiquement chez soi, pour héberger soi-même ses données personnelles et des services plutôt que de se reposer exclusivement sur des tiers. Par exemple, il est possible d'auto-héberger son blog de sorte qu'il "vive" dans une machine que vous contrôlez, au lieu qu'il soit sur l'ordinateur de quelqu'un d'autre (a.k.a. le Cloud) en échange d'argent, de publicités ou de données privées.
-->

El auto-alojamiento se refiere al hecho de tener y administrar tú tu propio servidor, normalmente en tu casa, para hospedar tus datos personales y servicios, en lugar de depender de terceros. Por ejemplo, es posible el auto-hospedaje de tu blog, de manera que este "viva" dentro de una máquina que controlas, en lugar de que se aloje en un ordenador de otra persona/empresa (alias La Nube) contra dinero, publicidad o cesión de datos privados.

<!--
L'auto-hébergement implique de disposer d'un serveur. Un serveur est un ordinateur qui est destiné à être accessible sur le réseau en permanence, et n'a généralement pas d'écran ni de clavier puisqu'il est administré à distance. Contrairement à une croyance répandue, les serveurs ne sont pas nécessairement des machines énormes et extrêmement puissantes : aujourd'hui, une petite carte ARM à ~30€ est adéquate pour de l'auto-hébergement.
-->

Auto-alojar implica disponer de un servidor. Un servidor es un ordenador destinado a ser accesible en la red las 24 horas del día y que normalmente no tiene ni pantalla ni teclado, ya que se controla a distancia. Contrariamente a una creencia extendida, los servidores no son necesariamente máquinas enormes y muy potentes: en la actualidad, una pequeña placa ARM de unos ~30€/$ es suficiente para el auto-hospedaje.
<!--
Pratiquer l'auto-hébergement ne rend pas "votre internet" plus sécurisé et ne fournit pas d'anonymat en tant que tel. L'objectif est généralement de pouvoir être autonome et au contrôle de ses services et de ses données - ce qui implique aussi d'en être responsable.
-->

La práctica del auto-alojamiento no convierte "tu internet" más segura y tampoco proporciona anonimato por si mismo. El objetivo es generalmente generar autonomía y control de tus servicios y tus datos - lo que también implica una responsabilidad.

## ¿Cuáles son los beneficios del auto-alojamiento?

<!-- 
- **Vous croyez en un internet libre, ouvert et décentralisé.** Dans un internet centralisé, les entités privées et les gouvernements peuvent espionner, analyser et influencer les personnes en dictant la façon dont elle peuvent interagir les unes avec les autres, ainsi qu'en filtrant du contenu. YunoHost est développé par une communauté qui croit en un internet ouvert et décentralisé. Nous espérons que vous aussi !
-->
- **Crées en una internet libre, abierta y descentralizada.** En una internet centralizada, entidades privadas y gobiernos pueden espiar, analizar e influir en nosotras dictando como iteraccionamos entre nosotras o filtrando contenidos. A YunoHost lo desarrolla por una comunidad que cree en una internet abierta y descentralizada. ¡Esperamos que tú también!

<!-- 
- **Vous voulez avoir le contrôle de vos données et services.** Vos images, vos messages de chat, votre historique de navigation, et votre dissertation pour l'école n'ont rien à faire sur l'ordinateur de quelqu'un d'autre (a.k.a. le Cloud). Ces données font partie de votre vie privée, mais également de celle de votre famille, de vos amis, etc. Ces données devraient être gérées par *vous*, et non par une quelconque entreprise américaine qui cherche à analyser vos données pour revendre les résultats.
-->
- **Quieres tener control de tus datos y servicios.** Tus fotos, mensajes de chat, el historial de navegación y ese trabajo del colegio no tienen nada que hacer en el ordenador de otra persona (alias La Nube). Esos datos forman parte de tu vida privada, pero también de la de tu familia, de tus amistades, etc. Estos datos deberían ser gestionados por *ti*, y no por una empresa americana cualquiera que busca analizar tus datos para vender los resultados.

<!--
- **Vous souhaitez apprendre comment fonctionnent les ordinateurs et Internet.** Opérer son propre serveur est un bon contexte pour apprendre les mécanismes de base au cœur des systèmes d'exploitation (OS) et d'Internet. Il vous faudra possiblement toucher à la ligne de commande et à des morceaux de configuration réseau et DNS.
 -->
- **Quieres aprender cómo funcionan los ordenadores e internet.** Operar tu propio servidor es un ejercicio muy enriquecedor para entender los mecanismos básicos en el corazón de los sistemas operativos y de internet. Es posible que tengas que escribir en la línea de comandos o a segmentos de configuración de la red y de DNS.

<!--
- **Vous voulez explorer de nouvelles possibilités et personnaliser votre espace.** Avez-vous déjà rêvé d'avoir votre propre serveur Minecraft pour vos ami·e·s, ou un client IRC ou XMPP persistant ? Avec votre propre serveur, vous pouvez manuellement installer et faire tourner n'importe quel programme et personnaliser chaque morceau.
-->

- **Quieres explorar las nuevas posibilidades y personalizar tu espacio.** ¿Alguna vez has soñado con tener tu propio servidor de Minecraft para jugar con tus amistades, o un cliente sw IRC o XMPP persistente? Con tu propio servidor, puedes instalar manualmente y ejecutar prácticamente cualquier programa que quieras y personalizar cada parte.

## ¿Qué implica el auto-alojamiento?

<!--
- **L'auto-hébergement requiert du travail et de la patience.** S'auto-héberger est un peu comme avoir son propre jardin ou potager : cela demande du travail et de la patience. Bien que YunoHost cherche à faire tout le travail compliqué pour vous, il vous faudra tout de même prendre le temps d'apprendre et configurer quelques détails pour que votre installation marche correctement. Il vous faudra aussi gérer quelques tâches de maintenance (telles que les mises à jour) de temps en temps, et demander de l'aide si des choses ne fonctionnent pas comme prévu.
-->
- **Auto-alojarse requiere del trabajo y de la paciencia.** Auto-alojarte es algo parecido a cultivar tu propio jardín o huerto: requiere del trabajo y de la paciencia. Mientras que YunoHost pretende hacer todo el trabajo duro por ti, necesitarás tomarte el tiempo para aprender y configurar pequeños detalles para que tu instalación funcione correctamente. También necesitarás realizar algunas tareas de mantenimiento (como actualizaciones) de vez en cuando, o pedir soporte si las cosas no funcionan.

<!--
- **Avec de grands serveurs viennent les grandes responsabilités.** Opérer un serveur implique d'être responsable des données que vous hébergez : personne ne pourra récupérer des données à votre place si vous les perdez. YunoHost fournit des fonctionnalités de sauvegarde qu'il est recommandé d'utiliser pour sauvegarder les configurations et données importantes. Il vous faut aussi garder un œil sur les recommandations et les nouvelles à propos de la sécurité pour que votre serveur ou vos données ne soient pas compromises.
-->
- **Un gran servidor conlleva una gran responsabilidad.** Operar un servidor significa que eres responsable de los datos que alojas. Nadie podrá recuperarlos por ti si se pierden. YunoHost proporciona funciones de copia de seguridad, que es recomendable utilizar regularmente para hacer copias de seguridad de las configuraciones y de los datos importantes. También deberías echar un ojo a las noticias y recomendaciones de seguridad, para que tu servidor o tus datos no se vean comprometidos.

<!--
- **La qualité et les performances ne seront probablement pas aussi bonnes que des services premium.** YunoHost (et la plupart des applications qui sont packagées) sont des logiciels libres et open-source, développés par des communautés bénévoles. Il n'y a pas de garantie absolue que ces logiciels fonctionneront dans toutes les circonstances possibles. Les performances de votre serveur auto-hébergé sont aussi liées au processeur, à la mémoire vive et à la connectivité internet.
-->
- **La calidad y el rendimiento probablemente no serán tan buenos como los de los servicios "premium".** YunoHost (y la mayoría de las aplicaciones empaquetadas) son programas libres basados de código abierto, desarrollados por comunidades de personas de manera voluntaria. No hay garantía absoluta de que el software funcione en todas las circunstancias posibles. El rendimiento de su servidor autohospedado también está relacionado con su procesador, a la memoria RAM y la conectividad a internet.