---
title: Configurar un cliente de correo electrónico
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_configure_client'
---

Es posible de consultar y enviar correos de tu YunoHost con un cliente de correo electrónico como Mozilla Thunderbird o K-9 Mail en el teléfono.
Normalmente, al añadir tu cuenta en el cliente de correo se va a configurar automáticamente, pero por si acaso no funciona, puedes configurarlo manualmente.

### Configuración general

A continuación puedes encontrar los elementos a configurar en el cliente de correo (`domain.tld` es todo lo que es después de @ en tu dirección de correo, y `nombre_de_usuario` es lo que es antes del @).

| Protocolo | Puerto | Seguridad | Autenticación  | Nombre de usuario                               |
| :--:     | :-:  | :--:       | :--:            | :--:                                   |
| IMAP     | 993  | SSL/TLS    | Normal password | `nombre_de_usuario` (sin `@domain.tld`) |
| SMTP     | 587  | STARTTLS   | Normal password | `nombre_de_usuario` (sin `@domain.tld`) |


### ![](image://thunderbird.png?resize=50&classes=inline) Configurar Mozilla Thunderbird (en un ordenador)

Para configurar manualmente un nuevo cuenta en Thunderbird, añadir las informaciones de la cuenta, y después seleccionar el puerto 993 con SSL/TLS para IMAP, y puerto 587 con STARTTLS para SMTP. Después seleccionar 'Normal Password' para Autenticación y haz click en el botón 'Advanced Config'. Se puede que tendrás que aceptar los certificados para que todo funciona normalmente.

![](image://thunderbird_config_1.png?resize=900)
![](image://thunderbird_config_2.png?resize=900)

* [Gestionar un alias para una dirección de correo electrónico](https://support.mozilla.org/es/kb/configurar-un-alias-para-una-direccin-de-correo-el)

### ![](image://k9mail.png?resize=50&classes=inline) Configurar K-9 Mail (en Android)

Seguir los pasos a continuación. (Como para Thunderbird, se puede que tendrás que aceptar los certificados para que funciona normalmente.)

![](image://k9mail_config_1.png?resize=280&classes=inline)
![](image://k9mail_config_2.png?resize=280&classes=inline)
![](image://k9mail_config_3.png?resize=280&classes=inline)
![](image://k9mail_config_4.png?resize=280&classes=inline)
