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
		   data: "method=updater&name=" + $('#bot_name').val() + "&keywords=" + $('#bot_key').val() + "&response=" + $('#bot_resp').val() + "&smode=" + $('#bot_mode').val() + "&id=" + $('#id').val(),
			success: function(){
		   	LoadPage('bots');
	        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}

</script>
<?php
	$botr = mysql_query("SELECT * FROM bots_responses WHERE id = '".$core->EscapeString($_GET['id'])."' LIMIT 1");
	$response = mysql_fetch_array($botr);
?>

	<h1>Edit Response</h1>
    <input type="text" name="id" id="id" value="<?php echo $core->EscapeString($_GET['id']); ?>" style="visibility:hidden;" />
	
    <div>

<?php
 	echo '<img src="img/info_16.png" class="tooltip" title="Modify Selected Bot" /><label for="bot_name">Selected Bot:</label><select name="bot_name"id="bot_name" style="width:384px">';
	$lbots = mysql_query("SELECT name, id FROM bots");
	while($bots = mysql_fetch_array($lbots)) {
	echo '<option ' . ($response['bot_id']==$bots['id'] ? 'selected' : '') . ' value="'.$bots['id'].'">'.$bots['name'].'</option>'; 	
}	
	echo '</select><br />';

?>    
    <img src="img/info_16.png" class="tooltip" title="Edit Bot Keywords (Split with ;)" /><label for="bot_key">Bot Keywords:</label><input type="text" name="bot_key" id="bot_key" style="width:384px" value="<?php echo $response['keywords']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Edit Bot Reponse" /><label for="bot_resp">Bot Response:</label><input type="text" name="bot_resp" id="bot_resp" style="width:384px" value="<?php echo $response['response_text']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Edit Bot Speech Mode" /><label for="bot_mode">Bot Speech Mode:</label><select name="bot_mode" id="bot_mode" style="width:384px"><option value="say" <?php if($response['mode'] == 'say') echo 'selected'; ?>>Say</option><option value="shout" <?php if($response['mode'] == 'shout') echo 'selected'; ?>>Shout</option></select><br />
    <button onclick="SubmitForm()" class="Updatebot">Update</button>
    </div>