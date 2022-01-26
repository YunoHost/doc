---
title: Quality levels of YunoHost application packages
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_levels'
---

In order to facilitate the packaging of applications by providing successive steps to achieve, each package is assigned a quality level, from 0 to 10.  
A package must meet a number of criteria to reach each level. In addition, to reach a level, the package must have previously reached the previous level.

This classification of applications by levels has 3 advantages:
- The application packaging is more fun, with clear objectives to achieve and successive steps.
- A properly packaged application is put forward more than an application that does not comply with packaging rules.
- Users can quickly see the level of an application and thus know if the package is of good quality.

The level is automatically computed by the automatic test suite ("the CI") which runs tests [here](https://ci-apps.yunohost.org/ci/) and results are summarized [here](https://dash.yunohost.org/appci/branch/stable).

<div class="alert alert-info">
<b>
In the application catalog of the webadmin, an application is only shown to the user if its level is at least 5. Otherwiser, users may have to enable the display of "low-quality" applications to be able to install it.
</b>
</div>

## Summary of the level definitions

The following summarizes the current definition of the levels.

The exact definitions are likely to shift over time and are heavily dependent on:
- the [package linter](https://github.com/YunoHost/package_linter) which performs a static analysis of the app scripts and files to detect issues or deprecated practices
- the [package check system](https://github.com/YunoHost/package_check) which actually tests the various operations (installs, upgrades, backup...)

#### Level 0

The application does not work at all.

#### Level 1

The application can be installed/removed in at least one configuration.

#### Level 2

The application can be installed/removed in all common configurations.

(Typically this corresponds to full domain vs. sub path installs, private/public
installs, multi-instance installs)

#### Level 3

The application supports upgrading.

#### Level 4

The application supports backup/restore.

#### Level 5

The application triggers no errors on the package linter

#### Level 6

The application repository is part of the YunoHost-Apps organization, which allows the community to contribute to its maintainance.

#### Level 7

The application triggers no warnings on the package linter.

#### Level 8

The application is long-term good quality, meaning it's been at least level 5 in the application catalog for a certain amount of time (when writing this: level 5+ 90% of the time during the last year)

#### Level 9

The application is considered ["high-quality"](https://github.com/YunoHost/apps/blob/master/hq_validation_template.md): it is well-integrated with YunoHost (in particular SSO/LDAP) and follows the recommended development workflow.

#### Level 10

(No definition yet)
