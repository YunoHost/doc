# Post-Installation

The step called "**post-installation**" is actually the initial configuration of YunoHost. It has to be done just after the installation of the system itself.

## Access

You can access it graphically by entering your **server's local IP** address in a **web browser** (e.g. `http://192.168.1.7`).

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_web.png">

<em><p class="text-muted">Preview of the Web post-installation</p></em>

<br>

Or by running `yunohost tools postinstall` in command-line.

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_cli2.png">

<em><p class="text-muted">Preview of the command-line post-installation</p></em>

<br>

---

### Main domain

This is the first domain name linked to your YunoHost server, but also the one which will be used by your server's users to access the **authentication portal**. It will thus be **visible by everyone**, choose it wisely.

* If you do not have a domain name, or if you want to use the YunoHost's DynDNS service, choose a sub-domain of **.nohost.me** or **.noho.st** (i.e. `homersimpson.nohost.me`). The domain will be configured automatically and you won't need any further configuration step.

* If you do know what **DNS** is, you probably want to configure your own domain name here. In this case, please refer to the [yunohost.org/dns](/dns) page for more informations.

### Administration password

This password will be used to access to your server's [administration interface](/admin). You would also use it to connect via **SSH** or **SFTP**. In general terms, this is your **system's key**, [choose it carefully](http://www.wikihow.com/Choose-a-Secure-Password).

<br>

---

## And after ?

Once the post-installation finished, check if you can access to your server with your web-browser. If it is not the case, a few more configuration steps may be required.

Do not hesitate to come on our [support chatroom](/support) if you need help.