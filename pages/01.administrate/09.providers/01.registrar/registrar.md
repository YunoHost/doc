---
title: Registrar
template: docs
taxonomy:
    category: docs
never_cache_twig: true
twig_first: true
process:
    markdown: true
    twig: true
routes:
  default: '/providers/registrar'
  aliases:
    - '/autodns'
---

Since version 4.3, YunoHost includes a mecanism to interface your server with your DNS registrar API, with the purpos of simplifying and automatizing DNS records registration and maintenance.

The procedure does require an initial configuration where you will need to generate an API key on your registrar's interface.

Not all registrars are supported though. So far, the community tested and validated the interface with [Gandi](https://gandi.net) and [OVH](https://ovh.com), which are recommended. The interface with other registrar may work but is still considered experimental until we gather feedback from the community.

The list bellow can help you to choose a registrar if you plan to buy a domain name to use it with YunoHost.


| Registrar | Compatibility | Easy to obtain an API key |
| --------- | ------------- | ------------------ |
| [Gandi](https://www.gandi.net)     | ✔ (tested)    | ✔  [Tutorial](/providers/registrar/gandi/autodns)                |
| [OVH](https://www.ovh.com/domaines/)       | ✔ (tested)    | ✘ [Tutorial](/providers/registrar/ovh/autodns)  |
| [Namecheap](https://www.namecheap.com/) | ✘ (in lexicon but untested)    | ✘✘✘ API not available without 50$ on the account  |
