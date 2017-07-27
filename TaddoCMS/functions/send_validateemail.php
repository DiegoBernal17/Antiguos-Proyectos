<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$userq = mysql_query("SELECT * FROM users WHERE username = '".$_SESSION['username']."' LIMIT 1");
$user = mysql_fetch_array($userq);
$rand = rand(100000, 999999);
$query = mysql_query("UPDATE users SET mail_verified = '".$rand."' WHERE mail = '".$user['mail']."'");
$to = $user['mail'];
$subject = $sitename.': Validate your email address';
$message = '<div style="padding:0pt;background-color:rgb(227, 227, 219);font-size:11px;font-family:Verdana,Arial,Helvetica,sans-serif;color:rgb(0, 0, 0)">
<div style="padding:14px;background-color:rgb(188, 224, 238)">
<img src="'.$core->CmsSetting('cms_url').'/Public/Styles/Default/Images/logo.png" alt="Otaku Studios"></div>
<div style="padding:14px 14px 50px;background-color:rgb(227, 227, 219)">
<div style="padding:14px;background-color:rgb(255, 255, 255)">
<h1 style="font-size:16px">Validate Your Email</h1>
<p style="font-size:13px">
Verify your email account by <a href="'.$core->CmsSetting('cms_url').'/functions/verifymail.php?mail='.$user['mail'].'&amp;ver='.$rand.'" target="_blank">clicking here!</a> </p>
<p>This is an automatic message from Habboon. To turn off the 
notification, update your Account Settings. </p>
</div>
<div style="padding:14px 0pt;text-align:center;font-size:10px">
Copyright &copy; 2006 - 2011 Otaku Studios<br>
Powered by <a href="http://teenforum.it">Phoenix PHP</a><br>
</div>
</div>
</div>';
$headers = 'From: '.$sitemail."\r\n" .
    'Reply-To: '.$sitemail."\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers) or header("location: ../settings.php?page=email&success=false");
header("location: ../settings.php?page=email&sent=false");
?>
