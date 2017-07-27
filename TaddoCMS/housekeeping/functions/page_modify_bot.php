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
		$('button.Updatebot').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/config_bot.php",
		   data: "method=update&caption=" + $('#caption').val() + "&roomid=" + $('#bot_room').val() + "&motto=" + $('#bot_motto').val() + "&aitype=" + $('#ai_type').val() + "&look=" + $('#bot_look').val() + "&walkmode=" + $('#walk_mode').val() + "&rotation=" + $('#bot_rotation').val() + "&x=" + $('#bot_x').val() + "&y=" + $('#bot_y').val() + "&z=" + $('#bot_z').val() + "&minx=" + $('#bot_minx').val() + "&maxx=" + $('#bot_maxx').val() + "&miny=" + $('#bot_miny').val() + "&maxy=" + $('#bot_maxy').val() + "&id=" + $('#id').val(),
			success: function(){
		   	LoadPage('bots');
	        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}

</script>
<?php
	$botd = mysql_query("SELECT * FROM bots WHERE id = '".$core->EscapeString($_GET['id'])."' LIMIT 1");
	$bot = mysql_fetch_array($botd);
	$RID = $bot['room_id'];
	$BOTRID = $bot['room_id'];
	$RN = mysql_query("SELECT caption FROM rooms WHERE id = $RID");
	$roomname = mysql_fetch_assoc($RN);

?>

	<h1>Edit Bot</h1>
    <input type="text" name="id" id="id" value="<?php echo $core->EscapeString($_GET['id']); ?>" style="visibility:hidden;" />
	
    <div>
    <img src="img/info_16.png" class="tooltip" title="Modify Bot Name" /><label for="caption">Bot Name:</label><input type="text" name="caption" id="caption" style="width:384px" value="<?php echo $bot['name']; ?>" /><br />
<?php
 	echo '<img src="img/info_16.png" class="tooltip" title="Modify Bot Room" /><label for="bot_room">Bot Room:</label><select name="bot_room"id="bot_room" style="width:384px">';
	$lrooms = mysql_query("SELECT caption, id FROM rooms where roomtype = 'public'");
	while($rooms = mysql_fetch_array($lrooms)) {
	echo '<option ' . ($BOTRID==$rooms['id'] ? 'selected' : '') . ' value="'.$rooms['id'].'">'.$rooms['caption'].'</option>'; 
}	
	echo '</select><br />';
	
?>    
    <img src="img/info_16.png" class="tooltip" title="Modify Bot Motto" /><label for="bot_motto">Bot Motto:</label><input type="text" name="bot_motto" id="bot_motto" style="width:384px" value="<?php echo $bot['motto']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify AI type" /><label for="ai_type">AI Type:</label><select name="ai_type" id="ai_type" style="width:384px"><option value="generic" <?php if($bot['ai_type'] == 'generic') echo 'selected'; ?>>generic</option><option value="guide" <?php if($bot['ai_type'] == 'guide') echo 'selected'; ?>>guide</option><option value="pet" <?php if($bot['ai_type'] == 'pet') echo 'selected'; ?>>pet</option></select><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Bot Look" /><label for="bot_look">Bot Look:</label><input type="text" name="bot_look" id="bot_look" style="width:384px" value="<?php echo $bot['look']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Walk Mode" /><label for="walk_mode">Walk Mode:</label><select name="walk_mode" id="walk_mode" style="width:384px"><option value="stand" <?php if($bot['walk_mode'] == 'stand') echo 'selected'; ?>>stand</option><option value="freeroam" <?php if($bot['walk_mode'] == 'freeroam') echo 'selected'; ?>>freeroam</option><option value="specified range" <?php if($bot['walk_mode'] == 'specified_range') echo 'selected'; ?>>specified_range</option></select><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Bot Rotation" /><label for="bot_rotation">Bot Rotation:</label><input type="text" name="bot_rotation" id="bot_rotation" style="width:384px" value="<?php echo $bot['rotation']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify X Axis" /><label for="bot_x">Bot X Axis:</label><input type="text" name="bot_x" id="bot_x" style="width:384px" value="<?php echo $bot['x']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Y Axis" /><label for="bot_Y">Bot Y Axis:</label><input type="text" name="bot_y" id="bot_y" style="width:384px" value="<?php echo $bot['y']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Z Axis" /><label for="bot_z">Bot Z Axis:</label><input type="text" name="bot_z" id="bot_z" style="width:384px" value="<?php echo $bot['z']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Min X Axis" /><label for="bot_minx">Bot Min X Axis:</label><input type="text" name="bot_minx" id="bot_minx" style="width:384px" value="<?php echo $bot['min_x']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Max X Axis" /><label for="bot_maxx">Bot Max X Axis:</label><input type="text" name="bot_maxx" id="bot_maxx" style="width:384px" value="<?php echo $bot['max_x']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Min Y Axis" /><label for="bot_miny">Bot Min Y Axis:</label><input type="text" name="bot_miny" id="bot_miny" style="width:384px" value="<?php echo $bot['min_y']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modify Max Y Axis" /><label for="bot_maxy">Bot Max Y Axis:</label><input type="text" name="bot_maxy" id="bot_maxy" style="width:384px" value="<?php echo $bot['max_y']; ?>" /><br />
    <button onclick="SubmitForm()" class="Updatebot">Update</button>
    </div>