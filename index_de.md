<div class="teasing-part">                                                                      

  <div class="home-logo">
    <img src="/images/ynh_logo_white_300dpi.png" width="100"/>
  </div>

  <div class="punchline">
    <p>
      <span class="yolo 1" style="color: #FF3399;">Selbst-Hosting für dich, Mom.</span>
      <span class="yolo 2" style="color: #6699FF;">Hasser werden Gastgeber sein</span>
      <span class="yolo 3" style="color: #66FF33;">Ich beherberge mich selbst, b*tches</span>
      <span class="yolo 4" style="color: #00FFCC;">Geh und bewirte dich!</span>
      <span class="yolo 5" style="color: #FF5050;">Raus aus meiner Cloud</span>
      <span class="yolo 6" style="color: #FF0066;">Beherbergt mich, ich bin berühmt.</span>
      <span class="yolo 7" style="color: #3366FF;">Versuchen Internet</span>
      <span class="yolo 8" style="color: #FFFFFF;">Wie kann I ich eure Server begegnen ?</span>
      <span class="yolo 9" style="color: #FF6600;">john@doe.org</span>
      <span class="yolo 10" style="color: #FF5050;">dude, Y U NO Host?!</span>
      <span class="yolo 11" style="color: #66FF33;">Ruhe bewahren und sich selbst bewirten</span>
    </p>
    <button class="btn btn-primary btn-lg btn-block yolobtn">Wie bitte?</button>
  </div>

  <div class="main-links hidden-xs">
    <a href="/whatsyunohost">Über Yunohost</a> <span class="colored-bar">•</span> 
    <a href="https://forum.yunohost.org/c/announcement" target="_blank">Letzte Nachrichten</a> <span class="colored-bar">•</span> 
    <a href="/docs">Dokumentation</a>
  </div>
  </div><!-- teasing-part -->

<div class="boring-part" markdown="1">

  <a href="https://github.com/YunoHost" target="_blank" class="github-ribbon hidden-xs">
    <img src="/images/github_ribbon_grey.png" alt="Folgen Sie Yunohost auf GitHub">
  </a>

  <h1>YunoHost <small>ist ein Serverbetriebssystem mit dem Ziel,<br>
Self-Hosting für jedermann zugänglich zu machen.</small></h1>

  <div class="home-panel">
    <img src="/images/home_panel.jpg" />
  </div>

  <div class="call-to-action">
    <a class="btn btn-primary btn-lg" href="/try">Ausprobieren</a>
    <a class="btn btn-success btn-lg" href="/install">Beginnen</a>
    <p class="text-muted"><small><a href="https://forum.yunohost.org/t/yunohost-3-4-release-sortie-de-yunohost-3-4/6950">YunoHost v3.4</a></small></p>
  </div>

  <div class="row cf">
    <div class="col-md-7">
      <h1>Installieren<small> Sie ganz einfach Ihren eigenen Server. Sie haben bereits alles, was Sie brauchen.</small></h1>
      <p><br /><a href="/hardware">Hardware-Voraussetzungen</a></p>
    </div>
    <div class="col-md-4">
      <div class="feature-pic">
        <img src="/images/home_install.png" />
      </div>
    </div>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-4">
      <div class="feature-pic">
        <img src="/images/home_enjoy.jpg" />
      </div>
    </div>
    <div class="col-md-7 text-right">
      <h1>Erfreuen <small>Sie sich an Ihren eigenen Apps und richten Sie ihre eigene kleine Ecke im Netz ein.</small></h1>
      <p><br /><a href="/apps">Liste der verfügbaren Apps</a></p>
    </div>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-7">
      <h1>Verwalten <small>Sie Ihren Server so, wie Sie es wünschen: per Web, mobil oder mit der Kommandozeile.</small></h1>
      <p><br /><a href="/try">Administrationsoberfläche testen</a></p>
    </div>
    <div class="col-md-4">
      <div class="feature-pic">
        <img src="/images/home_manage.jpg" />
      </div>
    </div>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-4 button-list">
      <a class="btn btn-lg btn-block btn-primary" href="/whatsyunohost">Uber YunoHost</a>
      <a class="btn btn-lg btn-block btn-info" href="/docs">Dokumentation</a>
      <a class="btn btn-lg btn-block btn-success" href="/contribute">Engagieren Sie sich</a>
      <a class="btn btn-lg btn-block btn-warning" href="https://forum.yunohost.org/" target="_blank">Forum</a>
      <a class="btn btn-lg btn-block btn-default" href="chat_rooms_de" target="_blank">Chaträume</a>
      <a class="btn btn-lg btn-block btn-danger" href="https://forum.yunohost.org/c/announcement">Letzte Nachrichten</a>
      <a class="btn btn-lg btn-block btn-danger btn-support" href="/help_de">Support</a>
    </div>
    <div class="col-md-7 text-right">
      <h1>Erfahren <small>Sie, was Sie mit einem Server machen können,<br> und warum es sinnvoll ist.</small></h1>
      <p><br /><a href="/docs">Lesen Sie die Dokumentation</a></p>
    </div>
  </div>

  <hr />

  <div class="text-center">
    <h1>Hey! Wir sind Menschen.<br /><small> Wenn Sie eine Frage oder ein Problem haben oder wenn Sie auch nur neugierig sind, hinterlassen Sie gerne eine Nachricht in unserem Chatraum, indem Sie auf den untenstehenden Button klicken.&nbsp;<span class="glyphicon glyphicon-share-alt"></span> </small></h1>

   <p class="liberapay">
     <a href="https://liberapay.com/YunoHost" target="_blank"><img src="/images/liberapay_logo.svg" alt="Donation button" title="Liberapay" /></a>
    </p>

  </div>

</div><!-- boring-part -->

<script type="text/javascript">
    jQuery('.teasing-part').css({
        marginTop: '0',
        display: 'block'
    });
    jQuery('.boring-part').css({
        marginTop: jQuery(window).height() + 100
    });
    jQuery( window ).resize(function() {
        jQuery('.boring-part').css({
            marginTop: jQuery('.teasing-part').height() + 100
        });
    });
    jQuery('.yolo').hide();
    randomNumber = Math.floor((Math.random()*jQuery('.yolo').length)+1);
    color = jQuery('.yolo.' + randomNumber).css('color');
    jQuery('.yolo.' + randomNumber).fadeIn();
    document.title = jQuery('.yolo.' + randomNumber).text();
    jQuery('.colored-bar').css({
      color: color,
      fontWeight: 'bold',
      padding: '1%'
    });
    jQuery('.yolobtn').css({
      background: color,
      borderColor: color
    }).on('click', function() {
      jQuery('html, body').animate({
        scrollTop: jQuery(window).height() + 80
      }, 500);
    });

</script>

