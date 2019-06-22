# Post-Installation

The step called "**post-installation**" is actually the initial configuration of YunoHost. It has to be done just after the installation of the system itself.

### From the web interface

You can perform the post-installation with the web interface by entering in your browser :
* **the local IP address of your server** if it is on your local network (e.g. at home !). The address typically looks like `192.168.x.y` (see 'Find your IP' on [the page about SSH](/ssh))
* **the public IP address of your server** if your server is not on your local network. Typically, if you own a VPS, your VPS provider should have given you the IP of the server.

During the first visit, you will very likely encounter a security warning related to the certificate used by the server. For now, your server uses a self-signed certificate. You will later be able to add a certificate automatically recognized by web browsers as described in the [certificate documentation](/certificate). For now, you should add a security exception to accept the current certificate.

You should then land on this page :

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_web.png">

<em><p class="text-muted">Preview of the Web post-installation</p></em>

### From the command line

You can also perform the postinstallation with the command `yunohost tools postinstall` directly on the server, or [via SSH](/ssh).

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_cli.png">

<em><p class="text-muted">Preview of the command-line post-installation</p></em>

<br>

## Informations asked

### Main domain

This is the first domain name linked to your YunoHost server, but also the one which will be used by your server's users to access the **authentication portal**. It will thus be **visible by everyone**, choose it wisely.

* If you do not have a domain name, or if you want to use the YunoHost's DynDNS service, choose a sub-domain of **.nohost.me**, **.noho.st** or **.ynh.fr** (e.g. `homersimpson.nohost.me`). Provided that it's not already taken, the domain will be configured automatically and you won't need any further configuration step.

* If you do know what **DNS** is, you probably want to configure your own domain name here. In this case, please refer to the [DNS page](/dns) page for more informations.

* If you don't own a domain name and don't want a **.nohost.me**, **.noho.st** or **.ynh.fr**, you can use a local domain. The idea is to configure your router to redirect a local domain name to your server. For example you could create the yunohost.local domain redirecting to your server in your router, and now every device on the network will be redirected to your server when accessing yunohost.local. More information on how to setup a local domain can be found [here](dns_local_network).

### Administration password

This password will be used to access to your server's [administration interface](/admin). You would also use it to connect via **SSH** or **SFTP**. In general terms, this is your **system's key**, [choose it carefully](http://www.wikihow.com/Choose-a-Secure-Password).

<br>

---

## Congratz!

If you got so far and saw 'YunoHost has been successfully installed' (web
postinstall) or 'YunoHost has been correctly configured', then congratulations!

### What now ?

- If you're self-hosting at home and without a VPN, you need to [make sure to
  correctly forward ports on your router/Internet box](isp_box_config) ;
- If you're using your own domain name (i.e. not a .nohost.me / .noho.st), you
  need to [configure it according to the recommended DNS
  configuration](dns_config) ;
- If you cannot configure your domain name yet (because you didn't register it
  yet, or because this is a test domain), see last paragraph
  [here](dns_local_network) for a workaround ;
- Don't be too afraid of the [certificate warning](certificate), you'll probably
  be able to install a Let's Encrypt certificate :).
- Have a look at [the available apps](apps) !

