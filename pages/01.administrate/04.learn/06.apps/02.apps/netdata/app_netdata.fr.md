---
title: NetData
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_netdata'
---

[NetData](http://my-netdata.io/) est un système distribué de **surveillance des performances et de la santé en temps réel**.
Il fournit un **aperçu inégalé, en temps réel**, de tout ce qui se passe sur lesystème qu'il exécute (y compris les applications telles que les serveurs web et de base de données), en utilisantdes **tableaux de bord modernes et interactifs sur le web**.

_netdata est **rapide** et **efficient**, conçu pour fonctionner en permanence sur tous les systèmes (serveurs **physiques** et **virtuels**, **conteneurs**, **dispositifs IoT**), sans en perturbant leur fonction principale.

[![Install Netdata with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=netdata)

**Personnalisation apportée par le paquet:**

* Accorde l'accès aux statistiques MySQL via un utilisateur `netdata`.
* Statistiques du journal racine NGINX en mettant l'utilisateur `netdata` dans le groupe `adm`.
* Statistiques Dovecot via l'accès aux statistiques de Dovecot pour l'utilisateur `net data` (fonctionne uniquement avec Dovecot 2.2.16+).

**Autres recommandations:**
Nous n'autorisons pas les paquets YunoHost à apporter des modifications sensibles aux fichiers du système. Voici donc d'autres personnalisations que vous pouvez faire pour permettre une meilleure surveillance :

* NGINX: 
  * Requêtes et connexions : suivez [ces recommandations](https://github.com/firehol/netdata/tree/master/python.d#nginx) pour activer `/stab_status` (par exemple en mettant la section `location` dans `/etc/nginx/conf.d/yunohost_admin.conf`).
  * Journaux web : vous pouvez surveiller tous vos journaux web (weblogs) NGINX pour détecter les erreurs ; suivez [ces recommandations](https://github.com/firehol/netdata/tree/master/python.d#nginx_log).
* PHP-FPM : suivez [ces recommandations](https://github.com/firehol/netdata/tree/master/python.d#phpfpm).

## Fonctionnalités

<p align="center">
<img src="https://cloud.githubusercontent.com/assets/2662304/19168687/f6a567be-8c19-11e6-8561-ce8d589e8346.gif"/>
</p>

 - Des **tableaux de bord interactifs époustouflants**<br/>
   souris et tactile, en 2 thèmes : sombre et clair.

 - **Rapide comme l'éclair**<br/>
   Répond à toutes les demandes en moins de 0,5 ms par métrique, même sur du matériel bas de gamme

 - **Haute efficacité**<br/>
   Collecte des milliers de mesures par serveur et par seconde, avec seulement 1% d'utilisation d'un seul cœur du processeur, quelques Mo de RAM et aucune E/S de disque.

 - **Alarme sophistiquée**<br/>
   Des centaines d'alarmes, **prête à l'emploi**!<br/>
   Prend en charge les seuils dynamiques, l'hystérésis, les modèles d'alarme, plusieurs méthodes de notification basées sur les rôles (comme le courriel, slack.com, pushover.net, pushbullet.com, telegram.org, twilio.com, messagebird.com).

 - **Extensible**<br/>
   Vous pouvez surveiller tout ce pour quoi vous pouvez obtenir une métrique, en utilisant son API de plugin (tout peut être un plugin NetData, BASH, Python, Perl, Node.JS, Java, Go, Ruby, etc.).

 - **Intégrable**<br/>
   Il peut fonctionner partout où un noyau Linux fonctionne (même IoT), et ses graphiques peuvent également être intégrés à vos pages web.

 - **Personnalisable**<br/>
   Des tableaux de bord personnalisés peuvent être construits en utilisant du HTML simple (pas de JavaScript nécessaire).

 - **Zéro configuration**<br/>
   Détecte tout automatiquement, il peut collecter jusqu'à 5000 mesures par serveur dès son lancement.

 - **Zéro dépendance**<br/>
   Il est même son propre serveur web, pour ses fichiers web statiques et son API web.

 - **Zéro maintenance**<br/>
   Vous le lancez, il fait le reste.

 - **S'échelonne à l'infini**<br/> 
   En exigeant un minimum de ressources centrales.

 - **Plusieurs modes de fonctionnement**<br/>
   Surveillance autonome de l'hôte, collecteur de données sans tête, proxy de transfert, proxy de stockage et de transfert, surveillance centrale de plusieurs hôtes, dans toutes les configurations possibles.
   Chaque nœud peut avoir une politique différente de rétention des données et fonctionner avec ou sans surveillance de la santé.

 - **Support des back-ends de séries chronologiques**<br/>
   Peut archiver ses mesures sur les bases de données de documents `graphite`, `opentsdb`, `prometheus`, ou sur les bases de données de documents JSON, avec le même niveau de détail ou un niveau inférieur (Inférieur : pour éviter qu'il n'encombre ces serveurs en raison de la quantité de données collectées).

![netdata](https://cloud.githubusercontent.com/assets/2662304/14092712/93b039ea-f551-11e5-822c-beadbf2b2a2e.gif)

---

## Qu'est-ce qu'il surveille ?

NetData collecte plusieurs milliers de mesures par appareil.
Toutes ces mesures sont collectées et visualisées en temps réel.

> _Presque toutes les métriques sont auto-détectées, sans aucune configuration._

Voici une liste de ce qu'il surveille actuellement :

- **Processeur central (CPU)**<br/>
  Utilisation, interruptions, softirqs, fréquence, total et par cœur, états du CPU.

- **Mémoire**<br/>
  RAM, utilisation de la mémoire du noyau et de la swap, KSM (Kernel Samepage Merging), NUMA.

- **Disques**<br/>
  Par disque : E/S, opérations, fille d'attente, utilisation, espace, RAID logiciel (md).

   ![sda](https://cloud.githubusercontent.com/assets/2662304/14093195/c882bbf4-f554-11e5-8863-1788d643d2c0.gif)

- **Interfaces réseau**<br/>
  Par interface : bande passante, paquets, erreurs, rejets.

   ![dsl0](https://cloud.githubusercontent.com/assets/2662304/14093128/4d566494-f554-11e5-8ee4-5392e0ac51f0.gif)

- **Réseautage IPv4**<br/>
  Bande passante, paquets, erreurs, fragments,
  TCP : connexions, paquets, erreurs, poignée de main,
  UDP : paquets, erreurs,
  Diffusion : bande passante, paquets,
  Multidiffusion : bande passante, paquets.

- **Réseautage IPv6**<br/>
  Bande passante, paquets, erreurs, fragments, ECT,
  UDP : paquets, erreurs,
  UDP-Lite : paquets, erreurs,
  Diffusion : bande passante,
  Multidiffusion : bande passante, paquets,
  ICMP : messages, erreurs, échos, routeur, voisin, MLDv2, appartenance à un groupe,
  ventiler par type.

- **Communication inter-processus - IPC**<br/>
  Tels que les sémaphores et les réseaux de sémaphores.

- **netfilter / iptables Linux firewall**<br/>
  Connexions, événements de suivi des connexions, erreurs.

- **Protection DDoS de Linux**<br/>
  Mesures de la SYNPROXIE.

- **latences fping**</br>
  Pour toute quantité d'hôtes, en indiquant la latence, les paquets et la perte de paquets.

   ![image](https://cloud.githubusercontent.com/assets/2662304/20464811/9517d2b4-af57-11e6-8361-f6cc57541cd7.png)


- **Processus**<br/>
  En fonctionnement, bloqué, bifurqué, actif.

- **Entropie**<br/>
  Le pool de nombres aléatoires, utilisé en cryptographie.

- **Serveurs et clients de fichiers NFS**<br/>
  NFS v2, v3, v4 : E/S, cache, lecture anticipée, appels RPC.

- **Réseau QoS**<br/>
  le seul outil qui permet de visualiser les classes du réseau `tc` en temps réel.

   ![qos-tc-classes](https://cloud.githubusercontent.com/assets/2662304/14093004/68966020-f553-11e5-98fe-ffee2086fafd.gif)

- **Groupes de contrôle de Linux**<br/>
  Conteneurs : systemd, lxc, docker.

- **Applications**<br/>
  En regroupant l'arbre des processus et en signalant l'utilisation du processeur, de la mémoire, la lecture des disques, l'écritures des disques, l'échange, les fils, les pipes, les prises - par groupe.

   ![apps](https://cloud.githubusercontent.com/assets/2662304/14093565/67c4002c-f557-11e5-86bd-0154f5135def.gif)

- **Utilisation des ressources par les utilisateurs et les groupes d'utilisateurs**<br/>
  En résumant l'arbre de processus par utilisateur et par groupe, rapportant : processeur central, mémoire, lecture de disque, écriture de disque, échange (swap), fils, pipes, et sockets.

- **Serveurs web Apache et lighttpd**<br/>
   `mod-status` (v2.2, v2.4) et statistiques des journaux de cache, pour plusieurs serveurs.

- **Serveurs web NGINX**<br/>
  `stub-status`, pour plusieurs serveurs.

- **Tomcat**<br/>
  Accès, files, mémoire libre, volume.

- **Fichiers journaux du serveur web**<br/>
  Extrayant en temps réel les mesures de performance du serveur web et appliquant plusieurs contrôles de santé.

- **Bases de données MySQL**<br/>
  Plusieurs serveurs, chacun indiquant : bande passante, requêtes/s, gestionnaires, verrous, problèmes,
  opérations tmp, connexions, métriques binlog, files, métriques innodb, et plus.

- **Bases de données Postgres**<br/>
  Plusieurs serveurs, chacun affichant : par base de données des statistiques (connexions, tuples
  lecture - écriture - rendu, transactions, verrous), les processus d'arrière-plan, les index,
  les tables, l'écriture à l'avance, l'écriture de fond et plus encore.

- **Bases de données Redis**<br/>
  Plusieurs serveurs, chacun affichant : opérations, taux de réussite, mémoire, clés, clients, esclaves.

- **mongodb**<br/>
  Opérations, clients, transactions, curseurs, connexions, assertions, serrures, etc.

- **bases de données memcached**<br/>
  Plusieurs serveurs, chacun indiquant : bande passante, connexions, objets.

- **elasticsearch**<br/>
  les performances de recherche et d'indexation, la latence, les délais, les statistiques sur les grappes, les statistiques sur les fils, etc.

- **ISC Bind name servers**<br/>
  Plusieurs serveurs, chacun affichant : les clients, les demandes, les requêtes, les mises à jour, les échecs et plusieurs mesures par vue.

- **Serveurs de noms NSD**<br/>
  Les requêtes, les zones, les protocoles, les types de requêtes, les transferts, etc.

- **Serveurs de courrier électronique Postfix**<br/>
  La file d'attente des messages (entrées, taille)

- **Serveurs de courrier électronique Exim**<br/>
  La file d'attente des messages (e-mails en file d'attente)

- **Dovecot**<br/>
  Serveurs POP3/IMAP

- **ISC dhcpd**<br/>
  L'utilisation des pools, les baux, etc.

- **IPFS**<br/>
  La bande passante, les pairs.

- **Squid proxy servers**<br/>
  Plusieurs serveurs, chacun indiquant : la bande passante et les requêtes des clients, la bande passante des serveurs et les requêtes.

- **HAproxy**<br/>
  La bande passante, les sessions, les backends, etc.

- **varnish**<br/>
  Les fils, les sessions, les succès, les objets, les backends, etc.

- **OpenVPN**<br/>
  Le statut par tunnel.

- **Senseurs matériels**<br/>
  Capteurs `lm_sensors` et `IPMI` : température, tension, ventilateurs, puissance, humidité.

- **NUT et APC UPSes**<br/>
  La charge, la tension de la batterie, la température, les mesures d'utilité, et les mesures de sortie.

- **PHP-FPM**<br/>
  Plusieurs instances, chacune rapportant les connexions, les demandes, et les performances.

- **hddtemp**<br/>
  La température des disques.

- **smartd**<br/>
  Les valeurs S.M.A.R.T. des disques.

- **Dispositifs SNMP**<br/>
  Peuvent également être surveillés (bien que vous devez les configurer).

- **statsd**<br/>
  [netdata est un serveur statsd complet](https://github.com/firehol/netdata/wiki/statsd).

Et vous pouvez l'étendre, en écrivant des plugins qui collectent des données de n'importe quelle source, en utilisant n'importe quel langage informatique.

## Liens

 * Signaler un bogue : https://github.com/YunoHost-Apps/netdata_ynh/issues
 * Site web de NetData : http://my-netdata.io/
