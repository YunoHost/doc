---
title: Configurer un relais SMTP
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_configure_relay'
  aliases: 
    - '/smtp_relay'
---

Si votre fournisseur d'accès à Internet bloque le port 25, ou si vous rencontrez un problème d’utilisation du serveur SMTP natif de YunoHost, vous pouvez configurer votre serveur YunoHost pour utiliser un relais SMTP.

## Qu'est-ce qu'un relais SMTP

C'est un serveur SMTP tiers qui va envoyer les e-mails aux destinataires à la place de votre propre serveur SMTP.
Une fois correctement installé, le fonctionnement est transparent pour l’utilisateur. Vos correspondants verront vos e-mails comme s’ils venaient de votre propre serveur, mais ils seront passés par le relais SMTP que vous aurez choisis et configurés.

## [fa=exclamation-triangle /] Inconvénients des relais SMTP

Il est important de noter que dans le monde de l'auto-hébergement, utiliser un relais SMTP est un énorme compromis ! En effet, le relais SMTP sera non seulement capable d'envoyer les e-mails de votre part, mais il a également accès au contenu intégral de vos e-mails et peut éventuellement les modifier (Par exemple, par défaut, MailJet réécrit les hyperliens html contenus dans vos mails, afin de traquer l'activité de vos correspondants). Il faut également savoir qu'une fois mis en place, tout le trafic e-mail sortant de votre serveur passera par ce relais ; il n'est pas possible de choisir de l'utiliser ou pas selon l'expéditeur ou la destination.

Au-delà des considérations de confidentialité ci-dessus, un relais SMTP peut imposer des limitations techniques que l'on n'aurait pas si le port 25 était ouvert. Par exemple, avec la plupart des relais, si un utilisateur de votre serveur YunoHost déclare **une "adresse de transfert" extérieure** dans le but de transférer automatiquement les messages reçus sur votre serveur YunoHost vers une autre boîte mail, **ce transfert ne fonctionnera pas** pour les courriels venant de l'extérieur de votre serveur, sans qu'il soit en averti. En effet, les relais exigent généralement que les messages qu'ils transmettent aient une adresse d'expéditeur de votre domaine (pour lutter contre le spam et préserver la réputation de leurs services), ce qui n'est pas le cas pour un "forward automatique" où l'expéditeur originel du mail est conservé ; le message est alors bloqué par le relais (qui, normalement, prévient votre admin YunoHost, mais seulement après coup).

## Comment utiliser un relais SMTP avec YunoHost ?

YunoHost supporte depuis la version 4.1 la configuration d'un relais SMTP. Pour le moment cette fonctionnalité n'est pas accessible depuis l'interface d'administration : le paramétrage doit être fait en ligne de commande.

### Étape 1 : S'inscrire chez un fournisseur de relais SMTP

Beaucoup de fournisseurs existent dans ce domaine. Certains sont gratuits et d'autres proposent des services payants contre différentes options. Comme écrit plus haut, vous devez être sûr de pouvoir lui faire confiance, mais cela reste à votre entier égard.

### Étape 2 : Paramétrer sa zone DNS correctement

Une fois inscrit, le paramétrage du relais SMTP demande de modifier la zone DNS de votre domaine. La procédure standard consiste à ajouter une clé DKIM, et SPF à la zone DNS. Les paramètres à modifier dépendent du fournisseur que vous aurez choisi.

Habituellement les fournisseurs ont une documentation à ce sujet.

! [fa=exclamation-triangle /] Attention une fois la zone DNS enregistrée, le relais SMTP peut envoyer des e-mails à votre nom sans que vous ne le sachiez

### Étape 3 : Configurer YunoHost correctement

Il est possible de configurer soit via la webadmin ou en ligne de commande.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Depuis la webadmin"]
Depuis l'interface d'administration, dans la section `Outils` > `Paramètres de YunoHost`, et l'onglet `Email`.
Il suffit d'activer l'option, et de renseigner les champs nécessaires :

- **Adresse du relais SMTP** : L'url pour le serveur SMTP.
- **Port du relais SMTP** : Le port utilisé sur le serveur renseigné.
- **Utilisateur du relais SMTP** : Login ou mail d'identification pour le serveur.
- **Mot de passe du relais SMTP** : Tout simplement le mot de passe.

! [fa=exclamation-triangle /] Les mots de passe avec le caractère `#` ne fonctionneront pas proprement à cause d'une limitation de postfix (d'autres caractères sont peut-être interdit, n'hésitez pas à rapporter ce genre de cas pour la mise à jour de cette doc).

![Option-Relais-Smtp](/img/relay_smtp_option_webadmin_en.png?resize=800)

[/ui-tab]
[ui-tab title="En ligne de commande"]
Pour que YunoHost soit capable d'utiliser le relais, il faut paramétrer 4 choses.

1. Votre url de relais SMTP (on utilisera `smtprelay.tld`).
2. Le port sur lequel on accède au relais (on utilisera le port 2525 ci-dessous)
3. Votre nom d'utilisateur SMTP (on utilisera `username`).
4. Votre mot de passe SMTP (on utilisera `password`).

! [fa=exclamation-triangle /] Les mots de passe avec le caractère `#` ne fonctionneront pas proprement à cause d'une limitation de postfix (d'autres caractères sont peut-être interdit, n'hésitez pas à rapporter ce genre de cas pour la mise à jour de cette doc).

Le fournisseur SMTP vous fournit ces trois informations.

Premièrement se connecter sur son serveur en SSH avec la commande :

```bash
ssh admin@domain.tld
```

Ensuite, mettre à jour les informations suivantes :

```bash
sudo yunohost settings set email.smtp.smtp_relay_enabled -v yes
sudo yunohost settings set smtp.relay.host -v smtprelay.tld
sudo yunohost settings set smtp.relay.port -v 2525
sudo yunohost settings set smtp.relay.user -v username
sudo yunohost settings set smtp.relay.password -v password
```

C'est une bonne idée de confirmer les informations en faisant `sudo yunohost settings list`

[/ui-tab] [/ui-tabs]

Votre relais SMTP est maintenant configuré !

! [fa=exclamation-triangle /] Maintenant le relais SMTP est capable de lire et d'utiliser toutes les informations contenues dans les emails que vous envoyez sans votre accord. Mais il ne sera pas capable de lire les informations des emails que vous recevez.

#### Relayer tous les emails même ceux des noms de domaines gérés par YunoHost

Si vous avez une grande confiance dans votre relais SMTP, que vous avez un second serveur IMAP que vous souhaitez ou êtes contraint d'utiliser en lieu et place de celui de YunoHost, vous pouvez choisir de relayer tous les emails même ceux des noms de domaines gérés par YunoHost en commentant les deux ligne suivantes dans `/etc/postfix/main.cf` :

```text
#virtual_mailbox_domains = ldap:/etc/postfix/ldap-domains.cf
#virtual_alias_maps = ldap:/etc/postfix/ldap-aliases.cf,ldap:/etc/postfix/ldap-groups.cf
```

### Étape 4 : Vérifier la configuration

Vous pouvez vérifier vos paramètres en envoyant un mail et voir si cela fonctionne. Certains relais SMTP vous confirment l'e-mail envoyé. Bien sur vous pouvez vérifier sur mail-tester.com pour prendre connaissance d’éventuelles problèmes.
