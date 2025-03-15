---
sidebar_label: OVH DNS config via API
title: Obtaining an API key from OVH
---

This page is meant to guide you in obtaining an API key from OVH in order to configure YunoHost's automatic DNS configuration mecanism

:::info
**DO NOT share your API tokens with anybody!** A malicious attacker obtaining your tokens could take over your domain, and possibly your server!
:::

1. Go to [the OVH token request page](https://eu.api.ovh.com/createToken/)

2. Fill the form with the required informations as shown below:

    - Account ID or email address: This is your usual OVH login
    - Password: This is your usual OVH password
    - Script Name: for example `YunoHost Auto DNS`
    - Script description: for example `YunoHost Auto DNS`
    - Validity: `Unlimited`
    - Rights: use the `+` button to add the following lines
      - `GET` : `/domain/zone/*`
      - `POST` : `/domain/zone/*`
      - `PUT` : `/domain/zone/*`
      - `DELETE` : `/domain/zone/*`

    ![](/img/registrar_api_ovh_1.png)

3. You will obtain three tokens (an application key, a secret application key, and a consumer key) which should be used in YunoHost's configuration
