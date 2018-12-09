# Advices and guidelines

This page lists a few advices and guidelines which every YunoHost administrator should be aware to take care of a YunoHost server :).

## Do not break YunoHost

To put it another way : your server is either a production server (meant to work) or a test server on which you allow yourself to experiment.

If your goal is to run a production server, then please : 
- be aware that servers are fragile system. Stay cautious, methodical and patient ;
- limit experimentations and customizations (for instance of config file) ;
- do not install dozens of apps just to see how they look ;
- use non-official apps with caution, and do not use apps that are still 'in progress', 'not working' or level 0 ;
- if something gets broken, think twice about fixing it by yourself if you don't know what you are doing. <small>(For instance, do not attempt to recreate yourself the admin user just because it mysteriously disappeared...)</small>

## Keep it simple !

YunoHost is designed to work with general and simple use cases in mind. Deviating from those conditions will make things harder and you will need technical knowledge to make it work. For instance, 
- do not try to run YunoHost in a context where you cannot have control over ports 80 and 443 (or no internet at all) ; 
- do not try to host five servers behind the same internet connection if you are not already an advanced user ; 
- do not fall into nerd whims such as willing to replace nginx by Apache (or run both at the same time) ; 
- do not try to use custom SSL certificates if you don't really need them ;
- ...

Keep things as simple as you can !

## Do not reinstall every day

Some people tend to fall into "the reinstallation spiral" - where each time something breaks in the server and it is not obvious how to fix it, or because the server became "dirty", one ends up reinstalling the whole server from scratch because it looks like an "easy" and quick solution to clean the table.

Please don't do this. Reinstalling is a heavy operation and is not a good long-term strategy for fixing problems. You will get tired and won't learn anything. Forget the dream of having a "clean" server. A real-life server always end up being a bit "dirty". Also, you need to (progressively) learn how to solve issues when you encounter them. Reach for [help](/help) with detailed symptoms of what you are trying to do and what is happening, and fix the issues. Over time, you will get a much better control over your server than just blindly reinstalling every time.

## Do backups

If you host services and data that are important for your users, it is important that you setup a backup policy. Backups can be easily created from the webadmin - though they currently cannot be downloaded from it (but it can be downloaded through other means). You should perform backup regularly and keep them in a safe and different physical location from your server. More info on [the backup documentation](/backup).

## Check root's email

As an administrator, you should configure an email client to check emails sent to `root@your.domain.tld` (which should be an alias to the first user your added) or otherwise forward them to another address that you actively check. Those mails may contain information on what is happening on your server such as automated periodic tasks.

## YunoHost is free software, maintained by volunteers 

Finally, keep in mind that YunoHost is a free software maintained by volunteers - and that the goal of YunoHost (to democratize self-hosting) is not an easy one ! It is provided without any warranty. The team of volunteers does its best to maintain and provide the best possible experience - yet features, applications and YunoHost as a whole are far from being perfect and you will experience small and big shortcomings at some points. When this happens, kindly [reach for help on the chat or forum, or report the issue](/help) :) !

If you like YunoHost and want to see the project being kept alive and make progress, feel free to leave a thank you note and to [donate](https://liberapay.com/YunoHost) to the project and talk about it around you !

Last but not least, since YunoHost is a free software project, you are legitimate and welcomed to come and [contribute](/contribute) to the project, be it on the technical aspects (i.e. code) and less-technical aspects (such as contributing to this documentation ;)) !


