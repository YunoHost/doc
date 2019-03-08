<div class="teasing-part">                                                                      

  <div class="home-logo">
    <img src="/images/ynh_logo_white_300dpi.png" width="100"/>
  </div>

  <div class="punchline">
    <p>
      <span class="yolo 1" style="color: #FF3399;">Self-hosting for you, mom</span>
      <span class="yolo 2" style="color: #6699FF;">Haters gonna host</span>
      <span class="yolo 3" style="color: #66FF33;">I host myself, Yo!</span>
      <span class="yolo 4" style="color: #00FFCC;">Go host yourself!</span>
      <span class="yolo 5" style="color: #FF5050;">Get off of my cloud</span>
      <span class="yolo 6" style="color: #FF0066;">Host me I’m famous</span>
      <span class="yolo 7" style="color: #3366FF;">Try Internet</span>
      <span class="yolo 8" style="color: #FFFFFF;">How I met your server</span>
      <span class="yolo 9" style="color: #FF6600;">mario@rossi.it</span>
      <span class="yolo 10" style="color: #FF5050;">dude, Y U NO Host?!</span>
      <span class="yolo 11" style="color: #66FF33;">Keep calm and host yourself</span>
    </p>
    <button class="btn btn-primary btn-lg btn-block yolobtn">Scusa?</button>
  </div>

  <div class="main-links hidden-xs">
    <a href="/whatsyunohost">A proposito</a> <span class="colored-bar">•</span> 
    <a href="https://forum.yunohost.org/c/announcement" target="_blank">Ultime notizie</a> <span class="colored-bar">•</span> 
    <a href="/docs">Documentazione</a>
  </div>

</div><!-- teasing-part -->

<div class="boring-part" markdown="1">

  <a href="https://github.com/YunoHost" target="_blank" class="github-ribbon hidden-xs">
    <img src="/images/github_ribbon_grey.png" alt="Fork me on GitHub">
  </a>

  <h1>YunoHost <small>è un sistema operativo per server con l'obiettivo di rendere il self-host accessibile a tutti.</small></h1>

  <div class="home-panel">
    <img src="/images/home_panel.jpg" />
  </div>

  <div class="call-to-action">
    <a class="btn btn-primary btn-lg" href="/try">Provalo</a>
    <a class="btn btn-success btn-lg" href="/install">Per cominciare</a>
    <p class="text-muted"><small><a href="https://forum.yunohost.org/t/yunohost-3-4-release-sortie-de-yunohost-3-4/6950">YunoHost v3.4</a></small></p>
  </div>

  <div class="row cf">
    <div class="col-md-7">
      <h1>Installa <small>il tuo server con facilità, hai già tutto a casa</small></h1>
      <p><br /><a href="/hardware">Vedi i requisiti</a></p>
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
      <h1>Dilettati <small>con le tue app e crea il tuo piccolo angolo di Internet</small></h1>
      <p><br /><a href="/apps">Lista delle app disponibili</a></p>
    </div>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-7">
      <h1>Gestisci <small>il tuo server nel modo che preferisci: via Web, mobile o riga di comando</small></h1>
      <p><br /><a href="/try">Prova l'amministrazione</a></p>
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
      <a class="btn btn-lg btn-block btn-primary" href="/whatsyunohost">A proposito di YunoHost</a>
      <a class="btn btn-lg btn-block btn-info" href="/docs">Documentazione</a>
      <a class="btn btn-lg btn-block btn-success" href="/contribute">Contribuisci</a>
      <a class="btn btn-lg btn-block btn-warning" href="https://forum.yunohost.org/" target="_blank">Forum</a>
      <a class="btn btn-lg btn-block btn-default" href="chat_rooms_en" target="_blank">Chat</a>
      <a class="btn btn-lg btn-block btn-danger" href="https://forum.yunohost.org/c/announcement">Ultime notizie</a>
      <a class="btn btn-lg btn-block btn-danger btn-support" href="/help_fr">Supporto</a>
    </div>
    <div class="col-md-7 text-right">
      <h1>Esplora <small>cosa puoi fare con un server, e perchè è importante</small></h1>
      <p><br /><a href="/docs">Leggi la documentazione</a></p>
    </div>
  </div>

  <hr />

  <div class="text-center">
    <h1>Hey! Siamo umani!<br /><small> Se hai domande, problemi o se sei solo un appassionato, lascia un messaggio sulla nostra chat cliccando il pulsante qui sotto &nbsp;<span class="glyphicon glyphicon-share-alt"></span> </small></h1>

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

