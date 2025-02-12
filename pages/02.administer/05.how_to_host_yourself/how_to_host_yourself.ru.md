
title: Выберите метод самостоятельной развёртки и провайдера
template: docs
taxonomy:
    category: docs
routes:
  default: '/howtohostyourself'
---

Вы можете разместить его у себя дома (на небольшом компьютере) или на удаленном сервере. У каждого решения есть свои плюсы и минусы:

### Дома, например, на плате ARM или старом компьютере

Вы можете запустить YunoHost у себя дома с помощью платы ARM или переоборудованного обычного компьютера, подключенного к вашему домашнему роутеру.

- **Плюсы** : у вас будет физический контроль над машиной, и вам нужно будет только купить оборудование;
- **Минусы** : вам придется [вручную настроить свой роутер](/isp_box_config) и [возможные ограничения вашим провайдером](/isp).

### Дома, используя VPN

VPN - это зашифрованный туннель между двумя компьютерами. На практике это делает все "как если бы" вы были напрямую, локально, подключены к своему серверному компьютеру, но на самом деле откуда-то еще в Интернете. Это позволяет вам по-прежнему разместить сервер у себя дома, обходя возможные ограничения вашего интернет-провайдера. Смотрите также [проект Internet Cube](https://internetcu.be/) и [FFDN](https://www.ffdn.org/).

- **Плюсы** : у вас будет физический контроль над машиной, а VPN скрывает ваш трафик от вашего интернет-провайдера и позволяет вам обойти его ограничения;
- **Минусы** : вам придется оплатить ежемесячную подписку на VPN.

### На удалённом сервере (VPS или выделенный)

Вы можете арендовать виртуальный частный сервер (VPS) или выделенную машину у [ассоциации](https://db.ffdn.org/) или [коммерческие](/providers/server) облачные провайдеры.

- **Плюсы** : ваш сервер и его подключение к Интернету будут быстрыми;
- **Минусы** : вам придется платить ежемесячно за сервер и у вас не будет физического контроля над вашим сервером.

### Суммарно

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
        <td style="text-align:center;">Стоимость оборудования</td>
        <td style="text-align:center;" class="warning"  colspan="2">около 50€ <br><small>(используя Raspberry Pi)</small></td>
        <td style="text-align:center;" class="success">Ничего</td>
      </tr>
      <tr>
        <td style="text-align:center;">Цена за месяц</td>
        <td style="text-align:center;" class="success">Незначительно<br><small>(только за электричество)</small></td>
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
        <td style="text-align:center;">Требуется ли ручное управление<br>портами</td>
        <td style="text-align:center;" class="warning">Да</td>
        <td style="text-align:center;" class="success">Нет</td>
        <td style="text-align:center;" class="success">Нет</td>
      </tr>
      <tr>
        <td style="text-align:center;">Возможные ограничения провайдера</td>
        <td style="text-align:center;" class="danger">Да <br><small>(подробнее <a href="/isp">здесь</a>)</small></td>
        <td style="text-align:center;" class="success">Обходится с помощью VPN</td>
        <td style="text-align:center;" class="success">Обычно нет</td>
      </tr>
      <tr>
        <td style="text-align:center;">ЦП</td>
        <td style="text-align:center;" class="warning" colspan="2">Около ~1 GHz</td>
        <td style="text-align:center;" class="success">~2 GHz <br><small>(Сервер от Digital Ocean)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">ОЗУ</td>
        <td style="text-align:center;" class="warning" colspan="2">Обычно 500 Мб или 1 Гб</td>
        <td style="text-align:center;" class="warning">Related to server cost</td>
      </tr>
      <tr>
        <td style="text-align:center;">Интернет соединенре</td>
        <td style="text-align:center;" class="warning" colspan="2">Зависит от домашнего Интернета</td>
        <td style="text-align:center;" class="success">Обычно достаточно хорошее</td>
      </tr>
    </tbody>
</table>
