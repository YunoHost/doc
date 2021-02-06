---
title: Catalogue d'applications
template: docs
taxonomy:
    category: docs
---

<span class="javascriptDisclaimer">
Cette page requiert que JavaScript soit activé pour s'afficher correctement :s.
<br/>
<br/>
</span>

<!--
Search bar
-->
<div class="input-group">
    <span id="basic-addon1" class="input-group-addon" ><span class="glyphicon glyphicon-search"></span></span>
    <input id="filter-app-cards" type="text" class="form-control"  placeholder="Rechercher des apps..." aria-describedby="basic-addon1"/>
    <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span id="current-quality-filter" data-filter="decent">Seulement les apps de qualité décente</span> <span class="caret"></span>
        </button>

        <ul class="dropdown-menu">
            <li><a href="#" data-quality-filter="high">Seulement les apps haute-qualité</a></li>
            <li><a href="#" data-quality-filter="decent">Seulement les apps de qualité décente</a></li>
            <li><a href="#" data-quality-filter="working">Seulement les apps fonctionelles</a></li>
            <li><a href="#" data-quality-filter="none">Toutes les apps</a></li>
        </ul>
    </div>
</div>
<br />

<!--
Disclaimers
-->

<div class="alert alert-info">L'équipe de packaging d'applications sera heureuse de recevoir vos commentaires ! Si vous trouvez des problèmes ou des améliorations possibles en installant une app, n'hésitez pas à contribuer en créant un ticket (issue) directement sur le dépôt de code.</div>

<div id="bad-quality-apps-disclaimer" class="alert alert-warning">
    Les applications étiquettées <span class="label label-warning label-as-badge">low quality</span> fonctionnent peut-être, mais ne respectent pas les bonnes pratiques de packaging ou ne supportent pas certaines fonctionnalités comme les sauvegardes/restauration ou l'authentication unifiée. Soyez prudent si vous les installez.
</div>

<div id="broken-apps-disclaimer" class="alert alert-danger">
    Les applications étiquettées <span class="label label-danger label-as-badge">not working</span> sont connues pour être cassées et/ou encore en développement. **Ne les installez pas** sur un serveur de production !
</div>

<div id="app-cards-list" class="app-cards-list"></div>

<div class="alert alert-warning">Si vous ne trouvez pas une application précise que vous recherchez, vous pouvez chercher un dépôt nommé nomdelapp_ynh sur GitHub ou internet, ou bien l'ajouter à la <a href="/apps_wishlist">liste d'apps souhaitées</a>.</div>

<!--
Custom CSS for this page
-->

<style>
#wrapper {
   max-width: 1100px;
}

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
    padding: 15px;
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
    height:100px;
    overflow: hidden;
    padding: 0 15px;
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
App card template
-->

<script type="text/template" id="app-template2">
    <div class="app-card_{app_id} app-card panel panel-default" data-quality="{app_quality}">

        <div class="app-title">{app_name}</div>
        <div class="app-descr">{app_description}</div>
        <div class="app-footer">
            <div class="app-maintainer">
                <span class="glyphicon glyphicon-refresh"></span> {app_update} -
                <span title="{maintained_help}" class="{maintained_state}"><span class="glyphicon glyphicon-{maintained_icon}"></span> {app_maintainer}</span>
            </div>
            <div class="app-buttons btn-group" role="group">
                <a href="{app_git}" target="_BLANK" type="button" class="btn btn-default col-sm-4"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Code</a>
                <a href="#/app_{app_id}" target="_BLANK" type="button" class="btn btn-default col-sm-4"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Doc</a>
                <a href="https://install-app.yunohost.org/?app={app_id}" target="_BLANK" type="button" class="btn btn-{app_install_css_style} col-sm-4 active"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Install</a>
            </div>
       </div>
    </div>
</script>

<!--
Javascript helpers
-->

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
    var time = date+' '+month+' '+year;//+' at '+hour+':'+min
    return time;
}


