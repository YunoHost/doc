# <img src="/images/OnlyOffice_logo.png" height="80px" alt="OnlyOffice Logo"> OnlyOffice Server

[![Install OnlyOffice with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=onlyoffice) [![Integration level](https://dash.yunohost.org/integration/onlyoffice.svg)](https://dash.yunohost.org/appci/app/onlyoffice)

### Index

- [Useful links](#useful-links)
- [How to setup OnlyOffice Server with Nextcloud](#with-nextcloud)  

ONLYOFFICE Server is a free collaborative online office suite comprising viewers and editors for texts, spreadsheets and presentations, fully compatible with Office Open XML formats: .docx, .xlsx, .pptx and enabling collaborative editing in real time.

## How to setup OnlyOffice Server with Nextcloud <a name="with-nextcloud" href=""></a>

1. Install [OnlyOffice Server](https://github.com/YunoHost-Apps/onlyoffice_ynh) in a different domain than the one used by Nextcloud. For example: `https://onlyoffice.domain.org` and `https://domain.org/nextcloud`

2. Install [ONLYOFFICE connector](https://apps.nextcloud.com/apps/onlyoffice) in Nextcloud
- Connect to Nextcloud as admin, and install ONLYOFFICE Connector: -> Applications -> install ONLYOFFICE. (ONLYOFFICE Connector version number doesn't need to match your OnlyOffice Server version number).
- In settings -> ONLYOFFICE, enter the address of your OnlyOffice Server (for example) `https://onlyoffice.domain.org`

OnlyOffice Server is now connected to Nextcloud.

## Useful links

+ Website: [www.onlyoffice.com](https://www.onlyoffice.com/)
+ ONLYOFFICE connector: [Nextcloud ONLYOFFICE Connector](https://apps.nextcloud.com/apps/onlyoffice)
+ Application software repository: [github.com - YunoHost-Apps/onlyoffice_ynh](https://github.com/YunoHost-Apps/onlyoffice_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/onlyoffice/issues](https://github.com/YunoHost-Apps/onlyoffice_ynh/issues)
