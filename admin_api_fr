# Administration depuis l’API ou une application externe

Toutes les actions exécutables en ligne de commande le sont également via une API.

L’API utilise l’adresse https://VOTRESERVEUR/yunohost/api et toutes les actions sont détaillées sur cette page.

Il faut d’abord récupérer un cookie de connexion pour ensuite réaliser les actions. Voici un exemple via curl :
```bash
    Login (avec mot de passe admin): curl -k -d “password=XXX” –dump-header headers https://VOTRESERVEUR/yunohost/api/login
    GET: curl -k -i -H “Accept: application/json” -H “Content-Type: application/json” -L -b headers -X GET https://VOTRESERVEUR/yunohost/api/ROUTE | grep }| python -mjson.tool
```
Pour simplifier l’administration à distance d’une instance YunoHost dans le cadre d’un projet CHATONS, des classes API ont été développées par des utilisateurs.

Par exemple, cette classe PHP vous permettra d’administrer votre instance YunoHost depuis une application PHP (site web, outil de gestion de capacité…).

Voici un exemple de code PHP permettant d’ajouter un utilisateur dans votre instance YunoHost :

```bash 
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
