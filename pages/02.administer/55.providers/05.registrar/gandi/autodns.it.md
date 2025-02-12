---
title: Ottenere una chiave API con Gandi
template: docs
taxonomy:
    category: docs
routes:
  default: '/providers/registrar/gandi/autodns'
  aliases:
    - '/registar_api_gandi'
---

Questa pagina indica come ottenere una chiave API con Gandi di modo da configurare il meccanismo di configurazione automatica del DNS di YunoHost.

! NB. : **NON comunicare a nessuno il token API!** Un attaccante malizioso con il tuo token potrebbe prendere il controllo del tuo dominio e quindi anche del tuo server!

1. Connettiti a <https://account.gandi.net/>
2. Dovresti vedere questa pagina e quindi clicca su 'Security'
  ![](image://registrar_api_gandi_1.png?resize=800)
3. Nella pagina successiva clicca su '(re)Generate the API key'.
  ![](image://registrar_api_gandi_2.png?resize=800)
