#Apps &nbsp;&nbsp;<img src="https://yunohost.org/images/roundcube.png"><img src="https://yunohost.org/images/ttrss.png"><img src="https://yunohost.org/images/wordpress.png"><img src="https://yunohost.org/images/transmission.png"><img src="https://yunohost.org/images/jappix.png">

<div class="panel-group" id="app-accordion"></div>

<script type="text/template" id="app-template">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-title">
        <a data-toggle="collapse" data-parent="#app-accordion" href="#app_{app_id}">{app_name} <em><small>({app_id})</small></em></a>
      </div>
    </div>
    <div class="panel-collapse collapse app_{app_id}">
      <div class="panel-body">
        <p><strong>Description</strong>: {app_description}</p>
        <p><strong>Last update (UTC)</strong>: {app_update}</p>
        <p><strong>Maintainer</strong>: {app_maintainer} <small class="text-muted">({app_mail})</small></p>
        <p><strong>Git</strong>: <a href="{app_git}" target="_blank">{app_git}</a> <small class="text-muted">({app_branch})</small></p>
        <a href="#/app_{app_id}" target="_blank" class="btn btn-default">Documentation</a>
    </div>
  </div>
</script>

<script>
function timeConverter(UNIX_timestamp) {
    var a = new Date(UNIX_timestamp*1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    if (hour < 10) { hour = '0' + hour; }
    if (min < 10) { min = '0' + min; }
    var time = date+' '+month+' '+year+' at '+hour+':'+min;
    return time;
}

$(document).ready(function () {
  $.getJSON('/list.json', function(app_list) {
    // Cast as array
    var app_list = $.map(app_list, function(el) { return el; });
    // Sort alpha
    app_list.sort(function(a, b){
      if (a.manifest.id > b.manifest.id) {return 1;}
      else if (a.manifest.id < b.manifest.id) {return -1;}
      return 0;
    });
    $.each(app_list, function(k, infos) {
      app_id = infos.manifest.id;
      html = $('#app-template').html()
             .replace(/{app_id}/g, app_id)
             .replace(/{app_name}/g, infos.manifest.name)
             .replace('{app_description}', infos.manifest.description.en)
             .replace(/{app_git}/g, infos.git.url)
             .replace('{app_branch}', infos.git.branch)
             .replace('{app_update}', timeConverter(infos.lastUpdate));

      if (infos.manifest.developer) {
        html = html
          .replace('{app_maintainer}', infos.manifest.developer.name)
          .replace('{app_mail}', infos.manifest.developer.email);
      }

      if (infos.manifest.maintainer) {
        html = html
          .replace('{app_maintainer}', infos.manifest.maintainer.name)
          .replace('{app_mail}', infos.manifest.maintainer.email);
      }

      $('#app-accordion').append(html);
      $('.app_'+ app_id).attr('id', 'app_'+ app_id);
    });
  });

  $(".inprogress").each(function() {
    $(this).html( '<a class="btn btn-small btn-warning disabled" href="#">in progress</a>' );
  });
  $(".ready").each(function() {
    $(this).html( '<a class="btn btn-small btn-success disabled" href="#">ready</a>' );
  });

});
</script>


<br>

### Work in progress

The following applications are being worked on by a growing number of packagers.

They are <strong>NOT</strong> validated by the packaging team, and as such, no official support is provided for them.

You can test them, **at your own risk**, by installing them either through the [administration web]("/admin") interface by choosing "Install custom app", or using the [moulinette]("/moulinette"):
```bash
yunohost app install https://github.com/<packager>/<app_repository>
```

The packagers will appreciate your remarks. If you test them and find issues, or have ideas for improvement, do not hesitate to file issues directly on their repositories project page.

<br>

| Name | Packager | State | URL repositories | Description
| --- | --- | --- | --- | --- |
| [20euros](https://jatekos101.github.io/20euros/) | Moul | <div class="ready"/> | https://github.com/M5oul/20euros_ynh | Clone of 2048 game with euros |
| [243](https://hgentry.github.io/81/) | Moul | <div class="ready"/> | https://github.com/M5oul/243_ynh | Clone of 2048 game: goal reach 243 |
| [Ampache](http://ampache.org/) | beudbeud | <div class="ready"/> | https://github.com/abeudin/ampache_ynh | Web based audio/video streaming |
| [BTSync](http://www.getsync.com/) | tifred | <div class="inprogress"/> | https://github.com/drfred1981/btsync_ynh | File synchronization tool  |
| Chtickynotes | chtixof | <div class="ready"/> | https://github.com/chtixof/ynh-chtickynotes | A Post-it page |
| [COPS](http://cops.com) | lunarok | <div class="ready"/> | https://github.com/lunarok/cops_ynh | Frontend for Calibre library |
| [Couchpotato](https://couchpota.to/) | Chao-Man | <div class="ready"/> | https://github.com/Chao-Man/couchpotato_ynh | PVR for Usenet and torrents |
| [Cubiks-2048](https://kshitij-banerjee.github.io/Cubiks-2048/) | Moul | <div class="ready"/> | https://github.com/M5oul/Cubiks-2048_ynh | Clone of 2048 game in 3D |
| Custom Webapp (Multi instance) | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/my_webapp_ynh |Custom Webapp |
| [Diaspora](http://diasporafoundation.org) | aymhce | <div class="inprogress"/> | https://github.com/aymhce/diaspora_ynh | Distributed social networking service |
| [EmailPoubelle](http://forge.zici.fr/p/emailpoubelle-php/) | matlink | <div class="inprogress"/> | https://github.com/matlink/emailpoubelle_ynh | Disposable email |
| [EtherCalc](https://ethercalc.org/) | zamentur | <div class="inprogress"/> | https://github.com/zamentur/ethercalc_ynh | Web spreadsheet |
| [Etherpad-Lite](http://etherpad.org) | beudbeud | <div class="ready"/> | https://github.com/abeudin/etherpadlite_ynh | Real-time collaborative document editing |
| [FileBin](http://sebsauvage.net/wiki/doku.php?id=php:zerobin) | IsserTerrus | <div class="ready"/> | https://github.com/isserterrus/filebin_ynh | Online filebin |
| [Firefox Sync](https://www.mozilla.org/en-US/firefox/sync/) | beudbeud | <div class="ready"/> |https://github.com/abeudin/ffsync_ynh | Firefox synchronization server |
| [FreshRSS](http://freshrss.org/) | plopoyop | <div class="ready"/> | https://github.com/plopoyop/freshrss_ynh | RSS reader |
| [Friendica](http://friendica.com) | aymhce | <div class="inprogress"/> | https://github.com/aymhce/friendica_ynh | Social Communication Server |
| FTP support for webapp | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/ftp_support_webapp_ynh | FTP support for webapp |
| [HTML Tools](http://lehollandaisvolant.net/tout/tools/)| IsserTerrus | <div class="ready"/> | https://github.com/isserterrus/htmltools_ynh | HTML Mini-tools |
| [HTPC Manager](http://htpc.io) | lunarok | <div class="ready"/> | https://github.com/lunarok/htpc_ynh | Manage your HTPC |
| [Ghost](http://ghost.org) | ju | <div class="ready"/> | https://github.com/julienmalik/ghost_ynh | Blogging platform |
| [Gitolite](https://github.com/sitaramc/gitolite) | matlink | <div class="inprogress"/> | https://github.com/matlink/gitolite_ynh | Hosting git repositories |
| [Gitweb](https://git.wiki.kernel.org/index.php/Gitweb) | matlink | <div class="inprogress"/> | https://github.com/matlink/gitweb_ynh | Web interface for git |
| [GLPI + FusionInventory](http://www.glpi-project.org/?lang=en) | beudbeud | <div class="ready"/> | https://github.com/abeudin/glpi_ynh | IT And Asset managent |
| [Gogs](http://gogs.io/) | tostaki | <div class=" inprogress"/> | https://github.com/mbugeia/gogs_ynh | self-hosted Git service |
| [Jeedom](http://jeedom.fr) | lunarok | <div class="ready"/> | https://github.com/lunarok/jeedom_ynh | Home automation |
| [Jenkins](http://jenkins-ci.org/) | ju | <div class="ready"/> | https://github.com/julienmalik/jenkins_ynh | Continuous Integration platform |
| [Kanboard](http://kanboard.net/) | tostaki | <div class=" ready"/> | https://github.com/mbugeia/kanboard_ynh | Visual task board |
| [KiwiIRC](http://kiwiirc.com) | ju | <div class="ready"/> | https://github.com/julienmalik/kiwiirc_ynh | Web IRC client |
| [Laverna](https://laverna.cc/) | anaqreon | <div class="inprogress"/> | https://github.com/anaqreon/laverna_ynh | Note taking app |
| [Leed](http://projet.idleman.fr/leed/) | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/leed_ynh | RSS reader |
| [Let's Chat](http://sdelements.github.io/lets-chat/) | Pierre de La Morinerie | <div class="ready"/> | https://github.com/kemenaran/yunohost-lets-chat | Chat for small teams |
| [LimeSurvey](http://www.limesurvey.org/en/) | zamentur | <div class="inprogress"/> | https://github.com/zamentur/limesurvey_ynh | Web survey tool |
| [Linux Dash](http://linuxdash.afaqtariq.com/) | opi | <div class="ready"/> | https://github.com/opi/linuxdash_ynh | Monitoring web dashboard |
| [Lychee](http://lychee.electerious.com/) | titoko | <div class="inprogress"/> | https://github.com/titoko/lychee_ynh | Web photo-management |
| [Lutim](https://lut.im/) | Maniack Crudelis | <div class="inprogress"/> | https://github.com/maniackcrudelis/lutim_ynh | Anonymous image hosting service (not working at all !) |
| [Lutim](https://lut.im/) | Matlink | <div class="inprogress"/> | https://github.com/matlink/lutim_ynh | Anonymous image hosting service (working version) |
| [MediaWiki](https://mediawiki.org) | ElieSauveterre | <div class="ready"/> | https://github.com/mikangali-labs/mediawiki_ynh | Wiki platform |
| [miniflux](http://miniflux.net) | matanya | <div class="inprogress"/> | https://github.com/mat-mo/miniflux_ynh | RSS reader via RTL support |
| [Mumble Admin Plugin](http://wiki.mumble.info/wiki/MAP_-_Mumb1e_Admin_Plugin) | matlink | <div class="inprogress"/> | https://github.com/matlink/mumble_admin_plugin_ynh | Web interface to manage mumble server |
| [Mumble Server](http://wiki.mumble.info/wiki/Main_Page) | matlink | <div class="ready"/> | https://github.com/matlink/mumbleserver_ynh | Voice chat for gaming and meeting |
| [Munin](http://munin-monitoring.org/) | ju | <div class="ready"/> | https://github.com/julienmalik/munin_ynh | System Monitoring graphing tool |
| [Monit](http://mmonit.com/monit/) | ju | <div class="ready"/> | https://github.com/julienmalik/monit_ynh | Daemon Monitoring tool |
| [MyCryptoChat](https://github.com/HowTommy/mycryptochat) | mrtino | <div class="ready"/> | https://github.com/mrtino/mycryptochat_ynh | Encrypted chat rooms manager |
| [OFBiz](https://ofbiz.apache.org/) | julien | <div class="inprogress"/> | https://github.com/nomakaFr/ofbiz_ynh | ERP |
| [OpenDKIM](http://opendkim.org/) | polytan02 | <div class="inprogress"/> | https://github.com/polytan02/opendkim_ynh | OpenDKIM for Yunohost installation script |
| [OpenID](http://openid.net/) | ju | <div class="inprogress"/> | https://github.com/julienmalik/openid-simplesamlphp_ynh | OpenID Identity server |
| [OpenWRT](http://openwrt.org) | lunarok | <div class="ready"/> | https://github.com/lunarok/openwrt_ynh | Reverse proxy for OpenWRT installation |
| [phpBB](http://www.phpbb.com/) | polytan02 | <div class="ready"/> | https://github.com/polytan02/phpBB_ynh | #1 forum in php with adaptive design - Requires manual configuration after initial installation |
| [phpLDAPadmin](http://phpldapadmin.sourceforge.net/) | aymhce | <div class="ready"/> | https://github.com/aymhce/phpldapadmin_ynh | LDAP database web manager |
| [PHPSysinfo](https://phpsysinfo.github.io/phpsysinfo/) | lunarok | <div class="ready"/> | https://github.com/lunarok/phpsysinfo_ynh | Informations about your system |
| [Piwigo](http://piwigo.org) | monsieur-a | <div class="ready"/> | https://github.com/monsieur-a/piwigo_ynh | Web photo gallery |
| [Piwik](http://piwik.org) | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/piwik_ynh | Web analytics platform |
| [Plexmediaserver](https://plex.tv/) | Chao-Man | <div class="inprogress"/> | https://github.com/Novakin/plexmediaserver_ynh | PlexMediaServer |
| [PluXml](http://www.pluxml.org/) | matlink | <div class="inprogress"/> | https://github.com/matlink/pluxml_ynh | Blogging platform |
| [proFTPd](http://www.proftpd.org/) | beudbeud | <div class="inprogress"/> | https://github.com/abeudin/proftpd_ynh | FTP server |
| PSP Adhoc Server | matlink | <div class="inprogress"/> | https://github.com/matlink/adhocserver_ynh | |
| [Pydio](http://pyd.io) | ju | <div class="inprogress"/> | https://github.com/julienmalik/pydio_ynh | File sharing and synchronization |
| [Radicale](http://radicale.org/) | beudbeud | <div class="ready"/> | https://github.com/abeudin/radicale_ynh | Caldav & Carddav Server |
| [Rainloop](http://rainloop.net/) | polytan02 | <div class="ready"/> | https://github.com/polytan02/rainloop_ynh | Rainloop : nice and simple webmail - configuration by hand |
| [Red Matrix](https://redmatrix.me/) | anaqreon | <div class="inprogress"/> | https://github.com/anaqreon/redmatrix_ynh | Social network and decentralized identity platform |
| [Sabnzbd](http://http://sabnzbd.org/) | Chao-Man | <div class="ready"/> | https://github.com/Chao-Man/sabnzbd_ynh | Automated Usenet download |
| [SCM-Manager](https://www.scm-manager.org/) | tifred | <div class="inprogress"/> | https://github.com/drfred1981/scm-manager_ynh | Share and manage repositories over HTTP |
| [Shaarli](http://sebsauvage.net/wiki/doku.php?id=php:shaarli) | ju | <div class="inprogress"/> | https://github.com/julienmalik/shaarli_ynh | Delicious clone |
| [Sickbeard](http://sickbeard.com) | Chao-Man | <div class="ready"/> | https://github.com/Chao-Man/sickbeard_ynh | PVR and episode guide that downloads and manages all your TV shows |
| [Subsonic](http://subsonic.org) | tifred | <div class="inprogress"/> | https://github.com/drfred1981/subsonic_ynh | Web-based media server |
| [TagSpaces](http://www.tagspaces.org/) | scith | <div class="inprogress"/> | https://github.com/scith/tagspaces_ynh | Manage files using tags |
| [Tor Relay](https://www.torproject.org/docs/tor-doc-relay.html.en) | matlink | <div class="inprogress"/> | https://github.com/matlink/torrelay_ynh | Tor Node |
| [Webmin](http://webmin.com) | tifred | <div class="inprogress"/> | https://github.com/drfred1981/webmin_ynh | Web-based system configuration tool |
| [Wordpress multisite](http://codex.wordpress.org/Create_A_Network) | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/wordpress_ynh | Wordpress with network support |
| [YaCy](http://yacy.net) | Moul | <div class="inprogress"/> | https://github.com/M5oul/yacy_ynh/ | Libre and decentralized search engine |
| [Yourls](http://yourls.org/) | courgette | <div class="ready"/> | https://github.com/courgette/yourls_ynh |  URL Shortening service |
| Yunofav | [xof](https://forum.yunohost.org/users/xof) | <div class="ready"/> | https://github.com/chtixof/yunofav | Page of favorite links Yunohost-styled |
| [Zomburl](http://cadav.re/) | courgette | <div class="inprogress"/> | https://github.com/courgette/zomburl_ynh | URL Shortening service |
| [ZoteroSync](http://blog.holz.ca/2011/11/phpzoterowebdav-installation/) | scith | <div class="inprogress"/> | https://github.com/scith/zoterosync_ynh | Sync Zotero library and files |
| [Z-Push](https://z-push.org/) | beudbeud | <div class="ready"/> | https://github.com/abeudin/z-push_ynh | ActiveSync Server |



### Wishlist

The following list is a compiled wishlist of applications that would be nice-to-have.

[Edit this list](/write_documentation) to add your own favorite app, or learn to [package apps](/packaging_apps) yourself.

* [10er10](https://github.com/dready92/10er10)
* [adminer](http://www.adminer.org/)
* [Ajenti](http://ajenti.org/)
* [Autoblog](https://github.com/mitsukarenai/Projet-Autoblog)
* [Bootstrap](http://getbootstrap.com/)
* [Browsepass](http://techualization.blogspot.de/2013/09/introducing-browsepass-keepass-on-web.html)
* [Caliopen](https://www.caliopen.org/)
* [CumulusClips](http://cumulusclips.org/)
* [DemocracyOS](http://democracyos.org/)
* [Discourse](http://discourse.org/)
* [Dotclear](http://dotclear.org/)
* [Ethersheet](https://ethersheet.org/)
* [Fail2web](https://github.com/Sean-Der/fail2web)
* [FileTea](https://filetea.me)
* [Fossil](http://www.fossil-scm.org)
* [Git-annex](http://git-annex.branchable.com/)
* [Gitit](http://gitit.net/)
* [GitLab](http://gitlab.org/)
* [Gollum](https://github.com/gollum/gollum)
* [Grav](http://getgrav.org/)
* [Guacamole](http://guac-dev.org/)
* [h5ai](http://larsjung.de/h5ai/)
* [Headphones](https://github.com/rembo10/headphones)
* [Hi Buddy](http://hibuddy.monkeypatch.me/)
* [Huginn](https://github.com/cantino/huginn)
* [ikiwiki](http://ikiwiki.info/)
* [img.bi](https://img.bi/)
* [Inbox](https://www.inboxapp.com/)
* [Jitsi Meet](https://github.com/jitsi/jitsi-meet)
* [jsFiddle](http://jsbin.com/help/2-second-setup)
* [Known](https://withknown.com/)
* [KrISS feed](https://github.com/tontof/kriss_feed)
* [Kune](https://en.wikipedia.org/wiki/Kune_%28software%29)
* [LSTU](https://github.com/ldidry/lstu)
* [Mailman](https://www.gnu.org/software/mailman/)
* [Mailpile](https://www.mailpile.is)
* [MPD](http://www.musicpd.org/)
* [MediaCrush](https://mediacru.sh/)
* [MediaGoblin](http://mediagoblin.org/)
* [MinigalNano](https://github.com/sebsauvage/MinigalNano)
* [Modoboa](http://modoboa.org/)
* [Mopidy](https://www.mopidy.com/)
* [Movim](http://www.movim.eu/)
* [Odoo ERP](https://www.odoo.com)
* [pdfy](https://github.com/joepie91/pdfy)
* [Pelican](http://blog.getpelican.com/)
* [PHPList](http://www.phplist.com/)
* [PHProxy](http://sourceforge.net/projects/poxy/)
* [Pico](http://picocms.org/)
* [Pix](http://pix.toile-libre.org/)
* [PPTP VPN](https://packages.debian.org/sv/squeeze/pptpd)
* [Pulse](https://ind.ie/pulse/)
* [Pump.io](http://pump.io)
* [racktables](http://racktables.org/)
* [remotestorage-server](http://remotestorage.io/provide/)
* [Respawn 2.0](https://github.com/broncowdd/respawn)
* [uMap](https://umap.openstreetmap.fr/en/)
* [Scramble, Browser-based PGP web mail](https://github.com/dcposch/scramble)
* [Scribbleton](https://scribbleton.com/)
* [scrumblr](http://scrumblr.ca/)
* [Shleuder](http://schleuder2.nadir.org/)
* [Sonerezh](https://github.com/Sonerezh)
* [Streisand](https://github.com/jlund/streisand)
* [SVG-Edit](https://code.google.com/p/svg-edit/)
* [Sympa](http://www.sympa.org/)
* [Syncthing](http://syncthing.net/)
* [Taiga](https://taiga.io/)
* [Total Respawn](https://github.com/broncowdd/TotalRespawn)
* [TorChat](https://github.com/prof7bit/TorChat)
* [Twister](http://twister.net.co/)
* [Unvis](https://github.com/phixofor/unvis.it)
* [Vaultier](http://www.vaultier.org/)
* [Webmpc](https://github.com/ushis/webmpc)
* [WebODF](http://webodf.org/)
* [webSync](http://furier.github.io/websync/)
* [Wisemapping](http://www.wisemapping.com/)
* [ZNC](http://wiki.znc.in/ZNC)
