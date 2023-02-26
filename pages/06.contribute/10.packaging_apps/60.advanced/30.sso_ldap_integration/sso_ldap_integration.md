---
title: SSO/LDAP integration
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_sso_ldap_integration'
---

One powerful aspect of YunoHost is that apps are meant to be integrated with the SSO/LDAP stack, such that users logged in on YunoHost's user portal can be directly logged in each app without having to create an account in each of them nor having to re-log in each app every time.

It should be stressed that there are two different aspects here:
- the LDAP integration, meaning that the user accounts in the app are directly mapped to YunoHost user accounts
- the SSO integration, meaning that a user logged in on the YunoHost user portal is automatically logged in on the app as well.

Sometimes, LDAP integration is possible, but not SSO integration (though the opposite would be really weird as LDAP integration is somewhat required for the SSO to work)

The SSO system is handled by [SSOwat](https://github.com/YunoHost/ssowat) and also handles the "permission" system which defines wether or not a user (or anonymous visitor) can access the app.

## LDAP integration

LDAP is a de-facto standard when it comes to sharing a common user account database between multiple applications, hence its use in the context of YunoHost.

However, each app does implement LDAP support in its own specific way (or doesn't), and needs to be provided with parameters to actually talk to YunoHost's LDAP database, usually via its config file. It is advise to look for real-life example of apps implementing these (such as Nextcloud, Wekan...) but you will usually need to provide:

- LDAP host: `localhost` / `127.0.0.1`
- LDAP port: `389`
- Base DN : `dc=yunohost,dc=org`
- User DN : `ou=users,dc=yunohost,dc=org`
- Search filter: `(&(|(objectclass=posixAccount))(uid=%uid)(permission=cn=__APP__.main,ou=permission,dc=yunohost,dc=org))` (this makes sure that only people with the appropriate YunoHost/SSowat permission can access the app)
- Username attribute: `uid`
- Display name attribute: `displayname`
- Email attribute: `mail`

TODO/FIXME: moar explanations? What is missing?

## SSO integration

Internally, SSOwat will on-the-fly inject [HTTP Basic Auth Headers](https://en.wikipedia.org/wiki/Basic_access_authentication) like `Authorization: Basic <base64credentials>`. Some applications may include Basic Auth support out of the box... PHP apps do often require this line in the NGINX config:

```text
fastcgi_param REMOTE_USER     $remote_user;
```

`$remote_user` being a special variable in NGINX that maps to the user provided in the HTTP Basic Auth headers. The PHP application will then use the `HTTP_REMOTE_USER` info in its code.


TODO/FIXME: moar explanations of how this is done for non-PHP apps?


## Configuring SSOwat permissions for the app

SSOwat permissions are configured using the 'permission' resource in your app's manifest.toml

If relevant, you can create "sub" permissions for your app, for instance to only allow a specific group of people to access the admin UI of the app. For example:

```toml
[resources.permissions]

# This configures the main permission, i.e. general access to `https://domain.tld/$app/`
# Initial access is defined using the `init_main_permission` install question.
main.url = "/"

# This configures an additional "admin" permission regarding access to `https://domain.tld/$app/admin`
admin.url = "/admin"
admin.show_tile = false    # This means that this permission won't correspond to a tile in YunoHost's user portal
admin.allowed = "admins"   # Initialize the access for the "admins" group ... You can also use an install question called `init_admin_permission` to let the server admin choose this.
```

See the page about app resources for the full description of behavior and properties.


## Logging out on the app vs. Logging out of YunoHost

A common [known issue](https://github.com/YunoHost/issues/issues/501) is that sometimes, logging out of YunoHost apps will not log people out of every app. This is for example the case for [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh/issues/19), because it uses its own authentication cookies which are not cleared when people log out of YunoHost. This is not trivial to fix.

Similarly, logging out of the app doesn't necessarily log people from YunoHost entirely (which is more acceptable that clicking Log out and... not being logged out at all because you're still logged-in on the SSO, hence logged in on the app). Some YunoHost app do integrate custom patches such that the logout process of the app does automatically redirects to `https://domain.tld/yunohost/sso/?action=logout` which logs them out.
