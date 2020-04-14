# Rainloop

Rainloop is a lightweight webmail.

To configure it, go to http://DOMAIN.TLD/rainloop/app/?admin

- The default login is : admin
- The default password is : Password chosen during install
- If you lost the admin password, you can retrieve it using ``sudo yunohost app settings rainloop password``

Each user can add a remote carddav server from their own parameters interface.

- If you use baikal, the CardDav address is: https://DOMAIN.TLD/baikal/card.php/addressbooks/USER/default/
- If you use NextCloud, the CardDav address is: https://DOMAIN.TLD/nextcloud/remote.php/carddav/addressbooks/USER/contacts

Rainloop saves your PGP private keys in the browser storage. This means that you will loose your private keys if you clear your browser storage (e.g., private browsing, different computer...). This packages integrates [PGPback by chtixof](https://github.com/chtixof/pgpback_ynh) so you can store your PGP private keys on the server securely. Go to **http://DOMAIN.TLD/rainloop/pgpback** to backup your PGP keys on the server or restore them.

To upgrade the app once a new rainloop version is available, simply run in a local shell via ssh or otherwise :
``sudo yunohost app upgrade -u https://github.com/YunoHost-Apps/rainloop_ynh rainloop``

-----------------------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="APPLICATION's logo"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

### Index

- [Configuration](#configuration)
- [Limitations with YunoHost](#limitations-with-yunohost)
- [Customer Applications](#customer-applications)
- [Useful links](#useful-links)

**General presentation of the application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**If the configuration of the application is not done with the admin panel of YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations with YunoHost

**Explanation of the current limitations in using the application with YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Customer applications

| Application name | Platform | Multi-account | Other supported networks | Play Store | F-Droid | Apple Store | *Other* |
|------------------|----------|---------------|--------------------------|------------|---------|-------------|---------|
|                  |          |               |                          |            |         |             |         |

## Useful links

+ Website: [WEBSITE](#)
+ Official documentation: [DOCUMENTATION](#)
+ Application software repository: [github.com - YunoHost-Apps/APPLICATION](https://github.com/YunoHost-Apps/APPLICATION_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/APPLICATION/issues](https://github.com/YunoHost-Apps/APPLICATION_ynh/issues)
