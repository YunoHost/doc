# Configuration de la zone DNS

DNS (système de nom de domaine) est un élément essentiel d'Internet qui permet
de convertir des adresses compréhensible par les êtres humains (les noms de
domaines) en adresses compréhensibles par la machine (les IPs). Pour que
votre serveur soit facilement accessible par d'autres êtres humains, et pour
que certains services comme le mail fonctionnent correctement, il est nécessaire
de configurer la zone DNS de votre domaine.

Si vous utilisez un [domaine automatique](/dns_nohost_me_fr) fourni par le Projet Yunohost,
la configuration devrait être faite automatiquement. Si vous utilisez votre propre nom de domaine
(e.g. acheté chez un registrar), il vous faut configurer manuellement votre
domaine via l'interface de votre registrar.

## Configuration DNS recommandée
_NB : les exemples utilisent ici le texte `votre.domaine.tld`, à remplacer par votre propre domaine (par exemple `www.yunohost.org`)._

YunoHost fournit une configuration DNS recommandée, accessible via :
- la webadmin, dans Domaines > votre.domain.tld > Configuration DNS ;
- ou la ligne de commande, `yunohost domain dns-conf votre.domaine.tld`

Pour certains besoins ou installations particulières, et si vous savez ce que
vous faites, il vous faudra peut-être modifier cette recommandation ou ajouter
d'autres enregistrements (e.g. pour gérer des sous-domaines).

La configuration recommandée ressemble typiquement à :

```bash
#
# Enregistrements IPv4/IPv6 basiques
#
@ 3600 IN A 111.222.33.44
* 3600 IN A 111.222.33.44

# (Si votre serveur supporte l'IPv6, il a des enregistrements AAAA)
@ 3600 IN AAAA 2222:444:8888:3333:bbbb:5555:3333:1111
* 3600 IN AAAA 2222:444:8888:3333:bbbb:5555:3333:1111

#
# XMPP
#
_xmpp-client._tcp 3600 IN SRV 0 5 5222 votre.domaine.tld.
_xmpp-server._tcp 3600 IN SRV 0 5 5269 votre.domaine.tld.
muc 3600 IN CNAME @
pubsub 3600 IN CNAME @
vjud 3600 IN CNAME @

#
# Mail (MX, SPF, DKIM et DMARC)
#
@ 3600 IN MX 10 votre.domaine.tld.
@ 3600 IN TXT "v=spf1 a mx ip4:111.222.33.44 -all"
mail._domainkey 3600 IN TXT "v=DKIM1; k=rsa; p=uneGrannnnndeClef"
_dmarc 3600 IN TXT "v=DMARC1; p=none"
```

Mais il est peut-être plus facile de la comprendre si affichée de la façon
suivante :

| Type    | Nom                    | Valeur                                                 |
| :-----: | :--------------------: | :----------------------------------------------------: |
|  **A**  |   **@**                |  `111.222.333.444` (votre IPv4)                        |
|    A    |   *                    |  `111.222.333.444` (votre IPv4)                        |
|  AAAA   |   @                    |  `2222:444:8888:3333:bbbb:5555:3333:1111` (votre IPv6) |
|  AAAA   |   *                    |  `2222:444:8888:3333:bbbb:5555:3333:1111` (votre IPv6) |
| **SRV** | **_xmpp-client._tcp**  |  `0 5 5222 votre.domaine.tld.`                         |
| **SRV** | **_xmpp-server._tcp**  |  `0 5 5269 votre.domaine.tld.`                         |
|  CNAME  |   muc                  |  `@`                                                   |
|  CNAME  |   pubsub               |  `@`                                                   |
|  CNAME  |   vjud                 |  `@`                                                   |
| **MX**  | **@**                  |  `votre.domaine.tld.`     (et priorité: 10)            |
|   TXT   |   @                    |  `"v=spf1 a mx ip4:111.222.33.44 -all"`                |
|   TXT   |  mail._domainkey       |  `"v=DKIM1; k=rsa; p=uneGrannnndeClef"`                |
|   TXT   |  _dmarc                |  `"v=DMARC1; p=none"`                                  |

#### Quelques notes à propos de cette table

- Tous ces enregistrements ne sont pas nécessaires. Pour une installation minimale, seuls les enregistrements en gras sont nécessaires ;
- Le point à la fin de `votre.domaine.tld.` est important ;) ;
- `@` corresponds à `votre.domaine.tld`, et par ex. `muc` corresponds à `muc.votre.domaine.tld` ;
- Les valeurs montrées ici sont des valeurs d'exemple ! Référez-vous à la configuration générée chez vous pour savoir quelles valeurs utiliser ;
- Nous recommandons un [TTL](https://fr.wikipedia.org/wiki/Time_to_Live#Le_Time_to_Live_dans_le_DNS) de 3600 (1 heure). Mais vous pouvez utiliser une autre valeur si vous savez ce que vous faîtes ;
- Ne mettez pas d'enregistrement IPv6 si vous n'êtes pas certains que l'IPv6 fonctionne sur votre serveur ! Vous aurez des problèmes avec Let's Encrypt si ce n'est pas le cas.
