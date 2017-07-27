<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$id=$users->UserID($_SESSION['username']);
$friendsq = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$id."'");
$friends_amount = mysql_num_rows($friendsq);
echo '
<div id="dragMe" style="padding:5px; font-size:14px; cursor:pointer;"><b>Amig@s</b>
<div align="right" onClick="HideFriends();" style=" width:50px; float:right;cursor:pointer;"><b>X</b></div></div>
<div class="friendbox"  align="left">
';
if($friends_amount>0){
	
	while($friends = mysql_fetch_array($friendsq)) {
		if($users->UserName($friends['user_two_id'])){
		echo '<div id="'.$friends['user_two_id'].'" onclick="AddTo('.$friends['user_two_id'].'); CheckName();" style="cursor:pointer;">';
		echo $users->UserName($friends['user_two_id']);
		echo '</div>';
		}}
echo '</div>';
	}

else echo "There are no friends in your list</div>";
?>
