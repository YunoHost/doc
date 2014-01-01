#YunoHost <small>is a server operating system aiming to make self-hosting accessible to everyone.</small>

<br>

<div style="width: 100%; height: 290px; overflow: hidden;
border-radius: 5px; border: 1px solid rgba(0,0,0,0.15); box-shadow: 0 5px 15px rgba(0,0,0,0.15);">
<img style="width: 100%; min-width: 580px;" src="http://pix.toile-libre.org/upload/original/1388434791.jpg">
</div>

<br>

<div class="text-center" style="width: 23%; min-width: 130px; margin: 0 auto;">
<a class="btn btn-primary btn-lg btn-block"  style="font-size: 1.5em" href="#/install">Install</a>
</div>
<p class="text-muted text-center"><small>YunoHost v2 • beta3</small></p>
</div>

<hr>

### <blockquote>Features</blockquote>

By default, YunoHost provides a secure solution to manage your mail & instant messaging addresses with ease, while using nice interfaces. 

You will also be able to extend your server's capabilities by installing [**apps**](#/apps) with one click.

### <blockquote>Software</blockquote>

Based on [Debian GNU/Linux](http://www.debian.org/index.en.html) (wheezy), YunoHost comes with the following free software:
* [Nginx](http://nginx.org/)
* [Postfix](http://www.postfix.org/)
* [Metronome](http://www.lightwitch.org/metronome)
* [OpenLDAP](http://www.openldap.org/)
* [Dovecot](http://www.dovecot.org/)
* [dspam](http://nuclearelephant.com/)
* [Amavis](http://amavis.org/)
* [Bind](https://www.isc.org/downloads/bind/)
* [Samba](http://www.samba.org/)
* [Tahoe-LAFS](https://tahoe-lafs.org/trac/tahoe-lafs)
* [SSOwat](https://github.com/Kloadut/SSOwat)

YunoHost automatically configures all these of applications at installation, unifying their usage through a [web interface](#/admin) or via the command-line interface called "[moulinette](#/moulinette)".

### <blockquote>Security</blockquote>

Every protocol used in YunoHost is secured by default. You will get a self-signed certificate automatically for every served domain.

Moreover, all of the software used in YunoHost is composed of known free and open-source projects, meaning that they are less likely to be vulnerable to security flaws.

A firewall is also deployed at installation, protecting you from undesirable and dangerous connections.


<br>
<div class="text-center"><img style="width: 100px" src="http://pix.toile-libre.org/upload/original/1386012810.png" />
<p>[Github](https://github.com/YunoHost) <b>/</b> [FAQ](https://ask.yunohost.org) <b>/</b> [Translate](https://translate.yunohost.org/) <b>/</b> [Old Wiki](http://wiki.yunohost.org) </p>
</div>

<script type="text/javascript">
    jQuery.ajaxSetup({cache: true});
    jQuery.getScript("https://doc.yunohost.org/jappix-en.js", function() {
      MINI_GROUPCHATS = ["support@conference.yunohost.org"];
      HOST_ANONYMOUS = "yunohost.org";
      HOST_MUC = "conference.yunohost.org";
      HOST_BOSH = "https://yunohost.org/http-bind/";
      HOST_BOSH_MINI = "https://yunohost.org/http-bind/";
      LOCK_HOST = 'on';
      MINI_ANIMATE = true;
      MINI_ANONYMOUS = true;
      launchMini(false, true, 'yunohost.org');
    });
    $("#edit").hide();
</script>
