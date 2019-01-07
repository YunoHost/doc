# Administration depuis l’API ou une application externe

Toutes les actions exécutables en ligne de commande le sont également via une API. L’API est accessible à l’adresse https://votre.serveur/yunohost/api.
Pour le moment, il n'existe pas de documentation des différentes routes ... mais
vous pouvez trouver l'actionmap [ici](https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/actionsmap/yunohost.yml) (en particulier les clefs `api`)

## Avec `curl`

Il faut d’abord récupérer un cookie de connexion pour ensuite réaliser les actions. Voici un exemple via curl :

```bash
# Login (avec mot de passe admin)
curl -k -H "X-Requested-With: customscript" \
        -d "password=supersecretpassword" \
        -dump-header headers \
        https://your.server/yunohost/api/login

# Example de GET
curl -k -i -H "Accept: application/json" \
           -H "Content-Type: application/json" \
           -L -b headers -X GET https://your.server/yunohost/api/ROUTE \
        | grep } | python -mjson.tool
```

# Avec une classe PHP

Pour simplifier l’administration à distance d’une instance YunoHost dans le cadre d’un projet CHATONS/Librehosters, des classes API ont été développées par des utilisateurs.

Par exemple, cette [classe PHP](https://github.com/scith/yunohost-api-php) vous permettra d’administrer votre instance YunoHost depuis une application PHP (site web, outil de gestion de capacité…).

Voici un exemple de code PHP permettant d’ajouter un utilisateur dans votre instance YunoHost :

```php
require("ynh_api.class.php");
$ynh = new YNH_API("adresse IP du serveur YunoHost ou nom d’hôte", "mot de passe administrateur");

if ($ynh->login()) {
    $domains = $ynh->get("/domains");
    $first_domain = $domains['domains'][0];

    $arguments = array(
        'username' => 'test',
        'password' => 'yunohost', 
        'firstname' => 'Prénom',
        'lastname' => 'Nom',
        'mail' => 'test@'.$first_domain,
        'mailbox_quota' => '500M'
    );

    $user_add = $ynh->post("/users", $arguments);
    print_r($user_add);

} else {
    print("Login to YunoHost failed.\n");
    exit;
}
```

