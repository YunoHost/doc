---
title: YunoHost's policy regarding the apps included in the official catalog
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_policy'
---

### License

The rule of thumb is that we only include software licensed under a free-software license in the official app catalog.

However, as YunoHost evolved, some gray-cases appeared with softwares that would be relevant for YunoHost's goal and match its spirit, while not being strictly-speaking free-software. Situations such as:

- software promoting the use of centralized services, though precisely to avoid their direct usage ;
- software relying on non-free dependencies or assets ;
- "new" post-open-source / ethical-yet-not-free licenses such as the [ACSL](https://anticapitalist.software/), the [HL3](https://firstdonoharm.dev/) or the [CoopCycle License](https://github.com/coopcycle/coopcycle-web/blob/master/LICENSE) ;
- "open-core" models, trademark clauses, or business-related license clauses (such as the BSL) which are meant to ensure the project's sustainability while still remaining ethical.

While we believe free software principles are an essential footstep towards [YunoHost's goal](#what-s-yunohost-goal), we believe they are a means and not an end. We reject the purist vision according to which software is either free or proprietary, and the flawed premise that technology is fundamentally neutral. We believe that ethical software and technology can and should exist beyond the definition of free software layed 40 years ago (see also: [Freedom isn't Free](https://logicmag.io/failure/freedom-isnt-free/) and [Post-Open Source](https://www.boringcactus.com/2020/08/13/post-open-source.html)).

The project therefore allows the inclusion inside the official app catalog, ***on a case-by-case basis***, of apps which does not qualify as "free software", yet considered to be ethical and worthy of interest for [YunoHost's goal](#what-s-yunohost-goal). Such apps are tagged in the catalog, such that an explicit message displayed before their installation.

If you notice an app is missing such a tag/disclaimer, feel free to open a discussion or pull requet on [the app catalog](https://github.com/YunoHost/apps/).

If you run YunoHost for your business, you are responsible for doing your due diligence by checking the licenses of the software you want to install on your server.

### Nature of the app

In addition, the YunoHost team decided to not including apps in the official catalog if they:
- are overly complex to deploy or resource-hungry compared to their features ; 
- only apply to super niche use cases ;
- promote cryptocurrencies ;
- promote AI for purposes deemed gadgety compared to the ecological cost involved behind the scenes ;
- promote shady activities such as tracking/stalking people.

The team may make exceptions to these criterias on a case-by-case basis. The team may also amend this list with other criterias in the future.

### What to do if you're not happy with these criterias

These previous criterias does not mean that apps cannot be created, just that they won't be included in the official catalog. You can manually install specific repo using `yunohost app install <url_to_git_repo_ynh>` or even creating and adding a custom catalog source with in `/etc/yunohost/apps_catalog.yml`
