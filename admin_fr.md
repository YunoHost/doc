# L’interface d’administration web

YunoHost est fourni avec une interface web d’administration. L’autre interface est la [moulinette](/moulinette_fr) en ligne de commande.

**Attention** : l’interface d’admininistration donne accès à beaucoup moins de fonctionnalités que la moulinette, car elle est actuellement en développement actif.

### Accès
L’interface admin est accessible depuis votre instance YunoHost à l’adresse https://example.org/yunohost/admin (remplacez example.org par la bonne valeur)

<div class="text-center" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">
<img src="https://yunohost.org/images/manage.png" style="max-width:100%;">
</div>

### Remise à zéro du mot de passe admin
Pour faire une remise à zéro du mot de passe admin de YunoHost (un utilisateur root est nécessaire)

Dans le fichier `/etc/slapd/slapd.conf` ajouter la ligne suivante :
```bash
rootdn "cn=admin,dc=yunohost,dc=org"
rootpw {SSHA}O4kkm2OkgO2DPrrnYXXXXXXXXXXXXXXX
```

avec le hash la dernière ligne de la commande
```bash
slappasswd -h {SSHA}
# Un mot de passe vous sera demandé, vous retournant un hash comme résultat
```

Une fois les lignes ajoutées (il faut probablement rédémarrer le service ldap), vous devriez être en mesure de vous connecter avec le mot de passse admin temporaire. Changer le via l’interface. Retirer les lignes ajoutées dans le fichier `slapd.conf`.

### Comment déplacer une application
Exemple avec WordPress :
```bash
# Deplacement du wordpress vers un autre support
$ sudo  mv /var/www/wordpress /media/disqueexterne 
# Creation du lien symbolique
$ sudo ln -s /media/disqueexterne/wordpress /var/www/wordpress
# Le répertoire doit appartenir à www-data
sudo chown -R www-data:www-data /media/externalharddrive/wordpress
```