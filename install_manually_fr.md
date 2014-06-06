# Installer YunoHost manuellement

Une fois que vous avez accès à votre serveur, directement ou par SSH, vous pouvez installer YunoHost avec le script d'installation.

<div class="alert alert-info">
<b>Note :</b> La configuration des services sera écrasée, il est donc recommandé d'installer YunoHost sur un système Debian nouvellement installé.
</div>

1. Installez git
```bash
sudo apt-get install git
```

2. Clonez le dépôt du script d'installation de YunoHost
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. Lancez le script d'installation
```bash
cd /tmp/install_script && sudo ./install_yunohostv2
```

<br>

<p class="text-center">
<img src="https://yunohost.org/images/install_script.png">
</p>

---

*Une fois l'installation terminée, vous pouvez procéder à la post-installation : **[yunohost.org/postinstall](/postinstall_fr)** *