---
title: Installer YunoHost
template: docs
taxonomy:
    category: docs
never_cache_twig: true
twig_first: true
process:
    markdown: true
    twig: true
page-toc:
  active: true
  depth: 2
routes:
  default: '/install'
  aliases:
    - '/install_iso'
    - '/install_on_vps'
    - '/install_manually'
    - '/install_on_raspberry'
    - '/install_on_arm_board'
    - '/install_on_debian'
    - '/install_on_virtualbox'
    - '/plug_and_boot'
    - '/burn_or_copy_iso'
    - '/boot_and_graphical_install'
    - '/postinstall'
    - '/hardware'
---
{% set image_type = 'YunoHost' %}
{% set arm, at_home, regular, rpi34, rpi012, show_legacy_arm_menu, arm_sup, arm_unsup, vps, vps_debian, vps_ynh, virtualbox, internetcube = false, false, false, false, false, false, false, false, false, false, false, false, false %}
{% set hardware = uri.param('hardware')  %}

{% if hardware == 'regular' %}
  {% set regular = true %}
{% elseif hardware == 'internetcube' %}
  {% set arm, arm_sup, internetcube = true, true, true %}
  {% set image_type = 'La Brique Internet' %}
  {% set show_legacy_arm_menu = true %}
{% elseif hardware == 'rpi34' %}
  {% set arm, rpi34 = true, true %}
{% elseif hardware == 'rpi012' %}
  {% set arm, arm_unsup, rpi012 = true, true, true %}
  {% set hardware = '' %}
{% elseif hardware == 'arm_sup' %}
  {% set arm, arm_sup = true, true %}
  {% set show_legacy_arm_menu = true %}
{% elseif hardware == 'arm' %}
  {% set arm, arm_unsup = true, true %}
  {% set image_type = 'Armbian' %}
{% elseif hardware == 'arm_unsup' %}
  {% set arm, arm_unsup = true, true %}
  {% set show_legacy_arm_menu = true %}
  {% set image_type = 'Armbian' %}
{% elseif hardware == 'vps_debian' %}
  {% set vps, vps_debian = true, true %}
{% elseif hardware == 'vps_ynh' %}
  {% set vps, vps_ynh = true, true %}
{% elseif hardware == 'virtualbox' %}
  {% set at_home, virtualbox = true, true %}
{% endif %}

{% if arm or regular %}
  {% set at_home = true %}
{% endif %}

Sélectionnez le matériel sur lequel vous souhaitez installer YunoHost :
[div class="flex-container"]

