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
<div dir="rtl"><strong>الإسم المستعار</strong> : <input id="nickname" value="foobar" type="text">
</div>
</br>
</br>
<div dir="rtl"><button id="joinChatroom" type="button" class="btn btn-success" style="font-weight:bold;">
            <span class="glyphicon glyphicon-comment"></span> إنضم إلى غرفة المحادثة
</button>
</div>
</br>
</br>
<div dir="rtl">
<em>ملاحظة : يمكن الإتصال كذلك بغرفة المحادثة باستخدام تطبيق XMPP الخاص بك على العنوان التالي </br>
support@conference.yunohost.org</em>
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