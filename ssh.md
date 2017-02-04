# SSH

## What's SSH?

**SSH** stands for Secure Shell, and refers to a protocol that allows to remotly control a machine using the command line interface (CLI). It is available by default on Linux and Mac OS / OSX. On Windows, unfortunately you might need to use the [PuTTy](http://www.fastcomet.com/tutorials/getting-started/putty) software.

## During YunoHost installation

#### Find your IP

If you are installing on a VPS, then your VPS provider should have gave you your IP address. 

If you are installing at home (e.g. on a Raspberry Pi or OLinuXino), then you need to find out which IP has been attributed to your board after you plugged it to your internet box / router. Several ways exists to find your server's IP :

- open a terminal and use `sudo arp-scan --local` to list the IP on your local network ;
- use your internet box / router interface to list the machines connected, or check the logs ;
- plug a screen on your server, log in and type `ifconfig`.

#### Connect

Assuming your IP address is `111.222.333.444`, open a terminal and enter :

```bash
ssh root@111.222.333.444
```

A password will be asked. If this is a VPS, your VPS provided should have communicated you the password. On a fresh Raspberry Pi, the password should be `yunohost`. For an OLinuXino, this should be `olinux`.

#### Change the password!

After logging in for the first time, you should change the root password. The server might automatically ask you to do so. If not, use the command `passwd`. It is important to choose a reasonably strong password.

## After installing YunoHost

If you installed your server at home and are attempting to connect from outside your local network, make sure port 22 is correctly forwarded to your server.

If you only know the IP of your server :

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

## Which users?

By default, only the admin and root users can log in to YunoHost ssh server.

YunoHost's users created via the administration interface are managed by the LDAP directory. By default, they can't connect via SSH for security reasons. See [here](https://forum.yunohost.org/t/ssh-disconnects-after-successful-login/256/10) if you absolutely want some users to have SSH access enabled.

## Security and SSH

See the dedicated page [Security & SSH](security_en)
