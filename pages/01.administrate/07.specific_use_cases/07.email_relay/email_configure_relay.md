---
title: Configure SMTP relay
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_configure_relay'
---

If your ISP blocks port 25, if you can't set a reverseDNS on your server, or if you have any other troubles using the built-in SMTP server on YunoHost, you may want to setup your YunoHost server to use a SMTP relay.

## What is a SMTP relay?

A SMTP relay is basically a third party hosted SMTP server that will send emails on behalf of your own SMTP server (Postfix service on YunoHost).
Once setup correctly on YunoHost, it will operate in a totally transparent manner, both for you and for your correspondents: they will see emails as coming from your YunoHost main URL, but all the sending will be delegated to the SMTP relay you have chosen and configured.

! [fa=exclamation-triangle /] It's important to note that using a SMTP relay has to be seen as a (big) compromise in the world of self-hosting. Indeed, when using a SMTP relay, you will not only let a third party send emails on your behalf, but also be able to access to the full content of all the emails you'll send. Be also aware that a SMTP relay is setup for your whole YunoHost server: you can't choose which emails or which users go through it because all future emails will.

## How to use a SMTP relay with YunoHost?

YunoHost has a built-in SMTP relay configuration, available from version 4.1. That configuration is not yet available from the admin web interface, though. You will have to use the command line interface.

### Step 1: Register on a SMTP relay provider

Many providers exist. Some have free plans with or without limitations, it's up to you. As written above, you have to be careful with your choice as you will basically handover all your emails to that third party. Whether you can trust it or not, that's your call!

### Step 2: Setup your DNS records correctly

Once registered, the SMTP relay provider will usually ask you to modify your DNS.
Standard procedure is to add a DKIM key and a SPF key to your DNS records.
The way to modify these records and the value of the keys you'll have to add depend both on your domain name provider and SMTP relay provider.

Usually, the SMTP relay provider will provide you with a guide on how to modify these records, together with an automatic check tool that will tell you when your DNS have been setup correctly. That step is mandatory to prove "the world" that you, owner of your domain name, did explicitly authorize your SMTP relay provider to send emails on your behalf. 

Please note that modifying your DNS records could sometimes take over 24h to take effect, so be patient!

! [fa=exclamation-triangle /] From now on, a non trusty SMTP relay provider could send emails from your main domain without telling you.

### Step 3: Setup YunoHost correctly

In order to setup your YunoHost to use your SMTP relay, you will have to configure three things:
1. Your SMTP relay URL (for this tutorial we will use `smtprelay.tld`)
2. Your SMTP relay username (for this tutorial we will use `username`)
3. Your SMTP relay password (for this tutorial we will use `password`)

Your SMTP relay will obviously provide you with these three things, that should be available in your control panel or whatsoever.

You can log into your YunoHost server using SSH:
```bash
ssh admin@yourdomain.tld
```

Then you can update the three values as below:

```bash
sudo yunohost settings set smtp.relay.host -v smtprelay.tld
sudo yunohost settings set smtp.relay.user -v username
sudo yunohost settings set smtp.relay.password -v password
```

It may be a good idea to double confirm your settings by doing:

```bash
sudo yunohost settings list
```

Your SMTP relay is now configured!

! [fa=exclamation-triangle /] From now on, a non trusty SMTP relay provider could read or use the data of all the emails you send without telling you (but still won't be able to read nor to use the data from emails you receive).

### Step 4: Check your setup

You can check your setup by sending emails and try if everything works.
Some of the SMTP relay will give you insights about the emails you send so that can also be a good way to check that everythings works as needed.
Of course, you can always have a try with [mail-tester.com](https://www.mail-tester.com/) to check for any problem or discrepancy.
