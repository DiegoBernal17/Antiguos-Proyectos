<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'home');
if(isset($_GET['u']))
{
$username = $core->EscapeString($_GET['u']);
}
else
{
$username = $core->EscapeString($_SESSION['username']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $sitename." - ".$username; ?></title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="Public/JS/jquery.history.js"></script>
    <script type="text/javascript" src="Public/JS/tooltip.js"></script>
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main.css" />
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main2.css" />
</head> 

<body id="mainbox"> 
 
<div class="mainBox"> 
    <?php include("site/header.php"); ?>
    <?php
    if(strtolower(@$_GET['u']) == strtolower($_SESSION['username']) || !isset($_GET['u']))
    include("site/homenav.php");
    else
    include("site/communitynav.php");
    ?>

    <div class="mid" id="midcontent"> 

<?php
if($users->NameTaken($username))
{
?>

<div class="column" id="column1">

    <div class="contentBox">
        <div class="boxHeader"><center><?php echo $users->UserInfo($username, 'username'); ?></center></div>
        <div class="boxContent">
            <div class="HomeBox" style="height:170px;">
            <img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $users->UserInfo($username, 'look'); ?>" alt="<?php echo $users->UserInfo($username, 'username'); ?>" style="float:left" />
                    <div class="OnlineStatus">
                        <?php
                        if($users->UserInfo($username, 'online') == 1)
                        {
                        ?>
                            <div class="Online">Conectado</div>
                        <?php
                        }
                        else
                        {
                        ?>
                            <div class="Offline">Desconectado</div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="UsersName"><?php echo $users->UserInfo($username, 'username'); ?></div>
                    <div class="UsersMotto"><strong>Misión:</strong> <?php echo $users->UserInfo($username, 'motto'); ?></div>
                    <div class="UsersLastLogin"><strong>Última vez conectado:</strong> <?php echo @date("d-m-Y",$users->UserInfo($username, 'last_online')); ?></div>
                    <div class="UsersCreated"><strong>Creado en:</strong> <?php echo @date("d-m-Y",$users->UserInfo($username, 'account_created')); ?></div>
                    <div class="UsersCreated"><strong>Rango:</strong> <?php echo $users->RankName($users->UserInfo($username, 'rank')); ?></div>
                    <div class="UsersCreated"><strong>Yosoys:</strong>
                    <?php
                    $tags = mysql_query("SELECT * FROM user_tags WHERE user_id = '".$users->UserID($username)."'");
                    while($tag= mysql_fetch_array($tags))
                    echo $tag['tag'].'<a href="functions/removetag.php?id='.$tag['id'].'">(x)</a>,';
                    ?></div>
                    <?php
                    if(strtolower($username) == strtolower($_SESSION['username']))
                    {
                        ?>
                    <form name="Tag" action="functions/addtag.php" method="post">
                    <label for="tag">Agregar Yosoys</label>
                    <input type="text" name="tag" id="tag"  />
                    <div class="Submitbtn right">
                        <button type="submit" class="positive" name="submitcomment">Aceptar</button>
                       </div>
                       </form>
                    <?php
                    }
                    ?>
            </div>
        </div>
    </div>
<div class="contentBox">
        <div class="boxHeader"><center>Estadisticas locales</center></div>
        <div class="boxContent">
        <div class="StatsBox">
<?php 
            $userq = mysql_query("SELECT * FROM user_stats WHERE id = '".$users->UserID($username)."'");
            while($user = mysql_fetch_array($userq))
{
?>

<div class="UsersMotto">
<b>Tiempo en linea:</b> <?php echo $user['OnlineTime']; ?> <br />
<b>Píxeles:</b> <?php echo $users->UserInfo($username, 'activity_points'); ?> <br />
<b>Respetos resividos:</b>   <?php echo $user['RespectGiven']; ?>    <br />
<b>Salas visitadas:</b> <?php echo $user['RoomVisits']; ?>  <br />
<b>Regalos dados:</b> <?php echo $user['GiftsGiven']; ?>  <br />
<b>Regalos recividos:</b> <?php echo $user['GiftsReceived']; ?>   <br />
<b>Puntuación lograda:</b>   <?php echo $user['AchievementScore']; ?>  <br />
<?php
}
?>
</div>
</div>
</div>
</div>
    <div class="contentBox">
        <div class="boxHeader"><center>Mis placas</center></div>
        <div class="boxContent">
        <div class="BadgeBox">
        <?php
        $userbadges = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$users->UserInfo($username, 'id')."'");
        if(mysql_num_rows($userbadges) == 0)
        {
            echo '<strong><center>No tienes placas</center></strong>';
        }
        while($userbadge = mysql_fetch_array($userbadges))
        {
        ?>
            <img src="Public/Images/badges/<?php echo $userbadge['badge_id']; ?>.gif" />
        <?php
        }
        ?>
        </div><div>
</div>
</div>
</div>
</div>
<div class="column" id="column2">
    <div class="contentBox">
        <div class="boxHeader"><center>Mis salas</center></div>
        <?php
        $userrooms = mysql_query("SELECT * FROM rooms WHERE owner = '".$username."'");
        $color = 'odd';
        if(mysql_num_rows($userrooms) == 0)
        {
            echo '<div class="RoomBox" id="even"><strong>No tienes salas</strong></div>';
        }
        while($userroom = mysql_fetch_array($userrooms))
        {
            ?>
            <div class="RoomBox" id="<?php echo $color; ?>">
            <strong><?php echo $userroom['caption']; ?></strong><br /><br />
            Visitantes de la sala: <?php echo $userroom['users_now']; ?> ~ Valoración de la sala: <?php echo $userroom['score']; ?>
            </div>
            <?php
            if($color == 'odd')
            $color='even';
            else
            $color='odd';
        }
        ?>
    </div>
</div>
<?php
}
else
{
?>
<div class="column" id="column1">
    <div class="contentBox">
        <div class="boxHeader"><center>¡Página no encontrada!</center></div>
        <div class="boxContent">
            Lo sentimos pero no hemos encontrado la página que solicitas.
        </div>
    </div>
</div>
<div class="column" id="column2">
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
            <div class="readmore"><a href="articles.php">Leer más &raquo;</a></div>
        </div>
</div>
<?php
}
?>
         
<?php include("site/sideads.php"); ?>

    </div> 

    <?php include("site/footer.php"); ?>
</div> 

</body> 
</html>