<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_iplookup', $username))
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

	function SubmitForm1(ip) {
		$('button#General').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/delete_ip.php",
		   data: "ip=" + ip,
			success: function(){
		    $('button#General').html('Posted!');
			LoadPage('mod','');
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}

	function SubmitForm2(id) {
		$('button#General').attr('disabled', 'disabled');
		$.ajax({
		   type: "POST",
		   url: "functions/delete_id.php",
		   data: "id=" + id,
			success: function(){
		    $('button#General').html('Posted!');
			LoadPage('mod','');
        	$('.page').css('display', 'none');
			$('.overlay').css('display', 'none');
		   }
		 });
	}
	
	function BanIP(ip) {
		$.ajax({
		   type: "POST",
		   url: "functions/page_ban_ip.php?ip=" + ip,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}
	
	function Ban(username) {
		$.ajax({
		   type: "POST",
		   url: "functions/page_ban_user.php?username=" + username,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}
	
	function Page(page) {
		$.ajax({
		   type: "POST",
		   url: "functions/ip_lookup.php?page=" + page,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	}
</script>

	<h1>Multiple IP Lookup</h1>
    <div>
<?php
if(!isset($_GET['page']))
$page = 0;
else
$page = $core->EscapeString($_GET['page']);
$limit = (50*$page).','.(50*$page+50);
$conta = mysql_query("SELECT ip_last, count(ip_last) as conteggio FROM users GROUP BY ip_last having count(ip_last) > 1");
$pag = floor(mysql_num_rows($conta)/50);
if($pag > 0)
echo 'Pages: ';
for($i=0; $i<$pag; $i++)
{
	echo '<span class="pages" onClick="Page(\''.$i.'\');">'.$i.'</span>';
}
$users = mysql_query("SELECT ip_last, count(ip_last) as conteggio FROM users GROUP BY ip_last having count(ip_last) > 1 LIMIT ".$limit."");
?>
    <table width="100%" border="0" cellspacing="0">
<thead style="margin-bottom:10px;">
<tr>
	<td>User ID</td>
    <td>Username</td>
	<td>IP</td>
	<td>Ban</td>
    <td>Delete</td>
</tr>
</thead>
<?php
$style = 'even';
ob_start();
while($user = mysql_fetch_array ($users))
{
$resultq = mysql_query("SELECT * FROM users WHERE ip_last = '".$user['ip_last']."'");
while($result = mysql_fetch_array($resultq))
{
if($result['ip_last'] != @$ip2)
{
if($style == 'even')
$style = 'odd';
else
$style = 'even';
}
$ip2 = $result['ip_last'];
?>
<tr>
	<td width="10%" class="<?php echo $style;?>"><?php echo $result['id']; ?></td>
    <td width="30%" class="<?php echo $style;?>"><?php echo $result['username']; ?></td>
	<td width="20%" class="<?php echo $style;?>"><?php echo $result['ip_last']; ?></td>
    <td width="20%" class="<?php echo $style;?>"><button class="left" onClick="Ban('<?php echo $result['username']; ?>')">Ban User</button></td>
	<td width="20%" class="<?php echo $style;?>"><button class="left" onClick="SubmitForm2('<?php echo $result['id']; ?>');">Delete User</button></td>
</tr>
<?php
}
ob_flush();
flush();
usleep(3000);
?>
<tr>
<td colspan="5" class="<?php echo $style;?>"><center><button class="none" onClick="BanIP('<?php echo $ip2; ?>')">Ban this IP</button><button id="General" onClick="SubmitForm1('<?php echo $ip2; ?>');" class="none">Delete Users</button></center><br /></td>
</tr>
<?php
}
?>
