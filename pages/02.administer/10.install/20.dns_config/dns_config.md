---
title: DNS zone configuration
template: docs
taxonomy:
    category: docs
routes:
  default: '/dns_config'
  aliases:
    - '/dns'
---

DNS (domain name system) is a system that converts human-readable addresses
(domain names) into machine-understandable addresses (IP). For your server to be
easily accessible by human beings, and for some services like mail to work
properly, DNS must be configured.

If you're using an [automatic domain](/dns_nohost_me) provided by the YunoHost Project, the configuration should be
performed automatically. If you're using your own domain name (e.g. bought via
a registrar), you should manually configure your domain on your registrar's
interface.

## Recommended DNS configuration

NB: Examples here use the placeholder `your.domain.tld`, you have to replace it with your real domain, such as `www.yunohost.org`.

YunoHost provides a recommended DNS configuration, available via:
- the webadmin, in Domain > your.domain.tld > DNS configuration;
- or the command line, `yunohost domain dns-conf your.domain.tld`

For specific needs or specific setups, and if you know what you're doing, you
might want or have to tweak these, or add additional ones (e.g. to handle
subdomains).

The recommended configuration typically looks like this:

```bash
#
# Basic ipv4/ipv6 records
#
@ 3600 IN A 111.222.33.44
* 3600 IN A 111.222.33.44

# (If your server is IPv6 capable, there are some AAAA records)
@ 3600 IN AAAA 2222:444:8888:3333:bbbb:5555:3333:1111
* 3600 IN AAAA 2222:444:8888:3333:bbbb:5555:3333:1111

#
# XMPP
#
_xmpp-client._tcp 3600 IN SRV 0 5 5222 your.domain.tld.
_xmpp-server._tcp 3600 IN SRV 0 5 5269 your.domain.tld.
muc 3600 IN CNAME @
pubsub 3600 IN CNAME @
vjud 3600 IN CNAME @
xmpp-upload 3600 IN CNAME @

#
# Mail (MX, SPF, DKIM and DMARC)
#
@ 3600 IN MX 10 your.domain.tld.
@ 3600 IN TXT "v=spf1 a mx -all"
mail._domainkey 3600 IN TXT "v=DKIM1; k=rsa; p=someHuuuuuuugeKey"
_dmarc 3600 IN TXT "v=DMARC1; p=none"
```

Though it might be easier to understand it if displayed like this:


| Type    | Name                   | Value                                                 |
| :-----: | :--------------------: | :--------------------------------------------------:  |
|  **A**  |   **@**                |  `111.222.333.444` (your IPv4)                        |
|    A    |   *                    |  `111.222.333.444` (your IPv4)                        |
|  AAAA   |   @                    |  `2222:444:8888:3333:bbbb:5555:3333:1111` (your IPv6) |
|  AAAA   |   *                    |  `2222:444:8888:3333:bbbb:5555:3333:1111` (your IPv6) |
| **SRV** | **_xmpp-client._tcp**  |  `0 5 5222 your.domain.tld.`                          |
| **SRV** | **_xmpp-server._tcp**  |  `0 5 5269 your.domain.tld.`                          |
|  CNAME  |   muc                  |  `@`                                                  |
|  CNAME  |   pubsub               |  `@`                                                  |
|  CNAME  |   vjud                 |  `@`                                                  |
|  CNAME  |   xmpp-upload          |  `@`                                                  |
| **MX**  | **@**                  |  `your.domain.tld.`     (and priority: 10)            |
|   TXT   |   @                    |  `"v=spf1 a mx -all"`               |
|   TXT   |  mail._domainkey       |  `"v=DKIM1; k=rsa; p=someHuuuuuuugeKey"`              |
|   TXT   |  _dmarc                |  `"v=DMARC1; p=none"`                                 |

#### A few notes about this table

- Not all these lines are absolutely necessary. For a minimal setup, you only need the records in bold.
- The dot at the end of `your.domain.tld.` is important ;);
- `@` corresponds to `your.domain.tld`, and e.g. `muc` corresponds to `muc.your.domain.tld`;
- These are example values ! See your generated conf for the actual values you should use;
- We recommend a [TTL](https://en.wikipedia.org/wiki/Time_to_live#DNS_records) of 3600 (1 hour). But you can use something else if you know what you're doing;
- Don't put an IPv6 record if you're not sure IPv6 really works on your server! You might have issues with Let's Encrypt if it doesn't.
- If you're using the domain provider Namecheap the SRV DNS entries are formatted as **Service**: _xmpp-client **Protocol**: _tcp **Priority**: 0 **Weight**: 5 **Port**: 5222 **Target**: your.domain.tld

### Reverse DNS

If your ISP or VPS provider let you define a [Reverse DNS
lookup](https://en.wikipedia.org/wiki/Reverse_DNS_lookup) for your public IPv4
and/or IPv6 addresses, you must configure it. It will prevent you to be marked as
spam by anti-spam filters.

**N.B. : the reverse DNS configuration happens on your Internet Service Provider or VPS provider. It is *not* handled by your domain's registrar.**

If your public IPv4 address is `111.222.333.444` and your DNS
domain is `domain.tld`, you should get following answer when using `nslookup`
command tool:

```shell
$ nslookup 111.222.333.444
444.333.222.111.in-addr.arpa    name = domain.tld.
```

The diagnosis system available in the webadmin performs this checks automatically (in section Email).

### Dynamic IP

If your global IP address is constantly changing, follow this [tutorial](/dns_dynamicip).
