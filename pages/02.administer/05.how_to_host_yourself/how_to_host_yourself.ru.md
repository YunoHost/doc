
title: Choose your selfhosting method and providers
template: docs
taxonomy:
    category: docs
routes:
  default: '/howtohostyourself'
---

You can host yourself at home (on a small computer), or on a remote server. Each solution has their pros and cons:

### At home, for instance on an ARM board or an old computer

You can host yourself at home with an ARM board or a re-purposed regular computer, connected to your home router/box. 

- **Pros**  : you will have physical control of the machine and only need to buy the hardware;
- **Cons**  : you will have to [manually configure your internet box](/isp_box_config) and [might be limited by your ISP](/isp).

### At home, behind a VPN

A VPN is an encrypted tunnel between two machines. In practice, it makes it "as if" you were directly, locally, connected to your server machine, but actually from somewhere else on the Internet. This allows you to still host yourself at home, while bypassing possible limitations of your ISP. See also [the Internet Cube project](https://internetcu.be/) and [the FFDN](https://www.ffdn.org/).

- **Pros** : you will have physical control of the machine, and the VPN hides your traffic from your ISP and allows you to bypass its limitations;
- **Cons** : you will have to pay a monthly subscription for the VPN.

### On a remote server (VPS or dedicated server)

You can rent a virtual private server or a dedicated machine from [associative](https://db.ffdn.org/) or [commercial](/providers/server) "Cloud" providers.

- **Pros** : your server and its internet connectivity will be fast;
- **Cons** : you will have to pay a monthly subscription and won't have physical control of your server.

### Summary

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
        <td style="text-align:center;">Физический контроль<br>of the machine</td>
        <td style="text-align:center;" class="success">Да</td>
        <td style="text-align:center;" class="success">Да</td>
        <td style="text-align:center;" class="danger">Нет</td>
      </tr>
      <tr>
        <td style="text-align:center;">Manual port <br>routing required</td>
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