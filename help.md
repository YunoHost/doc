# Looking for help?

<h3>Connect to the support chatroom</h3>
<center>
<div class="alert alert-info" markdown="1" style="max-width:700px;">
<strong>ProTips™</strong>
<ul style="text-align:left;">
<li>Don't ask to ask, just ask !</li>
<li><em>Be patient</em>, it can take a few minutes before someone sees your messages.</li>
</ul>
</div>
<strong>Nickname</strong> : <input id="nickname" value="foobar" type="text">
</br>
</br>
<button id="joinChatroom" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> Join the chatroom
</button>
</br>
</br>
<em>Note : you can also connect using your favorite XMPP client to </br>
support@conference.yunohost.org</em>
</center>

<h3>... or ask on the forum !</h3>

<center>
<button id="goForum" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> Go to the forum
          </button>
</center>

<h3>You've found a bug ?</h3>

<center>
<br>
<em>Please report it on our bugtracker or contact the developers</em><br><br>
<button id="goBugtracker" type="button" class="btn btn-warning" style="font-weight:bold;">
            <span class="glyphicon glyphicon-exclamation-sign"></span> Report a bug
          </button>
<button id="goDevroom" type="button" class="btn btn-warning" style="font-weight:bold; margin-left:40px">
            <span class="glyphicon glyphicon-comment"></span> Contact the developers
          </button>
</br>
</br>
<em>Note : you can also connect to the devrooms, using your favorite XMPP client, to </br>
dev@conference.yunohost.org and apps@conference.yunohost.org</em>
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

