# Besoin d'aide ?

<h3>Connectez-vous au salon de support</h3>
<center>
<div class="alert alert-info" markdown="1" style="max-width:750px;">
<strong>ProTips™</strong>
<ul style="text-align:left;">
<li>Pas besoin de demander si vous pouvez poser une question - posez-la directement !</li>
<li><em>Soyez patient</em>, cela peut prendre plusieurs minutes avant que quelqu'un remarque vos messages.</li>
</ul>
</div>

<iframe src="https://kiwiirc.com/client/irc.freenode.org:+6697/?nick=foobar|?&theme=mini#yunohost" style="border:0; width:100%; height:450px;"></iframe>

</br>
</br>
<em>Note : ce salon est accessible via IRC (#yunohost sur freenode en utilisant <a href="https://kiwiirc.com/client/irc.freenode.org:+6697/?nick=foobar|?&theme=mini#yunohost">Kiwiirc</a>), via XMPP <small>(support@conference.yunohost.org)</small>, ou Matrix <small>(#freenode_#yunohost:matrix.org - <a target="_blank" href="https://riot.im/app/#/room/#yunohost:matrix.org">en utilisant Riot</a>)</small>.</em>
</center>

<h3>... ou demandez sur le forum !</h3>

<center>
<button id="goForum" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> Aller sur le forum
          </button>
</center>

<h3>Vous avez trouvé un bug ?</h3>

<center>
<br>
<em>Vous pouvez rapporter le bug sur le bugtracker ou contacter les développeurs</em><br><br>
<button id="goBugtracker" type="button" class="btn btn-warning" style="font-weight:bold;">
            <span class="glyphicon glyphicon-exclamation-sign"></span> Rapporter un bug
          </button>
<button id="goDevroom" type="button" class="btn btn-warning" style="font-weight:bold; margin-left:40px">
            <span class="glyphicon glyphicon-comment"></span> Contacter les développeurs
          </button>
</br>
</br>
<em>Note : vous pouvez aussi vous connecter aux salons de dev, via votre client XMPP favori, à</br>
dev@conference.yunohost.org et apps@conference.yunohost.org</br>
ou bien via votre client matrix préféré, à</br>
#freenode_#yunohost-dev:matrix.org</em>
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
document.getElementById("goForum").onclick = function() {
    window.location.href = "https://forum.yunohost.org";
}
</script>

