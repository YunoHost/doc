#Local network access to your server

After completing your server installation, it is most likely that your domain will not be accessible through the local network. This is a know issue known as [hairpinning](http://en.wikipedia.org/wiki/Hairpinning).

To resolve this issue, you need to configure your router dns or, failing, your hosts files on your clients workstation

### Get the server local IP adress
In order to configure DNS or hosts file, you must know the private IP adress of your server. This adress is only working in the server local network and is not linked to your public IP adress.

You may retrieve your server private IP adress  through different means:
- Using the Yunohost connection screen on the server:
<img src="/images/ynh_login.png" width=600>

- Using Yunohost administration panel:
    Go to "State of the server" > Network
<img src="/images/ynh_admin_etat_ip.png" width=900>

- Or using your router or internet box, depending on model.

## Configure DNS of Internet box or router

The goal here is to create a network wide redirection handled by your router. The idea is to create a DNS redirection to your server's IP. You should access your router's configuration and look for DNS configuration, then add a redirection to your server's IP (e.g. redirect "yunohost.local" to 192.168.1.21).

### SFR Box
If you haven't found your server private IP, you may find it using the SFR box admin panel:  
    Go to Network tab > General
<img src="/images/ip_serveur.png" width=800>

#### Configure SFR box's DNS
Go to Network tab > DNS and add your domain name to the box's DNS.
<img src="/images/dns_9box.png" width=800>

## Configure [hosts](https://en.wikipedia.org/wiki/Host_%28Unix%29) file on client workstation
Modifying hosts file should be done only if you cannot alter your box's DNS or router, because hosts file will only impact the workstation where the file was modified.

- Windows hosts file is located at:
    `%SystemRoot%\system32\drivers\etc\`
    > You MUST activate hidden and system file display to see the hosts file.
- UNIX systems (GNU/Linux, Mac OS) hosts file is located at:
    `/etc/hosts`
    > You MUST have root privileges to modify the file.

Add a line at the end of the file containing your server private IP followed by a space and your domain name

```bash
192.168.1.62	domain.tld
```
