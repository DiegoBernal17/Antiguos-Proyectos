<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_bots', $username))
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

	$('.deleteresponse').click(function() { 
		response_delete($(this).attr('id'));
	});
	
	$('.deletespeech').click(function() { 
		speech_delete($(this).attr('id'));
	});
	
	$('.modifyresponse').click(function() { 
		response_edit($(this).attr('id'));
	});

	$('.modifyspeech').click(function() { 
		speech_edit($(this).attr('id'));
	});

	function bot_edit(bot) {
		$.ajax({
		   type: "POST",
		   url: "functions/page_modify_bot.php?id=" + bot,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}

	function bot_delete(bot) {
		$('button#Delete'+bot).html('Updating...');
		$('button#Delete'+bot).attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/config_bot.php",
		   data: "id=" + bot + "&method=remove",
		   success: function(){
		    $('button#Delete'+bot).html('Deleted!')
		     .delay(1200)
		     .queue(function(n) {
        	 	LoadPage('bots');
        	 })
		   }
		 });
	};

	function response_edit(rid) {
		$.ajax({
		   type: "POST",
		   url: "functions/page_modify_response.php?id=" + rid,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}

	function speech_edit(sid) {
		$.ajax({
		   type: "POST",
		   url: "functions/page_modify_speech.php?id=" + sid,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}
	
	function response_delete(rid) {
		$.ajax({
		   type: "POST",
		   url: "functions/config_bot.php",
		   data: "id=" + rid + "&method=remover",
		   success: function(msg){
		     $('.SelectRow#r' + rid).fadeOut('slow');
		   }
		 });
	}
	
	function speech_delete(sid) {		
		$.ajax({
		   type: "POST",
		   url: "functions/config_bot.php",
		   data: "id=" + sid + "&method=removes",
		   success: function(msg){
		     $('.SelectRow#s'+ sid).fadeOut('slow');
		   }
		 });
	}

	function bot_duplicate(bot) {
		$('button#DuplicateBot'+bot).html('Duplicating...');
		$('button#DuplicateBot'+bot).attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/config_bot.php",
		   data: "id=" + bot + "&method=dupli",
		   success: function(){
		    $('button#DuplicateBot'+bot).html('Duplicated!')
		     .delay(1200)
		     .queue(function(n) {
        	 	LoadPage('bots');
        	 })
		   }
		 });
	};

	function bot_add() {
		$.ajax({
		   type: "POST",
		   url: "functions/page_create_bot.php",
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}

	function bot_addresp() {
		$.ajax({
		   type: "POST",
		   url: "functions/page_create_response.php",
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}

	function bot_addspeech() {
		$.ajax({
		   type: "POST",
		   url: "functions/page_create_speech.php",
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}

	$('.exitbutton').click(function() { 
	    $('.page').css('display', 'none');
	    $('.overlay').css('display', 'none');
	});

</script>
<div>
	<h1>Configuración de Bots</h1>
	<div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>

	<div class="formPiece">
		<div>
			<h3>Bots</h3>
		</div>
	<div>
<?php
	$lbots = mysql_query("SELECT * FROM bots");
	while($bots = mysql_fetch_array($lbots))
		{
	$RID = $bots['room_id'];
	$RN = mysql_query("SELECT caption FROM rooms WHERE id = $RID");
	$roomname = mysql_fetch_assoc($RN);
?>

	<div class="RoomSearchResults" id="<?php echo $bots['id']; ?>">
	<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $bots['look']; ?>" alt="<?php echo $bots['name']; ?>" />
        <p>
	Nombre: <strong><?php echo $bots['name']; ?></strong><br />
	Tipo: <strong><?php echo $bots['ai_type']; ?></strong><br />
	Misión: <strong><?php echo $bots['motto']; ?></strong><br />
	Modo de caminar: <strong><?php echo $bots['walk_mode']; ?></strong><br />
	Bot para: <strong><?php echo $roomname['caption']; ?></strong>
	</p>	
	<button class="right" id="Edit<?php echo $bots['id']; ?>" onClick="bot_edit('<? echo $bots['id']?>');">Editar a <?php echo $bots['name']; ?></button>
	<button class="right" id="Delete<?php echo $bots['id']; ?>" onClick="bot_delete('<? echo $bots['id']?>');">Eliminar Bot</button>
	</div>
<?php
}
?>
	</div>
</div>

<div class="formPiece">
		<div>
			<h3>Herramientas de los bots</h3>
		</div>
		<div>
		<button class="left" id="CreateBot" onClick="bot_add();">Crear un bot</button>
		<button class="left" id="CreateResponse" onClick="bot_addresp()">Crear respuesta</button>
		<button class="left" id="CreateSpeech" onClick="bot_addspeech()">Crear palabras</button>
	</div>
</div>
	<div class="formPiece">
		<div>
			<h3>Respuestas de los bots</h3>
		</div>
		<div>
<?php
	$BR = mysql_query("SELECT * FROM bots_responses ORDER BY keywords ASC");
	while($response = mysql_fetch_array($BR))
	{
	$BNID = $response['bot_id'];
	$BN = mysql_query("SELECT name FROM bots WHERE id = $BNID");
	$botname = mysql_fetch_assoc($BN);
	$keywords = explode(";",$response['keywords']);
?>	
		<div class="SelectRow" id="r<?php echo $response['id']; ?>">
			<img src="img/gear_32.png" class="tooltip clickme modifyresponse" title="Modificar respuesta - Haga clic aquí para modificar la respuesta seleccionada" id="<?php echo $response['id']; ?>"/>
			<img src="img/trash_32.png" class="tooltip clickme deleteresponse" title="Eliminar respuesta - Haga clic aquí para eliminar la respuesta seleccionada" id="<?php echo $response['id']; ?>" />
			<h4><?php echo $botname['name']; ?></h4>
			<div><?php echo $keywords[0]; ?></div>
		</div>
<?php
	}
?>
	</div>
</div>
	<div class="formPiece">
		<div>
			<h3>Bots Speech</h3>
		</div>
		
		<div>
<?php
	$BS = mysql_query("SELECT * FROM bots_speech ORDER BY text ASC");
	while($speech = mysql_fetch_array($BS))
	{
	$BNID = $speech['bot_id'];
	$BN = mysql_query("SELECT name FROM bots WHERE id = $BNID");
	$botname = mysql_fetch_assoc($BN);
?>	
		<div class="SelectRow" id="s<?php echo $speech['id']; ?>">
			<img src="img/gear_32.png" class="tooltip clickme modifyspeech" title="Modify Speech - Click here to modify the selected bot speech" id="<?php echo $speech['id']; ?>"/>
			<img src="img/trash_32.png" class="tooltip clickme deletespeech" title="Delete Speech - Click here to remove the selected bot speech" id="<?php echo $speech['id']; ?>" />
			<h4><?php echo $botname['name']; ?></h4>
			<div><?php echo substr(strip_tags($speech['text']),0,40).'...'; ?></div>
		</div>
	
<?php
	}
?>			
		</div>
	</div>
</div>