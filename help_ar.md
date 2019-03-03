# <div dir=rtl>هل تبحث عن مساعدة ؟</div>

<h3 dir="rtl">إتصل بغرفة المساعدة</h3>
<center>
<div class="alert alert-info" markdown="1" style="max-width:700px;">
<strong>ProTips™</strong>
<ul dir="rtl" style="text-align:right;">
<li>لا تطرح سؤالا لمُجرّد الطرح، بل إطرح سؤالك !</li>
<li><em>تحلّى بالصبر</em>، في بعض الأحيان يمكن أن تمر بضع دقائق قبل أن يرى أحد المستخدمين سؤالك.</li>
</ul>
</div>
<div dir="rtl"><strong>الإسم المستعار</strong> : <input id="nickname" value="foobar__" type="text">
</div>

<iframe src="https://kiwiirc.com/client/irc.freenode.org:+6697/?nick=foobar|?&theme=mini#yunohost" style="border:0; width:100%; height:450px;"></iframe>

</br>
</br>
<div dir="rtl">
<em>ملاحظة : يمكن الإتصال كذلك بغرفة المحادثة باستخدام تطبيق XMPP الخاص بك على العنوان التالي </br>
support@conference.yunohost.org </br>
<a target="_blank" href="https://kiwiirc.com/client/irc.freenode.org:+6697/?nick=foobar|?&theme=mini#yunohost">kiwiirc</a>  باستخدام   freenode على #yunohost IRC أو </br>
<a target="_blank" href="https://riot.im/app/#/room/#yunohost:matrix.org">Riot</a> باستخدام Matrix أو </br>
</em>
</div>
</center>

<h3 dir="rtl">... أو إطرح سؤالك في المنتدى !</h3>

<div dir="rtl">
<center>
<button id="goForum" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> إنتقل إلى المنتدى
          </button>
</center>

<h3>هل إكتشفت علة أو خللًا ؟</h3>

<center>
<br>
<em>يرجى الإبلاغ عن المشاكل على أداة متعقّب الأخطاء الخاصة بالمشروع أو إتصل بالمطوّرين</em><br><br>
</div>
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
<div dir="rtl">
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
