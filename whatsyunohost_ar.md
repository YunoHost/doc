#<div dir="rtl">ماذا نعني بـ واي يونوهوست YunoHost ؟</div>

<div dir="rtl">
واي يونوهوست YunoHost هو **نظام لتشغيل الخوادم** صُمِّم لتسهيل الإستضافة الذاتية لخدمات الإنترنت.
هو مُرتكز و منسجم كافة الإنسجام مع توزيعة [غنو/لينكس ديبيان](https://debian.org).
</div>

<img src="/images/debian-logo.png" width=100>

---

###<div dir="rtl"> خصائصه</div>

<div dir="rtl">
- متعدد المستعملين مع تكامُل LDAP
- متعدد النطاقات
- خدمة البريد الإلكتروني
- خادم المراسلة الفورية
- نظام للمصادقة الموحَّدة (SSO)
- نظام للتطبيقات
- نظام للنسخ الإحتياطي
- نظام لإعادة توليد الإعدادات و الخدمات
</div>

<img src="/images/YunoHost_logo_vertical.png" width=400>

---

###<div dir="rtl"> أصل فكرة المشروع</div>

<div dir="rtl">
تعود نشأة فكرة مشروع واي يونوهوست YunoHost إلى شهر فيفري مِن عام 2012 بعد محادثة بدأت على هذا الشكل تقريبًا :
</div>
 <blockquote><p dir="rtl">« تبًا، لقد سئِمتُ مِن إعادة إعداد خادم البريد الإلكتروني ... Beudbeud، كيف قُمتَ بإعداد خادومك الجميل حول LDAP ؟ »</p>
<small>Kload، فيفري 2012</small></blockquote>
<div dir="rtl">

Il ne manquait en fait qu’une interface d’administration au serveur de Beudbeud pour en faire quelque chose d’exploitable, alors Kload a décidé de la développer. Finalement, après l’automatisation de quelques configurations et le packaging de quelques applications web, la première version de YunoHost était sortie.

Constatant l’engouement croissant autour de YunoHost et de l’auto-hébergement en général, les développeurs et les nouveaux contributeurs ont alors décidé de prendre le cap d’une version 2, plus accessible, plus extensible, plus puissante, et qui prépare du bon café commerce équitable pour les lutins de Laponie.
</div>

---

###<div dir="rtl"> الهدف</div>
<div dir="rtl">
يهدف واي يونوهوست YunoHost إلى تسهيل عملية تنصيب و تثبيت و إدارة أي خادمٍ لأكبر عدد ممكن مِن الناس و ذلك دون المساس بجودة و موثوقية البرمجيات. 

لم يُدَّخر أي جهد لتسهيل عملية التنصيب و الإنبساط وذلك على أكبر عدد ممكن مِن الأجهزة مهما اختلفت مميزات كل جهاز (في المنزل أو على خادوم إستضافة أو على خادوم شخصي إفتراضي)
</div>

---

###<div dir="rtl"> التسمية</div>

<div dir="rtl">
**YunoHost** مُستمَدٌّ مِن لُغة الإنترنت العاميّة « Y U NO Host » و بالمعنى التقريبي « لماذا لا تستضيف نفسك بنفسك ». [ميم الإنترنت](https://ar.m.wikipedia.org/wiki/%D9%85%D9%8A%D9%85_%D8%A5%D9%86%D8%AA%D8%B1%D9%86%D8%AA) الذي يصف المعنى بالتقريب هو :
<div class="text-center"><img style="border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.15);" src="/images/dude_yunohost.jpg"></div>
</div>

---

###<div dir="rtl"> التطوير </div>

YunoHost est développé pour être le plus **simple** et le moins intrusif possible pour garder la compatibilité avec Debian. Il propose uniquement un ensemble de configurations automatiques et opère via des interfaces accessibles.

Le tout est bien entendu **entièrement libre**. La philosophie de l’[الإستضافة الذاتية](selfhosting_fr) étant à nos yeux incompatible avec tout autre modèle de développement logiciel.

لا تتردّدوا في زيارة صفحة « [ساهموا](/contribute_ar) ».
</div>

---

###<div dir="rtl"> الأمان</div>

لقد بُذِلت كل المجهودات مِن أجل تأمين واي يونوهوست YunoHost و **تعمية و تشفير البروتوكولات** . بإمكانكم الإطلاع على الشرح بتفاصيليه [هنا](/security_fr).
</div>
---

###<div dir="rtl"> واي يونوهوست YunoHost ليس

Même si YunoHost est multi-domaine et multi-utilisateur, il reste **inapproprié pour un usage mutualisé**.

Premièrement parce que le logiciel est trop jeune, donc non-testé et non-optimisé pour être mis en production pour des centaines d’utilisateurs en même temps. Et quand bien même, ce n’est pas le chemin que l’on souhaite faire suivre à YunoHost. La virtualisation se démocratise, et c’est une façon bien plus étanche et sécurisée de faire de la mutualisation.

Vous pouvez héberger vos amis, votre famille ou votre entreprise sans problème, mais vous devez **avoir confiance** en vos utilisateurs, et ils doivent de la même façon avoir confiance en vous. Si vous souhaitez tout de même fournir des services YunoHost à des inconnus, **un VPS entier par utilisateur** sera la meilleure solution.
</div>
