# L’interface d’administration web

YunoHost est fourni avec une interface graphique d’administration. L’autre méthode est d’utiliser la [moulinette](/moulinette_fr) ligne de commande.

**Attention** : l’interface d’administration donne accès à beaucoup moins de fonctionnalités que la moulinette, car elle est en développement actif.

### Accès
L’interface admin est accessible depuis votre instance YunoHost à l’adresse https://exemple.org/yunohost/admin (remplacez exemple.org par la bonne valeur)

<div class="text-center" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">
<img src="/images/manage.png" style="max-width:100%;">
</div>

### Réinitialiser le mot de passe administrateur

<div class="text-error">Cette méthode ne fonctionnera pas avec Yunohost 2.4 / Debian Jessie</div>

Pour réinitialiser le mot de passe administrater de YunoHost (l’utilisateur root est nécessaire)

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

Une fois les lignes ajoutées (il faut probablement rédémarrer le service LDAP), vous devriez être en mesure de vous connecter avec le mot de passse temporaire. Changer le via l’interface. Retirer les lignes ajoutées dans le fichier `slapd.conf`.

### Comment déplacer le dossier d’une application

Pour changer le dossier contenant une application, seules quelques commandes sont nécessaires : déplacer le contenu créer un lien symbolique et définir les droits d’accès.

Exemple avec WordPress :
```bash
# Deplacement du wordpress vers un autre support
$ sudo  mv /var/www/wordpress /mon/dossier/cible
# Création du lien symbolique
$ sudo ln -s /media/disqueexterne/wordpress /var/www/wordpress
# Le répertoire doit appartenir à www-data
sudo chown -R www-data:www-data /media/externalharddrive/wordpress
```
