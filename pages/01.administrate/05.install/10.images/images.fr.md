---
title: Images
template: docs
taxonomy:
    category: docs
routes:
  default: '/images'
---

<span class="javascriptDisclaimer">
Cette page requiert que Javascript soit activé pour s'afficher correctement :s.
<br/>
<br/>
</span>

!!!! Même si l'image ne correspond pas à la dernière version de YunoHost, vous pouvez tout de même l'utiliser puis faire une mise à jour du système après l'installation !

!!! Si vous souhaitez vérifier la validité de nos images signées, vous pouvez [télécharger notre clé publique](https://forge.yunohost.org/yunohost.asc).

! Les images actuelles sont basées sur Debian Buster (YunoHost v4.x) et nécessitent que vous fassiez la commande `apt update` en SSH ou ligne de commande pour continuer les mises à jour.
! Répondez Oui à l'avertissement à propos du changement de `stable` vers `oldstable`.

<div class="hardware-image">
<div id="cards-list">
</div>
</div>

<script type="text/template" id="image-template">
<div id="{id}" class="card panel panel-default">
        <div class="panel-body text-center">
            <h3>{name}</h3>
            <div class="card-comment">{comment}</div>
            <div class="card-desc text-center">
<img src="/user/images/{image}" height=100 style="vertical-align:middle">
            </div>
        </div>
        <div class="annotations flex-container">
            <div class="flex-child annotation"><a href="{file}.sha256sum">[fa=barcode] Checksum</a></div>
            <div class="flex-child annotation"><a href="{file}.sig">[fa=tag] Signature</a></div>
        </div>
        <div class="btn-group" role="group">
            <a href="{file}" target="_BLANK" type="button" class="btn btn-info col-sm-12"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Télécharger <small>{version}</small></a>
        </div>
</div>
</script>


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

