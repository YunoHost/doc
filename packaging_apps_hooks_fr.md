# Usage des hooks YunoHost

Les hooks permettent de déclencher un script lorsqu'une action est effectuée par le système.  
Le cas le plus évident, est l'ajout d'un utilisateur. Si l'app dispose d'un hook `post_user_create`, ce hook sera déclenché dés qu'un utilisateur sera ajouté.  
Cela permet donc à une application d'exécuter des actions en fonction des évènements intervenant sur le système.

### Liste des hooks disponibles

- `post_domain_add`  
Après l'ajout d'un domaine.
- `post_domain_remove`  
Après la suppression d'un domaine.
- `post_user_create`  
Après l'ajout d'un utilisateur.
- `post_user_delete`  
Après la suppression d'un utilisateur.
- `post_iptable_rules`  
Après le rechargement du parefeu.
- `pre_backup_delete`  
Avant la suppression d'un backup.
- `post_backup_delete`  
Après la suppression d'un backup.
- `post_app_addaccess`  
Après l'ajout d'un utilisateur autorisé sur une application.
- `post_app_removeaccess`  
Après la suppression de l'autorisation d'un utilisateur sur une application.
- `post_app_clearaccess`  
Après l'effacement de toute les règles d'accès sur une application.
- `post_app_install`
Après l'installation d'une application
- `post_app_upgrade`
Après l'upgrade d'une applications
- `post_app_remove`
Après la supression d'une applications
- `post_app_change_url`
Après avoir modifié le chemin et ou le nom de domaine d'une application
- `post_cert_update`
Après la mise à jour d'un certificat
- `conf_regen`  
Avant et après la régénération de la configuration d'un service.  
Services pris en charge par regen-conf:
 - avahi-daemon
 - dnsmasq
 - dovecot
 - fail2ban
 - glances
 - metronome
 - mysql
 - nginx
 - nslcd
 - nsswitch
 - postfix
 - rspamd
 - slapd
 - ssh
 - ssl

### Mise en place des hooks

A l'exception du hook conf_regen, tout les hooks s'utilisent de la même manière.  
Tout d'abord, il faut comprendre qu'un hook est un simple script bash qui sera exécuté par YunoHost lorsque l'évènement indiqué se présentera.  
Pour ajouter un hook à YunoHost, il faut utiliser un dossier "hooks" à la racine du package de l'application. Puis dans celui-ci mettre votre script sous le nom du hooks correspondant.

> Par exemple:  
Pour un hook `post_user_create`, le script qui devra être exécuté pour ce hook doit simplement être placé dans "hooks/post_user_create" dans le package.

Lors de l'installation et de l'upgrade, les scripts dans le dossier hooks seront dupliqués dans le dossier "/etc/yunohost/hooks.d/" dans le dossier correspondant au hook, puis sous le nom "50-$app".  
Lors de la suppression de l'application, tout les hooks lui appartenant seront supprimés.

### Construire un script de hook

En tant que script bash, un script de hook doit commencer par le shebang bash

```bash
#!/bin/bash
```

Ensuite il convient de prendre les arguments donnés par YunoHost lors de l'appel du script.  
Chaque hook propose des arguments différents.

##### `post_domain_add` et `post_domain_remove`

```bash
domain=$1
```

##### `post_user_create`

```bash
username=$1
mail=$2
password=$3 # Clear password
firstname=$4
lastname=$5
```
##### `post_user_delete`

```bash
username=$1
purge=$2  # True/False Indique si le dossier utilisateur a été supprimé ou pas.
```

##### `post_iptable_rules`

```bash
upnp=$1  # True/False Indique si l'upnp est activé ou non.
ipv6=$2  # True/False Indique si l'IPV6 est activé ou non.
```

##### `pre_backup_delete` et `post_backup_delete`

```bash
backup_name=$1
```

##### `post_app_install`, `post_app_upgrade`, `post_app_remove` et `post_app_change_url`

Les variables utilisables dans ces scripts sont les mêmes que celles disponibles dans [les scripts d'actions associés](/packaging_apps_scripts_fr).


Example: pour `post_app_install` les variables sont les mêmes que pour le script `install`

##### `post_app_addaccess` et `post_app_removeaccess`

```bash
app_id=$1
users=$2  # Tous les utilisateurs autorisés sur l'app. Séparés par des virgules.
```

##### `post_app_clearaccess`

```bash
app_id=$1
```

##### `post_cert_update`
```bash
domain=$1
```

La suite du script dépend de ce que vous voulez effectuer dans celui-ci.

### Cas particulier de `conf_regen`
Le hook conf_regen est un hook plus délicat, que ce soit pour sa mise en place ou pour son contenu.

##### Mise en place d'un hook `conf_regen`

Un hook conf_regen ne doit pas être placé dans le dossier hooks de l'application. Il doit être mis en place manuellement.  
Le hook doit être copié en indiquant à quel service il est lié.
```bash
cp hook_regen_conf /usr/share/yunohost/hooks/conf_regen/50-SERVICE_$app
```

> Lors de la suppression de l'application, ce hook devra être supprimé manuellement.

##### Construire un script de hook conf_regen

Un hook conf_regen est appelé 2 fois, une première fois après analyse de la configuration et avant une éventuelle modification des fichiers, puis une seconde fois après application des modifications, si il y a eu des modifications.

Un script de hook conf_regen devrait donc ressembler à ça:

```bash
#!/bin/bash

force=${2:-0}  # 0/1 --force argument
dryrun=${3:-0}  # 0/1 --dry-run argument
pending_conf=$4 # Path of the pending conf file

do_pre_regen() {
  # Put your code here for pre regen conf.
}

do_post_regen() {
  # Put your code here for post regen conf.
  # Be careful, this part will be executed only if the configuration has been modified.
}

case "$1" in
  pre)
    do_pre_regen
    ;;
  post)
    do_post_regen
    ;;
  *)
    echo "Hook called with unknown argument \`$1'" >&2
    exit 1
    ;;
esac

exit 0
```
