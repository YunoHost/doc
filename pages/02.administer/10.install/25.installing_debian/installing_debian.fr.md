---
title: Installer Debian pour Yunohost
template: docs
taxonomy:
    category: docs
routes:
    default: '/installing_debian'
---

Si vous ne parvenez pas à installer YunoHost avec succès, vous avez toujours la possibilité d'installer Debian puis d'installer YunoHost par dessus.

## Quelle version de Debian

Au moment de la rédaction de cet article, seule Debian 11 est prise en charge par YunoHost. N'utilisez pas Debian 12.

## Avant de commencer

L'installateur Debian n'est pas l'installateur Linux le plus simple, surtout pour les débutants. Il sera plus facile de **formater le disque dur** que vous prévoyez d'utiliser pour Debian+YunoHost **avant d'installer Debian**, en utilisant l'utilitaire de disque de votre choix.

## Installer Debian

### Démarrer l'installateur

Ce guide n'entrera pas dans les détails sur la façon de démarrer l'installateur Debian. Vous pouvez utiliser la documentation de Debian pour cela. En bref, vous devrez flasher une clé USB avec l'image Debian 11, comme vous le feriez avec l'image YunoHost.

### Installation

En général, vous pouvez simplement suivre les instructions à l'écran et utiliser les valeurs par défaut suggérées.

L'installateur Debian demandera un **nom d'hôte** et un **nom de domaine**. Vous pouvez utiliser `yunohost` et `yunohost.local`. Ce n'est pas vraiment important puisque l'installateur YunoHost les écrasera de toute façon.

Debian demandera un **mot de passe root**. Assurez-vous de choisir un **mot de passe très long et complexe** et de l'enregistrer dans le gestionnaire de mots de passe de votre choix (Bitwarden, Firefox, etc…) ou de l'écrire dans un endroit sûr. N'oubliez pas qu'il s'agit d'un serveur qui sera disponible sur Internet, ce qui le rend vulnérable aux attaques éventuelles, vous devez donc être particulièrement prudent ici !

L'installateur demandera également un **compte utilisateur** et un autre mot de passe. **Important :** nommez-le d'une manière qui ne sera pas utilisée par votre serveur YunoHost plus tard. Par exemple, vous pouvez l'appeler « debian ». Assurez-vous également d'utiliser un mot de passe long et complexe.

Lorsque l'installateur vous demande où installer et comment **créer des partitions de disque**, sélectionnez l'option permettant d'utiliser l'intégralité du disque, à moins que vous ne sachiez ce que vous faites.

- Ne séparez pas les partitions /home, /var ou /tmp. Utilisez l'option permettant de « conserver tous les fichiers dans une seule partition ».
- Ne chiffrez aucune partition, [comme recommandé](https://yunohost.org/en/administer/install/hardware:regular#about-encryption)

Le programme d'installation vous posera des questions sur les **miroirs**. Sélectionnez un pays et un serveur proches de votre emplacement, ou utilisez les options par défaut.

Le programme d'installation vous demandera quel **environnement de bureau** vous souhaitez. Vous ne devez pas installer un environnement de bureau sur un serveur :

- Désélectionnez tous les environnements de bureau
- Gardez « Utilitaires système standard » coché

## Après l'installation de Debian

1. Retirez le support d'installation (débranchez la clé USB)
2. Redémarrez
3. Connectez-vous en tant que « root » avec le mot de passe long et complexe que vous avez créé précédemment.
4. Installez curl en tapant « apt install curl »
5. Procédez à l'installation de YunoHost sur Debian en suivant ces instructions : <https://yunohost.org/en/install/hardware:vps_debian>
- Le programme d'installation demandera l'autorisation d'écraser certains fichiers de configuration. Sélectionnez Oui.
