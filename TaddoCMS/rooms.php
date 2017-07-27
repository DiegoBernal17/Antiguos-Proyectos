<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'rooms');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Salas populares</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="Public/JS/jquery.history.js"></script>
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main.css" />
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main2.css" />

</head> 
 
<body> 

	<?php include("site/header.php"); ?>
	
	<div class="mid">
	<?php include("site/nav.php"); ?>
	<div id="column1">
	<?php include("site/homenav.php"); ?>
		    <section class="menu"><section class="menu2">
			<center><b>Salas populares</b></center></section>
			<?php
			$roomq = mysql_query("SELECT * FROM rooms WHERE users_now > 0 ORDER BY users_now DESC LIMIT 20");
			while($room = mysql_fetch_array($roomq))
			{
				?>
				<div class="RoomsBox">
					<div class="RoomSearchResultsIcon" style="background-image:url(Public/Images/rooms/<?php if($room['roomtype'] == 'private')echo $room['model_name']; else echo 'public'; ?>.gif);"></div>
					<div class="Roomsname"><?php echo $room['caption']; ?></div>
					<div class="Roomsinfo">Dueño: <?php if($room['roomtype'] == 'private')echo '<a href="home.php?u='.$room['owner'].'">'.$room['owner'].'</a>'; else echo 'N/A'; ?></div>
                    <div class="Roomsinfo">Visitantes de la sala: <?php echo $room['users_now']; ?></div>
                    <div class="Roomsinfo">Valoración de la sala: <?php echo $room['score']; ?></div>
                    <div class="Roomsinfo">Estado: <?php echo $room['state']; ?></div>
				</div>
            <?php } ?>
			</section>
	</div>
	        <div id="column2">
	<?php
	$query = mysql_query("SELECT * FROM cms_news ORDER BY published DESC LIMIT 1");
	$num = mysql_num_rows($query);
	if($num > 0)
	{
		$news = mysql_fetch_array($query);
		echo'<div class="newsHeader">
				<div class="HeadlineStory" id="'.$news["id"].'" style="background: url('.$news["image"].') no-repeat; display:block;">
					<p class="Mainheadline"><a href="articles.php?story='.$news["id"].'">'.stripslashes($news["title"]).'</a></p>
					<p class="Mainstory">'.strip_tags($news["shortstory"], '<br><br/><br />').'</p>
				</div>
		</div>';
		$color = 'odd';
		$query = mysql_query("SELECT * FROM cms_news ORDER BY published DESC LIMIT 5");
		while($news = mysql_fetch_array($query))
		{
			echo'<div class="storybox" id="'.$color.'" ref="'.$news["id"].'">
				<p class="headline"><a href="articles.php?story='.$news["id"].'">'.$news["title"].'</a></p>
				<p class="date">'.@date("d-m-Y", $news['published']).'</p>
			</div>';
			if($color == 'odd')
			$color='even';
			else
			$color='odd';
		}
	}
	?>
		<div class="storyboxEnd">
			<div class="readmore"><a href="articles.php">Leer Mas &raquo;</a></div>
		</div>
				   <section class="menu"><section class="menu2">
					<center><b>Top 5 - Pixeles</b></center></section>
<table>
<?php
$datosTop = mysql_query("SELECT * FROM users ORDER BY activity_points DESC LIMIT 5");

while($datosTop10 = mysql_fetch_array($datosTop)){
echo '
<tr><td width="5px"></td>
<td width="20px">';

echo '<img src="http://www.habbo.com.es/habbo-imaging/avatarimage?figure=' . $datosTop10['look'] . '&direction=3&head_direction=3&gesture=sml&action=crr=2&size=s" align="left"></td> <td width="195px"><a href="/home.php?u='.$datosTop10['username'].'">'.$datosTop10['username'].'</a><br />'.$datosTop10['activity_points'].' pixeles';

echo '</td>
           
          ';
}
?>

</table></section>
    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>