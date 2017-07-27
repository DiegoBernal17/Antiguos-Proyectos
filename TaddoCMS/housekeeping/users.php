<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_users', $username))
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
	
	$('.modify').click(function() {
		LoadContent('page_modify_user', $(this).attr('id'));
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	});
	
	function MakeVIP(id, vip, rank) {
		$('button#MakeVIP'+id).html('Updating...');
		$('button#MakeVIP'+id).attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/user_makevip.php",
		   data: "id=" + id + '&vip=' + vip + '&rank=' + rank,
		   success: function(){
		    $('button#MakeVIP'+id).html('Updated!')
		     .delay(1200)
		     .queue(function(n) {
        	 	Search2('id',id)
        	 	n();
        	 })
		   }
		 });
	};

	$('.delete').click(function() { 
		DeleteStory($(this).attr('id'));
	});

	$('.exitbutton').click(function() { 
	    $('.page').css('display', 'none');
	    $('.overlay').css('display', 'none');
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
	
		function Search(method) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "users.php",
			   data: "method="+method+"&value=" + $('#username').val(),
			   success: function(msg){
			     $('.conColumn').html(msg);
			   }
			 });
		}
		
		function Search2(method,value) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "users.php",
			   data: "method="+method+"&value=" + value,
			   success: function(msg){
			     $('.conColumn').html(msg);
			   }
			 });
		}
		
		function SearchRooms(value) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "rooms.php",
			   data: "roomtype=private&method=userid&value=" + value,
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#rooms').addClass('selected');
			     OldPage = 'rooms';
			   }
			 });
			}
</script>

<div>
	<h1>Usuarios</h1>
	<div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
	
	<div class="formPiece">
		<div>
			<h3>Buscar Usuario</h3>
		</div>

		<div>
        	<img src="img/info_16.png" class="tooltip" title="Busca Un Usuario" />
			<label for="username">Buscar Nombre: </label><input type="text" value="" name="username" id="username" /><br/>
            <button id="General" onClick="Search('username');">Buscar</button>
		</div>
	</div>

	<div class="formPiece">
		<h3>Resultados De La Busqueda</h3>

		<div>
			<?php

			switch(@$_POST['method'])
			{
				case 'username':
				$users_s = mysql_query("SELECT * FROM users WHERE username LIKE '".$_POST['value']."' OR mail LIKE '".$_POST['value']."'");
				break;
				case 'email':
				$users_s = mysql_query("SELECT * FROM users WHERE mail = '".$_POST['value']."'");
				break;
				case 'ip':
				$users_s = mysql_query("SELECT * FROM users WHERE ip_last = '".$_POST['value']."'");
				break;
				case 'rank':
				$users_s = mysql_query("SELECT * FROM users WHERE rank = '".$_POST['value']."'");
				break;
				case 'id':
				$users_s = mysql_query("SELECT * FROM users WHERE id = '".$_POST['value']."'");
				break;
				default:
				echo '<h3>No Hay Datos Disponibles</h3>';
				break;
			}
			
			while($user = @mysql_fetch_array($users_s))
			{
				$rand1 = rand(100000, 999999);
				$rand2 = rand(10000, 99999);
				$rand3 = rand(10000, 99999);
				$rand4 = rand(10000, 99999);
				$rand5 = rand(10000, 99999);
				$rand6 = rand(1, 9);
				$ticket = "ST-".$rand1."-".$rand2.$rand3."-".$rand4.$rand5."-otaku-".$rand6;
			?>
				<div class="UserSearchResults" id="<?php echo $user['id']; ?>">
                	<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $user['look']; ?>" alt="<?php echo $user['username']; ?>" />
					<p>Nombre De Usuario: <strong><?php echo $user['username']; ?></strong><br />
                    Correo: <strong id="<?php echo $user['mail']; ?>" class="tooltip" title="Search by Email" onClick="Search2('email',this.id);"><?php echo $user['mail']; ?></strong><br />
                    Ip Del Usuario: <strong id="<?php echo $user['ip_last']; ?>" class="tooltip" title="Search by IP" onClick="Search2('ip',this.id);"><?php echo $user['ip_last']; ?></strong><br />
                    Última Vez Conectado: <strong><?php echo @date("d-m-Y H:i",$user['last_online']); ?></strong><br />
                    Rango: <strong id="<?php echo $user['rank']; ?>" class="tooltip" title="Search by Rank" onClick="Search2('rank',this.id);"><?php echo $user['rank']; ?></strong><br />
                    <strong id="<?php echo $user['username']; ?>" class="tooltip" title="Salas Del Usuario" onClick="SearchRooms(this.id);">Mis Salas</strong><?php if($users->UserPermission('hk_ext_login', $username)) { ?> ~ <strong id="<?php echo $user['username']; ?>" class="tooltip" title="Ingresar A Este Usuario" onClick="window.open('../client/?username=<?php echo $user['username']; ?>&ticket=<?php echo $ticket; ?>','ClientWndw','width=980,height=597');return false;">Ingresar A Este Usuario</strong><?php } ?></p>
                    <?php if($users->UserPermission('hk_edit', $username))
					{
					?>
                    <?php if($user['vip'] == 0) { ?><button id="MakeVIP<?php echo $user['id']; ?>" onclick="MakeVIP('<?php echo $user['id']; ?>', 1,2);" style="margin:5px;">Hacer VIP</button><?php } ?><?php if($user['vip'] == 1) { ?><button id="MakeVIP<?php echo $user['id']; ?>" onclick="MakeVIP('<?php echo $user['id']; ?>', 0, 1);" style="margin:5px;">Quitar VIP</button><?php } ?><button id="<?php echo $user['id']; ?>" class="modify" style="margin:5px;">Editar Usuario</button>
                    <?php
					}
					?>
				</div>
            <?php
			}
			?>
			
		</div>
	</div>
</div>