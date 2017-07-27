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

	function SubmitForm() {
		$('button.UpdateUser').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/ban.php",
		   data: "value=" + $('#ip').val() + "&reason=" + $('#reason').val() + "&length=" + $('#length').val() + "&type=ip",
			success: function(){
		    $('button#General').html('Posted!');
			LoadPage('mod','');
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
</script>

	<h1>Ban IP</h1>
    <div>
	<img src="img/info_16.png" class="tooltip" title="IP" /><label for="value">IP:</label><input type="text" name="value" id="value" style="width:384px" value="<?php echo $_GET['ip']; ?>" /><br />
    <img src="img/info_16.png" class="tooltip" title="Rason" /><label for="reason">Rason:</label><input type="text" name="reason" id="reason" style="width:384px" />
<br />
	<img src="img/info_16.png" class="tooltip" title="Tiempo" /><label for="length">Tiempo:</label><select type="text" name="length" id="length" style="width:384px"><option value="1800">30 Minutes</option><option value="3600">1 Hour</option><option value="10800">3 Hours</option><option value="43200">12 Hours</option><option value="86400">1 Day</option><option value="259200">3 Day</option><option value="604800">1 Week</option><option value="1209600">2 Week</option><option value="2592000">1 Month</option><option value="7776000">3 Months</option><option value="31104000">1 Year</option><option value="62208000">2 Years</option><option value="360000000">Permanent</option></select><br />
    </div>
	<button onclick="SubmitForm()" class="UpdateUser">Ban</button>