# Apps

<span class="javascriptDisclaimer">
This page requires Javascript enabled to display properly :s.
<br/>
<br/>
</span>

<div class="input-group">
    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
    <input type="text" id="filter-app-cards" class="form-control"  placeholder="Search for apps..." aria-describedby="basic-addon1"/>
    <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span id="app-cards-list-filter-text">Only official apps</span> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#" id="app-cards-list-validated">Only official apps</a></li>
            <li><a href="#" id="app-cards-list-high-quality">Only High Quality apps</a></li>
            <li><a href="#" id="app-cards-list-featured">Only Featured apps</a></li>
            <li><a href="#" id="app-cards-list-working">Only working apps</a></li>
            <li><a href="#" id="app-cards-list-working-inprogress">In progress/not working apps</a></li>
            <li><a href="#" id="app-cards-list-all-apps">All apps</a></li>
        </ul>
    </div>
</div>
<br />
<div id="community-app-list-warrant" class="alert alert-danger">
    <p>Only apps tagged <span class="label label-success label-as-badge">validated</span> are officially supported by the package team. </p>

    <p>Apps tagged <span class="label label-success label-as-badge">working</span>, <span class="label label-warning label-as-badge">inprogress</span>, <span class="label label-danger label-as-badge">notworking</span> are from community repository, you can test and use them **at your own risk**.</p>

    <p>Important: it's the application maintaineur that qualify his application as working, not the YunoHost core team. Install it at your own risks. We won't provide support for it.</p>
</div>
<div class="alert alert-info">The packagers will appreciate your remarks. If you install them and find issues, or ideas for improvement, do not hesitate to file issues directly on their repositories project page.</div>

<div class="app-cards-list" id="app-cards-list"></div>

<div class="alert alert-warning">If you don't find the app you are searching for, you can search it in community app repository (working, inprogress and not working apps) or fill the <a href="/apps_wishlist_en">apps wishlist</a>.</div>

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
    width:270px;
    float:left;
    min-height: 1px;
    margin-right: 10px;
    margin-left: 10px;
}
/*===============================================*/

/*=================================================
 App card body
=================================================*/
.app-card .panel-body >  h3 {
    margin-top:0;
    margin-bottom:5px;
    font-size:1.2em;
}
.app-card .category {
    height:35px;
}
.app-card .category .label, .app-card-date-maintainer {
    font-size:0.7em;
}
.app-card-date-maintainer {
    text-align:right;
    max-height: 18px;
    margin-bottom: 3px;
    margin-right: 7px;
    margin-top: -5px;
}

.app-card .unmaintained {
   color: #e0aa33;
}

.app-card-desc {
    height:100px;
    overflow: hidden;
}
/*===============================================*/

/*=================================================
 App card footer
=================================================*/
.app-card .btn-group {
    width:100%;
    margin-left: 0px;
}
.app-card > .btn-group > .btn{
    border-bottom:0;
}
.app-card > .btn-group > .btn:first-child {
    border-left:0;
    border-top-left-radius:0;
}
.app-card > .btn-group > .btn:last-child {
    border-right:0;
    border-top-right-radius:0;
    margin-left: 0px;
    width: 33.6%;
}
/*===============================================*/
</style>

<script type="text/template" id="app-template2">
    <div class="app-card_{app_id} app-card panel panel-default">

        <div class="panel-body">
            <h3>{app_name}</h3>
            <div class="category"></div>

            <div class="app-card-desc">{app_description}</div>
        </div>
            <div class="app-card-date-maintainer">
                <span class="glyphicon glyphicon-refresh"></span> {app_update} -
                <span title="{maintained_help}" class="{maintained_state}"><span class="glyphicon glyphicon-{maintained_icon}"></span> {app_maintainer}</span>
            </div>
        <div class="btn-group" role="group">
            <a href="{app_git}" target="_BLANK" type="button" class="btn btn-default col-sm-4"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Code</a>
            <a href="#/app_{app_id}_en" target="_BLANK" type="button" class="btn btn-default col-sm-4"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Doc</a>
            <a href="https://install-app.yunohost.org/?app={app_id}" target="_BLANK" type="button" class="btn btn-{app_install_bootstrap} col-sm-4 active"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Install</a>
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
    var time = date+' '+month+' '+year;//+' at '+hour+':'+min
    return time;
}

