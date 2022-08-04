---
title: Collegarsi a YunoHost attraverso un Hidden Service
template: docs
taxonomy:
    category: docs
routes:
  default: '/torhiddenservice'
---

! Questo tutorial non è completo! Con queste impostazioni alcuni dati possono essere rivelati come ad esempio il dominio principale del tuo yunohost, di conseguenza non può essere considerato un reale "Hidden service". Vedi https://www.torproject.org/docs/tor-hidden-service.html

### Installare Tor
```bash
apt install tor 
```

### Configurazione dell'hidden service
Modifica `/etc/tor/torrc` aggiungendo queste righe:

```bash
HiddenServiceDir  /var/lib/tor/hidden_service/
HiddenServicePort 80 127.0.0.1:80
HiddenServicePort 443 127.0.0.1:443
```

### Riavvia Tor
```bash
service tor restart
```

### Copia l'hostname del tuo Hidden Service
```bash
cat /var/lib/tor/hidden_service/hostname
```

Il dominio dell'hidden service sarà una cosa tipo *random123456789.onion*

### Aggiungi il dominio .onion a YunoHost
```bash
yunohost domain add random123456789.onion
```

### Disabilita la redirezione SSO (opzionale)
Se non vuoi essere rediretto al portale SSO al login puoi disattivare SSOwat specificatamente per questo dominio modificando il file `/etc/nginx/conf.d/random123456789.onion.conf` commentando le seguenti linee (due volte):

```bash
#access_by_lua_file /usr/share/ssowat/access.lua;
```

### Riavvia NGINX
```bash
service nginx restart
```

