# Frequently Asked Questions


#### Under which license is YunoHost distributed?

YunoHost packages are under free licenses GNU AGPL v.3.

YunoHost is based on Debian, so on Debian's components' licenses.

Applications and applications packages have their own licenses.


#### What's YunoHost goal?

We believe that decentralizing the Internet, and empowering people to take control and
responsibility back over their own data and services, is a crucial issue to guarantee
a free and democratic society.

The YunoHost project aims to democratize self-hosting.

It provides a software that aims to make it easy for people to run and
administrate their own server, with minimal knowledge and required time.


#### But what does YunoHost exactly *do*?

YunoHost may be called a distribution or an operating system, but it's actually
"just" a simple layer added over the top of Debian, which does most of the hard
work for you.

For instance, if you wanted to install Wordpress, you would need to type a bunch
of commands to create some users, setup a web server, setup a SQL server,
download the Wordpress archive, uncompress it, configure the web server,
configure the SQL database, and finally configure Wordpress. YunoHost handles
the technical details and "types all these commands for you", so that you can focus
on what really matters.

More info on [this page](whatsyunohost) !

#### Can I host my own personal website with YunoHost?

Yes! Have a look at the [Custom Web app](https://github.com/YunoHost-Apps/my_webapp_ynh).
It provides an "empty shell" : after installing it, just upload your files
(via SSH/SCP or SFTP) to the right location. You can have PHP and a SQL database
if you need.


#### Can I host many independent websites with different domain names?

Yes! YunoHost is multi-user and multi-domain. Some applications like *WordPress* or *Web App Multi Custom*, are multi-instances, which means that the application can be installed many times.


#### Why can't I access applications via the IP address?

The [SSO](https://github.com/Kloadut/SSOwat/) (single sign-on) cannot properly authenticate users when they access your server with only its IP. If you really can't properly configure the DNS, you can temporarily work around it by [modifying the `hosts` file (last §)](dns_local_network_en) on your computer.


#### What's YunoHost's business model?

At the moment, YunoHost is maintained only by volunteers working in their free
time. Basically no money is involved in the project (apart from server fees
or stickers :P).

Considering that a few contributors are investing a large amount of time in the
project, we are thinking about ways to make the project sustainable.

This could be achieved via donations, grants, and a few contributors
have professional activities related to YunoHost.


#### Can I donate to the project?

Yes, you can! YunoHost needs money to pay servers and domain names. We would
also like contributors to be able to continue contributing rather than look for
jobs elsewhere.

You can donate on [Liberapay](https://liberapay.com/yunohost).

If you can, you can also make in-kind contributions, like servers (some of our
infrastructure relies on servers from a few associations).


#### How can I contribute to the project?

There are [many ways to contribute](contribute) :).

Don't hesitate to come talk to us about your ideas!

A common misconception for newcomers in free software projects is to think that
they are "not skilled enough". In practice, nobody is "skilled" :). What really
matter is : [liking what you do](https://www.youtube.com/watch?v=zIbR5TAz2xQ&t=113s),
being friendly with other human beings, being patient and stubborn with machines,
and having some free time. Other than that, just doing what you can is already awesome!


#### What's YunoHost's political model?

It is described in [this document](project_organization) :).


#### Will you port YunoHost to [insert favorite distro]?

Short answer: No. We don't have the energy for it and this is irrelevant.

<a data-toggle="collapse" data-target="#willyouportyunohost" href="#">Long answer</a>
<div id="willyouportyunohost" class="collapse">
<p>If you care about distrowars, or think 'Debian is dirty', then YunoHost is not for you.</p>

<p>YunoHost is aimed at non-tech people who just want their server to work. Debian has its flaws, but it's (one of?) the most widely known and used distribution for servers. It's stable. Most self-hosted software are one way or another compatible with Debian. It's easily hackable by anybody who's been doing a bit of CLI on their personal Ubuntu/Mint computer. There is no killer feature in other distributions that makes it relevant for YunoHost to switch or port to it.</p>

<p>If this does not convince you, there are other projects running on other distributions or with different philosophies.</p>
</div>


#### I checked how apps packaging work. Why are you reinventing [insert favorite package format] ?

Short answer: We are not.

Medium answer: Apps were packaged in .deb in the past. It was a nightmare. We're happy now ;).

<a data-toggle="collapse" data-target="#whyareyoureinventingpackaging" href="#">Long answer</a>
<div id="whyareyoureinventingpackaging" class="collapse">

<p>YunoHost aims to make packaging easy. The idea from the beginning was to keep it as simple as « if you can install the app manually, then you can easily copy/paste steps into a basic install/remove package with no particular training ». This is not the case with Debian packages.</p>

<p>Turns out, YunoHost apps packaging holds a subtly different purpose than traditional packaging like .deb. Debian packages fulfill the low-level purpose of installing files, commands, programs and services on the system. It is often your duty to configure them properly, simply because there is no standard server setup. Typically, web apps requires a lot of configuration because they rely on a web server and a database (and the single sign-on).</p>

<p>YunoHost manipulates high-level abstractions (apps, domains, users, ...) and defines a standard setup (Nginx, Postfix, Metronome, SSOwat, ...) and, because of this, can handle the configuration for the user.</p>

<p>If you still think it's possible to handle everything by fiddling with .deb packages, see previous answers.</p>
</div>
