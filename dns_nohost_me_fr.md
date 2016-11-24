# Noms de domaines nohost.me

### Présentation

Afin de rendre l'auto-hébergement le plus accessible possible, YunoHost offre un service de DNS dynamique par l'intermédiaire des noms de domaine `nohost.me` et `noho.st`. Si vous n'avez pas de nom de domaine, vous pouvez donc obtenir un sous-domaine de type `mondomaine.nohost.me` ou `mondomaine.noho.st`. Pour profiter de ce service, choisissez un domaine se terminant en `.nohost.me` ou `.noho.st`, il sera automatiquement rattaché à votre serveur YunoHost, et vous n’aurez pas d’étape de configuration supplémentaire.


### Obtenir un domaine

##### Depuis l'interface d'administration
Vous pouvez obtenir un domaine directement depuis l'interface d'administration de YunoHost, en vous rendant dans le menu "Domaines" et en cliquant sur le bouton "Ajouter un domaine" :

<img src="/images/dns_nohost_me.png" height=150 style="vertical-align:bottom">

##### En ligne de commande
Après vous être connecté à votre serveur YunoHost, entrez la commande (en remplaçant `mondomaine` par le domaine que vous souhaitez acquérir) :

```bash
sudo yunohost domain add mondomaine.nohost.me
```

Vous pouvez ensuite vérifier la création du domaine avec la commande :

```bash
sudo yunohost domain list
```


### Récupérer un domaine nohost.me ou noho.st

Il peut arriver qu'une mise à jour des DNS du domaine soit nécessaire (par exemple lors d'un changement de machine), pour cela vous pouvez poster votre demande de réinitialisation sur le forum, [un fil est dédié à ce sujet](https://forum.yunohost.org/t/nohost-domain-recovery/442).


### Sous-domaines

Le service de domaines `nohost.me` et `noho.st` n'autorise pas la création de sous-domaines.

Même si YunoHost permet l'installation d'applications sur des sous-domaines (par exemple avoir l'application Owncloud accessible depuis l'adresse `cloud.mondomaine.org`), cette fonctionnalité n'est pas permise avec les domaines `nohost.me` et `noho.st` et il n’est pas possible d’avoir un sous-sous-domaine tel `monapplication.mondomaine.nohost.me`.

Pour pouvoir profiter des applications installables uniquement à la racine d’un nom de domaine, il faut avoir son propre nom de domaine.
