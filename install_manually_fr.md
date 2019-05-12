# Installer YunoHost manuellement

Une fois que vous avez accès à votre serveur (directement ou par SSH), vous pouvez installer YunoHost en exécutant cette commande en tant que root :

```bash
curl https://install.yunohost.org | bash
```

<small>*(Si `curl` n'est pas installé sur votre système, il vous faudra peut-être l'installer avec `apt install curl`. Autrement, si la commande n'affiche rien du tout, vous pouvez tenter `apt install ca-certificates`)*</small>

Une fois l'installation terminée, il vous faudra [**procéder à la post-installation**](/postinstall)

---

**Note pour les utilisateurs avancés inquiets à propos de l'approche `curl|bash`**

Si vous êtes suspicieux de la tendance à utiliser `curl|bash` (ou commandes similaires) pour déployer des logiciels, prenez le temps de lire ["Is curl|bash insecure?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) sur le blog de Sandstom, et possiblement [cette discussion sur Hacker News](https://news.ycombinator.com/item?id=12766350).

