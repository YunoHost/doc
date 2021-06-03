---
title: Configurer un relais SMTP
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_configure_relay'
---

Si votre fournisseur internet bloque le port 25, ou si vous rencontrez un problème d’utilisation du serveur SMTP natif de YunoHost, vous pouvez configurer votre serveur YunoHost pour utiliser un relais SMTP.

## Qu'est ce qu'un relais SMTP

C'est un serveur SMTP tiers qui va envoyer les e-mails à la place de votre propre serveur SMTP.
Une fois correctement installé, le changement est totalement transparent pour l’utilisateur. Vos correspondants verront vos e-mails comme s’ils venaient de votre propre serveur, mais ils auront été envoyés depuis le relais SMTP que vous aurez choisi et configuré.

! [fa=exclamation-triangle /] Il est important de noter que dans le monde de l'auto-hébergement, utiliser un relai SMTP est un énorme compromis ! En effet, le relais SMTP ne sera pas seulement capable d'envoyer les e-mails, mais il a également accès au contenu entier de l’e-mail que vous envoyez. Il faut faire attention également que vous n'aurez pas le choix, tout le trafic e-mails passera par ce relais une fois la configuration terminée.

## Comment utiliser le relais SMTP avec YunoHost ?

YunoHost supporte depuis la version 4.1 la configuration d'un relais SMTP. Pour le moment cette fonctionnalité ne soit pas accessible depuis l'interface d'administration : le paramétrage doit être fait en ligne de commande.

### Étape 1 : S'inscrire chez un fournisseur de relais SMTP

Beaucoup de fournisseurs existent dans ce domaine. Certains sont gratuits et d'autres proposent des services payants contre différentes options. Comme écrit plus haut vous devez être sûr de pouvoir lui faire confiance, mais cela reste à votre entier égard.

### Étape 2 : Paramétrer sa zone DNS correctement

Une fois inscrit, le paramétrage du relais SMTP demande de modifier la zone DNS de votre domaine. La procédure standard consiste à ajouter une clé DKIM, et SPF à la zone DNS. Les paramètres à modifier dépendent du fournisseur que vous aurez choisi.

Habituellement les fournisseurs ont une documentation à ce sujet.

! [fa=exclamation-triangle /] Attention une fois la zone DNS enregistrée, le relais SMTP peut envoyer des e-mails à votre nom sans que vous ne le sachiez

## Étape 3 :Configurer YunoHost correctement

Pour que YunoHost soit capable d'utiliser le relais, il faut paramétrer 3 choses.
1. Votre url de relais SMTP (on utilisera `smtprelay.tld`).
2. Votre nom d'utilisateur SMTP (on utilisera `username`).
3. Votre mot de passe SMTP (on utilisera `password`).

Le fournisseur SMTP vous fournit ces trois informations.

Premièrement se connecter sur son serveur en SSH avec la commande : 

```bash
ssh admin@domain.tld
```

Ensuite, mettre à jour les informations suivantes : 

```bash
sudo yunohost settings set smtp.relay.host -v smtprelay.tld
sudo yunohost settings set smtp.relay.user -v username
sudo yunohost settings set smtp.relay.password -v password
```

C'est une bonne idée de confirmer les informations en faisant `sudo yunohost settings list`

Votre relais SMTP est maintenant configuré !

! [fa=exclamation-triangle /] Maintenant le relais SMTP est capable de lire et d'utiliser toutes les informations contenues dans les emails que vous envoyer sans votre accord. Mais ne sera pas capable de lire les informations des emails que vous recevez.

## Vérifier la configuration

Vous pouvez vérifier vos paramètres en envoyant un mail et voir si cela fonctionne. Certains relais SMTP vous confirment l'e-mail envoyé. Bien sur vous pouvez vérifier sur mail-tester.com pour prendre connaissance d’éventuelles problèmes.
