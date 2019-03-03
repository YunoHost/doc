# Cerchi aiuto?

<h3>Connettiti alla chat di supporto</h3>
<center>
<div class="alert alert-info" markdown="1" style="max-width:700px;">
<strong>ProTips™</strong>
<ul style="text-align:left;">
<li>Non chiedere tanto per chiedere, chiedi e basta !</li>
<li><em>Sii paziente</em>, potrebbero servire alcuni minuti prima che qualcuno veda i tuoi messaggi.</li>
</ul>
</div>

<iframe src="https://kiwiirc.com/client/irc.freenode.org:+6697/?nick=foobar|?&theme=mini#yunohost" style="border:0; width:100%; height:450px;"></iframe>

</br>
</br>
<em>Nota : questa stanza e disponibile via IRC (#yunohost su freenode - <a href="https://kiwiirc.com/client/irc.freenode.org:+6697/?nick=foobar|?&theme=mini#yunohost">usando kiwiirc</a>), via XMPP <small>(support@conference.yunohost.org)</small>, o Matrix <small>(#freenode_#yunohost:matrix.org - <a target="_blank" href="https://riot.im/app/#/room/#yunohost:matrix.org">usando Riot</a>)</small></em>
</center>

<h3>... o chiedi nel forum !</h3>

<center>
<button id="goForum" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> Vai al forum
          </button>
</center>

<h3>Hai trovato un problema ?</h3>

<center>
<br>
<em>Per favore segnalalo nel nostro bugtracker o contatta gli sviluppatori</em><br><br>
<button id="goBugtracker" type="button" class="btn btn-warning" style="font-weight:bold;">
            <span class="glyphicon glyphicon-exclamation-sign"></span> Segnala un bug
          </button>
<button id="goDevroom" type="button" class="btn btn-warning" style="font-weight:bold; margin-left:40px">
            <span class="glyphicon glyphicon-comment"></span> Contatta gli sviluppatori
          </button>
</br>
</br>
<em>Nota : puoi anche connetterti alla stanza degli sviluppatori, utilizzando il tuo client XMPP preferito, su </br>
dev@conference.yunohost.org e apps@conference.yunohost.org</em>
</center>

<script>

document.getElementById("goForum").onclick = function() {
    window.location.href = "https://forum.yunohost.org/latest";
}
document.getElementById("goBugtracker").onclick = function() {
    window.location.href = "https://github.com/yunohost/issues/issues";
}
document.getElementById("goDevroom").onclick = function() {
    window.location.href = "https://kiwiirc.com/client/irc.freenode.net/yunohost-dev";
}
</script>

