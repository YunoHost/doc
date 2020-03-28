# Packing Applications : Good Practise Guidelines

<div class="alert alert-danger">
<b>
This page is under development. As long as this warning is not removed. Consider this information as potentially false.
The name YEP is not a priori definitive, neither the levels nor the good practices in itself.
</b>
</div>

### Introduction
The purpose of this document is to list the various best practices concerning the creation of YunoHost application packages.

Each good practice is numbered with a number suffixed by the letters YEP (YunoHost Enhancement Proposals), so that it can be easily referenced in the ([package checker](https://github.com/YunoHost/package_check) and [package linter](https://github.com/YunoHost/package_linter)) tools, but also during the reviews of code.

Each YEP is associated with:
* a status indicating whether the rule has been validated or is still under discussion (draft, validated, refused, obsolete);
* an indication of the type of test to be carried out (manual or auto if an automatic tool can verify);
* an indication of the app level from which the rule is required (NOTWORKING, INPROGRESS, WORKING, OFFICIAL), some rules are optional;

### YEP Index
| ID | Title | Status | Test | Level |
| ---- | -------- | -------- | ------ | -------- |
| ** YEP 1 ** | ** Communicate with the community ** | | | |
| YEP 1.1 | App name and deposit | validated | manual | NOTWORKING (0) |
| YEP 1.2 | Register the app on a known "directory" | validated | manual | NOTWORKING (0) |
| YEP 1.3 | Indicate the license associated with the package | validated | AUTO | WORKING (5) |
| YEP 1.4 | Inform about intention to maintain package | draft | manual | OFFICIAL (6) |
| YEP 1.5 | Regularly update app status | draft | manual | WORKING (2) |
| YEP 1.6 | Keeping up-to-date on the evolution of apps packaging | validated | manual | OFFICIAL (6) |
| YEP 1.7 | Add the app to the [YunoHost-Apps Organization](https://github.com/YunoHost-Apps) | validated | manual | OFFICIAL (6) |
| YEP 1.8 | Publish test requests | validated | manual | OFFICIAL (6) |
| YEP 1.9 | Document the app | validated | AUTO | OFFICIAL (6) |
| YEP 1.10 | Keep a clean version history | draft | manual | OFFICIAL (6) |
| YEP 1.11 | Add app to [YunoHost bugtracker](https://github.com/YunoHost/issues/issues) | draft | manual | OFFICIAL (NA) |
| YEP 1.12 | Follow the template from [example_ynh](https://github.com/YunoHost/example_ynh) | draft | manual | OFFICIAL (8) |
| | | | | |
| ** YEP 2 ** | ** Stabilize an app ** | ** Status ** | ** Test ** | ** Level ** |
| YEP 2.1 | Respect the manifest format | validated | Home | INPROGRESS (5) |
| YEP 2.2 | Using bash for main scripts | validated | Home | WORKING (1) |
| YEP 2.3 | Save replies during installation | validated | manual | WORKING (3) |
| YEP 2.4 | Detect and manage errors | draft | manual | WORKING (8) |
| YEP 2.5 | Copy files correctly | draft | manual | WORKING (1) |
| YEP 2.6 | Cancel action if input values ​​are incorrect | validated | manual | WORKING (7) |
| YEP 2.7 | Give sufficient permissions to bash | validated | Home | WORKING (1) |
| YEP 2.8 | Correctly Changing a System Configuration | draft | manual | WORKING (8) |
| YEP 2.9 | Remove all traces of the app when deleting | draft | manual | WORKING (6) |
| YEP 2.10 | Configure application logs | draft | manual | WORKING (9) |
| YEP 2.11 | Use a variable rather than the id app directly | validated | manual | OFFICIAL (9) |
| YEP 2.12 | Using Helpers | validated | Home | OFFICIAL (5) |
| YEP 2.13 | Translate the package in English | draft | manual | OFFICIAL (9) |
| YEP 2.14 | Fill a conf file correctly | draft | manual | OFFICIAL (9) |
| YEP 2.15 | Follow the instructions for installing the application | validated | manual | OFFICIAL (1) |
| YEP 2.16 | Check availability of dependencies on ARM, x86 and x64 | validated | manual | OFFICIAL (8) |
| YEP 2.17 | Take the original version into account when updating | validated | manual | OFFICIAL (9) |
| | | | | |
| ** YEP 2.18 ** | ** Stabilize a webapp ** | ** Status ** | ** Test ** | ** Level ** |
| YEP 2.18.1 | Launch the script to install a webapp correctly | validated | manual | WORKING (5) |
| YEP 2.18.2 | Manage installation at the root of a domain name | validated | Home | WORKING (2) |
| YEP 2.18.3 | Manage installation on a subdomain | validated | Home | WORKING (2) |
| YEP 2.18.4 | Manage installation on a path `/path` | validated | Home | OFFICIAL (2) |
| YEP 2.18.5 | Manage the YunoHost tile for easy navigation between applications | validated | manual | OFFICIAL (8) |
| | | | | |
| ** YEP 3 ** | ** Secure an app ** | ** Status ** | ** Test ** | ** Level ** |
| YEP 3.1 | Do not ask or store LDAP password | draft | manual | NOTWORKING (?) |
| YEP 3.2 | Open a port correctly | draft | manual | WORKING (7) |
| YEP 3.3 | Facilitating Source Integrity Control | draft | manual | OFFICIAL (6) |
| YEP 3.4 | Isolate app | draft | manual | OFFICIAL (8) |
| YEP 3.5 | Follow the recommendations of the app's documentation | validated | manual | OFFICIAL (6) |
| YEP 3.6 | Update versions containing CVE | draft | manual | OFFICIAL (6) |
| | | | | |
| ** YEP 4 ** | ** Integrate an app ** | ** Status ** | ** Test ** | ** Level ** |
| 4.1 | Link to ldap | validated | manual | OFFICIAL (4) |
| YEP 4.2 | Link authentication to sso | validated | manual | OFFICIAL (4) |
| YEP 4.2.1 | Sign Out | validated | manual | OFFICIAL (9) |
| YEP 4.3 | Provide YunoHost Backup Script Functional | validated | Home | OFFICIAL (6) |
| YEP 4.4 | Provide a YunoHost Restore Functional script | validated | Home | OFFICIAL (6) |
| YEP 4.5 | Using Hooks | validated | manual | OPTIONAL (8) |
| YEP 4.6 | Manage multi-instance | validated | manual | OPTIONAL (2) |
| YEP 4.7 | Add a module to the CLI | validated | manual | OPTIONAL |
| YEP 4.8 | Add a module to the web admin | draft | manual | OPTIONAL |

### YEP 1
#### Communicating with the community
The YEP 1 is a meta YEP, it explains what it takes to interact with the community around a YunoHost application package.

#### YEP 1.1
##### App name and deposit | validated | manual | NOTWORKING |
Each YunoHost application has an id registered in the application manifest.
This identifier must be unique between each application packet.
It is therefore recommended to verify its availability by consulting the list of applications referenced in the known applications repositories (official, community, internetcube).

In addition, the identifier must respect the regular expression `^[a-z1-9]((_|-)?[A-z1-9])+$`. 
In other words, it must respect the following rules:
* be in lowercase
* start with a letter or number
* be alphanumeric (the underscore is allowed)
* do not contain two underscores or dashes that follow one another
* do not end with an underscore or dash

For application names containing spaces, virtually all current packages simply remove them without replacing them with dashes or underscores.

By convention, the YunoHost application repositories are always named their ID followed by the string "\ _ynh". Thus one can distinguish the upstream repository of the application, the deposit of the yunohost package. This notation also makes it possible to find applications not listed by the search engines of platforms offering version managers (GitHub for example).

Example: ID: Example Filing Name: example_ynh

#### YEP 1.2
##### Register the app on a known "directory" | validated | manual | NOTWORKING |
It is advised from the beginning of the packaging to register an app on one of the YunoHost application depots.

These deposits have several functions:
* communicate the existence of a package;
* indicate the latest version associated with the package (to allow the update of the app by YunoHost);
* indicate the state of operation of the packet;
* indicate information about the support of a package.

For the `apps.json` list maintained by the project team, registration is on [the git apps repository](https://github.com/YunoHost/apps). Other non-official lists may exists (including those for non-free apps for example), see more about that in the [community forum](https//forum.yunohost.org).

#### YEP 1.3
##### Indicate the license associated with the package | draft | AUTO | WORKING |
The license of the packet must be specified in a `LICENSE` file at the root of the packet. Be careful not to confuse with the license of the application that will be installed whose acronym is to be entered in the `license` field of the manifest.

The application lists official.json and community.json only accept packages with a free license, as well as the license for the contained application. Some free applications require non-free dependencies (example: mp3, drivers, etc.). In this case, you should add `&dep-non-free` to the acronym and if possible give details in the README.md of the package, in this case the integration will be accepted on a case-by-case basis.

**NB:** Apps not included in offical lists may still be installed: either manually with the URL to the app, or in a more practical way using non-official lists (which can be created and maintained by the community).

In the future, YunoHost will probably display details about the license of the application. To achieve this, the acronym must be the one from this [list of licenses listed in the SPDX](https://spdx.org/licenses/) (if there are 2 acronyms, the one containing the version number). For consistency, the case must be respected.

If the license is not present in the list, in this case it is necessary to indicate `free` or `non-free` depending on whether it is free or not and give the user the opportunity to inquire in the README .md (link, explanations, ...).

Example: for a GNU Lesser General Public License (LGPL), version 3 the acronym is `LGPL-3.0` if non-free dependencies are used in this case it will be necessary to put LGPL-3.0 & dep-non-free `in the manifesto.

If an application has modules linked to another license (Example: Odoo 9 LGPL-3.0 + a module licensed AGPL-3.0), in this case we will indicate the two licenses separated by a `&`.

If two separate applications are in the same installation package and have separate licenses, in this case we can use `,` to separate the licenses.

In both cases, the maintainer is encouraged to consider creating two separate packages. The manifest of each application is used to ask app-type questions to refer to another application already installed.

Reminder: a question of type `app` answers the identifier of one of the apps already installed.

Some interesting links to help with the choice of license:
* [Explanatory sheets on free licenses](https://www.inria.fr/content/download/5896/48452/version/2/file/INRIA_recueil_fiches_licences_libres_vf.pdf)
* [GNU project licensing documentation](https://www.gnu.org/licenses/licenses.html)
* [A Guide to the GNU Project to Help Choose a License](https://www.gnu.org/licenses/license-recommendations.en.html)

#### YEP 1.4
##### Inform about intention to maintain package | draft | manual | OFFICIAL |
The maintainer of the application must undertake to maintain its app over time if he wishes it to join the list of official applications.
This involves monitoring updates to the upstream application, adhering to the new packaging rules and responding to user requests.

#### YEP 1.5
##### Regularly update app status | draft | manual | WORKING |
#### YEP 1.6
##### Keeping up-to-date on the evolution of apps packaging | validated | manual | OFFICIAL |
In order to keep up with the evolution of the packaging format and best practices, it is recommended to:
* follow [the forum's Apps category](https://forum.yunohost.org/c/contribute-room/apps-packaging)

To follow the evolution of YunoHost more generally:
* join XMPP dev@conference.yunohost.org ([three days of logs are available](https://im.yunohost.org/logs/dev/))
* follow [Annoucement category of the forum](https://forum.yunohost.org/c/announcement)

#### YEP 1.7
##### Add the app to the [YunoHost-Apps Organization](https://github.com/YunoHost-Apps) | validated | manual | OFFICIAL |
Adding an app to the [YunoHost-Apps organization](https://github.com/YunoHost-Apps) lets you share apps with other contributors who might be tempted to package the targeted application .

It is also a way to quickly deploy a security patch if necessary in the event that the maintainer is unavailable.

Transfer Procedure: Ask the [chat room](chat_rooms_en) to be invited to the organization by providing the name of their GitHub account.
Once the invitation is accepted, [transfer its deposit to the organization by following this tutorial](https://help.github.com/articles/transferring-a-repository-owned-by-your-personal-account/# Transferring-a-repository-to-another-user-account-or-to-an-organization).

#### YEP 1.8
##### Publish test requests | validated | manual | OFFICIAL |
In order to ensure the proper functioning of a package, it is necessary to publish an announcement in order to open the tests on the package. This announcement can be done on the forum in [Forum Apps category](https://forum.yunohost.org/c/apps).

It is recommended to indicate if some tests have not been conducted.

* Check package with Package linter.
* Installation in subfolder.
* Installation at the root of a domain or subdomain.
* Deletion, in the 2 cases of previous installations.
* Access to the web interface of the application, with the / final in the address, and omitting it.
* Upgrade on the same version of the package.
* Upgrade from an older version of the package.
* Private installation (secured by SSO).
* Public installation.
* Multi-instance installation.
* User name error.
* Domain name error.
* Poorly written path (path / instead of / path for example).
* Port already used by another application.
* Source corrupted after download.
* Error downloading source.
* Folder already used by another application.
* Backup and restore.

#### YEP 1.9
##### Document the app | validated | AUTO | OFFICIAL |
Above all, it is appropriate to make a correct description of the app in the `description` field of the manifest. Keyword insertion in this description can be a good idea, as a user might be required to search (CTRL + F) among all applications.

There is also README.md, which must and can contain:
* the name of the app
* a brief summary of what it does
* any additional installation if the script is not sufficient
* instructions to use it (for example to connect your smartphone or computer)
* the location to report a malfunction / request
* the roadmap / TODO
* possibly prerequisites in terms of ram memories, processor etc. (some equipment has less than 512MB of ram)

#### YEP 1.10
##### Keep a clean version history | draft | manual | OFFICIAL |
#### YEP 1.11
##### Add app to [YunoHost bugtracker](https://github.com/YunoHost/issues/issues) | draft | manual | OFFICIAL |

#### YEP 1.12
##### Follow the template from [example_ynh](https://github.com/YunoHost/example_ynh) | draft | manual | OFFICIAL |
In order to facilitate the work of the community regarding a package, it has to follow the template shown by the example app.  
This will help other packagers to read, modify and debug the package. Also, it will help extend the life of the package by giving it a standard template that other packagers can quickly understand in the event that a package becomes orphaned.
As well, a package should not use exotic or uselessly complicated code if it's not really needed. If so, this part of the code should be clearly documented.  
Keep your code as easy as possible, keep everything a script needs directly into it. Do not move functions in another file. Keep it simple and efficient.

### YEP 2
#### Stabilize an app
#### YEP 2.1
##### Respect the manifest format | validated | Home | INPROGRESS |
The manifest allows to describe an app so that YunoHost can apply the good treatments. For more information see [dedicated documentation](https://yunohost.org/#/packaging_apps_manifest).

#### YEP 2.2
##### Using bash for main scripts | validated | Home | WORKING |
Action scripts (install, upgrade, remove, backup and restore) must be in the bash so that the cli / api yunohost can call them correctly.

That being said, there is nothing to prevent other scripts or function libraries from using these scripts. These are not obliged to be in bash.

However, careful attention must be paid to the correct display of logs of information, warning, or errors. So that a user of the cli / api yunohost can understand the operation of the script just executed and if necessary repair its YunoHost instance.

#### YEP 2.3
##### Save the answers during the installation | validated | manual | WORKING |
During installation, it is necessary to save each answer to the questions in the manifest. Indeed, even if at the beginning it is not necessary to write an update script, thereafter it will probably be the case. However, without the initial information, the update can be more tedious.

#### YEP 2.4
##### Detecting and Managing Errors | draft | manual | WORKING |
The install, upgrade, backup, and restore scripts must detect errors to avoid further scripting in case of blocking error or empty variable usage.
The use of trap and set -eu is recommended to detect and treat errors ([Discussion in progress](https://forum.yunohost.org/t/gestion-des-erreurs-set-e-and-or-trap/2249/5))
It is also necessary to check the contents of the variables before removing the remove script. For example, an `rm -Rf /var/www/$app` with `$app` empty would have a disastrous result.

At the beginning of the scripts, before any modifications, it is necessary to check the existence of the users mentioned at the installation, as well as the availability of the requested path, the availability of the final file of the application and the size of the passwords if necessary .

 Do not forget that in case of installation error the removal script will be launched automatically by the yunohost cli.

#### YEP 2.5
##### Copy files correctly | draft | manual | WORKING |
#### YEP 2.6
##### Cancel action if input values ​​are incorrect | validated | manual | WORKING |
Each script should verify that the input values ​​are correct.

Here are some examples :
* Check that the domain name exists
* Check that the user exists
* Check that the chosen path is available

If one of the values ​​is incorrect, it is necessary to cancel any modifications made previously to the instance. The best thing is to do all these checks before changing the system.

#### YEP 2.7
##### Give sufficient permissions to bash | validated | Home | WORKING |
Some instructions require sudo rights. In this case, do not forget to prefix these instructions with `sudo`.

In other cases it is necessary to give rights using chmod and chown.

#### YEP 2.8
##### Correctly changing a system configuration | draft | manual | WORKING |
Changes to the system must be reversible so that the removal of the application is of no consequence to the system leaves no residue.
For this purpose, the `.d` folders of the system configurations must be used as much as possible. Where it is not possible to do otherwise, clearly indicate the configuration as modified by an application and ensure that the changes will be removed when it is removed.

#### YEP 2.9
##### Remove all traces of the app when deleting | draft | manual | WORKING |
Except for dependencies (eg, Debian packages) used by other services or applications.

#### YEP 2.10
##### Configure application logs | draft | manual | WORKING |
If possible, the application should use a log file, which will preferably be in /var/log.
If the log is set up by the install script and not by the application itself, a log-rotate configuration file will have to be added to handle the logs of the application.

#### YEP 2.11
##### Using a variable rather than the app id directly | validated | manual | OFFICIAL |
It is advisable to make the scripts as generic as possible, a good way to do this is to use a variable for the app's name to avoid it being found everywhere in scripts. This will make it easier for another package builder to use the script for another app.

#### YEP 2.12
##### Using Helpers | validated | Home | OFFICIAL |
In order to simplify packaging, standardize practices, avoid errors and increase the lifetime of a script vis-à-vis future versions of YunoHost. A set of helpers to do many actions is proposed.

For more information :
* consult [helpers documentation](https://yunohost.org/#/packaging_apps_helpers)
* explore [helpers directory](https://github.com/YunoHost/yunohost/tree/unstable/data/helpers.d)

#### YEP 2.13
##### Translate the package in English | draft | manual | OFFICIAL |
#### YEP 2.14
##### Fill a conf file correctly | draft | manual | OFFICIAL |
* Just to clear up a little this YEP, but it remains in draft form. *
The goal is to find a more reliable method than sed to modify the configuration files. sed can possibly have edge effects by modifying unwanted parts of the configuration file, especially with the use of regex.

#### YEP 2.15
##### Follow the instructions for installing the application | validated | manual | OFFICIAL |

#### YEP 2.16
##### Check availability of dependencies on ARM, x86, and x64 | validated | manual | OFFICIAL |
YunoHost installs on ARM, x86 and x64. A package should therefore be tested on these three processor architectures.

Some packages are not available on ARM, in this case it is advisable to study other solutions or to indicate in the README.md that the application does not work on ARM and to block the installation by detection of type d 'architecture.

#### YEP 2.17
##### Take the original version into account when updating | validated | manual | OFFICIAL |
The update script must be able to run even if the previous updates have not been performed.

For example, it should be possible to perform update jumps from an N-x version to an N version. To do this, it is advisable to save the version numbers in the app settings.

### YEP 2.18
##### Stabilizing a webapp
The majority of YunoHost applications are web apps, but some are not. The YEP 2.18.x develop certain specificities related to the web app.

#### YEP 2.18.1
##### Launch the script to install a webapp correctly | validated | manual | WORKING |
Often a web app installs itself from forms displayed on a web page. This practice, while practical for a human, is less so for a program.

It is therefore necessary to check if the application does not propose a solution of installation on command line.

If this is not the case, the -H option of curl should be used. In some cases, DNS redirection may not be active at the time of installation.
`` `Bash
curl -kL -H "Host: $domain" --data "&param1=Text1&param2=text2" https: //localhost$path/install.php > /dev/null 2>&1
`` `

#### YEP 2.18.2
##### Manage installation at the root of a domain name | validated | Home | WORKING |
A web app should be able to install itself at the root of a domain name.

#### YEP 2.18.3
##### Manage installation on a subdomain | validated | Home | WORKING |
A web app should be able to install itself on a subdomain directly without subfolders.

#### YEP 2.18.4
##### Manage installation on a path `/path` | validated | Home | OFFICIAL |
A web app should be able to install on a path `/path`.

#### YEP 2.18.5
##### Manage the YunoHost tile to easily navigate between applications | validated | manual | OFFICIAL |
Except in rare cases it is advisable to integrate the tile YunoHost which allows to return to the menu of the SSO. This integration is done in the nginx configuration.

Some users have replaced this square with a script adding a menu at the top of each webapp.

### YEP 3
#### Securing an app
#### YEP 3.1
##### Do not ask or store LDAP password | draft | manual | NOTWORKING |
#### YEP 3.2
##### Open a port correctly | draft | manual | WORKING |
If the application requires the opening of a port, it is necessary to check beforehand that this port is not already used by another application. If so, the install script must be able to find another available port.
It should also be checked whether the port should be open on the router, beyond the local network. If this is not the case, the `--no-upnp` argument must be added to the` yunohost firewall allow` command in order to limit the port opening to the LAN only.

#### YEP 3.3
##### Facilitating Source Integrity Control | draft | manual | OFFICIAL |
The upstream application should not be integrated into tarball in the source folder of the package, as this adds to the package and the git repository and does not allow verification of the integrity of the source.
The source must be downloaded from the official website, then its integrity must be checked before installing it.

#### YEP 3.4
##### Isolate app | draft | manual | OFFICIAL |
In order to avoid edges in case of possible compromise of the application, it must be insulated in order not to affect the other applications.
To do this, it is necessary to isolate the application in its execution folder by restricting its environment by a chroot, either by a mechanism internal to the application where possible (for example for an ftp server), or by the use of phpfpm.
Similarly, to restrict the scope of the user running the application, it is preferable to use a user dedicated to the application. Whose rights are restricted to the use of the application only.
However, this should not exempt from a maximum restriction of rights on application files. As much as possible, the files must belong to root, and the dedicated user must have write rights only on files that specifically request it.

#### YEP 3.5
##### Follow the recommendations in the app's documentation | validated | manual | OFFICIAL |
Typically, an application provides documentation to help system administrators perform the installation. It is advisable to follow the recommendations, including the permissions to be granted per file or directory.

However, the package maintainer must remain vigilant, some documentation may be erroneous or insufficient.

#### YEP 3.6
##### Update versions with CVE | draft | manual | OFFICIAL |
The [CVE](https://en.wikipedia.org/wiki/Common_Vulnerabilities_and_Exposures), or Common Vulnerabilities and Exposures, identify security vulnerabilities common to applications. The corrections of these flaws may concern the application and it is important in this case to follow these updates as closely as possible.
More generally, the application can propose a patch for a specific vulnerability to itself.
Generally, this YEP involves tracking an information channel to track application security updates and reacting quickly by updating the package accordingly.

As specified in YEP 1.7, if a security patch is to be deployed urgently, another YunoHost member may be required to commit to the package if necessary.

### YEP 4
#### Embedding an app
This meta YEP deals with the integration of an app with the YunoHost environment. Good integration is generally a guarantee of quality and comfort for users.

#### YEP 4.2
##### Linking Authentication to sso | validated | manual | OFFICIAL |
The Single Sign On makes it possible to avoid having to create the same users for each app. Thus, a YunoHost user can connect via the Single Sign On to all the apps.

To do this, you must link your app to the LDAP and / or use hooks to duplicate the account credentials in the app's database.

Once this is done, the maintainer can use the REMOTE_USER HTTP statement to check whether a user is logged on or not. In general, modules exist (whether at the level of the technology, the framework or even the app itself).

If required, SSOwat can be used to secure access to one or more parts of the app. It may be relevant to secure access to an administration page with the SSO rather than a `.htaccess` and make the rest of the app accessible to all visitors.

#### YEP 4.2.1
##### Logout | validated | manual | OFFICIAL |
When you click on a disconnect action within the app, it should disconnect the user from the SSO. Otherwise, there is a risk that the user will inadvertently leave an open session.

#### YEP 4.3
##### Provide YunoHost Backup Script Functional | validated | Home | OFFICIAL |
The application must have a backup script to allow users to back up the application, its configuration, and its data.

#### YEP 4.4
##### Provide a functional YunoHost restoration script | validated | Home | OFFICIAL |
The application must have a restore script to allow users to restore an application previously backed up with the backup script.

#### YEP 4.5
##### Using Hooks | validated | manual | OPTIONAL |
YunoHost offers the possibility to launch actions with each processing carried out by the command line. This can be practical in many cases.

Examples:
* Add / delete a user in the app database when using `yunohost user create` or` yunohost user remove`
* Manage the addition of a new domain name during the `yunohost domain add` action
* Run a script after the firewall has been reloaded

List of hooks:
* post_domain_add
* post_domain_remove
* post_user_create
* post_user_delete
* post_backup_create
* post_backup_restore
* pre_backup_delete
* post_backup_delete
* post_app_addaccess
* post_app_removeaccess
* post_app_clearaccess
* post_app_addaccess
* post_iptable_rules

These scripts are to be placed in a `hooks` directory as in this package: https://github.com/YunoHost-Apps/owncloud_ynh/tree/master/hooks.


#### YEP 4.6
##### Manage multi-instance | validated | manual | OPTIONAL |
It is sometimes practical to be able to install the same app several times. For example, for several different domain names.

However, be careful about how to handle file paths, dependencies, ports used, etc. so that there is no collision.

#### YEP 4.7
##### Add a module to the CLI | validated | manual | OPTIONAL |
You can create a module to add commands to the yunohost command line.

To do this, you need to add an actionmaps to `/usr/share/moulinette/actionsmap/`. This actionmaps must start with `ynh_`.

The packages [menu_ynh](https://github.com/YunoHost-Apps/menu_ynh/) and [subscribe_ynh](https://github.com/YunoHost-Apps/subscribe_ynh/) are old (and not up to date) can be used as the basis for this type of module.
#### YEP 4.8
##### Add a module to the web admin | draft | manual | OPTIONAL |
