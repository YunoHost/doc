# Installation d’une Brique Internet

<div class="alert alert-info" markdown="1">
Site du projet **La Brique Internet** : http://labriqueinter.net/
</div>

*Instructions basées sur l'image **[labriqueinternet_04-06-2015_jessie.img](http://repo.labriqueinter.net/labriqueinternet_04-06-2015_jessie.img.tar.xz)** et écrites début Juillet par kload chez **Neutrinet**.*

![brique](https://yunohost.org/images/thisisinternet.png)

## Prérequis

Une **Brique Internet complète**, soit :
* Un mini-serveur [A20-OLinuXino-LIME](https://www.olimex.com/Products/OLinuXino/A20/A20-OLinuXino-LIME/open-source-hardware) ou [A20-OLinuXino-LIME2](https://www.olimex.com/Products/OLinuXino/A20/A20-OLinuXino-LIME2/open-source-hardware).
* Une carte micro-SD (des [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO) pour des raisons de performance/stabilité).
* Une antenne WiFi [MOD-WIFI-R5370-ANT](https://www.olimex.com/Products/USB-Modules/MOD-WIFI-R5370-ANT/) (non-libre) ou [AR9271](http://fr.aliexpress.com/item/Atheros-AR9271-Chip-150Mbps-Mini-USB-Wifi-Adapter-with-5dBi-Antenna/32344771975.html) (libre, mais limitée à 7 connexions simultanées maximum).
* Un adaptateur secteur [européen](https://www.olimex.com/Products/Power/SY0605E/) pour alimenter la brique. L’alimentation via USB semble peu stable.
* Un câble Ethernet/RJ-45 pour brancher la Brique à son routeur.

Et évidemment, **un ordinateur sous UNIX (e.g. GNU/Linux).**

---

L’ordre des étapes est important.

## Étapes préliminaires

1. Télécharger l’[image](http://repo.labriqueinter.net/labriqueinternet_latest_jessie.img.tar.xz), la décompresser, puis valider son *checksum* (en comparant la valeur de retour de la dernière commande avec [celle sur le site](http://repo.labriqueinter.net/SHA512SUMS)) :
```bash
% cd /tmp/
% wget http://repo.labriqueinter.net/labriqueinternet_latest_jessie.img.tar.xz
% sha512sum labriqueinternet_*.img.xz
% tar -xf labriqueinternet_*.img.tar.xz
```

2. Identifier le nom de la carte micro-SD en tapant la commande `ls -1 /sys/block/`, en insérant la carte micro-SD (éventuellement à l'aide d'un adaptateur) dans son ordinateur, puis en retapant la commande `ls -1 /sys/block/`. Le nom de la carte micro-SD correspond à la ligne qui apparaît en plus après la seconde saisie (e.g. *sdb* ou *mmcblk0*).

3. Copier l'image sur la carte (remplacer *SDNAME* par le nom trouvé lors de l'étape précédente) :
```bash
sudo dd if=/tmp/labriqueinternet_latest_jessie.img of=/dev/SDNAME bs=1M
```

4. **Uniquement pour le modèle LIME2** : Monter la carte micro-SD et changer le lien symbolique suivant :
```bash
% sudo mount /dev/SDNAME /mnt/
% cd /mnt/boot/
% sudo rm board.dtb
% sudo ln -sf /boot/dtb/sun7i-a20-olinuxino-lime2.dtb board.dtb
```

5. Mettre la carte micro-SD dans une Brique, brancher le câble Ethernet et l’alimentation. Elle démarre normalement toute seule, et les LEDs du port Ethernet se mettent à clignoter au bout de 10 secondes maximum.
<div class="alert alert-warning" markdown="1">
Le premier démarrage peut mettre une grosse minute car la partition est redimensionnée et le serveur est redémarré automatiquement.
</div>

6. Récupérer l’adresse IP locale de la Brique, soit avec une commande comme `arp-scan --local | grep -P '\t02'`, soit via l'interface du routeur listant les clients DHCP, soit en branchant un écran en HDMI à la Brique.
<div class="alert alert-info" markdown="1">
Admettons que l’adresse IP locale de la Brique soit **192.168.4.2**
</div>

7. Se connecter en SSH en root à la Brique, le mot de passe est **olinux** par défaut (un changement de mot de passe sera demandé à la première connexion) :
```bash
% ssh root@192.168.4.2
```

8. Mettre à jour le système (environ 10 minutes) :
```bash
% sudo apt-get update && sudo apt-get dist-upgrade
```

## Étapes de configuration

<div class="alert alert-info" markdown="1">
Ici nous installons la Brique de **michu.nohost.me** (à remplacer par le nom de domaine choisi).
</div>

1. Mettre à jour le fichier `/etc/hosts` de son ordinateur client pour pouvoir accéder à la Brique en local via **michu.nohost.me**, en ajoutant à la fin :
```bash
192.168.4.2 michu.nohost.me
```

2. Procéder à la [postinstallation](/postinstall_fr) en se connectant à la Brique sur https://michu.nohost.me (accepter l'exception de sécurité du certificat).
<div class="alert alert-info" markdown="1">
**Note :** il est possible de réaliser cette étape en ligne de commande via SSH en exécutant `yunohost tools postinstall`
</div>

3. **Créer le premier utilisateur** : se rendre dans l’interface d’administration YunoHost (ici https://michu.nohost.me/yunohost/admin), entrer le mot de passe d’administration puis se rendre dans **Utilisateurs** > **Nouvel utilisateur**.
<div class="alert alert-info" markdown="1">
Il faudra entrer un **nom d’utilisateur** sans majuscule/espace/tiret, un **nom/prénom/pseudo** en deux parties (obligatoires, merci LDAP) qui correspondra au nom qui apparaîtra sur les futurs emails de l’utilisateur, ainsi qu'un **quota d’email** éventuel et un **mot de passe** (*à ne pas confondre avec le mot de passe d’administration dans ce cas*).
</div>

4. **Installer l’application VPN Client** : se rendre dans **Applications** > **Installer**, et entrer `https://github.com/labriqueinternet/vpnclient_ynh` dans le champs **URL** du formulaire **Installer une application personnalisée** tout en bas de la page.

5. (optionnel) **Restreindre l’accès à l’application VPN Client** : se rendre dans **Applications** > **VPN Client** > **Accès** et sélectionner l’utilisateur précédemment créé, de sorte que les futurs potentiels nouveaux utilisateurs ne puissent pas modifier les paramètres d’accès VPN.

6. **Configurer l’application VPN Client** : se connecter à l’**interface utilisateur** (ici https://michu.nohost.me/yunohost/sso/) et entrer les identifiants de l’utilisateur précédemment créé. Vous devriez voir apparaître **VPN Client** dans votre liste d’application :
<div><a title="screenshot_vpnclient" target="_blank" href="https://raw.githubusercontent.com/labriqueinternet/vpnclient_ynh/master/screenshot.png">
<img style="border-radius: 5px; border: 5px solid #eee; max-width: 800px" src="https://raw.githubusercontent.com/labriqueinternet/vpnclient_ynh/master/screenshot.png" />
</a></div>
De manière générale, il convient bien sûr d’éditer les paramètres en fonction de son fournisseur d’accès VPN. Ce dernier devra vous fournir des certificats et/ou des identifiants ainsi qu'un préfixe délégué IPv6. Pour Neutrinet, dans **Advanced**, il faudra également ajouter trois directives spécifiques :
<pre><code>resolv-retry infinite
ns-cert-type server
topology subnet</code></pre>
<div class="alert alert-warning" markdown="1">
**Attention** : le redémarrage du service, déclenché par le bouton **Save and reload**, peut mettre quelques minutes.
</div>

7. **Installer l’application Hotspot** : s'assurer que l’antenne WiFi est bien branchée, et répéter les étapes **4**, **5** et **6** en installant à l’aide de l'URL `https://github.com/labriqueinternet/hotspot_ynh` :
<div><a title="screenshot_hotspot" target="_blank" href="https://raw.githubusercontent.com/labriqueinternet/hotspot_ynh/master/screenshot.png">
<img style="border-radius: 5px; border: 5px solid #eee; max-width: 800px" src="https://raw.githubusercontent.com/labriqueinternet/hotspot_ynh/master/screenshot.png" />
</a></div>

8. **TESTER** : la Brique devrait être accessible via l’IP publique que sa connexion VPN lui procure. Si l’utilisateur a opté pour un nom de domaine en **.nohost.me**, patienter quelques minutes que son IP se propage sur le serveur DNS de YunoHost. Si l’utilisateur a opté pour son propre nom de domaine, c’est le moment de [configurer ses enregistrements DNS](/dns_config_fr) correctement chez son registrar.
Si tout se passe bien côté **hotspot**, un réseau WiFi du nom choisi par l’utilisateur à l’étape 7 devrait être visible, et devrait vous router tout bien vers l’Internet.
Il est possible de regarder l’IP avec laquelle on sort sur Internet : [IPv6](http://ip6.yunohost.org) / [IPv4](http://ip.yunohost.org).

# Étapes supplémentaires <small>(pour une Brique idéale)</small>

Ces étapes ne sont pas obligatoires mais peuvent améliorer considérablement l'**expérience de la Brique** (*fap fap fap*).

* **Supprimer le CRON DynDNS** : si l’utilisateur a opté pour un nom de domaine en **.nohost.me**, YunoHost a configuré automatiquement un client DynDNS sur la Brique qui va avertir le serveur DNS d’un potentiel changement d’IP publique. Or, l’IP fourni par la connexion VPN **est fixe**. Il convient donc de supprimer ce client, qui pourrait malencontreusement mettre à jour l’IP dans les DNS si la connexion VPN venait à tomber :
```bash
rm /etc/cron.d/yunohost-dyndns
```

* **S’assurer du nom de l’interface WiFi** : lors du changement d’antenne WiFi (même si le modèle reste le même), il peut arriver que le nom de l’interface WiFi change, typiquement de `wlan0` à `wlan1`. Pour continuer à utiliser l’application **hotspot**, il faut se rendre sur l’interface web de configuration de l’application (étape 10) et mettre à jour le **Device**.

* **Ajouter un CRON de restart du service VPN** : selon les paramètres VPN client et serveur, il peut arriver que la connexion soit instable, et que le client VPN tombe de temps en temps. Pour s’assurer qu’il redémarrera automatiquement, une bonne méthode *quick'n'dirty* et de tester que le service tourne et de le redémarrer dans le cas contraire :
```bash
echo "* * * * * root /sbin/ifconfig tun0 > /dev/null 2>&1 || systemctl restart ynh-vpnclient" > /etc/cron.d/restart-vpn
```

* **Arrêter le service Amavis** :
Amavis est un antivirus qui s’occupe de regarder si les pièces jointes des emails ne sont pas vérolées. Il est très lourd et tombe souvent en panne sur des petites machines comme la Brique. Pour arrêter Amavis (ce qui arrêtera aussi l'antispam), éditer le fichier `/etc/postfix/main.cf` et commenter la ligne 90 (normalement) :
```bash
#content_filter = amavis:[127.0.0.1]:10024
```
Éditer également le fichier `/etc/postfix/master.cf` pour y commenter les lignes relatives à Amavis, vers les lignes 119-122:
```bash
#amavis unix    -       -       -       -       2     smtp
#     -o smtp_data_done_timeout=1200
#     -o smtp_send_xforward_command=yes
#     -o smtp_tls_note_starttls_offer=no
```
Une fois ces éditions effectuées, redémarrer le service postfix et arrêter le service amavis :
```bash
systemctl restart postfix
systemctl stop amavis
systemctl disable amavis
```

* **Arrêter le service postgrey** : Postgrey est un mécanisme antivirus qui est assez peu efficace, et surtout assez pénible. Il refuse les emails en premier lieu lorsque qu’ils proviennent d’une source inconnue. Un serveur email de spam ne fait pas toujours l’effort de renvoyer le spam une seconde fois. Pour arrêter postgrey, il faut éditer le fichier `/etc/postfix/main.cf` et commenter la ligne relative à postgrey (ligne 132) :
```bash
smtpd_recipient_restrictions =
    permit_mynetworks,
    permit_sasl_authenticated,
    reject_non_fqdn_recipient,
    reject_unknown_recipient_domain,
    reject_unauth_destination,
    check_policy_service unix:private/policy-spf
#    check_policy_service inet:127.0.0.1:10023
    permit
```
Une fois le fichier éditer, redémarrer le service postfix :
```bash
systemctl restart postfix
```

* **Mettre à jour la configuration SSH** : par défaut, la connexion en tant que **root** est possible sur la Brique. Pour ne garder que la connexion en tant qu’**admin** (qui est sudoer), il convient d’éditer le `/etc/ssh/sshd_config` et de passer **PermitRootLogin** à **without-password**.

* **Configurer le reverse DNS** : pour s’assurer du bon fonctionnement du serveur email, il est recommandé de configurer un reverse DNS pour son IP. En tant que FAI associatif, c’est un service faisable, autant le demander !

* **Configurer le DKIM** : avec un SPF et un PTR bien configurés dans les DNS, les emails envoyés par la Brique ne devraient pas être considérés comme spam. Ceci dit, GMail et d’autres dégraderont considérablement le spamscore si le DKIM n’est pas configuré également.
Cette opération est longue mais à considérer pour avoir un serveur email irréprochable en production. Plus de renseignement sur [la page de documentation appropriée](/dkim_fr).

* **Installer Roundcube** via l’interface d’administration YunoHost et tester l’envoi/réception d’email.

* **Installer d’autres applications** et les découvrir.

---

## Notes

* **Attention à la RAM** : sur le modèle A20-OLinuXino-LIME, les **512 Mo** partent vite. Les applications PHP ne sont pas très gourmandes, mais Searx et Etherpad Lite sont par exemple à installer avec des pincettes.

* **Glances ne fonctionne pas** sur l’image *labriqueinternet_04-06-2015_jessie.img*, ce qui rend l’onglet **État du serveur** inaccessible dans l’interface d’administration de YunoHost. Une mise à jour future du noyau sera à prévoir pour corriger le problème.