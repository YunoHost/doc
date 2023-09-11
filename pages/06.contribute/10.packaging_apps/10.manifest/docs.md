---
title: 'Writing the app manifest'
template: docs
taxonomy:
    category:
        - docs
routes:
    default: /packaging_manifest
---

The app's `manifest.toml` can be seen as the ID card of the app. It declares various basic metadata such as the id, name, description of the app, its version, install questions to be asked to the admin prior to installation, etc.

In this page, the data are described according to a somewhat dummy app called `helloworld`

!!! If you want to convert an application from the packaging v1 to v2 format, [please see here](/packaging_v2)!

## General information

```toml
packaging_format = 2
id = "helloworld"
name = "Hello World"
description.en = "A dummy basic app to illustrate YunoHost's app packaging."
description.fr = "Une app simple et bidon pour illustrer comme le packaging d'app de YunoHost fonctionne"

version = "0.1~ynh1"

maintainers = ["alexAubin"]
```

- `packaging_format` (`int`) is the packaging version format used to package this app. Newly packaged apps are strongly encouraged to use the new "v2" format (starting with YunoHost 11.1) while older apps may still be in "v1" format.
- `id` (`str`) is expected to be lower-case alphanumeric (and possibly `-`). This is what will be used for instance in the syntax `yunohost app install <app_id>`. This will also be the name of various folder or conf files such as `/etc/yunohost/apps/<app_id>` or `/etc/nginx/conf.d/<domain>.d/<app_id>.conf` (if applicable), and a dedicated system user.
- `name` (`str`) is the display name of the app, shown for example in the webadmin UI or user portal. It is limited to 22 chars <small>(though not sure why this number?)</small>.
- `description` (`dict` of `lang code`->`str`) contains *short*, *concise* descriptions of the app in different languages (at least `en`). It is limited to 150 chars. It will be displayed on the app catalog and should allow people to understand what this app is about at a glance. A more extensive description of the app can be provided in `doc/DESCRIPTION.md`.
- `version` (`str`) is composed of the *upstream* version of the app shipped, and an `~ynhX` suffix. Changing this version is what effectively triggers an available upgrade for YunoHost instances which installed this package (hence no upgrade will be displayed as available if you forget to change it). The point of the `~ynhX` suffix is to have a way to increment the version when commiting changes unrelated to the upstream but still trigger an upgrade.
- `maintainers` (`list` or `str`) may allow to declare which person should be the referring person for this package (though packages are often maintained collectively and not really used in practice). This should contain a list of easily identifiable persons (eg your Github or Matrix username)

## Upstream section

