---
title: How is used the main domain
template: docs
taxonomy:
    category: docs
routes:
  default: '/dev/maindomain'
---

Here is a list of situations in which we use the main domain concept:
- to expose the web portal: currently the web portal is only reachable through the main domain address (could be changed for multi tenant support in future)
- to define the hostname of the machine: we believe we do this to avoid some sudo errors (may be it's not relvant anymore or could be made in /etc/hosts)
- to TLS encrypt SMTP and dovecot: so user should define the main domain in their email client to avoid TLS warning
- To be able to do mail forwarding using the main domain as Sender Rewriting Scheme Domain see: https://en.wikipedia.org/wiki/Sender_Rewriting_Scheme
- to define default email as (root@ abuse@) but we probably should do it on all parent domain instead
- to define `myhostname` in postfix config, used as EHLO and reverseDNS (refering to https://mxtoolbox.com/emailhealth test it should be a FQDN, so a subdomain) 
- to generate the self-signed Local Authority: having just one allow to upload it in a browser and get an x509 authenticated https connexion.
- to define default xmpp DNS field: dns field are only set on the main domain by default

Finally we can imagine some apps use the main domain too, see 
https://github.com/search?q=org%3AYunoHost-Apps+main_domain&type=code
https://github.com/search?q=org%3AYunoHost-Apps+current_host&type=code
