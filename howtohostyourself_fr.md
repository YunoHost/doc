# Choisir son mode d'autohébergement

Vous pouvez vous auto-héberger à la maison (sur un petit ordinateur), ou sur un serveur distant. Chaque solution a ses avantages et inconvénients :

### À la maison, par exemple sur une carte ARM ou un ancien ordinateur

Vous pouvez vous héberger chez vous, sur une carte ARM ou un vieil ordinateur, connecté à votre box internet.

- **Avantages** : vous aurez un contrôle physique sur la machine et avez seulement besoin d'acheter le matériel initial ;
- **Inconvénients** : il vous faudra [configurer manuellement votre box internet](isp_box_config) et serez possiblement [limité par certains aspects de votre fournisseur d'accès internet](isp).

### À la maison, derrière un VPN

Un VPN est un tunnel chiffré entre deux machines. En pratique, cela permet de faire "comme si" une machine était connectée depuis ailleurs. Ceci permet de s'auto-héberger à la maison tout en contournant les limitations du fournisseur d'accès internet. Voir aussi [le projet Brique Internet](https://labriqueinter.net/) et [la FFDN](https://www.ffdn.org/).

- **Avantages** : vous aurez un contrôle physique sur la machine, et le VPN permettra de cacher votre trafic vis-à-vis de votre FAI ainsi que de contourner ses limitations ;
- **Inconvénients** : il vous faudra payer des frais mensuels pour le VPN.

### Sur un serveur distant (VPS ou serveur dédié)

Vous pouvez louer un serveur privé virtuel ou une machine dédiée à des hébergeurs [associatifs](https://db.ffdn.org/) ou commerciaux.

- **Avantages** : votre serveur sera rapide et la connectivité internet sera bonne ;
- **Inconvénients** : il vous faudra payer des frais mensuels pour la machine, et vous n'aurez pas de contrôle physique dessus.

### Résumé

<table class="table">
    <thead>
      <tr>
        <th></th>
        <th style="text-align:center;">À la maison<br><small>(e.g. carte ARM, vieil ordi)</small></th>
        <th style="text-align:center;">À la maison<br>derrière un VPN</th>
        <th style="text-align:center;">Sur un serveur distant<br>(VPS ou dédié)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center;">Coût matériel</td>
        <td style="text-align:center;" class="warning"  colspan="2">Autour de 50€ <br><small>(e.g. un Raspberry Pi)</small></td>
        <td style="text-align:center;" class="success">Aucun</td>
      </tr>
      <tr>
        <td style="text-align:center;">Coût mensuel</td>
        <td style="text-align:center;" class="success">Négligeable<br><small>(electricité)</small></td>
        <td style="text-align:center;" class="warning">Autour de 5€ <br><small>(VPN)</small></td>
        <td style="text-align:center;" class="warning">À partir de ~3€ <br><small>(VPS)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">Contrôle physique<br>sur la machine</td>
        <td style="text-align:center;" class="success">Oui</td>
        <td style="text-align:center;" class="success">Oui</td>
        <td style="text-align:center;" class="danger">Non</td>
      </tr>
      <tr>
        <td style="text-align:center;">Routage manuel <br>des ports</td>
        <td style="text-align:center;" class="warning">Oui</td>
        <td style="text-align:center;" class="success">Non</td>
        <td style="text-align:center;" class="success">Non</td>
      </tr>
      <tr>
        <td style="text-align:center;">Limitation possibles <br >par le FAI</td>
        <td style="text-align:center;" class="danger">Oui <br><small>(voir [ici](/isp))</small></td>
        <td style="text-align:center;" class="success">Contournées par le VPN</td>
        <td style="text-align:center;" class="success">Généralement non</td>
      </tr>
      <tr>
        <td style="text-align:center;">CPU</td>
        <td style="text-align:center;" class="warning" colspan="2">Généralement ~1 GHz</td>
        <td style="text-align:center;" class="success">~2 GHz <br><small>(droplet Digital Ocean)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">RAM</td>
        <td style="text-align:center;" class="warning" colspan="2">Généralement 500 Mo ou 1 Go</td>
        <td style="text-align:center;" class="warning">En fonction du prix</td>
      </tr>
      <tr>
        <td style="text-align:center;">Connectivité internet</td>
        <td style="text-align:center;" class="warning" colspan="2">Dépend de la connexion</td>
        <td style="text-align:center;" class="success">Généralement bonne</td>
      </tr>
    </tbody>
</table>
