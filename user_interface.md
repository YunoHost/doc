#User interface

### Access problem

Access to user interface can only be done by using a domain name. You can’t access to it by using the local IP address of your server like that: https://your.server.ip.address/yunohost/sso/

You can create a redirection by modifing `/etc/hosts`. Add that line:

```bash
your.server.ip.address domain.tld
```

By replacing `your.server.ip.address` for instance by `192.168.1.05` and `domain.tld` by your domain name or by one created here if you doesn’t own one.

### Software

User interface is based on that software: https://github.com/Kloadut/ssowat