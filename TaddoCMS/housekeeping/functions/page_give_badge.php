<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_badge', $username))
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
		   url: "functions/badge.php",
		   data: "username=" + $('#username').val() + "&badge=" + $('#badge_id').val() + '&method=add',
			success: function(){
		    $('button#General').html('Posted!');
			LoadPage('badge','');
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
</script>

	<h1>Dar Placa</h1>
    <div>
	<img src="img/info_16.png" class="tooltip" title="Nombre De Usuario" /><label for="value">Nombre De Usuario:</label><input type="text" name="value" id="value" style="width:384px" value="<?php echo $_GET['username']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Placa" /><label for="badge_id">Placa:</label><input type="text" name="badge_id" id="badge_id" style="width:384px" />
<br />
	<button onclick="SubmitForm()" class="UpdateUser">Dar</button>