$(document).ready(function () {

    var default_lang = "fr";

    // Hide warrant about states when we're using the default filter
    $('#state-disclaimer').hide();
    var quality_filters = "decent";

    function filter(){

        var current_quality_filter = $('#current-quality-filter').data("filter");
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

        // Display or hide the disclaimers depending on the current filter...
        ((current_quality_filter == "working") || (current_quality_filter == "none")) ? $("#bad-quality-apps-disclaimer").show() : $("#bad-quality-apps-disclaimer").hide();
        ((current_quality_filter == "none")) ? $("#broken-apps-disclaimer").show() : $("#broken-apps-disclaimer").hide();
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

    //=================================================
    // Upload apps lists
    //=================================================
    var catalog = undefined;

    // Fetch application catalog

    $.getJSON('https://app.yunohost.org/default/v2/apps.json', {}, function(data) {

        catalog = $.map(data["apps"], function(el) { return el; });

        // Clarify high quality state, and level if undefined or inprogress or notworking...

        $.each(catalog, function(k, infos) {
            if ((infos.level === undefined) || (infos.level === 0) || (infos.state === "inprogress") || (infos.state === "notworking")) {
                infos.level = null;
            }
            if ((infos.high_quality === true) && (infos.level === 8)) {
                infos.state = "high quality";
            }
            else if ((infos.state === "working") && (infos.level !== null) && (infos.level <= 4)) {
                infos.state = "low quality";
            }
        });

        // Sort apps according to their state and level...

        catalog.sort(function(a, b){
            a_state = (a.state === "high quality")?4:(a.level > 4)?3:(a.state > 0)?2:1;
            b_state = (b.state === "high quality")?4:(b.level > 4)?3:(b.state > 0)?2:1;
            if (a_state < b_state || a_state == b_state && a.level < b.level || a_state == b_state && a.level == b.level && a.manifest.id > b.manifest.id) {return 1;}
            else if (a.manifest.id == b.manifest.id) {return 0;}
            return -1;
        });

        // Add the card for each app

        $.each(catalog, function(k, infos) {

            app_id = infos.manifest.id;

            // Define what style to use for state, level and install button
            // according to the app quality ....

            if (infos.state === "high quality") {
                app_quality = "high,decent,working,none";
                app_badge = "high quality";
                app_badge_css_style = "epic";
                app_install_css_style = "success";
            } else if ((infos.state === "working") && (infos.level > 4)) {
                app_quality = "decent,working,none";
                app_badge = null;
                app_badge_css_style = "success";
                app_install_css_style = "success";
            } else if (infos.state === "low quality") {
                app_quality = "working,none";
                app_badge = "low quality";
                app_badge_css_style = "warning";
                app_install_css_style = "warning";
            } else {
                app_quality = "none";
                app_badge = "not working";
                app_badge_css_style = "danger";
                app_install_css_style = "danger";
            }

            // If level is null, we wanna display '?'
            if (infos.level == null) {
                infos.level = '?';
            }

            // Fill the template
            html = $('#app-template2').html()
             .replace(/{app_id}/g, app_id)
             .replace(/{app_name}/g, infos.manifest.name)
             .replace('{app_description}', infos.manifest.description[default_lang] || infos.manifest.description["en"])
             .replace(/{app_git}/g, infos.git.url)
             .replace('{app_branch}', infos.git.branch)
             .replace('{app_level}', infos.level)
             .replace('{app_quality}', app_quality)
             .replace('{app_update}', timeConverter(infos.lastUpdate))
             .replace('{app_install_css_style}', app_install_css_style);

            // Handle the maintainer info
            if (infos.maintained == false)
            {
               html = html
                 .replace('{maintained_state}', 'unmaintained')
                 .replace('{maintained_icon}', 'warning-sign')
                 .replace('{app_maintainer}', "Unmaintained")
                 .replace('{maintained_help}', "This package is currently unmaintained. Feel free to propose yourself as the new maintainer !");
            }
            else {
                html = html
                 .replace('{maintained_state}', 'maintained')
                 .replace('{maintained_icon}', 'user')
                 .replace('{maintained_help}', "Current maintainer of this package");

                if ((infos.manifest.developer) && (infos.manifest.developer.name)) {
                    html = html.replace('{app_maintainer}', infos.manifest.developer.name);
                }
                else if ((infos.manifest.maintainer) && (infos.manifest.maintainer.name)) {
                    html = html.replace('{app_maintainer}', infos.manifest.maintainer.name);
                }
                else {
                    html = html.replace('{app_maintainer}', "???");
                }
            }

            // Fill the template
            $('#app-cards-list').append(html);
            $('.app-card_'+ app_id).attr('id', 'app-card_'+ app_id);
            if (app_badge !== null) {
                 $('.app-card_'+ app_id + ' .app-title').append(' <span class="label label-'+app_badge_css_style+'">'+app_badge+'</span>');
            }
            if (typeof(infos.category) === "string") {
                 category = data["categories"].find(function(el) { return el.id == infos.category; });
                 if (typeof(category) !== "undefined")
                 {
                    display = category["title"][default_lang] || category["title"]["en"];
                    $('.app-card_'+ app_id + ' .app-title').append(' <span class="label label-default">'+display.toLowerCase()+'</span>');
                 }
            }
        });

        filter();
    });
    //=================================================
});
</script>
