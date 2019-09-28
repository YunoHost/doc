# App packaging <img src="/images/yunohost_package.png" width=100/>

The purpose of this document is to teach you how to package an application for YunoHost.

### Requirements
To package an application, here are the requirements:
* An account on a git server (e.g. [GitHub](https://github.com/)) to publish the application;
* Basic knowledge of `git`, bash shell and other programming stuff;
* A testing [virtual machine or a distant server](/install_en), or a development environement, [ynh-dev](https://github.com/yunohost/ynh-dev) or [VirtualBox](/packaging_apps_virtualbox_fr), to package and test the package.

### Content
A YunoHost package is composed of:

* A `manifest.json` file
* A `scripts` directory, which contains five Shell scripts: `install`, `remove`, `upgrade`, `backup` and `restore`
* Optional directories, containing `sources` or `conf` files
* A `LICENSE` file containing the license of the package
* A presentation page of your package in a `README.md` file

<a class="btn btn-lg btn-default" href="https://github.com/YunoHost/example_ynh"> A basic package</a>
feel free to use it as a framework.

## Manifest
<a class="btn btn-lg btn-default" href="packaging_apps_manifest_en">Manifest</a>

## Scripts
<a class="btn btn-lg btn-default" href="packaging_apps_scripts_en">Scripts</a>

### Architecture and arguments
Since YunoHost has a unified architecture, you will be able to guess most of the settings you need. But if you need variable ones, like the domain or web path, you will have to ask the administrator at installation (see `arguments` section in the manifest above).

<a class="btn btn-lg btn-default" href="packaging_apps_arguments_management_en">Arguments management</a>

### Nginx configuration
<a class="btn btn-lg btn-default" href="packaging_apps_nginx_conf_en">Nginx configuration</a>

### Multi-instance
<a class="btn btn-lg btn-default" href="packaging_apps_multiinstance_en">Multi-instance</a>

### Hooks
YunoHost provides a hook system, which is accessible via the packager's script callbacks in command line.
The scripts have to be placed in the `hooks` repository at the root of the YunoHost package, and must be named `priority-hook_name`, for example: `hooks/50-post_user_create` will be executed after each user creation.

**Note**: `priority` is optional, default is `50`.

Take a look at the [Nextcloud package](https://github.com/YunoHost-Apps/nextcloud_ynh/) for a working example.

### Helpers
<a class="btn btn-lg btn-default" href="packaging_apps_helpers_en">Helpers</a>

### Registering a log file

In a lot of case, you might want to register a log file created by your app, to make it available in the webadmin. To register a log, you can create a reference file `/var/log/yunohost/categories/app/APPNAME.yml`.

You can specify a start date by starting the file name with the date formatted as `YYYYMMDD-HHMMSS`.

Example of yml metadata log file:
```bash
log_path: /path/to/your/log/file.log
```

If you want display some context info, you can add:
```bash
extra:
  env:
    args1: value1
    args2: value2
    args3: value3
```

You can attach the log to an app, domain, service or user like this :
```bash
related_to:
    - ['app', 'APPNAME']
    - ['service', 'SERVICE1']
    - ['service', 'SERVICE2']
    - ['domain', 'DOMAIN.TLD']
```

This will be used to filter logs and display all log related to an entity like a user, a domain, an app or a service.

### Test it!
In order to test your package, you can execute your script standalone as `admin` (do not forget to append required arguments):
```bash
su - admin -c "/bin/bash /path/to/my/script my_arg1 my_arg2"
```

Or you can use [command line](/commandline_en):
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
* install script must contain support in case of script errors to delete residuals files thanks to `set -e` and [trap](packaging_apps_trap_fr);
* install script should use the command-line method instead of calls to curl through web install form;
* install script should save install answers;
* application sources should be checked with a control sum (sha256, sha1 or md5) or a PGP signature;
* scripts should be tested on Debian Stretch 32 bits, 64 bits and ARM architectures;
* backup and restore scripts should be present and functional.

To be define the quality of a package, it'll obtained a [level](packaging_apps_levels_fr), determined according to somes criteria of installation and according to respect to [package guidelines](packaging_apps_guidelines).

### Package script checker
<a class="btn btn-lg btn-default" href="https://github.com/YunoHost/package_checker">Package checker</a>

This Python script checks:
* that the package is up to date wich last specifications
* that all files are present
* that the manifest doesn't have syntax errors
* that scripts exit well before modifing the system during verification.

### Continuous integration

A continuous integration server is available for packagers who want to test their apps.  
<a class="btn btn-lg btn-default" href="packaging_apps_ci">Continuous integration</a>

### Publish and ask for testing your application

* Publishing a [post on the Forum](https://forum.yunohost.org/) with the [`App integration` category](https://forum.yunohost.org/c/app-integration), to ask for testing and feedback on your application.

* If your application is released under a free software license, you may ask the YunoHost app team to integrate your application to the [app repository](https://github.com/YunoHost/apps) (c.f. also the [app list](apps_en)). You can add your application even if it is not stable or working yet : the current state can be specified to `notworking`, `inprogress`, or `working`.

* If your application is *not* free software, then in the future, a non-official list might be created to handle them but is non-existent yet.

### Officalization of an application

**!! This section is obsolete as of 08/03/19** - The project's organization regarging this point is to be changed.

To become an official application, it must be tested well enough, be stable and should work on Debian Stretch 64 bits, 32 bits and ARM architectures. If you think those conditions are met, ask for [official integration](https://github.com/YunoHost/apps) of your application.
