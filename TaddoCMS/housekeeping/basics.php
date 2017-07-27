<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_basics', $username))
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

	function DisplayLoad(ButtonID) {
		$('button#' + ButtonID).attr('disabled', 'disabled');
	}

	function SubmitGeneral() {
		$('button#General').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/basics_update_general.php",
		   data: "cms_url=" + $('#cms_url').val() + "&cms_name=" + $('#cms_name').val() + "&maintenance=" + $('#maintenance').val(),
		   success: function(){
		    $('button#General').html('Updated!')
		     .delay(1200)
		     .queue(function(n) {
        	 	$('button#General').html('Update');
        	 	$('button#General').removeAttr("disabled");
        	 	n();
        	 })
		   }
		 });
	}

	function SubmitClient() {
		$('button#Client').html('Updating...');
		$('button#Client').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/basics_update_client.php",
		   data: "client_ip=" + $('#client_ip').val() + "&client_port=" + $('#client_port').val() + "&client_mus=" + $('#client_mus').val() + "&client_texts=" + $('#client_texts').val() + "&client_variables=" + $('#client_variables').val() + "&client_swf_path=" + $('#swf_path').val() + "&client_habbo_swf=" + $('#habbo_swf').val(),
		   success: function(){
		    $('button#Client').html('Updated!')
		     .delay(1200)
		     .queue(function(n) {
        	 	$('button#Client').html('Update');
        	 	$('button#Client').removeAttr("disabled");
        	 	n();
        	 })
		   }
		 });
	}

	function SubmitHotel() {
		$('button#Hotel').html('Updating...');
		$('button#Hotel').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/basics_update_hotel.php",
		   data: "timer=" + $('#timer').val() + "&pixels=" + $('#pixels').val() + "&credits=" + $('#credits').val() + "&motd=" + $('#motd').val(),
		   success: function(){
		    $('button#Hotel').html('Updated!')
		     .delay(1200)
		     .queue(function(n) {
        	 	$('button#Hotel').html('Update');
        	 	$('button#Hotel').removeAttr("disabled");
        	 	n();
        	 })
		   }
		 });
	}
</script>
<div>
	<h1>Basics</h1>
	<div class="formPiece">
		<div>
			<h3>General</h3>
		</div>
		<div>
			<img src="img/info_16.png" class="tooltip" title="Nombre del Hotel - " />
			<label for="cms_name">Nombre del Hotel: </label><input type="text" value="<?php echo $core->CmsSetting('cms_name'); ?>" name="cms_name" id="cms_name" /><br />
			
			<img src="img/info_16.png" class="tooltip" title="URL del sitio web - La url de su directorio raiz de sitios web" />
			<label for="cms_url">CMS URL: </label><input type="text" value="<?php echo $core->CmsSetting('cms_url'); ?>" name="cms_url" id="cms_url" /><br />
            
            <img src="img/info_16.png" class="tooltip" title="Mantenimiento" />
			<label for="cms_url">En Mantenimiento: </label><select name="maintenance" id="maintenance"><option value="true" <?php if($core->CmsSetting('maintenance') == 'true') echo 'selected'; ?>>Si</option><option value="false" <?php if($core->CmsSetting('maintenance') == 'false') echo 'selected'; ?>>No</option></select><br />
	
			<button id="General" onClick="SubmitGeneral();">Actualizar</button>
		</div>
	</div>
	<div class="formPiece">
		<div>
			<h3>Client</h3>
		</div>
		
		<div>
			<div class="infobox infobox_info">Puede que el hotel tenga que reiniciar poder ver los cambios</div><br /><br />

			<img src="img/info_16.png" class="tooltip" title="Direccion IP - La direccion IP de su emulador de hotel" />
			<label for="client_ip">Direccion IP: </label><input type="text" value="<?php echo $core->CmsSetting('client_ip'); ?>" name="client_ip" id="client_ip" /><br />

			<img src="img/info_16.png" class="tooltip" title="Puerto - El puerto que el emulador usa" />
			<label for="client_port">Puerto: </label><input type="text" value="<?php echo $core->CmsSetting('client_port'); ?>" name="client_port" id="client_port" /><br />

			<img src="img/info_16.png" class="tooltip" title="MUS Puerto - El puerto MUS de tu emulador" />
			<label for="client_mus">MUS Puerto: </label><input type="text" value="<?php echo $core->CmsSetting('client_mus'); ?>" name="client_mus" id="client_mus" /><br />

					<button id="Client" onClick="SubmitClient();">Actualizar</button>
		</div>
	</div>
	<div class="formPiece">
		<div>
			<h3>Hotel</h3>
		</div>
		
		<div>
			<div class="infobox infobox_info">Puede que el hotel tenga que reiniciar poder ver los cambios</div><br /><br />

			<img src="img/info_16.png" class="tooltip" title="Mensaje del dia - El mensaje que se muestra a los usuarios cuando el registro en el hotel" />
			<label for="motd">Mensaje Del Hotel: </label><input type="text" value="<?php echo $core->ServerSetting('motd'); ?>" name="motd" id="motd" /><br />

			<img src="img/info_16.png" class="tooltip" title="Timepo - El tiempo, en minutos, entre cada tick servidor" />
			<label for="timer">Tiempo: </label><input type="text" value="<?php echo $core->ServerSetting('timer'); ?>" name="timer" id="timer" /><br />

			<img src="img/info_16.png" class="tooltip" title="Creditos - Este es el numero de creditos se dan cada vez que el servidor de pasos de tiempo" />
			<label for="credits">Credits: </label><input type="text" value="<?php echo $core->ServerSetting('credits'); ?>" name="credits" id="credits" /><br />

			<img src="img/info_16.png" class="tooltip" title="Pixeles - Este es el numero de pixeles se dan cada vez que el servidor de pasos de tiempo" />
			<label for="pixels">Pixels: </label><input type="text" value="<?php echo $core->ServerSetting('pixels'); ?>" name="pixels" id="pixels" /><br />

			<button id="Hotel" onClick="SubmitHotel();">Actualizar</button>
		</div>
	</div>
</div>