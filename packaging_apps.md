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
YunoHost provides a hook system, which is accessible via the packager's script callbacks in moulinette (CLI).
The scripts have to be placed in the `hooks` repository at the root of the YunoHost package, and must be named `priority-hook_name`, for example: `hooks/50-post_user_create` will be executed after each user creation.

**Note**: `priority` is optional, default is `50`.

Take a look at the [ownCloud package](https://github.com/Kloadut/owncloud_ynh) for a working example.

### Helpers
<a class="btn btn-lg btn-default" href="packaging_apps_helpers_en">Helpers</a>

### Test it!
In order to test your package, you can execute your script standalone as `admin` (do not forget to append required arguments):
```bash
su - admin -c "/bin/bash /path/to/my/script my_arg1 my_arg2"
```

Or you can use [moulinette](/moulinette_en):
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
* scripts should be tested on Debian Jessie as well as 32 bits, 64 bits and ARM architectures;
* backup and restore scripts should be present and functional.

To be define the quality of a package, it'll obtained a [level](packaging_apps_levels_fr), determined according to somes criteria of installation and according to respect to [package guidelines](packaging_apps_guidelines_fr).

### Package script checker
<a class="btn btn-lg btn-default" href="https://github.com/YunoHost/package_checker">Package checker</a>

This Python script checks:
* that the package is up to date wich last specifications
* that all files are present
* that the manifest doesn't have syntax errors
* that scripts exit well before modifing the system during verification.

### Publish and ask for testing your application
* Publishing a [post on the Forum](https://forum.yunohost.org/) with the [`App integration` category](https://forum.yunohost.org/c/app-integration), to ask for testing and feedback on your application.

* Ask your application to be added to the [app repository](https://github.com/YunoHost/apps) to be displayed in the [non-official apps list](apps_en). Specify its progress state: `notworking`, `inprogress`, or `working`.

- Subscribe to the [Apps mailing list](https://list.yunohost.org/cgi-bin/mailman/listinfo/apps) to be informed about packaging evolution.

### Officalization of an application
To become an official application, it must be tested well enough, be stable and should work on 64 bits, 32 bits et ARM processor architectures, and on Debian Jessie. If you think those conditions are met, ask for [official integration](https://github.com/YunoHost/apps) of your application.
