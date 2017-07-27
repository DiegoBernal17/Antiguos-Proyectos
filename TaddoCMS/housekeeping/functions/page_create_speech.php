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
		   data: "method=adds&name=" + $('#bot_name').val() + "&speech=" + $('#bot_speech').val() + "&smode=" + $('#bot_mode').val(),		success: function(){
		    	LoadPage('bots');
	        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}

</script>
	<h1>Crear palabra</h1>
    <div>
<?php
 	echo '<img src="img/info_16.png" class="tooltip" title="Elije un Bot" /><label for="bot_name">Bot:</label><select name="bot_name"id="bot_name" style="width:384px">';
	$lbots = mysql_query("SELECT name, id FROM bots");
	while($bots = mysql_fetch_array($lbots)) {
	echo '<option value="',$bots['id'],'">',$bots['name'],'</option>'; 
}	
	echo '</select><br />';

?>
   <img src="img/info_16.png" class="tooltip" title="Elejir la palabra del Bot" /><label for="bot_speech">Palabra:</label><input type="text" name="bot_speech" id="bot_speech" style="width:384px" value="" /><br />
   <img src="img/info_16.png" class="tooltip" title="Elejir el modo de decir la palabra" /><label for="bot_mode">Modo de decirla:</label><select name="bot_mode" id="bot_mode" style="width:384px"><option value="0">Decir</option><option value="1">Gritar</option></select><br /> 
   <button onclick="SubmitForm()" class="CreateResponse">Crear</button>
</div>