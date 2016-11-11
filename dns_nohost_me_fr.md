# Noms de domaines nohost.me

### Présentation

Afin de rendre l'auto-hébergement le plus accessible possible, YunoHost offre un service de DNS dynamique par l'intermédiaire des noms de domaine `nohost.me` et `noho.st`. Si vous n'avez pas de nom de domaine, vous pouvez donc obtenir un sous-domaine de type `mondomaine.nohost.me` ou `mondomaine.noho.st`. Pour profiter de ce service, choisissez un domaine se terminant en .nohost.me ou .noho.st, il sera automatiquement rattaché à votre serveur YunoHost, et vous n’aurez pas d’étape de configuration supplémentaire.

### Sous-domaines

Utiliser le service de DNS `nohost.me` ou `noho.st` revient a en obtenir un sous-domaine.

Le service de domaines `nohost.me` et `noho.st` permet d'avoir uniquement un sous-domaine du type `mondomaine.nohost.me` ou `mondomaine.nohost.me` mais n'autorise pas les sous-domaines de sous-domaines.

Ainsi, même si YunoHost permet l'installation d'applications sur des sous-domaines (par exemple avoir l'application Owncloud accessible depuis l'adresse `cloud.mondomaine.org`), il n’est pas possible d’avoir un sous-sous-domaine tel `monapplication.mondomaine.nohost.me`.
Pour pouvoir profiter des applications installables uniquement à la racine d’un nom de domaine, il faut avoir son propre nom de domaine.

### Récuperer un domaine nohost.me ou noho.st

Il peut arriver qu'une mise à jour des DNS du domaine soit nécessaire (par exemple lors d'un changement de machine), pour cela vous pouvez poster votre demande de réinitialisation sur le forum, [un fil est dédié à ce sujet]().
