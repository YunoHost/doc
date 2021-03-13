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
    - '/docker'
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
---
{% set image_type = 'YunoHost' %}
{% set arm, at_home, regular, rpi2plus, rpi1, rpi0, arm_sup, arm_unsup, vps, vps_debian, vps_ynh, virtualbox, internetcube, docker = false, false, false, false, false, false, false, false, false, false, false, false, false, false %}
{% set hardware = uri.param('hardware')  %}

{% if hardware == 'regular' %}
  {% set regular = true %}
{% elseif hardware == 'internetcube' %}
  {% set arm, arm_sup, internetcube = true, true, true %}
  {% set image_type = 'La Brique Internet' %}
{% elseif hardware == 'rpi2plus' %}
  {% set arm, rpi2plus = true, true %}
{% elseif hardware == 'rpi1' %}
  {% set arm, rpi1 = true, true %}
{% elseif hardware == 'rpi0' %}
  {% set arm, rpi0 = true, true %}
{% elseif hardware == 'arm_sup' %}
  {% set arm, arm_sup = true, true %}
{% elseif hardware == 'arm_unsup' %}
  {% set arm, arm_unsup = true, true %}
  {% set image_type = 'Armbian' %}
{% elseif hardware == 'vps_debian' %}
  {% set vps, vps_debian = true, true %}
{% elseif hardware == 'vps_ynh' %}
  {% set vps, vps_ynh = true, true %}
{% elseif hardware == 'virtualbox' %}
  {% set at_home, virtualbox = true, true %}
{% elseif hardware == 'docker' %}
  {% set docker = true %}
{% endif %}

{% if arm or regular %}
  {% set at_home = true %}
{% endif %}

Sélectionnez le matériel sur lequel vous souhaitez installer YunoHost :
[div class="flex-container"]

