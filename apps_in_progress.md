# Apps in progress <img src="https://yunohost.org/images/freshrss_logo.png" width=50> <img src="https://yunohost.org/images/Icons_mumble.svg" width=50> <img src="https://yunohost.org/images/Lutim_small.png" width=40> <img src="https://yunohost.org/images/PluXml-logo_transparent.png" width=70> <img src="https://yunohost.org/images/rainloop_logo.png" width=50> <img src="https://yunohost.org/images/Etherpad.svg" width=50> <img src="https://yunohost.org/images/gogs.png" width=50>

<a class="btn btn-lg btn-default" href="/apps_en">Official apps</a> <a class="btn btn-lg btn-default disabled" href="/apps_in_progress_en">Apps in progress</a> <a class="btn btn-lg btn-default" href="/apps_wishlist_en">Apps wishlist</a>

The following applications are being packaged on by a growing number of packagers.
<div class="alert alert-danger">They are **NOT** validated by the packaging team, and as such, **no official support is provided** for them.<br>
You can test and use them **at your own risk**.
</div>

You can install them through the [administration web interface](/admin) by choosing "Install custom app", or using the [moulinette](/moulinette):
```bash
yunohost app install https://github.com/<packager>/<app_repository>
```

The packagers will appreciate your remarks. If you test them and find issues, or ideas for improvement, do not hesitate to file issues directly on their repositories project page.

<div class="clearfix" style="margin-bottom: 1em;">
<div class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#app-accordion2 .collapse">View all</div>
</div>


<div class="panel-group" id="app-accordion2"></div>

<script type="text/template" id="app-template2">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-title">
        <a data-toggle="collapse" data-parent="#app-accordion" href="apps_in_progress/#app_{app_id}">{app_name} <em><small>({app_id})</small></em></a>
      </div>
    </div>
    <div class="panel-collapse collapse app_{app_id}">
      <div class="panel-body">
        <div class="{app_state}"/>
        <p><strong>Description</strong>: {app_description}</p>
        <p><strong>Last update (UTC)</strong>: {app_update}</p>
        <p><strong>Maintainer</strong>: {app_maintainer} <small class="text-muted">({app_mail})</small></p>
        <p><strong>Git repository</strong>: <a href="{app_git}" target="_blank">{app_git}</a> <small class="text-muted">({app_branch})</small></p>
        <p><strong>Software license</strong>: {app_license}</p>
    </div>
  </div>
</script>

<script>
function timeConverter(UNIX_timestamp) {
    var a = new Date(UNIX_timestamp*1000);
    var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
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
      html = $('#app-template2').html()
             .replace(/{app_id}/g, app_id)
             .replace(/{app_name}/g, infos.manifest.name)
             .replace('{app_description}', infos.manifest.description.en)
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
              $(this).html( '<a class="btn btn-small btn-danger disabled" href="#">Not working</a>' );
          });
          $(".inprogress").each(function() {
              $(this).html( '<a class="btn btn-small btn-warning disabled" href="#">In progress</a>' );
          });
          $(".ready").each(function() {
              $(this).html( '<a class="btn btn-small btn-success disabled" href="#">Ready</a>' );
          });
      }, 3000);
    });
  });
});
</script>
