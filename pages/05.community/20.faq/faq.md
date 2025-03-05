---
title: Frequently Asked Questions
template: docs
taxonomy:
    category: docs
routes:
  default: '/faq'
---

#### Under which license is YunoHost distributed?

YunoHost packages are under free licenses GNU AGPL v.3.

YunoHost is based on Debian, so on Debian's components' licenses.

Applications and applications packages have their own licenses.

#### What's YunoHost goal? {#what-s-yunohost-goal}

We believe that decentralizing the Internet, and empowering people to take control and responsibility back over their own data and services, is a crucial issue to guarantee a free and democratic society.

The YunoHost project aims to democratize self-hosting.

It provides a software that aims to make it easy for people to run and administer their own server, with minimal knowledge and required time.

#### But what does YunoHost exactly *do*?

YunoHost is a distribution, in the sense that it is a purpose-specific version of GNU/Linux-Debian and it distributes a set of application via its catalog, but it is also "just" a program that automatically configures Debian and does most of the hard work for you.

For instance, if you wanted to install WordPress, you would need to type a bunch of commands to create some users, setup a web server, setup a SQL server, download the WordPress archive, uncompress it, configure the web server, configure the SQL database, and finally configure WordPress. YunoHost handles the technical details and "types all these commands for you", so that you can focus on what really matters.

More info on [this page](/whatsyunohost)!

#### Can I host my own personal website with YunoHost?

Yes! Have a look at the [Custom Web app](https://github.com/YunoHost-Apps/my_webapp_ynh). It provides an "empty shell" : after installing it, just upload your files (via SSH/SCP or SFTP) to the right location. You can have PHP and a SQL database if you need.

#### Can I host many independent websites with different domain names?

Yes! YunoHost is multi-user and multi-domain. Some applications like *WordPress* or *My webapp*, are multi-instances, which means that the application can be installed many times.

#### Why can't I access applications via the IP address?

The [SSO](https://github.com/Kloadut/SSOwat/) (single sign-on) cannot properly authenticate users when they access your server with only its IP. If you really can't properly configure the DNS, you can temporarily work around it by [modifying the `hosts` file (last §)](/dns_local_network) on your computer.

#### What's YunoHost's business model?

YunoHost is maintained by volunteers working on their free time. The project regularly receives donations which pay for the servers' bills and stickers. The project received (or continues to receive) grants from organization like [NLnet](https://nlnet.nl/) or [CodeLutin](https://www.codelutin.com/) to fund specific developments

Donations to the project are increasing, and we are in the process of defining the way we redistribute this money to main contributors and therefore help make the project sustainable. Additionally, some contributors do have professional activities based (at least partially) on YunoHost.

#### Can I donate to the project?

Yes, you can! YunoHost needs money to pay servers and domain names. We would also like contributors to be able to spend more time contributing rather than looking for jobs.

You can donate using [our donation interface](https://donate.yunohost.org)

If you can, you can also make in-kind contributions, like servers (some of our infrastructure relies on servers from a few associations).

#### How can I contribute to the project?

There are [many ways to contribute](/contribute) :).

Don't hesitate to come talk to us about your ideas!

A common misconception for newcomers in free software projects is to think that they are "not skilled enough". In practice, nobody is "skilled" :). What really matter is: [liking what you do](https://www.youtube.com/watch?v=zIbR5TAz2xQ&t=113s), being friendly with other human beings, being patient and stubborn with machines, and having some free time. Other than that, just doing what you can is already awesome!

#### How is the YunoHost project organized?

It is described in [this document](/project_organization) :).

#### Will you port YunoHost to [insert favorite distro]?

If you care about distrowars, or think 'Debian is dirty', then YunoHost is not for you.

YunoHost is aimed at non-tech people who just want their server to work. Debian has its flaws, but it's (one of?) the most widely known and used distribution for servers. It's stable. Most self-hosted software are one way or another compatible with Debian. It's easily hackable by anybody who's been doing a bit of CLI on their personal Ubuntu/Mint computer. There is no killer feature in other distributions that makes it relevant for YunoHost to switch or port to it.

If this does not convince you, there are other projects running on other distributions or with different philosophies.

#### I checked how apps packaging work. Why are you reinventing [insert favorite package format]?

People have been tempted to compare YunoHost packages to traditional package managers (such as Debian's `.deb`), which hold a different purpose. Traditional package managers are meant to install low-level purpose of installing files, commands, programs and services on the system. It is often your duty to configure them properly, simply because there is no standard server setup. Typically, web apps requires a lot of configuration because they rely on a web server and a database (and the single sign-on).

YunoHost manages high-level abstractions (apps, domains, users...) and defines a standard setup (NGINX, Postfix, Metronome, SSOwat...) and, because of this, can handle the configuration for the user.

#### When will [this feature] be implemented? Why isn't [that app] packaged yet? I cannot believe you do not do [this] yet!

We do not give timelines.

We are a bunch of volunteers working on our free time to maintain and develop YunoHost. We have no product owner or project manager handling resources, we are not a business. We do what we can, because we love this software, when we can.

If you really want to have a feature implemented or documented, or an app packaged, [consider contributing yourself](/contribute)! We would love helping you get started.

### What is YunoHost's policy regarding the apps included in the official catalog ?

See [this page](/packaging_policy)

### Why won't you include [feature X] ?

YunoHost is primarily designed for not-so-tech-savvy users and aims to remain relatively simple in terms of UI/UX. At the same time, the project has limited time and energy available to be maintained and developed. Therefore we may lower the priority of features, or refuse entirely the inclusion of features, based on the criteria that they:

- would only be meaningful for advanced / power-users stuff which is out of the scope of the project ;
- would introduce too much UI/UX bloat ;
- would only cover unrealistic threat models ;
- would be there only to satisfy purists ;
- or overall would not be worth it in terms of development/maintenance time/energy for what it brings to the project.
