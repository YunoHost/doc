# Frequently asked questions

#### YunoHost ported on Ubuntu?
YunoHost team does not have energy to port and maintain YunoHost on Ubuntu.

#### YunoHost is distributed under which license?
YunoHost packages are under free licenses GNU AGPL v.3.

YunoHost is based on Debian, so on licenses of Debian based elements.

Applications and applications packages have there respectives licenses.

#### Can we host many independents websites with differents domain names?
We can host many websites cause YunoHost is multi-domain and that some applications for websites management, like *WordPress* or *Web App Multi Custom*, are multi-instances, which means that the application can be installed many times.

#### Why can I access to applications with the IP address?
The [SSO](https://github.com/Kloadut/SSOwat/) does not allow to access to the user part (apps included) with an IP address. For this purpose, you should use a domain name. One trick could be to modify the [`hosts` file (last §)](dns_local_network_en) of your desktop computer.