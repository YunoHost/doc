#Roadmap

---

## v2.4
Core:
* Add tools in moulinette to manage certificate (add, remove, update) *(ljf, Moul)*
* Run automatic tests on moulinette *(kload)*
* Use templates to (re)generate configurations instead of packages *(beudbeud, jerome)*
* Add proper upgrade/remove scripts and comment Debian scripts in packages *(beudbeud)*
* Complete and improve backup and restore system *(jerome)*

Web interface:
* User avatar *(opi)*
* Plugin system for the admin panel *(ljf)*

---

## v2.2 <small><small>12 may 2015</small></small>

Core:
* ✔ Migrate YunoHost to Debian Jessie
* ✔ Update Metronome to v3.6 and make a more Debian-friendly package *(jerome)*
* ✔ Update Nginx to v1.6.2
* ✔ Add Dnsmasq next to Bind9 *(kload)*
* ✔ Add email quota *(beudbeud, jerome)*
* ✔ Implement a simple backup and restore system *(jerome, kload)*
* ✔ Add logging to the moulinette for each action *(jerome)*
* ✔ Review the app manifest format and integrate it *(app maintainers, jerome, opi)*

Web interface:
* ✔ Install unofficial apps from the admin panel *(opi)*
* ✔ Add firewall in admin panel *(opi)*
* ✔ Warn admin about security updates in the admin panel *(opi)*
* ✔ Fix websocket issue for Raspberry Pi *(jerome, kload)*

Apps:
* ✔ 21 official apps and 88 unofficial apps *(app maintainers)*
* ✔ Migrate to Baikal and deprecate Radicale *(ju)*
* ✔ Add Shell in a box and remove GateOne from official apps *(kload)*
* ✔ OpenVPN configuration page and access control *(kload)*
* ✔ Add a download files button on Transmission interface *(opi)*

Installs:
* ✔ Create an image for La Brique Internet on Olimex *(kload)*
* ✔ Create an image for Raspberry Pi 1 and 2 *(matlink)*
* ✔ Create an image for Cubieboard 2 *(Moul)*
* ✔ Update Docker image *(kload)*

Others:
* ✔ Install and switch to a new build system on a new server *(beudbeud)*
* ✔ Improve documentation, to make YunoHost more accessible *(Moul)*

---

## v2.0 <small><small>12 june 2014</small></small>
* ✔ Add sexiness and a menu to YunoHost.org frontpage *(kload)*
* ✔ **DOCUMENTATIONNNNNNN** *(everyone <3)*

---

## v2.0 RC

* ✔ Email forward configuration *(kload, beudbeud)*
* ✔ Make pending official apps *(Ju)*
* ✔ SFTP *(kload)*
* ✔ Fix DNS zone *(kload)*
* ✔ SSOwat stuffs (presistent rules, public root website) *(ezpen)*
* ✔ Email configuration tests *(beudbeud)*
* ✔ Test and upgrade official apps like Owncloud, Roundcube and Radicale *(app maintainers)*
* ✔ Upgrade function + view *(beudbeud, opi)*
* ✔ uPnP rework *(kload, titoko)*
* ✔ Add warning in a sample backup view *(opi)*
* ✔ User interface design *(Courgette, opi)*
* ✔ Moulinette/API refactoring *(jerome)*
* ✔ Security check and complete patterns
* ✔ Internationalization I18n *(opi, jerome)*
* ✔ Lack of hairpinning hack *(kload)*