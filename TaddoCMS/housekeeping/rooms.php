<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_rooms', $username))
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
		LoadContent('page_modify_room', $(this).attr('id'));
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	});

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
	
		function Search() {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "rooms.php",
			   data: "roomtype=private&method=name&value=" + $('#room').val(),
			   success: function(msg){
			     $('.conColumn').html(msg);
			   }
			 });
		}
		
		function Search2(roomtype) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "rooms.php",
			   data: "roomtype="+roomtype,
			   success: function(msg){
			     $('.conColumn').html(msg);
			   }
			 });
		}
		
		function Search3(username) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: "users.php",
			   data: "method=username&value="+username ,
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#users').addClass('selected');
			     OldPage = 'users';
			   }
			 });
		}
		
</script>

<div>
	<h1>Salas</h1>
	<div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
	
	<div class="formPiece">
		<div>
			<h3>Buscar Sala</h3>
		</div>

		<div>
        	<img src="img/info_16.png" class="tooltip" title="Buscar Salas" />
			<label for="room">Buscar Salas: </label><input type="text" value="" name="room" id="room" /><br/>
            <button id="General" onClick="Search();">Buscar</button>
		</div>
	</div>
    
    <div class="formPiece">
    <?php
	if(@$_POST['roomtype'] == 'public')
	{
	?>
    <button id="General" class="left" onClick="Search2('private');">Mostrar habitaciones privadas</button>
    <?php
    }
	else
	{?>
	<button id="General" class="left" onClick="Search2('public');">Mostrar habitaciones privadas</button>
    <?php
	}
	?>
    </div>

	<div class="formPiece">
		<h3>Resultados De La Busqueda</h3>

		<div>
			<?php
			switch(@$_POST['roomtype'])
			{
				case 'private':
				switch(@$_POST['method'])
				{
					case 'userid':
					$rooms = mysql_query("SELECT * FROM rooms WHERE owner = '".$core->EscapeString($_POST['value'])."'");
					break;
					case 'name':
					$rooms = mysql_query("SELECT * FROM rooms WHERE caption LIKE '".$core->EscapeString($_POST['value'])."'");
					break;
					default:
					$rooms = mysql_query("SELECT * FROM rooms WHERE roomtype = 'private' ORDER BY users_now DESC LIMIT 20");
					break;
				}
				break;
				case 'public':
				$rooms = mysql_query("SELECT * FROM rooms WHERE roomtype = 'public' ORDER BY users_now DESC");
				break;
				case 'id':
				$rooms = mysql_query("SELECT * FROM rooms WHERE id = '".$core->EscapeString($_POST['value'])."'");
				break;
				default:
				$rooms = mysql_query("SELECT * FROM rooms WHERE roomtype = 'private' ORDER BY users_now DESC LIMIT 20");
				break;
			}
			
			if(mysql_num_rows($rooms) == 0)
			{
				echo '<h3>No Hay Datos Disponibles</h3>';
			}
			
			while($room = mysql_fetch_array($rooms))
			{
			?>
				<div class="RoomSearchResults" id="<?php echo $room['id']; ?>">
                	<div class="RoomSearchResultsIcon" style="background-image:url(img/rooms/<?php if($room['roomtype'] == 'private')echo $room['model_name']; else echo 'public'; ?>.gif)"></div>
					<p>Nombre De La Sala: <strong><?php echo $room['caption']; ?></strong><br />
                    Tipo De Sala: <strong><?php echo $room['roomtype']; ?></strong><br />
                    Dueño: <strong onClick="Search3('<?php echo $room['owner']; ?>');"><?php echo $room['owner']; ?></strong><br />
                    Contraseña: <strong><?php echo $room['password']; ?></strong><br />
                    Estatus: <strong><?php echo $room['state']; ?></strong><br />
                    Usuarios En La Sala: <strong><?php echo $room['users_now']; ?></strong><br />
                    Usuarios Maximos: <strong><?php echo $room['users_max']; ?></strong><br />
                    </p>
                    <?php if($users->UserPermission('hk_edit', $username))
					{ ?><button id="<?php echo $room['id']; ?>" class="modify">Editar Sala</button><?php } ?>
				</div>
            <?php
			}
			?>
			
		</div>
	</div>
</div>