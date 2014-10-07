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
        <p><strong>Last update (UTC)x</strong>: {app_update}</p>
        <p><strong>Maintainer</strong>: {app_maintainer} <small class="text-muted">({app_mail})</small></p>
        <p><strong>Git</strong>: {app_git} <small class="text-muted">({app_branch})</small></p>
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
    console.log(app_list);
    $.each(app_list, function(app_id, infos) {
      html = $('#app-template').html()
             .replace(/{app_id}/g, app_id)
             .replace(/{app_name}/g, infos.manifest.name)
             .replace('{app_description}', infos.manifest.description.en)
             .replace('{app_maintainer}', infos.manifest.developer.name)
             .replace('{app_mail}', infos.manifest.developer.email)
             .replace('{app_git}', infos.git.url)
             .replace('{app_branch}', infos.git.branch)
             .replace('{app_update}', timeConverter(infos.lastUpdate));
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

You can test them, at your own risk, by installing them either through the [administration web]("/admin") interface by choosing "Install custom app", or using the [moulinette]("/moulinette") :
```bash
yunohost app install https://github.com/<packager>/<app_repository>
```

The packagers will appreciate your remarks. If you test them and find issues, or have ideas for improvement, do not hesitate to file issues directly on the dedicated GitHub project page.

<br>

| Name | Packager | State | URL |
| --- | --- | --- | --- |
| EtherCalc | zamentur | <div class="inprogress"/> | https://github.com/zamentur/ethercalc_ynh |
| LimeSurvey | zamentur | <div class="inprogress"/> | https://github.com/zamentur/limesurvey_ynh |
| Firefox Sync | beudbeud | <div class="inprogress"/> | https://github.com/abeudin/ffsync_ynh |
| OpenID | julien | <div class="inprogress"/> | https://github.com/julienmalik/openid-simplesamlphp_ynh |
| Shaarli | julien | <div class="inprogress"/> | https://github.com/julienmalik/shaarli_ynh |
| Zomburl | courgette | <div class="inprogress"/> | https://github.com/courgette/zomburl_ynh |
| proFTPd | beudbeud | <div class="inprogress"/> | https://github.com/abeudin/proftpd_ynh.git |
| Lychee | titoko | <div class="inprogress"/> | https://github.com/titoko/lychee_ynh.git |
| FreshRSS | plopoyop | <div class="ready"/> | https://github.com/plopoyop/freshrss_ynh |
| Yourls | courgette | <div class="ready"/> | https://github.com/courgette/yourls_ynh |
| MyCryptoChat | mrtino | <div class="ready"/> | https://github.com/mrtino/mycryptochat_ynh |
| MediaWiki | kload | <div class="ready"/> | https://github.com/kloadut/mediawiki_ynh |
| Linux Dash | opi | <div class="ready"/> | https://github.com/opi/linuxdash_ynh |
| Ampache | beudbeud | <div class="ready"/> | https://github.com/abeudin/ampache_ynh |
| Piwigo | monsieur-a | <div class="ready"/> | https://github.com/monsieur-a/piwigo_ynh |
| Etherpad-Lite | beudbeud | <div class="ready"/> | https://github.com/abeudin/etherpadlite_ynh |
| Webmin | tifred | <div class="inprogress"/> | https://github.com/drfred1981/webmin_ynh |
| Ghost | julien | <div class="ready"/> | https://github.com/julienmalik/ghost_ynh |
| Subsonic | tifred | <div class="inprogress"/> | https://github.com/drfred1981/subsonic_ynh |
|Leed | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/leed_ynh |
| Custom Webapp (Multi instance) | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/my_webapp_ynh |
| FTP support for webapp | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/ftp_support_webapp_ynh |
| Jeedom | lunarok | <div class="ready"/> | https://github.com/lunarok/jeedom_ynh |
| COPS | lunarok | <div class="ready"/> | https://github.com/lunarok/cops_ynh |
| OpenWRT | lunarok | <div class="ready"/> | https://github.com/lunarok/openwrt_ynh |
| PHPSysinfo | lunarok | <div class="ready"/> | https://github.com/lunarok/phpsysinfo_ynh |
| HTPC Manager | lunarok | <div class="ready"/> | https://github.com/lunarok/htpc_ynh |
| Piwik | Maniack Crudelis | <div class="ready"/> | https://github.com/maniackcrudelis/piwik_ynh |
| KiwiIRC | julien | <div class="ready"/> | https://github.com/julienmalik/kiwiirc_ynh |
| FileBin | IsserTerrus | <div class="ready"/> | https://github.com/isserterrus/filebin_ynh |
| Pydio | julienmalik | <div class="inprogress"/> | https://github.com/julienmalik/pydio_ynh |
| Sickbeard | Chao-Man | <div class="ready"/> | https://github.com/Chao-Man/sickbeard_ynh |
| Couchpotato | Chao-Man | <div class="ready"/> | https://github.com/Chao-Man/couchpotato_ynh |
| Sabnzbd | Chao-Man | <div class="ready"/> | https://github.com/Chao-Man/sabnzbd_ynh |
| Plexmediaserver | Chao-Man | <div class="ready"/> | https://github.com/Chao-Man/plexmediaserver_ynh |

### Wishlist

The following list is a compiled wishlist of applications that would be nice-to-have.

[Edit this list](/write_documentation) to add your own favorite app, or learn to [package apps](/packaging_apps) yourself.

<br>

* [Ethersheet](https://ethersheet.org/)
* [Mumble](http://mumble.sourceforge.net/)
* [PluXML](http://www.pluxml.org/)
* [Autoblog](https://github.com/mitsukarenai/Projet-Autoblog)
* [Movim](http://www.movim.eu/)
* [GitLab](http://gitlab.org/)
* [FileTea](https://filetea.me)
* [10er10](https://github.com/dready92/10er10)
* [PHProxy](http://sourceforge.net/projects/poxy/)
* [Jitsi Meet](https://github.com/jitsi/jitsi-meet)
* [Sympa](http://www.sympa.org/)
* [Mailman](https://www.gnu.org/software/mailman/)
* [PHPList](http://www.phplist.com/)
* [Shleuder](http://schleuder2.nadir.org/)
* [Diaspora](https://diasporafoundation.org/)
* [MediaGoblin](http://mediagoblin.org/)
* [CumulusClips](http://cumulusclips.org/)
* [RainLoop](http://rainloop.net/)
* [Mailpile](https://www.mailpile.is)
* [ZNC](http://wiki.znc.in/ZNC)
* [Tor relay](https://www.torproject.org/docs/tor-doc-relay.html.en)
* [uMap](https://umap.openstreetmap.fr/en/)
* [Sickbeard](http://sickbeard.com/)
* [CouchPotato](https://couchpota.to/)
* [Headphones](https://github.com/rembo10/headphones)
* [Sabnzbd](http://sabnzbd.org/)
* [MediaCrush](https://mediacru.sh/)
* [Lutim](https://github.com/ldidry/lutim)

