<?php
#######################################
##   RareWare v1.0.2                 ##
##   By: Leixx                       ##
##   Compatible con: Phoenix 3.5.5   ##
#######################################

include("../global.php");
require_once("configuracion.php");
$msj = "";
if($row = mysql_fetch_assoc($userI))
{
	$userID = $row['id'];
if($row['online'] == "1")
	{
		die("<h2 align=\"center\">Para poder usar la tienda usted debe estar desconectado. Por favor cierre el client y haga click <a href=\"javascript:location.reload()\">aquí</a>.</h2>");
	}
	if(isset($_POST['comp_1']))
	{
		$userF = @mysql_query("SELECT * FROM items WHERE user_id = '".$userID."' AND room_id = '0' AND base_item = '".$rare1_i."'");
		if(mysql_num_rows($userF) > 0)
		{
			$msj .= '<div class="action-error flash-message">';
			$msj .= '<div class="rounded">';
			$msj .= 'Ya tienes este furni en tu inventario.';
			$msj .= '</div></div>';
		}
		else
		{
			$userCredits = $row['credits'];
			$userPixels = $row['activity_points'];
			if($userCredits >= $rare1_c and $userPixels >= $rare1_p)
			{
				$userCreditsTotal = $userCredits-$rare1_c;
				$userPixelsTotal = $userPixels-$rare1_p;
				@mysql_query("UPDATE `users` SET `credits` = '".$userCreditsTotal."', `activity_points` = '".$userPixelsTotal."' WHERE `id` = ".$userID.";");
				$i=@mysql_query("INSERT INTO `items` (`user_id`, `room_id`, `base_item`, `extra_data`, `x`, `y`, `z`, `rot`, `wall_pos`) VALUES ('".$userID."', '0', '167', '".$MsjRegalo."', '0', '0', '0', '0', '');");
				$lastID = mysql_insert_id();
				@mysql_query("INSERT INTO `user_presents`(`item_id`, `base_id`, `amount`, `extra_data`) VALUES ('".$lastID."', '".$rare1_i."', '1', '');");
				$msj .= '<div class="action-confirmation flash-message">';
				$msj .= '<div class="rounded">';
				$msj .= 'Acabas de comprar '.$rare1_n.' por ' . number_format($rare1_c) . ' créditos y ' . number_format($rare1_p) . ' píxeles.';
				$msj .= '</div></div>';
				
			}
			else
			{
				$msj .= '<div class="action-error flash-message">';
				$msj .= '<div class="rounded">';
				$msj .= '¡No tienes créditos y/o píxeles para realizar la compra!';
				$msj .= '</div></div>';
			}
		}
	} //Venta del Rare 1
	
	if(isset($_POST['comp_2']))
	{
		$userF = @mysql_query("SELECT * FROM items WHERE user_id = '".$userID."' AND room_id = '0' AND base_item = '".$rare2_i."'");
		if(mysql_num_rows($userF) > 0)
		{
			$msj .= '<div class="action-error flash-message">';
			$msj .= '<div class="rounded">';
			$msj .= 'Ya tienes este furni en tu inventario.';
			$msj .= '</div></div>';
		}
		else
		{
			$userCredits = $row['credits'];
			$userPixels = $row['activity_points'];
			if($userCredits >= $rare2_c and $userPixels >= $rare2_p)
			{
				$userCreditsTotal = $userCredits-$rare2_c;
				$userPixelsTotal = $userPixels-$rare2_p;
				@mysql_query("UPDATE `users` SET `credits` = '".$userCreditsTotal."', `activity_points` = '".$userPixelsTotal."' WHERE `id` = ".$userID.";");
				$i=@mysql_query("INSERT INTO `items` (`user_id`, `room_id`, `base_item`, `extra_data`, `x`, `y`, `z`, `rot`, `wall_pos`) VALUES ('".$userID."', '0', '167', '".$MsjRegalo."', '0', '0', '0', '0', '');");
				$lastID = mysql_insert_id();
				@mysql_query("INSERT INTO `user_presents`(`item_id`, `base_id`, `amount`, `extra_data`) VALUES ('".$lastID."', '".$rare2_i."', '1', '');");
				$msj .= '<div class="action-confirmation flash-message">';
				$msj .= '<div class="rounded">';
				$msj .= 'Acabas de comprar '.$rare2_n.' por ' . number_format($rare2_c) . ' créditos y ' . number_format($rare2_p) . ' píxeles.';
				$msj .= '</div></div>';
				
			}
			else
			{
				$msj .= '<div class="action-error flash-message">';
				$msj .= '<div class="rounded">';
				$msj .= '¡No tienes créditos y/o píxeles para realizar la compra!';
				$msj .= '</div></div>';
			}
		}
	} //Venta del Rare 2
	
	if(isset($_POST['comp_3']))
	{
		$userF = @mysql_query("SELECT * FROM items WHERE user_id = '".$userID."' AND room_id = '0' AND base_item = '".$rare3_i."'");
		if(mysql_num_rows($userF) > 0)
		{
			$msj .= '<div class="action-error flash-message">';
			$msj .= '<div class="rounded">';
			$msj .= 'Ya tienes este furni en tu inventario.';
			$msj .= '</div></div>';
		}
		else
		{
			$userCredits = $row['credits'];
			$userPixels = $row['activity_points'];
			if($userCredits >= $rare3_c and $userPixels >= $rare3_p)
			{
				$userCreditsTotal = $userCredits-$rare3_c;
				$userPixelsTotal = $userPixels-$rare3_p;
				@mysql_query("UPDATE `users` SET `credits` = '".$userCreditsTotal."', `activity_points` = '".$userPixelsTotal."' WHERE `id` = ".$userID.";");
				$i=@mysql_query("INSERT INTO `items` (`user_id`, `room_id`, `base_item`, `extra_data`, `x`, `y`, `z`, `rot`, `wall_pos`) VALUES ('".$userID."', '0', '167', '".$MsjRegalo."', '0', '0', '0', '0', '');");
				$lastID = mysql_insert_id();
				@mysql_query("INSERT INTO `user_presents`(`item_id`, `base_id`, `amount`, `extra_data`) VALUES ('".$lastID."', '".$rare3_i."', '1', '');");
				$msj .= '<div class="action-confirmation flash-message">';
				$msj .= '<div class="rounded">';
				$msj .= 'Acabas de comprar '.$rare1_n.' por ' . number_format($rare3_c) . ' créditos y ' . number_format($rare3_p) . ' píxeles.';
				$msj .= '</div></div>';
				
			}
			else
			{
				$msj .= '<div class="action-error flash-message">';
				$msj .= '<div class="rounded">';
				$msj .= '¡No tienes créditos y/o píxeles para realizar la compra!';
				$msj .= '</div></div>';
			}
		}
	} //Venta del Rare 3
	
}
?>

