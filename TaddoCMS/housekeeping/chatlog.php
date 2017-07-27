<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_chatlog', $username))
{
header("Location: nopermission.php");
die;
}
if(isset($_GET['start'])){
	$start=$core->EscapeString($_GET['start']);
	}
	else $start=0;
if(!isset($_GET['uname'])){
	$chatlogq = mysql_query("SELECT * FROM chatlogs ORDER BY id DESC LIMIT ".$start.",20");
	}
	else {
		$chatlogq = mysql_query("SELECT * FROM chatlogs WHERE user_name='".$core->EscapeString($_GET['uname'])."' ORDER BY id DESC LIMIT ".$start.",20");
		}
?>
<script language="javascript">
		
		function LoadPage(PageName) {
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: PageName + ".php",
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#' + PageName).addClass('selected');
			     OldPage = PageName;
			   }
			 });
		}		
		
		function RefreshPage(PageName) {
			
		    $('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: PageName + ".php<?php if (isset($_GET['uname'])) echo '?uname='.$core->EscapeString($_GET['uname']);?>",
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#' + PageName).addClass('selected');
			     OldPage = PageName;
			   }
			 });
		}
		
		function NextPage(PageName) {
			var start=<?php echo $start;?>;
			start=start+20;
			$('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: PageName + ".php?start="+start+"<?php if (isset($_GET['uname'])) echo '&uname='.$_GET['uname'];?>",
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#' + PageName).addClass('selected');
			     OldPage = PageName;
			   }
			 });
		}
		
		function PreviousPage(PageName) {
			var start=<?php echo $start;?>;
			start=start-20;
			$('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: PageName + ".php?start="+start+"<?php if (isset($_GET['uname'])) echo '&uname='.$_GET['uname'];?>",
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#' + PageName).addClass('selected');
			     OldPage = PageName;
			   }
			 });
		}
		
		function GetUserChat(uname,PageName) {
			$('.page').css('display', 'none');
		    $('.overlay').css('display', 'none');
			$.ajax({
			   type: "POST",
			   url: PageName + ".php?uname=" + uname,
			   success: function(msg){
			     $('.conColumn').html(msg);
			     $('li#' + OldPage).removeClass('selected');
			     $('li#' + PageName).addClass('selected');
			     OldPage = PageName;
			   }
			 });
		}
		
		
	</script>
<div>
	<h1>Chat Logs</h1>
    <div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
    <div>		
        <?php while($chatlog = @mysql_fetch_array($chatlogq)){ ?>
            <div style="padding:2px; cursor:pointer;" onmouseover="this.style.fontWeight='bold';" onmouseout="this.style.fontWeight='normal';">
            <div style="width:150px; float:left"><?php echo @date("d/m/y : H:i:s",$chatlog['timestamp']);?></div>
            <div style="width:150px; float:left; cursor:pointer;" onclick="GetUserChat('<?php echo $chatlog['user_name'];?>', 'chatlog');"><?php echo $chatlog['user_name'];?></div>
            <div style="float:left"><?php echo $core->EscapeString($chatlog['message']);?></div><br>

            </div>
			<?php } ?>
            <?php if (isset($_GET['uname'])) {?><button id="refresh" onclick="RefreshPage('chatlog');" style="float:left;">Cargar de nuevo la pagina de <?php echo $_GET['uname']; ?> </button>&nbsp;&nbsp;&nbsp;<?php }?> 
            <button id="refresh" onclick="LoadPage('chatlog');" style="float:left;">Recargar pagína</button><br /><br />

			<div >
           <?php $num_rows = mysql_num_rows($chatlogq);
		   if($start>0){ echo '
           <button id="PreviousPage" onclick="PreviousPage(\'chatlog\');" style="float:left;"><< Regresar pagína</button>
		   ';}
		   if($num_rows>=20){ echo '<button id="NextPage" onclick="NextPage(\'chatlog\');" style="float:left;">Pagína siguiente >></button>';}?>
           </div>
    </div>
</div>