---
title: squid3
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_squid3'
---

[![Installer squid3 avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=squid3) [![Integration level](https://dash.yunohost.org/integration/squid3.svg)](https://dash.yunohost.org/appci/app/squid3)

*squid3* est un proxy de mise en cache pour le Web prenant en charge HTTP, HTTPS, FTP, etc. Il réduit la bande passante et améliore les temps de réponse en mettant en cache et en réutilisant les pages Web fréquemment demandées. Squid dispose de contrôles d'accès étendus et constitue un excellent accélérateur de serveur.

### Avertissements / informations importantes

### Instruction

1. L'application ne peut pas être **multi-instance** (ne peut pas être installée plusieurs fois sur le même serveur).
2. **LDAP** est présent (les utilisateurs enregistrés peuvent utiliser leur nom d'utilisateur et leur mot de passe pour naviguer sur Internet via le proxy).
3. Le **numéro de port** utilisé par le proxy sera envoyé à la **messagerie administrative** du serveur Yunohost.
4. Le nom d'utilisateur et le mot de passe sont **demandés deux fois** la première fois que vous démarrez le navigateur (je n'ai aucune idée pourquoi cela se produit).

### Configurer Squid3 pour Firefox

1. Allez dans **Préférences -> Général -> proxy réseau**.
1. Sélectionnez **Configuration manuelle du proxy**.
1. Dans **HTTP Proxy**, entrez votre **nom de domaine ou IP de serveur** et dans **Port**, entrez le port envoyé à votre **admin email**.
1. Cochez **Utiliser ce serveur proxy pour tous les protocoles**.
1. Sous **No Proxy for**, entrez ce **localhost, 127.0.0.1**.
1. **Sauvergarder et redémarrer** Firefox.

Si vous essayez Squid 3 d'une autre manière, veuillez écrire l'instruction dans l'issue afin que je puisse l'ajouter au readme.

### Remerciements particuliers
Merci à **Fred** d'avoir écrit l'instruction pour configurer Squid pour YunoHost. Français : https://memo-linux.com/installer-squid3-sur-un-serveur-yunohost/

## Liens utiles

+ Site web : [squid-cache.org](http://www.squid-cache.org/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/squid3](https://github.com/YunoHost-Apps/squid3_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/squid3/issues](https://github.com/YunoHost-Apps/squid3_ynh/issues)
