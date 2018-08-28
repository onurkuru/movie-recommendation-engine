<?php
session_start(); 

$id = $_GET['id'];
$fuid = $_SESSION['FBID'];
require 'dbconfig.php';


/* SEO URL Builder */
function seo($s) {
 $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
 $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
 $s = str_replace($tr,$eng,$s);
 $s = strtolower($s);
 $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
 $s = preg_replace('/\s+/', '-', $s);
 $s = preg_replace('|-+|', '-', $s);
 $s = preg_replace('/#/', '', $s);
 $s = str_replace('.', '', $s);
 $s = trim($s, '-');
 return $s;
}



// Kullanıcı oturumu var mı yok mu?
if(isset($fuid)){
/* User Datası bilgisi almak? */
$check1 = mysql_query("select * from Users where Fuid='$fuid'");
$check = mysql_num_rows($check1);
$row = mysql_fetch_assoc($check1);
$uid = $row['UID'];

$check_movie1 = mysql_query("select * from `movies_meta` where user_id='$uid' && movie_id='$id'");
$check_movie = mysql_num_rows($check_movie1); 
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$id."?append_to_response=videos%2Ccredits%2C&language=tr-TR&api_key=api_key",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$json = json_decode($response, true);


$title        = $json["title"];
$poster_path  = $json["poster_path"];
$backdrop_path= $json["backdrop_path"];
$vote_average = $json["vote_average"];
$content      = $json["overview"];
$runtime      = $json["runtime"];
$release_date = $json["release_date"];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="https://www.sekizbucuk.com/xmlrpc.php" rel="pingback">
  <meta content="index, follow" name="robots">
  <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" name="viewport">
  <title><?=$title?> - Sekizbuçuk Film Öneri Robotu</title>
  <meta content="En sevdiğiniz filmleri öneri robotunda bulabilirsiniz. Film ve dizi haberleri, yakın çekim, perde, başka bir tezgah, dizibox ve ekstra haberler" name="description">
  <meta content="Sekizbucuk, sinema, sinema haberleri, yönetmenler, kamera arkası" name="keywords">
  <meta content="tr_TR" property="og:locale">
  <meta content="website" property="og:type">
  <meta content="SEKIZBUCUK {Sinema Haberleri}" property="og:title">
  <meta content="Film ve dizi haberleri, yakın çekim, perde, başka bir tezgah, dizibox ve ekstra haberler" property="og:description">
  <meta content="https://www.sekizbucuk.com/wp-content/themes/thenous/img/shared.png" property="og:image">
  <meta content="SEKIZBUCUK" property="og:site_name">
  <meta content="https://www.sekizbucuk.com" property="og:url">
  <meta content="summary_large_image" name="twitter:card">
  <meta content="@sekizbucukcom" name="twitter:site">
  <meta content="SEKIZBUCUK" name="twitter:title">
  <meta content="Film ve dizi haberleri, yakın çekim, perde, başka bir tezgah, dizibox ve ekstra haberler" name="twitter:description">
  <meta content="https://www.sekizbucuk.com/wp-content/themes/thenous/img/shared.png" name="twitter:image">
  <meta content="1 days" name="revisit-after">
  <link href="https://www.sekizbucuk.com/wp-content/themes/thenous/style.css?v=15051294682" rel="stylesheet" type="text/css">
  <link href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <link href="//www.sekizbucuk.com/inc/cplayer.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  <script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'>
  </script>
  <script src="//imasdk.googleapis.com/js/sdkloader/ima3.js" type="text/javascript">
  </script>
  <script src="//www.sekizbucuk.com/inc/cplayer.js" type="text/javascript">

  </script>
  <script>
   var googletag = googletag || {};
   googletag.cmd = googletag.cmd || [];
  </script>
  <script>
   googletag.cmd.push(function() {
     googletag.defineSlot('/1027660/Sekizbucuk_300x250', [300, 250], 'div-gpt-ad-1485789388924-0').addService(googletag.pubads());
     googletag.defineSlot('/1027660/Sekizbucuk_300x600', [300, 600], 'div-gpt-ad-1485789388924-1').addService(googletag.pubads());
     googletag.defineSlot('/1027660/sekizbucuk_728x90', [728, 90], 'div-gpt-ad-1485789388924-2').addService(googletag.pubads());
     googletag.defineSlot('/1027660/sekizbucuk_970x90', [970, 90], 'div-gpt-ad-1485789388924-3').addService(googletag.pubads());
     googletag.defineSlot('/1027660/Sekizbucuk_Mobil_300x250', [300, 250], 'div-gpt-ad-1485789388924-4').addService(googletag.pubads());
     googletag.defineSlot('/1027660/Sekizbucuk_320x50', [320, 50], 'div-gpt-ad-1505128161487-0').addService(googletag.pubads());
     googletag.defineSlot('/1027660/Sekizbucuk_Native', [1, 1], 'div-gpt-ad-1503304955375-0').addService(googletag.pubads());
     googletag.pubads().enableVideoAds();
     googletag.companionAds().setRefreshUnfilledSlots(true);
     googletag.enableServices();
   });
  </script>
  <meta content="Film ve dizi haberleri, yakın çekim, perde, başka bir tezgah, dizibox ve ekstra haberler" name="description">
  <link href="https://www.sekizbucuk.com/" rel="canonical">
  <link href="https://www.sekizbucuk.com/page/2/" rel="next">
  <script type='application/ld+json'>
  {"@context":"http:\/\/schema.org","@type":"WebSite","@id":"#website","url":"https:\/\/www.sekizbucuk.com\/","name":"Sekizbucuk","potentialAction":{"@type":"SearchAction","target":"https:\/\/www.sekizbucuk.com\/?s={search_term_string}","query-input":"required name=search_term_string"}}
  </script>
  <script type='application/ld+json'>
  {"@context":"http:\/\/schema.org","@type":"Organization","url":"https:\/\/www.sekizbucuk.com\/","sameAs":["https:\/\/www.facebook.com\/sekizbucukcom","https:\/\/www.instagram.com\/8.bucuk\/","https:\/\/twitter.com\/sekizbucukcom"],"@id":"#organization","name":"Sekiz Bu\u00e7uk","logo":"https:\/\/www.sekizbucuk.com\/wp-content\/uploads\/2016\/08\/120x120.png"}
  </script>
  <script async src="https://cdn.onesignal.com/sdks/OneSignalSDK.js">
  </script>
  <script>
  window.OneSignal=window.OneSignal||[];OneSignal.push(function(){OneSignal.SERVICE_WORKER_UPDATER_PATH="OneSignalSDKUpdaterWorker.js.php";OneSignal.SERVICE_WORKER_PATH="OneSignalSDKWorker.js.php";OneSignal.SERVICE_WORKER_PARAM={scope:'/'};OneSignal.setDefaultNotificationUrl("https://www.sekizbucuk.com");var oneSignal_options={};window._oneSignalInitOptions=oneSignal_options;oneSignal_options.wordpress=!0;oneSignal_options.appId='54c41678-f786-4392-a150-300508da242f';oneSignal_options.autoRegister=!0;oneSignal_options.welcomeNotification={};oneSignal_options.welcomeNotification.disable=!0;oneSignal_options.subdomainName="sekizbucuk";oneSignal_options.promptOptions={};oneSignal_options.promptOptions.actionMessage='Yeni film ve dizi haberleri için bildirim Almak ister misin ?                ';oneSignal_options.promptOptions.exampleNotificationTitleDesktop='Bu Örnek Bir Bildirim';oneSignal_options.promptOptions.exampleNotificationMessageDesktop='Bildirim Masaüstünde Gözüküyor';oneSignal_options.promptOptions.exampleNotificationTitleMobile='Bu Örnek Bir Bildirim';oneSignal_options.promptOptions.exampleNotificationMessageMobile='Bildirim Mobil Gözüküyor';oneSignal_options.promptOptions.exampleNotificationCaption='İstediğiniz zaman takibi bırakabilirsiniz.';oneSignal_options.promptOptions.acceptButtonText='DEVAM';oneSignal_options.promptOptions.cancelButtonText='DAHA SONRA';oneSignal_options.promptOptions.siteName='https://www.sekizbucuk.com';oneSignal_options.promptOptions.autoAcceptTitle='KABUL ET';oneSignal_options.notifyButton={};oneSignal_options.notifyButton.enable=!0;oneSignal_options.notifyButton.position='bottom-right';oneSignal_options.notifyButton.theme='default';oneSignal_options.notifyButton.size='medium';oneSignal_options.notifyButton.prenotify=!1;oneSignal_options.notifyButton.displayPredicate=function(){return OneSignal.isPushNotificationsEnabled().then(function(isPushEnabled){return!isPushEnabled})};oneSignal_options.notifyButton.showCredit=!1;OneSignal.init(window._oneSignalInitOptions)});function documentInitOneSignal(){var oneSignal_elements=document.getElementsByClassName("OneSignal-prompt");var oneSignalLinkClickHandler=function(event){OneSignal.push(['registerForPushNotifications']);event.preventDefault()};for(var i=0;i
<oneSignal_elements.length;i++)
  oneSignal_elements[i].addEventListener('click',oneSignalLinkClickHandler,!1);}
  if(document.readyState==='complete'){documentInitOneSignal()}
  else{window.addEventListener("load",function(event){documentInitOneSignal()})}
     
  </script>
  <link href='https://www.sekizbucuk.com/wp-json/' rel='https://api.w.org/'>
  <link href="https://www.sekizbucuk.com/xmlrpc.php?rsd" rel="EditURI" title="RSD" type="application/rsd+xml">
  <link href="https://www.sekizbucuk.com/wp-includes/wlwmanifest.xml" rel="wlwmanifest" type="application/wlwmanifest+xml">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="style_new.css" rel="stylesheet" type="text/css">
</head>
<body>
  <header data-loc="frontpage" id="header" role="banner">
    <div class="mmenu">
      <i class="ion-navicon"></i>
    </div>
    <h1 id="logo"><a href="https://www.sekizbucuk.com" title="SEKIZBUCUK">SEKIZBUCUK.COM</a></h1>
    <form action="https://www.sekizbucuk.com/" method="get">
      <input id="search" name="s" placeholder="&#xf2f5;" role="search">
    </form>
    <nav id="nav" role="navigation">
      <ul class="menu" id="menu-td-demo-footer-menu">
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2021" id="menu-item-2021">
          <a href="https://www.sekizbucuk.com/sinema/yakin-cekim/">YAKIN ÇEKİM</a>
        </li>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2020" id="menu-item-2020">
          <a href="https://www.sekizbucuk.com/sinema/perde/">PERDE</a>
        </li>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2018" id="menu-item-2018">
          <a href="https://www.sekizbucuk.com/sinema/dizibox/">DİZİBOX</a>
        </li>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2017" id="menu-item-2017">
          <a href="https://www.sekizbucuk.com/sinema/baska-bir-tezgah/">BAŞKA BİR TEZGAH</a>
        </li>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2019" id="menu-item-2019">
          <a href="https://www.sekizbucuk.com/sinema/ekstra/">EKSTRA</a>
        </li>
        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2892" id="menu-item-2892">
          <a href="https://www.sekizbucuk.com/kunye/">KÜNYE</a>
        </li>
        <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-2135" id="menu-item-2135">
          <a href="http://www.sekizbucuk.com">KAPAT</a>
        </li>
      </ul>
    </nav>
  </header>

  <main class="container_detail" role="main">

<section class="movie_bg" style="background-image: url(https://image.tmdb.org/t/p/w1400_and_h450_bestv2<?=$backdrop_path?>);">
<div class="movie_row">
<div class="multi_tools">
<div class="poster"><img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2<?=$poster_path?>"></div>
<div class="multi_assets">
<div class="title"><?=$title?></div>
  <div class="point"><i class="ion-android-star"></i><div class="score"><?=$vote_average?></div></div>

  <div class="starpoint"><span>Senin Puanın: </span><fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
</fieldset></div>
<?php
if($check_movie){
  echo '<div class="watchlist btn-clicked"><img src="img/like2.png" title="Heart" width="32" height="32"> İZLEME LİSTESİNDE</div>';
}else {
  echo '<div class="watchlist"><img src="img/like1.png" title="Heart" width="32" height="32"> İZLEME LİSTESİNE EKLE</div>';
  } 
  ?>
  <div class="comment"><i class="ion-chatbox"></i>YORUM YAP</div>
</div>
</div>
</div>
 </section>
<section class="movie_detail_row">
<div class="leftside">
  <? 
  foreach(array_keys($json['genres']) as $key) {
    $genres  = $json['genres'][$key]["name"];
    $genresid  = $json['genres'][$key]["id"];
?>
<div class="genre_tag"><?=$genres?></div>
<span class="genre_id"><?=$genresid?></span>
<? } ?> 
<div> 
  <?
  for ($i = 1; $i <= 3; $i++) { 
  $crew_title  = $json['credits']['crew'][$i]["name"]; 
  $crew_job  = $json['credits']['crew'][$i]["job"]; 

  ?>
	<b> <?=$crew_title?></b><br>
<?=$crew_title?>
<br><br>
<?
} 
?>
<br><br>
  <b>Gösterim Tarihi</b><br>
<?=$release_date?>
<br><br>
<b>Süre: </b> <? echo gmdate("H:i:s", $runtime); ?> 
<br><br>

</div>


</div>
<div class="rightside">
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$id."/videos?api_key=6f10bed37d2a9c745dfd3af6afcecc63",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$json2 = json_decode($response, true);

$video_id     = $json2["results"][0]["key"];

$genres0 = $json["genres"][0]["name"];

?>
<div class="breadcrumb"><a href="/test/mrs/index.php">Kategoriler</a> > <a href="/test/mrs/list.php?cat=<?=seo($genres0)?>"><?=$genres0?></a></div>

<div class="content">
<?=$content?>
</div>

  <div id="cplayer-container1" style="width:100%;overflow: hidden;"></div>
  <script>
var videoid    = '<?=$video_id?>';
var posterpath = '<?=$backdrop_path?>';
    var ios = navigator.userAgent.match('iPhone');var android = navigator.userAgent.match('Android');var wp = navigator.userAgent.match('Windows Phone');var mobile = "";if(ios || android || wp){mobile = "true";}else{mobile = "false";}var options = { playerId : "player",playerType : "vod",preload : true,video : [{ desktop : [ { src : "https://www.thenousdigital.com/yt/getvideo.mp4?videoid="+videoid+"&amp;format=ipad", type : "video/mp4", poster : "https://image.tmdb.org/t/p/w533_and_h300_bestv2"+posterpath+"" } ]}, { mobile : [ { src : "https://www.thenousdigital.com/yt/getvideo.mp4?videoid="+videoid+"&amp;format=ipad", type : "video/mp4", poster : "https://image.tmdb.org/t/p/w533_and_h300_bestv2"+posterpath+"" } ]}],ads : { adTagUrl :  "//www.sekizbucuk.com/inc/sekizbucuk_vmap.php?mobile="+mobile, disableAds : false},plugins : {social : {socialSharing : true,twitterOptions : {via : '',related : '',hashtags : ''}} }};player = cPlayer("cplayer-container1").init(options);</script>




<div class="casts">
<?
  for ($i = 1; $i <= 8; $i++) { 
  $cast_name       = $json['credits']['cast'][$i]["name"]; 
  $cast_character  = $json['credits']['cast'][$i]["character"]; 
  $cast_profile_path  = $json['credits']['cast'][$i]["profile_path"]; 
  ?>

  <div class="cast">
    <div class="img_cast"><img src="https://image.tmdb.org/t/p/w138_and_h175_bestv2<?=$cast_profile_path?>" /></div>
        <div class="cast_title">
    <b><?=$cast_name?></b><br>
    <?=$cast_character?>
  </div>  </div>
  <? }
  ?>


</div>

</div>

<div class="comment_box">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v2.10&appId=299438420463853";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-comments" data-href="https://www.sekizbucuk.com/test/mrs/detail.html" data-numposts="5" width="100%"></div>

</div>
</section>

     </main>
  <footer id="footer">
    <div id="promotion">
      <section class="social" role="menu">
        <h2>TAKİP ET</h2><a href="https://www.facebook.com/sekizbucukcom" role="menuitem" title="FACEBOOK"><i class="ion-social-facebook"></i> BEĞEN</a> <a href="https://www.twitter.com/sekizbucukcom" role="menuitem" title="TWITTER"><i class="ion-social-twitter"></i> TAKİP ET</a> <a href="https://www.instagram.com/sekizbucukcom" role="menuitem" title="INSTAGRAM"><i class="ion-social-instagram"></i> TAKİP ET</a>
      </section>
      <section class="email" role="form">
        <h2>GÜNLÜK E-POSTA BÜLTENİ</h2>
        <form action="//sekizbucuk.us15.list-manage.com/subscribe/post?u=84a90c2983c4d1aecc8e8fac8&amp;id=5f7f8e58bf" id="mc-embedded-subscribe-form" method="post" name="mc-embedded-subscribe-form" target="_blank">
          <input id="mce-FNAME" name="FNAME" placeholder="ADIN" type="text"> <input id="mce-EMAIL" name="EMAIL" placeholder="E-POSTA ADRESİN" type="text"> <input id="mc-embedded-subscribe" name="subscribe" type="submit" value="KAYDET">
        </form>
      </section>
    </div>
  </footer>
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <?php

$cart = array();

   foreach(array_keys($json['genres']) as $key) {

    $genres  = $json['genres'][$key]["name"];
    $genresid  = $json['genres'][$key]["id"];
	
	$cart[] = array( 'movie_id' => $id, 'genre_id' => $genresid, 'user_id' => $uid);
 }
 ?>

<script type="text/javascript">

$(document).ready(function(){

    $(".watchlist").click(function(){
   var check = '<?=$check?>';
if( check == ''){

        window.location.href = "fbconfig.php";


} else {

    var $this = $(this);
    var id = <?=$_GET['id']?>;
    var jsonString = JSON.stringify(<?php echo json_encode($cart); ?>);

    $this.toggleClass('btn-clicked');

    if($this.hasClass('btn-clicked')) {

       $.ajax({
        type: "POST",
        url: "script.php?a=save",
        data: {data : jsonString}, 
        cache: false,
        success: function(){}
        });  

     } else {
      $.ajax({
        type: "POST",
        url: "script.php?a=delete",
        data: {data : jsonString}, 
        cache: false,
        success: function(){}
        });  
    }
    
    $this.html(function(i, v){
       return v === '<img src="img/like2.png" title="Heart" width="32" height="32"> İZLEME LİSTESİNDE' ? '<img src="img/like1.png" title="Heart" width="32" height="32"> İZLEME LİSTESİNE EKLE' : '<img src="img/like2.png" title="Heart" width="32" height="32"> İZLEME LİSTESİNDE'
    });
       }
    });
 
});

  

</script>


</body>
</html>