# Mise à jour en v2

Si vous disposez déjà d'une version de YunoHost antérieure à la RC (`beta2`, `beta3` ou `beta4`), mettez à jour votre système de la manière suivante :

## <small>1.</small> Système

Connectez-vous en SSH sur votre serveur, ou accédez-y directement, et exéctuez :

```bash
sudo apt-get update && sudo apt-get dist-upgrade
```

## <small>2.</small> Applications

Une fois votre système mis à jour, vous pouvez mettre à jour vos applications :

```bash
sudo yunohost app upgrade
```

**Attention** : Si vous aviez installé des applications non-officielle (autres que Roundcube, Jappix, Wordpress, TTRSS, Radicale, Agendav, Owncloud, PHPMyAdmin, Zerobin, Jirafeau ou Transmission), il faudra les mettre à jour manuellement (où les laisser telles quelles)

---

***Si vous avez besoin d'aide lors de ces étapes, n'hésitez pas à utiliser les différents [moyens de support](/support_fr).***
