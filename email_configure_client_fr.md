## Configuration desktop email client

Vous pouvez récupérer et envoyer des emails avec votre instance YunoHost grâce à des logiciels comme Mozilla Thunderbird, ou sur votre smartphone grâce à des applications comme K-9 Mail.

##### Réglages génériques

| Protocole | Port | Chiffrement | Authentification    | Login                                   |
| :--:      | :-:  | :--:        | :--:                | :--:                                    | 
| IMAP      | 993  | SSL/TLS     | Mot de passe normal | `nom_dutilisateur` (sans `@domain.tld`) |
| SMTP      | 587  | STARTTLS    | Mot de passe normal | `nom_dutilisateur` (sans `@domain.tld`) |

### <img src="images/thunderbird.png" width=50> Configurer Mozilla Thunderbird

L'outil de détection automatique de Thunderbird ne fonctionne actuellement pas avec YunoHost. Il vous faudra remplir les champs manuellement. Commencez par remplir les informations de base (Nom, adresse et mot de passe), cliquez sur Continuer puis Configuration Manuelle. Enlevez le `.` avant le nom de domaine. Sélectionnez le port 993 avec SSL/TLS pour IMAP, et le port 586 avec STARTTLS pour SMTP. Sélectionnez 'Mot de passe normal' pour l'authentification. Testez la configuration puis validez. (Il vous faudra ensuite possiblement accepter des certificats pour que tout fonctionne correctement.)

<img src="/images/thunderbird_config_1.png" width=900>
<img src="/images/thunderbird_config_2.png" width=900>

* [Gérer les alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

### <img src="images/k9mail.png" width=50> Configurer K-9 Mail (sur Android)

Suivez les instructions suivantes. (Comme pour Thunderbird, il vous faudra peut-être accepter des certificats à un moment)

<a href="/images/k9mail_config_1.png"><img src="/images/k9mail_config_1.png" width=200/></a>
<a href="/images/k9mail_config_2.png"><img src="/images/k9mail_config_2.png" width=200/></a>
<a href="/images/k9mail_config_3.png"><img src="/images/k9mail_config_3.png" width=200/></a>
<a href="/images/k9mail_config_4.png"><img src="/images/k9mail_config_4.png" width=200/></a>
