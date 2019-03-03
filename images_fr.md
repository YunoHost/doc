# Images

<span class="javascriptDisclaimer">
Cette page requiert que Javascript soit activé pour s'afficher correctement :s.
<br/>
<br/>
</span>


<div id="cards-list">
</div>

<script type="text/template" id="image-template">
<div id="{id}" class="card panel panel-default">
        <div class="panel-body text-center">
            <h3>{name}</h3>
            <div class="card-comment">{comment}</div>
            <div class="card-desc text-center">
<img src="/images/{image}" height=100 style="vertical-align:middle">
            </div>
        </div>
        <div class="annotations">
            <div class="col-sm-6 annotation"><a href="{file}.sha256sum"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Checksum</a></div>
            <div class="col-sm-6 annotation"><a href="{file}.sig"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> Signature</a></div>
        </div>
        <div class="btn-group" role="group">
            <a href="{file}" target="_BLANK" type="button" class="btn btn-info col-sm-12"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Télécharger <small>{version}</small></a>
        </div>
</div>
</script>

<style>
/*
###############################################################################
  Style sheet for the cards
###############################################################################
*/
#cards-list:after {
    content:'';
    display:block;
    clear: both;
}

.card {
    margin-bottom:20px;
    width:270px;
    float:left;
    min-height: 1px;
    margin-right: 10px;
    margin-left: 10px;
}

.card .panel-body >  h3 {
    margin-top:0;
    margin-bottom:5px;
    font-size:1.2em;
}

.card-desc {
    height:100px;
    overflow: hidden;
}

.card .btn-group {
    width:100%;
    margin-left: 0px;
}
.card > .btn-group > .btn{
    border-bottom:0;
}
.card > .btn-group {   
    border-left:0;
    border-top-left-radius:0;
    border-top-right-radius:0;
    margin-left: 0px;
}
.card-comment {
    font-size: 0.8em;
    margin-top:-5px;
}
.card > .annotations {
    text-align:center;
    font-size:small;
}
</style>

<script>
/*
###############################################################################
  Script that loads the infos from javascript and creates the corresponding
  cards
###############################################################################
*/
$(document).ready(function () {
    console.log("in load");
    $.getJSON('https://build.yunohost.org/images.json', function (images) {
        $.each(images, function(k, infos) {
            // Fill the template
            html = $('#image-template').html()
             .replace('{id}', infos.id)
             .replace('{name}', infos.name)
             .replace('{comment}', infos.comment || "&nbsp;")
             .replace('{image}', infos.image)
             .replace('{version}', infos.version);
 
            if (infos.file.startsWith("http"))
                html = html.replace(/{file}/g, infos.file);
            else
                html = html.replace(/{file}/g, "https://build.yunohost.org/"+infos.file);
   
            if ((typeof(infos.has_sig_and_sums) !== 'undefined') && infos.has_sig_and_sums == false)
            {
                var $html = $(html);
                $html.find(".annotations").html("&nbsp;");
                html = $html[0];
            } 
            $('#cards-list').append(html);
        });
    });
});
</script>

