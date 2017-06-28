# Post-Installation

The step called "**post-installation**" is actually the initial configuration of YunoHost. It has to be done just after the installation of the system itself.

## Access

You can access it graphically by entering your **server's local IP** address in a **web browser** (e.g. `http://192.168.1.7`).

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_web.png">

<em><p class="text-muted">Preview of the Web post-installation</p></em>

<br>

Or by running `yunohost tools postinstall` in command-line.

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_cli.png">

<em><p class="text-muted">Preview of the command-line post-installation</p></em>

<br>

---

### Main domain

This is the first domain name linked to your YunoHost server, but also the one which will be used by your server's users to access the **authentication portal**. It will thus be **visible by everyone**, choose it wisely.

* If you do not have a domain name, or if you want to use the YunoHost's DynDNS service, choose a sub-domain of **.nohost.me** or **.noho.st** (i.e. `homersimpson.nohost.me`). The domain will be configured automatically and you won't need any further configuration step.

* If you do know what **DNS** is, you probably want to configure your own domain name here. In this case, please refer to the [DNS page](/dns) page for more informations.

* If you don't own a domain name and don't want a **.nohost.me** or **.noho.st**, you can use a local domain. The idea is to configure your router to redirect a local domain name to your server. For example you could create the yunohost.local domain redirecting to your server in your router, and now every device on the network will be redirected to your server when accessing yunohost.local. More information on how to setup a local domain can be found [here](dns_local_network).

### Administration password

This password will be used to access to your server's [administration interface](/admin). You would also use it to connect via **SSH** or **SFTP**. In general terms, this is your **system's key**, [choose it carefully](http://www.wikihow.com/Choose-a-Secure-Password).

<br>

---

## Troubleshooting

### Secured connection fails after **post-installation**

If you're using your own domain and depending on your browser, you might be stuck out of your Yunohost installation until you deploy an appropriate certificate. Thanks to Yunohost and [Let's Encrypt](https://letsencrypt.org/), this proves to be quite easy: just run `yunohost domain cert-install` in command-line to issue and install your certificate and _Voilà_. Refresh your browser and you're good to go.

---

## And after ?

Once the post-installation finished, check if you can access to your server with your web-browser. If it is not the case, a few more configuration steps may be required.

Do not hesitate to come on our [support chatroom](/support) if you need help.
