#YunoHost <small> est un outil qui vous permet d’installer et d’utiliser facilement votre propre serveur.</small>

<br>

<div style="width: 100%; height: 290px; overflow: hidden;
border-radius: 5px; border: 1px solid rgba(0,0,0,0.15); box-shadow: 0 5px 15px rgba(0,0,0,0.15);">
<img style="width: 100%; min-width: 580px;" src="http://pix.toile-libre.org/upload/original/1388434791.jpg">
</div>

<br>

<div class="text-center" style="width: 23%; min-width: 130px; margin: 0 auto;">
<a class="btn btn-primary btn-lg btn-block"  style="font-size: 1.5em" href="#/install_fr">Installer</a>
<p class="text-muted text-center"><small>YunoHost v2 • beta2</small></p>
</div>

<hr>

### <blockquote>Fonctionnalités</blockquote>

YunoHost vous permet par défaut de gérer vos adresses mail et de messagerie instantanée via des interfaces simples d’utilisation et de manière sécurisée. 

Vous pourrez également étendre les fonctionnalités via des [**apps**](#/apps_fr) installables en un click.


### <blockquote>Logiciels</blockquote>

Il est basé sur [Debian GNU/Linux](http://www.debian.org/index.fr.html) (wheezy) et se compose des logiciels libres suivants :
* [Nginx](http://nginx.org/)
* [Postfix](http://www.postfix.org/)
* [Metronome](http://www.lightwitch.org/metronome)
* [OpenLDAP](http://www.openldap.org/)
* [Dovecot](http://www.dovecot.org/)
* [dspam](http://nuclearelephant.com/)
* [Amavis](http://amavis.org/)
* [Bind](https://www.isc.org/downloads/bind/)
* [Samba](http://www.samba.org/)
* [Tahoe-LAFS](https://tahoe-lafs.org/trac/tahoe-lafs)
* [SSOwat](https://github.com/Kloadut/SSOwat)

YunoHost configure tous ces logiciels automatiquement à l’installation, puis l’utilisation se fait via [l’interface admin](#/admin_fr) ou via la [moulinette](#/moulinette_fr) (CLI).

### <blockquote>Sécurité</blockquote>

Tous les protocoles utilisés par YunoHost sont sécurisés par défaut. Vous disposez d’un certificat auto-signé pour chaque domaine géré par votre serveur.

Par ailleurs tous les logiciels composant YunoHost sont libres, connus, utilisés, et sont de fait peu vulnérables aux attaques.

Un pare-feu est également déployé dès l’installation, vous protégeant contre les connexions indésirables et dangereuses.

<br>
<div class="text-center"><img style="width: 100px" src="http://pix.toile-libre.org/upload/original/1386012810.png" />
<p>[Github](https://github.com/YunoHost) <b>/</b> [FAQ](https://ask.yunohost.org) <b>/</b> [Traduction](https://translate.yunohost.org/) <b>/</b> [Ancien Wiki](http://wiki.yunohost.org) </p>
</div>

<script type="text/javascript">
    jQuery.ajaxSetup({cache: true});
    jQuery.getScript("https://doc.yunohost.org/jappix-fr.js", function() {
      MINI_GROUPCHATS = ["support@conference.yunohost.org"];
      HOST_ANONYMOUS = "yunohost.org";
      HOST_MUC = "conference.yunohost.org";
      HOST_BOSH = "https://yunohost.org/http-bind/";
      HOST_BOSH_MINI = "https://yunohost.org/http-bind/";
      LOCK_HOST = 'on';
      MINI_ANIMATE = true;
      MINI_ANONYMOUS = true;
      launchMini(false, true, 'yunohost.org');
    });
    $("#edit").hide();
</script>
