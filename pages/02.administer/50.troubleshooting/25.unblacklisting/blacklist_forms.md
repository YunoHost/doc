---
title: Unblacklisting forms
template: docs
taxonomy:
    category: docs
routes:
  default: '/blacklist_forms'
---

It could happen sometimes that your IP is blacklisted by some email provider, or anti-spam services. If you receive an alert from the diagnosis tool, click on details to find the unblocking forms.

## Test your server

To check your Email deliverability, YunoHost provide some tests avilables in the Diagnosis tool. This tools evalutes  a lot of configuration and ip reputation points. It gives you also an indicator if some mails are blocked inside the mail queue (waiting to be sent).
all the points evaluated by [the well known mail-tester.com](https://www.mail-tester.com) except for mail content (usefull if you prepare a newsletter).

However, if you have a doubt on the internal diagnosis results, you could check on external tools:
- by sending an emails : [Mail tester](https://www.mail-tester.com)
- by providing the public ip : [MultiRBL Valli](https://multirbl.valli.org/) or [Whatismyip](https://whatismyipaddress.com/blacklist-check)

## Check your mail logs

This command can help you to summarize which emails has been refused by other SMTP server and why.

```
cat /var/log/mail.log | grep "deferred" | sed -E "s/(:[0-9][0-9]).+</\1\t/g" | sed -E "s/>.+dsn/\terror/g" | sed -E "s/, status=deferred \(/ /g" | sed -E "s/\)$//g"
```

See [the list of SMTP return code](https://en.wikipedia.org/wiki/List_of_SMTP_server_return_codes) from wikipedia.

## Untestable email providers
YunoHost is only able to test generic blacklist using the DNS RBL mechanism. However, Gmail, Microsoft, Yahoo or Free maintains their own blacklisting mechanism, so in some situation you may need to contact their teams through dedicated forms or use dedicated tools.

### Microsoft

* No way to test easily IP reputation
* [Microsoft guide for postmaster](https://sendersupport.olc.protection.outlook.com/pm/)
* [Information about SMTP return code from Microsoft](https://sendersupport.olc.protection.outlook.com/pm/troubleshooting.aspx#Codes)
* Reputation Management tools :
  * [Junk Email Reporting Program (JMRP)](https://postmaster.live.com/snds/JMRP.aspx)
  * [Smart Network Data Services (SNDS)](https://postmaster.live.com/snds/index.aspx)
* [Get support form for deliverability issues](https://support.microsoft.com/supportrequestform/8ad563e3-288e-2a61-8122-3ba03d6b8d75) (Sadly you need a Microsoft account :/ )

### Gmail
* No way to test easily IP reputation
* [Google guide for postmaster](https://support.google.com/a/topic/1354753)
* [Information about SMTP return code from Google](https://support.google.com/a/answer/3726730)
* Reputation Management tools : [Google Postmaster Tools](https://postmaster.google.com)
* [Get support form for deliverability issues](https://support.google.com/mail/contact/bulk_send_new)

### Yahoo
* No way to test easily IP reputation
* [Yahoo guide for postmaster](https://senders.yahooinc.com/best-practices)
* [Information about SMTP return code from Yahoo](https://senders.yahooinc.com/smtp-error-codes)
* Reputation Management tools : [Complaint Feedback Loop](https://io.help.yahoo.com/contact/index?page=contactform&locale=en_US&token=Zh%2FBBVqXzLHlIbokbUqVWTUbuuQeXGkGnZzhKR2JQ4O6mMQdy9JSWdtWFXvjthcYCRj9bUIFfycOfG%2B4GOHPHoOGa8HwDO2%2B0kYRtTcdR8Nja5P9HWkKh3VWfS3pyu4UdjhvwG%2BBCvnYFl5dToDK%2Fw%3D%3D&selectedChannel=email-icon)
* [Get support form for deliverability issues](https://senders.yahooinc.com/contact)

### Free
You can find a tool to test your IP, advices, explanation of error code and a way to contact Free on [this page](https://postmaster.free.fr/)

## Get alert about emails sent without SPF or DKIM
If you use your own domains and think that some mails are sent by unauthorized servers (so without SPF/DKIM), you  get report about this mail with.
```
_dmarc.DOMAIN 3600 IN TXT "v=DMARC1; p=none; fo=1; rua=mailto:example@domain.tld!10m"
```

