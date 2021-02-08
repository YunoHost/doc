---
title: Catalogue d'applications
template: docs
taxonomy:
    category: docs
routes:
  default: '/apps'
twig_first: true
process:
    twig: true
---

<div class="javascriptDisclaimer">
Cette page requiert que JavaScript soit activé pour s'afficher correctement :s.
</div>

<div class="input-group">
    <span id="filter-app-icon" class="input-group-addon"><i class="fa fa-search"></i></span>
    <input id="filter-app-cards" type="text" class="form-control"  placeholder="Rechercher des apps..." aria-describedby="basic-addon1"/>
</div>

!!! L'équipe de packaging d'applications sera heureuse de recevoir vos commentaires ! Si vous trouvez des problèmes ou des améliorations possibles en installant une app, n'hésitez pas à contribuer en créant un ticket (issue) directement sur le dépôt de code.

! Les applications étiquettées <span class="label label-warning label-as-badge">mauvaise qualité</span> fonctionnent peut-être, mais ne respectent pas les bonnes pratiques de packaging ou ne supportent pas certaines fonctionnalités comme les sauvegardes/restauration ou l'authentication unifiée. Soyez prudent si vous les installez.

{% set catalog = read_file('/var/www/app_yunohost/apps/builds/default/doc_catalog/apps.json')|json_decode(true) %}

<div id="app-cards-list" class="app-cards-list">
{% for app_id, infos in catalog.apps %}

{% if grav.language.getActive in infos.description %}
    {% set descr_lang = grav.language.getActive %}
{% else %}
    {% set descr_lang = 'en' %}
{% endif %}

<div class="app-card panel panel-default" data-appid="{{ app_id }}" data-level="{{ infos.level }}">
<div class="app-title">
{% if infos.good_quality %}
<i class="fa fa-star" style="color: gold"></i>
{% endif %}
{{ infos.name }} 
<span class="label label-default">{{infos.category}}</span>
{% if infos.broken %}
<span class="label label-error">cassée</span>
{% else %}
{% if infos.bad_quality %}
<span class="label label-warning">mauvaise qualité</span>
{% endif %}
{% endif %}
</div>
<div class="app-descr">{{ infos.description[descr_lang] }}</div>
<div class="app-footer">
<div class="app-buttons btn-group" role="group">

<a href="{{infos.url}}" target="_BLANK" type="button" class="btn btn-default col-sm-4"> <i class="fa fa-code"></i> Code </a>
<a href="app_{{app_id}}" target="_BLANK" type="button" class="btn btn-default col-sm-4"> <i class="fa fa-book"></i> Doc </a>
<a href="https://install-app.yunohost.org/?app={{app_id}}" target="_BLANK" type="button" class="btn btn-{% if infos.bad_quality %}error{% else %}success{% endif %} col-sm-4 active"> <i class="fa fa-plus"></i> Install </a>

</div>
</div>
</div>
{% endfor %}
</div>

! Si vous ne trouvez pas une application précise que vous recherchez, vous pouvez l'ajouter à la [liste d'apps souhaitées](/apps_wishlist).

<!--
Javascript helpers
-->

<script>

$(document).ready(function () {

    $(".javascriptDisclaimer").hide();

    function filter() {

        var user_input_in_search_field = $('#filter-app-cards').val().toLowerCase();

        $('.app-card').each(function() {
            // This is where we actually define how apps are filtered:
            // we look for the name of the app (h3) and try to find the user input
            // + we check this app match the current quality filter
            var text = $(this).find('.app-title').text().toLowerCase() + " " + $(this).find('.app-descr').text().toLowerCase();
            if (text.indexOf(user_input_in_search_field) >= 0)
            {
                $(this).show();
            }
            else
            {
                $(this).hide();
            }
        });
    }

    function sort() {
        var sorted = $('.app-card').sort(function (a, b) {
            var level_a = Math.min(parseInt($(a).data('level')), 8);
            var level_b = Math.min(parseInt($(b).data('level')), 8);
            if (level_a > level_b)
            {
                return -1;
            }
            else if (level_a < level_b)
            {
                return 1;
            }
            else {
                var id_a = $(a).data('appid');
                var id_b = $(b).data('appid');
                return id_a > id_b ? 1 : -1;
            }
        });
        $("#app-cards-list").html(sorted);
    }

    //=================================================
    // Search & filter bar event
    //=================================================
    $('#filter-app-cards').keyup(filter);

    $('a[data-quality-filter]').on("click", function(){
        $('#current-quality-filter').text($(this).text());
        $('#current-quality-filter').data("filter", $(this).data("quality-filter"));
        filter();
    });

    sort();
    filter();

});
</script>
