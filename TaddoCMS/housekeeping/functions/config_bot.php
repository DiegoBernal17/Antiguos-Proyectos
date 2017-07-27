<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_bots', $username))
{
header("Location: ../nopermission.php");
die;
}
?>
<script type="text/javascript" src="../Public/tiny_mce/jquery.tinymce.js"></script>
<script language="javascript">
		
	function SubmitForm() {
		$('button.Updatebot').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/update_bot.php",
		   data: "caption=" + $('#caption').val() + "&roomid=" + $('#bot_room').val() + "&motto=" + $('#bot_motto').val() + "&aitype=" + $('#ai_type').val() + "&look=" + $('#bot_look').val() + "&walkmode=" + $('#walk_mode').val() + "&rotation=" + $('#bot_rotation').val() + "&x=" + $('#bot_x').val() + "&y=" + $('#bot_y').val() + "&z=" + $('#bot_z').val() + "&minx=" + $('#bot_minx').val() + "&maxx=" + $('#bot_maxx').val() + "&miny=" + $('#bot_miny').val() + "&maxy=" + $('#bot_maxy').val() + "&id=" + $('#id').val(),
			success: function(){
		    $('button#General').html('Posted!');
			LoadPage('bots');
	        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
</script>

<?php
if(isset($_POST['method']) && ($_POST['method']) == 'remove') {
if(is_numeric($_POST['id'])) {
	$query = mysql_query("DELETE FROM bots WHERE id = '".$core->EscapeString($_POST['id'])."'");
	}
}
if(isset($_POST['method']) && ($_POST['method']) == 'add') {
if(isset($_POST['caption']) && isset($_POST['roomid']) && isset($_POST['motto']) && isset($_POST['aitype']) && isset($_POST['look']) && isset($_POST['walkmode']) && is_numeric($_POST['rotation']) && is_numeric($_POST['x']) && is_numeric($_POST['y']) && is_numeric($_POST['z']) && is_numeric($_POST['minx']) && is_numeric($_POST['maxx']) && is_numeric($_POST['miny']) && is_numeric($_POST['maxy'])) {
	$query = mysql_query("INSERT INTO bots (name, room_id, motto, ai_type, look, walk_mode, rotation, x, y, z, min_x, max_x, min_y, max_y) VALUES ('".$core->EscapeString($_POST['caption'])."', '".$core->EscapeString($_POST['roomid'])."', '".$core->EscapeString($_POST['motto'])."', '".$core->EscapeString($_POST['aitype'])."', '".$core->EscapeString($_POST['look'])."', '".$core->EscapeString($_POST['walkmode'])."', '".$core->EscapeString($_POST['rotation'])."', '".$core->EscapeString($_POST['x'])."', '".$core->EscapeString($_POST['y'])."', '".$core->EscapeString($_POST['z'])."', '".$core->EscapeString($_POST['minx'])."', '".$core->EscapeString($_POST['maxx'])."', '".$core->EscapeString($_POST['miny'])."', '".$core->EscapeString($_POST['maxy'])."');");
	}
}
if(isset($_POST['method']) && ($_POST['method']) == 'update') {
if(isset($_POST['caption']) && is_numeric($_POST['roomid']) && isset($_POST['motto']) && isset($_POST['aitype']) && isset($_POST['look']) && isset($_POST['walkmode']) && is_numeric($_POST['rotation']) && is_numeric($_POST['x']) && is_numeric($_POST['y']) && is_numeric($_POST['z']) && is_numeric($_POST['minx']) && is_numeric($_POST['maxx']) && is_numeric($_POST['miny']) && is_numeric($_POST['maxy']) && is_numeric($_POST['id'])) {
	$query = mysql_query("UPDATE bots SET name = '".$core->EscapeString($_POST['caption'])."', room_id = '".$core->EscapeString($_POST['roomid'])."', motto = '".$core->EscapeString($_POST['motto'])."', ai_type = '".$core->EscapeString($_POST['aitype'])."', look = '".$_POST['look']."', walk_mode = '".$core->EscapeString($_POST['walkmode'])."', rotation = '".$_POST['rotation']."', x = '".$_POST['x']."', y = '".$_POST['y']."', z = '".$_POST['z']."', min_x = '".$_POST['minx']."', max_x = '".$_POST['maxx']."', min_y = '".$_POST['miny']."', max_y = '".$_POST['maxy']."' WHERE id ='".$core->EscapeString($_POST['id'])."'");	
	}
}
if(isset($_POST['method']) && ($_POST['method']) == 'duplicate') {
if(is_numeric($_POST['id'])) {
	$dbot = mysql_query("SELECT * FROM bots WHERE id = '".$core->EscapeString($_POST['id'])."' LIMIT 1");
	$bots = mysql_fetch_array($dbot);
	$query = mysql_query("INSERT INTO bots (name, room_id, motto, ai_type, look, walk_mode, rotation, x, y, z, min_x, max_x, min_y, max_y) VALUES ('bots['name']', 'bots['room_id']', 'bots['motto']', 'bots['ai_type']', 'bots['look']', 'bots['walk_mode']', 'bots['rotation']', 'bots['x']', 'bots['y']', 'bots['z']', 'bots['min_x']', 'bots['max_x']', 'bots['min_y']', 'bots['max_y']');");	
	}	
}
if(isset($_POST['method']) && ($_POST['method']) == 'remover') {
if(is_numeric($_POST['id'])) {
	$query = mysql_query("DELETE FROM bots_responses WHERE id = '".$core->EscapeString($_POST['id'])."'");
	}
}
if(isset($_POST['method']) && ($_POST['method']) == 'removes') {
if(is_numeric($_POST['id'])) {
	$query = mysql_query("DELETE FROM bots_speech WHERE id = '".$core->EscapeString($_POST['id'])."'");
	}
}
if(isset($_POST['method']) && ($_POST['method']) == 'addr') {
if(is_numeric($_POST['name']) && isset($_POST['keywords']) && isset($_POST['response']) && isset($_POST['smode'])) {
	$query = mysql_query("INSERT INTO bots_responses (bot_id, keywords, response_text, mode) VALUES ('".$core->EscapeString($_POST['name'])."', '".$core->EscapeString($_POST['keywords'])."', '".$core->EscapeString($_POST['response'])."', '".$core->EscapeString($_POST['smode'])."');");
	}
}
if(isset($_POST['method']) && ($_POST['method']) == 'updater') {
if(is_numeric($_POST['id']) && is_numeric($_POST['name']) && isset($_POST['keywords']) && isset($_POST['response']) && isset($_POST['smode'])) {
	$query = mysql_query("UPDATE bots_responses SET bot_id = '".$core->EscapeString($_POST['name'])."', keywords = '".$core->EscapeString($_POST['keywords'])."', response_text = '".$core->EscapeString($_POST['response'])."', mode = '".$core->EscapeString($_POST['smode'])."' WHERE id ='".$core->EscapeString($_POST['id'])."'");	
	}
}
if(isset($_POST['method']) && ($_POST['method']) == 'adds') {
if(is_numeric($_POST['name']) && isset($_POST['speech']) && isset($_POST['smode'])) {
	$query = mysql_query("INSERT INTO bots_speech (bot_id, text, shout) VALUES ('".$core->EscapeString($_POST['name'])."', '".$core->EscapeString($_POST['speech'])."', '".$core->EscapeString($_POST['smode'])."');");
	}
}
if(isset($_POST['method']) && ($_POST['method']) == 'updates') {
if(is_numeric($_POST['name']) && isset($_POST['speech']) && is_numeric($_POST['smode'])) {
	$query = mysql_query("UPDATE bots_speech SET bot_id = '".$core->EscapeString($_POST['name'])."', text = '".$core->EscapeString($_POST['speech'])."', shout = '".$core->EscapeString($_POST['smode'])."' WHERE id ='".$core->EscapeString($_POST['id'])."'");	
	}
}
?>