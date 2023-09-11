---
title: Users groups and permissions
template: docs
taxonomy:
    category: docs
routes:
  default: '/groups_and_permissions'
---

You can access the *groups and permissions* management interface from the webadmin
by going into the 'Users' section and clicking the corresponding button:

![](image://button_to_go_to_permission_interface.png)

## Managing groups

The group mechanism can be used to define groups of users which then can be used to restrict permissions for applications and other services (such as mail or XMPP). Note that it is *not* mandatory to create a group to do so: you can also restrict access to an app or service on a user-per-user basis.

Using groups is however useful for semantics, for example if you host multiple groups of friends, associations or businesses on your server, you might want to create groups like `association1` and `association2` and add members of each association to the relevant group.

It's also possible to define mail aliases for a group, such that mails sent to `groupe@domain.tld` will be dispatched to all members of the group.


### Default groups

By default, two special groups are created:
- `all_users`, that contain all users registered on YunoHost,
- `visitors`, that applies to people viewing the server while not logged in. 

The content of those groups cannot be changed, only the permissions given to them.

### List existing groups

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
The existing groups are listed at the top of the *groups and permissions* page.

![](image://groups_default-groups.png)

[/ui-tab]
[ui-tab title="From the command line"]

To list the currently existing groups in CLI :

```shell
$ yunohost user group list
groups:
  all_users:
    members:
      - alice
      - bob
      - charlie
      - delphine
```
[/ui-tab]
[/ui-tabs]

### Creating a new group

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
To create a new group, simply click on the "New Group" button at the top of the page. You may only choose a name formed with letters (uper- and lowercase) and spaces. The group is created empty and without any permission.

![](image://groups_button-new-group.png)

[/ui-tab]
[ui-tab title="From the command line"]
In CLI, to create a new group called `yolo_crew`

```shell
$ yunohost user group create yolo_crew
```
[/ui-tab]
[/ui-tabs]

### Updating a group

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
Let's add a first to this group: in the group panel, click the button "add a user" and scroll to the desired user, then click on it.

![](image://groups_button-add-user.png)

To remove a user, click on the cross next to their username, in the group panel.

![](image://groups_button-remove-user.png)

[/ui-tab]
[ui-tab title="From the command line"]
In CLI, use the following command to add `charlie` and `delphine`to the `yolo_crew` group:

```shell
$ yunohost user group add yolo_crew charlie delphine
```

(similarly, `remove` can be used to remove members from a group)

Now in the group list we should see:

```shell
$ yunohost user group list
groups:
  all_users:
    members:
      - alice
      - bob
      - charlie
      - delphine
  yolo_crew:
    members:
      - charlie
      - delphine
```
[/ui-tab]
[/ui-tabs]

### Deleting groups

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
To delete a group, click on the red cross on the top right of the group panel. You will be asked for confirmation.

![](image://groups_button-delete-group.png)

[/ui-tab]
[ui-tab title="From the command line"]
To delete the group `yolo_crew` in CLI, you may run

```shell
$ yunohost user group delete yolo_crew
```
[/ui-tab]
[/ui-tabs]

## Managing permissions

The permission mechanism allow to restrict access to services (for example mail, XMPP...) and apps, or even specific parts of the apps (for example the administration interface of WordPress).

### List permissions

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
The groups page lists the permissions given to each group, including the special groups `all_users` and `visitors`.

![](image://groups_default-with-permissions.png)

[/ui-tab]
[ui-tab title="From the command line"]
To list permissions and corresponding accesses in CLI:

```shell
$ yunohost user permission list
permissions:
  mail.main:
    allowed: all_users
  wordpress.admin:
    allowed:
  wordpress.main:
    allowed: all_users
  xmpp.main:
    allowed: all_users
```

Here, we find that all registered users can use email, XMPP, and access the WordPress blog. However, nobody can access the WordPress admin interface.

More details can be displayed by adding the `--full` option which will display the list of users corresponding to groups allowed, as well as urls associated to a permission (relevant for web apps).
[/ui-tab]
[/ui-tabs]

### Add accesses to group or users

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
To add a permission to a group, simply click the "+" button in the group panel, scroll to the desired permission, then click on it.

![](image://groups_add-permission-group.png)

Note that you can also allow a single user, by using the specific panel at the bottom of the page.

![](image://groups_add-permission-user.png)

[/ui-tab]
[ui-tab title="From the command line"]
To allow a group to access the WordPress admin interface in CLI:

```shell
$ yunohost user permission update wordpress.admin --add yolo_crew
```

Note that you can also allow a single user, by using the specific panel at the bottom of the page.

```shell
$ yunohost user permission update wordpress.admin --add alice
```

And now we may see that both the YoloCrew and Alice have access to the WordPress admin interface:

```shell
$ yunohost user permission list
  [...]
  wordpress.admin:
    allowed:
      - yolo_crew
      - alice
  [...]
```

Note that, for example, if we want to restrict permission for email so that only Bob is allowed to email, we should also remove `all_users` from the permission, by deleting it from the `all_users` group panel, or in CLI:

```shell
$ yunohost user permission update mail --remove all_users --add bob
```
[/ui-tab]
[/ui-tabs]

Note that some permissions may be "protected", meaning that you won't be able to add/remove the visitor group to this permission. Generally, this is because it would make no sense (or is a security risk) to do so.

The webadmin will issue a warning if you set a permission that is superseded by a wider permission.

![](image://groups_alerte-permission.png)

### Hide/display specific tiles in the user portal

Since YunoHost 4.1, you can choose to hide/display specific tiles in the SSO.
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
In the webadmin, you can do so by going in the corresponding app view, go in `Manage label and tiles` and check/uncheck the option `Display the tile in the user portal` for the corresponding permission. 

[/ui-tab]
[ui-tab title="From the command line"]

In command line, this may be done with:

```shell
# Enable the tile for the WordPress admin interface
$ yunohost user permission update wordpress.admin --show_tile True
```
[/ui-tab]
[/ui-tabs]


### Config alias group
Each group can use mail aliases, but their configuration is only available from the CLI so far. For example, the `admins` group is configured with aliases such as `admins@domain.tld`, `root@domain.tld` ... : mail sent to these addresses will be dispatched to all members of the `admins` group.

The command `yunohost user group info` will list them.

```shell
$ yunohost user group info admins
  [...]
  mail-aliases:
    - root@maindomain.tld
    - admin@maindomain.tld
    - admins@maindomain.tld
    - webmaster@maindomain.tld
    - postmaster@maindomain.tld
    - abuse@maindomain.tld
  [...]
```

To add a new mail, use the action `add-mailalias` or `remove-mailalias` to delete it.
```shell
$ yunohost user group add-mailalias <group> <address@domaine.tld>
```
