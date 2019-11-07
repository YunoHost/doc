# YunoHost News

<div id="news">
</div>

<style>
.emoji {
    height: 21px;
}

blockquote p {
    font-size: medium;
}
blockquote > p {
    margin-top: 0;
}
</style>

<script type="text/template" id="news-template">
    <article class="news">
        <h2><a target="_blank" href="{link}">{title}</a></h2>

        <div>{body}</div>
    </article>

    <hr>
</script>

<script>
$(document).ready(function() {
    // FIXME, we need to enable CORS on forum.yunohost.org
    $.get("https://forum.yunohost.org/c/announcement.rss").success(function(data) {
        $(data).find("item").each(function(_, item) {
            var description = $(item).find("description");
            // yes this is a NIGHTMARE
            var blockquote_content = $("<div>" + description[0].textContent + "</div>").find("blockquote")[0].innerHTML
            // blockquote_content = blockquote_content.replace("<h1", "<h4");

            html = $('#news-template').html()
             .replace(/{title}/g, $(item).find("title").text())
             .replace(/{link}/g, $(item).find("link").text())
             .replace(/{body}/g, blockquote_content)

            $("#news").append(html);
        })
    })
})
</script>
