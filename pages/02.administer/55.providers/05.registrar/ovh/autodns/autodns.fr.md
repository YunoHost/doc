---
title: Obtenir une clé API d'OVH
template: docs
taxonomy:
    category: docs
routes:
  default: '/providers/registrar/ovh/autodns'
  aliases:
    - '/registar_api_ovh'
---

Cette page a pour but de vous guider dans l'obtention d'une clé API d'OVH afin de configurer le mécanisme de configuration automatique des DNS de YunoHost.

! NB. : **Ne partagez PAS vos tokens API avec qui que ce soit !** Un attaquant malveillant obtenant vos tokens pourrait prendre le contrôle de votre domaine, et éventuellement de votre serveur !

1. Allez sur <https://eu.api.ovh.com/createToken/>

2. Remplissez le formulaire avec les informations requises comme indiqué ci-dessous :

- ID du compte ou adresse e-mail : Il s'agit de votre identifiant OVH habituel
- Mot de passe : Il s'agit de votre mot de passe OVH habituel
- Nom du script : par exemple `YunoHost Auto DNS`
- Description du script : par exemple `YunoHost Auto DNS`
- Validité : `Unlimited`
- Droits : utilisez le bouton `+` pour ajouter les lignes suivantes
  - `GET` : `/domain/zone/*`
  - `POST` : `/domain/zone/*`
  - `PUT` : `/domain/zone/*`
  - `DELETE` : `/domain/zone/*`

![](image://registrar_api_ovh_1.png?resize=800)

3. Vous obtiendrez trois jetons (une clé d'application, une clé d'application secrète, et une clé de consommateur) qui doivent être utilisés dans la configuration de YunoHost
