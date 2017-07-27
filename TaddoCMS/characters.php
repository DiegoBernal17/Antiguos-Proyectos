<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'characters');
$email = $core->EscapeString($_SESSION['account']);
if(!$users->MailTaken($email))
header("Location: index.php");
unset($_SESSION['username']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title><?php echo $sitename; ?> - Characters</title>
	<link type="text/css" rel="stylesheet" href="./Public/Styles/CSS/avatarselect.css" />
    <link type="text/css" rel="stylesheet" href="./Public/Styles/CSS/main.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
</head> 

	<script language="javascript"> 
	(function($){
		$(document).ready(function() {
			$('.avatar').click(function()  {
				var Name = $(this).attr('alt');
				var Figure = $(this).attr('figure');
				var LoginDate = $(this).attr('lastlogin');
				container = '.CurrentAvatar';
				$(container).fadeOut(500, function () {
					$('#CharName').html(Name)
					$('.Mainavatar').html('<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' + Figure + '" alt="' + Name + '" />')
					$('.LastLogin').html('Última vez conectado: ' + LoginDate)
					$(container).fadeIn(500)
				});
				return;
			});

			$('.LoginButton').click(function()  {
				var Name = $('#CharName').html();
				location.href='./functions/userlogin.php?name=' + Name;
				return;
			});

		});
		
	})(jQuery);
	</script>

<body> 
<div class="MainBox">
	<div class="top"> 
		<a href="./index.php"><img src="./Public/Styles/Images/logo.png" /></a>
		<?php echo $core->UsersOnline(); ?> Usuarios online
	</div> 
	
	<div class="mid"> 
		<div class="CurrentAvatar">
			<?php
			$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE mail = '".$email."' ORDER BY last_online DESC LIMIT 50"));
			echo '<div class="box_header" id="CharName">'.$user["username"].'</div>
			<div class="Mainavatar"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure='.$user["look"].'" /></div>
			<div class="LoginButton">Entrar</div>
			<div class="LastLogin">Última vez conectado: '.@date("d-m-Y", $user["last_online"]).'</div>'; ?>
		</div> 
        

		<div class="AvatarSelection"> 
			<div class="box_header">Selecciona un avatar</div>
			<div class="Avatars">
            <?php
			$userq = mysql_query("SELECT * FROM users WHERE mail = '".$email."' ORDER BY last_online DESC LIMIT 50");
			while($user = mysql_fetch_array($userq))
			{
				echo '<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure='.$user["look"].'&size=s" figure="'.$user["look"].'" alt="'.$user["username"].'" class="avatar" lastlogin="'.@date("d-m-Y", $user["last_online"]).'" />';
			}
			?>
			</div>
			<form id="Add_Avatar" method="post" action="./register/step2.php">
				<input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
				<input type="hidden" name="bdday" id="bdday" value="why" />
				<input type="hidden" name="bdmonth" id="bdmonth" value="are" />
				<input type="hidden" name="bdyear" id="bdyear" value="you" />
				<input type="hidden" name="password" id="password" value="LookingHere" />
				<div class="AddAvatar" onclick="Add_Avatar.submit();">Agregar otro habbo</div>
			</form>
		</div>
        	<div class="AvatarSelection"> 
			<div class="box_header">Tu informacion</div>
			<div class="Avatars">
            <?php
			$userq = mysql_query("SELECT * FROM users WHERE mail = '".$email."' ORDER BY last_online DESC");
			$user = mysql_fetch_array($userq);
			echo '<a class="selected">Email:</a> '.$user['mail'].'<br /><a class="selected">Rango máximo:</a> '.$users->UserInfoMax('rank', $email).'<br /><a class="selected">Última vez conectado:</a> '.$user["username"].' - '.@date("d-m-Y H:i", $user["last_online"]).'<br /><a class="selected">IP:</a> '.$user['ip_last'].'<br /><a class="selected">Créditos totales:</a> '.$users->UserInfoSum('credits', $email).'<br /><a class="selected">Píxeles totales:</a> '.$users->UserInfoSum('activity_points', $email).'<br />';
			?>
			</div>
		</div>
	</div> 
	
	<?php include("site/footer.php"); ?>
</div> 
 
</body> 
</html>