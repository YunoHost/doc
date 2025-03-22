---
title: Что такое YunoHost?
template: docs
taxonomy:
    category: docs
routes:
  default: '/whatsyunohost'
---

![YunoHost logo](/img/YunoHost_logo_vertical.png?resize=400&id=ynhlogo)

YunoHost это **операционная система** позволяющая легко администрировать **сервера**, и следовательно позволяет сделать [self-hosting](/selfhosting) надёжным, безопасным, этическим и лёгким. Это свободнораспространяемая библиотека которая поддерживается исключительно волонтёрами. Технически, это дистрибутив основанный на [Debian GNU/Linux](https://debian.org) и может быть установлен на [большое количество систем](/install).

## Фичи

- ![](/img/icon-debian.png?resize=32&classes=inline) Основан на Debian;
- ![](/img/icon-tools.png?resize=32&classes=inline) Администрируй свой сервер через **простой веб-интерфейс** ;
- ![](/img/icon-package.png?resize=32&classes=inline) Развертывание **приложение за пару секунд**;
- ![](/img/icon-users.png?resize=32&classes=inline) Редактируй **пользователей** <small>(основано на LDAP)</small>;
- ![](/img/icon-globe.png?resize=32&classes=inline) Управляй **доменными именами**;
- ![](/img/icon-medic.png?resize=32&classes=inline) Создавай и восстанавливай **бэкапы**;
- ![](/img/icon-door.png?resize=32&classes=inline) Соединяй все приложения в **пользовательском портале** <small>(NGINX, SSOwat)</small>;
- ![](/img/icon-mail.png?resize=32&classes=inline) Включает **полный набор для работы электронной почты** <small>(Postfix, Dovecot, Rspamd, DKIM)</small>;
- ![](/img/icon-lock.png?resize=32&classes=inline) Управляй **SSL сертификатами** <small>(Основано на Let's Encrypt)</small> ;
- ![](/img/icon-shield.png?resize=32&classes=inline)... и **системами безопасности** <small>(`fail2ban`, `yunohost-firewall`)</small>;

## История

YunoHost был создан в Феврале 2012 после чего-то вроде:

> "Блин, Я слишком ленив чтобы перенастроить мой почтовый сервер... Beudbeud, как вам удалось запустить свой малеький сервер LDAP?"
> <small>Kload, Февраль 2012</small>

Всё что было нужно - админ панель для сервера Beudbeud-а чтобы сделать что-то юзабельное, поэтому Kload решил её разработать. В итоге, после автоматизации нескольких конфигураций и упаковки некоторых Веб-приложений, YunoHost v1 был завершён.

Заметив большое внимание вокруг YunoHost и своими серверами, первоначальные разработчики вместе с новыми помощниками решили начать работу над версией 2. Более универсальной, более мощной, более простой и всё такое.

Название **YunoHost** пришло из жаргонного "Y U NO Host". Этот [интернет мем](https://ru.wikipedia.org/wiki/%D0%98%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B5%D0%BC) должен проиллюстрировать это:
![](/img/dude_yunohost.jpg)

## Чем не является YunoHost?

Не смотря на то, что YunoHost поддерживает управление несколькими доменами, это **не значит что он может их обьеденять**.

Во первых, код ещё очень молод, не протестирован и не оптимизирован для большого количества пользователей. Однако, мы не хотиим делать весь упор разработки на это.

Вы можете хостить для друзей, семьи и компании легко и просто, но **вы должны доверять ползователям**, и они должны доверять вам превыше всего. Если вы всё-таки хотите предоставлять услуги YunoHost незнакомым людям, полный VPS на каждого пользователя будет достаточно, и мы уверены что есть лучший вариант.

## Логотипы

Чёрный и Белый логотипы YunoHost от ToZz (400 × 400 px). Licence: CC-BY-SA 4.0. Logos and other artwork are available in <https://github.com/YunoHost/yunohost-artwork>

![](/img/ynh_logo_black_300dpi.png?resize=220) ![](/img/ynh_logo_white_300dpi.png?resize=220&id=whitelogo)
