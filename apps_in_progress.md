# Apps in progress

<img src="/images/freshrss_logo.png" width=40>
<img src="/images/Icons_mumble.svg" width=40>
<img src="/images/Lutim_small.png" width=30>
<img src="/images/PluXml-logo_transparent.png" width=60>
<img src="/images/rainloop_logo.png" width=40>
<img src="/images/Etherpad.svg" width=40>
<img src="/images/gogs.png" width=40>
<img src="/images/movim_logo.png" width=40>

<a class="btn btn-lg btn-default" href="/apps_en">Official apps</a> 
<a class="btn btn-lg btn-default disabled" href="/apps_in_progress_en">Apps in progress</a>
<a class="btn btn-lg btn-default" href="/apps_wishlist_en">Apps wishlist</a>

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
<div class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#app-accordion2-notworking .collapse">Collapse broken</div>
<div class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#app-accordion2-inprogress .collapse">Collapse in progress</div>
<div class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#app-accordion2-working .collapse">Collapse working</div>
</div>

<h2>Declared as working applications</h2>
<p><b style="color: red">Important: it's the application maintaineur that qualify his application as working, not the YunoHost core team. Install it at your own risks. We won't provide support for it.</b></p>

<div class="panel-group" id="app-accordion2-working"></div>

<h2>Work in progress applications</h2>
<p>Those are <b>not yet finished</b> applications, we <b>strongly advise against installing them</b> except if you know what you are doing.</p>

<div class="panel-group" id="app-accordion2-inprogress"></div>

<h2>Broken applications</h2>
<p>Do <b>NOT</b> install them, they are here as reference while they aren't fixed.</p>

<div class="panel-group" id="app-accordion2-notworking"></div>

<script type="text/template" id="app-template2">
  <div class="panel panel-default panel-{app_state_bootstrap}">
    <div class="panel-heading">
      <div class="panel-title">
        <a data-toggle="collapse" data-parent="#app-accordion" href="apps_in_progress/#app_{app_id}">{app_name} <em><small>({app_id})</small></em></a>
      </div>
    </div>
    <div class="panel-collapse collapse app_{app_id}">
      <div class="panel-body">
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
  $.getJSON('https://app.yunohost.org/community.json', function(app_list) {
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
      if (infos.state === "working") {
        app_state_bootstrap = "default";
      } else if (infos.state === "inprogress") {
        app_state_bootstrap = "warning";
      } else if (infos.state === "notworking") {
        app_state_bootstrap = "danger";
      }

      html = $('#app-template2').html()
             .replace(/{app_id}/g, app_id)
             .replace(/{app_name}/g, infos.manifest.name)
             .replace('{app_description}', infos.manifest.description.en)
             .replace(/{app_git}/g, infos.git.url)
             .replace('{app_branch}', infos.git.branch)
             .replace('{app_update}', timeConverter(infos.lastUpdate))
             .replace('{app_state}', infos.state)
             .replace('{app_state_bootstrap}', app_state_bootstrap)
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

      $('#app-accordion2-' + infos.state).append(html);
      $('.app_'+ app_id).attr('id', 'app_'+ app_id);
    });
  });
});
</script>
