<div class="teasing-part">                                                                      

  <div class="home-logo">
    <img src="/images/ynh_logo_white.png" width="100"/>
  </div>

  <div class="punchline">
    <p>
      <span class="yolo 1" style="color: #FF3399;">Self-hosting for you, mom</span>
      <span class="yolo 2" style="color: #6699FF;">Haters gonna host</span>
      <span class="yolo 3" style="color: #66FF33;">I host myself, b*tches</span>
      <span class="yolo 4" style="color: #00FFCC;">Go host yourself!</span>
      <span class="yolo 5" style="color: #FF5050;">Get off of my cloud</span>
      <span class="yolo 6" style="color: #FF0066;">Host me I’m famous</span>
      <span class="yolo 7" style="color: #3366FF;">Try Internet</span>
      <span class="yolo 8" style="color: #FFFFFF;">How I met your server</span>
      <span class="yolo 9" style="color: #FF6600;">john@doe.org</span>
      <span class="yolo 10" style="color: #FF5050;">dude, Y U NO Host?!</span>
      <span class="yolo 11" style="color: #66FF33;">Keep calm and host yourself</span>
    </p>
    <button class="btn btn-primary btn-lg btn-block yolobtn">What?</button>
  </div>

  <div class="main-links hidden-xs">
    <a href="/whatsyunohost">About</a> <span class="colored-bar">•</span> 
    <a href="https://forum.yunohost.org/c/announcement" target="_blank">Latest news</a> <span class="colored-bar">•</span> 
    <a href="/docs">Documentation</a>
  </div>

</div><!-- teasing-part -->

<div class="boring-part" markdown="1">

  <a href="https://github.com/YunoHost" target="_blank" class="github-ribbon hidden-xs">
    <img src="/images/github_ribbon_grey.png" alt="Fork me on GitHub">
  </a>

  <h1>YunoHost <small>is a server operating system aiming to make self-hosting accessible to everyone.</small></h1>

  <div class="home-panel">
    <img src="/images/home_panel.jpg" />
  </div>

  <div class="call-to-action">
    <a class="btn btn-primary btn-lg" href="/try">Try it</a>
    <a class="btn btn-success btn-lg" href="/install">Get started</a>
    <p class="text-muted"><small><a href="https://forum.yunohost.org/t/yunohost-2-4-released/1544/1">YunoHost v2.4</a></small></p>
  </div>

  <div class="row cf">
    <div class="col-md-7">
      <h1>Install <small>your server with ease, you already have everything at home</small></h1>
      <p><br /><a href="/hardware">See the requirements</a></p>
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
      <h1>Enjoy <small>your apps and make your little corner of Internet</small></h1>
      <p><br /><a href="/apps">List of available apps</a></p>
    </div>
  </div>

  <hr />

  <div class="row cf">
    <div class="col-md-7">
      <h1>Manage <small>your server the way you like: via Web, mobile or command-line</small></h1>
      <p><br /><a href="/try">Try the administration</a></p>
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
      <a class="btn btn-lg btn-block btn-primary" href="/whatsyunohost">About YunoHost</a>
      <a class="btn btn-lg btn-block btn-info" href="/docs">Documentation</a>
      <a class="btn btn-lg btn-block btn-success" href="/contribute">Get involved</a>
      <a class="btn btn-lg btn-block btn-warning" href="https://forum.yunohost.org/" target="_blank">Forum</a>
      <a class="btn btn-lg btn-block btn-default" href="chat_rooms_en" target="_blank">Chat rooms</a>
      <a class="btn btn-lg btn-block btn-danger" href="https://forum.yunohost.org/c/announcement">Latest news</a>
      <a class="btn btn-lg btn-block btn-danger btn-support" href="/support">Support</a>
    </div>
    <div class="col-md-7 text-right">
      <h1>Explore <small>what you can do with a server, and why it is important</small></h1>
      <p><br /><a href="/docs">Read the documentation</a></p>
    </div>
  </div>

  <hr />

  <div class="text-center">
    <h1>Hey! We are humans!<br /><small> If you have questions, problems or if you are just an enthusiast, leave a message on our chatroom by clicking on the button below &nbsp;<span class="glyphicon glyphicon-share-alt"></span> </small></h1>
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
