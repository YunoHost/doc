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

<img src="/images/thunderbird-config.png" width=900>

* [Manage alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

#### For Android
[K-9 Mail](https://en.wikipedia.org/wiki/K-9_Mail) application works.

#### For Firefox OS

Tested with Firefox OS 2.6.
On the home screen, enter the user name and the email address. Then use manual configuration:

<a href="/images/ffos_email_config_home_screen_empty.png"><img src="/images/ffos_email_config_home_screen_empty.png" width=200/></a> <a href="/images/ffos_email_config_home_screen_fill.png"><img src="/images/ffos_email_config_home_screen_fill.png" width=200/></a>

Configure manually the form as shown on following screenshots:

<a href="/images/ffos_email_config_manual_conf_empty.png"><img src="/images/ffos_email_config_manual_conf_empty.png" width=200/></a> <a href="/images/ffos_email_config_manual_conf_fill.png"><img src="/images/ffos_email_config_manual_conf_fill.png" width=200/></a>


<a href="/images/ffos_email_config_manual_conf_2_empty.png"><img src="/images/ffos_email_config_manual_conf_2_empty.png" width=200/></a> <a href="/images/ffos_email_config_manual_conf_2_fill.png"><img src="/images/ffos_email_config_manual_conf_2_fill.png" width=200/></a>
