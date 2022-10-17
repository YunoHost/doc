---
title: Riottenere l'accesso a YunoHost
template: docs
taxonomy:
    category: docs
routes:
  default: '/noaccess'
---

Ci possono essere diverse ragioni che possono portare al blocco parziale o totale degli accessi a amministratore ad un server YunoHost. Spesso però se un metodo di accesso è bloccato altri sono possibili.

Questa pagina cercherà di trovare il problema, riottenere l'accesso ed eventualmente riparare il vostro sistema. Le cause più comuni sono all'inizio per cui siete invitati a seguire questo tutorial dall'inizio.

## Hai l'accesso al server usando l'indirizzo IP locale ma non dal nome di dominio.

#### Se il server è self-hosted a casa: controlla il port forwarding

Controlla di riuscire ad accedere al server usando l'IP pubblico (lo puoi trovare su [https://ip.yunohost.org](https://ip.yunohost.org)). Se questo non funziona:
   - Assicurati di aver [impostato il forwarding](/isp_box_config).
   - Alcuni ISP non supportano l'*hairpinning*, cosa che ti impedirà di raggiungere il tuo server dal nome di dominio dalla rete locale. Nel caso puoi usare una connessione cellulare o modificare il file `hosts` del tuo computer in modo da associare il nome di dominio all'indirizzo IP locale invece che a quello pubblico.
   
#### Configura i record DNS

! Questo non è un problema se stai usando un dominio fornito da `nohost.me`, `noho.st` or `ynh.fr`

Devi configurare i tuoi [record DNS](/dns_config) (come minimo i record `A` e `AAAA` se usi una connessione IPv6).

Puoi verificare la correttezza dei record DNS confrontando i risultati dati da [questo servizio](https://www.whatsmydns.net/) con l'[IP restituito dal nostro servizio](https://ip.yunohost.org).

#### Altre probabili cause

- Il tuo dominio `noho.st`, `nohost.me` o `ynh.fr` non è raggiungibile a causa di un problema nell'infrastruttura di YunoHost. Controlla il [forum](https://forum.yunohost.org/) per annunci o post di persone relativi allo stesso problema.
- Il tuo nome di dominio potrebbe essere scaduto. Controlla la pagina del registrar usato per la registrazione oppure usa il comando `whois yourdomain.tld`.
- Stai usando un indirizzo IP dinamico. In questo caso è necessario impostare uno script o usare un client appositi per aggiornare con regolarità questo indirizzo. Leggi la pagina [DNS with a dynamic IP](/dns_dynamicip) per vedere come. Puoi usare anche un dominio `nohost.me`, `noho.st` o `ynh.fr` che comprende queste opzioni.

## Stai ricevendo un errore sul certificato che non ti permette di raggiungere la pagina di amministrazione

- Un errore sul certificato può essere visualizzato nel caso in cui hai scritto male l'indirizzo nella barra del browser.

- Sei hai appena installato il tuo server o un nuovo dominio stai usando un certificato auto-firmato. In questo caso è possibile e comprensibile aggiungere una eccezione di sicurezza *temporanea* in modo che sia possibile [installare un certificato Let's Encrypt](/certificate), ammesso che tu abbian una connessione Internet sicura.

## Puoi accedere via SSH ma non dalla pagina di amministrazione o l'inverso

#### Stai provando a loggarti via SSH come `root` invece che con l'utente `admin`

Di default è possibile loggarsi via SSH solo come `admin`. È possibile loggarsi come `root` *solo dall'interno della rete locale del server*. Se il server è su una VPS la console web o VNC fornita dal provider DPS dovrebbe funzionare.

Se stai provando ad avviare i comandi `yunohost` dalla riga di comando come `admin` è necessario avviarlo preceduto dal comando `sudo` (ad esempio `sudo yunohost user list`). È possibile diventare `root` anche con il comando `sudo su`.

#### Sei stato bannato temporaneamente

Il tuo server YunoHost include il servizio Fail2Ban che banna automaticamente gli indirizzi IP che falliscono più volte di seguito. In alcuni casi possono essere programmi configurati con password vecchie (ad esempio client Nextcloud) oppure un utente che ha il tuo stesso IP.

Se sei stato bannato provando ad accedere ad una pagina web sarà irraggiungibile solo questa e potrai collegarti al tuo server via SSH. Viceversa se sei stato bannati da SSH la pagina di amministrazione funzionerà.

Se sei stato bannato sia da SSH che dalla pagina di amministrazione puoi provare a raggiungere il tuo server attraverso un altro indirizzo IP. Ad esempio puoi provare a collegarti usando la connessione cellulare del tuo telefono, attraverso una VPN, Tor o un altro proxy.

Vedi anche: [togliere il ban ad un indirizzo](/fail2ban)

!!!! I ban normalmente durano dai 0 ai 12 minuti e solo su IPv4.

#### Il server web NGINX non funziona

Può essere che il server web NGINX non stia funzionando.

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
