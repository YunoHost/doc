---
title: Adding documentation to your app
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_app_doc'
---

Properly documenting your app is important for user experience ;). YunoHost provides several mechanism to display information to users.

## Extensive description : `doc/DESCRIPTION.md` and `doc/screenshots/`

You are encouraged to add a `doc/DESCRIPTION.md` which should contain a more extensive description than the short description contained in `manifest.toml`. This usually corresponds to listing the key features of the app.

You are also encouraged to add a `.png` or `.jpg` screenshot of what the app looks like in `doc/screenshots/`. There is no constrain on the exact filename, but the file weight should be kept below 512kb.

This description and screenshot will be shown when the admin open the catalog page for this app and the app info page in the webadmin after the admin installs this app.

You can also add translated versions of the `.md` file in, for example, `doc/DESCRIPTION_fr.md`, `_es.md`, `_it.md`, etc.

If your app repository is part of the YunoHost-Apps org, the provided description will be used to auto-regenerate the README.md of your github repo via `yunohost-bot`.

## Specific notes for admins : `doc/ADMIN.md`, `doc/<whatever>.md`

Sometimes, you may want to ship YunoHost-specific notes regarding the administration of this app. For example, integrating OnlyOffice inside Nextcloud.

You can do so by adding a `doc/ADMIN.md` file or even a `doc/<whatever>.md` page for each specific topic - and similarly add `_<lang>` suffix for translations.

Note that you can even use the `__FOOBAR__` syntax which will automatically be replaced with the `foobar` setting.

These notes will be available in the app info page in the webadmin after the app installation.

## Pre/post-install notes, pre/post-upgrade notes

Sometimes, you may want to display important information to the admin at key points in the app's life cycle. You can do so by providing special markdown files:
- `doc/PRE_INSTALL.md`: displayed right before the installation (for example to warn that « This app install is expected to take around 30 minutes, be patient! » or « This app will automatically add 1GB swap to your system »)
    - NB: try to not overlap with the anti-feature tags from the catalog (cf Publishing your app in the catalog) which can be used to warn that the app's upstream is alpha-stage or deprecated among other things.
- `doc/POST_INSTALL.md`: displayed in a popup after the installation AND a dismissable note in the webadmin app info view.
- `doc/PRE_UPGRADE.md`: displayed right before any upgrade of this app (NB: the pre-upgrade note from the NEW version will be used, not the one from the installed version)
    - You can also create `doc/PRE_UPGRADE.d/{version}.md` to have a note displayed before upgrading to a version equal or higher than `{version}`
- `doc/POST_UPGRADE.md`: displayed in a popup after the upgrade AND a dismissable note in the webadmin app info view.

Same as `ADMIN.md` and others: in these files, you can use the `__FOOBAR__` syntax which will automatically be replaced with the `foobar` setting.
