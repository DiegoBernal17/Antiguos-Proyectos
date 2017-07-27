<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
?>
<script type="text/javascript">
$(document).ready(function(){
	
	$('textarea.wysiwyg').tinymce({
		script_url : '../Public/tiny_mce/tiny_mce.js',
        theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,|,undo,redo,|,image,cleanup,help,|,forecolor,backcolor",
        theme_advanced_buttons3 : "",
        skin : "o2k7",
        skin_variant : "blue",
	});
});
</script>

<div id="topBar" style="padding:5px; font-size:14px; cursor:pointer;">Reportar mensaje
<div align="right" onClick="window.location = 'private_messages.php?page=inbox'" style=" width:50px; float:right;cursor:pointer;"><b>X</b></div></div>
<div id="form">
<div style=" background-color:#EFEFEF; float:left; padding:5px;" align="center">
	<div style="float:left; padding:10px; width:70px; ">
    <img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $users->UserInfo($_SESSION['username'], 'look'); ?>" alt="<?php echo $users->UserInfo($from, 'username'); ?>" />
    </div>
	<div style="margin:2px; padding-left:4px; float:right" align="left">
    <div style="border:1px; border-color:#CCC; border-style:solid; padding:10px;">
    <label for="new_pm"><b>Por qué estás reportando este mensaje:</b> </label><br />
    <textarea class="wysiwyg" name="message" id="message" style="width:90%; padding:4px; border:1px; border-color:#999; border-style:solid; height:200px;"></textarea>
    
    <input name="id" id="id" type="hidden" value="<?php echo $core->EscapeString($_GET['id'])?>" />
    <br />
	<div class="report_button">¡Este mensaje se eliminará de la bandeja de entrada!</div>
    <br />
    <button class="buttons SendReport" onclick="SubmitReport()">Enviar</button>
</div>
</div>