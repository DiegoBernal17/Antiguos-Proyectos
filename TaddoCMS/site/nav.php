	<div class="SubnavBar">
	<div class="navButton" <?php if(THIS_SCRIPT == 'me') echo 'style="font-weight:bolder;"'; ?> onClick="location.href='me.php'"><a href="me.php">Home</a></div>
    <div class="navButton" <?php if(THIS_SCRIPT == 'community') echo 'style="font-weight:bolder;"'; ?> onClick="location.href='community.php'"><a href="community.php">Comunidad</a></div>
    <div class="navButton" <?php if(THIS_SCRIPT == 'Private Messages') echo 'style="font-weight:bolder;"'; ?> onClick="location.href='private_messages.php'"><a href="private_messages.php">Mensajes privados</a></div>
    <div class="navButton" <?php if(THIS_SCRIPT == 'shop') echo 'style="font-weight:bolder;"'; ?> onClick="location.href='shop.php'"><a href="shop.php">Tienda</a></div>
    <div class="navButton" <?php if(THIS_SCRIPT == 'referidos') echo 'style="font-weight:bolder;"'; ?> onClick="location.href='referidos.php'"><a href="referidos.php">Referidos</a></div>
    <?php if($users->UserPermission('hk_login', $core->EscapeString($_SESSION['username']))) {?><div class="navButton" <?php if(THIS_SCRIPT == 'housekeeping') echo 'style="font-weight:bolder;"'; ?> onClick="location.href='housekeeping/'"><a href="housekeeping/">Housekeeping</a></div><?php } ?>
    <?php
	$getplugin = mysql_query("SELECT * FROM plugin WHERE cms_tab = 'home'");
	while($plugin = mysql_fetch_array($getplugin))
	{
	?>
		<div class="navButton" <?php if(THIS_SCRIPT == $plugin['cms_link']) echo 'style="font-weight:bolder;"'; ?> onClick="location.href='<?php echo $plugin['cms_link']; ?>.php'"><a href="<?php echo $plugin['cms_link']; ?>.php"><?php echo $plugin['cms_text']; ?></a></div>
    <?php
	}
	?>
	</div>