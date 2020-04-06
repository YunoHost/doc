## Configuring email client

You can fetch and send emails using your YunoHost instance from desktop email clients such as Mozilla Thunderbird or on your smartphone with applications like K-9 Mail.

Modern mail clients should be able to configure themselves automatically. If autoconfiguration fails, you can do it manually following the instructions below. (If the autoconfiguration fails though, it should be understood as a bug in YunoHost, and we would be glad to read your feedback to try to reproduce the issue on our side!)

### Generic settings

Here are the element you should enter to manually configure your mail client (`domain.tld` refers to what's after the @ in your email address, and `username` what's before @).

| Protocol | Port | Encryption | Authentication  | Username                               |
| :--:     | :-:  | :--:       | :--:            | :--:                                   | 
| IMAP     | 993  | SSL/TLS    | Normal password | `username` (without the `@domain.tld`) |
| SMTP     | 587  | STARTTLS   | Normal password | `username` (without the `@domain.tld`) |

### <img src="images/thunderbird.png" width=50> Configure Mozilla Thunderbird (on a desktop computer)

To manually configure a new account in Thunderbird, add the account information, then select port 993 with SSL/TLS for IMAP, and port 587 with STARTTLS for SMTP. Afterwards select 'Normal Password' for Authentication and click on 'Advanced Config'. You may need to accept the certificate exceptions for fetching mails and after you send your first mail. Don't forget to remove the dot before the domain name.

<img src="/images/thunderbird_config_1.png" width=900>
<img src="/images/thunderbird_config_2.png" width=900>

* [Manage alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

### <img src="images/k9mail.png" width=50> Configure K-9 Mail (on Android)

Follow the following steps. (As for Thunderbird, you might need to accept certificates at some points)

<a href="/images/k9mail_config_1.png"><img src="/images/k9mail_config_1.png" width=200/></a>
<a href="/images/k9mail_config_2.png"><img src="/images/k9mail_config_2.png" width=200/></a>
<a href="/images/k9mail_config_3.png"><img src="/images/k9mail_config_3.png" width=200/></a>
<a href="/images/k9mail_config_4.png"><img src="/images/k9mail_config_4.png" width=200/></a>

### <img src="images/dekko-app.png" width=50> Configure Dekko (on Ubuntu Touch)

The first time you can simply choose "Add account". If you already have an account configured, tap the hamburger menu then tap the gear, choose Mail, Accounts and press the '+'-symbol.

Then you choose IMAP. Fill in the fields and press Next. Now Dekko will look for the configuration. Check that all fields are correct. Make sure you have your yunohost username, NOT your mailadress and choose "Allow untrusted certificates". Do this for IMAP and SMTP and press Next. Dekko will now synchronise the account after which you are done. Congratz!

<a href="/images/dekko_config_1.png"><img src="/images/dekko_config_1.png" width=200/></a>
<a href="/images/dekko_config_2.png"><img src="/images/dekko_config_2.png" width=200/></a>
<a href="/images/dekko_config_3.png"><img src="/images/dekko_config_3.png" width=200/></a>
<a href="/images/dekko_config_4.png"><img src="/images/dekko_config_4.png" width=200/></a>
