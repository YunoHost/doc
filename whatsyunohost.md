#What is YunoHost ?

YunoHost is a **server operating system** aiming to make self-hosting accessible to everyone. It is based on Debian GNU/Linux and is fully compatible with it.

<img src="https://yunohost.org/images/debian-logo.png" width=100>

---

### Software

Basically YunoHost **automatically installs** and configures some services around LDAP, and **provides tools** to administrate them.

It can thus be considered as a distribution, including the following software:

<img src="https://yunohost.org/images/nginx.png"><img src="https://yunohost.org/images/postfix.png"><img src="https://yunohost.org/images/dovecot.png"><img src="https://yunohost.org/images/spamassassin.png"><img src="https://yunohost.org/images/XMPP_logo.png" width=80>

* [Nginx](http://nginx.org/): a web server
* [Postfix](http://www.postfix.org/): an SMTP e-mail server
* [Dovecot](http://www.dovecot.org/): an IMAP and a POP3 e-mail server
* [Amavis](http://amavis.org/): an antispam
* [Metronome](http://www.lightwitch.org/metronome): an XMPP server
* [OpenLDAP](http://www.openldap.org/)
* [Bind](https://www.isc.org/downloads/bind/): a DNS server
* [SSOwat](https://github.com/Kloadut/SSOwat): a Single Sign On (SSO) web authentication system
* [Tahoe-LAFS](https://tahoe-lafs.org/trac/tahoe-lafs): a backup system (not yet functional)

---

### App system

Additionally, YunoHost comes with an "app" system which is, in other words, **a community repository** of validated helper scripts to install further services or web applications.

The most interesting thing about this system is that **web applications benefits from the LDAP** through the SSO (Single Sign On), which authenticate server's users in every installed apps at the same time.

You may be interessed in reading the [packaging documentation](/packaging_apps) and the [SSOwat GitHub page](https://github.com/Kloadut/SSOwat) to go further.

<img src="https://yunohost.org/images/roundcube.png"><img src="https://yunohost.org/images/ttrss.png"><img src="https://yunohost.org/images/wordpress.png"><img src="https://yunohost.org/images/transmission.png"><img src="https://yunohost.org/images/jappix.png">

---

### Origin

YunoHost was created in February 2012 after something like this:

 <blockquote><p>"Shit, I'm too lazy to reconfigure my mail server... Beudbeud, how were you able to get your little server running with LDAP?"</p>
<small>Kload, February 2012</small></blockquote>

All that was needed was an administration interface for Beudbeud's server to make something usable, so Kload decided to develop one. Finally, after automating several configurations and packaging in some web apps, YunoHost v1 was finished.

Noting the growing enthusiasm around YunoHost and around self-hosting in general, the original developers along with new contributors decided to start work on version 2, more extensible, more powerful, more easy-to-use, and one that makes a nice cup of fair-trade coffee for the elves of Lapland.

---

### Goal

YunoHost's goal is to make installing and administering a server accessible to as many people as possible, without taking away from the quality and reliability of the software.

Everything is done with the goal of simplifying deployment on as many different kinds of hardware as possible, and in any condition (at home, on a dedicated server or on a VPS). 

---

### Name

**YunoHost** comes from the jargon "Y U NO Host". The [Internet meme](https://en.wikipedia.org/wiki/Internet_meme) should illustrate it:
<div class="text-center"><img style="border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.15);" src="https://yunohost.org/images/dude_yunohost.jpg"></div>

---

### Development

YunoHost is developed to be as **simple** and minimally-intrusive as possible, to retain compatibility with Debian. It merely proposes a package of automatic configurations for existing software, and is configurable via simple interfaces.

YunoHost is **entirely** a free software project. The philosophy of self-hosting is, to us, incompatible with any other model of software development.

Do not hesitate to visit the ["contribute" page](/contribute).

---

### Security

All the efforts have been made to keep YunoHost secure, and **communications encrypted**. You can read more about this subject on the related page :

[https://yunohost.org/security](/security)

---

### What YunoHost is not ?

Even if YunoHost can handle multiple domains and multiple users, it is **not meant to be a mutualized system**.

Firstable, the software is too young, not tested and thus probably not optimized to be put in production for hundreds of users at one time. And with that said, we do not want to lead the software in that direction. Virtualization democratizes, and its usage is recommended since it is a more leaktight way to achieve mutualization than a "full-stack" system like YunoHost.

You can host your friends, your family and your company safely and with ease, but you have to **trust your users**, and they have to trust you above all. If you do want to provide YunoHost services for unknown persons anyway, a full VPS per user will be just fine.


