# Install YunoHost manually

Once you have access to your server, either directly or by SSH, you can install YunoHost using the install script.

<div class="alert alert-info">
**Note:** The configuration of your services will be overridden, it is thus recommended to install YunoHost on a newly installed Debian system.
</div>

1. Install git
```bash
sudo apt-get install git
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

<img src="https://yunohost.org/images/install_script.png">

*Once the installation is finished, you may want to go to the configuration step:*

**[yunohost.org/postinstall](/postinstall)**