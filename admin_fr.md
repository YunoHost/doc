# L’interface d’administration web

YunoHost est fourni avec une interface graphique d’administration. L’autre méthode est d’utiliser la [ligne de commande](/commandline_fr).

### Accès

L’interface admin est accessible depuis votre instance YunoHost à l’adresse https://exemple.org/yunohost/admin (remplacez exemple.org par la bonne valeur)

<div class="text-center" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">
<img src="/images/webadmin_fr.png" style="max-width:100%;">
</div>


### Réinitialiser le mot de passe administrateur

Pour réinitialiser le mot de passe administrateur de YunoHost (à partir de l'utilisateur root) :

```bash
$ yunohost-reset-ldap-password
```

Un mot de passe temporaire sera créé, que vous pouvez utiliser pour ensuite définir un nouveau mot de passe.


### Comment déplacer le dossier d’une application

Pour changer le dossier contenant une application, seules quelques commandes sont nécessaires : déplacer le contenu, créer un lien symbolique et définir les droits d’accès.

Exemple avec WordPress :
```bash
# Deplacement du wordpress vers un autre support
$ sudo  mv /var/www/wordpress /mon/dossier/cible
# Création du lien symbolique
$ sudo ln -s /media/disqueexterne/wordpress /var/www/wordpress
# Le répertoire doit appartenir à www-data
sudo chown -R www-data:www-data /media/externalharddrive/wordpress
```
