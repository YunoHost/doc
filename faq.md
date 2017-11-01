# Frequently Asked Questions

#### Under which licence is YunoHost distributed?

YunoHost packages are under free licenses GNU AGPL v.3.

YunoHost is based on Debian, so on licenses of Debian based elements.

Applications and applications packages have their respectives licenses.

#### Can I host many independents websites with different domain names?

Yes ! YunoHost is multi-user and multi-domain. Some applications like *WordPress* or *Web App Multi Custom*, are multi-instances, which means that the application can be installed many times.

#### Why can't I access to applications via the IP address?

The [SSO](https://github.com/Kloadut/SSOwat/) (single sign-on) cannot properly authenticate users when they access your server with only its IP. If you really can't configure the DNS properly, you can temporarily work around it by [modifying the `hosts` file (last §)](dns_local_network_en) on your computer.


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
