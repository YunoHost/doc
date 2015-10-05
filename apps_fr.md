#Apps officielles&nbsp;&nbsp;<img src="https://yunohost.org/images/roundcube.png" width=50><img src="https://yunohost.org/images/ttrss.png" width=50><img src="https://yunohost.org/images/wordpress.png" width=50><img src="https://yunohost.org/images/transmission.png" width=50><img src="https://yunohost.org/images/jappix.png" width=50><img src="https://yunohost.org/images/logo-jirafeau.jpeg" width=50><img src="https://yunohost.org/images/Logo-wallabag-svg.svg" width=50><img src="https://yunohost.org/images/Searx_logo.svg" width=50>

<a class="btn btn-lg btn-default" href="/apps_fr" disabled>Apps officielles</a> <a class="btn btn-lg btn-default" href="/apps_in_progress_fr">Apps en cours</a> <a class="btn btn-lg btn-default" href="/apps_wishlist_fr">Apps souhaitées</a>

<div class="clearfix" style="margin-bottom: 1em;">
<div class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#app-accordion .collapse">Tout déplier</div>
</div>

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
        <p><strong>Description</strong> : {app_description}</p>
        <p><strong>Dernière mise à jour (UTC)</strong> : {app_update}</p>
        <p><strong>Mainteneur</strong> : {app_maintainer} <small class="text-muted">({app_mail})</small></p>
        <p><strong>Dépôt git</strong> : <a href="{app_git}" target="_blank">{app_git}</a> <small class="text-muted">({app_branch})</small></p>
        <a href="#/app_{app_id}_fr" target="_blank" class="btn btn-default">Documentation</a>
    </div>
  </div>
</script>
<br />
<div class="alert alert-info">Toutes les applications officielles sont sous licences libres.</div>

<script>
function timeConverter(UNIX_timestamp) {
    var a = new Date(UNIX_timestamp*1000);
    var months = ['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    if (hour < 10) { hour = '0' + hour; }
    if (min < 10) { min = '0' + min; }
    var time = date+' '+month+' '+year+' à '+hour+':'+min;
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
});
</script>