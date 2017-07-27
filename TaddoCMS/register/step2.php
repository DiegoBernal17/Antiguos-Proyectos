<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include("../global.php");
if($_POST['email'] == NULL || $_POST['bdday'] == NULL || $_POST['bdmonth'] == NULL || $_POST['bdyear'] == NULL || $_POST['password'] == NULL)
header("Location: index.php");
$_SESSION['register'] = true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> 
	<title><?php echo $sitename; ?> - Registrate es gratis</title>
	<link type="text/css" rel="stylesheet" href="../Public/Styles/CSS/login.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
</head> 
 
<body> 


<div class="loginBox"> 
	<div class="top"> 
		<a href="../index.php"><img src="../Public/Styles/Images/logo.png" /></a>
		<?php echo $core->UsersOnline(); ?> Usuarios online
	</div> 
	
	<div class="mid"> 
		<div class="registerstep2">
			<div class="box_header">Crea tu avatar</div> 
			Habbo Nombre:<br /> 
			<input type="text" id="habbo_name_field" /> 
			<input type="submit" value="Comprobar" onmousedown="this.style.backgroundColor='#ddd'; doCheckHabboName();" onmouseup="this.style.backgroundColor='#eee';" onmouseover="this.style.backgroundColor='#eee';" onmouseout="this.style.backgroundColor='#fff';" /><br />
			<div class="errormsg display_none" id="habbo_name_message_box"> 
				<h3>Error message</h3> 
				Error text goes here oh no.
			</div>
			<br /> 
			
			<script type="text/javascript"> 
				function doUpdateImage( incoming ) {
					$('#figure').val(incoming.rel);
					document.getElementById('main_reg_img').src = 'http://www.habbo.com/habbo-imaging/avatarimage?figure=' + incoming.rel + '&size=b&direction=2';
					return false;
				}
				
				function enableField() {
					$('#username').val($('#habbo_name_field').val());
					document.getElementById('register-button').disabled=false;
				}
 
				function disableField() {
					$('#username').val('');
					document.getElementById('register-button').disabled=true;
				}
 
				function doCheckHabboName() {
					name = $("#habbo_name_field").val();
					
					if( name.length < 3 ) {
						$("#habbo_name_message_box").html("<h3>Tu nombre es demasiado pequeño</h3>Por favor elige un nombre más largo.");
						$("#habbo_name_message_box").removeClass().addClass("errormsg");
						disableField();
							
						return false;
					}
					
					$.get("namecheck.php", {ajaxAct: "check_habbo_name", habbo_name: name}, function(data) {
						if( $.trim(data) == "1" ) {
							$("#habbo_name_message_box").html("<h3>" + name + " está disponible.</h3>'");
							$("#habbo_name_message_box").removeClass().addClass("goodmsg");
							enableField();
						} else {
							$("#habbo_name_message_box").html("<h3>" + name + " <u>no</u> está disponible</h3>Por favor selecciona un nombre diferente..");
							$("#habbo_name_message_box").removeClass().addClass("errormsg");
							disableField();
						}
					});
				}
				
				$('#habbo_name_field').keypress(function(e){
					if(e.which == 13){
						doCheckHabboName();
					}
				});
				
				$('#habbo_name_field').blur(function(e){
					doCheckHabboName();
				});
				</script>
			
			
			<div id="avatar-field-container"> 
                <div class="field field-avatar"> 
                    <div id="selected-avatar"> 
                        <h3>Previa</h3>
                        <img id="main_reg_img" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=hr-515-45.hd-600-8.ch-884-76.lg-696-76.sh-740-76.ea-1401-76.ca-1815-62.wa-2011&size=b&direction=4" ref="hr-515-45.hd-600-8.ch-884-76.lg-696-76.sh-740-76.ea-1401-76.ca-1815-62.wa-2011" width="64" height="110"/> 
                    </div> 
                    <div id="avatar-choices"> 
                        <h3>Chicas</h3> 
						<?php
						$query = mysql_query("SELECT * FROM cms_registration_figures WHERE gender = 'f' ORDER BY RAND() LIMIT 11");
						while($figure = mysql_fetch_array($query))
						{
							echo '<a class="female-avatar" onclick="doUpdateImage(this); return false;" rel="'.$figure["figure"].'"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure='.$figure["figure"].'&direction=4&size=s" width="33" height="56"/></a>';
						}
						?>
                        <h3>Chicos</h3> 
						<?php
						$query = mysql_query("SELECT * FROM cms_registration_figures WHERE gender = 'm' ORDER BY RAND() LIMIT 11");
						while($figure = mysql_fetch_array($query))
						{
							echo '<a class="male-avatar" onclick="doUpdateImage(this); return false;" rel="'.$figure["figure"].'"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure='.$figure["figure"].'&direction=4&size=s" width="33" height="56"/></a>';
						}
						?>
                    </div>
				</div>
			</div>
			
				<form id="register_step_two" method="post" action="complete.php">
                	<?php if($_POST['character'] == '1')
					echo  '<input type="hidden" name="character" id="character" value="1" />';
					?>
					<input type="hidden" name="email" id="email" value="<?php echo($_POST['email']); ?>" />
					<input type="hidden" name="bdday" id="bdday" value="<?php echo($_POST['bdday']); ?>" />
					<input type="hidden" name="bdmonth" id="bdmonth" value="<?php echo($_POST['bdmonth']); ?>" />
					<input type="hidden" name="bdyear" id="bdyear" value="<?php echo($_POST['bdyear']); ?>">
					<input type="hidden" name="username" id="username" value="" />
					<input type="hidden" name="figure" id="figure" value="hr-515-45.hd-600-8.ch-884-76.lg-696-76.sh-740-76.ea-1401-76.ca-1815-62.wa-2011" />
					<input type="hidden" name="password" id="password" value="<?php echo($_POST['password']); ?>" />
					<input type="submit" value="Registrarse" id="register-button" onmousedown="this.style.backgroundColor='##ddd';" onmouseup="this.style.backgroundColor='##eee';" onmouseover="this.style.backgroundColor='##eee';" onmouseout="this.style.backgroundColor='##fff';" disabled="disabled" />	
				</form>
		</div>
	</div>
	
	<?php include("../site/footer.php"); ?>
</div> 
 
</body> 
</html>