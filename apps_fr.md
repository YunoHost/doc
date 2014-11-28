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

Une liste d'application en cours d'intégration est disponible sur la [page anglaise](/apps_en).

