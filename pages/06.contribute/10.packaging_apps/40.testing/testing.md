---
title: Testing your app
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_testing'
  aliases:
    - '/packaging_apps_levels'
---

Once you're done writing you app package, you'll want to check that everything works correctly. At first, you can manually try to install your app on some test server of your own, but testing everything manually often becomes tedious ;).

The YunoHost maintains several tools to automatically and somewhat "objectively" analyze and tests our 400+ apps catalog.

## Package linter

The [package linter](https://github.com/YunoHost/package_linter) performs a static analysis of your app to check a bunch of recommended practice.

It is pretty straightforward to run considering that you should only need Python installed.

## Package check

[Package check](https://github.com/YunoHost/package_check) is a more elaborate software that will tests many scenarios for you app such as:
- installing, removing and reinstalling your app + validating that the app can indeed be accessed on its URL endpoint (with no 404/502 error)
   - when installing on a root domain (`domain.tld/`)
   - when installing in a domain subpatch (`domain.tld/foobar`)
   - installing in private mode
   - installing multiple instances
- upgrading from the same version
- upgrading from older versions
- backup/restore
- ...

Package check will then summarize the results and compute a quality level ranging from 0 to 8.

To run its tests, package check uses a LXC container to manipulate the package in a clean environment without any previous installations. Installing LXC/LXD is unfortunately not that straighforward (it kinda depends on your OS/distribution), though we documented how to do so [in the README](https://github.com/YunoHost/package_check#deploying-package_check).

### Package check's `tests.toml`

Package check interfaces with your app's `tests.toml` which allows to control a few things about which tests are run - though it is usually pretty empty as many things can be deduced from the app's manifest.

More info about the syntax here are also available [in the README](https://github.com/YunoHost/package_check#teststoml-syntax)

### Application quality levels

Package check will compute a quality level ranging from 0 to 8.

Apps with level equal or lower than 4 are considered "bad quality" and YunoHost will discourage people from installing such apps.

While this definition may vary with time, the current definition as of February 2023 is roughly:

- level 0 (« Broken ») : the application doesn't work at all or doesn't pass level 1 criterias
- level 1 (« Installable in at least one scenario ») : At least one install succeeded, and there's no critical issue reported in the linter
- level 2 (« Installable in all scenarios ») : All install scenarios tested (typically install on full domain, domain+subpath, multi-instance, private/public) succeeded
- level 3 (« Can be upgraded ») : All upgrades tests from the current commit succeeded
- level 4 (« Can be backuped/restored ») : All backup/restore tests succeeded
- level 5 (« No linter error ») : No red errors reported by the linter
- level 6 (« App is in a community-operated git org ») : The app is hosted on YunoHost-Apps organization. (From a maintenance / security point of view, we want to avoid the catalog being filled with apps that are privately-hosted and that the initial maintainer will ultimately abandon and that can't be maintained easily by the community)
- level 7 (« All tests succeeded + No linter warning ») : Pass all test (including for example upgrade from past commits) and no warning reported by the linter
- level 8 (« Maintained and long-term good quality ») : The app is not flagged as not-maintained / alpha / deprecated / obsolete in the catalog, and has been at least level 5 during the past ~year


## Continous integration (CI)

The YunoHost project also developed an interface called [`yunorunner`](https://github.com/YunoHost/yunorunner) which interfaces with `package_check`, handles a job queue, and automatically add jobs to the queue using some triggers.

The two major ones are:
- [The "official" CI](https://ci-apps.yunohost.org/ci): This where the "official" quality level of each app comes from. Jobs are triggered after each commit on the repo's master branch.
- [The "dev" CI](https://ci-apps-dev.yunohost.org/ci/): This is where people validate their pull request which is often more convenient than running `package_check` yourself, and has the advantage of the results being automatically public, which facilitates collective debugging.

Members of the YunoHost-Apps organization can trigger jobs on the dev CI directly from a pull request simply by commenting something like `!testme` (cf for example [here](https://github.com/YunoHost-Apps/nextcloud_ynh/pull/532#issuecomment-1402751409)). A .png summary of the tests will be automatically displayed once the job completes (and you can click the link to see the entire job execution and debug it).


#### Why create `package_check` + `yunorunner` rather than using well-known solutions like Gitlab-CI ?

Constrain 1 : Gitlab-CI or other similar solutions are mostly based around Docker, while we use LXC. In particular, we do want to reuse LXC snapshots of successful install during other tests (upgrade, backup/restore, ..) rather than reinstalling the app from scratch everytime, which drastically reduces the test time. We could do so using Gitlab artifacts, but such artifacts are automatically made public which is not convenient because they contain a full filesystem and their only use it to speed up the test process. Moreover, in the Gitlab-CI paradigm, jobs are not running on the same machine and they would need to download the snapshot which can be lengthy. The other mechanism, caching, is explicitly advertised as not reliable in Gitlab's-CI doc. What would be helpful would be some non-public artifact system (see similar discussion [here](https://gitlab.com/gitlab-org/gitlab-runner/-/issues/336))

Constrain 2 : Our test workflow is somewhat complex and we have 400+ apps to maintain. It's not acceptable to have to duplicate/maintain the CI logic in app each repository, so we need some sort of repo that handles the CI logic, while still being to supersed some behavior from the app repo itself. Gitlab-CI has some syntax which can allow this, but this remains quite laborious.

Constrain 3 : Having a common job queue/dashboard UI accross all app. In the Gitlab-CI paradigm, each repository has its own job queue/dashboard UI, but this is not really convenient.
