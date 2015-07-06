# Installation d’une Brique Internet

*Instructions basées sur l'image **[labriqueinternet_04-06-2015_jessie.img](http://repo.labriqueinter.net/labriqueinternet_04-06-2015_jessie.img.tar.xz)** et écrites début Juillet par kload chez **Neutrinet**.*

![brique](https://yunohost.org/images/thisisinternet.png)

## Prérequis

Une **Brique Internet complète**, soit :
* Une board [A20-OLinuXino-LIME](https://www.olimex.com/Products/OLinuXino/A20/A20-OLinuXino-LIME/open-source-hardware)
* Une carte microSD (on utilise des [Trasncend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO) pour des raisons de performance/stabilité)
* Une antenne WiFi [MOD-WIFI-R5370-ANT](https://www.olimex.com/Products/USB-Modules/MOD-WIFI-R5370-ANT/) (seule version testée jusqu’à présent chez nous)
* Un adaptateur secteur pour alimenter la brique ([chinois](https://www.olimex.com/Products/Power/SY0605E-CHINA/) ou [européen](https://www.olimex.com/Products/Power/SY0605E/)). L’alimentation via USB semble peu stable.
* Un câble Ethernet/RJ-45 pour brancher la Brique à son routeur

**+ un ordinateur sous UNIX**

---

L’installation s’articule en deux parties : les étapes réalisables sans avoir besoin de l’utilisateur, et les étapes de configuration pour lesquelles la présence de l’utilisateur est recommandée.

L’ordre des étapes est important :-)

## Étapes préliminaires

1. Télécharger l’image à partir de https://repo.labriqueinter.net, valider son checksum.

2. Copier l'image sur la carte à l'aide de `dd` (la commande, pas le patron du bistro d’en face)
```bash
sudo dd if=labriqueinternet_XX-XX-XXXX_jessie.img of=/dev/sdX bs=1M
```

3. Mettre la carte SD dans une Brique, brancher le câble Ethernet et l’alimentation. Elle démarre normalement toute seule, et les LEDs du port Ethernet se mettent à clignoter au bout de 10 secondes maximum.
<div class="alert alert-warning" markdown="1">
Le premier démarrage peut mettre une grosse minute car la partition est redimensionnée et la board redémarrée automatiquement.
</div>

4. Récupérer l’adresse IP locale de la Brique, soit avec une commande comme `nmap -T4 -sP 192.168.x.0/24`, soit via l'interface du routeur listant les clients DHCP, soit en branchant un écran en HDMI à la Brique.
<div class="alert alert-info" markdown="1">
Admettons que l’adresse IP locale de la Brique soit **192.168.4.2**
</div>

5. Se connecter en SSH en root à la Brique, le mot de passe est **olinux** par défaut. Le changer par un mot de passe temporaire à modifier avec l’utilisateur par la suite.
```bash
ssh root@192.168.4.2
```
6. Mettre à jour le système (environ 10 minutes), et pré-installer les paquets qui seront nécessaires aux applications **vpnclient** et **hotspot** (comme ça c'est fait).
```bash
apt-get update && apt-get upgrade
apt-get install openvpn sipcalc hostapd iw dnsmasq firmware-linux-free firmware-linux-nonfree \ firmware-realtek firmware-ralink
```

---

**Plus d’étapes pourront sans doute être automatisées dans cette partie à l’avenir.**

---

## Étapes de configuration

1. Assembler la Brique, la brancher sur le routeur, la démarrer, récupérer son IP locale et le nom de domaine désiré par l’utilisateur.
<div class="alert alert-info" markdown="1">
Ici nous installons la Brique de **michu.nohost.me** qui a pour IP locale **192.168.4.2**
</div>

2. Mettre à jour le fichier `/etc/hosts` de son ordinateur client pour pouvoir accéder à la Brique en local via **michu.nohost.me** (important pour la configuration des applications **vpnclient** et **hotspot**).  
Ajouter à la fin du fichier :
```bash
192.168.4.2 michu.nohost.me
```

3. Procéder à la [postinstallation](/postinstallation_fr) en se connectant à la Brique sur https://michu.nohost.me. L’uilisateur pourra lui-même saisir le mot de passe d’administration qu'il souhaite lors de cette étape.
<div class="alert alert-info" markdown="1">
**Note :** il est possible de réaliser cette étape en ligne de commande via SSH en exécutant `yunohost tools postinstall`
</div>

4. Se connecter en SSH et changer le mot de passe **root** (potentiellement par le même mot de passe que l’administration pour éviter la complexité).
```bash
ssh root@michu.nohost.me
passwd root
```

5. **Fix temporaire** : la création des répertoires utilisateur ne se fait pas automatiquement dans cette image YunoHost pour la Brique. Il convient donc d'ajouter un script qui s'exécutera à la création des utilisateurs YunoHost et qui s’en assurera.  
En SSH sur la Brique :
```bash
mkdir -p /usr/share/yunohost/hooks/post_user_create
cat > /usr/share/yunohost/hooks/post_user_create/06-create_userdir <<EOF
#!/bin/bash
user=\$1
sudo mkdir -p /var/mail/\$user
sudo chown -hR vmail:mail /var/mail/\$user
mkhomedir_helper \$user
EOF
```

6. **Créer le premier utilisateur** : se rendre dans l’interface d’administration YunoHost (ici https://michu.nohost.me/yunohost/admin), entrer le mot de passe d’administration puis se rendre dans **Utilisateurs** > **Nouvel utilisateur**.
<div class="alert alert-info" markdown="1">
Il faudra entrer un **nom d’utilisateur** sans majuscule/espace/tiret, un **nom/prénom/pseudo** en deux parties (obligatoires, merci LDAP) qui correspondra au nom qui apparaîtra sur les futurs emails de l’utilisateur, ainsi qu'un **quota d’email** éventuel et un **mot de passe** (*à ne pas confondre avec le mot de passe d’administration dans ce cas*).
</div>

7. **Installer l’application VPN Client** : se rendre dans **Applications** > **Installer**, et entrer `https://github.com/labriqueinternet/vpnclient_ynh` dans le champs **URL** du formulaire **Installer une application personnalisée** tout en bas de la page.

8. (optionnel) **Restreindre l’accès à l’application VPN Client** : se rendre dans **Applications** > **VPN Client** > **Accès** et sélectionner l’utilisateur précédemment créé, de sorte que les futurs potentiels nouveaux utilisateurs ne puissent pas modifier les paramètres d’accès VPN.

9. **Configurer l’application VPN Client** : se connecter à l’**interface utilisateur** (ici https://michu.nohost.me/yunohost/sso/) et entrer les identifiants de l’utilisateur précédemment créé. Vous devriez voir apparaître **VPN Client** dans votre liste d’application :
<div><a title="screenshot_vpnclient" target="_blank" href="https://raw.githubusercontent.com/labriqueinternet/vpnclient_ynh/master/screenshot.png">
<img style="border-radius: 5px; border: 5px solid #eee; max-width: 800px" src="https://raw.githubusercontent.com/labriqueinternet/vpnclient_ynh/master/screenshot.png" />
</a></div>  
De manière générale, il convient bien sûr d’éditer les paramètres en fonction de son fournisseur d’accès VPN.  
Chez Neutrinet, nous éditons, dans **Advanced**, le template de configuration pour y ajouter trois directives spécifiques :  
<pre><code>resolv-retry infinite
ns-cert-type server
topology subnet</code></pre>
<div class="alert alert-warning" markdown="1">
**Attention** : le redémarrage du service, déclenché par le bouton **Save and reload**, peut mettre quelques minutes.
</div>

10. **Installer l’application Hotspot** : s'assurer que l’antenne WiFi est bien branchée, et répéter les étapes **7**, **8** et **9** en installant à l’aide de l'URL `https://github.com/labriqueinternet/hotspot_ynh`  
<div><a title="screenshot_hotspot" target="_blank" href="https://raw.githubusercontent.com/labriqueinternet/hotspot_ynh/master/screenshot.png">
<img style="border-radius: 5px; border: 5px solid #eee; max-width: 800px" src="https://raw.githubusercontent.com/labriqueinternet/hotspot_ynh/master/screenshot.png" />
</a></div>

11. **TESTEY** : la Brique devrait être accessible via l’IP publique que sa connexion VPN lui procure. Si l’utilisateur a opté pour un nom de domaine en **.nohost.me**, patienter quelques minutes que son IP se propage sur le serveur DNS de YunoHost. Si l’utilisateur a opté pour son propre nom de domaine, c’est le moment de [configurer ses enregistrements DNS](/dns_config_fr) correctement chez son registrar.  
Si tout se passe bien côté **hotspot**, un réseau WiFi du nom choisi par l’utilisateur à l’étape 10 devrait être visible, et devrait vous router tout bien vers l’Internet.  
Il est possible de regarder l’IP avec laquelle on sort sur Internet [ici](http://ip.yunohost.org) (ou via `curl ip.yunohost.org` depuis le serveur)

---

**Les problèmes proviennent majoritairement de la configuration VPN. Il convient de vérifier les paramètres côté client *et* serveur VPN en cas de pépin.**

---

# Étapes supplémentaires <small>(pour une Brique idéale)</small>

Ces étapes ne sont pas obligatoires mais peuvent améliorer considérablement l'**expérience de la Brique** (*fap fap fap*).

* **Supprimer le CRON DynDNS** : si l’utilisateur a opté pour un nom de domaine en **.nohost.me**, YunoHost a configuré automatiquement un client DynDNS sur la Brique qui va avertir le serveur DNS d’un potentiel changement d’IP publique. Or, l’IP fourni par la connexion VPN **est fixe**. Il convient donc de supprimer ce client, qui pourrait malencontreusement mettre à jour l’IP dans les DNS si la connexion VPN venait à tomber :
```bash
rm /etc/cron.d/yunohost-dyndns
```

* **S’assurer du nom de l’interface WiFi** : lors du changement d’antenne WiFi (même si le modèle reste le même), il peut arriver que le nom de l’interface WiFi change, typiquement de `wlan0` à `wlan1`. Pour continuer à utiliser l’application **hotspot**, il faut se rendre sur l’interface web de configuration de l’application (étape 10) et mettre à jour le **Device**.

* **Ajouter un CRON de restart du service VPN** : selon les paramètres VPN client et serveur, il peut arriver que la connexion soit instable, et que le client VPN tombe de temps en temps. Pour s’assurer qu’il redémarrera automatiquement, une bonne méthode *quick'n'dirty* et de tester que le service tourne et de le redémarrer dans le cas contraire :
```bash
echo "* * * * * /usr/bin/pgrep openvpn || systemctl restart ynh-vpnclient" > /etc/cron.d/restart-vpn
```

* **Ajouter un CRON de restart du service Amavisd** : il peut arriver, notamment lorsque la Brique sature en RAM, que le service Amavisd s’arrête. Même *workaround* que pour le client VPN :
```bash
echo "0,30 * * * * netstat -lntp | grep -v 10024 || systemctl restart amavis" > /etc/cron.d/restart-amavis
```

* **Mettre à jour la configuration SSH** : par défaut, la connexion en tant que **root** est possible sur la Brique. Pour ne garder que la connexion en tant qu’**admin** (qui est sudoer), il convient d’éditer le `/etc/ssh/sshd_confg` et de remplacer passer **PermitRootLogin** à **without-password**.

* **Configurer le reverse DNS** : pour s’assurer du bon fonctionnement du serveur email, il est recommandé de configurer un reverse DNS pour son IP. En tant que FAI associatif, c’est un service faisable, autant en profiter !

* **Configurer le DKIM** : avec un SPF et un PTR bien configuré dans les DNS, les emails envoyés par la Brique ne devrait pas être considérés comme spam. Ceci dit, GMail et d’autres dégraderont considérablement le spamscore si le DKIM n’est pas configuré également.  
Cette opération est longue mais à considérer pour avoir un serveur email irréprochable en production. Plus de renseignement sur [la page de documentation appropriée](/dkim_fr).  

* **Installer Roundcube** via l’interface d’administration YunoHost et tester l’envoi/réception d’email.

* **Installer d’autres applications** et les découvrir avec l’utilisateur pour l'accompagner (c'est toujours sympa \o/).

---

## Notes

* **Attention à la RAM** : sur le modèle A20-OLinuXino-LIME, les **512 Mo** partent vite. Les applications PHP ne sont pas très gourmandes, mais Searx et Etherpad Lite sont par exemple à installer avec des pincettes.

* **Glances ne fonctionne pas** sur l’image *labriqueinternet_04-06-2015_jessie.img*, ce qui rend l’onglet **État du serveur** inaccessible dans l’interface d’adminstration de YunoHost. Une mise à jour future du noyau sera à prévoir pour corriger le problème.

* Attention à bien veiller à ce que les répertoires utilisateurs soient bien créés (étape 5.) dans `/var/mail` et `/home/`, sans quoi plusieurs bugs seront observables dans l’interface d’administration (erreurs 500 en pagaille).