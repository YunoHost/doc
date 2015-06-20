## Configuration desktop email client

*[Documentation linked to YunoHost email](/email_fr)*.

You can access your emails via desktop email clients such as Mozilla Thunderbird.

#### Requirements
* Email address
* Password of the user account

##### Settings
| Protocol | Port | Encryption |
| :--: | :-: | :--: |
| IMAP | 993 | SSL/TLS |
| SMTP | 465 | SSL/TLS |

#### Mozilla Thunderbird

The automatic detection tool of Thunderbird does not work with YunoHost. You will need to set it up manually. To do so, add the account information, then select SSL/TLS for IMAP and SMTP. Afterwards select 'Normal Password' for Authentication and click on 'Advanced Config'. You will need to accept the certificate exceptions for fetching mails and after you send your first mail. Remove dot before domain name.

<img src="https://yunohost.org/images/thunderbird-config.png" width=900>

* [Manage alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

#### For Android
[K-9 Mail](https://en.wikipedia.org/wiki/K-9_Mail) application works.