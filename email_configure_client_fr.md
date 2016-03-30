## Configuration client email de bureau

*[Documentation en rapport avec l’email de YunoHost](/email_fr)*.

Il est possible d’accéder à ses emails grâce à un client lourd de messagerie électronique tel que Mozilla Thunderbird.

#### Prérequis
* Adresse email principale
* Mot de passe du compte utilisateur

#### Réglages génériques
| Protocole | Port | Chiffrement |
| :--: | :-: | :--: |
| IMAP | 993 | SSL/TLS |
| SMTP | 465 | SSL/TLS |

#### Mozilla Thunderbird
L’utilitaire de détection automatique de Thunderbird ne fonctionne pas avec le serveur email de YunoHost. Il faut donc passer en configuration manuelle. N’oubliez pas d’enlever le point devant le nom de domaine.

<img src="/images/thunderbird-config.png" width=900>

* [Gestion des alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

#### Pour Android
L’application [K-9 Mail](https://github.com/k9mail) fonctionne.