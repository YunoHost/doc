# Contribuer

<p class="lead">
YunoHost dépend entièrement de la participation de gens comme vous.
</p>

---

<div class="row">
<div class="col col-md-3 lead">
<span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp; Passez le mot
</div>
<div class="col col-md-8" markdown="1">
Parlez de logiciel libre, d’[auto-hébergement](/selfhosting_fr), de YunoHost à vos proches et à votre travail. Nous comptons sur des évangélistes du Datalove comme vous <3
</div>
</div>

---

<div class="row">
<div class="col col-md-3 lead">
<span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp; Testez
</div>
<div class="col col-md-8" markdown="1">
Nous avons besoin de tester YunoHost profondément. Si vous trouvez un bug, essayez de l’identifier, puis reportez-le sur notre <a href="https://dev.yunohost.org/projects/yunohost/issues/new" target="_blank">bug tracker</a>.
</div>
</div>

---

<div class="row">
<div class="col col-md-3 lead">
<span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Aidez les utilisateurs
</div>
<div class="col col-md-8" markdown="1">
Notre support est communautaire et s’appuie sur des contributeurs comme vous. Venez simplement sur le [salon de discussion XMPP](/support_fr), ou tentez de répondre aux questions du <a href="https://forum.yunohost.org/" target="_blank">Forum</a>. Vous pouvez aussi organiser des <a href="https://hackstub.netlib.re/wiki/index.php?title=Atelier_3_avenir%28s%29_d%27internet_-_Introduction_%C3%A0_Yunohost_et_la_brique_internet" target="_blank">ateliers de formation</a>.
</div>
</div>

---

<div class="row">
<div class="col col-md-3 lead">
<span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp; Codez
</div>
<div class="col col-md-8" markdown="1">
Vous pouvez vous impliquer dans le développement de YunoHost peu importe votre niveau. Administrateurs système, développeurs web, designers et pythonistes <a href="https://github.com/YunoHost" target="_blank">sont les bienvenus</a>.<br>
Découvrez [comment contribuer](/dev_fr), et rejoignez-nous sur le [salon de discussion](xmpp:dev@conference.yunohost.org?join) et la <a href="http://list.yunohost.org/cgi-bin/mailman/listinfo/contrib">mailing-list</a> !
</div>
</div>

---

<div class="row">
<div class="col col-md-3 lead">
<span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp; Traduisez
</div>
<div class="col col-md-8" markdown="1">
Participez en rendant les interfaces de YunoHost disponibles dans votre langue. <a href="https://translate.yunohost.org/" target="_blank">Lancez-vous</a> !
</div>
</div>

---

<div class="row">
<div class="col col-md-3 lead">
<span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp; Écrivez
</div>
<div class="col col-md-8" markdown="1">
Améliorez cette documentation en [proposant de nouvelles pages](/write_documentation_fr) ou en traduisant les existantes dans votre langue.
</div>
</div>

---

<div class="row">
<div class="col col-md-3 lead">
<span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp; Packagez
</div>
<div class="col col-md-8" markdown="1">
Étendez les capacités de YunoHost en [packageant de nouveaux services et applications web](/packaging_apps_fr). Jetez un œil à [ce qui a déjà été fait](/apps_fr) !
<br>
Un [salon de développement](xmpp:dev@conference.yunohost.org?join) et une <a href="http://list.yunohost.org/cgi-bin/mailman/listinfo/apps">mailing-list</a> est également disponible.
</div>
</div>

---

<!--

<div class="row">
<div class="col col-md-3 lead">
<span class="glyphicon glyphicon glyphicon-upload"></span>&nbsp;&nbsp; Seedez
</div>
<div class="col col-md-8" markdown="1">
Seedez (partagez) avec le système de Torrent les images de YunoHost : [live](http://build.yunohost.org/yunohost-live.iso.torrent), [32 bits](http://build.yunohost.org/yunohostv2-latest-i386.iso.torrent) et [64 bits](http://build.yunohost.org/yunohostv2-latest-amd64.iso.torrent).
</div>
</div>

---

-->

<br>
<br>
<p class="lead" markdown="1">Dans tous les cas, venez sur le [salon de développement](xmpp:dev@conference.yunohost.org?join) pour contribuer :-)</p>

<script type="text/javascript" src="/jappix/javascripts/mini.min.js"></script>
<script type="text/javascript">
    // Jappix mini chat
    $(".actions").css('opacity', 0);
    jQuery.ajaxSetup({cache: false});

    var ADS_ENABLE = 'off';
    var JAPPIX_STATIC = '/jappix/';
    var HOST_BOSH = 'https://im.yunohost.org/http-bind/';
    var ANONYMOUS = 'on';
     JappixMini.launch({
        connection: {
           domain: "anonymous.yunohost.org",
        },
        application: {
           network: {
              autoconnect: false,
           },
           interface: {
              showpane: false,
              animate: false,
           },
           groupchat: {
              open: ['dev@conference.yunohost.org'],
              suggest: ['support@conference.yunohost.org']
           }
        },
     });
</script>
