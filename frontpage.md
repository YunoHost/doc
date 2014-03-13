<div class="teasing-part" style="
  display: none;
  background: #222;
  color: #eee; 
  position: absolute; 
  top: 0; 
  left: 0; 
  width: 100%;
  height: 100%;
  box-shadow: 0 5px 15px rgba(0,0,0,0.45);
  overflow: hidden">                                                                      

<div style="
  position: absolute;
  top: 10%;
  width: 100%;
  text-align: center;
  text-align: center">
<img src="http://pix.toile-libre.org/upload/original/1394644667.png" width="100"/>
</div>

<br />

<div style="
  position: absolute; 
  top: 30%; 
  width: 100%; 
  text-align: center; 
  font-weight: bold; 
  margin: 50px auto 0">
<p style="font-size: 3em; margin-bottom: 30px">
<span class="yolo 1" style="color: #FF3399;">Self-hosting for you, mom</span>
<span class="yolo 2" style="color: #6699FF;">Haters gonna host</span>
<span class="yolo 3" style="color: #66FF33;">I host myself, b*tches</span>
<span class="yolo 4" style="color: #00FFCC;">Go host yourself !</span>
<span class="yolo 5" style="color: #FF5050;">Get off of my cloud</span>
<span class="yolo 6" style="color: #FF0066;">Host me I'm famous</span>
<span class="yolo 7" style="color: #3366FF;">Try Internet</span>
<span class="yolo 8" style="color: #FFFFFF;">How I met your server</span>
<span class="yolo 9" style="color: #CC66FF;">sudo internet --debug</span>
<span class="yolo 10" style="color: #FF6600;">how_about_no@hotmail.com</span>
</p>
<button class="btn btn-primary btn-lg btn-block yolobtn"  style="
  min-width: 200px; 
  width: 20%; 
  margin: 0 auto;
  color: #222;
  font-size: 1.6em">What ?</button>
</div>


<br />

<div class="text-center" style="
  width: 100%;
  position: absolute; 
  top: 90%;
  text-align: center;">
<a style="color: #777" href="/docs">Documentation</a> <span class="colored-bar">•</span> <a style="color: #777" href="https://ask.yunohost.org">FAQ</a> <span class="colored-bar">•</span> <a style="color: #777" href="/contribute">Contribute</a>
</div>

</div>

<div class="boring-part" markdown="1">

<h1>YunoHost <small>is a server operating system aiming to make self-hosting accessible to everyone.</small></h1>

<br />

<div style="
  width: 100%; 
  max-height: 290px; 
  overflow: hidden; 
  border-radius: 5px; 
  border: 1px solid rgba(0,0,0,0.15); 
  box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<!--<img style="width: 100%; min-width: 580px;" src="http://pix.toile-libre.org/upload/original/1394651546.jpg" />-->
<img style="width: 100%; min-width: 580px;" src="http://pix.toile-libre.org/upload/original/1394651972.jpg" />
</div>


<div class="text-center" style="
  width: 23%; 
  min-width: 150px; 
  margin: 40px auto 0;">
<a class="btn btn-primary btn-lg"  style="min-width: 150px; font-size: 1.5em" href="/install">Try it</a>
<p class="text-muted text-center"><small>YunoHost v2 • beta4</small></p>
</div>
<br />                                                                                                                                                                                                 
<h3><blockquote>Features</blockquote></h3>

<p>TO BE Written (with images and stuff)</p>

<br />
<br />
<br />
<br />

<div class="text-center">
<img style="width: 100px" src="http://pix.toile-libre.org/upload/original/1386012810.png" />

<p markdown="1">
<a href="/docs">Documentation</a> • <a href="https://ask.yunohost.org">FAQ</a> • <a href="/contribute">Contribute</a>
</p>
</div>

</div>

<script type="text/javascript">
    jQuery('.teasing-part').css({
        marginTop: '0',
        display: 'block'                                                                                                                                                                          
    });
    jQuery('.boring-part').css({
        marginTop: jQuery(window).height() + 50
    });
    jQuery('.yolo').hide();
    randomNumber = Math.floor((Math.random()*jQuery('.yolo').length)+1);
    color = jQuery('.yolo.' + randomNumber).css('color');
    jQuery('.yolo.' + randomNumber).fadeIn();
    jQuery('.colored-bar').css({
      color: color,
      fontWeight: 'bold',
      padding: '1%'
    });
    jQuery('.yolobtn').css({
      background: color,
      borderColor: color
    }).on('click', function() {
      jQuery('.teasing-part').animate({
        marginTop: '-' + jQuery(window).height(),
        height: 0
      }, 500);
      jQuery('.boring-part').animate({
        marginTop: 0
      }, 500);
    });
    $(".actions").css('opacity', 0);
    $(".languages").css('opacity', 0);
</script>
