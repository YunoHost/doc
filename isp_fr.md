# Fournisseurs d’accès à Internet

<a class="btn btn-lg btn-default" href="/isp_box_config_fr"> Configuration générale box</a>

Voici une liste non exhaustive des fournisseurs d’accès à Internet par pays, contenant les critères de tolérance à l’[auto-hébergement](selfhosting_fr).

Un « **non** » peut entraîner des problèmes d’utilisation de votre serveur ou peut vous obliger à faire des configurations supplémentaires. Le statut entre parenthèses indique le comportement par défaut.

### France

Tous les fournisseurs d’accès à Internet [membres de la Fédération French Data Network](http://www.ffdn.org/fr/membres) ont une politique favorable à l’auto-hébergement.
* ✔ : oui
* ✘ : non

| Fournisseur d’accès | OVH | [Free](/isp_free_fr) | [SFR](/isp_sfr_fr) | [Orange](/isp_orange_fr) | Bouygues<br>Télécom | Darty |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Box/routeur** | Personnel/OVH Télécom | Freebox | Neufbox | Livebox | Bbox | Dartybox |
| **[UPnP](https://fr.wikipedia.org/wiki/Universal_Plug_and_Play)** | ✔ | ✔ | ✔ | ✔ | ✔ | ✔ |
| **[Port 25 ouvrable](email_fr)**<br> (fermé par défaut) | ✔ | ✔ | ✔ | ✘ | ✔ | ✔ |
| **[Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning)** | ✔ | ✔ | ✔/✘ | ✔ (depuis la Livebox 4) | ✔ | ✔ |
| **[Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup)<br>personnalisable ** | ✔ | ✔ (sauf IPv6) pas de support | … | ✘ | ✘ | ✘ |
| **[IP fixe](/dns_dynamicip_fr)** | ✔ | ✔ | ✔/✘ | ✘ | ✔ | ✔ |
| **[IPv6](https://fr.wikipedia.org/wiki/IPv6)** | ✔ | ✔ | ✔ | ✔ | … | … |
| **[Non listé sur le DUL](https://en.wikipedia.org/wiki/Dialup_Users_List)** | … | ✘ | … | … | … | … |
Pour une liste plus complète et précise, référez-vous à la très bonne documentation de [wiki.auto-hebergement.fr](http://wiki.auto-hebergement.fr/fournisseurs/fai#d%C3%A9tail_des_fai).

**Astuce** : [FDN](http://www.fdn.fr) fournit des [VPN](http://www.fdn.fr/-VPN-.html) permettant de rapatrier une (ou plusieurs sur demande) IPv4 fixe et un /48 en IPv6 et ainsi « nettoyer » votre connexion si vous êtes chez l’un des FAI *limitants* du tableau ci-dessus.

### Belgique

| Fournisseur d’accès | Box/ routeur | uPnP activable | [Port 25 ouvrable](email_fr)| [Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning) | [Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup) | IP fixe |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Proximus** | BBox2 | oui (activé) | oui | **non** | **non** | **non** |
| | BBox3 | oui (activé) | oui | **non** | **non** | **non** |
| **Scarlet** | BBox2 | oui (activé) | oui | **non** | **non** | **non** |

**Proximus** ne serait pas ouvert à l’auto-hébergement. L’ouverture des ports serait plus difficile afin d’éviter tout SPAM. Il serait préférable de passer par [Neutrinet](http://neutrinet.be), un des [membres de la Fédération French Data Network](http://www.ffdn.org/fr/membres).

### Côte d'Ivoire

| Fournisseur d’accès | Box/ routeur | uPnP activable | [Port 25 ouvrable](email_fr)| [Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning) | [Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup) | IP fixe |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Orange** | Livebox2 | oui (activé) | non | **non** | **non** | **non** |
| **Moov** |  | oui (activé) |  |  |  |  |
| **MTN** |  | oui (activé) |  |  |  | |
