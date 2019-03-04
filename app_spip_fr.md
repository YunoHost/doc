# SPIP for YunoHost

### SPIP c'est quoi ?

SPIP est un système de publication pour l’Internet qui s’attache particulièrement au fonctionnement collectif, au multilinguisme et à la facilité d’emploi. C’est un logiciel libre, distribué sous la licence GNU/GPL. Il peut ainsi être utilisé pour tout site Internet, qu’il soit associatif ou institutionnel, personnel ou marchand.

Source : [spip.net](https://www.spip.net/fr_rubrique91.html)

### Fonctionnalité de l'application pour Yunohost

* Installation de la base sans passer par le système d'installation
* Support multilingue
* Support LDAP

#### Installation

```bash
$ sudo yunohost app install https://github.com/YunoHost-Apps/spip_ynh.git
```

#### Mise à jour

```
$ sudo yunohost app upgrade --verbose spip -u https://github.com/YunoHost-Apps/spip_ynh.git
```

#### Utilisation

Accéder à l'administration du site en écrivant l'adresse suivante dans votre navigateur.

https://www.domain.tld/spip/ecrire

Faire une demande de "mot de passe oublié" pour changer votre mot de passe, vous recevez un email vous indiquant comment procéder au changement de mot de passe.