$(document).ready(function () {
    // Hide warrant about community list
    $('#community-app-list-warrant').hide();
    var filters = ["validated"];

    function filter(){
        var filters_text = filters.map(function(el) { return '.app-' + el;}).join(', ');
        var valThis = $('#filter-app-cards').val().toLowerCase();
        $('.app-card').each(function(){
            var text = $(this).find('h3').text().toLowerCase();
            (text.indexOf(valThis) == 0 && $(this).find(filters_text).length > 0) ? $(this).show() : $(this).hide();
        });
        (filters.indexOf("working") == -1) ?$('#community-app-list-warrant').hide():$('#community-app-list-warrant').show();
    }

    //=================================================
    // Search & filter bar event
    //=================================================
    $('#filter-app-cards').keyup(filter);

    $('#app-cards-list-validated').click(function(){
        filters = ["validated"];
        $('#app-cards-list-filter-text').text($('#app-cards-list-validated').text());
        filter();
    });

    $('#app-cards-list-high-quality').click(function(){
        filters = ["high_quality"];
        $('#app-cards-list-filter-text').text($('#app-cards-list-high-quality').text());
        filter();
    });

    $('#app-cards-list-featured').click(function(){
        filters = ["featured"];
        $('#app-cards-list-filter-text').text($('#app-cards-list-featured').text());
        filter();
    });

    $('#app-cards-list-working').click(function(){
        filters = ["validated", "working"];
        $('#app-cards-list-filter-text').text($('#app-cards-list-working').text());
        filter();
    });

    $('#app-cards-list-working-inprogress').click(function(){
        filters = ["notworking", "inprogress"];
        $('#app-cards-list-filter-text').text($('#app-cards-list-working-inprogress').text());
        filter();
    });

    $('#app-cards-list-all-apps').click(function(){
        filters = ["validated", "working", "inprogress", "notworking"];
        $('#app-cards-list-filter-text').text($('#app-cards-list-all-apps').text());
        filter();
    });
    //=================================================


    //=================================================
    // Upload apps lists
    //=================================================
    var app_list={};
    $.when(
        $.getJSON('https://app.yunohost.org/community.json', {}, function(community) {
            app_list.community = $.map(community, function(el) { return el; });
        }),
        $.getJSON('https://app.yunohost.org/official.json', {}, function(official) {
            app_list.official = $.map(official, function(el) { return el; });
        })
    ).then(function() {
        app_list = app_list.official.concat(app_list.community);

        // Sort alpha
        app_list.sort(function(a, b){
            a_state = (a.state == "validated")?4:(a.state == "working")?3:(a.state == "inprogress")?2:1;
            b_state = (b.state == "validated")?4:(b.state == "working")?3:(b.state == "inprogress")?2:1;
            if (a_state < b_state || a_state == b_state && a.level < b.level || a_state == b_state && a.level == b.level && a.manifest.id > b.manifest.id) {return 1;}
            else if (a.manifest.id == b.manifest.id) {return 0;}
            return -1;
        });
        $.each(app_list, function(k, infos) {
            app_id = infos.manifest.id;
            app_install_bootstrap = "success";
            if (infos.state === "validated") {
                app_state_bootstrap = "success";
            } else if (infos.state === "working") {
                app_state_bootstrap = "success";
            } else if (infos.state === "inprogress") {
                app_state_bootstrap = "warning";
                app_install_bootstrap = "danger";
            } else if (infos.state === "notworking") {
                app_state_bootstrap = "danger";
                app_install_bootstrap = "danger";
            }
            if (infos.level == null ) {
                infos.level = '?';
            }
            if (infos.level == 0 ) {
                app_level_bootstrap = "danger";
                app_install_bootstrap = "danger";
            } else if (infos.level <= 2) {
                app_level_bootstrap = "warning";
                app_install_bootstrap = "danger";
            } else if (infos.level >= 7) {
                app_level_bootstrap = "success";
            } else {
                app_level_bootstrap = "default";
            }

            // Fill the template
            html = $('#app-template2').html()
             .replace(/{app_id}/g, app_id)
             .replace(/{app_name}/g, infos.manifest.name)
             .replace('{app_description}', infos.manifest.description.en)
             .replace(/{app_git}/g, infos.git.url)
             .replace('{app_branch}', infos.git.branch)
             .replace('{app_level}', infos.level)
             .replace('{app_update}', timeConverter(infos.lastUpdate))
             .replace('{app_state_bootstrap}', app_state_bootstrap)
             .replace('{app_install_bootstrap}', app_install_bootstrap);

            if (infos.maintained == false)
            {
               html = html
                 .replace('{maintained_state}', 'unmaintained')
                 .replace('{maintained_icon}', 'warning-sign')
                 .replace('{app_maintainer}', "Unmaintained")
                 .replace('{maintained_help}', "This package is currently unmaintained. Feel free to propose yourself as the new maintainer !");
            } else {
            if (infos.manifest.developer) {
                html = html
                 .replace('{maintained_state}', 'maintained')
                 .replace('{maintained_icon}', 'user')
                 .replace('{app_maintainer}', infos.manifest.developer.name)
                 .replace('{maintained_help}', "Current maintainer of this package");
            }
            if (infos.manifest.maintainer) {
                html = html
                 .replace('{maintained_state}', 'maintained')
                 .replace('{maintained_icon}', 'user')
                 .replace('{app_maintainer}', infos.manifest.maintainer.name)
                 .replace('{maintained_help}', "Current maintainer of this package");;
            }
            }


            // Fill the template
            $('#app-cards-list').append(html);
            $('.app-card_'+ app_id).attr('id', 'app-card_'+ app_id);
            $('.app-card_'+ app_id + ' .category').append(' <span class="label label-'+app_level_bootstrap+' label-as-badge">'+infos.level+'</span>');
            $('.app-card_'+ app_id + ' .category').append(' <span class="label label-'+app_state_bootstrap+' label-as-badge app-'+infos.state+'">'+infos.state+'</span>');
            if (infos.manifest.license && infos.manifest.license != 'free') {
                $('.app-card_'+ app_id + ' .category').append(' <span class="label label-default">'+infos.manifest.license+'</span>');
            }

        });
        filter();
    });
    //=================================================
});
</script>
