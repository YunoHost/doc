---
title: Introduction to packaging
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_intro'
  aliases:
    - '/packaging_apps'
---

This documentation is here to provide all the basic concepts and vocabulary needed to understand app packaging.

We will detail what a YunoHost application package is, how it works, how to make your own package and how to find help if you need it.


## 1. Packaging philosophy

The ability to easily install applications from a catalog is a key feature of YunoHost. While you dive in the process of YunoHost application packaging, you should remember these key principles:

- **The admin should not have a PhD in computer science to be able to install, configure and use your application**: try to assume that the admin doesn't know about advanced computer concepts;

- **Less is more**, **Keep it simple!**: don't overcrowd the admin with a dozens technical questions;

- **Things should work out of the box**: for example, the admin should not have to manually finish the installation process by manually filling in database credentials;

- YunoHost app packaging is **not just about installing** sources and dependencies: it's also about maintenance (upgrade, backup...) and integrating the app in the YunoHost ecosystem (NGINX, SSO/LDAP, Fail2Ban, application catalog, UI/UX...)


## 2. Prerequisites

Before diving in, this documentation assumes that:

1. You already are a YunoHost admin yourself and already know what the install workflow looks like;)
2. You are somewhat familiar with (or are willing to learn) system administration and bash programming;
3. You are somewhat familiar with (or are willing to learn) Git;
4. You are comfortable with tinkering and debugging computer stuff in general.

You are also encouraged to join the [app packaging chatroom](/chat_rooms) to ask any question you may have!

At some point, you will also want to have a dev/test environment, either using [VirtualBox](/packaging_apps_virtualbox) or [LXC/ynh-dev](https://github.com/yunohost/ynh-dev) which is meant for the core but can totally be used for developping apps. You can also setup a dev/test VPS on your favourite hosting provider, or even develop on your prod if you like to live dangerously;).

## 3. Notes about the history of YunoHost's app packaging

Many things in YunoHost, and YunoHost app packaging format, are historical or were designed in an organic fashion. Thus some aspects may legitimately feel old.

The **"v0" of app packaging** consisted in writing raw bash scripts with no real standardization/constrain.

Over time, recurrent steps (such as installing dependencies with apt, or setting up the NGINX config) where formalized into standardized bash functions, aka "helpers". This pretty much marked **the beginning of the "v1" packaging era**.

Various tools were implemented to test the app and standardize their behavior.

After a while, a set of common practices and conventions emerged and is somewhat reflected and maintain in the `example_ynh` template application. While it is tempting for dev-oriented folks to change variable naming schemes or refactorize the structure of scripts, it turns out that it is even more important to stick to the common set of practices (even though arbitrary and not elegant) to ease the maintenance of all apps by any member of the packaging community accross all repos!

Nevertheless, even though helpers existed, the inherent structure of apps was hard and boring to maintain with too many redundant pieces of code or filled with funky historical conventions. **A new v2 format** [has been designed and added to YunoHost 11.1 in early 2023](https://github.com/YunoHost/yunohost/pull/1289) in the hope to modernize and simplify app packaging and improve the UI/UX of YunoHost.

However, [**a future v3 format** has yet to come](https://github.com/YunoHost/issues/issues/2136) to further simplify app packaging (such as taking care of NGINX/systemd/... configurations, removing the need to manually write remove/backup/restore scripts, etc.)


## 4. General overview of a YunoHost app structure

A YunoHost app consists in a Git repository. We encourage you to have a look at those code repository to get familiar witch app repository structures:
- [the `helloworld_ynh` app](https://github.com/YunoHost-Apps/helloworld_ynh)
- [the `example_ynh` app](https://github.com/YunoHost/example_ynh) which illustrates all common features and recommended formatting
- your favourite "real-life" app in the [YunoHost-Apps organization](https://github.com/orgs/YunoHost-Apps/repositories)

Among the file contained in a package, the most important ones are: 

- the **app manifest** `manifest.toml` <small>(or `.json` in the past)</small>
    - this can be seen as the ID card of the application, containing various metadatas. 
    - it also contains the questions asked during the installation of the app.
    - and a bunch of "resources" to initialize, such as sources to download or apt dependencies to install
- **scripts/** contains a bunch of bash scripts corresponding to actions exposed in YunoHost
   - `_common.sh`: common variables or custom functions included in other scripts
   - `install`/`remove`: the install and remove procedure
   - `upgrade`: the upgrade procedure
   - `backup`/`restore`: the backup/restore procedures 
   - (`change_url`): changing where the app is installed in terms of web access url
- **conf/** contains a bunch of configuration templates used when installing the app. Here are some example of commonly found files:
   - `nginx.conf`: the NGINX (=web server) configuration template for this app
   - `systemd.service`: the systemd service configuration template for this app
   - `config.json/yaml/???`: the app's configuration template

Roughly speaking, the install itself generally consists of the following operations (though these may vary depending on the complexity and technologies used by the app) - not necessarily in that exact order:

1. YunoHost fetches the package's Git repository
2. YunoHost asks to the admin the install questions defined in `manifest.toml`
3. The admin fills the form and starts the install
4. YunoHost provisions a bunch of technical prerequisites (called 'resources') such as:
    - initializes the app'skey/value store `settings.yml` with the admin's answers to the install form
    - creates a UNIX system user for this app
    - install apt dependencies needed for this app
    - picks up a port for internal reverse-proxying
    - initializes an empty SQL database
    - configures SSOwat permissions
    - ...
5. The actual app's `install` script is ran and typically does:
    - fetch and deploy the app sources
    - configure the app (typically DB credentials, internal reverse-proxy port...)
    - add the NGINX configuration
    - add the systemd configuration the app's daemon
    - starts the app daemon
    - various finialization tweaks
6. ???
7. Application is ready to use!


## 5. Creating your very first YunoHost package

Unless you really want to start from scratch or from [`example_ynh`](https://github.com/YunoHost/example_ynh), one common practice is to identify an app similar to the one you're trying to package - typically because it relies on the same technologies - clone the corresponding code repository, and adapt the various files. 

TODO/FIXME : here we should list a bunch of well-knowh apps for classic technologies

- PHP apps:
- NodeJS apps:
- Python apps:
- ???
