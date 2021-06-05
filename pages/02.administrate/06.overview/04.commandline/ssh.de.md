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

#### Connect

Assuming your IP address is `111.222.333.444`, open a terminal and enter :

```bash
ssh root@111.222.333.444
```

A password will be asked. If this is a VPS, your VPS provided should have communicated you the password. If you used a pre-installed image (for x86 computer or ARM board), the password should be `yunohost`.

! Since YunoHost 3.4, after running the postinstallation, you won't be able to login as `root` anymore. Instead, **you should login using the `admin` user !** In the event that the LDAP server is broken and the `admin` user is unusable, you may still however still be able to login using `root` from the local network.

#### Change the password!

After logging in for the first time, you should change the root password. The server might automatically ask you to do so. If not, use the command `passwd`. It is important to choose a reasonably strong password. Note that the root password will be overriden by the admin password when you perform the postinstallation.

#### Let's configure !

We're now ready to begin the [post-installation](/postinstall).

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
yunohost user ssh allow <username>
```

It is also possible to remove SSH access using the following:

```bash
yunohost user ssh disallow <username>
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


## Yunohost command line

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
