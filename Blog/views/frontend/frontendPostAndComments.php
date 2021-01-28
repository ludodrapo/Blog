<?php session_start(); ?>

<?php ob_start(); ?>

<div class="myFrame">

	<h3 class="center"><?=htmlspecialchars($post_details['title'])?></h3>

	<p class="center">
		<em>Ecrit par <?=htmlspecialchars($post_details['login_name'])?>, le <?=htmlspecialchars($post_details['date'])?>, mis à jour le <?=htmlspecialchars($post_details['update_date'])?>.</em><br /><strong><?=nl2br(htmlspecialchars($post_details['lead']))?></strong>
	</p>
	<p>
		<?=nl2br(htmlspecialchars($post_details['content']))?><br />
	</p>
</div>

<?php
while ($comment = $all_comments->fetch())
{
?>

<p>
	<em><?=htmlspecialchars($comment['login_name'])?> a commenté le <?=htmlspecialchars($comment['date'])?> à <?=htmlspecialchars($comment['time'])?> :</em><br />"<?=htmlspecialchars($comment['comment'])?>".
</p>


<?php
}
$all_comments->closeCursor();
?>

<?php
if(isset($_SESSION['login_name']))
{
?>
<form method="post" action="index.php?action=addComment&amp;post_id=<?=$post_details['post_id']?>" class="center">

	<p>
		<textarea name="comment" required rows="5" cols="45" placeholder="Votre commentaire ..."></textarea>
	</p>
	<p>
		<button type="submit">Envoyer</button>
	</p>

</form>
<?php
}
else
{
?>
<p class="center">
	Si vous souhaitez ajouter un commentaire, vous devez être inscrit(e) et connecté(e), merci de votre compréhension. En plus, c'est super simple, il suffit de cliquer <a href="index.php?action=login">ici</a> !
</p>
<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>