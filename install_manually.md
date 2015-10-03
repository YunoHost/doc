# Install YunoHost manually

Once you have access to your server, either directly or by SSH, you can install YunoHost using the install script.

<div class="alert alert-info">
<b>Note:</b> The configuration of your services will be overridden, it is thus recommended to install YunoHost on a newly installed Debian system.
</div>

1. Install git
```bash
sudo apt-get install git
```

2. Clone the Yunohost install script repository
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. The root user must have a password set, if it isn't the case, set it (whithout the install script failed):
```bash
sudo passwd root
```

4. Execute the installation script
```bash
cd /tmp/install_script && sudo ./install_yunohostv2
```

<br>

<p class="text-center">
<img src="https://yunohost.org/images/install_script.png">
</p>

<br>

<div class="alert alert-warning">
<b>Warning:</b> Apache could already be installed by default on your dedicated server. If it's the case the installation script will fail since YunoHost is using Nginx. You will have to remove *apache2.2* package with the command: ``sudo apt-get autoremove apache2.2`` and execute the script again.
</div>

---

*Once the installation is finished, you may want to proceed to post-installation: **[yunohost.org/postinstall](/postinstall)** *