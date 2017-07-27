<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
require_once('badge.php');
define("THIS_SCRIPT", 'me');
$username = $core->EscapeString($_SESSION['username']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="Content-Type" />
<title><?php echo $sitename." - Me"; ?></title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="Public/JS/jquery.history.js"></script>
	<script language="javascript"> 
	(function($){
		$(document).ready(function() {
			$('.Usersmotto').click(function()  {
				$('.Usersmotto').css("display", "none")
				$('.UserMotto').css("display", "block")
				$('.UserMotto').focus()
				return;
			});
	
			$('.UserMotto').blur(function()  {
				$('.UserMotto').css("display", "none")
				$.ajax({
					url: "functions/updatemotto.php?motto=" + $('.UserMotto').val(),
					async: false
				})
				$('.Usersmotto').html($('.UserMotto').val())
				$('.Usersmotto').css("display", "block")
				$('.Usersmotto').css("min-width", "200px")
				$('.Usersmotto').css("min-height", "30px")
				return;
			});
		});
	})(jQuery);
	</script>
<link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main.css" />
<link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main2.css" />
</head> 
	<style>
        .capa1{
            display: block;
            position: fixed;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index:1001;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity=80);
        }
        .ads {
		   -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
            border-radius: 5px;
            display: block;
            position: absolute;
            top: 25%;
            left: 25%;
            width: 540px;
            padding: 10px;
			color:#FFF;
            background-color: #3d3d3d;
            z-index:1002;
        }
		.capa3 {
		    display: block;
            position: fixed;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index:10000;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity=80);
		}
		.text {
		position:Absolute;
		color:#FFF;
		z-index:20000;
		font-weight:bold;
		top:35%;
		left:45%;
		}
    </style>

<body>
  	 <div id="capa3" onclick="document.getElementById('capa3').style.display='none';" style="display:none;"><div class="capa3"></div><div class="text"><img src="images/page_loader.gif"><br>Cargando...</div></div>
  <div style="display:block" class="capa1" id="capa1"></div>
        <div style="display:block" id="ads" class="ads"><a href="javascript:void(0)" onclick="document.getElementById('ads').style.display='none';document.getElementById('capa1').style.display='none';"><img align="right" src="Public/Styles/Images/icons/close.png"></a><center><h2>Hola <strong><?php echo $users->UserInfo($username, 'username'); ?></strong>, Si quieres que el hotel pueda mantenerse las 24/7 ayudanos dando 2 clicks diarios a la publicidad, de esta manera estaras apoyandonos para poder comprar un dominio asi como un VPS para que puedas disfrutar al maximo de tu estadia, <b>¡Gracias por tu ayuda!</b></h2><center>
