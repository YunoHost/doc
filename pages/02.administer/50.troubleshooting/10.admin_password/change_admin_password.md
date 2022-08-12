---
title: Changing the administration password
template: docs
taxonomy:
    category: docs
routes:
  default: '/change_admin_password'
---

You may want to change your administrator password for security reason or because you forgot it.

If you forgot your password or are unable to connect using the `admin` user, you
may still be able to change the password if you're able to login as `root` on
SSH (from your local network! or using a rescue mode if you're on a VPS...)

## Using the web administration interface

First, connect to your web administration.

Then go to Tools > Change administration password.


## Using the command line interface


```bash
yunohost tools adminpw
```
