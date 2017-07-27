<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_voucher', $username))
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
	
	
	function Add() {
	$('button#Add').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/add_voucher.php",
		   data: "code=" + $('#code').val() + "&value=" + $('#credits').val(),
		   success: function(){
			LoadPage('voucher', '');
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
</script>
<div>
	<h1>Credit Voucher</h1>
    <div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
    
	<div class="formPiece">
		<div>
			<h3>Credit Voucher</h3>
		</div>
		<div>
        <?php
		$code = substr(md5(time()+rand(100000, 999999)),0,7).substr(md5(rand(100000, 999999)),0,3);
		?>
			<img src="img/info_16.png" class="tooltip" title="Codigo" />
			<label for="code">Codigo: </label><input type="text"  name="code" id="code" value="<?php echo $code; ?>" /><br />
            
            <img src="img/info_16.png" class="tooltip" title="Creditos" />
            <label for="credits">Creditos: </label><input type="text"  name="credits" id="credits" /><br />
			<button id="Add" onClick="Add();">Agregar voucher</button><br />
		</div>
	</div>
    
	<div class="formPiece">
		<div>
			<h3>Voucher Activos</h3>
		</div>
		<div>
        <?php
		$voucherq = mysql_query("SELECT * FROM credit_vouchers");
		while($voucher = mysql_fetch_array($voucherq))
		{
		?>
        <div class="UserSearchResults">
        <p>Codigo: <strong><?php echo $voucher['code']; ?></strong><br />
        Valor: <strong><?php echo $voucher['value']; ?></strong></p>
        </div>
        <?php
		}
		?>
        </div>
    </div>
</div>