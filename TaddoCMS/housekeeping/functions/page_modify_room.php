<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_edit', $username))
{
header("Location: ../nopermission.php");
die;
}
?>
<script type="text/javascript" src="../Public/tiny_mce/jquery.tinymce.js"></script>
<script language="javascript">
	$('.tooltip').tooltip({ 
	    track: true, 
	    delay: 0, 
	    showURL: false, 
	    showBody: " - ", 
	    fade: 250 
	});
	
	function LoadPage(PageName, Data) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: PageName + ".php",
			   data: Data,
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#' + PageName).addClass('selected');
			     OldPage = PageName;
			   }
			 });
		}

	function SubmitForm() {
		$('button.UpdateUser').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/update_room.php",
		   data: "caption=" + $('#caption').val() + "&owner=" + $('#owner').val() + "&state=" + $('#state').val() + "&users_max=" + $('#users_max').val() + "&password=" + $('#password').val() + "&model_name=" + $('#model_name').val() + "&id=" + $('#id').val(),
			success: function(){
		    $('button#General').html('Posted!');
			LoadPage('rooms', 'roomtype=id&value='+$('#id').val());
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
</script>
<?php
$roomq = mysql_query("SELECT * FROM rooms WHERE id = '".$core->EscapeString($_GET['id'])."' LIMIT 1");
$room = mysql_fetch_array($roomq);
?>

	<h1>Editar Sala</h1>
    <input type="text" name="id" id="id" value="<?php echo $core->EscapeString($_GET['id']); ?>" style="visibility:hidden;" />
	
    <div>
    <img src="img/info_16.png" class="tooltip" title="Modificar Nombre De La Sala" /><label for="caption">Nombre De La Sala:</label><input type="text" name="caption" id="caption" style="width:384px" value="<?php echo $room['caption']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Dueño" /><label for="owner">Dueño:</label><input type="text" name="owner" id="owner" style="width:384px" value="<?php echo $room['owner']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Estatus" /><label for="state">Estatus:</label><select name="state" id="state" style="width:384px"><option value="open" <?php if($room['state'] == 'open') echo 'selected'; ?>>Abierta</option><option value="locked" <?php if($room['state'] == 'locked') echo 'selected'; ?>>Cerrada</option><option value="password" <?php if($room['state'] == 'password') echo 'selected'; ?>>Usa clave</option></select><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Usuarios Maximos" /><label for="users_max">Usuarios Maximos:</label><input type="text" name="users_max" id="users_max" style="width:384px" value="<?php echo $room['users_max']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Contraseña" /><label for="password">Contraseña:</label><input type="text" name="password" id="password" style="width:384px" value="<?php echo $room['password']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Modelo" /><label for="model_name">Modelo:</label><input type="text" name="model_name" id="model_name" style="width:384px" value="<?php echo $room['model_name']; ?>" /><br />
	<button onclick="SubmitForm()" class="UpdateUser">Actualizar</button>