# YunoHost Debian Packages

## Architecture

Yunohost packages are located on the yunohost.org workstation, in the `/home/yunohost/packages.git` folder.

Build system is based on debuild and pbuilder. It will generate a chroot, embedding every dependencies and Debian build tools.

Configuration is defined in the `/etc/pbuilder/megusta-amd64` file and allows to make packages without any specific architecture. 

<div class="alert alert-info">
**Caution:** be advised not to be logged in as "root" to execute the following commands (except those starting with `sudo`).
</div>

## Package update
#### Packages with external sources
Packages based on GitHub sources (moulinette, moulinette-yunohost, ssowat, et yunohost-admin) require the latest modifications:

```bash
[yunohost@yunohost] ~/packages.git/moulinette $ cd src
[yunohost@yunohost] ~/packages.git/moulinette/src $ git pull
```

Then, start package build (**caution: you need to be located in the package root folder**):

```bash
[yunohost@yunohost] ~/packages.git/moulinette/src $ cd ..
[yunohost@yunohost] ~/packages.git/moulinette $ commit-and-build "Message de commit"
```

---

#### Configuration Packages 
To update a yunohost-config-* package, move to the root folder, make your changes (for example: change a `debian/postinst` script), and type in the same command as for packages with sources:

```bash
[yunohost@yunohost] ~/packages.git/yunohost-config-nginx $ commit-and-build "Commit message"
```

The build command will update the Debian changelog (`debian/changelog`) and start the package creation. Once created, it will automatically added in the repository test`.

---

#### Update in a production environment
To add a package in the `megusta` (stable) (`debian/changelog`):

```bash
[yunohost@yunohost] ~/packages.git/monpaquet $ commit-and-build "Commit message" production
```

Once modifications are applied, you may execute `git push` to send your modifications to GitHub.

## Add a package to a repository manually
You can add Debian packages into the repository. NodeJS package is an example.

```bash
sudo reprepro -Vb /var/www/repo.yunohost.org/ includedeb repository_name package_name.deb
```

`repository_name` may be `test` or `megusta`.

## Delete a package from a repository
Delete a Debian package from a repository in order to empty the test repository for example:

```bash
sudo reprepro -Vb /var/www/repo.yunohost.org/ includedeb repository_name package_name
```
 
## TODO 
Modify commit-build script to retrieve git commit messages and generate Debian changelog with `git-dch` command.