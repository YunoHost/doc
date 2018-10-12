## Using YunoHost as a Tor Hidden Service
<div class="alert alert-warning">
This tuto is not finished ! Some data could leak with this setup like the main domain of your yunohost, so it's not a "Hidden Service".
</div>

See https://www.torproject.org/docs/tor-hidden-service.html.en

### Installing Tor
```bash
apt install tor 
```

### Configuring our hidden service
Edit `/etc/tor/torrc`, and add these lines:

```bash
HiddenServiceDir  /var/lib/tor/hidden_service/
HiddenServicePort 80 127.0.0.1:80
HiddenServicePort 443 127.0.0.1:443
```

### Restart Tor
```bash
service tor restart
```

### Get your Tor Hidden Service hostname
```bash
cat /var/lib/tor/hidden_service/hostname
```

Your domain looks like *random123456789.onion*

### Add the .onion domain to YunoHost
```bash
yunohost domain add random123456789.onion
```

### Avoid SSO redirection (optional)
If you want to avoid being redirected to the SSO portal at login, you can deactivate SSOwat for this specific tor domain, by editing the file `/etc/nginx/conf.d/random123456789.onion.conf` and commenting the following line (two times):

```bash
#access_by_lua_file /usr/share/ssowat/access.lua;
```

### Restart nginx
```bash
service nginx restart
```
