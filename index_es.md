<div class="teasing-part">                                                                      

  <div class="home-logo">
    <img src="/images/ynh_logo_white_300dpi.png" width="100"/>
  </div>

  <div class="punchline">
    <p>
      <span class="yolo 1" style="color: #FF3399;">datalove <3</span>
      <span class="yolo 2" style="color: #6699FF;">data@home</span>
      <span class="yolo 3" style="color: #66FF33;">Alojar arriba, dijeron</span>
      <span class="yolo 4" style="color: #00FFCC;">Host me I'm famous</span>
      <span class="yolo 5" style="color: #FF5050;">sudo internet</span>
      <span class="yolo 6" style="color: #FF0066;">Ellos alojamientido y tenía muchos hijos</span>
      <span class="yolo 8" style="color: #FFFFFF;">Try Internet</span>
      <span class="yolo 7" style="color: #3366FF;">Internet, lectura y escritura</span>
      <span class="yolo 9" style="color: #CC66FF;">No tengo nada que ocultar</span>
      <span class="yolo 10" style="color: #FF6600;">How I met your server</span>
      <span class="yolo 11" style="color: #FF3399;">datalove <3</span>
    </p>
    <button class="btn btn-primary btn-lg btn-block yolobtn">Perdón ?</button>
  </div>

  <div class="main-links hidden-xs">
    <a href="/whatsyunohost">About</a> <span class="colored-bar">•</span> 
    <a href="https://forum.yunohost.org/c/announcement" target="_blank">últimas noticias</a> <span class="colored-bar">•</span> 
    <a href="/docs">Documentation</a>
  </div>

</div><!-- teasing-part -->

<div class="boring-part" markdown="1">

  <h1>YunoHost <small>es un herramiento que permite installar et utilizar facilamente sur propio servidor.</small></h1>


  <div class="home-panel">
    <img src="/images/home_panel.jpg" />
  </div>

  <div class="call-to-action">
    <!-- <a class="btn btn-primary btn-lg" href="/try">Try it</a>  -->
    <a class="btn btn-success btn-lg" href="/install">Get started</a>
    <p class="text-muted"><small><a href="https://forum.yunohost.org/t/yunohost-3-4-release-sortie-de-yunohost-3-4/6950">YunoHost v3.4</a></small></p>
  </div>

  <div class="row cf">
    <div class="col-md-7">
      <h1>Installar <small>su sevidor simplemente, tienes todo a casa</small></h1>
      <p><br /><a href="/hardware">Ver los requisitos previos</a></p>
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
      <h1>Disfrutar <small>de sus aplicaciones web, y crea su esquina de Internet</small></h1>
      <p><br /><a href="/apps_fr">Lista de aplicationes disponible</a></p>
    </div>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-7">
      <h1>Gestionar <small>su servidor como quieras : via web, móvil o en línea de comandos</small></h1>
      <p><br /><a href="/try_fr">Intentar el interfaz de administración</a></p>
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
      <a class="btn btn-lg btn-block btn-primary" href="/userdoc_fr">Guía del usuario</a>
      <a class="btn btn-lg btn-block btn-info" href="https://ask.yunohost.org" target="_blank">Preguntas más frecuentes</a>
      <a class="btn btn-lg btn-block btn-success" href="/whatsyunohost_fr">Que es YunoHost ?</a>
      <a class="btn btn-lg btn-block btn-warning" href="/contribute_fr">Cómo contribuir</a>
      <a class="btn btn-lg btn-block btn-danger btn-support" href="http://news.yunohost.org">últimas noticias</a>
    </div>
    <div class="col-md-7 text-right">
      <h1>Explorar <small>las posibilidad de su servidor, y aprender pourque es importante</small></h1>
      <p><br /><a href="/docs_fr">Leer la documentación</a></p>
    </div>
  </div>

  <hr />

  <div class="text-center">
    <h1>¡ Hey ! Somos humanos<br /><small> Si tiene algun pregunta, un problema, o simplemente estás interesado, ven decir "¡ Hola !" sobre nuetra salón de discusión clic en el botón abajo &nbsp;<span class="glyphicon glyphicon-share-alt"></span> </small></h1>

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
    $(".actions").css('opacity', 0);
    jQuery.ajaxSetup({cache: false});
    jQuery.getScript('https://'+ location.host +'/mini/javascripts/mini.js', function() {
        HOST_BOSH = 'https://'+ location.host +'/http-bind/';
        JappixMini.launch({
            connection: {
              domain: 'anonymous.yunohost.org'
            },

            application: {
              network: {
                autoconnect: false
              },

              interface: {
                showpane: true,
                animate: true
              },

              groupchat: {
                open: ['support@conference.yunohost.org'],
                suggest: ['dev@conference.yunohost.org']
              }
            }
        });
    });
</script>
