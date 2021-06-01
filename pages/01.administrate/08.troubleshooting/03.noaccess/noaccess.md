---
title: Get access back into YunoHost
template: docs
taxonomy:
    category: docs
routes:
  default: '/noaccess'
---

There are several reasons that could lead to one administrator's access being partially or completely blocked off their YunoHost server. In numerous cases, one of the access methods is blocked, but others are not.

This page will help you diagnose the issue, get back access, and if needed repair your system. Most common causes are listed first, so follow the tutorial from top to bottom.

## You have access to the server with its local IP address, but not its domain name.

#### If you are self-hosted at home: fix ports forwarding

Check that you are getting access to the server by using its public IP (you can find at [https://ip.yunohost.org](https://ip.yunohost.org). If this does not work:
   - Make sure you have [set up forwarding](/isp_box_config)
   - Some ISP routers do not support *hairpinning*, which prevents you from reaching your server by its domain name from within your local network. If so, you can use a cellular connection, or tweak your `hosts` file on your computer to make it bind your domain name to the local IP address instead of the public one.

#### Configure DNS records

! This is not a problem if you are using a domain from `nohost.me`, `noho.st` or `ynh.fr`)

You have to configure your [DNS records](/dns_config) (at least `A` records, and `AAAA` if you have an IPv6 connection). 

You can check that the DNS records are correct by comparing the results given by [this service](https://www.whatsmydns.net/) with the [IP given by our service](https://ip.yunohost.org).

#### Other probable causes

- You domain `noho.st`, `nohost.me`, or `ynh.fr` is unreachable following a failure on YunoHost's infrastructure. Check the [forum](https://forum.yunohost.org/) for announcements or people posting about the same issue.
- Your domain name may be expired. Check that on your registrar's client panel, or by using the command `whois yourdomain.tld`.
- You have a dynamic IP address. In that case, you need to set up a script or a client that takes care of regularly update it. Refer to the page on [DNS with a dynamic IP](/dns_dynamicip) to see how. You can also use a domain `nohost.me`, `noho.st` or `ynh.fr` that includes this features.

## You are getting a certificate error that prevents you from reaching the webadmin

- A certificate error may be displayed if you have made a typo in the address bar of your browser.

- If you have just installed your server, or just installed a new domain, it uses a self-signed certificate. In that case, it is possible and understandable to add a *temporary* security exception so that you can [install a Let's Encrypt certificate](/certificate), provided you have a secure Internet connection.

## You have access via SSH but not via the webadmin, or inversely

#### You are trying to log in with SSH as `root` instead of `admin` user.

By default, SSH connection has to be made as `admin`. It possible to log into the server as `root` *only from the local network of the server*. If your server is a VPS, the web console or VNC provided by VPS providers may work.

If you are running `yunohost` commands in the CLI as `admin`, you have to call them with `sudo` before (for example `sudo yunohost user list`). You can also become `root` by running `sudo su`.

#### You have been temporarily banned

Your YunoHost server includes a service, Fail2ban, which automatically bans IPs that fail several times in a row to log in. In some cases it can be software (e.g. Nextcloud client) that are confifured with an old password, or a user who has the same IP as you have.

If you have been banned while trying to access a web page, and only web pages are unreachable, you may have access to your server via SSH. Similarly, if you have been banned from SSH, webadmin access may work.

If you have been banned from both SSH and webadmin, you can try to reach your server through another IP address. For example through the cellular network of your phone, a VPN, Tor, or another proxy.

See also : [unban an IP on Fail2Ban](/fail2ban)

!!!! Ban are usually 10 to 12-minute-long, and on IPv4 only.

#### NGINX web server is broken

Maybe the NGINX web server is out of order. You can check that [trough SSH](/ssh) with the command `yunohost service status ssh`. If it is failinf, check that its configuration is correct by running `nginx -t`. If it is indeed broken, it may be due to the installation or removal of a low-quality app... If you need support, [ask for it](/help).

The NGINX or SSH servers may have been killed due to a lack of storage space, RAM, or swap.

- Try restarting the service with `systemctl restart nginx`.
- You can check used storage with `df -h`. If one of your partitions is full, you need to identify what fills it and make rooù. You can use `ncdu` command (install it with `apt install ncdu` to browse from the root directory: `ncdu /`
- You can check RAM and swap usage with `free -h`. Depending on the result, it may be necessary to optimize your server to use less RAM (removal of heavy or unused apps...), add more RAM or add a swap file.

#### Your server is reachable by IPv6, but not IPv4, or inversely

You can check that by `ping`ing it:

```bash
ping -4 yourdomain.tld # or its IPv4
ping -6 yourdomain.tld # or its IPv6
```

If one of the two is working, use it to connect by SSH or the webadmin.

If none are working, you need to resolv your connection issue. In some cases, an update of your router may have enabled IPv6 and DNS configuration may be disrupted.

## Webadmin is working, but some web apps are returning 502 errors.

It is highly probable that the underlying service for these apps is failing (e.g. PHP apps requiring `php7.0-fpm` or `php7.3-fpm`). You can then try to restart the services, and/or ask for [help](/help)

## You have lost your admin password, or the password is seemingly wrong

If you can reach the webadmin login page (force reload with `CTRL + F5` to be sure), and you cannot log in, your password is probably wrong.

If yoy are sure of your passord, it may be due to the `slapd` service failing. If that's the case, log into the server by SSH as `root`.
- If your server is at home, you most likely have access to the local network. From this network, you can follow the [SSH instructions](/ssh)`.
- If your server is a VPS, your provider may offer a web console.

Once logged in, you have to check the state of the service with `yunohost service status slapd` and/or reset your admin password with `yunohost tools adminpw`.

If this is still failing, on a VPS you may be able to reboot in rescue mode. Do not hesitate to ask for [help](/help)

!!! To be completed.

## Your VPN expired or does not connect any more

If you have a VPN with fixed IP, maybe it has expired, or the provider's infrastructure is failing.

In that case, contact your VPN provider to renew it and update the parameters of the VPN Client app.

Meanwhile, try reaching your server if it is at home, by:
- its local IP, retrievable from your router configuration panel or `sudo arp-scan --local`
- reaching it at `yunohost.local`, if it is at home and that you have only one YunoHost server in your network.

!!! To be completed.

## Your server does not boot

In some cases your server may be stuck at boot. It may come from a new, buggy, kernel. Try changing to another kernel on the boot screen (via VNC for VPS).

If you are in "rescue" mode with `grub`, it may be due a misconfiguration of `grub`, or a corrupted drive.

In that case, access the storage drive from another system (your provider's "rescue" mode, live USB drive, read the SD or drive on another computer) and try to check partitions integrity with `smartctl`, `fsck`, and `mount`.

If disks are corrupted or hard to miunt, you have to save your data and maybe reformat, reinstall, and/or change the drive. If you succeed in mounting the drive, you can use `systemd-nspawn` to access its database.

Otherwise, run `grub-update`, `grub-install` again with `chroot` or with `systemd-nspawn`.

## VNC or screen access does not work

It may be due hardware issue on your server, or with the hypervisor if it is on a VPS.

If you are renting your server, contact the support of your provider. Otherwise, try fixing your machine by replacing failing components.
