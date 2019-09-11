<div class="teasing-part">                                                                      

  <div class="home-logo">
    <img src="/images/ynh_logo_white_300dpi.png" width="100"/>
  </div>

  <div class="punchline">
    <p>
      <span class="yolo 1" style="color: #FF3399;">Ven a l’ostal, soi albergat en çò d’una amiga</span>
      <span class="yolo 2" style="color: #FF0066;">S’alberguèron e aguèron un molon d’enfants</span>
      <span class="yolo 3" style="color: #3366FF;">Internet, lectura e escritura</span>
      <span class="yolo 4" style="color: #FFFFFF;">monssur@michu.fr</span>
      <span class="yolo 5" style="color: #CC66FF;">Ai pas res a rescondre</span>
      <span class="yolo 6" style="color: #FF6600;">How I met your server</span>
    </p>
    <button class="btn btn-primary btn-lg btn-block yolobtn">Perdon ?</button>
  </div>

  <div class="main-links hidden-xs">
    <a href="/whatsyunohost_fr">A prepaus</a> <span class="colored-bar">•</span> 
    <a href="https://forum.yunohost.org/c/announcement" target="_blank">Darrièras novèlas</a> <span class="colored-bar">•</span> 
    <a href="/docs_fr">Documentacion</a>
  </div>

</div><!-- teasing-part -->

<div class="boring-part" markdown="1">

  <h1>YunoHost <small> es una aisina que vos permet d’installar e d’utilizar facilament vòstre pròpri servidor.</small></h1>

  <div class="home-panel">
    <img src="/images/home_panel.jpg" />
  </div>

  <div class="call-to-action">
    <a class="btn btn-primary btn-lg" href="/try_fr">Ensajar</a>
    <a class="btn btn-success btn-lg" href="/install_fr">Installar</a>
    <p class="text-muted"><small><a href="https://forum.yunohost.org/t/yunohost-3-6-release-sortie-de-yunohost-3-6/8359">YunoHost v3.6</a></small></p>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-7">
      <h1>Installatz <small>vòstre servidor simplament, avètz ja tot çò que cal a l’ostal</small></h1>
      <p><a href="/hardware_fr">Far veire los requistes</a></p>
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
      <h1>Profitatz <small>de vòstras aplicacions web e fabricatz vòstre canton d’Internet</small></h1>
      <p><br /><a href="/apps_fr">Lista de las aplicacions disponiblas</a></p>
    </div>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-7">
      <h1>Gerissètz <small>vòstre servidor coma volgatz : via web, mobil o en linha de comanda</small></h1>
      <p><br /><a href="/try_fr">Ensajar l’interfàcia d’administracion</a></p>
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

      <a class="btn btn-lg btn-block btn-primary" href="/whatsyunohost_fr">Qu’es aquò YunoHost ?</a>
      <a class="btn btn-lg btn-block btn-info" href="/docs_fr">Documentacion</a>
      <a class="btn btn-lg btn-block btn-success" href="/contribute_fr">Cossí contribuir</a>
      <a class="btn btn-lg btn-block btn-warning" href="https://forum.yunohost.org" target="_blank">Forum</a>
      <a class="btn btn-lg btn-block btn-default" href="chat_rooms_fr" target="_blank">Salas de discussions</a>
      <a class="btn btn-lg btn-block btn-danger" href="https://forum.yunohost.org/c/announcement">Darrièras novèlas</a>
      <a class="btn btn-lg btn-block btn-danger btn-support" href="/help_fr">Assisténcia</a>

    </div>
    <div class="col-md-7 text-right">
      <h1>Exploratz <small>las possibilitats de vòstre servidor, e aprenètz perque es important</small></h1>
      <p><br /><a href="/docs_fr">Legir la documentacion</a></p>
    </div>
  </div>

  <hr />

  <div class="text-center">
    <h1>Ou ! Sèm umans !<br /><small> S’avètz una question, un problèma, o que sètz simplament interessat, venètz dire « Bonjorn » dins nòstra sala de discussion en clicar lo boton aval &nbsp;<span class="glyphicon glyphicon-share-alt"></span> </small></h1>

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

