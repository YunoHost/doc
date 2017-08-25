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
<strong>Pseudonyme</strong> : <input id="nickname" value="foobar" type="text">
</br>
</br>
<button id="joinChatroom" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> Rejoindre le salon
</button>
</center>

<h3>... ou demandez sur le forum !</h3>

<center>
<button id="goForum" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> Aller sur le forum
          </button>
</center>

<h3>Vous avez trouver un bug ?</h3>

<center>
<br>
<em>Vous pouvez rapporter le bug sur le bugtracker ou contacter les développeurs</em><br><br>
<button id="goBugtracker" type="button" class="btn btn-warning" style="font-weight:bold;">
            <span class="glyphicon glyphicon-exclamation-sign"></span> Rapporter un bug
          </button>
<button id="goDevroom" type="button" class="btn btn-warning" style="font-weight:bold; margin-left:40px">
            <span class="glyphicon glyphicon-comment"></span> Contacter les développeurs
          </button>
</center>

<script>
document.getElementById("joinChatroom").onclick = function() {
    var nickname = document.getElementById("nickname").value;
    window.location.href = "https://chat.yunohost.org/?nick="+nickname;
}
document.getElementById("goForum").onclick = function() {
    var nickname = document.getElementById("nickname").value;
    window.location.href = "https://forum.yunohost.org/latest";
}
document.getElementById("goBugtracker").onclick = function() {
    window.location.href = "https://dev.yunohost.org/projects/yunohost/issues";
}
document.getElementById("goDevroom").onclick = function() {
    window.location.href = "https://chat.yunohost.org/";
}
</script>

