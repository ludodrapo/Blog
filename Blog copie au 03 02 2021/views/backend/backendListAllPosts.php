<?php session_start(); ?>

<?php ob_start(); ?>

<p>
	<a href="backendIndex.php?action=newPost">Nouvel article</a>
</p>

<h2 class="center">Liste des articles disponibles</h2>

<?php
while ($post = $listed_all_posts->fetch())
{
?>
<div class="myFrame">
	<strong><?=htmlspecialchars($post['title'])?></strong><br />
	<?= htmlspecialchars($post['lead'])?><br />
	<?= substr(htmlspecialchars($post['content']), 0, 30) ?> ...<br />
	<a href="backendIndex.php?action=fillUpdatePostPage&amp;post_id=<?=$post['post_id']?>">Modifier</a> / 
	<?php
	if ($post['is_ok'] == 1)
	{
	?>
	<a href="backendIndex.php?action=deactivatePost&amp;post_id=<?=$post['post_id']?>">Désactiver</a>
	<?php
	}
	elseif ($post['is_ok'] == 0)
	{
	?>
	<a href="backendIndex.php?action=activatePost&amp;post_id=<?=$post['post_id']?>">Activer</a>
	<?php
	}
	?>
</div>
<?php
}
$listed_all_posts->closeCursor();
?>


<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>