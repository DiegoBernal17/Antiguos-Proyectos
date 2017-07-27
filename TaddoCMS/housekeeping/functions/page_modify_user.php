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
		   url: "functions/update_user.php",
		   data: "username=" + $('#username').val() + "&real_name=" + $('#real_name').val() + "&mail=" + $('#mail').val() + "&motto=" + $('#motto').val() + "&rank=" + $('#rank').val() + "&credits=" + $('#credits').val() + "&activity_points=" + $('#pixels').val() + "&vip=" + $('#vip').val() + "&id=" + $('#id').val() + "&oldusername=" + $('#oldusername').val(),
			success: function(){
		    $('button#General').html('Posted!');
			LoadPage('users', 'method=id&value='+$('#id').val());
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
</script>
<?php
$userq = mysql_query("SELECT * FROM users WHERE id = '".$core->EscapeString($_GET['id'])."' LIMIT 1");
$user = mysql_fetch_array($userq);
?>

	<h1>Editar Usuario</h1>
    <input type="text" name="id" id="id" value="<?php echo $core->EscapeString($_GET['id']); ?>" style="visibility:hidden;" />
    <input type="text" name="oldusername" id="oldusername" value="<?php echo $user['username']; ?>" style="visibility:hidden;" />

	<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $user['look']; ?>" /><br /><br />
	
    <div>
    <img src="img/info_16.png" class="tooltip" title="Modificar Nombre De Usuario" /><label for="username">Nombre De Usuario:</label><input type="text" name="username" id="username" style="width:384px" value="<?php echo $user['username']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Nombre Real" /><label for="real_name">Nombre Real:</label><input type="text" name="real_name" id="real_name" style="width:384px" value="<?php echo $user['real_name']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Correo" /><label for="mail">Correo:</label><input type="text" name="mail" id="mail" style="width:384px" value="<?php echo $user['mail']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Misión" /><label for="motto">Misión:</label><input type="text" name="motto" id="motto" style="width:384px" value="<?php echo $user['motto']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Rango" /><label for="rank">Rango:</label><input type="text" name="rank" id="rank" style="width:384px" value="<?php echo $user['rank']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Creditos" /><label for="credits">Creditos:</label><input type="text" name="credits" id="credits" style="width:384px" value="<?php echo $user['credits']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar pixels" /><label for="pixels">Píxeles:</label><input type="text" name="pixels" id="pixels" style="width:384px" value="<?php echo $user['activity_points']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="VIP" /><label for="vip">Vip:</label><select type="text" name="vip" id="vip" style="width:384px"><option value="0" <?php if($user['vip'] == '0') echo 'selected'; ?>>0</option><option value="1" <?php if($user['vip'] == '1') echo 'selected'; ?>>1</option></select><br />
    </div>
	<button onclick="SubmitForm()" class="UpdateUser">Actualizar</button>