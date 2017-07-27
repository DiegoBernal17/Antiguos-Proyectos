<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");

$username = $core->EscapeString($_SESSION['username']);
if(is_numeric($_GET['id'])){
$folder=$core->EscapeString($_GET['folder']);
$pmq = mysql_query("SELECT * FROM cms_pm WHERE id = '".$_GET['id']."' LIMIT 1");
$pm = mysql_fetch_array($pmq);
$from=$users->UserName($pm['fromid']);
if($pm['toid']==$users->UserID($username)||$pm['fromid']==$users->UserID($username)||($users->UserPermission('pm_reports', $username))){
	if($pm['read']=="0") {  
		if($folder=="inbox")mysql_query("UPDATE cms_pm SET `read`='1', timestamp_received='".time()."' WHERE id=".$_GET['id']."");
	}
?>
<script type="text/javascript">
function DeletePm(Id) {
			
		$('button.SendPM').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/pm_delete_message.php",
		   data: "id=" + Id + "&uid=<?php $users->UserID($_SESSION['username']);?>&folder=<?php echo $folder; ?>",
			success: function(){
		    $('button.SendPM').html('Posted!');
			<?php switch ($folder){
				case "inbox":
				echo 'window.location = "private_messages.php?page=inbox";';
				break;
				case "outbox":
				echo 'window.location = "private_messages.php?page=outbox";';
				break;
				case "trash":
				echo 'window.location = "private_messages.php?page=trash";';
				break;
				}?>
			}
		 });
	}
	
function ReplyPm(Id) {
			
		$.ajax({
		   type: "POST",
		   url: "functions/pm_compose.php?id=" + Id,
		   success: function(msg){
			 $('#draggable').html(msg);
			  $('#draggable').show();
			  
		   }
		 });
	}
function MovePm(Id) {
		
		$.ajax({
		   type: "POST",
		   url: "functions/pm_delete_message.php",
		   data: "cmd=move&id=" + Id,
			success: function(){
		    window.location = "private_messages.php?page=inbox";
			}
		 });
	}
	
function ReportPm(Id) {
		$.ajax({
		   type: "POST",
		   url: "functions/pm_report.php?id=" + Id,
		   success: function(msg){
			 $('#draggable').html(msg);
			  $('#draggable').show();
		   }
		 });
	}
</script>
<div id="topBar" style="padding:5px; font-size:14px; cursor:pointer;">
De : <?php echo $users->UserName($pm['fromid']);?>
<div onClick="window.location = 'private_messages.php?page=<?php echo $folder; ?>'" style="width:25px; float:right;cursor:pointer;"><b>X</b></div>
</div>


<div style=" background-color:#EFEFEF; float:left; padding:5px;" align="center">
	<div style="float:left; padding:10px; width:70px; ">
		
		<img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $users->UserInfo($from, 'look'); ?>" alt="<?php echo $users->UserInfo($from, 'username'); ?>" />
        <?php if($folder=='inbox'){?><div class="buttons" onclick="ReplyPm(<?php echo $pm['id'];?>)">Responder</div><?php } ?>
        <?php if($folder=='trash'){?><div class="buttons" onclick="MovePm(<?php echo $pm['id'];?>)">Mover a la bandeja de entrada</div><?php } ?>
        <?php if(($folder=='outbox')||($folder=='trash')||($folder=='inbox')){ ?><div class="buttons" onclick="DeletePm(<?php echo $pm['id'];?>);">Eliminar</div><?php } ?><br />
        <?php if($folder=='inbox'){?><div class="buttons report_button" onclick="ReportPm(<?php echo $pm['id'];?>)">Reportar</div><?php } ?>
        <?php if($folder=='reported'){?><div class="buttons report_button" onclick="Solved(<?php echo $pm['id'];?>)">Establecer como Resuelto</div><?php } ?>
        
	</div>
	<div style="margin:2px; padding-left:4px; width:380px; float:right" align="left">
		<?php if($folder=='reported'){
			
			$reportq = mysql_query("SELECT * FROM cms_pm_report WHERE reported_pm = '".$pm['id']."' LIMIT 1");
			$report = mysql_fetch_array($reportq);
			?>
		
        <div style="border:1px; border-color:#CCC; border-style:solid; padding:10px; font-weight:bold; margin-bottom:3px;">Reported by: <?php echo $users->UserName($report['reported_by']);?></div>
		<div style="border:1px; border-color:#CCC; border-style:solid; padding:10px; font-weight:bold; margin-bottom:3px;">Reason : <?php echo $report['reason'];?></div>
		<div><br />Original Message:</div>
		<?php }?>
        <div style="border:1px; border-color:#CCC; border-style:solid; padding:10px; font-weight:bold; margin-bottom:3px;">Para : <?php echo $users->UserName($pm['toid']);?></div>
        <div style="border:1px; border-color:#CCC; border-style:solid; padding:10px; font-weight:bold; margin-bottom:3px;">Asunto : <?php echo $pms->WordFilter($pm['subject']);?></div>
		<div style="border:1px; border-color:#CCC; border-style:solid; padding:10px;">Mensaje o contenido:<?php 
		if($users->UserPermission('pm_reports', $username)&&($folder=='reported'))echo $pm['message'];
		else echo $pms->WordFilter($pm['message']);
		?></div>
	</div>
    
    <div style="width:100%;float:left;" align="right">Date Sent: <?php echo date('l dS \o\f F Y h:i:s A', $pm['timestamp_sent']);?></div>
</div>
<?php }} ?>