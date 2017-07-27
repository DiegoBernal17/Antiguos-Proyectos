<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_permissions', $username))
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
		$('button.UpdateUser').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/update_rank.php",
		   data: "name=" + $('#name').val() + "&badgeid=" + $('#badgeid').val() + "&id=" + $('#id').val(),
			success: function(){
		    $('button#General').html('Posted!');
			LoadPage('permissions');
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
</script>
<?php
$ranks = mysql_query("SELECT * FROM ranks WHERE id = '".$core->EscapeString($_GET['rank'])."' LIMIT 1");
$rank = mysql_fetch_array($ranks);
?>

	<h1>Editar Rango</h1>
    <input type="text" name="id" id="id" value="<?php echo $core->EscapeString($_GET['rank']); ?>" style="visibility:hidden;" />
	
    <div>
    <img src="img/info_16.png" class="tooltip" title="Modificar Nombre del Rango" /><label for="name">Rango:</label><input type="text" name="name" id="name" style="width:384px" value="<?php echo $rank['name']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Modificar Placa" /><label for="badgeid">Placa:</label><input type="text" name="badgeid" id="badgeid" style="width:384px" value="<?php echo $rank['badgeid']; ?>" /><br />
    </div>
	<button onclick="SubmitForm()" class="UpdateUser">Actualizar</button>