# Using Yunohost as a Tor Hidden Service

See https://www.torproject.org/docs/tor-hidden-service.html.en

## Installing Tor

```bash
apt-get install tor 
```

## Configuring our hidden service

Edit /ect/tor/torrc, and add these lines:

```
HiddenServiceDir  /var/lib/tor/hidden_service/
HiddenServicePort 80 127.0.0.1:80
HiddenServicePort 443 127.0.0.1:443
```

## Restart Tor

```bash
service tor restart
```

## Get your Tor Hidden Service hostname

```bash
cat /path/to/hidden_service/keys/hostname
```

Your domain looks like *random123456789.onion*

## Add the .onion domain to Yunohost

```bash
yunohost domain add random123456789.onion
```
