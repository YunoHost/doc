---
title: Vaultwarden
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_vaultwarden'
  aliases:
    - '/app_bitwarden'
---

![Logo di Bitwarden](image://bitwarden_logo.png?width=80)

[![Installa Vaultwarden con YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=vaultwarden) [![Livello di integrazione](https://dash.yunohost.org/integration/vaultwarden.svg)](https://dash.yunohost.org/appci/app/vaultwarden)

### Indice

- [Configurazione](#configurazione)
- [Limiti con YunoHost](#limiti-con-yunohost)
- [Applicazioni per utenti](#applicazioni-per-utenti)
- [Collegamenti utili](#collegamenti-utili)

Vaultwarden è un gestore di password gratuito con funzioni a pagamento, con licenza AGPL, che permette di generare e custodire password in maniera sicura. Una singola password, chiamata 'master password', protegge l'accesso alla cassaforte. Il progetto Bitwarden è stato iniziato nel 2016 da Kyle Spearrin, un ingegnere software.

Il programma è disponibile sui principali sistemi operativi (GNU/Linux, Windows, macOS, iOS, Android e da riga di comando), e come estensione per i browser. È, inoltre, possibile accedere alle password dal sito.[¹](#fonti)

## Configurazione

Per configurare l'applicazione, visita: `sotto.dominio.tld/admin`

### Token admin

Se installata da web, Vaultwarden non comunica il token necessario per accedere all'interfaccia di amministrazione. Per recuperare la password, è necessario:
- fare il login da riga di comando (`ssh admin@sotto.dominio.tld`) ed
- eseguire `grep "admin_token" /etc/yunohost/apps/vaultwarden/settings.yml`

## Limiti con YunoHost

HTTP e l'autenticazione LDAP non sono supportati.

## Applicazioni per utenti

| Nome applicazione | Piattaforma | Multi-account | Fonte | Play Store | F-Droid | Apple Store |
|----------------------|----------|---------------|--------|------------|---------|-------------|
| Bitwarden | GNU/Linux / macOS / Windows  | [Sì](https://bitwarden.com/help/account-switching/) | [bitwarden.com - download](https://bitwarden.com/download) |
| Bitwarden | Android / iOS | [Sì](https://bitwarden.com/help/account-switching/) |  | [Playstore - Bitwarden](https://play.google.com/store/apps/details?id=com.x8bit.bitwarden) | Sì ([repo da aggiungere](https://mobileapp.bitwarden.com/fdroid/)) | [App Store - Bitwarden](https://itunes.apple.com/app/bitwarden-free-password-manager/id1137397744?mt=8) |


## Collegamenti utili

+ Sito: [bitwarden.com](https://bitwarden.com/)
+ Documentazione ufficiale: [help.bitwarden.com](https://help.bitwarden.com/)
+ Repository dell'applicazione YunoHost: [github.com - YunoHost-Apps/vaultwarden](https://github.com/YunoHost-Apps/vaultwarden_ynh)
+ Segnala un problema o miglioramento aprendo una segnalazione (issue): [github.com - YunoHost-Apps/vaultwarden/issues](https://github.com/YunoHost-Apps/vaultwarden_ynh/issues)

-----

### Fonti

¹ [wikipedia.org - Bitwarden](https://en.wikipedia.org/wiki/Bitwarden)
