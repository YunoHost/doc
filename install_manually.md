# Install YunoHost manually

Once you have access to your server, either directly or by SSH, you can install YunoHost using the install script.

<div class="alert alert-info">
<b>Note:</b> The configuration of your services will be overridden, it is thus recommended to install YunoHost on a newly installed Debian system.
</div>

1. Install git
```bash
sudo apt-get install git sudo
```

2. Clone the Yunohost install script repository
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. Execute the installation script
```bash
cd /tmp/install_script && sudo ./install_yunohostv2
```

<br>

<p class="text-center">
<img src="https://yunohost.org/images/install_script.png">
</p>

---

*Once the installation is finished, you may want to proceed to post-installation: **[yunohost.org/postinstall](/postinstall)** *
