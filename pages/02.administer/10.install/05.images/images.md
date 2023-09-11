---
title: Pre-installed images
template: docs
taxonomy:
    category: docs
routes:
  default: '/images'
---

<span class="javascriptDisclaimer">
This page requires Javascript enabled to display properly :s.
<br/>
<br/>
</span>

!!! Even if the image does not corresponds to the latest version of YunoHost, you can still use it and do a regular system upgrade after setting up!

!!! If you wish to check the validity of our signed images, you can [download our public key](https://forge.yunohost.org/yunohost.asc).

<div class="hardware-image">
<div id="cards-list">
</div>
</div>
<template id="image-template">
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
            <a href="{file}" target="_BLANK" type="button" class="btn btn-info col-sm-12"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download <small>{version}</small></a>
        </div>
    </div>
</template>


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
            if (infos.hide == true) { return; }
            // Fill the template
            html = $('#image-template').html()
             .replace('{id}', infos.id)
             .replace('{name}', infos.name)
             .replace('{comment}', infos.comment || "&nbsp;")
             .replace('%7Bimage%7D', infos.image)
             .replace('{image}', infos.image)
             .replace('{version}', infos.version);
            if (!infos.file.startsWith("http"))
                infos.file="https://build.yunohost.org/"+infos.file;
            html = html.replace(/%7Bfile%7D/g, infos.file).replace(/{file}/g, infos.file);

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

