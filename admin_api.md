# Administration from the API or an external application

All command line actions can also be ran from the web API. The API is available at https://your.server/yunohost/api. For now there's no documentation on the various routes ... but you can get an idea by looking at the actionmap [here](https://github.com/YunoHost/yunohost/blob/stretch-unstable/data/actionsmap/yunohost.yml) (in particular the `api` stuff).

## Using `curl`

You must first retrieve a login cookie to perform the actions. Here is an example via curl:

```bash
# Login (with admin password)
curl -k -H "X-Requested-With: customscript" \
        -d "password=supersecretpassword" \
        -dump-header headers \
        https://your.server/yunohost/api/login

# GET example
curl -k -i -H "Accept: application/json" \
           -H "Content-Type: application/json" \
           -L -b headers -X GET https://your.server/yunohost/api/ROUTE \
        | grep } | python -mjson.tool
```

## Using a PHP class

To simplify the remote administration of a YunoHost instance in CHATONS/Librehosters projects, API classes have been developed by users.

For example, this [PHP class](https://github.com/scith/yunohost-api-php) will allow you to administer your YunoHost instance from a PHP application (website, capacity management tool...).

Here is an example of PHP code to add a user to your YunoHost instance:

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
