---
title: listmonk
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_listmonk'
---

listmonk is a self-hosted, high performance mailing list and newsletter manager

## Authentication

By default, there is no username-password for the admin user. In place the authentication is enforced by the reverse-proxy itself. Only the admin user chosen while installing the app can access the admin panel.

More users can be given access to the panel by editing the Users and Groups permissions from the webmin or the cli.

## SMTP Configuration

listmonk requires an active SMTP configuration to be able to send e-mails. This can be configured in listmonk's admin interface, by going to Settings -> Settings -> SMTP

### Local SMTP Configuration

If you want to use your YunoHost server to send e-mails, use the following configuration:

```
Host: localhost
Port: 25
Auth protocol: None
Skip TLS Verification: True
```

### Gmail, Amazon SES, Mailgun, Mailjet, Sendgrid, Postmark, e.t.c

Just click on the respective buttons to get the desired configurations, and replace the relevant fields.

These settings are also provided by the providers themselves.
