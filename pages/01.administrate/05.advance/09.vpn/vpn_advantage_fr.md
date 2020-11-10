# Avantage d’un VPN pour l’auto-hébergement

L'installation d'un serveur chez soi étant une pratique peu courante, la plupart des connexions Internet fournies aux particuliers sont inadaptées à sa mise en pratique. Un VPN respectant la neutralité du net et fournissant une adresse IPv4 fixe et des adresses IPv6 peut permettre de contourner certaines limitations ou certaines difficultés.

<div class="alert alert-warning">
<b>Attention</b> : tous les fournisseurs VPN existants ne remplissent pas ces conditions, assurez-vous bien que celui que vous choisissez les remplis.
</div>

## Avantages

### Plug & Play
En configurant un VPN sur votre serveur, vous serez en mesure de le rendre accessible au reste d'Internet sans avoir à modifier la configuration du routeur auxquel vous le branchez. Ce point peut être vraiment pratique si vous partez en vacances, que vous déménagez ou si vous avez une coupure d'Internet, car vous serez en mesure de le brancher facilement chez une personne de confiance sans avoir besoin de configurer le routeur de la personne qui vous aide.

De la même façon, vous vous économisez l'ouverture des ports de votre routeur ainsi que le contournement du hairpinning.

### Pas de micro-coupure DNS
Si votre connexion Internet n'a pas d'IP publique fixe, vous serez obligé de mettre en place un nom de domaine dynamique (Dynamique DNS). Cette solution peut être acceptable, mais la mise à jour du DNS ne se fera qu'à intervalle régulier (Toutes les deux minutes si c'est un nom de domaine en `noho.st` ou `nohost.me`). Il y a donc une chance que cela provoque de temps en temps des erreurs d'affichage dans le navigateur, voir même qu'un autre site s'affiche (les risques sont toutefois réduit car la pratique de l'auto-hébergement n'est pas répandue).

Avec un VPN neutre, ce problème est contourné car le VPN peut être comparé à une connexion Internet Virtuelle, qui a sa propre adresse IPv4 fixe, dès lors plus besoin de mettre à jour le nom de domaine. 

### Le cas du mail
Le mail est un des protocoles les plus complexes à auto-héberger, en général c'est ce qu'un utilisateur auto-héberge en dernier. En effet, il est très facile de se retrouver dans une situation où les emails envoyés par le serveur sont refusés par les serveurs SMTP destinataires.

Pour éviter ça il faut entre autre :
- configurer le reverse DNS de la connexion Internet (ou du VPN) du serveur
- une IPv4 fixe
- que cette IPv4 soit enlevable de toutes les listes noire (notamment l'IP ne doit pas être sur le DUL)
- pouvoir ouvrir le port 25 (ainsi que les autres ports SMTP)

Malheureusement, aucun des FAI français les plus courants ne respecte la totalité de ces points.

Pour pallier cela, l'usage d'un VPN respectant ces points peut être une alternative.

### Confiance
Enfin, si vous ne souhaitez pas que le contenu des communications de votre serveur soit espionnable par des équipements présent sur le réseau de votre Fournisseur d'Accès Internet, vous pouvez utiliser un VPN pour chiffrer vos communications et déporter votre confiance sur un fournisseur de VPN. Rappel, depuis 2015, le gouvernement déploie officiellement des boîtes noires chez les gros opérateurs réseau qui ont pour objectif de mettre sur écoute l'ensemble des communications numériques françaises entre autre pour préserver les intérêts scientifiques, économiques et industrielles de la France.

## Inconvénient
### Coût
Un VPN neutre a un coût puisque l'opérateur qui le fournis doit faire fonctionner un serveur et utiliser de la bande passante. Les prix des VPN associatifs de la FFDN sont autour de 6 € par mois.

### Trajet des paquets
Lorsque l'on met en place un VPN sur son serveur, si on ne met pas en place de configuration particulière, le transfert d'un fichier d'un ordinateur du réseau local vers le serveur utilisant le VPN, passera par le bout du VPN c'est-à-dire par le serveur du fournisseur de VPN.

Pour pallier ce point, il y a deux solutions :
- transformer son serveur en routeur et connecter les équipements de la maison à ce dernier, ces équipements bénéficieront alors de la confidentialité du VPN également.
- utiliser le serveur YunoHost comme résolveur DNS lorsque l'on est chez soi, de façon à rediriger les noms de domaines du serveur l'ip locale plutôt que l'ip publique. Cette opération peut se faire soit sur chaque équipements, soit sur le routeur (si ce dernier le permet).