[div class="flex-child hardware{%if virtualbox %} active{% endif %}"]
[[figure caption="VirtualBox"]![](image://virtualbox.png?height=75)[/figure]](/install/hardware:virtualbox)
[/div]

[div class="flex-child hardware{%if rpi2plus or rpi1 or rpi0 %} active{% endif %}"]
[[figure caption="Raspberry Pi"]![](image://raspberrypi.jpg?height=75)[/figure]](/install/hardware:rpi2plus)
[/div]

[div class="flex-child hardware{%if arm_sup or arm_unsup or internetcube %} active{% endif %}"]
[[figure caption="Carte ARM"]![](image://olinuxino.jpg?height=75)[/figure]](/install/hardware:arm_sup)
[/div]

[div class="flex-child hardware{%if regular %} active{% endif %}"]
[[figure caption="Ordinateur standard"]![](image://computer.png?height=75)[/figure]](/install/hardware:regular)
[/div]

[div class="flex-child hardware{%if vps_debian or vps_ynh %} active{% endif %}"]
[[figure caption="Serveur distant"]![](image://vps.png?height=75)[/figure]](/install/hardware:vps_debian)
[/div]

[/div]
[div class="flex-container pt-2"]

{% if rpi2plus or rpi1 or rpi0 %}
[div class="flex-child hardware{%if rpi2plus %} active{% endif %}"]
[[figure caption="Raspberry Pi 2, 3 ou 4"]![](image://raspberrypi.jpg?height=50)[/figure]](/install/hardware:rpi2plus)
[/div]

[div class="flex-child hardware{%if rpi1 %} active{% endif %}"]
[[figure caption="Raspberry Pi 1"]![](image://rpi1.jpg?height=50)[/figure]](/install/hardware:rpi1)
[/div]

[div class="flex-child hardware{%if rpi0 %} active{% endif %}"]
[[figure caption="Raspberry Pi zero"]![](image://rpi0.jpg?height=50)[/figure]](/install/hardware:rpi0)
[/div]
{% elseif arm_sup or arm_unsup or internetcube %}

[div class="flex-child hardware{%if internetcube %} active{% endif %}"]
[[figure caption="La Brique Internet avec un VPN"]![](image://internetcube.png?height=50)[/figure]](/install/hardware:internetcube)
[/div]

[div class="flex-child hardware{%if arm_sup and not internetcube %} active{% endif %}"]
[[figure caption="Olinuxino lime1&2 ou Orange Pi PC+"]![](image://olinuxino.jpg?height=50)[/figure]](/install/hardware:arm_sup)
[/div]

[div class="flex-child hardware{%if arm_unsup %} active{% endif %}"]
[[figure caption="Autres cartes ARM"]![](image://odroidhc4.png?height=50)[/figure]](/install/hardware:arm_unsup)
[/div]
{% elseif vps_debian or vps_ynh %}

[div class="flex-child hardware{%if vps_debian %} active{% endif %}"]
[[figure caption="VPS ou serveur dédié avec Debian 10"]![](image://debian-logo.png?height=50)[/figure]](/install/hardware:vps_debian)
[/div]

[div class="flex-child hardware{%if vps_ynh %} active{% endif %}"]
[[figure caption="VPS ou serveur dédié avec YunoHost pre-installé"]![](image://logo.png?height=50)[/figure]](/install/hardware:vps_ynh)
[/div]

{% endif %}

[/div]


{% if hardware != '' %}

{% if docker %}
!! **YunoHost ne supporte plus officiellement Docker depuis les problèmes rencontrés avec la version 2.4+. En cause, YunoHost dépend désormais de systemd et Docker a décidé qu’il ne le supporterait pas nativement (et il y a d'autres problèmes liés au firewall et aux services).**
!!
!! **Nous vous décourageons fortement d'utiliser YunoHost sur docker avec ces images**

## Images communautaires

Cependant, ces images communautaires existent et sont disponibles sur Docker Hub:

  * [AMD64 (classic) (YunoHost 4.x)](https://hub.docker.com/r/domainelibre/yunohost/)
  * [I386 (old computers) (YunoHost 4.x)](https://hub.docker.com/r/domainelibre/yunohost-i386/)
  * [ARM64V8 (Raspberry Pi 4) (YunoHost 4.x)](https://hub.docker.com/r/cms0/yunohost/)
  * [ARMV7 (Raspberry Pi 2/3 ...) (YunoHost 4.x)](https://hub.docker.com/r/domainelibre/yunohost-arm/)
  * [ARMV6 (Raspberry Pi 1) (ancienne version de YunoHost)](https://hub.docker.com/r/tuxalex/yunohost-armv6/)
{% else %}


## [fa=list-alt /] Pré-requis

{% if regular %}
* Un matériel compatible x86 dédié à YunoHost : portable, netbook, ordinateur avec 512Mo de RAM et 16Go de capacité de stockage (au moins) ;
{% elseif rpi2plus %}
* Un Raspberry Pi 2, 3 ou 4 ;
{% elseif rpi1 %}
* Un Raspberry Pi 1 avec au moins 512Mo de RAM ;
{% elseif rpi0 %}
* Un Raspberry Pi zero ;
{% elseif internetcube %}
* Un Orange Pi PC+ ou une Olinuxino Lime 1 ou 2 ;
* Un VPN avec une IP publique dédiée et un fichier `.cube` ;
{% elseif arm_sup %}
* Un Orange Pi PC+ ou une Olinuxino Lime 1 ou 2 ;
{% elseif arm_unsup %}
* Une carte ARM avec au moins 512Mo de RAM ;
{% elseif vps_debian %}
* Un serveur dédié ou virtuel avec Debian 10 (Buster) pré-installé <small>(avec un **kernel >= 3.12**)</small>, 512Mo de RAM et 16Go de capacité de stockage (au moins) ;
{% elseif vps_ynh %}
* Un serveur dédié ou virtuel avec YunoHost pré-installé, 512Mo de RAM et 16Go de capacité de stockage (au moins) ;
{% elseif virtualbox %}
* Un ordinateur x86 avec [VirtualBox installé](https://www.virtualbox.org/wiki/Downloads) et assez de RAM disponible pour lancer une petite machine virtuelle avec 1024Mo de RAM et 8Go de capacité de stockage (au moins) ;
{% endif %}
{% if arm %}
* Une alimentation électrique (soit un adaptateur, soit un cable microUSB) pour alimenter la carte ;
* Une carte microSD : 16Go de capacité (au moins), [classe « A1 »](https://fr.wikipedia.org/wiki/Carte_SD#Vitesse) hautement recommandée (comme par exemple [cette carte SanDisk A1](https://www.amazon.fr/SanDisk-microSDHC-Adaptateur-homologu%C3%A9e-Nouvelle/dp/B073JWXGNT/)) ;
{% endif %}
{% if regular %}
* Une clé USB avec au moins 1Go de capacité OU un CD vierge standard ;
{% endif %}
{% if at_home %}
* Un [fournisseur d'accès internet correct](/isp), de préférence avec une bonne vitesse d’upload ;
{% if rpi0 %}
* Un câble OTG ou un adaptateur Wifi USB pour connecter votre Raspberry Pi Zero ;
{% elseif not virtualbox %}
* Un câble ethernet/RJ-45 pour brancher la carte à votre routeur/box internet ;
{% endif %}
* Un ordinateur pour lire ce guide, flasher l'image et accéder à votre serveur.
{% endif %}
{% if not at_home %}
* Un ordinateur ou un smartphone pour lire ce guide et accéder à votre serveur.
{% endif %}

{% if virtualbox %}
! N.B. : Installer YunoHost dans une VirtualBox est utile pour tester la distribution. Pour réellement s'autohéberger sur le long terme, il vous faudra probablement une machine physique (vieil ordinateur, carte ARM...) ou un serveur en ligne.
{% endif %}




{% if vps_ynh %}
## Fournisseurs de VPS YunoHost
Ci-dessous une liste de fournisseurs de VPS supportant nativement YunoHost :

[div class="flex-container"]

[div class="flex-child"]
[[figure caption="Alsace Réseau Neutre - FR"]![](image://vps_ynh_arn.png?height=50)[/figure]](https://vps.arn-fai.net)
[/div]

[/div]
{% endif %}


{% if at_home %}
## [fa=download /] Télécharger l'image {{image_type}}

{% if virtualbox or regular %}
!!! Si votre hôte est en 32 bits, faite bien attention à télécharger l'image 32 bits.
{% elseif arm_unsup %}
<a href="https://www.armbian.com/download/" target="_BLANK" type="button" class="btn btn-info col-sm-12">[fa=external-link] Télécharger l'image pour votre carte sur le site d'Armbian</a>

!!! N.B.: il vous faut télécharger l'image Armbian Buster.
{% endif %}


<div class="hardware-image">
<div id="cards-list">
</div>
</div>
<script type="text/template" id="image-template">
<div id="{id}" class="card panel panel-default">
        <div class="panel-body text-center pt-2">
            <h3>{name}</h3>
            <div class="card-comment">{comment}</div>
            <div class="card-desc text-center">
<img src="/user/images/{image}" height=100 style="vertical-align:middle">
            </div>
        </div>
        <div class="annotations flex-container">
            <div class="flex-child annotation"><a href="{file}.sha256sum">[fa=barcode] Somme de contrôle</a></div>
            <div class="flex-child annotation"><a href="{file}.sig">[fa=tag] Signature</a></div>
        </div>
        <div class="btn-group" role="group">
            <a href="{file}" target="_BLANK" type="button" class="btn btn-info col-sm-12">[fa=download] Télécharger <small>{version}</small></a>
        </div>
</div>
</script>
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
    $.getJSON('https://build.yunohost.org/images.json', function (images) {
        $.each(images, function(k, infos) {
            if (infos.tuto.indexOf(hardware) == -1) return;
            // Fill the template
            html = $('#image-template').html()
             .replace('{id}', infos.id)
             .replace('{name}', infos.name)
             .replace('{comment}', infos.comment || "&nbsp;")
             .replace('{image}', infos.image)
             .replace('{version}', infos.version);
 
            if (infos.file.startsWith("http"))
                html = html.replace(/{file}/g, infos.file);
            else
                html = html.replace(/{file}/g, "https://build.yunohost.org/"+infos.file);
   
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

Si vous êtes sur GNU/Linux / macOS et que vous êtes familier avec la ligne de commande, il est possible de flasher la clef USB ou carte SD avec dd. Vous pouvez identifier le nom du périphérique avec `fdisk -l` ou `lsblk`. Une carte SD s'appelle typiquement `/dev/mmcblk0`. ATTENTION à faire attention de prendre le bon nom !

Ensuite lancez :

```bash
# Remplacez /dev/mmcblk0 si le nom de votre périphérique est différent...
dd if=/path/to/yunohost.img of=/dev/mmcblk0
```

[/ui-tab]
{% if regular %}
[ui-tab title="Copier un CD/DVD"]
Pour les anciens matériels, il vous faut peut-être utiliser un CD/DVD. Le logiciel à utiliser est différent suivant votre système d’exploitation.

* Sur Windows, utilisez [ImgBurn](http://www.imgburn.com/) pour écrire l’image sur le disque

* Sur macOS, utilisez [Disk Utility](http://support.apple.com/kb/ph7025)

* Sur GNU/Linux, vous avez plusieurs choix, tels que [Brasero](https://wiki.gnome.org/Apps/Brasero) ou [K3b](http://www.k3b.org/)

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

* Sélectionnez `Accès par pont`
* Choisissez votre interface selon son nom :
    **wlan0** si vous êtes connecté sans-fil, **eth0** ou **eno1** sinon.

![](image://virtualbox_2.png?class=inline)

{% endif %}









{% if arm %}
## [fa=plug /] Démarrer la carte

* Branchez le câble ethernet (un côté sur votre box, l'autre côté à votre carte).
    * Pour les utilisateurs et utilisatrices souhaitant configurer la carte pour la connecter via le WiFi à la place, voir [cet exemple](https://www.raspberrypi.org/documentation/configuration/wireless/wireless-cli.md).
* Mettez la carte SD dans le serveur.
* (Faculatif) Il est possible de brancher un écran et clavier sur votre serveur en cas de soucis ou pour vérifier que le processus de démarrage (boot) se passe bien ou encore pour avoir un accès direct en console.
* Branchez l'alimentation.
* Laissez quelques minutes à votre serveur pour s'autoconfigurer durant le premier démarrage.
* Assurez-vous que votre ordinateur (de bureau ou portable) est connecté au même réseau local (c'est-à-dire la même box internet) que votre serveur.

{% elseif virtualbox %}
## [fa=plug /] Lancer la machine virtuelle

Démarrez votre machine virtuelle après avoir sélectionné l'image YunoHost.

![](image://virtualbox_2.1.png?class=inline)

! Si vous rencontrez l'erreur "VT-x is not available", il vous faut probablement activer (enable) la virtualisation dans les options du BIOS de votre ordinateur.

{% else %}
## [fa=plug /] Démarrer la machine sur la clé USB

* Branchez le câble ethernet (un côté à votre box, de l'autre côté à votre carte).
* Démarrez votre serveur avec la clé USB ou le CD-ROM inséré, et sélectionnez-le comme **périphérique de démarrage (bootable device)** en pressant l’une des touches suivantes (dépendant de votre ordinateur) :
`<ESC>`, `<F9>`, `<F10>`, `<F11>`, `<F12>` or `<DEL>`.
    * N.B. : si le serveur était précédemment installé avec une version récente de Windows (8+), vous devez d'abord demander à Windows de « redémarrer réellement ». Vous pouvez le faire dans une oiption du menu « Options de démarrage avancées ».
{% endif %}

{% if regular or virtualbox %}
## [fa=rocket /] Lancer l’installation graphique

!! N.B. : L'installation effacera totalement les données sur votre disque dur !

Vous devriez voir un écran comme ça :

[figure class="nomargin" caption="Capture d'écran du menu de l'ISO"]
![](image://virtualbox_3.png?class=inline)
[/figure]

  1. Sélectionnez `Graphical install`
  2. Sélectionnez votre langue, votre localisation et votre agencement de clavier.
  3. L'installateur va ensuite télécharger les paquets requis et les installer.

{% endif %}


{% if rpi1 or rpi0 %}
## [fa=bug /] Se connecter à la carte et corriger l'image
Les Raspberry Pi 1 et 0 ne sont pas totalement supportés à cause de [problèmes de compilation pour cette architecture](https://github.com/YunoHost/issues/issues/1423).

Cependant, il est possible de corriger l'image par vous-même avant de lancer la configuration initiale.

Pour y parvenir, vous devez vous connectez à votre Raspberry Pi en tant que root [via SSH](/ssh) avec le mot de passe temporaire `yunohost`:
```
ssh root@yunohost.local
```

Ensuite, lancez les commandes suivantes pour contourner le dysfonctionnement de metronome :
```
mv /usr/bin/metronome{,.bkp}
mv /usr/bin/metronomectl{,.bkp}
ln -s /usr/bin/true /usr/bin/metronome
ln -s /usr/bin/true /usr/bin/metronomectl
```

Et celle-ci pour contourner celui de upnpc :
```
sed -i 's/import miniupnpc/#import miniupnpc/g' /usr/lib/moulinette/yunohost/firewall.py
```

! Cette dernière commande nécessite d'être lancée après chaque mise à jour de YunoHost :/

{% elseif arm_unsup %}
## [fa=terminal /] Se connecter à la carte

Ensuite, il vous faut [trouver l'adresse IP locale de votre serveur](/finding_the_local_ip) pour vous connecter en tant que root [via SSH](/ssh) avec le mot de passe temporaire `1234`.

```
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

!!! Si vous êtes en train de restaurer une sauvegarde YunoHost, vous devez sauter cette étape et vous référer à la section [Restaurer durant la postinstallation à la place de cette étape de configuration initiale](/backup#restoring-during-the-postinstall).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]
{%if at_home %}
Dans un navigateur web, tapez dans la barre d'adresse **{% if internetcube %}`https://internetcube.local`{% else %}`https://yunohost.local`{% endif %}**.

!!! Si ça ne fonctionne pas, vous devez [chercher l'adresse IP locale du serveur](/finding_the_local_ip). L'adresse ressemble typiquement à `192.168.x.y`, et vous devriez taper `https://192.168.x.y` dans la barre d'adresse du navigateur.
{% else %}
Vous pouvez lancer la configuration initiale à partir du navigateur en tapant l'**adresse IP publique de votre serveur**. Généralement, votre fournisseur de VPS vous indique l'IP dans un mail ou sur sa console de gestion.
{% endif %}

! Lors de la première visite, vous rencontrerez très probablement un avertissement de sécurité lié au certificat utilisé. Pour le moment, votre serveur utilise un certificat auto-signé. Vous pourrez plus tard ajouter un certificat automatiquement reconnus par les navigateurs comme décrit dans [la page sur les certificats](/certificate). En attendant, ajoutez une exception de sécurité pour accepter le certificat actuel. Toutefois, **s'il vous plaît**, ne prenez pas l'habitude d'accepter ce genre d'alerte de sécurité !

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

##### [fa=globe /] Domaine principal

C’est le nom de domaine qui permettra l’accès à votre serveur ainsi qu’au **portail d’authentification** des utilisateurs. Vous pourrez ensuite ajouter d'autres domaines, et changer celui qui sera le domaine principal si besoin.

* Si l'auto-hébergement est tout neuf pour vous et que vous n'avez pas encore de nom de domaine, nous recommandons d'utiliser un domaine en **.nohost.me** / **.noho.st** / **.ynh.fr** (exemple : `homersimpson.nohost.me`). S'il n'est pas déjà utilisé, le domaine sera automatiquement rattaché à votre serveur YunoHost, et vous n’aurez pas d’étape de configuration supplémentaire. Toutefois, notez que l'utilisation d'un de ces noms de domaines implique que vous n'aurez pas le contôle complet sur votre configuration DNS.

* Si en revanche vous avez déjà votre propre nom de domaine, vous souhaitez probablement l'utiliser. Vous aurez donc besoin ensuite de configurer les enregistrements DNS comme expliqué [ici](/dns_config).

!!! Oui, vous *devez* configurer un nom de domaine. Si vous n'avez pas de nom de domaine et que vous n'en voulez pas en **.nohost.me**, **.noho.st** ou **.ynh.fr**, vous pouvez utilisez un « faux » domaine comme par exemple `yolo.test` et modifier votre fichier `/etc/hosts` pour que ce domaine pointe vers l'IP de votre serveur, comme expliqué [ici](/dns_local_network).

##### [fa=key /] Mot de passe d’administration
C’est le mot de passe qui vous permettra d’accéder à l’interface d’administration de votre serveur. Vous pourrez également l’utiliser pour vous connecter à distance [via SSH](/ssh), ou [en SFTP](/filezilla) pour transférer des fichiers. De manière générale, c’est la **clé d’entrée à votre système**, pensez donc à la choisir attentivement.

## [fa=user /] Créer un premier utilisateur

Une fois la configuration initiale faite, vous devriez être capable de vous connecter à l'interface d'administration web en utilisant le mot de passe d'administration.

Bien que votre serveur dispose maintenant d'un utilisateur `admin`, cet utilisateur `admin` n'est pas un utilisateur "standard" et ne peut pas se connecter sur le [portail utilisateur](/users).

Par conséquent, vous devriez ajouter un premier utilisateur « standard ».

!!! Le premier utilisateur que vous créez est un peu spécial : il recevra les emails envoyés à `root@votredomaine.tld` et `admin@votredomaine.tld`. Ces emails peuvent être utilisés pour envoyer des informations ou des alertes techniques.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="A partir de l'interface web"]

Allez dans `Users > Add`

TODO: add a screenshot
[/ui-tab]
[ui-tab title="A partir de la ligne de commande"]
```
yunohost user create johndoe
```
TODO : copypasta an actual shell session will all info asked etc..

[/ui-tab]
[/ui-tabs]
{% endif %}

## [fa=stethoscope /] Lancer le diagnostic

Le système de diagnostic est conçu pour fournir un moyen facile de valider que tous les aspects critiques de votre serveur sont proprement configurés et pour vous guider dans la résolution des problèmes soulevés. Le diagnostic se lance deux fois par jour et envoie une alerte si un dysfonctionnement est détecté.

!!! N.B. : **ne partez pas en courant** ! La première fois que vous lancerez le diagnostic, il est assez normal d'avoir plusieurs alertes rouges ou jaunes car vous devez généralement [configurer les enregistrements DNS](/dns_config) (si vous n'utilisez pas un domaine `.nohost.me`, `.noho.st` ou `.ynh.fr`), ajouter un fichier de swap {%if at_home %} et/ou [configurer la redirection des ports](/isp_box_config){% endif %}.

!!! Si une alerte n'est pas pertinente (par exemple parce que vous ne pensez pas utiliser une fonctionnalité spécifique), il est tout à fait convenable d'indiquer le dysfonctionnement comme « À ignorer » en allant dans l'administration web > Diagnostic, et en cliquant sur bouton « Ignorer » pour ce dysfonctionnement spécifique.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommandé) A partir de l'interface web"]
Pour lancer le diagnostic, allez dans l'Administration Web dans la partie Diagnostic. Vous devriez obtenir un écran comme celui-ci :

[figure class="nomargin" caption="Capture d'écran du panneau de diagnostic"]
![](image://diagnostic.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="A partir de la ligne de commande"]
```
yunohost diagnosis run
yunohost diagnosis show --issues --human-readable
```
[/ui-tab]
[/ui-tabs]

## [fa=lock /] Obtenir un certificat Let's Encrypt

Une fois que vous avez configuré, si nécessaire, les enregistrements DNS et la redirection de ports, vous devriez être en mesure d'installer un certificat Let's Encrypt. Ceci permettra de supprimer l'étrange alerte de sécurité vue plus tôt.

Pour plus d'instructions détaillées, ou pour en savoir plus à propos des certificats SSL/TLS, voir [la page correspondante ici](/certificate).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="A partir de l'interface web"]

[figure class="nomargin" caption="Capture d'écran du panneau pour installer un certificat Let's Encrypt"]
![](image://certificate-before-LE.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="A partir de la ligne de commande"]
```
yunohost domain cert-install
```
[/ui-tab]
[/ui-tabs]
{% endif %}

## ![](image://tada.png?resize=32&classes=inline) Félicitations !

Vous avez maintenant un serveur plutôt bien configuré. Si vous découvrez YunoHost, nous vous recommandons de jeter un oeil à [la visite guidée](/overview). Vous devriez aussi être en mesure d'[installer  vos applications favorites](/apps). N'oubliez pas de [prévoir des sauvegardes](/backup) !

{% endif %}
