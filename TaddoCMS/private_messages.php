<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'Private Messages');
if(!isset($_GET['page']))$page="inbox"; else $page=$_GET['page'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<head>
<title><?php echo $sitename." - Private Messages"; ?></title>
<link rel="stylesheet" href="Public/Styles/Default/CSS/jquery-ui.css" type="text/css" media="all" />
<script src="Public/JS/jquery.min.js" type="text/javascript"></script>
<script src="Public/JS/jquery-ui.min.js" type="text/javascript"></script>
<script src="Public/JS/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
<script type="text/javascript" src="Public/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	function LoadPm(Id) {
		$.ajax({
		   type: "POST",
		   url: "functions/pm_get_message.php?id=" + Id + "&folder=<?php echo $page; ?>",
		   data: "",
		   success: function(msg){
			 $('#draggable').html(msg);
			  $("#draggable").show();
		   }
		 });
	}
	
	function LoadFriends(Id) {
		$.ajax({
		   type: "POST",
		   url: "functions/pm_friends.php?id=" + Id + "&folder=<?php echo $page; ?>",
		   data: "",
		   success: function(msg){
			 $('#friendlist').html(msg);
			  $("#friendlist").show();
		   }
		 });
	}
	
	function HideFriends(){
		$("#friendlist").hide();
		
		}
	
	function ComposePm() {
		$.ajax({
		   type: "POST",
		   url: "functions/pm_compose.php",
		   data: "",
		   success: function(msg){
			 $('#draggable').html(msg);
			  $('#draggable').show();
		   }
		 });
	}
	
	function SubmitReport() {
		$.ajax({
		   type: "POST",
		   url: "functions/pm_submit_report.php",
		   data: "id=" + escape($('#id').val()) + "&reason=" + escape($('#message').val()) + "&uid=<?php echo $users->UserID($_SESSION['username']);?>",
		   success: function(){
		   $('#SendReport').html('Reported!');
		   window.location = "private_messages.php"		
		   }
		 });
	}
	
	function Solved(Id) {
		$.ajax({
		   type: "POST",
		   url: "functions/pm_report_solved.php",
		   data: "id=" + Id + "&uid=<?php echo $users->UserID($_SESSION['username']);?>",
		   success: function(){
		   window.location = "private_messages.php?page=reported"		
		   }
		 });
	}
	
	
	$(document).ready(function(){
	$('#draggable').css({top:'25%',left:'50%',margin:'-'+($('#draggable').height() / 2)+'px 0 0 -'+($('#draggable').width() / 2)+'px'});
	$('#friendlist').css({top:'25%',left:'70%',margin:'-'+($('#friendlist').height() / 2)+'px 0 0 -'+($('#draggable').width() / 3)+'px'});
	});

	$(function() {
		
		$( "#draggable" ).draggable({
			handle: '#topBar'});
		
		$( "#friendlist" ).draggable({
			handle: '#dragMe'});

	});
	
	function CheckBeforeSend(){
		var error=0;
		CheckName();
		userName = $('#to').val().replace(/\s+$/, '');
		
		if($('#to').val() === "") {
			$("#namelookup").html("Name can not be blank!");
			$("#namelookup").removeClass().addClass("errormsg");
			$("#namelookup").show("fast");
			error=error+1;
		}
		else $("#namelookup").hide("fast");
		
		if($('#subject').val() === "") {
			$("#subjectcheck").html("Subject can not be blank!");
			$("#subjectcheck").removeClass().addClass("errormsg");
			$("#subjectcheck").show("fast");
			error=error+1;
		}
		else $("#subjectcheck").hide("fast");
		
		if($('#message').val() === "") {
			$("#messagecheck").html("Message can not be blank!");
			$("#messagecheck").removeClass().addClass("errormsg");
			$("#messagecheck").show("fast");
			error=error+1;
		}
		
		if (userName === '') {
    	$("#namelookup").html("Name can not be blank!");
			$("#namelookup").removeClass().addClass("errormsg");
			$("#namelookup").show("fast");
			error=error+1;
		} 
		
		else $("#messagecheck").hide("fast");
		if(error===0) SubmitForm();
		
     }

		
	function CheckName(){
	name = $("#to").val();
	if(name>""){
	$.get("functions/pm_checkname.php", {ajaxAct: "check_habbo_name", habbo_name: name}, function(data) {
		if( $.trim(data) == "1" ) {
			$("#namelookup").html("Nombre encontrado...");
			$("#namelookup").removeClass().addClass("goodmsg");
			$("#namelookup").show("fast");
			$("#SendPM").show("fast");
			
			
			}
		else {
				$("#namelookup").html("Nombre no encontrado esta incorrecto...");
				$("#namelookup").removeClass().addClass("errormsg");
				$("#namelookup").show("fast");
				$("#SendPM").hide("fast");
				var error=1;
				return error;
				}
		});}
	}
	
	function SubmitForm() {
		var save=0;
		if ($('#save').attr('checked')) save=1;
		$.ajax({
		   type: "POST",
		   url: "functions/pm_new_message.php",
		   data: "to=" + escape($('#to').val()) + "&subject=" + escape($('#subject').val()) + "&message=" + escape($('#message').val()) + "&uid=<?php echo $users->UserID($username);?>&save="+ save,
			success: function(){
		    $('#SendPM').html('¡Cargando!');
			window.location = "private_messages.php"
			
			
		   }
		 });
	}
	
	function SetAsRead(id) {
		$("#"+ id).attr('class', 'read');
		} 
	
	function EmptyTrash() {
		
		$.ajax({
		   type: "POST",
		   url: "functions/pm_delete_message.php",
		   data: "cmd=et&folder=<?php echo $page; ?>",
			success: function(){
		    window.location = "private_messages.php?page=trash";
			}
		 });
	}
	
	function AddTo(id) {
		var to = $("#to").val();
		var sepparator = "";
		if(to>"") sepparator = "; ";
		$("#to").val(to + sepparator + $("#" + id).html());
		$("#" + id).hide();
		}
		
