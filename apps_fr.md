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
        <p><strong>Dernière mise à jour (UTC)</strong>: {app_update}</p>
        <p><strong>Mainteneur</strong>: {app_maintainer} <small class="text-muted">({app_mail})</small></p>
        <p><strong>Git</strong>: {app_git} <small class="text-muted">({app_branch})</small></p>
        <a href="#/app_{app_id}_fr" target="_blank" class="btn btn-default">Documentation</a>
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
      if (typeof infos.manifest.description.fr === 'undefined') {
        infos.manifest.description.fr = infos.manifest.description.en;
      }
      html = $('#app-template').html()
             .replace(/{app_id}/g, app_id)
             .replace(/{app_name}/g, infos.manifest.name)
             .replace('{app_description}', infos.manifest.description.fr)
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

### En cours d'intégration

| Nom | Packageur | État d'avancement | URL du git |
| --- | --- | --- | --- |
| LimeSurvey | zamentur | En cours | https://github.com/zamentur/limesurvey_ynh |
| Firefox Sync | beudbeud | En cours | https://github.com/abeudin/ffsync_ynh |
| OpenID | julien | En cours | https://github.com/julienmalik/openid-simplesamlphp_ynh |
| Shaarli | julien | En cours | https://github.com/julienmalik/shaarli_ynh |
| proFTPd | beudbeud | En dev | https://github.com/abeudin/proftpd_ynh.git |
| Lychee | titoko | En dev | https://github.com/titoko/lychee_ynh.git |
| Baïkal | aquaxp | En dev | https://github.com/aquaxp/baikal_ynh |
| Yourls | courgette | En test | https://github.com/thomaslebeau/yourls_ynh |
| OpenSondage | zamentur | En test | https://github.com/zamentur/opensondage_ynh |
| Strut | zamentur | En test | https://github.com/zamentur/strut_ynh |
| MyCryptoChat | mrtino | En test | https://github.com/mrtino/mycryptochat_ynh |
| MediaWiki | kload | En test | https://github.com/kloadut/mediawiki_ynh |
| Linux Dash | opi | en test | https://github.com/opi/linuxdash_ynh |
| Ampache | beudbeud | en test | https://github.com/abeudin/ampache_ynh |
| Piwigo | monsieur-a | en test | https://github.com/monsieur-a/piwigo_ynh |
| Etherpad-Lite | beudbeud | En test | https://github.com/abeudin/etherpadlite_ynh |
| Webmin | drfred1981 | En dev | https://github.com/drfred1981/webmin_ynh |
| Subsonic | drfred1981 | En dev | https://github.com/drfred1981/subsonic_ynh |

### À intégrer

* [Ethercalc](http://ethercalc.net/) / [Ethersheet](https://ethersheet.org/)
* [Sympa](http://www.sympa.org/)
* [Mumble](http://mumble.sourceforge.net/)
* [Ghost](http://ghost.org)
* [PluXML](http://www.pluxml.org/)
* [Piwigo](http://piwigo.org) / [openphoto](http://theopenphotoproject.org/)
* [Leed](http://projet.idleman.fr/leed/)
* [Autoblog](https://github.com/mitsukarenai/Projet-Autoblog)
* [Movim](http://www.movim.eu/)
* [KiwiIRC](http://kiwiirc.com/)
* [Piwik](http://piwik.org/)
* [Gitlab](http://gitlab.org/)
* [FileTea](https://filetea.me)
* [10er10](https://github.com/dready92/10er10)
* [Subsonic](http://www.subsonic.org)
* [Sick Beard](http://sickbeard.com)
* [Cops](http://blog.slucas.fr/fr/oss/calibre-opds-php-server)
* [PHProxy](http://sourceforge.net/projects/poxy/)
* [GPodder](https://gpodder.net)
* [Jitsi Meet](https://github.com/jitsi/jitsi-meet)
* [Mailman](https://www.gnu.org/software/mailman/)
* [Diaspora](https://diasporafoundation.org/)
* [MediaGoblin](http://mediagoblin.org/)
