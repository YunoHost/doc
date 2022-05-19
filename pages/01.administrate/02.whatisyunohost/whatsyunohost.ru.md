---
title: Что такое YunoHost?
template: docs
taxonomy:
    category: docs
routes:
  default: '/whatsyunohost'
---

![YunoHost logo](image://YunoHost_logo_vertical.png?resize=400&id=ynhlogo)

YunoHost это **операционная система** позволяющая легко администрировать **сервера**, и следовательно позволяет сделать [self-hosting](/selfhosting) надёжным, безопасным, этическим и лёгким. Это свободнораспространяемая библиотека которая поддерживается исключительно волонтёрами. Технически, это дистрибутив основанный на [Debian GNU/Linux](https://debian.org) и может быть установлен на [большое количество систем](/install).

## Фичи

- ![](image://icon-debian.png?resize=32&classes=inline) Основан Debian;
- ![](image://icon-tools.png?resize=32&classes=inline) Администрируй свой сервер через **простой веб-интерфейс** ;
- ![](image://icon-package.png?resize=32&classes=inline) Развертывание **приложение за пару секунд**;
- ![](image://icon-users.png?resize=32&classes=inline) Редактируй **пользователей** <small>(основано на LDAP)</small>;
- ![](image://icon-globe.png?resize=32&classes=inline) Управляй **доменными именами**;
- ![](image://icon-medic.png?resize=32&classes=inline) Создавай и восстанавливай **Бэкапы**;
- ![](image://icon-door.png?resize=32&classes=inline) Соединяй все приложения в **пользовательском портале** <small>(NGINX, SSOwat)</small>;
- ![](image://icon-mail.png?resize=32&classes=inline) Включает **полный стэк электронной почты** <small>(Postfix, Dovecot, Rspamd, DKIM)</small>;
- ![](image://icon-messaging.png?resize=32&classes=inline)... так-же хорошо как **встроенный сервер сообщений** <small>(XMPP)</small>;
- ![](image://icon-lock.png?resize=32&classes=inline) Управляй **SSL сертификатами** <small>(Основано на Let's Encrypt)</small> ;
- ![](image://icon-shield.png?resize=32&classes=inline)... и **системами безопасности** <small>(Fail2ban, yunohost-firewall)</small>;

## История

YunoHost был создан в Феврале 2012 после чего-то типа:

<blockquote><p>"Блин, Я слишком ленив чтобы перенастроить мой почтовый сервер... Beudbeud, как вам удалось запустить свой малеький сервер LDAP?"</p>
<small>Kload, Февраль 2012</small></blockquote>

Всё что было нужно - админ панель для сервера Beudbeud-а чтобы сделать что-то юзабельное, поэтому Kload решил её разработать. В итоге, после автоматизации нескольких конфигураций и упаковки некоторых Веб-приложений, YunoHost v1 быз завершён.

Заметив большое внимание вокруг YunoHost и своими серверами, первоначальные разработчики вместе с новыми помощниками решили начать работу над версией 2. Более универсальной, более мощной, более простой и всё такое.

Название **YunoHost** пришло из жаргонного "Y U NO Host". Этот [интернет мем](https://en.wikipedia.org/wiki/Internet_meme) должен проиллюстрировать это:
![](image://dude_yunohost.jpg)

## Чем не является YunoHost?

Не смотря на то, что YunoHost поддерживает управление несколькими доменами, это **не значит что он может их обьеденять**.

Во первых, код ещё очень молод, не протестирован и не оптимизирован для большого количества пользователей. Однако, мы не хотиим делать весь упор разработки на это.

Вы можете хостить для друзей, семьи и компании легко и просто, но **вы должны доверять ползователям**, и они должны доверять вам превыше всего. Если вы всё-таки хотите предоставлять услуги YunoHost незнакомым людям, полный VPS на каждого пользователя будет достаточно, и мы уверены что есть лучший вариант.

## Логотипы

Чёрный и Белый логотипы YunoHost от ToZz (400 × 400 px):

![](image://ynh_logo_black_300dpi.png?resize=220)
![](image://ynh_logo_white_300dpi.png?resize=220&id=whitelogo)