This section is meant to provide various metadata about the app upstream such that YunoHost admins can easily obtain further information regarding this app (or, kinda important, try the upstream's demo before deciding to install it).

Apart from the license, all fields are *optional* and should only be provided if they are relevant (e.g. don't provide `website` if the upstream project has no website...)

```toml
[upstream]
license = "WTFPL"
website = "https://www.hello-world.com/"
code = "https://github.com/octocat/Hello-World"
demo = ...
admindoc = ...
userdoc = ...
```

- `license` (`str`) : the license code of the *upstream* project. (Note that only apps based on free software will be accepted in the official YunoHost app catalog.). The license code should be [a valid SPDX identified](https://spdx.org/licenses/).
- (optional) `website` (`url`) : the url of the upstream project's website, if there is indeed a website (please don't just copypasta the git repo url)
- (optional) `demo` (`url`) : an url where people can try out the app before installing it (ideally maintained by the upstream project)
- (optional) `code` (`url`) : the url of the upstream project's code repository, which is very much expected to exist for free software ... but may not exist for special "no upstream" apps ;)
- (optional) `admindoc` (`url`) : the url of the *upstream* project's admin documentation, which may help YunoHost admins with adminstrating the app <small>(YunoHost-specific documentation can be provided in `doc/ADMIN.md`)</small>.
- (optional) `userdoc` (`url`) : the url of the *upstream* project's user documentation, which may help YunoHost end-users with effectively using the app.
- (optional) `cpe` (`str`) corresponds to the [Common Platform Enumerations code in NIST db](https://nvd.nist.gov/products/cpe). For example for Wekan this is `cpe:2.3:a:wekan_project:wekan`. Not really used at the moment, but may be used in the future to check for known vulnerabilities (CVE) in the app catalog.

## Integration section

This section is meant to contain info related to the relation between the app and YunoHost, or things like typical resource usage.

```toml
[integration]
yunohost = ">= 11.1"
architectures = "all"
multi_instance = false
ldap = "not_relevant"
sso = "not_relevant"
disk = "1M"
ram.build = "1M"
ram.runtime = "1M"
```

- `yunohost` (`str`) contains the minimum YunoHost version required for this app to work.
- `architectures` : `"all"` OR a list of supported archs using the `dpkg --print-architecture` nomenclature, i.e. among : `amd64` (= x86 64bit), `i386` (= x86 32bit), `armhf` (= ARM 32bit), `arm64` (= ARM 64bit)
- `multi_instance` (`bool`) : wether or not the app supports being installed multiple time <small>(in which case, during installation, the actual app id is not just the `id` of the manifest, but something like `hellowold__2`, `helloworld__3`, etc. for subsequent installs)</small>
- `ldap` (`bool` OR `"not_relevant"`) :  not to confused with the `sso` key : this corresponds to wether or not the app is configured to use YunoHost's LDAP DB as the user account DB. This should be set to `"not_relevant"` if and only if there is no notion of user account for this app (for example, Hextris). LDAP integration is often a prerequisite for the SSO to work.
- `sso` (`bool` OR `"not_relevant"`) : not to be confused with the `ldap` key : this corresponds to wether or not a user is *automatically logged-in* on the app when logged-in on the YunoHost portal. This should be set to `"not_relevant"` if and only if there is no notion of user account for this app (for example, Hextris).
- `disk` (size) : an *estimate* minimum disk requirement. For example: 20M, 400M, 1G, ...
- `ram.build` (size) : an *estimate* minimum ram requirement when building the app (this may be way different than `ram.runtime` because some apps have a peak 1~2G RAM when building sometimes...). For example: 50M, 400M, 1G, ...
- `ram.runtime` (size) : an *estimate* minimum ram requirement when the app is active and running. For example: 50M, 400M, 1G, ...


## Install questions

This section contains questions that should be asked to the admin prior to starting the actual install

```toml
[install]
    [install.domain]
    # this is a generic question - ask strings are automatically handled by YunoHost's core
    type = "domain"

    [install.path]
    # this is a generic question - ask strings are automatically handled by YunoHost's core
    type = "path"
    default = "/helloworld"

    [install.init_main_permission]
    # this is a generic question - ask strings are automatically handled by YunoHost's core
    type = "group"
    default = "visitors"

    [install.prefered_pet]
    ask.en = "Do you prefer cats or dogs?"
    help.en = "Think carefully!"
    type = "string"
    choices.cat = "Cats :3 !"
    choices.dog = "Doggos <3"
    choices.both = "OMG Both ! I can't choose !"
```

- `domain` and `path` (with `type = "domain"/"path"`) are classic questions to allow the admin to choose where the app is installed (in terms of web url endpoint)
   - e.g. if the admin answers `domain.tld` and `/foobar`, the app will be available under `domain.tld/foobar`
   - some webapp do require a full dedicated domain and do not support the "subpath" install scheme. In that case, you typically want to remove the `path` question entirely
   - these questions are part of YunoHost's generic app questions and therefore you do not need to define the `ask.en` strings that contain the actual question displayed in the UI along the line of "Choose a domain to install this app on"
- `init_main_permission` is also a classic question <small>(similar to `is_public` in v1 packaging)</small> and define what user group will be able to access the app after it is installed. Typical answer are : `visitors` (= everybody including anonymous users, the app is "public"), `all_users` (= only people with a YunoHost account, the app is "private"), or any custom user group that may have been defined by the YunoHost admins prior to the install.
- `prefered_pet` is a custom question:
   - `ask.en` defines the human-readable question to be asked (at least the english version)
   - `help.en` is an optional additional message to provide further info about this question
   - `type` is the type of question, in this case `string`
   - in this example, we don't want a free user input but choosing between `cat`, `dog` or `both` (with proper human-readable versions of these choices)
   - this will later automatically create a yunohost app setting named `prefered_pet`
   - .. and in the bash install script, the bash variable will automatically be available `$prefered_pet` with the chosen value

### Regarding install question types

FIXME : This should be way more documented in a separate section (and is also related to config panels...)

The full list of question types is : `string`, `text`, `select`, `tags`, `email`, `url`, `date`, `time`, `color`, `password`, `path`, `boolean`, `domain`, `user`, `group`, `number`, `range`, `alert`, `markdown`, `file`, `app`.

`password`-type questions have special behavior and are NOT automatically saved as setting (user-chosen password should ideally not be stored, at least not hashed...)

Every install question is not necessarily mandatory (e.g. a question to propose to add an api key for a better user experience, although the app still works without). To make those questions optional, just write `optional = true`.

## Resource system

The resource section corresponds to recurring app needs that are to be provisioned/deprovisioned by the core of YunoHost. They include for example: downloading the app's sources, creating a system user, installing apt dependencies, creating the install dir, creating the data dir, finding an available internal port, configuring permissions, initializing an SQL database... Each resource is to be provisioned *before* running the install script, deprovisioned *after* the remove script, and automatically upgraded if needed before running the upgrade script (or provisionned if introduced in the new app version, or deprovisioned if removed w.r.t. the previous app version)

```toml
[resources]
```toml
    [resources.sources.main]
    url = "https://some.domain/url/where/to/download/the/app/sources.tar.gz"
    sha256 = "0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef"

    [resources.system_user]

    [resources.install_dir]

    [resources.permissions]
    main.url = "/"
    
    [resources.apt]
    packages = "nyancat, lolcat, sl"
```

In this example:
- `sources.main`: the URL+checksum from which the app sources will be downloaded + validated
- `system_user`: a system (unix) user will be created for this app, using the app id as username.
- `install_dir`: an install dir will be initialized, named `/var/www/$app` by default. Additional `owner` and `group` property allow to change the owner/group and r/w/x permissions on the created folder.
- `permissions`: an SSOwat `$app.main` permission will be initialized such that the SSO allows access to the app's endpoint according to the chosen `init_main_permission` question. The `main.url = "/"` is here to tell that the main endpoint is the "root" of the app, that is `https://domain.tld/helloworld/` if the app is installed with `domain=domain.tld` and `path=/helloworld`
- `apt`: the packages `nyancat`, `lolcat`, `sl` will be installed with `apt`. These are just dummy apt dependencies to illustrate the syntax.

### List of app resources

The full documentation on resources is available [here](/packaging_apps_resources).
