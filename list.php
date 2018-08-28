<?php
session_start(); 

$id = $_GET['id'];
$fuid = $_SESSION['FBID'];
require 'dbconfig.php';

/* URL'den kategori alma buna göre TMDB id'leri ile eşleştirme */
$cat = $_GET['cat'];

switch ($cat) {
    case "komedi":
        $catid = 35;
        break;
    case "macera":
        $catid = 12;
        break;
    case "aksiyon":
        $catid = 28;
        break;
    case "bilim-kurgu":
        $catid = 878;
        break;
    case "romantik":
        $catid = 10749;
        break;
    case "korku":
        $catid = 27;
        break;
    case "animasyon":
        $catid = 16;
        break;
    case "suc":
        $catid = 80;
        break;
    case "tarih":
        $catid = 36;
        break;
    case "dram":
        $catid = 18;
        break;
    case "belgesel":
        $catid = 99;
        break;
    case "western":
        $catid = 37;
        break;
    default:
        $catid = 35;
}

// Kullanıcı oturumu var mı yok mu?
if(isset($fuid)){
/* User Datası bilgisi almak? */
$check1 = mysql_query("select * from Users where Fuid='$fuid'");
$check = mysql_num_rows($check1);
$row = mysql_fetch_assoc($check1);
$uid = $row['UID'];


$movie_find = mysql_query("SELECT * FROM genres_meta LEFT JOIN movies_meta ON genres_meta.movie_id=movies_meta.movie_id where user_id='$uid' && genre_id='$catid' ORDER BY genres_meta.id DESC LIMIT 1");
$finder_row = mysql_fetch_assoc($movie_find);
$recommend_movie =  $finder_row['movie_id'];
$check_movie = mysql_num_rows($movie_find); 

if($check_movie){

$veri = "https://api.themoviedb.org/3/movie/".$recommend_movie."/recommendations?api_key=api_key&language=tr&page=3";

}else {
$veri = "https://api.themoviedb.org/3/genre/".$catid."/movies?sort_by=created_at.desc&include_adult=false&language=tr-TR&api_key=api_key";
}

} else {

$veri = "https://api.themoviedb.org/3/genre/".$catid."/movies?sort_by=created_at.desc&include_adult=false&language=tr-TR&api_key=api_key";


}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="https://www.sekizbucuk.com/xmlrpc.php" rel="pingback">
  <meta content="index, follow" name="robots">
  <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" name="viewport">
  <title><?=$cat?> - Sekizbuçuk Film Öneri Robotu</title>
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
  <main class="container" id="main" role="main">
    <section class="row" id="feed">


<div class="profile-banner"><div class="pb-bg" style=""></div>
<a href="/test/mrs/index.php" class="breadcrumb_1" style="position: absolute;line-height: 30px;top: 10px;color:white"><img src="https://cdn.pbrd.co/images/GPtpGqE.png" style="float: left;">&nbsp;Kategoriler</a>
<div class="relative" style=""><h1 style="">Sizin için Film Önerileri</h1>
    <?php if ($_SESSION['FBID']): ?>      <!--  After user login  -->


<div class="cast">
<div class="img_cast"><img src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture"></div>
<div class="cast_title">
<b><?php echo $_SESSION['FULLNAME']; ?> </div> </div>


    <?php else: ?>     <!-- Before login --> 
<a href="fbconfig.php" class="loginBtn loginBtn--facebook">Facebook ile Giriş Yap</a>

    <?php endif ?>
</div></div>
    <div class="content_list">

<?php

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



/* CURL ile data çekimi */
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $veri,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

// CURL devamı
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$json = json_decode($response, true);




/* Json gelen döngüye */
foreach(array_keys($json['results']) as $key) {

$title        = $json['results'][$key]["title"];
$poster_path  = $json['results'][$key]["poster_path"];
$vote_average = $json['results'][$key]["vote_average"];
$id           = $json['results'][$key]["id"];


  if(isset($fuid)){
$genre0        = $json['results'][$key]["genre_ids"][0];
$genre1        = $json['results'][$key]["genre_ids"][1];
$genre2        = $json['results'][$key]["genre_ids"][2];
$genre3        = $json['results'][$key]["genre_ids"][3];
$genre4        = $json['results'][$key]["genre_ids"][4];

if( in_array($catid, array($genre0,$genre1,$genre2,$genre3,$genre4)) ){ ?>

<a href="detail.php?id=<?=$id?>&title=<?=seo($title)?>" class="movie_box">
      <? echo '<img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2'.$poster_path.'">'; ?>
      <div class="oval">
        <?=$vote_average?>
      </div>
      <div class="movie_title">
          <?=$title?>
      </div></a> 

<?
}

} else {


?>
     <a href="detail.php?id=<?=$id?>&title=<?=seo($title)?>" class="movie_box">
      <? echo '<img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2'.$poster_path.'">'; ?>
      <div class="oval">
        <?=$vote_average?>
      </div>
      <div class="movie_title">
          <?=$title?>
      </div></a> 
<?
}
}
?>



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
</body>
</html>