</script>
<link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main.css" />
<link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main2.css" />
<link type="text/css" rel="stylesheet" href="Public/Styles/Pms/pms.css" />
</head> 

<div id="draggable" style="display:none;" class="ui-widget-content"></div>
<div id="friendlist" style="display:none; font-size:14px; font-weight:bold;" class="ui-widget-content"></div>
<body id="news_body"> 

	<?php include("site/header.php"); ?>
	<div class="mid">
	<?php include("site/nav.php"); ?>
	<div id="column1">
			    <section class="menu"><section class="menu2">
			<center><b>Menu</b></center></section>
                	<a onclick="ComposePm();" href="#" <?php if($page == 'compose') echo 'class="selected"'; ?>>
                    
                    <div class="navigation" style="background-image:url(Public/pm_images/newpm.png); background-repeat:no-repeat; padding-left:35px;" align="center">Nuevo mensaje</div></a>
                    <br  />

			    	<a href="?page=inbox" <?php if($page == 'inbox') echo 'class="selected"'; ?>>
                    <div class="navigation" style="background-image:url(Public/pm_images/inbox.png); background-repeat:no-repeat; padding-left:35px;" align="center">Bandeja de entrada</div></a>
                    <br />
					<a href="?page=outbox"<?php if($page == 'outbox') echo 'class="selected"'; ?>>
                    <div class="navigation" style="background-image:url(Public/pm_images/outbox.png); background-repeat:no-repeat; padding-left:35px;" align="center">Bandeja de salida</div></a>
       		        <br />
					<a href="?page=trash"<?php if($page == 'trash') echo 'class="selected"'; ?>>
                    <div class="navigation" style="background-image:url(Public/pm_images/trash.png); background-repeat:no-repeat; padding-left:35px;" align="center">Basura</div></a>
                    <br />
                    <?php if($page == 'trash'){ ?>
                    <div onclick="EmptyTrash(); " class="navigation" style="background-image:url(Public/pm_images/trash.png); background-repeat:no-repeat; padding-left:35px;" align="center"><b>Vaciar papelera</b></div>
                    <?php }?>
                    <br />
					<?php 
					if($users->UserPermission('pm_reports', $username)){ ?>
                    <a href="?page=reported"<?php if($page == 'reported') echo 'class="selected"'; ?>>
					<div onclick="ViewReported(); " class="navigation" style="background-image:url(Public/pm_images/alert.png); background-repeat:no-repeat; padding-left:35px;" align="center"><b>Reportar mensaje</b></div></a>
					<?php }?>
        		</div></section>
		
           <div id="column2">
		    <section class="menu"><section class="menu2">
			<center><b>Mensajes</b></center></section>
					<?php if($page=='inbox'){
						$inboxq = mysql_query("SELECT * FROM cms_pm WHERE  folder = 'inbox' AND toid = '".$users->UserId($username)."' ORDER BY id DESC");
						$num_messages = mysql_num_rows($inboxq);
						
						$unreadq = mysql_query("SELECT * FROM cms_pm WHERE  folder = 'inbox' AND toid = '".$users->UserId($username)."' AND `read` = '0'");
						$num_unread = mysql_num_rows($unreadq);
					
						echo "<div class='alert'>Hay <b>".$num_messages."</b> mensajes en su bandeja de entrada<br>";
						echo "Hay <b>".$num_unread."</b> mensajes no leídos en la Bandeja de entrada</div>";
					
						if($num_messages>=1){
							while($inbox = mysql_fetch_array($inboxq)) {
							echo '<div>';
							
							echo '<div id="'.$inbox['id'].'" ';
							if($inbox['read']==0) echo "class = 'unread' "; else echo "class='read' ";
							echo 'style="padding:2px; cursor:pointer;" onclick="SetAsRead('.$inbox['id'].'); LoadPm(\''.$inbox['id'].'\');">
							<div class="hubba_head" style="background-image:url(http://www.habbo.com/habbo-imaging/avatarimage?size=s&action=wav&figure='.$users->UserInfo($users->UserName($inbox['fromid']), 'look').'); width:30px;"></div>
							<b>From:</b> '.$users->UserName($inbox['fromid']).'<br><b>Subject: </b>'.$pms->WordFilter($inbox['subject']).'<br><b>Sent on: </b>'.date('l dS \o\f F Y h:i:s A', $inbox['timestamp_sent']).'</div>';
							echo '</div>';
							
							}
						}
					}
					?>
                    
                    <?php if($page=='outbox'){
                    $outboxq = mysql_query("SELECT * FROM cms_pm WHERE fromid = '".$users->UserId($username)."' AND folder='outbox' ORDER BY id DESC");
						$num_messages_out = mysql_num_rows($outboxq);
						echo "<div class='alert'>Hay <b>".$num_messages_out."</b> mensajes en la bandeja de salida<br></div>";
						

						if($num_messages_out>=1){
							while($outbox = mysql_fetch_array($outboxq)) {
							echo '<div>';
							echo '<div class="read" id="'.$outbox['id'].'" ';
							echo 'style="padding:2px; cursor:pointer;" onclick="; LoadPm(\''.$outbox['id'].'\');">
							<div class="hubba_head" style="background-image:url(http://www.habbo.com/habbo-imaging/avatarimage?size=s&action=non&figure='.$users->UserInfo($users->UserName($outbox['toid']), 'look').'); width:30px;"></div>
							<b>To:</b> '.$users->UserName($outbox['toid']).'<br><b>Subject: </b>'.$pms->WordFilter($outbox['subject']).'<br><b>Sent on: </b>'.date('l dS \o\f F Y h:i:s A', $outbox['timestamp_sent']).'</div>';
							echo '</div>';
							
							}
						}
					
                     } ?>
                    <?php if($page=='trash'){$trashq = mysql_query("SELECT * FROM cms_pm WHERE toid = '".$users->UserId($username)."' AND folder='trash' ORDER BY id DESC");
						$num_messages_trash = mysql_num_rows($trashq);
						echo "<div class='alert'>Hay <b>".$num_messages_trash."</b> mensajes en la basura<br></div>";

						if($num_messages_trash>=1){
							while($trash = mysql_fetch_array($trashq)) {
							echo '<div>';
							echo '<div class="read" id="'.$trash['id'].'" ';
							echo 'style="padding:2px; cursor:pointer;" onclick="; LoadPm(\''.$trash['id'].'\');">
							<div class="hubba_head" style="background-image:url(http://www.habbo.com/habbo-imaging/avatarimage?size=s&action=non&figure='.$users->UserInfo($users->UserName($trash['fromid']), 'look').'); width:30px;"></div>
							<b>From:</b> '.$users->UserName($trash['fromid']).'<br><b>Subject: </b>'.$pms->WordFilter($trash['subject']).'<br><b>Sent on: </b>'.date('l dS \o\f F Y h:i:s A', $trash['timestamp_sent']).'</div>';
							echo '</div>';
							
							
							}
							
						} } ?>
                        
					<?php 
					if($users->UserPermission('pm_reports', $username)){
					if($page=='reported'){
						
						$reportq = mysql_query("SELECT * FROM cms_pm_report WHERE solved='0' ORDER BY id DESC");
						$num_messages_report = mysql_num_rows($reportq);
						echo "<div class='alert'>There are <b>".$num_messages_report."</b> unhandled messages in the report box<br></div>";

						if($num_messages_report>=1){
							while($report = mysql_fetch_array($reportq)) {
							$reportedq = mysql_query("SELECT * FROM cms_pm WHERE id='".$report['reported_pm']."' LIMIT 1");
							$reported = mysql_fetch_array($reportedq);
							echo '<div>';
							echo '<div class="read" id="'.$reported['id'].'" ';
							echo 'style="padding:2px; cursor:pointer;" onclick="; LoadPm(\''.$reported['id'].'\');">
							<div class="hubba_head" style="background-image:url(http://www.habbo.com/habbo-imaging/avatarimage?size=s&action=non&figure='.$users->UserInfo($users->UserName($reported['fromid']), 'look').'); width:30px;"></div>
							<b>From:</b> '.$users->UserName($reported['fromid']).'<br><b>Subject: </b>'.$reported['subject'].'<br><b>Sent on: </b>'.date('l dS \o\f F Y h:i:s A', $reported['timestamp_sent']).'</div>';
							echo '</div>';
							
							
							}
							
						}  }} ?>
                 
</section>
        
    	<?php include("site/sideads.php"); ?>
	</div>

	<?php include("site/footer.php"); ?>
</div> 

</body> 
</html>