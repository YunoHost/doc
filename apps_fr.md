#Apps
---

### Disponibles

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
      if (typeof infos.manifest.description.fr === undefined) {
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
| Radicale | beudbeud | Testée | https://github.com/abeudin/radicale_ynh |
| Wordpress | beudbeud | Testée | https://github.com/abeudin/wordpress_ynh |
| Owncloud | kload | Testée | https://github.com/Kloadut/owncloud_ynh |
| Firefox Sync | beudbeud | En cours | https://github.com/abeudin/ffsync_ynh |
| OpenID | julien | En test | https://github.com/julienmalik/openid-simplesamlphp_ynh |
| Shaarli | julien | En test | https://github.com/julienmalik/shaarli_ynh |

### À intégrer

* [Etherpad lite](http://etherpad.org/)
* [Sympa](http://www.sympa.org/)
* [OpenSondage](https://github.com/framasoft/OpenSondage) (framadate)
* [Poche](http://www.inthepoche.com/)
* [Mumble](http://mumble.sourceforge.net/)
* [Ghost](http://ghost.org)
* [PluXML](http://www.pluxml.org/)
* [OpenVPN](http://openvpn.net/)
* [Piwigo](http://piwigo.org)
* [ZeroBin](http://sebsauvage.net/wiki/doku.php?id=php:zerobin)


