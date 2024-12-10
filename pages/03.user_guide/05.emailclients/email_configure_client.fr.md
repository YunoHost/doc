---
title: Configurer un client email
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_configure_client'
---

Vous pouvez récupérer et envoyer des emails avec votre instance YunoHost grâce à des logiciels comme Thunderbird Desktop, ou sur votre smartphone grâce à des applications comme K-9 Mail.

Normalement, votre client email devrait recevoir la configuration automatiquement lorsque vous ajoutez un compte. Si cela ne fonctionne pas, il est possible de le faire manuellement en suivant les quelques étapes suivantes. (Cependant, cela devrait être compris comme étant un bug dans YunoHost, et le cas échéant, c'est cool si vous nous notifiez du problème pour que nous puissions tenter de le reproduire et corriger !)

### Réglages génériques

Voici les éléments que vous devrez entrer pour configurer manuellement votre client email (`votre.domaine.tld` fait référence à ce qui est après le @ dans votre adresse email, et `nom_utilisateur` ce qui est avant @).

| Protocole | Port | Chiffrement | Authentification    | Login                                         |
| :--:      | :-:  | :--:        | :--:                | :--:                                          |
| IMAP      | 993  | SSL/TLS     | Mot de passe normal | `nom_utilisateur` (sans `@votre.domaine.tld`) |
| SMTP      | 587  | STARTTLS    | Mot de passe normal | `nom_utilisateur` (sans `@votre.domaine.tld`) |

### Client par client

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Mozilla Thunderbird"]

#### ![](image://thunderbird.png?resize=50&classes=inline) Configurer Thunderbird Desktop

Pour configurer manuellement un nouveau compte dans Thunderbird Desktop commencez par remplir les informations de base (nom, adresse et mot de passe), cliquez sur Continuer puis Configuration Manuelle. Enlevez le `.` avant le nom de domaine. Sélectionnez le port 993 avec SSL/TLS pour IMAP, et le port 587 avec STARTTLS pour SMTP. Sélectionnez 'Mot de passe normal' pour l'authentification. Testez la configuration puis validez (il vous faudra ensuite peut-être accepter des certificats pour que tout fonctionne correctement).

![](image://thunderbird_config_1.png?resize=900)
![](image://thunderbird_config_2.png?resize=900)

- [Gérer les alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

[/ui-tab]

[ui-tab title="K-9 Mail"]

#### ![](image://k9mail.png?resize=50&classes=inline) Configurer K-9 Mail / Thunderbird Mobile (sur Android)

Suivez les instructions suivantes (comme pour Thunderbird Desktop, il vous faudra peut-être accepter des certificats à un moment).

![](image://thunderbird_mobile_config_1.png?resize=280&classes=inline)
![](image://thunderbird_mobile_config_2.png?resize=280&classes=inline)
![](image:/thunderbird_mobile_config_3.png?resize=280&classes=inline)

[/ui-tab]

[ui-tab title="Dekko"]

#### ![](image://dekko-app.png?resize=50&classes=inline) Configurer Dekko (sur Ubuntu Touch)

La première fois, vous pouvez simplement choisir « Ajouter un compte ». Si vous avez déjà un compte configuré, appuyez sur le menu hamburger puis sur le rouage, choisissez Courrier, Comptes et appuyez sur le symbole '+'.

Sélectionnez ensuite IMAP. Remplissez les champs et appuyez sur Suivant. Dekko va ensuite chercher la configuration. Vérifiez que tous les champs sont corrects. Assurez-vous d'avoir votre nom d'utilisateur YunoHost, PAS votre adresse email, et choisissez « Autoriser les certificats non fiables ». Faites ceci pour IMAP et SMTP et appuyez sur Suivant. Dekko va ensuite synchroniser le compte, après quoi vous aurez terminé. Félicitations !

![](image://dekko_config_1.png?resize=280&classes=inline)
![](image://dekko_config_2.png?resize=280&classes=inline)
![](image://dekko_config_3.png?resize=280&classes=inline)
![](image://dekko_config_4.png?resize=280&classes=inline)
[/ui-tab]
[/ui-tabs]
