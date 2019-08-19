# SSH

## What's SSH?

**SSH** stands for Secure Shell, and refers to a protocol that allows to remotly control a machine using the command line interface (CLI). It is available by default in any terminal on Linux and Mac OS / OSX. On Windows, you may want to use [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (after launching it, click on Session then SSH).

## During YunoHost installation

#### Find your IP

If you are installing on a VPS, then your VPS provider should have gave you your IP address. 

If you are installing at home (e.g. on a Raspberry Pi or OLinuXino), then you need to find out which IP has been attributed to your board after you plugged it to your internet box / router. Several ways exists to find your server's IP :

- open a terminal and use `sudo arp-scan --local` to list the IP on your local network ;
- if the arp-scan command displays a confusing number of devices, you can check which ones are open to ssh with `nmap -p 22 192.168.1.0/24` to sort them out (adapt the IP range to your local network)
- use your internet box / router interface to list the machines connected, or check the logs ;
- plug a screen on your server, log in and type `hostname --all-ip-address`.

#### Connect

Assuming your IP address is `111.222.333.444`, open a terminal and enter :

```bash
ssh root@111.222.333.444
```

A password will be asked. If this is a VPS, your VPS provided should have communicated you the password. If you used a pre-installed image (for x86 computer or ARM board), the password should be `yunohost`.

<div class="alert alert-warning">
Since YunoHost 3.4, after running the postinstallation, you won't be able to login as `root` anymore. Instead, **you should login using the `admin` user !** In the event that the LDAP server is broken and the `admin` user is unusable, you may still however still be able to login using `root` from the local network.
</div>

#### Change the password!

After logging in for the first time, you should change the root password. The server might automatically ask you to do so. If not, use the command `passwd`. It is important to choose a reasonably strong password. Note that the root password will be overriden by the admin password when you perform the postinstallation.

#### Let's configure !

We're now ready to begin the [post-installation](postinstall).

## After installing YunoHost

If you installed your server at home and are attempting to connect from outside your local network, make sure port 22 is correctly forwarded to your server. (Reminder : since YunoHost 3.4 you should connect using the `admin` user !)

If you only know the IP address of your server :

```bash
ssh admin@111.222.333.444
```

Then, you need to enter your administrator password created at [post-installation step](postinstall).

If you configured your DNS (or tweaked your `/etc/hosts`), you can simply use your domain name :

```bash
ssh admin@your.domain.tld
```

If you changed the SSH port, you need to add `-p <portnumber>` to the command, e.g. :

```bash
ssh -p 2244 admin@your.domain.tld
```

<div class="alert alert-info">
If you are connected as `admin` and would like to become `root` for more comfort (e.g. to avoid typing `sudo` in front of every command), you can become `root` using the command `sudo su`.
</div>

## Which users?

By default, only the `admin` user can log in to YunoHost ssh server.

YunoHost's users created via the administration interface are managed by the LDAP directory. By default, they can't connect via SSH for security reasons. If you want some users to have SSH access enabled, use the command:

```bash
yunohost user ssh allow <username>
```

It is also possible to remove ssh access using the following:

```bash
yunohost user ssh disallow <username>
```

Finally, it is possible to add, delete and list ssh keys, to improve ssh access security, using the commands:

```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```

## Security and SSH

N.B. : `fail2ban` will ban your IP for 10 mimutes if you perform 5 failed login attempts. If you need to unban the IP, have a look at the page about [fail2ban](/fail2ban)

A more extensive discussion about security & SSH can be found on the [dedicated page](security_en).
