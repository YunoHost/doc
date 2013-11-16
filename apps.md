#Apps

<ul id="app-list"></ul>

<script>
$(document).ready(function () {
  $.getJSON('http://app.yunohost.org/list.json', function(app_list) {
    console.log(app_list);
    $.each(app_list, function(app_id, infos) {
      $('#app-list').append('<li><a data-app-id="'+ app_id +'">'+ infos.manifest.name +'</a></li>');
    });
  });
});
</script>
