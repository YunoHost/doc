
title: Choose your selfhosting method and providers
template: docs
taxonomy:
    category: docs
routes:
  default: '/howtohostyourself'
---

Вы можете разместить его у себя дома (на небольшом компьютере) или на удаленном сервере. У каждого решения есть свои плюсы и минусы:

### Дома, например, на плате ARM или старом компьютере

Вы можете разместить себя дома с помощью платы ARM или переоборудованного обычного компьютера, подключенного к вашему домашнему роутеру.
- **Плюсы** : у вас будет физический контроль над машиной, и вам нужно будет только купить оборудование;
- **Минусы** : вам придется [вручную настроить свой интернет-бокс](/isp_box_config) и [может быть ограничено вашим провайдером](/isp).

### Дома, используя VPN

VPN - это зашифрованный туннель между двумя компьютерами. На практике это делает все "как если бы" вы были напрямую, локально, подключены к своему серверному компьютеру, но на самом деле откуда-то еще в Интернете. Это позволяет вам по-прежнему принимать гостей у себя дома, обходя возможные ограничения вашего интернет-провайдера. Смотрите также [проект Internet Cube](https://internetcu.be /) и [FFDN](https://www.ffdn.org /).

- **Плюсы** : у вас будет физический контроль над машиной, а VPN скрывает ваш трафик от вашего интернет-провайдера и позволяет вам обойти его ограничения;
- **Минусы** : вам придется оплатить ежемесячную подписку на VPN.
- 
### На удалённом сервере (VPS или выделенный)

Вы можете арендовать виртуальный частный сервер или выделенную машину у [associative](https://db.ffdn.org /) или [коммерческие] (/провайдеры/сервер) облачные провайдеры.

- **Плюсы** : ваш сервер и его подключение к Интернету будут быстрыми;
- **Минусы** : вам придется оплачивать ежемесячную подписку, и у вас не будет физического контроля над вашим сервером.

### Итого

<table>
    <thead>
      <tr>
        <th></th>
        <th style="text-align:center;">Дома<br><small>(допустим ARM платы или старый компьютер)</small></th>
        <th style="text-align:center;">Дома<br>используя ВПН</th>
        <th style="text-align:center;">На удалённом сервере<br>(VPS или выделенный)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center;">Цена железа</td>
        <td style="text-align:center;" class="warning"  colspan="2">около 50€ <br><small>(используя Raspberry Pi)</small></td>
        <td style="text-align:center;" class="success">Ничего</td>
      </tr>
      <tr>
        <td style="text-align:center;">Цена за месяц</td>
        <td style="text-align:center;" class="success">Незначительный<br><small>(электричество)</small></td>
        <td style="text-align:center;" class="warning">около 5€ <br><small>(VPN)</small></td>
        <td style="text-align:center;" class="warning">около 3€ <br><small>(VPS)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">Физический контроль<br>к компьютеру</td>
        <td style="text-align:center;" class="success">Да</td>
        <td style="text-align:center;" class="success">Да</td>
        <td style="text-align:center;" class="danger">Нет</td>
      </tr>
      <tr>
        <td style="text-align:center;">Ручное управление<br>портами необходимо</td>
        <td style="text-align:center;" class="warning">Yes</td>
        <td style="text-align:center;" class="success">No</td>
        <td style="text-align:center;" class="success">No</td>
      </tr>
      <tr>
        <td style="text-align:center;">Possible ISP limitations</td>
        <td style="text-align:center;" class="danger">Yes <br><small>(see <a href="/isp">here</a>)</small></td>
        <td style="text-align:center;" class="success">Bypassed by VPN</td>
        <td style="text-align:center;" class="success">Typically no</td>
      </tr>
      <tr>
        <td style="text-align:center;">ЦП</td>
        <td style="text-align:center;" class="warning" colspan="2">Typically ~1 GHz</td>
        <td style="text-align:center;" class="success">~2 GHz <br><small>(Digital Ocean droplet)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">ОЗУ</td>
        <td style="text-align:center;" class="warning" colspan="2">Typically 500 Mb or 1 Gb</td>
        <td style="text-align:center;" class="warning">Related to server cost</td>
      </tr>
      <tr>
        <td style="text-align:center;">Internet connectivity</td>
        <td style="text-align:center;" class="warning" colspan="2">Depends on home connectivity</td>
        <td style="text-align:center;" class="success">Typically pretty good</td>
      </tr>
    </tbody>
</table>