<!-- Powered by: RareWare v1.0.2
	by Leixx -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
	<title>RareWare - Tienda de Rares</title>

<script type="text/javascript">
var andSoItBegins = (new Date()).getTime();
</script>
<link rel="shortcut icon" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="alternate" type="application/rss+xml" title="Habbo Hotel - RSS" href="http://www.habbo.com/articles/rss.xml" />

<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery/static/styles/common.css" type="text/css" />
<link rel="stylesheet" href="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery/static/styles/process.css" type="text/css" />
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery/static/js/libs2.js" type="text/javascript"></script>

<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery/static/js/common.js" type="text/javascript"></script>
<script src="http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery/static/js/fullcontent.js" type="text/javascript"></script>
<link rel="stylesheet" href="/styles/local/com.css" type="text/css" />

<script src="/js/local/com.js" type="text/javascript"></script>

<script type="text/javascript">
var ad_keywords = "gender%3Am,age%3A111";
var ad_key_value = "kvage=111;kvgender=m;kvtags=";
</script>
<script type="text/javascript">
document.habboLoggedIn = false;
var habboName = null;
var habboId = null;
var habboReqPath = "";
var habboStaticFilePath = "http://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/374/web-gallery";
var habboImagerUrl = "http://www.habbo.com/habbo-imaging/";
var habboPartner = "";
var habboDefaultClientPopupUrl = "http://www.habbo.com/client";
window.name = "habboMain";
if (typeof HabboClient != "undefined") {
    HabboClient.windowName = "client";
}


</script>

<meta property="fb:app_id" content="183096284873" />

<script language="JavaScript" type="text/javascript">
	document.logoutPage = true;
	</script>
</head>
<body id="logout" class="process-template">

<div id="overlay"></div>

<div id="container">
	<div class="cbb process-template-box clearfix">
		<div id="content" class="wide">
					<div id="header" class="clearfix">
						<h1><a href="../RareWare/"></a></h1>
<ul class="stats">
    <li class="stats-online"><span class="stats-fig">3</span> Rares en venta</li>

</ul>
					</div>
			<div id="process-content">
<?php
echo $msj;
?>

<div style="text-align: center">

	   <div style="margin: 10px auto"><span style="font-size:12px"> <b>NOTA:</b> Al comprar un rare los cr&eacute;ditos y/o p&iacute;xeles son descontados automaticamente, as&iacute; que piensa bien antes de comprar ya que no devolvemos los cr&eacute;ditos o p&iacute;xeles gastados.</span></div>
       <form name="RareWare" method="post">
       <table width="384" border="0" align="center">
       		<tr>
           	  <th><img src="furni/bath_green.gif" border="0"/></th>
                <th><img src="furni/dragon_gold.gif" border="0" /></th>
                <th><img src="furni/smoke_yellow.gif" border="0" /></th>
            </tr>
            <tr>
           	  <td><font size="-2"><strong><?php echo number_format($rare1_c);?> cr&eacute;ditos<br /><?php echo number_format($rare1_p);?> p&iacute;xeles</strong></font><br />
               	  <input name="comp_1" type="submit" value="&iexcl;Comprar!"/></td>
                <td><font size="-2"><strong><?php echo number_format($rare2_c);?> cr&eacute;ditos<br /><?php echo number_format($rare2_p);?> p&iacute;xeles</strong></font><br />
               	  <input name="comp_2" type="submit" value="¡Comprar!"/></td>
              <td><font size="-2"><strong><?php echo number_format($rare3_c);?> cr&eacute;ditos<br /><?php echo number_format($rare3_p);?> p&iacute;xeles</strong></font><br />
           	    <input name="comp_3" type="submit" value="¡Comprar!"/></td>
            </tr>
       </table>
       </form>
        <div id="column2" class="column">
</div>
</div>

<script type="text/javascript">
document.observe("dom:loaded", function() {

    Cookie.erase("habboclient");
    Cookie.erase("friendlist");

    HabboView.run();
});
</script>
<div id="footer">
	<p class="footer-links"><a href="mailto:leixx@kekomundo.com">Contactame</a> | <a href="http://kekomundo.com" target="_new">Kekomundo</a> | <a href="https://habbo.es" target="_new">Habbo</a></p>

	<p class="copyright">Powered by <a href="http://www.byleixx.x10.mx/" target="_new">RareWare</a> v1.0<br />
    Tienda de Rares creada por <a href="http://twitter.com/byLeixx" target="_new">Leixx</a> para PhoenixPHP. Las im&aacute;genes usadas son propiedad de HABBO.</p>
</div>			</div>
        </div>
    </div>
</div>
</body>

</html>