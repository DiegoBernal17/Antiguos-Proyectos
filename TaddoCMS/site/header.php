<script language="javascript">

function RefreshUserCount()
{
var html = $.ajax({
url: "online.php",
async: false
}).responseText;
$('.OnlineCount').fadeOut(200, function () {
$('.OnlineCount').css("display", "none")
$('.OnlineCount').html(html + ' <?php echo $lang['users_online']; ?>')
$('.OnlineCount').fadeIn(200)
});
setTimeout("RefreshUserCount()",120000);
}

function NewPM()
{
var html = $.ajax({
url: "newpm.php",
async: false
})
.responseText;
if(html>"0"){
$('.NewPM').fadeOut(200, function () {
$('.NewPM').css("display", "none")
$('.NewPM').html(html + ' mensajes no leidos(s)')
$('.NewPM').fadeIn(200)

})};
setTimeout("NewPM()",60000);
}

<?php if($users->UserPermission('pm_reports', $username)){ ?>
function ReportedPM()
{
var html = $.ajax({
url: "functions/pm_checkfor_reported.php",
async: false
})
.responseText;
if(html>"0"){
$('.ReportedPM').fadeOut(200, function () {
$('.ReportedPM').css("display", "none")
$('.ReportedPM').html(html + ' mensajes leidos(s)')
$('.ReportedPM').fadeIn(200)

})};
setTimeout("ReportedPM()",60000);
}
ReportedPM();
<?php } ?>
RefreshUserCount();
NewPM();

</script>
<style>
.NewPM{
color: #F00;
font-weight: bold;
}
.ReportedPM{
color: #F00;
font-weight: bold;
}
</style>

<div class="Box">
	<div class="top">
		<a href="./"><img src="./Public/Styles/Images/logo.png" /></a>
	<div style="float:right">
		<div class="usersBox" style="width:140px;">
			<div class="OnlineCount"><?php echo $core->UsersOnline(); ?> Usarios Online</div>
<div class="NewPM" <?php if($pms->NewPM($users->UserID($_SESSION['username']))=="0") echo 'style="display:none;"' ?> onClick="location.href='private_messages.php?page=inbox'" style="cursor:pointer;"><br>Tienes <?php echo $pms->NewPM($users->UserID($_SESSION['username'])) ?> mensaje(s)</div>
<?php if($users->UserPermission('pm_reports', $username)){ ?>
<div class="ReportedPM" <?php if($pms->ReportedPM()=="0") echo 'style="display:none;"' ?> onClick="location.href='private_messages.php?page=reported'" style="cursor:pointer;"><?php echo $pms->ReportedPM() ?> Mensajes sin resolver(s)</div><?php }?>
			<br/><a href="logout.php">Desconectarse</a>
		</div>
	</div></div>
  <a href="http://www.youtube.com/user/diegobernal17" target="_blank" title="Sígueme en Twitter"><img src="Public/Styles/Images/icons/youtube.png" style="position: fixed; bottom: 440px; right: 0px;" border="0" width="40" height="150"></a> 
  <a href="http://twitter.com/" target="_blank" title="Sígueme en Twitter"><img src="Public/Styles/Images/icons/twiiter.png" style="position: fixed; bottom: 250px; right: 0px;" border="0" width="39" height="179"></a> 
  <a href="http://www.facebook.com/pages/Taddo-Hotel/144096468999718" target="_blank" title="Hazte Fan en Facebook"><img src="Public/Styles/Images/icons/face.png" style="position: fixed; bottom: 125px; right: 0px;" border="0" width="38" height="117"></a>

