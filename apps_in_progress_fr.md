# Apps en cours <img src="https://yunohost.org/images/freshrss_logo.png" width=50> <img src="https://yunohost.org/images/Icons_mumble.svg" width=50> <img src="https://yunohost.org/images/Lutim_small.png" width=40> <img src="https://yunohost.org/images/PluXml-logo_transparent.png" width=70> <img src="https://yunohost.org/images/rainloop_logo.png" width=50> <img src="https://yunohost.org/images/Etherpad.svg" width=50> <img src="https://yunohost.org/images/gogs.png" width=50>

<a class="btn btn-lg btn-default" href="/apps_fr">Apps officielles</a>
<a class="btn btn-lg btn-default disabled" href="/apps_in_progress_fr">Apps en cours</a>
<a class="btn btn-lg btn-default" href="/apps_wishlist_fr">Apps souhaitées</a>

De plus en plus d'applications sont mises à disposition par les packagers.
<div class="alert alert-danger">Ces applications **n’ont pas** été validées par l’équipe YunoHost et  **ne sont pas** officiellement prises en charge.<br>Vous pouvez les tester et les utiliser à **vos risques et périls**.
</div>

Elles sont installables avec l’[interface web d'administration](/admin) ou avec la moulinette :
```bash
yunohost app install https://github.com/<packageur>/<dépôt_app>
```

N’hésitez pas à vous créer un compte GitHub pour faire part de vos remarques aux packagers (sous forme d’«&nbsp;issues&nbsp;») ou à leur proposer des améliorations (sous forme de «&nbsp;pull requests&nbsp;»).

<div class="clearfix" style="margin-bottom: 1em;">
<div class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#app-accordion2 .collapse">Tout déplier</div>
</div>

<div class="panel-group" id="app-accordion2"></div>

<script type="text/template" id="app-template2">
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
        <p><strong>Licence de l’application</strong> : {app_license}</p>
        <div class="{app_state}"/>
    </div>
  </div>
</script>

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
    var time = date+' '+month+' '+year+' at '+hour+':'+min;
    return time;
}

$(document).ready(function () {
  $.getJSON('/community.json', function(app_list) {
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
      html = $('#app-template2').html()
             .replace(/{app_id}/g, app_id)
             .replace(/{app_name}/g, infos.manifest.name)
             .replace('{app_description}', infos.manifest.description.fr)
             .replace(/{app_git}/g, infos.git.url)
             .replace('{app_branch}', infos.git.branch)
             .replace('{app_update}', timeConverter(infos.lastUpdate))
             .replace('{app_state}', infos.state)
             .replace('{app_license}', infos.manifest.license);

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

      $('#app-accordion2').append(html);
      $('.app_'+ app_id).attr('id', 'app_'+ app_id);

      setTimeout(function() {
          $(".notworking").each(function() {
              $(this).html( '<a class="btn btn-small btn-danger disabled" href="#">Non fonctionnel</a>' );
          });
          $(".inprogress").each(function() {
              $(this).html( '<a class="btn btn-small btn-warning disabled" href="#">En cours</a>' );
          });
          $(".ready").each(function() {
              $(this).html( '<a class="btn btn-small btn-success disabled" href="#">Fonctionnel</a>' );
          });
      }, 3000);
    });
  });
});
</script>
