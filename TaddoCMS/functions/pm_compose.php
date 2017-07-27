<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");?>
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

<?php
$username = $core->EscapeString($_SESSION['username']);
if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
if(isset($_GET['folder'])) $folder=$core->EscapeString($_GET['folder']);
$pmq = mysql_query("SELECT * FROM cms_pm WHERE id = '".$_GET['id']."' AND toid='".$users->UserID($username)."' LIMIT 1");
$pm = mysql_fetch_array($pmq);
$from=$users->UserName($pm['fromid']);
if($pm['toid']==$users->UserId($username)||$pm['fromid']==$users->UserId($username)){
if($pm['read']=="0") {  
if($folder=="inbox"){mysql_query("UPDATE cms_pm SET `read`='1', timestamp_received='".time()."' WHERE id=".$_GET['id']."");}}
?>
<div id="topBar" style="padding:5px; font-size:14px; cursor:pointer;">Responder el mensaje de <?php echo $users->UserInfo($from, 'username'); ?>
<div align="right" onClick="window.location = 'private_messages.php?page=inbox'" style=" width:50px; float:right;cursor:pointer;"><b>X</b></div></div>
<div id="form">
<div style=" background-color:#EFEFEF; float:left; padding:5px;" align="center">
	<div style="float:left; padding:10px; width:70px; ">
    <img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $users->UserInfo($_SESSION['username'], 'look'); ?>" alt="<?php echo $users->UserInfo($from, 'username'); ?>" />
    </div>
	<div style="margin:2px; padding-left:4px; float:right" align="left">
    <div style="border:1px; border-color:#CCC; border-style:solid; padding:10px;">
    <label for="to"><b>Para:</b> </label><br />
	<input type="text" name="to" id="to" class="textbox" disabled="disabled" style="width:90%;" value="<?php echo $users->UserName($pm['fromid']);?>" /><div id="check"></div><br /><br />
    <label for="subject"><b>Asunto: </b></label><br />
	<input type="text" name="subject" id="subject" class="textbox" style="width:90%;" value="RE: <?php echo $pms->WordFilter($pm['subject']);?>" /><br /><br />
    <label for="new_pm"><b>Mensaje:</b> </label><br />
    <textarea class="wysiwyg" name="message" id="message" style="width:90%; padding:4px; border:1px; border-color:#999; border-style:solid; height:200px;">
                    <br /><hr/>
                    From: <?php echo $users->UserName($pm['fromid']);?><br />
                    Subject: <?php echo $pm['subject'];?><br />
                    Received: <?php echo date('l dS \o\f F Y h:i:s A', $pm['timestamp_received']);?><br />
                    Message:<br /><?php echo $pms->WordFilter($pm['message']);?>
    </textarea>
    <br /><br />
	<input name="save" id="save" type="checkbox" value="1" /><label for="save">  Guardar una copia en la bandeja de salida</label><br />

    <button class="buttons" onclick="SubmitForm()" class="SendPM">Enviar</button>
</div>
</div>
<?php }}
else {
?>
<div id="topBar" style="padding:5px; font-size:14px; cursor:pointer;">Nuevo mensaje
<div align="right" onClick="window.location = 'private_messages.php?page=inbox'" style=" width:50px; float:right;cursor:pointer;"><b>X</b></div></div>
<div id="form">
<div style=" background-color:#EFEFEF; float:left; padding:5px;" align="center">
	<div style="float:left; padding:10px; width:70px; ">
    <img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $users->UserInfo($_SESSION['username'], 'look'); ?>" alt="<?php echo $users->UserInfo($from, 'username'); ?>" />
    </div>
	<div style="margin:2px; padding-left:4px; float:right" align="left">
	<div style="border:1px; border-color:#CCC; border-style:solid; padding:10px;">
    <label for="to"><b>Para</b> </label><br />
	<div>
    <input onblur="CheckName()" class="textbox" type="text" name="to" id="to" style="width:75%;" />
    <button onclick="LoadFriends()" class="navigation">Amigos</button>
    <div style="width:91%; margin-left:5px; margin-top:0px; position:inherit; top:-5px;display:none; border:1px; border-style:solid; border-color:#CCC;padding:2px;" id="namelookup"></div>
    
        </div>
	<label for="subject"><b>Asunto:</b></label><br />
	<input type="text" name="subject" class="textbox" id="subject" style="width:90%;" />
    <div style="width:91%; margin-left:5px; margin-top:0px; position:inherit; top:-5px;display:none; border:1px; border-style:solid; border-color:#CCC;padding:2px;" id="subjectcheck"></div>
	<label for="new_pm"><b>Mensaje:</b> </label><br />
	<textarea class="wysiwyg" name="message" id="message" style="margin-left:5px; height:200px; margin-right:20px;"></textarea>
    <div style="width:91%; margin-left:5px; margin-top:0px; position:inherit; top:-5px;display:none; border:1px; border-style:solid; border-color:#CCC;padding:2px;" id="messagecheck"></div>
	<input name="save" id="save" type="checkbox" value="1" /><label for="save">  Guardar una copia en la bandeja de salida</label><br />
	<button onclick="CheckBeforeSend()"  id="SendPM" class="buttons">Enviar</button></div>
</div>
</div>	

<?php }?>