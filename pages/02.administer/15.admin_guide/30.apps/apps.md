---
title: Applications
template: docs
taxonomy:
    category: docs
page-toc:
  active: true
routes:
  default: '/apps_overview'
---

One of the key feature of YunoHost is the ability to easily install applications which are then immediately usable. Example of applications include a blog system, a "cloud" (to host and sync files), a website, an RSS reader...

Applications can be installed and managed through the webadmin interface in `[fa=cubes /] Applications` or through commands of the `yunohost app` category.

[center]
![Apps list](image://apps_list.png?resize=512&classes=caption "Apps list in the webadmin, with its Install button.")
[/center]

The application catalog and its categories can be browsed directly from the webadmin by clicking on the `[fa=plus /] Install` button in the apps list, or from this documentation.

<center><a href="/apps" style="background: orange; border-color: orange;" class="btn btn-lg btn-error"><i class="fa fa-cubes"></i> Applications catalog</a></center>

! Be careful and stay reasonable on the number of installed applications. Each additional installation increases the attack surface and the risk of failure. Ideally, if you want to test, do it with another instance for example in [a virtual machine](/install/hardware:virtualbox).

## Installing an app

Let's say you want to install a *Custom Webapp*. Before actually running the installation steps, YunoHost will usually have you fill in a form to properly set it up for you.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the webadmin"]

![Custom Webapp install form](image://app_install_form.png?resize=512&classes=caption "Pre-installation form of the Custom Webapp")

[/ui-tab]
[ui-tab title="From the command line"]

![Custom Webapp install form in CLI](image://app_install_form_cli.png?resize=512&classes=caption "Pre-installation form of the Custom Webapp in CLI")

[/ui-tab]
[/ui-tabs]

### Subpaths vs. individual domains per apps

Among specific questions, forms usually ask you to choose a domain and a path onto which the app will be accessible.

In the context of YunoHost, it is quite common to have a single (or a few) domains on which several apps are installed in "subpaths", so that you end up with something like this:

```text
yolo.com
     ├── /blog  : Wordpress (a blog)
     ├── /cloud : Nextcloud (a cloud service)
     ├── /rss   : TinyTiny RSS (a RSS reader)
     ├── /wiki  : DokuWiki (a wiki)
```

Alternatively, you may choose to install each (or some) apps on a dedicated domain. Beyond the aesthetic, using sub-domains instead of sub-paths allows the possibility to move a service to another server more easily. Also, some applications may need an entire domain dedicated to them, for technical reasons. The disadvantage is that you have to add a new domain each time, and therefore potentially configure additional DNS records, restart the diagnostics and install a new Let's Encrypt certificate.

This might look prettier for end users, but is generally considered more complicated and less efficient in the context of YunoHost, since you need to add a new domain each time. Nevertheless, some apps might need an entire domain dedicated to them, for technical reasons.

If all apps from the previous example were installed on a separate domain, this would give something like this:

```text
blog.yolo.com  : Wordpress (a blog)
cloud.yolo.com : Nextcloud (a cloud service)
rss.yolo.com   : TinyTiny RSS (a RSS reader)
wiki.yolo.com  : DokuWiki (a wiki)
```

!!! Many applications integrate a feature that allows you to change the URL of your application. This choice between subpath and subdomain can be reversed in some cases via a simple manipulation in the administration interface.

### User access management and public apps

The installation form usually asks whether or not the app should be publically accessible. If you choose to not make it public, only users logged in YunoHost will be able to reach it.

!!!! After installation, this can be configured via the webadmin in the [Groups and permissions panel](/groups_and_permissions), or similarly via the command-line subcategory `yunohost user permission`.

### Instructions after installation

Some applications need to give you instructions, URLs or credentials once they are installed. So remember to check the email of the first user account or the admin user selected before installation, if it was prompted.

### Multi-instance applications

Some applications support the ability to be installed several times (at different locations) ! To do so, just go another time in `Applications > [fa=plus /] Install`, and select again the application to install.

## LDAP / SSO integration

Applications that allow users to register may support integration with the LDAP / Single Sign On of YunoHost, so that users who connect to the user portal can be automatically logged in all these apps.

However, some applications do not support this as it can be either not implemented in the upstream, or the package does not work on this part yet. This information is usually available on the README of the application package.

## Application configuration

After installation, some settings handled by YunoHost can be tweaked, such as user and group permissions, application's tile and label in the SSO page, or its access URL.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the webadmin"]

You can access the app's operations page by clicking its name in the applications list.

![Application operations page](image://app_config_operations.png?resize=768&classes=caption "Application operations page in the webadmin")

You can also delete the application from this page.

[/ui-tab]
[ui-tab title="From the command line"]

From the command line, you can change:

- the app's label in the SSO: `yunohost app change-label <app> <new_label>`
- the app's url: `yunohost app change-url app [-d <DOMAIN>] [-p <PATH>]`

You can also delete the app: `yunohost app remove <app>`

`<app>` is to be replaced with the app's ID. If this is the first instance of the app, like Nextcloud, the ID is `nextcloud`. If this is the second, then it's `nextcloud__2` and so on. To list all your apps and check their ID, you can run `yunohost app info`.

[/ui-tab]
[/ui-tabs]

### Configuration panels

Some apps include a *configuration panel*, which features actions and settings specific for each app that they usually do not handle themselves. They can also spare you the need for altering configuration files by hand.

!!!! Configuration panels are *not* meant to tweak every aspects of the apps. You will surely use their own administration panels more often than YunoHost's configuration panels.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the webadmin"]

The configuration panels are accessible in the webadmin in their operations page, trough the `[fa=cogs /] Config panel` button.

![My Webapp configuration panel](image://app_config_panel.png?resize=768&classes=caption "Configuration panel for My Webapp")

[/ui-tab]
[ui-tab title="From the command line"]

From the command line, you can list the configuration panel settings with the following command: `yunohost app config get <app>`

```bash
$ yunohost app config get my_webapp
main.php_fpm_config.phpversion:
  ask: PHP version
  value: none
main.sftp.password:
  ask: Set a password for the SFTP access
  value: **************
main.sftp.with_sftp:
  ask: Do you need a SFTP access?
  value: yes
```

To change a setting, either use `yunohost app config set <app>` to get prompted about all the settings, or use `yunohost app config set <app> <key> -v <new_value>` to alter a specific one.

The `<key>` is the setting name, for example `main.sftp.with_sftp` from above.

[/ui-tab]
[/ui-tabs]

## Execute commands within the app

Starting YunoHost v11.1.21.4, if you need to execute commands with the app's binary, or PHP commands, etc., you can execute the command `yunohost app shell <app>`.
It will:

- open a new Bash shell as the app's system user
- open the app's working directory (e.g. `/var/www/<app>`)
- preload the environment with variables taken from the app's service, if it exists
- override `php`, so that it points to the PHP version used by the app

## Applications packaging

Applications must be packaged manually by application packagers/maintainers. Apps can be integrated with YunoHost to support upgrades, backup/restore and LDAP/SSO integration among other things.

If you want to learn or contribute to app packaging, please check the [contributor documentation](/contributordoc).

### Integration and quality levels

Automated tests are being run regularly to test the integration and quality of all apps who were declared to be `working` by packagers. The result is a level between 0 and 8, whose meaning is detailed on [this page](/packaging_apps_levels). Some tests results may also be available [on this dashboard](https://dash.yunohost.org/appci/branch/stable).

By default, only applications of sufficient quality are offered. When the quality of an application drops and until the problem is reolved, the app is hidden from the catalog to prevent its installation and its upgrades are put on hold.
