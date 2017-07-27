<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_permissions', $username))
{
header("Location: ../nopermission.php");
die;
}
?>
<script language="javascript">
document.getElementById('rank').value = '';
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
		LoadPage('permissions');
	});
	

	function Permission_Rank(id) {
		$.ajax({
		   type: "POST",
		   url: "functions/page_permissions_rank.php?rank=" + id,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
		}
		
	function Edit_Rank(id) {
		$.ajax({
		   type: "POST",
		   url: "functions/page_modify_rank.php?rank=" + id,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
		}
	
	function AddRank() {
		$('button.UpdateRank').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/add_rank.php",
		   data: "name=" + $('#name').val() + "&badgeid=" + $('#badgeid').val(),
			success: function(){
		    $('button#UpdateRank').html('Added!');
			LoadPage('permissions');
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
</script>
<div>
	<h1>Permissions</h1>
    <div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
    
    <div class="formPiece">
		<div>
			<h3>Agregar Rango</h3>
		</div>
		<div>
        <img src="img/info_16.png" class="tooltip" title="Rango" /><label for="name">Rango:</label><input type="text" name="name" id="name" style="width:384px" /><br />
        <img src="img/info_16.png" class="tooltip" title="Placa" /><label for="badgeid">Placa:</label><input type="text" name="badgeid" id="badgeid" style="width:384px" /><br />
        <button onclick="AddRank()" class="UpdateRank">Agregar</button>
        </div>
    </div>
    
	<div class="formPiece">
		<div>
			<h3>Permisos & Rangos</h3>
		</div>
		<div>
			<?php
			$ranks = mysql_query("SELECT * FROM ranks");
			while($rank = mysql_fetch_array($ranks))
			{
			?>
			<div class="UserSearchResults">
			<p><strong><?php echo $rank['name']; ?></strong><br />
			ID: <strong><?php echo $rank['id']; ?></strong><br />
            Placa: <strong><?php echo $rank['badgeid']; ?></strong></p>
            <button onclick="Permission_Rank('<?php echo $rank['id']; ?>')">Editar Permisos</button>
            <button onclick="Edit_Rank('<?php echo $rank['id']; ?>')">Editar Rango</button>
			</div>
			<?php
			}
			?>
		</div>
	</div>
</div>