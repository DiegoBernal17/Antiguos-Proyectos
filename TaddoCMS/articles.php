<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include('global.php');
define("THIS_SCRIPT", 'articles');

            if(htmlspecialchars($_GET['delcommentid'])){
                    if($users->UserPermission('hk_login', $core->EscapeString($_SESSION['username']))) {
                mysql_query("DELETE FROM cms_comments WHERE id='".$_GET['delcommentid']."'");
                }
            }
            ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Noticas</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="Public/JS/jquery.history.js"></script>
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main.css" />
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main2.css" />
	    <script type="text/javascript"> 
        function doPostComment() {
            comment = $("#our_comment").val();
            story = $("#storyid").val();
            uid = $("#uid").val();
            
            if( comment.length < 1 && comment == "Enter your comment here...") {
                return false;
            }
            
            $("#OurNewComment > #Comment").html("<strong><?php echo $_SESSION['username']; ?></strong> ahora" + comment);
            $("#OurNewComment").show("slow");
            $(".CommentInput").hide("slow");
            $.post("./functions/postcomment.php", { comment: comment, story: story, uid: uid });
        
        }
    </script>

</head> 
 <body> 


	<?php include("site/header.php"); ?>
<?php
if(!isset($_GET['story']) || !is_numeric($_GET['story']))
{
$articleq = mysql_query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 1");
}
else
{
$articleq = mysql_query("SELECT * FROM cms_news WHERE id = '".addslashes($_GET['story'])."' LIMIT 1");
}
$article = mysql_fetch_array($articleq);
$authorq = mysql_query("SELECT * FROM users WHERE id = '".$article['author']."' LIMIT 1");
$author = mysql_fetch_array($authorq);
$recentstoriesq = mysql_query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 25");
?>



    <input type="hidden" value="<?php echo $article['id']; ?>" name="storyid" id="storyid" />
    <input type="hidden" value="<?php echo $users->UserID($core->EscapeString($_SESSION['username'])); ?>" name="uid" id="uid" />
	
	<div class="mid">
	<?php include("site/nav.php"); ?>
	<div id="column2">
		    <section class="menu"><section class="menu2">
			<center><b>Noticias recientes</b></center></section>
            <?php
            while($recentstories = mysql_fetch_array($recentstoriesq))
            {
                echo '<a href="?story='.$recentstories['id'].'">'.$recentstories['title'].' &raquo;</a>';
            }
            ?>
</section>
	</div>
	        <div id="column1">	<?php include("site/communitynav.php"); ?>
					    <section class="menu"><section class="menu2">
			<center><b><?php echo stripslashes($article['title']); ?></b></center></section>
            <div class="story"><?php echo stripslashes($article['longstory']); ?></div>
            <div class="extrainfo">
                <div class="poster">Autor: <a href="home.php?u=<?php echo $author['username']; ?>"><?php echo $author['username']; ?></a></div>
                <div class="date">Publicada: <?php echo @date("d-m-Y",$article['published']); ?></div>
            </div>
			</section>
   <?php
   $commentsq = mysql_query("SELECT * FROM cms_comments WHERE story = '".addslashes($article['id'])."' ORDER BY id ASC");
   ?>
   		    <section class="menu"><section class="menu2">
			<center><b>Comentarios</b></center></section>
    <?php
    $style = 'left';
    while($comments = mysql_fetch_array($commentsq))
    {
        $authorq = mysql_query("SELECT * FROM users WHERE id = '".$comments['author']."' LIMIT 1");
        $author = mysql_fetch_array($authorq);
    ?>
            <div class="UserComment <?php echo $style; ?>">
            <?php if($users->UserPermission('hk_login', $core->EscapeString($_SESSION['username']))) {?><a href="articles.php?story=<?php echo $article['id']; ?>&delcommentid=<?php echo $comments['id']; ?>"><font color="red"><b>X</b></font></a><?php } ?>
                <div class="Avatar"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $author['look']; if($style == 'right') echo '&direction=4'; ?>" alt="<?php echo $author['username']; ?>" /></div>
                <p class="triangle-border <?php echo $style; ?> <?php if($author['rank'] == 8) echo 'staff'; ?>" id="Comment">
                    <strong><a href="home.php?u=<?php echo $author['username']; ?>"><?php echo $author['username']; ?></a></strong> el <?php echo @date("d-m-Y",$comments['date']); ?>
                    <?php echo $comments['comment']; ?>
                </p>
            </div>
            <?php
            if($style == 'left')
            $style = 'right';
            else
            $style = 'left';
            }
            ?>
            <div class="UserComment <?php echo $style; ?>" style="display: none" id="OurNewComment">
                <div class="Avatar"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $users->UserInfo($core->EscapeString($_SESSION['username']), 'look'); if($style == 'right') echo '&direction=4'; ?>" alt="<?php echo $users->UserInfo($core->EscapeString($_SESSION['username']), 'look') ?>" /></div>

                <p class="triangle-border <?php echo $style; ?>" id="Comment">
                    placeholder
                </p>
            </div>
            <div class="CommentInput">
                <div class="MyAvatar"><img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $users->UserInfo($core->EscapeString($_SESSION['username']), 'look'); ?>" alt="<?php echo $core->EscapeString($_SESSION['username']); ?>" /></div>
                <div class="Comment"><textarea cols="50" class="triangle-border left" onfocus="this.value=''; setbg('##e5fff3');" id="our_comment">Ingresa tu comentario aqui...</textarea></div>
                <div class="Submitbtn right">
                    <button type="submit" class="positive" name="submitcomment" onmousedown="doPostComment();">Comentar</button>
                   </div>
            </div>
	</section>
	
    	<?php include("site/sideads.php"); ?>
	</div>
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>