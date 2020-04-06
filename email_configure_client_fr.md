## Configurer un client mail

Vous pouvez récupérer et envoyer des emails avec votre instance YunoHost grâce à des logiciels comme Mozilla Thunderbird, ou sur votre smartphone grâce à des applications comme K-9 Mail.

Normalement, votre client mail devrait recevoir la configuration automatiquement lorsque vous ajoutez un compte. Si cela ne fonctionne pas, il est possible de le faire manuellement en suivant les quelques étapes suivantes. (Cependant, cela devrait être compris comme étant un bug dans YunoHost, et le cas échéant, c'est cool si vous nous notifiez du problème pour que nous puissions tenter de reproduire et corriger le problème !)

### Réglages génériques

Voici les éléments que vous devrez entrer pour configurer manuellement votre client mail (`domain.tld` fait référence à ce qui est après le @ dans votre adresse mail, et `nom_dutilisateur` ce qui est avant @).

| Protocole | Port | Chiffrement | Authentification    | Login                                   |
| :--:      | :-:  | :--:        | :--:                | :--:                                    | 
| IMAP      | 993  | SSL/TLS     | Mot de passe normal | `nom_dutilisateur` (sans `@domain.tld`) |
| SMTP      | 587  | STARTTLS    | Mot de passe normal | `nom_dutilisateur` (sans `@domain.tld`) |

### <img src="images/thunderbird.png" width=50> Configurer Mozilla Thunderbird

Pour configurer manuellement un nouveau compte dans Thunderbird commencez par remplir les informations de base (Nom, adresse et mot de passe), cliquez sur Continuer puis Configuration Manuelle. Enlevez le `.` avant le nom de domaine. Sélectionnez le port 993 avec SSL/TLS pour IMAP, et le port 587 avec STARTTLS pour SMTP. Sélectionnez 'Mot de passe normal' pour l'authentification. Testez la configuration puis validez. (Il vous faudra ensuite possiblement accepter des certificats pour que tout fonctionne correctement.)

<img src="/images/thunderbird_config_1.png" width=900>
<img src="/images/thunderbird_config_2.png" width=900>

* [Gérer les alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

### <img src="images/k9mail.png" width=50> Configurer K-9 Mail (sur Android)

Suivez les instructions suivantes. (Comme pour Thunderbird, il vous faudra peut-être accepter des certificats à un moment)

<a href="/images/k9mail_config_1.png"><img src="/images/k9mail_config_1.png" width=200/></a>
<a href="/images/k9mail_config_2.png"><img src="/images/k9mail_config_2.png" width=200/></a>
<a href="/images/k9mail_config_3.png"><img src="/images/k9mail_config_3.png" width=200/></a>
<a href="/images/k9mail_config_4.png"><img src="/images/k9mail_config_4.png" width=200/></a>

### <img src="images/dekko-app.png" width=50> Configure Dekko (on Ubuntu Touch)

La première fois, vous pouvez simplement choisir "Ajouter un compte". Si vous avez déjà un compte configuré, appuyez sur le menu hamburger puis sur le rouage, choisissez Courrier, Comptes et appuyez sur le symbole " + ".

Sélectionnez ensuite IMAP. Remplissez les champs et appuyez sur Suivant. Dekko va ensuite chercher la configuration. Vérifiez que tous les champs sont corrects. Assurez-vous d'avoir votre nom d'utilisateur yunohost, PAS votre adresse e-mail et choisissez "Autoriser les certificats non fiables". Faites ceci pour IMAP et SMTP et appuyez sur Suivant. Dekko va ensuite synchroniser le compte après quoi vous aurez terminé. Félicitations !

<a href="/images/dekko_config_1.png"><img src="/images/dekko_config_1.png" width=200/></a>
<a href="/images/dekko_config_2.png"><img src="/images/dekko_config_2.png" width=200/></a>
<a href="/images/dekko_config_3.png"><img src="/images/dekko_config_3.png" width=200/></a>
<a href="/images/dekko_config_4.png"><img src="/images/dekko_config_4.png" width=200/></a>
