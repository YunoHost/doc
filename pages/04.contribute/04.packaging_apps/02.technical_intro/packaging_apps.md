---
title: App packaging
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps'
---

![](image://yunohost_package.png?resize=100)

The purpose of this document is to teach you how to package an application for YunoHost.

! This page is outdated and should be reworked

### Requirements
To package an application, here are the requirements:
* An account on a Git server (e.g. [GitHub](https://github.com/)) to publish the application;
* Basic knowledge of [Git](/packaging_apps_git), bash shell and other programming stuff;
* A testing [virtual machine or a distant server](/install) or [VirtualBox](/packaging_apps_virtualbox), to package and test the package. Alternatively you can also use [ynh-dev](https://github.com/yunohost/ynh-dev), it is meant for the core but can totally be used for developping apps, but be aware that for now the documentation on this part is lacking.

### Content
A YunoHost package is composed of:

* A `manifest.json` file
* A `scripts` directory, which contains five Shell scripts: `install`, `remove`, `upgrade`, `backup` and `restore`
* Optional directories, containing `sources` or `conf` files
* A `LICENSE` file containing the license of the package
* A presentation page of your package in a `README.md` file

[div class="btn btn-lg btn-default"] [ A basic package](https://github.com/YunoHost/example_ynh) [/div]
feel free to use it as a framework.

## Manifest
[div class="btn btn-lg btn-default"] [Manifest](/packaging_apps_manifest) [/div]

## Scripts
[div class="btn btn-lg btn-default"] [Scripts](/packaging_apps_scripts) [/div]

### Architecture and arguments
Since YunoHost has a unified architecture, you will be able to guess most of the settings you need. But if you need variable ones, like the domain or web path, you will have to ask the administrator at installation (see `arguments` section in the manifest above).

[div class="btn btn-lg btn-default"] [Arguments management](/packaging_apps_arguments_management) [/div]

### NGINX configuration
[div class="btn btn-lg btn-default"] [NGINX configuration](/packaging_apps_nginx_conf) [/div]

### Multi-instance
[div class="btn btn-lg btn-default"] [Multi-instance](/packaging_apps_multiinstance) [/div]

### Hooks
YunoHost provides a hook system, which is accessible via the packager's script callbacks in command line.
The scripts have to be placed in the `hooks` repository at the root of the YunoHost package, and must be named `priority-hook_name`, for example: `hooks/50-post_user_create` will be executed after each user creation.

**Note**: `priority` is optional, default is `50`.

Take a look at the [Nextcloud package](https://github.com/YunoHost-Apps/nextcloud_ynh/) for a working example.

### Helpers
[div class="btn btn-lg btn-default"] [Helpers](/packaging_apps_helpers) [/div]

### Test it!
In order to test your package, you can execute your script standalone as `admin` (do not forget to append required arguments):
```bash
su - admin -c "/bin/bash /path/to/my/script my_arg1 my_arg2"
```

Or you can use [command line](/commandline):
```bash
yunohost app install /path/to/my/app/package
```
Note that it also works with a Git URL:
```bash
yunohost app install https://github.com/author/my_app_package.git
```

### Packaging best practices
Here is a list of best practices for application install scripts:
* scripts should use `sudo cp -a ../sources/. $final_path` instead of `sudo cp -a ../sources/* $final_path`;
* install script must contain support in case of script errors to delete residuals files thanks to `set -e` and [trap](/packaging_apps_trap);
* install script should use the command-line method instead of calls to curl through web install form;
* install script should save install answers;
* application sources should be checked with a control sum (sha256, sha1 or md5) or a PGP signature;
* scripts should be tested on Debian Buster 32 bits, 64 bits and ARM architectures;
* backup and restore scripts should be present and functional.

To be define the quality of a package, it'll obtained a [level](/packaging_apps_levels), determined according to somes criteria of installation and according to respect to [package guidelines](/packaging_apps_guidelines).

### Package script checker
[div class="btn btn-lg btn-default"] [Package checker](https://github.com/YunoHost/package_checker) [/div]

This Python script checks:
* that the package is up to date wich last specifications
* that all files are present
* that the manifest doesn't have syntax errors
* that scripts exit well before modifing the system during verification.

### Continuous integration

A continuous integration server is available for packagers who want to test their apps.  
[div class="btn btn-lg btn-default"] [Continuous integration](packaging_apps_ci) [/div]

### Publish and ask for testing your application

* Publishing a [post on the Forum](https://forum.yunohost.org/) in the [`Discuss > Apps` category](https://forum.yunohost.org/c/discuss/discuss-apps/), to ask for testing and feedback on your application.

* If your application is released under a free software license, you may ask the YunoHost app team to integrate your application to the [app repository](https://github.com/YunoHost/apps) (c.f. also the [app list](/apps)). You can add your application even if it is not stable or working yet : the current state can be specified to `notworking`, `inprogress`, or `working`.

* If your application is *not* free software, then in the future, a non-official list might be created to handle them but is non-existent yet.

### Officalization of an application

**!! This section is obsolete as of 08/03/19** - The project's organization regarging this point is to be changed.

To become an official application, it must be tested well enough, be stable and should work on Debian Buster 64 bits, 32 bits and ARM architectures. If you think those conditions are met, ask for [official integration](https://github.com/YunoHost/apps) of your application.
