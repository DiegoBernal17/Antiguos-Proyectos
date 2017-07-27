<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_plugins', $username))
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
	
	function LoadContent(PageName, ID) {
		$.ajax({
		   type: "POST",
		   url: "functions/" + PageName + ".php?id=" + ID,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	}

	function DisplayLoad(ButtonID) {
		$('button#' + ButtonID).attr('disabled', 'disabled');
	}
	
	$('.exitbutton').click(function() { 
	    $('.page').css('display', 'none');
	    $('.overlay').css('display', 'none');
		LoadPage('plugins');
	});
	
	
	function Add() {
		$.ajax({
		   type: "POST",
		   url: "functions/add_plugin.php",
		   data: "file=" + $('#file').val(),
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}
	
	function Remove(id) {
	$('button#Remove'+id).attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/remove_plugin.php?id="+id,
		   success: function(){
		    $('button#Remove'+id).html('Uninstalled!')
		     .delay(1200)
		     .queue(function(n) {
        	 	$('button#Remove'+id).html('Uninstall');
        	 	$('button#Remove'+id).removeAttr("disabled");
				LoadPage('plugins');
        	 	n();
        	 })
		   }
		 });
	}
</script>
<div>
	<h1>Plugins</h1>
    <div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
    
	<div class="formPiece">
		<div>
			<h3>Agregar Plugin</h3>
		</div>
		<div>
        	<img src="img/info_16.png" class="tooltip" title="Plugin" />
			<label for="file">Xml Archivo URL:</label>
			<input type="text" name="file" id="file" />
			<br />
            <button id="Add" onClick="Add();">Agregar plugin</button><br />
		</div>
	</div>
    
	<div class="formPiece">
		<div>
			<h3>Activar Plugins</h3>
		</div>
		<div>
        <?php
		$pluginq = mysql_query("SELECT * FROM plugin");
		while($plugin = mysql_fetch_array($pluginq))
		{
		?>
        <div class="UserSearchResults">
        <p>Plugin Nombre: <strong><?php echo $plugin['name']; ?></strong><br />
        <br />
        <button id="Remove<?php echo $plugin['id']; ?>" onClick="Remove('<?php echo $plugin['id']; ?>');">Desinstalar</button><br /></p>
        </div>
        <?php
		}
		?>
        </div>
    </div>
</div>