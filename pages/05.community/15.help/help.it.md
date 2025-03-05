---
title: Cerchi aiuto?
template: docs
taxonomy:
    category: docs
routes:
  default: '/help'
---

<h3>Connettiti alla chat di supporto</h3>

!!! **ProTips™**
!!! - Non c'è bisogno di chiedere se puoi chiedere qualcosa, chiedi e basta !
!!! - *Sii paziente*, potrebbero servire alcuni minuti prima che qualcuno veda i tuoi messaggi.

<center>

<iframe src="https://web.libera.chat/#yunohost" style="width:100%;height:450px;border:0;display:block"></iframe>

</br>
</br>
<em>Nota : questa stanza e disponibile via IRC (#YunoHost su libera.chat - <a href="https://web.libera.chat/#yunohost">usando kiwiirc</a>), via XMPP <small>(support@conference.yunohost.org)</small>, o Matrix <small>(#YunoHost:matrix.org - <a target="_blank" href="https://matrix.to/#/#yunohost:matrix.org">Element using Matrix.to</a>)</small></em>
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
    window.location.href = "https://web.libera.chat/#yunohost-dev";
}
</script>
