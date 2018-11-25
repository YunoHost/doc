# Migrating an existing instance to Stretch

This page is dedicated to help you migrating an instance from YunoHost 2.7.x (running on Debian Jessie/8.x) to YunoHost 3.0 (running on Debian Stretch/9.x).

## Important notes

- The YunoHost team did its best to make sure that the migration is as smooth as possible and was tested over the course of several months in several cases.

- With that said, please be aware that this is a delicate operation. System administration is a complicated topic and covering every particular cases is quite hard. Therefore, if you host critical data and services, please [make backups](/backup). And in any case, be patient and attentive during the migration.

- Yet, please don't rush into thinking that you should rush into reinstalling your system. A common "mistake" is to be willing to reinstall a server at the slightest complication. But turns out that reinstalling a system can also be complicated. Instead, if you happen to run into issues, we encourage you to try to investigate and understand what's going on and reach for help instead of just throwing away everything because it looks simpler.

- About external email clients : if you or your users are using external email clients (typically Thunderbird, K9Mail, ...) be aware that the SMTP port changed from 465 (with SSL/TLS) to 587 (STARTTLS). See [this page of doc dedicated to email clients](/email_configure_client). Webmail configurations such as Rainloop should also be updated using the corresponding administration interface.

- For advanced users : if you have some custom scripts for backups, be aware that we made some backward-incompatible changes in the backup command line. The deprecated `--hooks`/`--ignore-hooks` options were removed, as well as the options `--ignore-apps`, `--ignore-system`. To make things more intuitive, `yunohost backup create --apps wordpress` (for example) will only backup wordpress, i.e. you don't have to add `--ignore-system` to not backup the system.

## Migration procedure

#### From the webadmin

After upgrading to 2.7.14, go to Tools > Migrations to access the migrations interface. You will have to read carefully and accept the disclaimer then launch the migration. The logs will be shown in the message bar (you can hover it to see the whole history).

#### From the command line

After upgrading to 2.7.14, run : 

```bash
sudo yunohost tools migrations migrate
```

then read carefully and accept the disclaimer.

## During the migration

Depending on your hardware and packages installed, the migration might take up to a few hours. 

Note that it is expected to see some errors (in particular about fail2ban) during the migration, so don't worry too much about them.

#### If the migration crashed / failed at some point.

If the migration failed at some point, it should be possible to relaunch it. If it still doesn't work, you can try to [get help](/help) (please provide the corresponding messages or whatever makes you tell that it's not working).

## What to do after the upgrade

#### Check that you actually are on Debian Stretch and YunoHost 3.0

You should be able to see this from the webadmin Tools > Diagnosis, and also in the footer of the page. On the command line, you can use `lsb_release -a` and `yunohost --version`.

#### Check that fail2ban and the firewall are active

You should be able to see that fail2ban and the firewall are active. From the webadmin in Services (look for 'fail2ban' and 'yunohost-firewall'). From the command line, run `yunohost service status fail2ban yunohost-firewall`. They should both have `active: active`.

#### Check that your applications are working

Test that your applications are working. If they aren't, you should try to upgrade them (it is also a good idea to upgrade them even if they are working anyway).

#### Mail users: check your mail score

If you are using mails (especially sending them), check that your score is still good by using [mail-tester](https://www.mail-tester.com/) for example.
