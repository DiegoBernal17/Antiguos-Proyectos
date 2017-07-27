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
		$('button.CreateResponse').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/config_bot.php",
		   data: "method=addr&name=" + $('#bot_name').val() + "&keywords=" + $('#bot_key').val() + "&response=" + $('#bot_resp').val() + "&smode=" + $('#bot_mode').val(),
			success: function(){
		    	LoadPage('bots');
	        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}

</script>
	<h1>Crear respuesta</h1>
    <div>
<?php
 	echo '<img src="img/info_16.png" class="tooltip" title="Elije el Bot" /><label for="bot_name">Bot:</label><select name="bot_name"id="bot_name" style="width:384px">';
	$lbots = mysql_query("SELECT name, id FROM bots");
	while($bots = mysql_fetch_array($lbots)) {
	echo '<option value="',$bots['id'],'">',$bots['name'],'</option>'; 
}	
	echo '</select><br />';

?>
    <img src="img/info_16.png" class="tooltip" title="Elije la palabra clave del Bot" /><label for="bot_key">Palabra clave del Bot:</label><input type="text" name="bot_key" id="bot_key" style="width:384px" value="" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije la respuesta de la palabra clave del Bot" /><label for="bot_resp">Respuesta del Bot:</label><input type="text" name="bot_resp" id="bot_resp" style="width:384px" value="" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el modo de voz del Bot" /><label for="bot_mode">Modo de voz del Bot:</label><select name="bot_mode" id="bot_mode" style="width:384px"><option value="say">Decir</option><option value="shout">Gritar</option></select><br />
    <button onclick="SubmitForm()" class="CreateResponse">Crear</button>
</div>