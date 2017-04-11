#Debian package creation

## Architecture
The system contains `rebuildd`, a front-end for `pbuilder`, some chroot pbuilder for i386, amd64, armhf and `reprepro` for debian repository system.

---

## Workflow

There is 3 repositories (`unstable`, `testing` & `stable`):
* Packages from `unstable` (aka `daily`) are the latest version from git and are build automatically every night.

* Packages from `testing` (aka `test`) allow to set up a new package version to be tested.

* Packages from `stable` (aka `megusta`) contains only production versions.

This workflow purpose is to avoid any manual interaction (script launch, ...) on your server and to focus on package management through Github only.

Thus, each yunohost package has three branches, matching the three repositories (`unstable`, `testing` et `stable`). The build server will **automatically** build and deploy Debian source packages and binaries into the corresponding state on Github

### Unstable branch
Commits to the unstable branch will not modify the `debian/changelog` file because it is automatically updated during daily builds with corresponding date and time.

Any commit that will alter a package behaviour need to be done to the `unstable` branch first.

**`TODO`** Add pre-commit hook to avoid errors ?

### Testing et stable branch - standard workflow

No commit can be done directly in those branches. You need to use merges (merge from `unstable` to `testing` & merge from `testing` to `stable`).

The only specific changes that occur on the repositories are version changes (modification of `debian/changelog`, then tag).

As a YunoHost application maintainer, you may find specific tools in the repository [yunohost-debhelper](https://github.com/YunoHost/yunohost-debhelper)
```bash
git clone https://github.com/YunoHost/yunohost-debhelper
yunohost-debhelper/setup_git_alias.sh
```
The previous instructions will configure a new git alias named `yunobump`. It is global and located at `~/.gitconfig`, therefore accessible through any local git repository.

<div class="alert alert-warning">
**Cauttion:** this helper `yunobump` only works for Ubuntu or Debian Jessie for the moment. You **need** to install `git` and `git-buildpackage` packages in order to make this helper work properly.
</div>

#### Without helper

1. Go into the repository you wish to build
2. Make sure `unstable` branch contains all modifications you wish to apply
3. Get the current version number: `head debian/changelog`
4. Move to the `testing` or `stable` branch
5. Merge or cherry-pick commits you want to insert into the `unstable` branch
6. Add to `debian/changelog` the corresponding commits messages (or use `git-dch` to do it automatically)
7. Tag the current branch (`testing` or `stable`) with the next superior value for version number
8. Push modifications **and tags** into GitHub repository
9. Go back to `unstable` branch
10. Merge changelog
11. Push `unstable` branch

#### With helper

```bash
# You Only Clone Once
$ git clone git@github.com:YunoHost/yunohost.git
$ cd yunohost

# Be sure to be up-to-date, and don't forget to get the tags !
$ git fetch --tags

# Checkout your branch: stable or testing
$ git checkout testing

# Do your 'functional' modifications: either merge unstable in testing, or merge testing in stable
$ git pull origin unstable
# Or just
$ git merge unstable

# What is the current version number in test?
$ dpkg-parsechangelog | grep "^Version" | cut -d ' ' -f 2
# Or just
$ head debian/changelog

# Update changelog and do a proper tag (explained below)
$ git yunobump x.y.z

# Push the branch state AND the tags to the remote repository
$ git push origin --tags testing:testing

# Merge changelog modifications to the `unstable` branch
$ git checkout unstable
$ git merge testing
$ git push origin unstable
```

**`TODO`** Tag format policy: actually $branch/$version to enable the same version into two different branches. Is it necessary?

**`TODO`** Under normal circumstances, every push to test or stable, the last commit will result in a changelog commit properly tagged. It should be possible to set a pre-push git hook that prevents from pushing unfinished work

#### Test and stable branches - hotfix

Exceptionally, you may hotfix (for security purposes for example) `stable` or `test` packages, leading to a merge into daily branch which is not acceptable (too much new features in development).

** This MUST remain exceptional **

**`TODO`** Describe

**`TODO`** Develop a 'git yunohotfix ...' helper that commit into stable and cherry-pick right away into daily? or the opposite?

#### Not YunoHost packages

« not-YunoHost » packages (`python-bottle` for example) don't go through `unstable` repository. Once package tests are completed, they need to be manually transferred into `backport` repository.

---

## Version number

So far, YunoHost global base version is **2**. The current convention for the version number is **2.x.x**.

The second section of the number string is incremented if a major functional change has occured: addition of a new functionality, modification of a behaviour. For now, all packages are versionned **2.1.x**.

The third section of the number string is incremented if a bugfix or a minor functional change has occured. For example, you may currently find **2.1.3** or **2.1.5** packages
 
A fourth section is dedicated for exceptional cases like bugfixes in stable branch. In this case, we want to pass on a unique change directly into stable branch, therefore we add **-x**  to the number string. This may result into something like this: **2.1.3-1**.

---

## Packages management

#### Daily build

A cron task defined for `pbuilder` user is executed **every day at 01:00**. The script will update the `packages` git repository and submodules (`ssowat`, `moulinette`, `yunohost` & `yunohost-admin`). 
Once sources are up to date, the script will rebuild packages that have been updated the day.

Sources packages will then need to be created and moved into `/var/www/repo.yunohost.org/daily/incomming` folder.

Launch source file addition to the repository. This will automatically launch a `rebuildd` job (see daily repository configuration: `/var/www/repo.yunohost.org/daily/conf/distribustion`).

Once packages are built, they are added to the `unstable` repository.


#### (Re)build a YunoHost package

You may manualy launch a package build by typing:

```bash
$ daily_build -p package_name
```

#### Build a not YunoHost package

```bash
$ build_deb /path/of/package
```

**`TODO`** Describe : need to bump the version to pass from test to stable 

### Passing from `daily` to `test`

```bash
$ push-packages-test -p package_name
```
You may add the `-v` argument to manually define the package version.

The script will get the `daily` sources package and define the version and changelist into the changelog. Build package will be added to the rebuildd jobs list that will pass everything to the `test` repository.

**Attention :** Version name must not contain `daily` otherwise the package will be added to the `daily` repository.


### Passing from `test` to `stable`

```bash
$ push-package-stable -p package_name
```

The previous command only passes the package from `test` to `stable` repository, without rebuild.


### Repository management with `reprepro`

* Delete a package
```bash
$ reprepro -V -b /var/www/repo.yunohost.org/repo_name/ remove megusta package_name
```

* Add a Debian package into a repository
```bash
$ reprepro -V -b /var/www/repo.yunohost.org/repo_name/ includedeb megusta package_name.deb
```

### Backports management
Packages from backports repository can be quickly into Yunohost `test` repository.
To do so, you need to add the package name into the `/var/www/repo.yunohost.org/test/conf/list` file and type in the following command:
```bash
$ reprepro -V -b /var/www/repo.yunohost.org/test update megusta
```
Now packages will be downloaded and added to `test` repository.
