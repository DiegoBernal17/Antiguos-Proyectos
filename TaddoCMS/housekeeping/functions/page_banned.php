<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_ban', $username))
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

	function RemoveBan(id) {
		$.ajax({
		   type: "POST",
		   url: "functions/remove_ban.php",
		   data: "id=" + id,
			success: function(){
			LoadPage('mod', '');
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}

</script>
<h1>Usuario Baneados</h1>
<table width="100%" border="0" cellspacing="0">
<thead style="margin-bottom:10px;">
<tr>
	<td width="10%">Ban ID</td>
    <td width="10%">Tipo</td>
	<td width="15%">Datos</td>
	<td width="30%">Rason</td>
	<td width="10%">Termina</td>
	<td width="15%">Agregado Por</td>
	<td width="10%">Opcion</td>
</tr>
</thead>
<?php
$banq = mysql_query("SELECT * FROM bans");
while($ban = mysql_fetch_array($banq))
{
?>
<tr>
	<td><?php echo $ban['id']; ?></td>
    <td><?php echo strtoupper($ban['bantype']); ?></td>
	<td><?php echo $ban['value']; ?></td>
	<td><?php echo $ban['reason']; ?></td>
	<td><?php if($ban['expire'] < time()) echo 'Expired'; else echo @date("d-m-Y H:i", $ban['expire']); ?></td>
	<td><?php echo $ban['added_by']; ?></td>
	<td><button class="left" onClick="RemoveBan('<?php echo $ban['id']; ?>');" href="#">Quitar</button></td>
</tr>
<?php
}
?>