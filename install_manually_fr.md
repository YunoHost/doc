# Installer YunoHost manuellement

Une fois que vous avez accès à votre serveur, directement ou par SSH, vous pouvez installer YunoHost avec le script d’installation.

<div class="alert alert-info">
<b>Note :</b> La configuration des services sera écrasée, il est donc recommandé d’installer YunoHost sur un système Debian nouvellement installé.
</div>

1. Installez git
```bash
sudo apt-get install git
```

2. Clonez le dépôt du script d’installation de YunoHost
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. L'utilisateur root doit avoir un mot de passe, si ce n'est pas le cas, créez en un (sinon le script d'installation échoue):
```bash
sudo passwd root
```

4. Lancez le script d’installation
```bash
cd /tmp/install_script && sudo ./install_yunohostv2
```

<br>

<p class="text-center">
<img src="https://yunohost.org/images/install_script.png">
</p>

<br>

<div class="alert alert-warning">
<b>Attention :</b> il se peut qu’Apache soit déjà installé par défaut sur votre serveur dédié. Si c’est le cas, le script d’installation échouera vu que YunoHost utilise Nginx. Vous aurez à désinstaller le paquet *apache2.2* avec la commande : ``sudo apt-get autoremove apache2.2`` et relancer le script.
</div>

---

*Une fois l’installation terminée, vous pouvez procéder à la post-installation : **[yunohost.org/postinstall](/postinstall_fr)** *
