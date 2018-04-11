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

Pour le mot de passe: il faut saisir le mot de passe de l'utilisateur yunohost. 
Pour l'identifiant: il faut saisir le nom de l'utilisateur yunohost.

Note : si votre instance Yunohost gère plusieurs noms de domaine, il faut utiliser celui définit comme "nom de domaine par défaut" dans l'interface de gestion des noms de domaines. Et ce, même si le domaine de votre adresse mail en est un autre.


* [Gestion des alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

#### Pour Android
L’application [K-9 Mail](https://github.com/k9mail) fonctionne.


#### Pour Firefox OS

Testé avec Firefox OS 2.6.
Sur la page d’accueil, entrez votre nom d’utilisateur et l’adresse email, puis allez dans la configuration manuelle :

<a href="/images/ffos_email_config_home_screen_empty.png"><img src="/images/ffos_email_config_home_screen_empty.png" width=200/></a> <a href="/images/ffos_email_config_home_screen_fill.png"><img src="/images/ffos_email_config_home_screen_fill.png" width=200/></a>

Configurer manuellement le formulaire comme indiqué sur les captures d’écran suivantes :

<a href="/images/ffos_email_config_manual_conf_empty.png"><img src="/images/ffos_email_config_manual_conf_empty.png" width=200/></a> <a href="/images/ffos_email_config_manual_conf_fill.png"><img src="/images/ffos_email_config_manual_conf_fill.png" width=200/></a>


<a href="/images/ffos_email_config_manual_conf_2_empty.png"><img src="/images/ffos_email_config_manual_conf_2_empty.png" width=200/></a> <a href="/images/ffos_email_config_manual_conf_2_fill.png"><img src="/images/ffos_email_config_manual_conf_2_fill.png" width=200/></a>
