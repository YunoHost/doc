---
title: VPN providers
template: docs
taxonomy:
    category: docs
never_cache_twig: true
twig_first: true
process:
    markdown: true
    twig: true
routes:
  default: '/providers/vpn'
---

Since setting up a server at home is an uncommon practice, most Internet connections provided to individuals are unsuitable for this purpose especially if you desire to send mail. A net neutral VPN providing a dedicated fixed public IPv4 address and IPv6 addresses [can help to circumvent some limitations or difficulties](/vpn_advantage).


Below, you can find a list of providers compatible for self-hosting and especially those providing .cube format for VPNClient apps and those providing [internetcube](https://internetcu.be).

!!! By **compatible for self-hosting** we means VPN offers with at least:
!!! * a fixed dedicated public IPv4
!!! * port forwarding or opened features
!!! * net neutrality: no traffic analysis, no user data resale, no alteration of traffic (without legal obligations)...

------------------

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="English speaking-site"]

| VPN provider | [VPNClient](https://github.com/labriqueinternet/vpnclient_ynh) compatibility | IPv6 | rDNS IPv4 | rDNS IPv6 | Price | Membership | Net Neutrality |
| ------------ | ----------------------- | ---- | --------- | --------- | ----- | -------------- |
| [Neutrinet](https://neutrinet.be/en/vpn)    | ✔ (.cube + [internetcube](https://internetcu.be))               | ✔    | ✔         | ?         | ~8 €¹ / month | included | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
¹ [Pay what you want](https://en.wikipedia.org/wiki/Pay_what_you_want)

!!! If you try an other VPN provider that include **public dedicated ipv4 and port forwarding**, feel free to contribute to this documentation. We need people to test specific offers of those commercial providers:
!!! * [VPN area](https://vpnarea.com/front/home/dedicated-ip) ✘ does not allow forwarding port 80. Running a webserver is against their TOS.
!!! * [Trust zone](https://trust.zone/fr/order?p=25)
!!! * [PureVPN](https://www.purevpn.fr/ip-vpn-dedie)
!!! * [RapidVPN](https://www.rapidvpn.com/vpn)
[/ui-tab]
[ui-tab title="French speaking-site"]

| Fournisseurs | Compatibilité [VPNClient](https://github.com/labriqueinternet/vpnclient_ynh) | IPv6 | rDNS IPv4 | rDNS IPv6 | Prix | Adhésion | Neutralité du net |
| ------------ | ----------------------- | ---- | --------- | --------- | ----- | -------------- |
| [Aquilenet](https://www.aquilenet.fr/vpn/)    | ✔ (.cube)               | ✔    | ✔         | ✔         | 3 à 5 / mois | ~15€¹ /an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Alsace Réseau Neutre](https://arn-fai.net/vpn)    | ✔ (.cube + [internetcube](https://internetcu.be))               | ✔    | ✔         | ✔         | 4 € (ou [Ğ1](https://duniter.org/fr/monnaie-libre-g1/)) / mois | 15€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Baionet](https://www.baionet.fr/nos-services/vpn/)    | ✘ (wireguard)               | ?    | ?         | ?         | 2,5 € ou 5 € / mois | 5€ ou 40€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [FAImaison](https://www.faimaison.net/services/vpn.html)    | ✔ (.cube)               | ✘   | ✔         | ✘        | Prix libre | 8 ou 16€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [French Data Network](https://www.fdn.fr/services/vpn/)    | ✔ (.cube)               | ✔   | ✔         | ✔        | 6,5€ à 23€ / mois | 15 ou 30€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Franciliens](https://www.franciliens.net/acces-internet/vpn/)    | ✔ (.cube + [internetcube](https://internetcu.be))               | ✔   | ✔         | ✔        | 6,5€ à 23€ / mois | 15 ou 30€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Grifon](https://grifon.fr/services/vpn/)    | ✔ (manuelle) + L2TP/IPSec               | ✔   | ✔         | ✔        | 5€ / mois | 15€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Igwan.net](https://igwan.net)    | ✘ (L2TP/IPSec)               | ?    | ?         | ?         | 4 ou 8€ / mois | ? / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Illyse](https://www.illyse.net/acces-internet-par-vpn/)    | ✔ (manuelle)               | ✔    | ✔         | ✔         | 6 ou 8€ / mois | 20€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [ILOTH](https://iloth.net/vpn/)    | ✔ (.cube)               | ✘   | ✔         | ✘        | 80€ / an | 5 à 100€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Milkywan](https://milkywan.fr/prices#popupTunnel)    | ✔ (manuelle)               | ✔    | ✔         |  ✔        | 5 € / mois | incluse | |
| [Mycélium](https://mycelium-fai.org/wiki/documentation/services/vpn)    | ✔ (manuelle)               | ✘    | ✘         | ✘         | Prix libre | incluse<br>Réservé aux nordistes(FR 59) | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Neutrinet](https://neutrinet.be/en/vpn)    | ✔ (.cube + [internetcube](https://internetcu.be))               | ✔    | ✔         | ?         | ~8 €¹ / mois | incluse | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Rézine](https://www.rezine.org/acces_internet/tunnels_chiffr%C3%A9s/)    | ✔ (manuelle)               | ✔   | ✔         | ✔        | 5 à 10€ / mois | Prix libre | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Swiss Neutral Network](https://www.swissneutral.net/?page_id=31)    | ✔ (.cube)               | ✔    |  ✔        | ✔         | 30.- CHF/mois | 50.- CHF / an<br>Réservé aux suisses | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Tetaneutral](https://tetaneutral.net/adherer/)    | ✘ (wireguard)               | ?    | ?         | ?         | 5€¹ / mois | 5 à 100€¹ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |
| [Touraine Data Network](https://tdn-fai.net/)    | ✔ (.cube + [internetcube](https://internetcu.be))               | ✔    | ?         | ?         | 5€ / mois | 10 à 20€ / an | <span class="ffdn">FFDN</span> <span class="label label-success label-as-badge">Non Profit</span> |

¹ Prix libre

[/ui-tab]
[ui-tab title="German speaking-site"]
| VPN provider | [VPNClient](https://github.com/labriqueinternet/vpnclient_ynh) compatibility | IPv6 | rDNS IPv4 | rDNS IPv6 | Price | Membership | Net Neutrality |
| ------------ | ----------------------- | ---- | --------- | --------- | ----- | -------------- |
| [In-Berlin](https://in-vpn.de/provider/vpn.html)    | ✔ (manuelle)               | ✔    | ✔         | ✔         | 9 or 14€ / month | 20€ / an | <span class="label label-success label-as-badge">Non Profit</span> |

[/ui-tab]
[/ui-tabs]

<style>
.ffdn {
    background-color: #3a87ad;
    border-radius: 3px;
    display: inline-block;
    padding: 4px 4px;
    font-weight: bold;
    line-height: 14px;
    color: #f8f8f8;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    white-space: nowrap;
    vertical-align: baseline;
}
</style>
