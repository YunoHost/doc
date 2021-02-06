---
title: Advanced features of apps packaging
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_advanced'
---

<div class="alert alert-warning">For now, all those features are <b>EXPERIMENTALS</b>
and aren't ready for production and are probably going to change again, if you
still decide to use them don't expect them to be stable and follow to core
development of YunoHost otherwise <b>they might randomly breaks on your apps</b>
</div>

## Actions

Actions allow you to ship a list of executables "actions" related to your
application, for example that could be:

* import data
* generate a custom backup
* start a procedure
* regenerate a local cache

[Full documentation](/packaging_apps_actions)

Example in the admin:

![actions admin screenshot](image://actions_example.png)

## Configuration Panel

Configuration or "config_panel" allow you to offer a custom configuration panel
for your application integrated into YunoHost administration panel. This allow
you to expose whatever configuration you want for your application and this is
generally used to handle an application configuration file when this is not
possible inside the application itself.

This is generally also the place where you want to add the option to make an
application public or not.

[Full documentation](/packaging_apps_config_panel)

Example in the admin:

![actions admin screenshot](image://config_panel_example.png)
