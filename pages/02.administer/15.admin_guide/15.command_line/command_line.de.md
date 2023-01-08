---
title: SSH
template: docs
taxonomy:
    category: docs
routes:
  default: '/ssh'
  aliases:
    - '/commandline'
page-toc:
  active: true
---

## Was ist SSH?

**SSH** steht für **S**ecure **Sh**ell, und bezeichnet ein Protokoll, dass es einem erlaubt über ein entferntes System auf die Kommandozeile (Command Line Interface, **CLI**) zuzugreifen. SSH ist standardmäßig auf jedem Terminal auf GNU/Linux oder macOS verfügbar. Für Windows ist Drittsoftware nötig, z.B. [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (Klicke nach dem Start auf Session und dann SSH).

## Während der YunoHost Installation

#### Finde deine IP

Solltest du auf einem VPS installieren, dann hat der VPS Provider die IP-Adresse, die du bei ihm erfragen solltest. 

Wenn du Zuhause installierst (z.B. auf einem Raspberry Pi oder OLinuXino), dann musst du herausfinden, welche IP-Adresse dein Router dem System zugewiesen hat. Hierfür existieren mehrere Wege:
- Öffne ein Terminal und tippe `sudo arp-scan --local` ein, um eine Liste der aktiven IP-Adressen deines lokalen Netzwerks anzuzeigen;
- wenn dir der arp-scan eine zu unübersichtliche Zahl an Adressen anzeigt, versuche mit `nmap -p 22 192.168.**x**.0/24` nur die anzuzeigen, deren SSH-Port 22 offen ist. (passe das **x** deinem Netzwerk an);
- Prüfe die angezeigten Geräte in der Benutzeroberfläche deines Routers, ob du das Gerät findest;
- Schließe einen Bildschirm und Tastatur an deinen Server, logge dich ein und tippe `hostname --all-ip-address`.

#### Verbinden

Angenommen deine IP Addresse ist `111.222.333.444`, öffne einen Terminal und gib Folgendes ein:

```bash
ssh root@111.222.333.444
```

Es wird nach einem Passwort gefragt. Handelt es sich um einen VPS, sollte der VPS Provider dir das Passwort kommuniziert haben. Wenn du ein pre-installed image benutzt (für x86 Computer oder ARM boards), sollte das Passwort `yunohost` sein.

! Seit YunoHost 3.4 kann man sich nach dem Ausführen der Postinstallation nicht mehr als `root` anmelden. **Stattdessen sollte man sich mit dem `admin` Benutzer anmelden!** Für den Fall, dass der LDAP-Server defekt und der `admin` Benutzer nicht verwendbar ist, kann man sich eventuell trotzdem noch mit `root` über das lokale Netzwerk anmelden.

#### Ändere das Passwort!

Nach dem allerersten Login sollte man das root Passwort ändern. Der Server könnte dazu automatisch auffordern. Falls nicht, ist der Befehl `passwd` zu benutzen. Es ist wichtig, ein einigermaßen starkes Passwort zu wählen. Beachte, dass das root Passwort durch das admin Passwort überschrieben wird, wenn man die Postinstallation durchführt.

#### Auf ans Konfigurieren!

Wir sind nun bereit, mit der [Postinstallation](/postinstall) zu beginnen.

## After installing YunoHost

If you installed your server at home and are attempting to connect from outside your local network, make sure port 22 is correctly forwarded to your server. (Reminder : since YunoHost 3.4 you should connect using the `admin` user !)

If you only know the IP address of your server :

```bash
ssh admin@111.222.333.444
```

Then, you need to enter your administrator password created at [post-installation step](/postinstall).

If you configured your DNS (or tweaked your `/etc/hosts`), you can simply use your domain name :

```bash
ssh admin@your.domain.tld
```

If you changed the SSH port, you need to add `-p <portnumber>` to the command, e.g. :

```bash
ssh -p 2244 admin@your.domain.tld
```

!!! If you are connected as `admin` and would like to become `root` for more comfort (e.g. to avoid typing `sudo` in front of every command), you can become `root` using the command `sudo su`.

## Which users?

By default, only the `admin` user can log in to YunoHost SSH server.

YunoHost's users created via the administration interface are managed by the LDAP directory. By default, they can't connect via SSH for security reasons. If you want some users to have SSH access enabled, use the command:

```bash
yunohost user permission add ssh.main <username>
```

It is also possible to remove SSH access using the following:

```bash
yunohost user permission remove ssh.main <username>
```

Finally, it is possible to add, delete and list SSH keys, to improve SSH access security, using the commands:

```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```

## Security and SSH

N.B. : `fail2ban` will ban your IP for 10 mimutes if you perform 5 failed login attempts. If you need to unban the IP, have a look at the page about [Fail2Ban](/fail2ban)

A more extensive discussion about security & SSH can be found on the [dedicated page](/security).


## YunoHost command line

!!! Providing a full tutorial about the command line is quite beyond the scope of the YunoHost documentation : for this, consider reading a dedicated tutorial such as [this one](https://ryanstutorials.net/linuxtutorial/) or [this one](http://linuxcommand.org/). But be reassured that you don't need to be a CLI expert to start using it !

The `yunohost` command can be used to administer your server and perform the various actions similarly to what you do on the webadmin. The command must be launched either from the `root` user or from the `admin` user by preceeding them with `sudo`. (ProTip™ : you can become `root` with the command `sudo su` as `admin`).

YunoHost commands usually have this kind of structure : 

```bash
yunohost app install wordpress --label Webmail
          ^    ^        ^             ^
          |    |        |             |
    category  action  argument      options
```

Don't hesitate to browse and ask for more information about a given category or action using the the `--help` option. For instance, those commands : 

```bash
yunohost --help
yunohost user --help
yunohost user create --help
```

will successively list all the categories available, then the actions available in the `user` category, then the usage of the action `user create`. You might notice that the YunoHost command tree is built with a structure similar to the YunoHost admin pages.
