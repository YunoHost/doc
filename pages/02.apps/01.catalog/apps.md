---
title: Application catalog
template: docs
taxonomy:
    category: docs
routes:
  default: '/apps'
twig_first: true
process:
    twig: true
---

<span class="javascriptDisclaimer">
This page requires JavaScript enabled to display properly :s.
<br/>
<br/>
</span>

<!--
Search bar
-->

<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-search"></i></span>
    <input id="filter-app-cards" type="text" class="form-control"  placeholder="Search for apps..." aria-describedby="basic-addon1"/>
</div>
<br />

<!--
Disclaimers
-->

!!! The application packaging team will welcome your feedback! If you install an app and find issues or possible improvements, do not hesitate to contribute by reporting your issues directly on the corresponding code repositories.

! Applications flagged as <span class="label label-warning label-as-badge">low quality</span> may be working, but they may not respect good packaging practices or lack integration of some features like backup/restore or single authentication. Be cautious when installing them.


{% set catalog = read_file('/var/www/app_yunohost/apps/builds/default/doc_catalog/apps.json')|json_decode(true) %}

<div id="app-cards-list" class="app-cards-list">
{% for app_id, infos in catalog.apps %}

{% if grav.language.getActive in infos.description %}
    {% set descr_lang = grav.language.getActive %}
{% else %}
    {% set descr_lang = 'en' %}
{% endif %}

<div class="app-card_{{app_id}} app-card panel panel-default">
<div class="app-title">
{% if infos.good_quality %}
<i class="fa fa-star" style="color: gold"></i>
{% endif %}
{{ infos.name }} 
<span class="label label-default">{{infos.category}}</span>
{% if infos.bad_quality %}
<span class="label label-warning">low quality</span>
{% endif %}
</div>
<div class="app-descr">{{ infos.description[descr_lang] }}</div>
<div class="app-footer">
<div class="app-buttons btn-group" role="group">

<a href="{{infos.url}}" target="_BLANK" type="button" class="btn btn-default col-sm-4"> <i class="fa fa-code"></i> Code </a>
<a href="fixme" target="_BLANK" type="button" class="btn btn-default col-sm-4"> <i class="fa fa-book"></i> Doc </a>
<a href="https://install-app.yunohost.org/?app={{app_id}}" target="_BLANK" type="button" class="btn btn-success col-sm-4 active"> <i class="fa fa-plus"></i> Install </a>

</div>
</div>
</div>
{% endfor %}
</div>

! If you don't find the app you are looking for, you can try to look for a appname_ynh repository on GitHub or on the internet, or add it to the [apps wishlist](/apps_wishlist).

<!--
Custom CSS for this page
-->

<style>
/*=================================================
 Search bar
=================================================*/
#filter-app-cards, #app-cards-list {
    width:100%;
}
/*===============================================*/

/*=================================================
 Force return space after card list
=================================================*/
#app-cards-list:after {
    content:'';
    display:block;
    clear: both;
}
/*===============================================*/

/*=================================================
 App card
=================================================*/

.app-card {
    margin-bottom:20px;
    width:31.2%;
    float:left;
    min-height: 1px;
    margin-right: 10px;
    margin-left: 10px;
    border-radius: 3px;
    position: relative;
    height: 230px;
}
.app-title {
    margin-top: 0;
    margin-bottom: 5px;
    font-size: 1.2em;
    font-weight: 700;
    line-height: 1.1;
    color: black;
    padding: 1rem 1rem;
    padding-bottom: 0;
}
.app-title .label {
    font-size: 0.5em;
    display: inline-block;
    vertical-align: middle;
    padding: 0.5em 0.6em;
    padding-bottom: 0.3em;
}

.label-epic {
    background-color: darkorchid;
}

.app-descr {
    height:120px;
    overflow: hidden;
    padding: 0.2rem 1rem;
}

.app-footer {
   width:100%;
   position: absolute;
   bottom: 0;
}

.app-maintainer {
    font-size: 0.7em;
    text-align: right;
    margin-right: 5px;
}

.app-card .unmaintained {
   color: #e0aa33;
}

/*===============================================
 App buttons
=================================================*/
.app-buttons {
    width:100%;
}
.app-buttons > .btn {
    border-bottom:0;
    font-size: 0.9em;
    line-height: 1.58;
}
.app-buttons > .btn:first-child {
    border-left:0;
    border-top-left-radius:0;
}
.app-buttons > .btn:last-child {
    border-right:0;
    border-top-right-radius:0;
    margin-left: 0px;
    width: 33.6%;
}

/*===============================================*/
</style>



<!--
Javascript helpers
-->

<script>

$(document).ready(function () {

    $(".javascriptDisclaimer").hide();

    function filter(){

        var user_input_in_search_field = $('#filter-app-cards').val().toLowerCase();

        $('.app-card').each(function() {
            // This is where we actually define how apps are filtered:
            // we look for the name of the app (h3) and try to find the user input
            // + we check this app match the current quality filter
            var text = $(this).find('.app-title').text().toLowerCase() + " " + $(this).find('.app-descr').text().toLowerCase();
            if (text.indexOf(user_input_in_search_field) >= 0 && $(this).data("quality").indexOf(current_quality_filter) >= 0)
            {
                $(this).show();
            }
            else
            {
                $(this).hide();
            }
        });
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

    filter();

});
</script>
