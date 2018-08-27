# Administrate YunoHost in command line

The command line interface (CLI) is, in the computer world, the original (and more technical) way of interacting with a computer compared to graphical interface. Command line interfaces are generally said to be more complete, powerful or efficient than a graphical interface, though it is more difficult to learn.

In the context of YunoHost, or system administration in general, the CLI is commonly used to remotely control machines after connecting through [connecting to it via SSH](/ssh).

<div class="alert alert-info" markdown="1">
Providing a full tutorial about the command line is quite beyond the scope of the YunoHost documentation : for this, consider reading a dedicated tutorial such as [this one](https://ryanstutorials.net/linuxtutorial/) or [this one](http://linuxcommand.org/). But be reassured that you don't need to be a CLI expert to start using it !
</div>

The `yunohost` command can be used to administrate your server and perform the various actions similarly to what you do on the webadmin. The command must be launched either from the `root` user or from the `admin` user by preceeding them with `sudo`. (ProTip™ : you can become `root` with the command `sudo su` as `admin`).

YunoHost commands usually have this kind of structure : 

```bash
yunohost app install wordpress --label Webmail
          ^    ^        ^             ^
          |    |        |             |
    category  action  argument      options
```

Don't hesitate to browse and ask for more information about a given category or action using the the `--help` option. For instance, those commands : 

```bash
yunohost --help
yunohost user --help
yunohost user create --help
```

will successively list all the categories available, then the actions available in the `user` category, then the usage of the action `user create`. You might notice that the YunoHost command tree is built with a structure similar to the YunoHost admin pages.
