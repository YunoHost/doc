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
---

In order to ease the [DNS configuration process](/dns_config), YunoHost 4.3+ come with a feature allowing to automatically push the configuration to your registrar (the website where you buy a domain name).

However, some registrar are not compatible/tested with this feature or are more difficult to configure with cause the registrar user interface to get credentials are too complicated.

The list bellow can help you to choose a registrar if you plan to buy a domain name to use it with YunoHost.


| Registrar | Compatibility | Easy setup process |
| --------- | ------------- | ------------------ |
| [Gandi](https://www.gandi.net)     | ✔ (tested)    | ✔                  |
| [OVH](https://www.ovh.com/domaines/)       | ✔ (tested)    | ✘ [Tutorial](/providers/registrar/ovh)  |
| [Namecheap](https://www.namecheap.com/) | ✘ (in lexicon but untested)    | ✘✘✘ API not available without 50$ on the account  |
