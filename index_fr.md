<div class="teasing-part">                                                                      

  <div class="home-logo">
    <img src="/images/ynh_logo_white.png" width="100"/>
  </div>

  <div class="punchline">
    <p>
      <span class="yolo 1" style="color: #FF3399;">Viens chez moi, je suis hébergé chez une copine</span>
      <span class="yolo 2" style="color: #6699FF;">Si à 50 ans t’es pas auto-hébergé, t’as raté ta vie</span>
      <span class="yolo 3" style="color: #FF0066;">Ils s’hébergèrent et eurent beaucoup d’enfants</span>
      <span class="yolo 4" style="color: #3366FF;">Internet, lecture et écriture</span>
      <span class="yolo 5" style="color: #FFFFFF;">monsieur@michu.fr</span>
      <span class="yolo 6" style="color: #CC66FF;">J’ai rien à cacher</span>
      <span class="yolo 7" style="color: #FF6600;">How I met your server</span>
    </p>
    <button class="btn btn-primary btn-lg btn-block yolobtn">Pardon ?</button>
  </div>

  <div class="main-links hidden-xs">
    <a href="/whatsyunohost_fr">À propos</a> <span class="colored-bar">•</span> 
    <a href="https://forum.yunohost.org/c/announcement" target="_blank">Dernières nouvelles</a> <span class="colored-bar">•</span> 
    <a href="/docs_fr">Documentation</a>
  </div>

</div><!-- teasing-part -->

<div class="boring-part" markdown="1">

  <a href="https://github.com/YunoHost" target="_blank" class="github-ribbon hidden-xs">
    <img src="/images/github_ribbon_grey.png" alt="Fork me on GitHub">
  </a>

  <h1>YunoHost <small>est un outil qui vous permet d’installer et d’utiliser facilement votre propre serveur.</small></h1>

  <div class="home-panel">
    <img src="/images/home_panel.jpg" />
  </div>

  <div class="call-to-action">
    <a class="btn btn-primary btn-lg" href="/try_fr">Essayer</a>
    <a class="btn btn-success btn-lg" href="/install_fr">Installer</a>
    <p class="text-muted"><small><a href="https://forum.yunohost.org/t/parution-de-yunohost-2-4/1541">YunoHost v2.4</a></small></p>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-7">
      <h1>Installez <small>votre serveur simplement, vous avez déjà tout ce qu’il faut à la maison</small></h1>
      <p><a href="/hardware_fr">Voir les prérequis</a></p>
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
      <h1>Profitez <small>de vos applications web, et fabriquez votre coin d’Internet</small></h1>
      <p><br /><a href="/apps_fr">Liste des applications disponibles</a></p>
    </div>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-7">
      <h1>Gérez <small>votre serveur comme vous le voulez : via web, mobile ou ligne de commande</small></h1>
      <p><br /><a href="/try_fr">Essayez l’interface d’administration</a></p>
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

      <a class="btn btn-lg btn-block btn-primary"href="/whatsyunohost_fr">Qu’est-ce que YunoHost ?</a>
      <a class="btn btn-lg btn-block btn-info" href="/docs_fr">Documentation</a>
      <a class="btn btn-lg btn-block btn-success" href="/contribute_fr">Comment contribuer</a>
      <a class="btn btn-lg btn-block btn-warning" href="https://forum.yunohost.org" target="_blank">Forum</a>
      <a class="btn btn-lg btn-block btn-default" href="chat_rooms_fr" target="_blank">Salons de discussions</a>
      <a class="btn btn-lg btn-block btn-danger" href="https://forum.yunohost.org/c/announcement">Dernières nouvelles</a>
      <a class="btn btn-lg btn-block btn-danger btn-support" href="/support_fr">Support</a>

    </div>
    <div class="col-md-7 text-right">
      <h1>Explorez <small>les possibilités de votre serveur, et apprenez pourquoi c’est important</small></h1>
      <p><br /><a href="/docs_fr">Lire la documentation</a></p>
    </div>
  </div>

  <hr />

  <div class="text-center">
    <h1>Hey ! Nous sommes humains !<br /><small> Si vous avez une question, un problème, ou que vous êtes tout simplement intéressé, passez dire « Bonjour » sur notre salon de discussion en cliquant sur le bouton en bas &nbsp;<span class="glyphicon glyphicon-share-alt"></span> </small></h1>
<!--
    <p class="liberapay">
      <a href="https://liberapay.com/YunoHost" target="_blank"><img src="/images/liberapay_logo.svg" alt="Donation button" title="Liberapay" /></a>
    </p>
-->
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

<script type="text/javascript" src="/jappix/javascripts/mini.min.js"></script>
<script type="text/javascript">
    // Jappix mini chat
    jQuery.ajaxSetup({cache: false});
    $(".actions").css('opacity', 0);

    var ADS_ENABLE = 'off';
    var JAPPIX_STATIC = '/jappix/';
    var HOST_BOSH = 'https://im.yunohost.org/http-bind/';
    var ANONYMOUS = 'on';
     JappixMini.launch({
        connection: {
           domain: "anonymous.yunohost.org",
        },
        application: {
           network: {
              autoconnect: false,
           },
           interface: {
              showpane: false,
              animate: false,
           },
           groupchat: {
              open: ['support@conference.yunohost.org'],
              suggest: ['dev@conference.yunohost.org']
           }
        },
     });
</script>
