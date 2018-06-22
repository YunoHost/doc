# Frequently Asked Questions


#### Under which licence is YunoHost distributed?

YunoHost packages are under free licenses GNU AGPL v.3.

YunoHost is based on Debian, so on licenses of Debian based elements.

Applications and applications packages have their respectives licenses.


#### What is the goal of YunoHost?

We believe that decentralizing the Internet, and people taking back control and
responsability over their own data and services, is a crucial issue to guarantee
a free and democratic society.

The YunoHost project aims to democratize self-hosting.

It provides a software that aim to make it easy for people to run and
administrate their own server, with minimal knowledge and time required.


#### But what does YunoHost *do* exactly?

YunoHost may be called a distribution or an operating system, but it's actually
"just" a simple layer added over the top of Debian, which does most of the hard
work for you.

For instance, if you wanted to install Wordpress, you would need to type a bunch
of commands to create some users, setup a web server, setup a SQL server,
download the wordpress archive, uncompress it, configure the web server,
configure the SQL database, and finally configure wordpress. YunoHost handle
the technical mess and "type all these commands for you", so that you can focus
on what really matters.

More info on [this page](whatsyunohost) !

#### Can I host my own personnal website with YunoHost?

Yes ! Have a look at the [Custom Web app](https://github.com/YunoHost-Apps/my_webapp_ynh).
It provides an "empty shell" : after installing it, just upload your files
(via SSH/SCP or SFTP) to the right location. You can have PHP and a SQL database
if you need.


#### Can I host many independents websites with different domain names?

Yes ! YunoHost is multi-user and multi-domain. Some applications like *WordPress* or *Web App Multi Custom*, are multi-instances, which means that the application can be installed many times.


#### Why can't I access to applications via the IP address?

The [SSO](https://github.com/Kloadut/SSOwat/) (single sign-on) cannot properly authenticate users when they access your server with only its IP. If you really can't configure the DNS properly, you can temporarily work around it by [modifying the `hosts` file (last §)](dns_local_network_en) on your computer.


#### What's YunoHost's business model?

At the moment, YunoHost is maintained only by volunteers working in their free
time. Basically no money is involved in the project (apart from server fees
or stickers :P).

Considering that a few contributors are investing a large amount of time in the
project, we are thinking about ways to make the project sustainable.

This could be achieved via donations, public fundings, and a few contributors
have professional activities related to YunoHost.


#### Can I make donations to the project?

Yes, you can ! YunoHost needs money to pay servers and domain names. We would
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

It is described in [this document](https://github.com/YunoHost/project-organization/blob/master/yunohost_project_organization.md) :).


#### Will you port YunoHost to [insert favorite distro] ?

Short answer: No. We don't have the energy for it and this is irrelevant.

<a data-toggle="collapse" data-target="#willyouportyunohost" href="#">Long answer</a>
<div id="willyouportyunohost" class="collapse">
<p>If you care about distrowars, or think 'Debian is dirty', you are not the public of YunoHost.</p>

<p>YunoHost is aimed at non-tech people who just want their server to work. Debian has its flaws, but it's (one of?) the most widely known and used distribution for servers. It's stable. Most self-hosted softwares are one way or another compatible with Debian. It's easily hackable by anybody who's been doing a bit of CLI on their personal Ubuntu/Mint computer. There is no killer feature in other distributions that makes it relevant for YunoHost to switch or port it.</p>

<p>If this does not convince you, there are other projects running on other distributions or with different philosophy.</p>
</div>


#### I checked how apps packaging work. Why are you reinventing [insert favorite package format] ?

Short answer: We are not.

Medium answer: Apps were packaged in .deb in the past. It was a nightmare. We're happy now ;).

<a data-toggle="collapse" data-target="#whyareyoureinventingpackaging" href="#">Long answer</a>
<div id="whyareyoureinventingpackaging" class="collapse">

<p>YunoHost aims to make packaging easy. The idea from the beginning was to keep it as simple as « if you can install the app manually, then you can easily copy/paste steps into a basic install/remove package with no particular training ». This is not the case with Debian packages.</p>

<p>Turns out, YunoHost apps packaging holds a subtly different purpose than traditional packaging like .deb. Debian packages fulfill the low-level purpose of installing files, commands, programs and services on the system. It is often your duty to configure them properly, simply because there is no standard server setup. Typically, web apps requires a lot of configuration because they rely on a web server and a database (and the single sign-on).</p>

<p>YunoHost manipulate high-level abstractions (apps, domains, users, ...) and defines a standard setup (Nginx, Postfix, Metronome, SSOwat, ...) and, because of this, can handle the configuration for the user.</p>

<p>If you still think deb packages can be hacked to do this, see previous answers.</p>
</div>
