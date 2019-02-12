# How to host yourself ?

You can host yourself at home (on a small computer), or on a remote server. Each solution has their pros and cons:

### At home, for instance on an ARM board or an old computer

You can host yourself at home with an ARM board or a re-purposed regular computer, connected to your home router/box. 

- **Pros**  : you will have physical control of the machine and only need to buy the hardware;
- **Cons**  : you will have to [manually configure your internet box](isp_box_config) and [might be limited by your ISP](isp).

### At home, behind a VPN

A VPN is an encrypted tunnel between two machines. In practice, it makes it "as if" you were directly, locally, connected to your server machine, but actually from somewhere else on the Internet. This allows you to still host yourself at home, while bypassing possible limitations of your ISP. See also [the Internet Cube project](https://internetcu.be/) and [the FFDN](https://www.ffdn.org/).

- **Pros** : you will have physical control of the machine, and the VPN hides your traffic from your ISP and allows you to bypass its limitations;
- **Cons** : you will have to pay a monthly subscription for the VPN.

### On a remote server (VPS or dedicated server)

You can rent a virtual private server or a dedicated machine from [associative](https://db.ffdn.org/) or commercial "Cloud" providers.

- **Pros** : your server and its internet connectivity will be fast;
- **Cons** : you will have to pay a monthly subscription and won't have physical control of your server.

### Summary

<table class="table">
    <thead>
      <tr>
        <th></th>
        <th style="text-align:center;">At home<br><small>(e.g. ARM board, old computer)</small></th>
        <th style="text-align:center;">At home<br>behind a VPN</th>
        <th style="text-align:center;">On a remote server<br>(VPS or dedicated)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center;">Hardware cost</td>
        <td style="text-align:center;" class="warning"  colspan="2">About 50€ <br><small>(e.g. a Raspberry Pi)</small></td>
        <td style="text-align:center;" class="success">None</td>
      </tr>
      <tr>
        <td style="text-align:center;">Monthly cost</td>
        <td style="text-align:center;" class="success">Negligible<br><small>(electricity)</small></td>
        <td style="text-align:center;" class="warning">Around 5€ <br><small>(VPN)</small></td>
        <td style="text-align:center;" class="warning">Starting at ~3€ <br><small>(VPS)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">Physical control<br>of the machine</td>
        <td style="text-align:center;" class="success">Yes</td>
        <td style="text-align:center;" class="success">Yes</td>
        <td style="text-align:center;" class="danger">No</td>
      </tr>
      <tr>
        <td style="text-align:center;">Manual port <br>routing required</td>
        <td style="text-align:center;" class="warning">Yes</td>
        <td style="text-align:center;" class="success">No</td>
        <td style="text-align:center;" class="success">No</td>
      </tr>
      <tr>
        <td style="text-align:center;">Possible ISP limitations</td>
        <td style="text-align:center;" class="danger">Yes <br><small>(see [here](/isp))</small></td>
        <td style="text-align:center;" class="success">Bypassed by VPN</td>
        <td style="text-align:center;" class="success">Typically no</td>
      </tr>
      <tr>
        <td style="text-align:center;">CPU</td>
        <td style="text-align:center;" class="warning" colspan="2">Typically ~1 GHz</td>
        <td style="text-align:center;" class="success">~2 GHz <br><small>(Digital Ocean droplet)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">RAM</td>
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
