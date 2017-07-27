<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_badge', $username))
{
header("Location: nopermission.php");
die;
}
?>
<script language="javascript">
	$('.tooltip').tooltip({ 
	    track: true, 
	    delay: 0, 
	    showURL: false, 
	    showBody: " - ", 
	    fade: 250 
	});
	
	function LoadContent(PageName, ID) {
		$.ajax({
		   type: "POST",
		   url: "functions/" + PageName + ".php?id=" + ID,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	}

	function DisplayLoad(ButtonID) {
		$('button#' + ButtonID).attr('disabled', 'disabled');
	}
	
	$('.exitbutton').click(function() { 
	    $('.page').css('display', 'none');
	    $('.overlay').css('display', 'none');
	});
	

	function Give() {
		if($('#username').val() != '')
		{
		$.ajax({
		   type: "POST",
		   url: "functions/page_give_badge.php?username=" + $('#username').val(),
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
		}
	}
	
	function Remove(user,badge,username)
	{
			$('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "functions/badge.php",
			   data: "user=" + user + '&badge=' + badge + '&method=remove',
			   success: function(msg){
			     $('.conColumn').html(msg);
				 Search2(username);
			   }
			 });
	}
	
		function Search() {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "badge.php",
			   data: "username="+$('#username2').val(),
			   success: function(msg){
			     $('.conColumn').html(msg);
			   }
			 });
		}
		
		function Search1() {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "badge.php",
			   data: "badge_id="+$('#badge_id').val(),
			   success: function(msg){
			     $('.conColumn').html(msg);
			   }
			 });
		}
		
		function Search2(username) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "badge.php",
			   data: "username="+username,
			   success: function(msg){
			     $('.conColumn').html(msg);
			   }
			 });
		}
	
</script>
<div>
	<h1>Placas</h1>
    <div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
    
	<div class="formPiece">
		<div>
			<h3>Dar Placas</h3>
		</div>
		<div>
			<img src="img/info_16.png" class="tooltip" title="Nombre De Usuario" />
			<label for="username">Nombre De Usuario: </label><input type="text"  name="username" id="username" /><br />
			<button id="Give" onClick="Give();">Dar Placas</button><br /><br />
		</div>
	</div>
    
	<div class="formPiece">
		<div>
			<h3>Buscar Las Placas De Un Usuario</h3>
		</div>
		<div>
			<img src="img/info_16.png" class="tooltip" title="Nombre De Usuario" />
			<label for="username2">Nombre De Usuario: </label><input type="text"  name="username2" id="username2" /><br />
			<button id="Search" onClick="Search();">Buscar</button><br /><br />
		</div>
	</div>
    
    <div class="formPiece">
		<div>
			<h3>Buscar Usuarios Que Estan Usando Esta Placa</h3>
		</div>
		<div>
			<img src="img/info_16.png" class="tooltip" title="Nombre De La Placa" />
			<label for="badge_id">Placa: </label><input type="text"  name="badge_id" id="badge_id" /><br />
			<button id="Search" onClick="Search1();">Buscar</button><br /><br />
		</div>
	</div>
    
	<div class="formPiece">
		<h3>Resultados De La Busqueda</h3><br />

		<div>
			<?php

			if(isset($_POST['username']))
			{
				$badges = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$users->UserID($core->EscapeString($_POST['username']))."'");
				echo 'Haga clic en la placa para eliminarla<br />';
			}
			elseif(isset($_POST['badge_id']))
			{
				$badges = mysql_query("SELECT * FROM user_badges WHERE badge_id = '".$core->EscapeString($_POST['badge_id'])."'");
				echo 'Haga clic en la placa para eliminarla<br />';
			}
			else
			{
				echo '<h3>No Hay Datos Disponibles</h3>';
			}
			
			while($badge = @mysql_fetch_array($badges))
			{
			?>
				<div class="BadgeSearchResults" onClick="Remove('<?php echo $badge['user_id']; ?>','<?php echo $badge['badge_id']; ?>','<?php echo $users->UserName($badge['user_id']); ?>');">
                	<img src="../Public/Images/badges/<?php echo $badge['badge_id']; ?>.gif" alt="<?php echo $badge['badge_id']; ?>" />
                    <center>
                    <?php if(isset($_POST['badge_id'])) echo $users->UserName($badge['user_id']); ?></center>
				</div>
            <?php
			}
			?>
			
		</div>
	</div>
</div>