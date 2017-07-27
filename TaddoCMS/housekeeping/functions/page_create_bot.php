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
		$('button.Createbot').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/config_bot.php",
		   data: "method=add&caption=" + $('#caption').val() + "&roomid=" + $('#bot_room').val() + "&motto=" + $('#bot_motto').val() + "&aitype=" + $('#ai_type').val() + "&look=" + $('#bot_look').val() + "&walkmode=" + $('#walk_mode').val() + "&rotation=" + $('#bot_rotation').val() + "&x=" + $('#bot_x').val() + "&y=" + $('#bot_y').val() + "&z=" + $('#bot_z').val() + "&minx=" + $('#bot_minx').val() + "&maxx=" + $('#bot_maxx').val() + "&miny=" + $('#bot_miny').val() + "&maxy=" + $('#bot_maxy').val(),
			success: function(){
		    	LoadPage('bots');
	        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}

</script>
	<h1>Create Bot</h1>
    <div>
    <img src="img/info_16.png" class="tooltip" title="Elije un nombre para el Bot" /><label for="caption">Nombre del Bot:</label><input type="text" name="caption" id="caption" style="width:384px" value="Bot" /><br />

<?php
 	echo '<img src="img/info_16.png" class="tooltip" title="Elije el lugar donde estara el Bot" /><label for="bot_room">Lugar del Bot:</label><select name="bot_room"id="bot_room" style="width:384px">';
	$lrooms = mysql_query("SELECT caption, id FROM rooms where roomtype = 'private'");
	while($rooms = mysql_fetch_array($lrooms)) {
	echo '<option value="',$rooms['id'],'">',$rooms['caption'],'</option>'; 
}	
	echo '</select><br />';

?>
    
    <img src="img/info_16.png" class="tooltip" title="Elije una misión para el Bot" /><label for="bot_motto">Misión del Bot:</label><input type="text" name="bot_motto" id="bot_motto" style="width:384px" value="[Kr]Bot" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el tipo del Bot" /><label for="ai_type">Tipo del Bot:</label><select name="ai_type" id="ai_type" style="width:384px"><option value="generic">Generico</option><option value="guide">Guia</option><option value="pet">Mascota</option></select><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el look del  Bot" /><label for="bot_look">Look del Bot:</label><input type="text" name="bot_look" id="bot_look" style="width:384px" value="hd-180-7.sh-290-110.lg-270-91.ch-809-62.hr-828-45" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije la forma de caminar del Bot" /><label for="walk_mode">Modo de caminar:</label><select name="walk_mode" id="walk_mode" style="width:384px"><option value="stand">Normalmente</option><option value="freeroam">Libremente</option><option value="specified range">Modo especificado</option></select><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el modo de rotación del Bot" /><label for="bot_rotation">Modo de rotación:</label><input type="text" name="bot_rotation" id="bot_rotation" style="width:384px" value="2" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el eje x del Bot" /><label for="bot_x">Eje X:</label><input type="text" name="bot_x" id="bot_x" style="width:384px" value="1" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el eje y del Bot" /><label for="bot_Y">Eje Y:</label><input type="text" name="bot_y" id="bot_y" style="width:384px" value="1" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el eje z del Bot" /><label for="bot_z">Eje Z:</label><input type="text" name="bot_z" id="bot_z" style="width:384px" value="0" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el lugar minimo del eje x" /><label for="bot_minx">Lugar minimo del eje x:</label><input type="text" name="bot_minx" id="bot_minx" style="width:384px" value="1" /><br />
    <img src="img/info_16.png" class="tooltip" title="Lugar maximo del eje x" /><label for="bot_maxx">Lugar maximo del eje x</label><input type="text" name="bot_maxx" id="bot_maxx" style="width:384px" value="16" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el lugar minimo del eje y" /><label for="bot_miny">Lugar minimo del eje y:</label><input type="text" name="bot_miny" id="bot_miny" style="width:384px" value="1" /><br />
    <img src="img/info_16.png" class="tooltip" title="Elije el lugar maximo del eje y" /><label for="bot_maxy">Lugar maximo del eje y:</label><input type="text" name="bot_maxy" id="bot_maxy" style="width:384px" value="10" /><br />
    <button onclick="SubmitForm()" class="Createbot">Crear bot</button>
    </div>