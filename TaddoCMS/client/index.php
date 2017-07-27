<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('../global.php');

$rand1 = rand(100000, 999999);
$rand2 = rand(10000, 99999);
$rand3 = rand(10000, 99999);
$rand4 = rand(10000, 99999);
$rand5 = rand(10000, 99999);
$rand6 = rand(1, 9);
$ticket = "ST-".$rand1."-".$rand2.$rand3."-".$rand4.$rand5."-otaku-".$rand6;
$username = $_SESSION['username'];
if(@$_GET['ticket'] && @$_GET['username'] && $users->UserPermission('hk_ext_login', $_SESSION['username']))
{
   $username = $_GET['username'];
   $ticket = $_GET['ticket'];
}
$query = mysql_query("UPDATE users SET auth_ticket = '$ticket' WHERE username = '$username'");
$query = mysql_query("UPDATE users SET ip_last = '".$_SERVER['REMOTE_ADDR']."' WHERE username = '$username'");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <title><?php echo $sitename." - Client"; ?></title>

<script type="text/javascript">
var andSoItBegins = (new Date()).getTime();
</script>
<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/styles/common.css" type="text/css" />
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/js/libs2.js" type="text/javascript"></script>

<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/js/common.js" type="text/javascript"></script>

   <script type="text/javascript">
      document.habboLoggedIn = true;
      var habboName = "<?php echo $_SESSION['username']; ?>";
      var habboReqPath = "http://todopixel.sytes.net";
      var habboStaticFilePath = "http://images.habbo.com/habboweb/60_cf3b27a092308ed2f4b382d9929147fc/4/web-gallery";
      var habboImagerUrl = "http://www.habbo.com/habbo-imaging/";
      var habboPartner = "";
      var habboDefaultClientPopupUrl = "http://taddo.no-ip.org/client";
      window.name = "ClientWndw";
      if (typeof HabboClient != "undefined") { HabboClient.windowName = "ClientWndw"; }
   </script>

<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/styles/habboflashclient.css" type="text/css" />
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/js/habboflashclient.js" type="text/javascript"></script>
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/js/identity.js" type="text/javascript"></script>

<script type="text/javascript">
    FlashExternalInterface.loginLogEnabled = false;
    FlashExternalInterface.logLoginStep("web.view.start");
   
    if (top == self) {
        FlashHabboClient.cacheCheck();
    }
    var flashvars = {
            "client.allow.cross.domain" : "1",
            "client.notify.cross.domain" : "1",
            "connection.info.host" : "taddo.no-ip.org",
            "connection.info.port" : "90",
            "site.url" : "http://taddo.no-ip.org",
            "url.prefix" : "http://taddo.no-ip.org",
            "client.reload.url" : "http://taddo.no-ip.org/index.php",
            "client.fatal.error.url" : "http://taddo.no-ip.org/client/disconnected.php",
            "client.connection.failed.url" : "http://taddo.no-ip.org/client/disconnected.php",
            "external.variables.txt" : "http://gavvos.net/swf/gamedata/variables_5.txt",
            "external.texts.txt" : "http://gavvos.net/swf/gamedata/texts/texts_es.txt",
            "use.sso.ticket" : "1",
            "sso.ticket" : "<?php echo $ticket ?>",
            "processlog.enabled" : "0",
            "account_id" : "1",
            "client.starting" : "Porfavor espera esta cargando",
            "flash.client.url" : "http://gavvos.net/swf/gordon/R63/",
            "user.hash" : "31385693ae558a03d28fc720be6b41cb1ccfec02",
            "has.identity" : "0",
            "flash.client.origin" : "popup",
            "token" : "<?php echo $ticket ?>"
    };
    var params = {
        "base" : "http://gavvos.net/swf/gordon/R63/",
        "allowScriptAccess" : "always",
        "menu" : "false"               
    };
   
    if (!(HabbletLoader.needsFlashKbWorkaround())) {
       params["wmode"] = "opaque";
    }
   
    var clientUrl = "http://gavvos.net/swf/gordon/R63/R63-phoenix3.swf";

    swfobject.embedSWF(clientUrl, "flash-container", "100%", "100%", "10.0.0", "http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/flash/expressInstall.swf", flashvars, params);
 
    window.onbeforeunload = unloading;
    function unloading() {
        var clientObject;
        if (navigator.appName.indexOf("Microsoft") != -1) {
            clientObject = window["flash-container"];
        } else {
            clientObject = document["flash-container"];
        }
        try {
            clientObject.unloading();
        } catch (e) {}
    }
</script>

<!--[if IE 8]>
<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/styles/ie8.css" type="text/css" />
<![endif]-->

<!--[if lt IE 8]>
<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/styles/ie.css" type="text/css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/styles/ie6.css" type="text/css" />
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>

<style type="text/css">
body { behavior: url(/js/csshover.htc); }
</style>
<![endif]-->

</head>
 
<body id="client" class="flashclient">

<div id="overlay"></div> 
<div id="overlay"></div>
<div id="client-ui" >
    <div id="flash-wrapper">
    <div id="flash-container">
        <div id="content" style="width: 400px; margin: 20px auto 0 auto; display: none">
         <div class="cbb clearfix">
             <h2 class="title">Porfavor instala adobe flash player.</h2>
             <div class="box-content">
                     <p>Puedes instalar adobe flash player: <a href="http://get.adobe.com/flashplayer/">
                  aqui</a>. Puedes encontrar instrucciones (En ingles): <a href="http://www.adobe.com/products/flashplayer/productinfo/instructions/">
                  Aqui</a></p>
                     <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/362/web-gallery/v2/images/client/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
             </div>
         </div>
        </div>
        <script type="text/javascript">
            $('content').show();
        </script>
        <noscript>
            <div style="width: 400px; margin: 20px auto 0 auto; text-align: center">
                <p>Si no eres automaticamente redirigido <a href="/client/">haz click aqui</a></p>
            </div>
        </noscript>
    </div>

    </div>
   <div id="content" class="client-content"></div>
</div>

</body>
</html>