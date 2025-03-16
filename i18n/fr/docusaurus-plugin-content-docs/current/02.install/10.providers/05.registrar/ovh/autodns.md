---
sidebar_label: Configuration DNS OVH via l’API
title: Obtenir une clef API de OVH
---

Cette page a pour but de vous guider dans l'obtention d'une clé API auprès d'OVH afin de configurer le mécanisme de configuration automatique des DNS de YunoHost.

:::caution
**NE partagez vos cléfs API avec PERSONNE !** Un attaquant malveillant qui obtiendrait vos jetons pourrait prendre le contrôle de votre domaine, et éventuellement de votre serveur !
:::

1. Allez sur [la page de demande de jeton OVH](https://eu.api.ovh.com/createToken/)


2. Remplissez le formulaire avec les informations requises comme indiqué ci-dessous :

    - ID du compte ou adresse email : Il s'agit de votre login OVH habituel

    - Mot de passe : Il s'agit de votre mot de passe OVH habituel

    - Nom du script : par exemple `YunoHost Auto DNS`

    - Description du script : par exemple `YunoHost Auto DNS`

    - Validité : `Unlimited`

    - Droits : utilisez le bouton `+` pour ajouter les lignes suivantes
      - `GET` : `/domaine/zone/*`
      - `POST` : `/domaine/zone/*`
      - `PUT` : `/domaine/zone/*`
      - `DELETE` : `/domaine/zone/*`

    ![](/img/registrar_api_ovh_1.png)

3. Vous obtiendrez trois jetons (une clé d'application, une clé d'application secrète et une clé de consommateur) qui doivent être utilisés dans la configuration de YunoHost.