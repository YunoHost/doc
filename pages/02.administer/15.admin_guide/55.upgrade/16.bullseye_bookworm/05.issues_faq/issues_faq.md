---
title: Bookworm migration isues FAQ
template: docs
taxonomy:
    category: docs
routes:
  default: '/bookworm_migration_issues_faq'
---

This page lists all the known issues encountered after a migration from YunoHost 11 to 12.

If the suggested solutions don't work, please [ask for help](/help).

## Python apps

After upgrading, some python apps should be unavailable because their virtual environment (venv) needs to be rebuilt.

To do that you can run the pending migrations in `Webadmin > Update`. 

In addition, the apps below won't be automatically repaired, you need to force-upgrade them manually instead, with `yunohost app upgrade -F APP`.

Apps which won't be automatically repaired and need a force upgrade:
- __borgserver__ and all its instances (eg. `borgserver__2`, `borgserver__3`, ...)
- __borg__ (https://apps.yunohost.org/app/borg) : rebuilt using `yunohost app upgrade -F borg` (otherwise, will sent emails notifying that "The backup miserably failed to backup", with error `ModuleNotFoundError: No module named 'borg'`)

TODO: list those apps

FIXME:??!!! If needed, you can disable the automatic rebuild for a specific python app, by removing the dedicated file ending with `.requirements_backup_for_bullseye_upgrade.txt` before applying the migration. You can find this file near the venv (Python virtual environment) of your app inside `/var/www`.

## Error 500 everywhere

The web server, nginx, might need a restart before being fully operational. Please run this command:

```
sudo systemctl restart nginx
```

## Mailman3 failed in diagnostics

A manual change in a configuration file is needed for Mailman3 to work : https://github.com/YunoHost-Apps/mailman3_ynh/issues/48#issuecomment-2536194377

<!-- ### Can't run the migration due to `libc6-dev : Breaks: libgcc-8-dev issue`

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

After that you should be able to restore your apps. Don't forget to force upgrade them if you have 502 errors. -->
