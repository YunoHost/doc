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

Since version 4.3, YunoHost includes a mechanism to interface your server with your DNS registrar API, with the purpose of simplifying and automatizing DNS records registration and maintenance.

The procedure requires an initial configuration where you need to generate an API key on your registrar's interface.

Not all registrars are supported. So far, the community tested and validated the interface with [Gandi](https://gandi.net) and [OVH](https://ovh.com), which are recommended. The interface with other registrars may work, but is still considered experimental until we gather feedback from the community.

The list below can help you to choose a registrar if you plan to buy a domain name to use it with YunoHost.

| Registrar | Compatibility | Easy to obtain an API key | Howto |
| --------- | ------------- | ------------------ |
| [Gandi](https://www.gandi.net)     | ✘ (broken)    | ✘ |  [Obtain an API key](/providers/registrar/gandi/autodns)                | see bug here https://github.com/YunoHost/issues/issues/2419
| [OVH](https://www.ovh.com/domaines/)       | ✔ (tested)    | ✘ | [Obtain an API key](/providers/registrar/ovh/autodns) <br> [Configure manually](/providers/registrar/ovh/manualdns) |
| [Namecheap](https://www.namecheap.com/) | ✘ (in lexicon but untested)    | ✘✘✘ API not available without 50$ on the account  | [Obtain an API key](/providers/registrar/namecheap/autodns)|
