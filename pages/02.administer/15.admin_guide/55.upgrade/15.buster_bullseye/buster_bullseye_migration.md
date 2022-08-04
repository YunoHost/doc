---
title: Migrating an existing instance to Bullseye
template: docs
taxonomy:
    category: docs
routes:
  default: '/buster_bullseye_migration'
---

This page is dedicated to help you migrating an instance from YunoHost 4.4.x (running on Debian Buster/10.x) to YunoHost 11.x (running on Debian Bullseye/11.x).

## Important notes

- The YunoHost team did its best to make sure that the migration is as smooth as possible and was tested over the course of several months in several cases.

- With that said, please be aware that this is a delicate operation. System administration is a complicated topic and covering every particular cases is quite hard. Therefore, if you host critical data and services, please [make backups](/backup). And in any case, be patient and attentive during the migration.

- Please don't rush into thinking that you should need to reinstall your system from scratch thinking it would be "simpler" (sigh). (A common attitude is to be willing to reinstall a server at the slightest complication...) Instead, if you happen to run into issues, we encourage you to try to investigate and understand what's going on and [reach for help on the chat and the forum](/help).

## Migration procedure

#### From the webadmin

After upgrading to 4.4.x, go to Tools > Migrations to access the migrations interface. You will have to read carefully and accept the disclaimer then launch the migration. 

#### From the command line

After upgrading to 4.4.x, run : 

```bash
sudo yunohost tools migrations migrate
```

then read carefully and accept the disclaimer.

## During the migration

Depending on your hardware and packages installed, the migration might take up to a few hours. 

The logs will be shown in the message bar (you can hover it to see the whole history). They will also be available after the migration (like any other operations) in Tools > Logs.

Note that even if you close the webadmin page for some reason, the migration will continue in the background (but the webadmin will be partially unavailable).

#### If the migration crashed / failed at some point.

If the migration failed at some point, it should be possible to relaunch it. If it still doesn't work, you can try to [get help](/help) (please provide the corresponding messages or whatever makes you tell that it's not working).

## What to do after the upgrade

#### Check that you actually are on Debian Bullseye and YunoHost 11.x

For this, go in Diagnosis (category Base system) or look at the footer of the webadmin. In the command line, you can use `lsb_release -a` and `yunohost --version`.

#### Check that no issue appeared in the diagnosis

Also in the Diagnosis in the webadmin, make sure that no specific issue appeared after running the migration (for example a service that crashed for some reason).

#### Check that your applications are working

Test that your applications are working. If they aren't, you should try to upgrade them (it is also a good idea to upgrade them even if they are working anyway).

If your app is broken and you were already with the last version, you can rerun the upgrade thanks to the `-f` option:
```
yunohost app upgrade -f APP_NAME
```

!!! We know that the following applications need to be updated by force: my_webapp, jupiterlab, weblate. Contrary to previous major updates, most python3 applications like borg or django should not need an update to work again.

## Current known (minor) issues after the migration

