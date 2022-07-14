# Configuration DNS automatique

Pour configurer la gestion automatique de la configuration DNS lorsque vous avez acheté votre nom de domaine chez OVH, votre instance Yunohost a besoin de 4 informations à entrer lorsque vous utiliserez la commande `yunohost domain registrar set domain.tld ovh`: 
- `auth_entrypoint`
- `auth_application_key`
- `auth_application_secret`
- `auth_consumer_key`

La première, `auth_entrypoint`, vaut `ovh-eu`.

Pour les trois autres informations, elles sont à récupérer en suivant les instructions ci-dessous:
- Aller sur https://eu.api.ovh.com/createToken/
- Vous arrivez ensuite sur un formulaire à remplir comme indiqué ci-dessous :
    - Account ID or email address : Entrer votre adresse e-mail ou votre identifiant client OVH
    - Password : Mot de passe
    - Script Name: Entrer `Yunohost`
    - Script description: Entrer `My self-hosting   solution`
    - Validity : Sélectrionner `Unlimited`
    - Rights : Entrer les quatre lignes suivantes   (Appuyer sur le bouton `+` pour ajouter des   lignes ) :
        - GET : /domain/zone/\*
        - POST : /domain/zone/\*
        - PUT : /domain/zone/\*
        - DELETE : /domain/zone/\*/record/\*
    - Vous arrivez sur une page qui vous donne les information recherchés

![Formulaire à remplir](image://ovh-keys-ask.png)

![Clés recherchées](image://ovh-keys.png)

