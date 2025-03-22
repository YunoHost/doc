---
title: Chat, VoIP and social network with XMPP
template: docs
taxonomy:
    category: docs
routes:
  default: '/XMPP'
---

![](/img/XMPP_logo.png?resize=100)

По умолчанию YunoHost поставляется с сервером обмена мгновенными сообщениями Metronome, который реализует [XMPP protocol](https://en.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol) (ранее известный как Jabber).

Этот протокол уже используется миллионами людей по всему миру - это открытый протокол. Все приложения, основанные на XMPP, совместимы друг с другом: при использовании клиента XMPP вы можете взаимодействовать с любым пользователем, у которого есть учетная запись XMPP.

XMPP - это расширяемый протокол — это означает, что пользователи могут настраивать "расширения" для комнат чатов, обмениваться сообщениями и файлами, а также совершать голосовые и видеозвонки с помощью XMPP.

## Учетная запись XMPP

Чтобы использовать учетную запись XMPP, вам нужно имя пользователя в формате: `user@domain.tld` и password.

С YunoHost учетная запись XMPP создается для всех пользователей YunoHost автоматически.
Учетные данные учетной записи XMPP соответствуют основному адресу электронной почты пользователя и паролю.

## Подключение к вашей учетной записи YunoHost XMPP

Вы можете подключиться к своей учетной записи YunoHost XMPP различными способами.

### Веб - клиенты

- [Movim](https://movim.eu)
- [ConverseJS](https://conversejs.org/)
- [Libervia/Salut à Toi](https://salut-a-toi.org/)

### Настольные клиенты

- [Gajim](https://gajim.org/) (Linux, Windows)
- [Dino](https://dino.im) (Linux)
- [Thunderbird](https://www.thunderbird.net/fr/) (multiplatform)
- [Beagle IM](https://beagle.im/) (macOS)
- [Profanity](https://profanity-im.github.io/) (Linux)

### Мобильные клиенты

- [Conversations](https://conversations.im/) (Android)
- [Xabber](https://xabber.com) (Android)
- [Movim](https://movim.eu) (Android)
- [ChatSecure](https://chatsecure.org/) (iOS)
- [Monal](https://monal.im/) (iOS)
- [Siskin IM](https://siskin.im/) (iOS)
- [Kaidan](https://www.kaidan.im/) (Ubuntu Touch / Plasma Mobile)

Вот исчерпывающий список клиентов XMPP: <https://xmpp.org/software/clients.html>

## Шифруйте разговоры с помощью OMEMO

XMPP-чаты можно сделать безопасными и приватными с помощью [шифрования OMEMO](https://xmpp.org/extensions/xep-0384.html), например, с помощью Gajim:

- Установить `gajim` и плагин `gajim-omemo`.
- Включите плагин в `Tools > Plugins`.
- Включите шифрование в чате с кем-нибудь, у кого также есть OMEMO.

## Комнаты Чата

Чтобы создать чат-комнату (многопользовательский чат) на вашем сервере YunoHost, используйте идентификатор `chatroomname@muc.yourdomain.tld`.

Чтобы это сработало, вам нужно [добавить соответствующий `muc.` DNS записи](/install/post_install/dns_config) в конфигурации DNS.

## VoIP и видеоконференции

Практическим инструментом для вызова клиента XMPP с помощью голоса или голоса + видео является использование клиента [Jitsi](https://jitsi.org/).
