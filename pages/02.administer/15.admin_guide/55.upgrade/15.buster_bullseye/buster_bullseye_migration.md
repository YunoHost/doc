---
title: Migrating from 4.x to 11.x
template: docs
taxonomy:
    category: docs
routes:
  default: '/buster_bullseye_migration'
---

This page is dedicated to help you migrating an instance from YunoHost 4.4.x (running on Debian Buster/10.x) to YunoHost 11.x (running on Debian Bullseye/11.x). Note: we decided to skip the version numbers from 5 to 10 to follow the Debian version numbers.

## Important notes

- The YunoHost team did its best to make sure that the migration is as smooth as possible and was tested over the course of several months in several cases.

- With that said, please be aware that this is a delicate operation. System administration is a complicated topic and covering every particular case is quite hard. Therefore, if you host critical data and services, please [make backups](/backup). And in any case, be patient and attentive during the migration.

- Please don't rush into thinking that you should need to reinstall your system from scratch thinking it would be "simpler" (sigh). (A common attitude is to be willing to reinstall a server at the slightest complication...). Instead, if you happen to run into issues, we encourage you to try to investigate and understand what's going on and [reach for help on the chat and the forum](/help).

- **You should watch the known issues at the bottom of this page, to be sure your migrations will work properly.**

## Migration procedure

### From the webadmin

After upgrading to 4.4.x, go to Tools > Migrations to access the migrations interface. You will have to read carefully and accept the disclaimer then launch the migration.

### From the command line

After upgrading to 4.4.x, run:

```bash
sudo yunohost tools migrations run
```

then read carefully and accept the disclaimer.

## During the migration

Depending on your hardware and packages installed, the migration might take up to a few hours.

The logs will be shown in the message bar (you can hover it to see the whole history). They will also be available after the migration (like any other operations) in Tools > Logs.

Note that even if you close the webadmin page for some reason, the migration will continue in the background (but the webadmin will be partially unavailable).

### If the migration crashed / failed at some point

If the migration failed at some point, it should be possible to relaunch it. If it still doesn't work, you can try to [get help](/help) (please provide the corresponding messages or whatever makes you say that it's not working).

## What to do after the upgrade

### Check that you actually are on Debian Bullseye and YunoHost 11.x

For this, go to Diagnosis (category Base system) or look at the footer of the webadmin. In the command line, you can use `lsb_release -a` and `yunohost --version`.

### Run the migration to repair your python app

After upgrading, your python apps should be unavailable because their virtual environment (venv) needs to be rebuilt.

To do that you can run the pending migrations in `Webadmin > Update`. The apps below won't be automatically repaired, you need to force-upgrade them manually instead with `yunohost app upgrade -F APP`.

Apps which won't be automatically repaired and need a force upgrade:

- calibreweb
- django-for-runners
- ffsync (this app is in python2 and no longer maintained, no guarantee)
- jupiterlab
- librephotos
- mautrix
- mediadrop
- mopidy
- pgadmin
- tracim
- synapse
- weblate

!!! If needed, you can disable the automatic rebuild for a specific python app, by removing the dedicated file ending with `.requirements_backup_for_bullseye_upgrade.txt` before applying the migration. You can find this file near the venv (Python virtual environment) of your app inside `/opt` or `/var/www`.

### Check that no issue appeared in the diagnosis

Also in the webadmin Diagnosis section, make sure that no specific issue appeared after running the migration (for example a service that crashed for some reason).

If the service `php7.3-fpm` appears to be dead, you should upgrade your PHP apps like the custom web app. Next, you can run `apt autoremove`.

### Check that your applications are working

Test that your applications are working. If they aren't, you should try to upgrade them (it is also a good idea to upgrade them even if they are working anyway).

If your app is broken and you were already with the latest version, you can rerun the upgrade thanks to the `-F|--force` option:

```bash
yunohost app upgrade --force APP_NAME
```

## Current known issues after the migration

### Can't run the migration due to `libc6-dev : Breaks: libgcc-8-dev issue`

Note: This issue should be resolved in `yunohost_version`: `4.4.2.13`
You have an app that depends on the `build-essential` package.

See this [solution](https://forum.yunohost.org/t/migration-to-11-wont-start-libc6-dev-breaks-libgcc-8-dev/20617/42) to fix it manually

### DNSmasq is not running anymore

We haven't yet found  solution for this issue.

### No ethernet connexion after rebooting following a migration on a Raspberry Pi 4

! If you have not yet rebooted your server, don't do it (we are looking for a solution). This will avoid you the use of a keyboard and screen.

We found this in the Raspberry Pi documentation

> when the dhcpcd5 package is updated to the latest version (1:8.1.2-1+rpt1 -> 1:8.1.2-1+rpt2), the Raspberry Pi will fail to obtain a DHCP IP address following the next reboot or startup. This problem can be avoided by disabling and re-enabling the "System Options -> Network at Boot" option using the latest raspi-config after the dhcpcd5 package has been updated and prior to the system being shutdown or rebooted

If you are using a Raspberry Pi 4 (or maybe 3), see this [solution](https://forum.yunohost.org/t/aucun-acces-a-internet-suite-a-migration-4-4-to-11-depuis-raspberry-pi-4-pi-400/20652/17)

### Restore ynh4 backup onto a fresh ynh11

If you can't restore your app but your system has been restored, you probably should use the regen conf to fix the nginx issues:

```bash
yunohost tools regenconf nginx --force
```

After that you should be able to restore your apps. Don't forget to force upgrade them if you have 502 errors.
