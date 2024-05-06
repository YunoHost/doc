---
title: Scegliere il tuo metodo e provider di self-hosting
template: docs
taxonomy:
    category: docs
routes:
  default: '/howtohostyourself'
---

Puoi fare self-hosting in casa (su un piccolo computer), o su un server remoto. Ogni soluzione ha i suoi pro e i suoi contro:

### In casa, per esempio con una scheda ARM o con un vecchio computer

Puoi fare self-hosting in proprio, con una scheda ARM o con un vecchio computer, connesso con il tuo router.

- **Pro**: avrai un controllo fisico sulla macchina e avrai bisogno solo di acquistare il materiale per iniziare;
- **Contro**: dovrai [configurare manualmente il router](/isp_box_config) e probabilmente ci saranno dei [limiti rispetto al tuo fornitore di accesso a internet](/isp)

### In casa, dietro una VPN

Una VPN è un tunnel criptato tra due macchine. In pratica permette di avere una macchina «come se» fosse connessa ad un'altra. Questa soluzione permette di fare self-hosting a casa aggirando i limiti del fornitore di accesso a internet. Vedi anche il [progetto Brique Internet](https://labriqueinter.net) e [FFDN](https://www.ffdn.org).

- **Pro**: avrai un controllo fisico sulla macchina e la VPN ti permetterà di nascondere il traffico al tuo ISP e ti permetterà di bypassare le sue limitazioni.
- **Contro**: dovrai pagare un canone mensile per la VPN.

### Su un server distante (VPS o server dedicato)

Puoi affittare un server virtuale privato o un macchina dedicata da fornitori "Cloud" come [associazioni](https://db.ffdn.org) o [commerciali](/providers/server)

- **Pro**: il tuo server e la connessione saranno veloci;
- **Contro**: dovrai pagare un canone mensile per la macchina e non avrai il controllo fisico del tuo server.

### Sommario

<table>
    <thead>
      <tr>
        <th></th>
        <th style="text-align:center;">In casa<br><small>(e.g. scheda ARM, vecchio computer)</small></th>
        <th style="text-align:center;">In casa<br>dietro una VPN</th>
        <th style="text-align:center;">Su un server distante<br>(VPS o dedicato)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center;">Costo del materiale</td>
        <td style="text-align:center;" class="warning"  colspan="2">Circa 50€ <br><small>(e.g. un Raspberry Pi)</small></td>
        <td style="text-align:center;" class="success">Nessuno</td>
      </tr>
      <tr>
        <td style="text-align:center;">Costo mensile</td>
        <td style="text-align:center;" class="success">Trascurabile<br><small>(elettricità)</small></td>
        <td style="text-align:center;" class="warning">Circa 5€ <br><small>(VPN)</small></td>
        <td style="text-align:center;" class="warning">A partire da ~3€ <br><small>(VPS)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">Controllo fisico<br>sulla macchina</td>
        <td style="text-align:center;" class="success">Si</td>
        <td style="text-align:center;" class="success">Si</td>
        <td style="text-align:center;" class="danger">No</td>
      </tr>
      <tr>
        <td style="text-align:center;">Routing manuale <br>delle porte</td>
        <td style="text-align:center;" class="warning">Si</td>
        <td style="text-align:center;" class="success">No</td>
        <td style="text-align:center;" class="success">No</td>
      </tr>
      <tr>
        <td style="text-align:center;">Possibili limitazioni <br >dall'ISP</td>
        <td style="text-align:center;" class="danger">Si <br><small>(vedere <a href="/isp">qui</a>)</small></td>
        <td style="text-align:center;" class="success">Aggirati dalla VPN</td>
        <td style="text-align:center;" class="success">Generalmente no</td>
      </tr>
      <tr>
        <td style="text-align:center;">CPU</td>
        <td style="text-align:center;" class="warning" colspan="2">Generalmente ~1 GHz</td>
        <td style="text-align:center;" class="success">~2 GHz <br><small>(Digital Ocean droplet)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">RAM</td>
        <td style="text-align:center;" class="warning" colspan="2">Generalmente 500 Mb o 1 Gb</td>
        <td style="text-align:center;" class="warning">In relazione al costo del server</td>
      </tr>
      <tr>
        <td style="text-align:center;">Connettività internet</td>
        <td style="text-align:center;" class="warning" colspan="2">Dipende dalla connessione di casa</td>
        <td style="text-align:center;" class="success">Generalmente buona</td>
      </tr>
    </tbody>
</table>
