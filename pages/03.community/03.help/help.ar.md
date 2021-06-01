---
title: هل تبحث عن مساعدة
template: docs
taxonomy:
    category: docs
routes:
  default: '/help'
---

<h3>إتصل بغرفة المساعدة</h3>

!!! **ProTips™**
!!! - Non c'è bisogno di chiedere se puoi chiedere qualcosa, chiedi e basta !
!!! - *Sii paziente*, potrebbero servire alcuni minuti prima che qualcuno veda i tuoi messaggi.
!!! - لا تطرح سؤالا لمُجرّد الطرح، بل إطرح سؤالك !
!!! - تحلّى بالصبر، في بعض الأحيان يمكن أن تمر بضع دقائق قبل أن يرى أحد المستخدمين سؤالك.

<center>

<strong>الإسم المستعار</strong> : <input id="nickname" value="ynhuser__" type="text">

<iframe src="https://kiwiirc.com/nextclient/?settings=7b72a0a81838360686798199ed53624f" style="border:0; width:100%; height:450px;"></iframe>

</br>
</br>
<em>ملاحظة : يمكن الإتصال كذلك بغرفة المحادثة باستخدام تطبيق XMPP الخاص بك على العنوان التالي </br>
support@conference.yunohost.org </br>
<a target="_blank" href="https://kiwiirc.com/nextclient/?settings=7b72a0a81838360686798199ed53624f">kiwiirc</a>  باستخدام   freenode على #yunohost IRC أو </br>
<a target="_blank" href="https://riot.im/app/#/room/#yunohost:matrix.org">Riot</a> باستخدام Matrix أو </br>
</em>
</center>

<h3>... أو إطرح سؤالك في المنتدى !</h3>

<center>
<button id="goForum" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> إنتقل إلى المنتدى
          </button>
</center>

<h3>هل إكتشفت علة أو خللًا ؟</h3>

<center>
<br>
<em>يرجى الإبلاغ عن المشاكل على أداة متعقّب الأخطاء الخاصة بالمشروع أو إتصل بالمطوّرين</em><br><br>
<button id="goBugtracker" type="button" class="btn btn-warning" style="font-weight:bold;">
            <span class="glyphicon glyphicon-exclamation-sign"></span> أبلِغ عن عِلّة أو خلل
          </button>
<button id="goDevroom" type="button" class="btn btn-warning" style="font-weight:bold; margin-left:40px">
            <span class="glyphicon glyphicon-comment"></span> إتصل بالمطوّرين
          </button>
</center>
</br>
</br>
<center>
<em>ملاحظة : يمكن الإتصال كذلك بغرفة التطوير باستخدام تطبيق XMPP الخاص بك على العناوين التالية </br>
dev@conference.yunohost.org and apps@conference.yunohost.org</em>
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
