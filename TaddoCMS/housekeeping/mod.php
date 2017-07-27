<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_mod', $username))
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
	});
	

	function Ban() {
		if($('#username').val() != '')
		{
		$.ajax({
		   type: "POST",
		   url: "functions/page_ban_user.php?username=" + $('#username').val(),
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
		}
	}
	
	function BanIP() {
		if($('#ip').val() != '')
		{
		$.ajax({
		   type: "POST",
		   url: "functions/page_ban_ip.php?ip=" + $('#ip').val(),
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
		}
	}
	
	function ShowBan() {
		$.ajax({
		   type: "POST",
		   url: "functions/page_banned.php",
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}
	
	function IPLookup() {
		$.ajax({
		   type: "POST",
		   url: "functions/ip_lookup.php",
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}
	
	function HA() {
	$('button#HA').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/ha.php",
		   data: "ha=" + $('#ha').val(),
		   success: function(){
		    $('button#HA').html('Sent!')
		     .delay(1200)
		     .queue(function(n) {
        	 	$('button#HA').html('Send');
        	 	$('button#HA').removeAttr("disabled");
        	 	n();
        	 })
		   }
		 });
	}
</script>
<div>
	<h1>MOD Utilidades</h1>
    <div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
    
	<div class="formPiece">
		<div>
			<h3>Ban</h3>
		</div>
		<div>
			<img src="img/info_16.png" class="tooltip" title="Nombre De Usuario" />
			<label for="username">Nombre De Usuario: </label><input type="text"  name="username" id="username" /><br />
			<button id="Ban" onClick="Ban();">Ban Usuario</button><br /><br />
            <img src="img/info_16.png" class="tooltip" title="IP" />
			<label for="ip">IP: </label><input type="text"  name="ip" id="ip" /><br />
			<button id="Ban" onClick="BanIP();">Ban IP</button><br /><br />
            <button class="right" id="Banned" onClick="ShowBan();">Usuarios Baneados</button>
<?php
if($users->UserPermission('hk_iplookup', $username))
	{
		?>
            <button class="left" id="IP Lookup" onClick="IPLookup();">Busqueda De Multiples IP</button>
<?php
	}
	?>
		</div>
	</div>
    <?php
	if($users->UserPermission('hk_ha', $username))
	{
		?>
	<div class="formPiece">
		<div>
			<h3>Alertar Hotel</h3>
		</div>
        <div>
		<label for="ha" style="width:400px;">Texto De La Alerta:</label><br /><br /><textarea id="ha" name="ha" cols="56" rows="10"></textarea><br />
			<button id="HA" onClick="HA();">Enviar</button>
		</div>
	</div>
    <?php
	}
	?>
</div>