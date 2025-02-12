---
title: Migrating from 11.x to 12.x
template: docs
taxonomy:
    category: docs
routes:
  default: '/bullseye_bookworm_migration'
---

This page is dedicated to help you migrating an instance from YunoHost 11.x (running on Debian Bullseye) to YunoHost 12 (running on Debian Bookworm).

## Important notes

- The YunoHost team did its best to make sure that the migration is as smooth as possible and was tested over the course of several months in several cases.

- Please [backup your data and server](/backup)! This migration is a complex operation and covering every pitfall is quite hard. And in any case, be patient and attentive during the migration.

- Please don't rush into thinking that you should need to reinstall your system from scratch thinking it would be "simpler" (sigh). (A common attitude is to be willing to reinstall a server at the slightest complication...). Instead, if you happen to run into issues, we encourage you to try to investigate and understand what's going on and [reach for help on the chat and the forum](/help).

- **You should watch the known issues at the bottom of this page, to be sure your migrations will work properly.**

## Migration procedure

You first need to ensure your system is up to date. The migration is available starting with the version 11.3.

It is recommended to run the migration from the command line, but it can still be done from the webadmin.

### From the webadmin

Go to Tools > Migrations to access the migrations interface. You will have to read carefully and accept the disclaimer then launch the migration.

Note that even if you close the webadmin page for some reason, the migration will continue in the background (but the webadmin will be partially unavailable).

### From the command line

Just run :

```bash
sudo yunohost tools migrations run
```

then read carefully and accept the disclaimer.

## During the migration

Depending on your hardware and packages installed, the migration might take up to a few hours.

The logs will be shown in the message bar (you can hover it to see the whole history). They will also be available after the migration (like any other operations) in Tools > Logs.

### If the migration crashed / failed at some point

If the migration failed at some point, it should be possible to relaunch it. If it still doesn't work, you can try to [get help](/help) (please provide the corresponding messages or whatever makes you say that it's not working).

## What to do after the upgrade

### Check that you actually are on Debian Bookworm and YunoHost 12.x

For this, go to Diagnosis (category Base system) or look at the footer of the webadmin. In the command line, you can use `lsb_release -a` and `yunohost --version`.

### Run the new pending migrations

Some more migrations appeared after the upgrade:

* Rebuilding the virtualenvs of your Python apps
* Migrate from PostgreSQL 13 to 15

You should run those as soon as possible to ensure your apps work properly.

### Check the Diagnosis

In the webadmin Diagnosis section, make sure that no specific issue appeared after running the migration (for example a service that crashed for some reason).

### Check that your applications are working

Test that your applications are working. If they aren't, you should try to upgrade them (it is also a good idea to upgrade them even if they are working anyway).

If your app is broken and you were already with the latest version, you can rerun the upgrade thanks to the `-F|--force` option:

```bash
yunohost app upgrade --force APP_NAME
```

## Current known issues after the migration

Please check the [issues FAQ](/bookworm_migration_issues_faq).
