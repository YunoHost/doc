# Continuous integration

A continuous integration server is available for any packager willing to test an app with [Package_check](https://github.com/YunoHost/package_check).

<a class="btn btn-lg btn-default" href="https://ci-apps-dev.yunohost.org">ci-apps-dev</a>

This server is free to use for any of you, you just need an account.  
To do so, ask to a member of the Apps group on our [Applications chatroom](/chat_rooms)

To create an account on this CI, you'll need two things:
- A name (To create an user and to give it a directory).
- A public ssh key (For your access to the server).

When that's done, you'll be able to access the server and put your apps on it.  
To connect to the server use:
```bash
ssh USER@ci-apps-dev.yunohost.org -i YOUR_PRIVATE_KEY
```

You will find an empty directory, ready to receive your apps.  
As soon as you push an app into your directory, in a 5 minutes maximum delay, a new job will be created for this app and executed by the CI.  
Each time you will update this app, a new test will be executed.

However, to prevent any security issues, your ssh connection will be very limited.  
You can only use `sftp` or `rsync` to copy your apps into that directory. `Git` isn't available, neither most of the usual bash commands.  
To ease your usage of this CI, a small script can be used to copy your apps to your directory.

Copy this [script](https://raw.githubusercontent.com/YunoHost/CI_package_check/master/dev_CI/Send%20CI%20dev.sh) into your usual working directory and fill it with your info.

Make sure the content of your `check_process` file is correct then transfer your files.
When your files have been transfered, you can monitor the CI pipeline on https://ci-apps-dev.yunohost.org.

---

# Other continuous integration servers

For your information, here the list of all our continuous integration servers.  
Those CI are automatic, you can't use them directly. They're working on their own.

- [Official CI](https://ci-apps.yunohost.org): Our official CI, working on a x86-64 system. It is in charge of determining levels for all working apps.
- [ARM CI](https://ci-apps-arm.yunohost.org): This CI is working with multiple Raspberry-Pi, own by members of the YunoHost community. Tests are running on Raspberry-Pi to determine if apps are working on this architecture.
- [Unstable/Testing CI](https://ci-apps-unstable.yunohost.org): CI designed to run tests on the branches Unstable and Testing of YunoHost. Its purpose is to test those branches before an official release.
- [Jessie CI](https://ci-stretch.nohost.me): CI running on a Debian Jessie system. This CI determine is apps are still working with the previous version of Debian and YunoHost before the version 3.
- [HQ CI](https://ci-apps-hq.yunohost.org): **Incoming...** This CI runs automatic tests on branches of High Quality apps. Except the master branch, which is exclude from this CI, all branches added to a High Quality app will be added to this CI to be tested.