[div class="flex-child hardware{%if virtualbox %} active{% endif %}"]
[[figure caption="VirtualBox"]![](image://virtualbox.png?height=75)[/figure]](/install/hardware:virtualbox)
[/div]

[div class="flex-child hardware{%if rpi34 or rpi012 %} active{% endif %}"]
[[figure caption="Raspberry Pi"]![](image://raspberrypi.png?height=75)[/figure]](/install/hardware:rpi34)
[/div]

[div class="flex-child hardware{%if arm_sup or (arm_unsup and not rpi012) or internetcube %} active{% endif %}"]
[[figure caption="Carte ARM"]![](image://olinuxino.png?height=75)[/figure]](/install/hardware:arm)
[/div]

[div class="flex-child hardware{%if regular %} active{% endif %}"]
[[figure caption="Ordinateur standard"]![](image://computer.png?height=75)[/figure]](/install/hardware:regular)
[/div]

[div class="flex-child hardware{%if vps_debian or vps_ynh %} active{% endif %}"]
[[figure caption="Serveur distant"]![](image://vps.png?height=75)[/figure]](/install/hardware:vps_debian)
[/div]

[/div]
[div class="flex-container pt-2"]

{% if rpi34 or rpi012 %}
[div class="flex-child hardware{%if rpi34 %} active{% endif %}"]
[[figure caption="Raspberry Pi 3 ou 4"]![](image://raspberrypi.png?height=50)[/figure]](/install/hardware:rpi34)
[/div]

[div class="flex-child hardware{%if rpi012 %} active{% endif %}"]
[[figure caption="Raspberry Pi 0, 1 or 2"]![](image://rpi1.png?height=50)[/figure]](/install/hardware:rpi012)
[/div]

{% elseif show_legacy_arm_menu %}

[div class="flex-child hardware{%if internetcube %} active{% endif %}"]
[[figure caption="La Brique Internet avec un VPN"]![](image://internetcube.png?height=50)[/figure]](/install/hardware:internetcube)
[/div]

[div class="flex-child hardware{%if arm_sup and not internetcube %} active{% endif %}"]
[[figure caption="Olinuxino lime1&2 ou Orange Pi PC+"]![](image://olinuxino.png?height=50)[/figure]](/install/hardware:arm_sup)
[/div]

[div class="flex-child hardware{%if arm_unsup %} active{% endif %}"]
[[figure caption="Autres cartes ARM"]![](image://odroidhc4.png?height=50)[/figure]](/install/hardware:arm_unsup)
[/div]
{% elseif vps_debian or vps_ynh %}

[div class="flex-child hardware{%if vps_debian %} active{% endif %}"]
[[figure caption="VPS ou serveur dédié avec Debian 12"]![](image://debian-logo.png?height=50)[/figure]](/install/hardware:vps_debian)
[/div]

[div class="flex-child hardware{%if vps_ynh %} active{% endif %}"]
[[figure caption="VPS ou serveur dédié avec YunoHost pre-installé"]![](image://logo.png?height=50)[/figure]](/install/hardware:vps_ynh)
[/div]

{% endif %}

[/div]

{% if rpi012 %}
!! La prise en charge des Raspberry Pi 0, 1 et 2 a malheureusement été abandonnée depuis Debian 12 Bookworm. Nous vous suggérons de migrer vers un modèle de Raspberry Pi plus moderne, pris en charge par Bookworm.
{% endif %}

{% if hardware != '' %}

## [fa=list-alt /] Pré-requis

{% if regular %}

- Un matériel compatible x86 dédié à YunoHost : portable, netbook, ordinateur avec 512Mo de RAM et 16Go de capacité de stockage (au moins) ;
{% elseif rpi34 %}
- Un Raspberry Pi 3 ou 4 ;
{% elseif internetcube %}
- Un Orange Pi PC+ ou une Olinuxino Lime 1 ou 2 ;
- Un VPN avec une IP publique dédiée et un fichier `.cube` ;
{% elseif arm_sup %}
- Un Orange Pi PC+ ou une Olinuxino Lime 1 ou 2 ;
{% elseif arm_unsup %}
- Une carte ARM avec au moins 512Mo de RAM ;
{% elseif vps_debian %}
- Un serveur dédié ou virtuel avec Debian 12 (Bookworm) pré-installé <small>(avec un **kernel >= 6.1**)</small>, avec au moins 512Mo de RAM et 16Go de capacité de stockage ;
{% elseif vps_ynh %}
- Un serveur dédié ou virtuel avec YunoHost pré-installé, avec au moins 512Mo de RAM et 16Go de capacité de stockage ;
{% elseif virtualbox %}
- Un ordinateur x86 avec [VirtualBox installé](https://www.virtualbox.org/wiki/Downloads) et assez de RAM disponible pour lancer une petite machine virtuelle avec au moins 1024Mo de RAM et 8Go de capacité de stockage ;
{% endif %}
{% if arm %}
- Une alimentation électrique (soit un adaptateur, soit un câble microUSB) pour alimenter la carte ;
- Une carte microSD : au moins 16Go de capacité, [classe « A1 »](https://fr.wikipedia.org/wiki/Carte_SD#Vitesse) hautement recommandée (comme par exemple [cette carte SanDisk A1](https://www.amazon.fr/SanDisk-microSDHC-Adaptateur-homologu%C3%A9e-Nouvelle/dp/B073JWXGNT/)) ;
{% endif %}
{% if regular %}
- Une clé USB avec au moins 1Go de capacité OU un CD vierge standard ;
{% endif %}
{% if at_home %}
- Un [fournisseur d'accès à Internet correct](/isp), de préférence avec une bonne vitesse d’upload ;
{% if not virtualbox %}
- Un câble ethernet/RJ-45 pour brancher la carte à votre routeur/box internet ;
{% endif %}
- Un ordinateur pour lire ce guide, flasher l'image et accéder à votre serveur.
{% else %}
- Un ordinateur ou un smartphone pour lire ce guide et accéder à votre serveur.
{% endif %}

{% if virtualbox %}
! N.B. : Installer YunoHost dans une VirtualBox est généralement destiné à tester la distribution ou pour développer. VirtualBox n'est pas pratique pour faire tourner un 'vrai' serveur sur le long terme car la machine surlaquelle il est installé ne sera sans doute pas allumé 24h/24, et parce que Virtualbox rajoute une couche de complexité supplémentaire pour ce qui est d'exposer la machine sur Internet.
{% endif %}

{% if vps_ynh %}

## Fournisseurs de VPS YunoHost

Ci-dessous une liste de fournisseurs de VPS supportant nativement YunoHost :

[div class="flex-container"]

[div class="flex-child"]
[[figure caption="Alsace Réseau Neutre - FR"]![](image://vps_ynh_arn.png?height=50)[/figure]](https://arn-fai.net/fr/hébergement-alternatif/vps)
[/div]
[div class="flex-child"]
[[figure caption="FAImaison - FR"]![](image://vps_ynh_faimaison.svg?height=50)[/figure]](https://www.faimaison.net/services/vm.html)
[/div]
[div class="flex-child"]
[[figure caption="ECOWAN - FR"]![](image://vps_ynh_ecowan.png?height=50)[/figure]](https://www.ecowan.fr/vps-linux)
[/div]
[/div]
{% endif %}

{% if at_home %}

## [fa=download /] Télécharger l'image {{image_type}}

{% if virtualbox or regular %}
!!! Si votre hôte est en 32 bits, faites bien attention à télécharger l'image 32 bits.
{% elseif arm_unsup %}
<a href="https://www.armbian.com/download/" target="_BLANK" type="button" class="btn btn-info col-sm-12" style="background:none;">[fa=external-link] Télécharger l'image pour votre carte sur le site d'Armbian</a>

!!! N.B.: il vous faut télécharger l'image Armbian Bookworm.
{% endif %}

!!! Si vous souhaitez vérifier la validité de nos images signées, vous pouvez [télécharger notre clé publique](https://forge.yunohost.org/yunohost.asc).

{% if internetcube or arm_sup %}
! Les images sont basées sur Debian Buster (YunoHost v4.x) et nécessitent que vous fassiez la commande `apt update` en SSH ou ligne de commande pour continuer les mises à jour.
! Répondez Oui à l'avertissement à propos du changement de `stable` vers `oldstable`.
{% endif %}

<div class="hardware-image">
<div id="cards-list">
</div>
</div>
<template id="image-template">
<div id="{id}" class="card panel panel-default">
        <div class="panel-body text-center pt-2">
            <h3>{name}</h3>
            <div class="card-comment">{comment}</div>
            <div class="card-desc text-center">
<img src="/user/images/{image}" height=100 style="vertical-align:middle">
            </div>
        </div>
        <div class="annotations flex-container">
            <div class="flex-child annotation"><a href="{file}.sha256sum">[fa=barcode] Checksum</a></div>
            <div class="flex-child annotation"><a href="{file}.sig">[fa=tag] Signature</a></div>
        </div>
        <div class="btn-group" role="group">
            <a href="{file}" target="_BLANK" type="button" class="btn btn-info col-sm-12">[fa=download] Télécharger <small>{version}</small></a>
        </div>
</div>
</template>
<script>
var hardware = "{{ hardware|escape('js') }}";
/*
###############################################################################
  Script that loads the infos from JavaScript and creates the corresponding
  cards
###############################################################################
*/
$(document).ready(function () {
    console.log("in load");
    $.getJSON('https://repo.yunohost.org/images/images.json', function (images) {
        $.each(images, function(k, infos) {
            if (infos.hide == true) { return; }
            if (infos.tuto.indexOf(hardware) == -1) return;
            // Fill the template
            html = $('#image-template').html()
             .replace('{id}', infos.id)
             .replace('{name}', infos.name)
             .replace('{comment}', infos.comment || "&nbsp;")
             .replace('%7Bimage%7D', infos.image)
             .replace('{image}', infos.image)
             .replace('{version}', infos.version);

            if (!infos.file.startsWith("http"))
                infos.file="https://repo.yunohost.org/images/"+infos.file;
            html = html.replace(/%7Bfile%7D/g, infos.file).replace(/{file}/g, infos.file);
   
            if ((typeof(infos.has_sig_and_sums) !== 'undefined') && infos.has_sig_and_sums == false)
            {
                var $html = $(html);
                $html.find(".annotations").html("&nbsp;");
                html = $html[0];
            } 
            $('#cards-list').append(html);
        });
    });
});
</script>

{% if not virtualbox %}

{% if arm %}

## ![microSD card with adapter](image://sdcard_with_adapter.png?resize=100,75&class=inline) Flasher l'image {{image_type}}

{% else %}

## ![USB drive](image://usb_key.png?resize=100,100&class=inline) Flasher l'image YunoHost

{% endif %}

Maintenant que vous avez téléchargé l’image de {{image_type}}, vous devez la mettre sur {% if arm %}une carte microSD{% else %}une clé USB ou un CD/DVD.{% endif %}

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommandé) Avec Etcher"]

Téléchargez <a href="https://www.balena.io/etcher/" target="_blank">Etcher</a> pour votre système d'exploitation et installez-le.

Branchez votre {% if arm %}carte microSD{% else %}clé USB{% endif %}, sélectionnez votre image et cliquez sur « Flash ».

![Etcher](image://etcher.gif?resize=700&class=inline)

[/ui-tab]
[ui-tab title="Avec USBimager"]

Téléchargez [USBimager](https://bztsrc.gitlab.io/usbimager/) pour votre système d'exploitation et installez-le.

Branchez votre {% if arm %}carte microSD{% else %}clé USB{% endif %}, sélectionnez votre image et cliquez sur « Write ».

![USBimager](image://usbimager.png?resize=700&class=inline)

[/ui-tab]
[ui-tab title="Avec dd"]

Si vous êtes sur GNU/Linux / macOS et que vous êtes familier avec la ligne de commande, il est possible de flasher la clé USB ou carte SD avec dd. Vous pouvez identifier le nom du périphérique avec `fdisk -l` ou `lsblk`. Une carte SD s'appelle typiquement `/dev/mmcblk0`. ATTENTION à bien prendre le bon nom !

Ensuite lancez :

```bash
# Remplacez /dev/mmcblk0 si le nom de votre périphérique est différent...
dd if=/path/to/yunohost.img of=/dev/mmcblk0
```

[/ui-tab]
{% if regular %}
[ui-tab title="Copier un CD/DVD"]
Pour les anciens matériels, il vous faut peut-être utiliser un CD/DVD. Le logiciel à utiliser est différent suivant votre système d’exploitation.

- Sur Windows, utilisez [ImgBurn](http://www.imgburn.com/) pour écrire l’image sur le disque

- Sur macOS, utilisez [Disk Utility](http://support.apple.com/kb/ph7025)

- Sur GNU/Linux, vous avez plusieurs choix, tels que [Brasero](https://wiki.gnome.org/Apps/Brasero) ou [K3b](http://www.k3b.org/)

[/ui-tab]
[ui-tab title="Utiliser Ventoy"]
Ventoy sera utile si vous n'arrivez pas à démarrer l'image de YunoHost en utilisant les autres méthodes

[Ventoy](https://www.ventoy.net/) est un outil pratique qui permet de mettre plusieurs images Linux sur une même clé USB et démarrer ces images sans devoir re-flasher la clé USB à chaque fois. C'est aussi pratique pour démarer une image qui refuse de démarrer: Ventoy réussi habituellement à tout démarrer!

1. Installer [Ventoy](https://www.ventoy.net/) sur la clé USB. Référez-vous aux [instructions d'installation](https://www.ventoy.net/en/doc_start.html).
    - Cela va créer 2 partition sur la clé USB.
2. En utilisant votre application de fichiers préférée, copiez l'image YunoHost sur la grande partition "Ventoy (pas celle "VTOYEFI")
    - N'utilisez pas *Balena Etcher*, USBImager ou `dd` pour faire ça!

Insérez cette clé USB dans l'ordinateur et démarrez en utisant celle-ci. Ventoy va apparaitre et lister toutes les images qui sont sur la clé USB. Sélectionnez l'image de YunoHost. Sélectionnez ensuite "GRUB2" comme option de démarrage (ou utilisez n'importe laquelle qui fonctionnera sur votre ordinateur 😉)
[/ui-tab]
{% endif %}
[/ui-tabs]

{% else %}

## Créer une nouvelle machine virtuelle

![](image://virtualbox_1.png?class=inline)

! Ce n'est pas grave si seulement la version 32-bit est disponible, mais dans ce cas soyez sûr d'avoir téléchargé l'image 32 bit précédemment.

## Modifier la configuration réseau

! Cette étape est importante pour exposer proprement la machine virtuelle sur le réseau.

Allez dans **Réglages** > **Réseau** :

- Sélectionnez `Accès par pont`
- Choisissez votre interface selon son nom :
    **wlan0** si vous êtes connecté sans-fil, **eth0** ou **eno1** sinon.

![](image://virtualbox_2.png?class=inline)

{% endif %}

{% if arm %}

## [fa=plug /] Démarrer la carte

- Branchez le câble Ethernet (un côté sur votre box, l'autre côté à votre carte).
  - Pour les utilisateurs et utilisatrices souhaitant configurer la carte pour la connecter via le WiFi à la place, voir [cet exemple](https://www.raspberrypi.com/documentation/computers/configuration.html#connect-to-a-wireless-network) ([ou là avant YunoHost12/bookworm](https://www.raspberryme.com/configurer-le-wifi-sur-un-pi-manuellement-a-laide-de-wpa_supplicant-conf/).
- Mettez la carte SD dans le serveur.
- (Facultatif) Il est possible de brancher un écran et un clavier sur votre serveur en cas de soucis, pour vérifier que le processus de démarrage (boot) se passe bien, ou encore pour avoir un accès direct en console.
- Branchez l'alimentation.
- Laissez quelques minutes à votre serveur pour s'autoconfigurer durant le premier démarrage.
- Assurez-vous que votre ordinateur (de bureau ou portable) est connecté au même réseau local (c'est-à-dire la même box Internet) que votre serveur.

{% elseif virtualbox %}

## [fa=plug /] Lancer la machine virtuelle

Démarrez votre machine virtuelle après avoir sélectionné l'image YunoHost.

![](image://virtualbox_2.1.png?class=inline)

! Si vous rencontrez l'erreur "VT-x is not available", il vous faut probablement activer (enable) la virtualisation dans les options du BIOS de votre ordinateur.

{% else %}

## [fa=plug /] Démarrer la machine sur la clé USB

- Branchez le câble Ethernet (un côté à votre box, de l'autre côté à votre carte).
- Démarrez votre serveur avec la clé USB ou le CD-ROM inséré, et sélectionnez-le comme **périphérique de démarrage (bootable device)** en pressant l’une des touches suivantes (dépendant de votre ordinateur) :
`<F9>`, `<F10>`, `<F11>`, `<F12>`, `<DEL>`, `<ESC>` ou <Alt>.
  - N.B. : si le serveur était précédemment installé avec une version récente de Windows (8+), vous devez d'abord demander à Windows de « redémarrer réellement ». Vous pouvez le faire dans une option du menu « Options de démarrage avancées ».

!!! Si vous n'arrivez pas à démarrer l'image YunoHost, essayez d'utiliser Ventoy (sélectionnez "Ventoy" dans la section "Flasher l'image YunoHost" ci-dessus).
{% endif %}

{% if regular or virtualbox %}

## [fa=rocket /] Lancer l’installation graphique

Votre écran devrait ressembler à la capture ci-dessous :

[figure class="nomargin" caption="Capture d'écran du menu de l'ISO"]
![](image://virtualbox_3.png?class=inline)
[/figure]
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Installation classique sur un disque entier"]

!! N.B. : A partir du moment où vous aurez validé l'agencement du clavier, l'installation sera lancée et effacera totalement les données sur votre disque dur !

  1. Sélectionnez `Graphical install`
  2. Sélectionnez votre langue, votre localisation, votre agencement de clavier et éventuellement votre timezone.
  3. L'installateur va ensuite télécharger les paquets requis et les installer.
[/ui-tab]
[ui-tab title="Installation en mode expert"]

Le projet YunoHost a simplifié au maximum l'installation classique afin d'éviter au plus grand nombre d'être perdu avec des questions trop techniques ou liées à des cas particuliers.

Avec l'installation en mode expert, vous avez plus de possibilités notamment concernant le partitionnement exact de vos supports de stockages. Vous pouvez aussi décider d'utiliser le mode classique et [ajouter vos disques après coup](/external_storage).

### Résumé des étapes en mode expert

  1. Sélectionnez `Expert graphical install`
  2. Sélectionnez votre langue, votre localisation, votre agencement de clavier et éventuellement votre timezone.
  3. Partitionner vos disques. C'est à cette étape que vous pouvez configurer un RAID ou chiffrer tout ou partie du serveur.
  4. Indiquez un éventuel proxy HTTP à utiliser pour l'installation des paquets
  5. Indiquez sur quels volumes grub doit être installé

### A propos du partitionnement

De façon générale, nous recommandons d'éviter de partitionner `/var`, `/opt`, `/usr`, `/bin`, `/etc`, `/lib`, `/tmp` et `/root` sur des partitions distinctes. Ceci vous évitera des soucis de partitions pleines qui pourraient mettre en panne votre machine, faire échouer l'installation d'app, voir même altérer vos bases de données.

Pour des raisons de performances, il est recommandé de monter votre stockage le plus rapide (SSD) sur la racine `/`.

Si vous avez un ou des disques durs pour stocker les données, vous pouvez choisir de les monter sur un de ces dossiers selon votre utilisation.

| Chemin | Contenu  |
|--------|---|
| `/home`                                | Dossiers utilisateurs accessibles via SFTP |
| `/home/yunohost.backup/archives`       | Sauvegardes YunoHost à placer idéalement ailleurs que sur les disques qui gérent les données |
| `/home/yunohost.app`                   | Données lourdes des applications YunoHost (nextcloud, matrix...) |
| `/home/yunohost.multimedia`            | Données lourdes partagées entre plusieurs applications |
| `/var/mail`                            | Mails des usagers  |

Si vous souhaitez de la souplesse et ne pas avoir à (re-)dimensionner des partitions, vous pouvez aussi choisir de monter sur `/mnt/hdd` et de suivre ce [tutoriel pour monter l'ensemble de ces dossiers avec `mount --bind`](/external_storage).

### A propos du chiffrement

Prenez bien en compte que si vous chiffrez tout ou partie de vos disques, vous aurez à taper la phrase de passe à chaque redémarrage de votre serveur, ce qui peut poser problème si vous n'êtes pas sur place. Il existe toutefois des solutions (assez difficiles à mettre en oeuvre) qui permettent de tapper la phrase via SSH ou via une page web (cherchez "dropbear encrypted disk").

### A propos du RAID

Ne perdez pas de vue que:

- les disques de vos RAID doivent être de marque, d'usure ou de lots distincts (surtout si ce sont des SSD)
- un RAID 1 (même sans disque de spare) est plus fiable qu'un RAID5 d'un point de vue probabilité
- les raid matériels sont dépendant de la carte raid, si celle-ci fait défaut il en faudra une de remplacement pour pouvoir lire et reconstruire la grappe

[/ui-tab]
[/ui-tabs]

!!! Si l'installation de YunoHost échoue sur votre machine et que vous n'arrivez pas à résoudre le problème, sachez qu'il est aussi possible d'installer Debian et ensuite d'installer YunoHost dessus. Voir ces instructions: https://yunohost.org/fr/administer/install/installing_debian
{% endif %}

{% if arm_unsup %}

## [fa=terminal /] Se connecter à la carte

Ensuite, il vous faut [trouver l'adresse IP locale de votre serveur](/finding_the_local_ip) pour vous connecter en tant que root [via SSH](/ssh) avec le mot de passe temporaire `1234`.

```bash
ssh root@192.168.x.xxx
```

{% endif %}

{% endif %}

{% if vps_debian or arm_unsup %}

## [fa=rocket /] Lancer le script d'installation

- Ouvrez la ligne de commande sur votre serveur (soit directement, soit avec [SSH](/ssh))
- Assurez-vous d'être connecté en tant que root (ou tapez `sudo -i` pour le devenir)
- Lancez la commande suivante :

```bash
curl https://install.yunohost.org | bash
```

!!! Si `curl` n'est pas installé sur votre système, il vous faudra peut-être l'installer avec `apt install curl`.
!!! Autrement, si la commande n'affiche rien du tout, vous pouvez tenter `apt install ca-certificates`

!!! **Note pour les utilisateurs avancés inquiets à propos de l'approche `curl|bash` :** prenez le temps de lire ["Is curl|bash insecure?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) sur le blog de Sandstorm, et possiblement [cette discussion sur Hacker News](https://news.ycombinator.com/item?id=12766350&noprocess).

{% endif %}

## [fa=cog /] Lancer la configuration initiale

!!! Si vous êtes en train de restaurer une sauvegarde YunoHost, vous devez sauter cette étape et vous référer à la section [Restaurer durant la post-installation à la place de cette étape de configuration initiale](/backup#restoring-during-the-postinstall).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]
{%if at_home %}
Dans un navigateur web, tapez dans la barre d'adresse **{% if internetcube %}`https://internetcube.local`{% else %}`https://yunohost.local` (utilisez `yunohost-2.local`, etc. s'il y a plusieurs serveurs YunoHost sur le réseau){% endif %}**.

!!! Si ça ne fonctionne pas, vous devez [chercher l'adresse IP locale du serveur](/finding_the_local_ip). L'adresse ressemble typiquement à `192.168.x.y`, et vous devriez taper `https://192.168.x.y` dans la barre d'adresse du navigateur.
{% else %}
Vous pouvez lancer la configuration initiale à partir du navigateur en tapant l'**adresse IP publique de votre serveur**. Généralement, votre fournisseur de VPS vous indique l'IP dans un email ou sur sa console de gestion.
{% endif %}

! Lors de la première visite, vous rencontrerez très probablement un avertissement de sécurité lié au certificat utilisé. Pour le moment, votre serveur utilise un certificat auto-signé. Vous pourrez plus tard ajouter un certificat automatiquement reconnu par les navigateurs comme décrit dans [la page sur les certificats](/certificate). En attendant, ajoutez une exception de sécurité pour accepter le certificat actuel. Toutefois, **s'il vous plaît**, ne prenez pas l'habitude d'accepter ce genre d'alerte de sécurité !

{% if not internetcube %}
Vous devriez ensuite obtenir cette page :

[figure class="nomargin" caption="Capture d'écran de la page de configuration initiale"]
![Page de configuration initiale](image://postinstall_web.png?resize=100%&class=inline)
[/figure]

{% endif %}
[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]

Vous pouvez aussi lancer la post-installation avec la commande `yunohost tools postinstall` directement sur le serveur ou [via SSH](/ssh).

[figure class="nomargin" caption="Capture d'écran de la configuration initiale en ligne de commande"]
![Configuration initiale en ligne de commande](image://postinstall_cli.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[/ui-tabs]

{% if not internetcube %}

### [fa=globe /] Domaine principal

C’est le nom de domaine qui permettra l’accès à votre serveur ainsi qu’au **portail d’authentification** des utilisateurs. Vous pourrez ensuite ajouter d'autres domaines, et changer celui qui sera le domaine principal si besoin.

- Si l'auto-hébergement est tout neuf pour vous et que vous n'avez pas encore de nom de domaine, nous recommandons d'utiliser un domaine en **.nohost.me** / **.noho.st** / **.ynh.fr** (exemple : `homersimpson.nohost.me`). S'il n'est pas déjà utilisé, le domaine sera automatiquement rattaché à votre serveur YunoHost, et vous n’aurez pas d’étape de configuration supplémentaire. Toutefois, notez que l'utilisation d'un de ces noms de domaines implique que vous n'aurez pas le contrôle complet sur votre configuration DNS.

- Si en revanche vous avez déjà votre propre nom de domaine, vous souhaitez probablement l'utiliser. Vous aurez donc besoin ensuite de configurer les enregistrements DNS comme expliqué [ici](/dns_config).

!!! Oui, vous *devez* configurer un nom de domaine. Si vous n'avez pas de nom de domaine et que vous n'en voulez pas en **.nohost.me**, **.noho.st** ou **.ynh.fr**, vous pouvez utilisez un « faux » domaine comme par exemple `yolo.test` et [modifier votre fichier `/etc/hosts` **sur votre ordinateur local** pour que ce domaine pointe vers l'IP de votre serveur, comme expliqué ici](/dns_local_network).

### [fa=key /] Premier compte utilisateur

Le premier compte utilisateur est créé à cette étape. Il vous faudra choisir un nom d'utilisateur et un mot de passe raisonablement complexe. (Nous ne pouvons que souligner l'importance du choix d'un mot de passe **robuste** !) Ce compte utilisateur sera ajouté au groupe Admins, et pourra se connecter au portail utilisateur, à la webadmin, et se connecter [via **SSH**](/ssh) ou [**SFTP**](/filezilla). Les admins recevront aussi les mails envoyés à `root@votredomaine.tld` et `admin@votredomaine.tld` : ces emails peuvent être utilisés pour envoyer des informations ou des alertes techniques. Vous pourrez plus tard ajouter d'autres comptes utilisateur supplémentaire, qu'il est aussi possible d'ajouter au groupe Admins.

Ce compte remplace l'ancien compte `admin`, qui est peut être toujours mentionné dans certaines pages de documentation. Dans ce cas, remplacez simplement `admin` par votre identifiant.

## [fa=stethoscope /] Lancer le diagnostic

Une fois la postinstall terminée, vous devriez pouvoir vous connecter à la webadmin en utilisant les identiants du premier compte utilisateur que vous venez de créer.

{% if virtualbox %}
! Rappel : YunoHost dans VirtualBox ne sera sans doute pas accessible depuis l'extérieur sans une configuration supplémentaire dans les paramètres de Virtualbox. Le diagnostique se plaindra sans doute de cela.
{% endif %}

Le système de diagnostic est conçu pour fournir un moyen facile de valider que tous les aspects critiques de votre serveur sont proprement configurés et pour vous guider dans la résolution des problèmes soulevés. Le diagnostic se lance deux fois par jour et envoie une alerte si un dysfonctionnement est détecté.

!!! N.B. : **ne partez pas en courant** ! La première fois que vous lancerez le diagnostic, il est assez normal d'avoir plusieurs alertes rouges ou jaunes car vous devez généralement [configurer les enregistrements DNS](/dns_config) (si vous n'utilisez pas un domaine `.nohost.me`, `.noho.st` ou `.ynh.fr`), ajouter un fichier de swap {%if at_home %} et/ou [configurer la redirection des ports](/isp_box_config){% endif %}.

!!! Si une alerte n'est pas pertinente (par exemple parce que vous ne pensez pas utiliser une fonctionnalité spécifique), il est tout à fait convenable d'indiquer le dysfonctionnement comme « À ignorer » en allant dans l'administration web > Diagnostic, et en cliquant sur le bouton « Ignorer » pour ce dysfonctionnement spécifique.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommandé) À partir de l'interface web"]
Pour lancer le diagnostic, allez dans l'Administration Web dans la partie Diagnostic. Vous devriez obtenir un écran comme celui-ci :

[figure class="nomargin" caption="Capture d'écran du panneau de diagnostic"]
![](image://diagnostic.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]

```bash
yunohost diagnosis run
yunohost diagnosis show --issues --human-readable
```

[/ui-tab]
[/ui-tabs]

## [fa=lock /] Obtenir un certificat Let's Encrypt

Une fois que vous avez configuré, si nécessaire, les enregistrements DNS et la redirection de ports, vous devriez être en mesure d'installer un certificat Let's Encrypt. Ceci permettra de supprimer l'étrange alerte de sécurité vue plus tôt.

Pour plus d'instructions détaillées, ou pour en savoir plus à propos des certificats SSL/TLS, voir [la page correspondante ici](/certificate).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]

[figure class="nomargin" caption="Capture d'écran du panneau pour installer un certificat Let's Encrypt"]
![](image://certificate-before-LE.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]

```bash
yunohost domain cert install
```

[/ui-tab]
[/ui-tabs]

## ![](image://tada.png?resize=32&classes=inline) Félicitations !

Vous avez maintenant un serveur plutôt bien configuré. Si vous découvrez YunoHost, nous vous recommandons de jeter un œil à [la visite guidée](/overview). Vous devriez aussi être en mesure d'[installer vos applications favorites](/apps). N'oubliez pas de [prévoir des sauvegardes](/backup) !

{% endif %}
{% endif %}
