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
});
</script>


<br>

### Work in progress

| Name | Packager | State | URL |
| --- | --- | --- | --- |
| EtherCalc | zamentur | in progress | https://github.com/zamentur/ethercalc_ynh |
| LimeSurvey | zamentur | in progress | https://github.com/zamentur/limesurvey_ynh |
| Firefox Sync | beudbeud | in progress | https://github.com/abeudin/ffsync_ynh |
| OpenID | julien | in progress | https://github.com/julienmalik/openid-simplesamlphp_ynh |
| Shaarli | julien | in progress | https://github.com/julienmalik/shaarli_ynh |
| Zomburl | courgette | in progress | https://github.com/courgette/zomburl_ynh |
| proFTPd | beudbeud | in progress | https://github.com/abeudin/proftpd_ynh.git |
| Lychee | titoko | in progress | https://github.com/titoko/lychee_ynh.git |
| Baïkal | julien | in progress | https://github.com/julienmalik/baikal_ynh |
| FreshRSS | plopoyop | in progress | https://github.com/plopoyop/freshrss_ynh |
| Yourls | courgette | ready | https://github.com/courgette/yourls_ynh |
| OpenSondage | zamentur | ready | https://github.com/zamentur/opensondage_ynh |
| Strut | zamentur | ready | https://github.com/zamentur/strut_ynh |
| MyCryptoChat | mrtino | ready | https://github.com/mrtino/mycryptochat_ynh |
| MediaWiki | kload | ready | https://github.com/kloadut/mediawiki_ynh |
| Linux Dash | opi | ready | https://github.com/opi/linuxdash_ynh |
| Ampache | beudbeud | ready | https://github.com/abeudin/ampache_ynh |
| Piwigo | monsieur-a | ready | https://github.com/monsieur-a/piwigo_ynh |
| Etherpad-Lite | beudbeud | ready | https://github.com/abeudin/etherpadlite_ynh |
| Webmin | tifred | in progress | https://github.com/drfred1981/webmin_ynh |
| Ghost | julien | ready | https://github.com/julienmalik/ghost_ynh |
| Sick Beard | julien | in progress |  |
| Subsonic | tifred | in progress | https://github.com/drfred1981/subsonic_ynh |
|Leed | Maniack Crudelis | ready | https://github.com/maniackcrudelis/leed_ynh |
| Custom Webapp (Multi instance) | Maniack Crudelis | ready | https://github.com/maniackcrudelis/my_webapp_ynh |
| FTP support for webapp | Maniack Crudelis | ready | https://github.com/maniackcrudelis/ftp_support_webapp_ynh |
| Jeedom | lunarok | ready | https://github.com/lunarok/jeedom_ynh |
| COPS | lunarok | ready | https://github.com/lunarok/cops_ynh |
| OpenWRT | lunarok | ready | https://github.com/lunarok/openwrt_ynh |
| PHPSysinfo | lunarok | ready | https://github.com/lunarok/phpsysinfo_ynh |
| HTPC Manager | lunarok | ready | https://github.com/lunarok/htpc_ynh |
| Hextris | opi | ready | https://github.com/opi/hextris_ynh |
| Piwik | Maniack Crudelis | ready | https://github.com/maniackcrudelis/piwik_ynh |

### TODO list

* [Ethersheet](https://ethersheet.org/)
* [Mumble](http://mumble.sourceforge.net/)
* [PluXML](http://www.pluxml.org/)
* [Autoblog](https://github.com/mitsukarenai/Projet-Autoblog)
* [Movim](http://www.movim.eu/)
* [KiwiIRC](http://kiwiirc.com/)
* [GitLab](http://gitlab.org/)
* [FileTea](https://filetea.me)
* [10er10](https://github.com/dready92/10er10)
* [PHProxy](http://sourceforge.net/projects/poxy/)
* [Jitsi Meet](https://github.com/jitsi/jitsi-meet)
* [Sympa](http://www.sympa.org/)
* [Mailman](https://www.gnu.org/software/mailman/)
* [PHPList](http://www.phplist.com/)
* [Diaspora](https://diasporafoundation.org/)
* [MediaGoblin](http://mediagoblin.org/)
* [CumulusClips](http://cumulusclips.org/)
* [RainLoop](http://rainloop.net/)
* [Mailpile](https://www.mailpile.is)
