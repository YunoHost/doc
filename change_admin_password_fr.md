#Changer le mot de passe d’administration 

Pour des raisons de sécurité vous pouvez avoir besoin de changer votre mot de passe d’administration. Pour cela, deux méthodes sont possibles.

<div class="alert alert-warning">
<span class="glyphicon glyphicon-warning-sign"></span>
Le mot de passe d’administration actuel est **requis** pour effectuer cette modification.
</div>

##Administration web

Premièrement, connectez-vous à [l’administration web](/admin_fr).

Puis allez dans la section `Outils` > `Changer le mot de passe d’administration`.

##Ligne de commande

```bash
yunohost tools adminpw
```

Si vous avez oublié votre mot de passe, utilisez plutôt:

```bash
yunohost-reset-ldap-password
```
