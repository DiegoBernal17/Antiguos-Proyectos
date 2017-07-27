<?php
define('USERNAME_REQUIRED', TRUE);
define('ACCOUNT_REQUIRED', TRUE);
include("../global.php");
$username = $core->EscapeString($_SESSION['username']);
if(!$users->UserPermission('hk_news', $username))
{
header("Location: ../index.php");
die;
}
?>

<script language="javascript">
	$('.tooltip').tooltip({ 
	    track: true, 
	    delay: 0, 
	    showURL: false, 
	    showBody: " - ", 
	    fade: 250 
	});
	
	$('.modify').click(function() { 
		LoadContent('page_modify_news', $(this).attr('id'));
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	});

	$('.delete').click(function() { 
		DeleteStory($(this).attr('id'));
	});

	$('button.PostNews').click(function() { 
		LoadContent('page_post_news', 0);
	    $('.overlay').fadeIn();
	    $('.page').fadeIn("slow");
	});

	$('.exitbutton').click(function() { 
	    $('.page').css('display', 'none');
	    $('.overlay').css('display', 'none');
	});

	function LoadContent(PageName, StoryID) {
		$.ajax({
		   type: "POST",
		   url: "functions/" + PageName + ".php?id=" + StoryID,
		   success: function(msg){
		     $('.content').html(msg);
		   }
		 });
	}
	
	function DeleteStory(StoryID) {
		$.ajax({
		   type: "POST",
		   url: "functions/news_delete_story.php?id=" + StoryID,
		   success: function(msg){
		     $('.SelectRow#' + StoryID).fadeOut('slow');
		   }
		 });
	}
</script>

<div>
	<h1>Noticias</h1>
	<div class="overlay hidden">
		<div class="page hidden">
			<div class="exitbutton"></div>
			<div class="content">
			</div>
		</div>
	</div>
	
	<div class="formPiece">
		<div>
			<h3>Publicar Noticia</h3>
		</div>

		<div>
			<button class="PostNews">Crear Noticia</button>
		</div>
	</div>

	<div class="formPiece">
		<h3>Noticias Actuales</h3>

		<div>
			<?php
			$newsq = mysql_query("SELECT * FROM cms_news ORDER BY id ASC");
			while($news = mysql_fetch_array($newsq))
			{
			?>
				<div class="SelectRow" id="<?php echo $news['id']; ?>">
					<img src="img/gear_32.png" class="tooltip clickme modify" title="Modificar Noticia - Haz click aqui para modificar esta noticia." id="<?php echo $news['id']; ?>"/>
					<img src="img/trash_32.png" class="tooltip clickme delete" title="Eliminar noticia - Haz click aqui para eliminar esta noticia." id="<?php echo $news['id']; ?>" />
					<h4><?php echo $news['title']; ?></h4>
					<div><?php echo substr(strip_tags($news['shortstory']),0,40).'...'; ?></div>
				</div>
            <?php
			}
			?>
			
		</div>
	</div>
</div>