</div>
	<?php include("site/header.php"); ?>
	
	<div class="mid">
	<?php include("site/nav.php"); ?>
	<div id="column1">
       <?php include("site/homenav.php"); ?>
		<div class="myOverview">
			<div id="enter-hotel">
				<div class="open">
					<a href="client/?forwardid=2&roomid=1" target="ClientWndw" onclick="window.open('client/','ClientWndw','width=980,height=597');return false;">Entrar al Hotel<i></i></a><b></b>
				</div>
			</div>
			<div id="avatar-plate" onclick="location.href='characters.php'"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $users->UserInfo($username, 'look'); ?>" alt="<?php echo $users->UserInfo($username, 'username'); ?>" style="margin:0 0 0 15px;" /></div>
		</div>
		<div class="avatarinfo">
			<div class="MottoContainer">
				<div class="Usersname"><?php echo $users->UserInfo($username, 'username'); ?>:</div>
				<div class="Usersmotto" style="min-width:200px; min-height:30px;"><?php echo $users->UserInfo($username, 'motto'); ?></div>
				<input class="UserMotto" type="text" value="<?php echo $users->UserInfo($username, 'motto'); ?>" style="display:none"/>
			</div>
			<div class="link-bar">
				<div class="credits"><?php echo $users->UserInfo($username, 'credits'); ?> Creditos</div>
				<div class="activitypoints"><?php echo $users->UserInfo($username, 'activity_points'); ?> Pixeles</div>
                <?php
				$query = mysql_query("SELECT * FROM user_subscriptions WHERE user_id = '".$users->UserInfo($username, 'id')."' LIMIT 1");
				$num = mysql_num_rows($query);
				$subscription = mysql_fetch_array($query);
				if($num > 0 && $subscription['timestamp_expire']>= time())
				{
					$expire = $subscription['timestamp_expire']-time();
					$expire = intval($expire/60/60/24);
					if($subscription['subscription_id'] == 'habbo_club')
					echo '<div class="club">'.$expire.' días de HC restantes</div>';
					elseif($subscription['subscription_id'] == 'habbo_vip')
					echo '<div class="club">'.$expire.' días de VIP restantes</div>';
				}
				?>
			</div>
		</div>
	<div class="avatarextrainfo">
			<?php
            $query = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id ='".$users->UserInfo($username, 'id')."'");
			$i = 0;	
			while($friends = mysql_fetch_array($query))
			{
				$getfriend = mysql_query("SELECT * FROM users WHERE id ='".$friends['user_two_id']."' AND online = '1' LIMIT 1");
				if(mysql_num_rows($getfriend) > 0)
				{
					$i++;
					if($i == 1)
					{
						echo '<div class="content" id="feed-friends">Amigos online: ';
					}
					$friend = mysql_fetch_array($getfriend);
					echo $friend['username'].', ';
				}
			}
			if($i > 0)
			echo '</div>';
			?>
		<div class="smallcontent" id="feed-lastlogin">
			Última vez online: <?php echo @date("d-m-Y", $users->UserInfo($username, 'last_online')); ?>
		</div></div>
			    <section class="menu"><section class="menu2">
			<center><b>Campañas</b></center></section>
				<?php 
	$query = mysql_query("SELECT * FROM cms_news WHERE campaign ='1' ORDER BY published DESC");
	$num = mysql_num_rows($query);
	if($num > 0)
	{
		$color = 'odd';
		while($campaign = mysql_fetch_array($query))
		{
			echo' 
					<div class="campaigncontainer" id="'.$color.'">
						<div class="image" style="background: url('.$campaign['campaignimg'].') no-repeat;"></div>
						<div class="campaign">
							<div class="title"><a href="articles.php?story='.$campaign['id'].'">'.strip_tags($campaign['title']).'</a></div>
							<div class="story">'.strip_tags($campaign['shortstory'], '<br><br/><br />').'</div>
							<div class="published">Posteado: '.@date("d-m-Y", $campaign['published']).'</div>
							<div class="readmore"><a href="articles.php?story='.$campaign['id'].'">Leer más &raquo;</a></div>
						</div>
					</div>';
			if($color == 'odd')
			$color='even';
			else
			$color='odd';
		}
	}			
	?>
			</section>
			
			    <section class="menu"><section class="menu2">
			<center><b>Chat</b></center></section>
        <?php echo $core->CmsSetting('site_chat'); ?>
			</section>
	</div>
	        <div id="column2">
	<?php
	$query = mysql_query("SELECT * FROM cms_news ORDER BY published DESC LIMIT 1");
	$num = mysql_num_rows($query);
	if($num > 0)
	{
		$news = mysql_fetch_array($query);
		echo'<div class="newsHeader">
				<div class="HeadlineStory" id="'.$news["id"].'" style="background: url('.$news["image"].') no-repeat; display:block;">
					<p class="Mainheadline"><a href="articles.php?story='.$news["id"].'">'.stripslashes($news["title"]).'</a></p>
					<p class="Mainstory">'.strip_tags($news["shortstory"], '<br><br/><br />').'</p>
				</div>
		</div>';
		$color = 'odd';
		$query = mysql_query("SELECT * FROM cms_news ORDER BY published DESC LIMIT 3");
		while($news = mysql_fetch_array($query))
		{
			echo'<div class="storybox" id="'.$color.'" ref="'.$news["id"].'">
				<p class="headline"><a href="articles.php?story='.$news["id"].'">'.$news["title"].'</a></p>
				<p class="date">'.@date("d-m-Y", $news['published']).'</p>
			</div>';
			if($color == 'odd')
			$color='even';
			else
			$color='odd';
		}
	}
	?>
		<div class="storyboxEnd">
			<div class="readmore"><a href="articles.php">Leer más &raquo;</a></div>
		</div>
					    <section class="menu"><section class="menu2">
			<center><b>Top 5 - creditos</b></center></section>
<table>
<?php
$datosTop = mysql_query("SELECT * FROM users ORDER BY credits DESC LIMIT 5");

while($datosTop10 = mysql_fetch_array($datosTop)){
echo '
<tr><td width="5px"></td>
<td width="20px">';

echo '<img src="http://www.habbo.com.es/habbo-imaging/avatarimage?figure=' . $datosTop10['look'] . '&direction=3&head_direction=3&gesture=sml&action=crr=2&size=s" align="left"></td> <td width="195px"><a href="/home.php?u='.$datosTop10['username'].'">'.$datosTop10['username'].'</a><br />'.$datosTop10['credits'].' creditos';

echo '</td>
           
          ';
}
?>

</table>
			</section>
		   <section class="menu"><section class="menu2">
			<center><b>Tienda de placas</b></center></section>
        <center>
        <form method="post">
        <?php echo $error; ?>
        
        	<h4>Consigue una placa a un bajo precio.</h4>
        	<img src="http://images.habbo.com/c_images/album1584/<?php echo $placa; ?>.gif" />
        	<br />
            <br />
            Esta vez, la placa que puedes comptrar es <strong><?php echo $placa; ?></strong>.<br />
            Su precio es de: <strong><?php echo number_format($precio); ?> píxeles</strong>
            <br /><br />
            <input type="submit" value="¡Comprar placa!" name="buy-bad"/>
            <input name="habbo" type="hidden" id="habbo" value="<?php echo $username; ?>"/>
</center>		
		</section>
				   <section class="menu"><section class="menu2">
			<center><b>Un juego</b></center></section>
			<tr>
            <td colspan="2">
            <div style="background:white;padding:3px; border:1px solid #999999;"><iframe src="http://www-open-opensocial.googleusercontent.com/gadgets/ifr?url=http://www.schulz.dk/pacman.xml&amp;container=open&amp;view=home&amp;lang=all&amp;country=MX&amp;debug=0&amp;nocache=0&amp;sanitize=0&amp;v=e348a8057d60ab7b&amp;source=http://xxamericaxx.es.tl/Inicio.htm&amp;parent=http://xxamericaxx.es.tl/Inicio.htm&amp;libs=core:core.io#up_LANG=en&amp;st=%st%" width="275" height="300" style="display:block;" frameborder="0" scrolling="no"></iframe></div>
            </td>
        </tr>
			</section>

    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>