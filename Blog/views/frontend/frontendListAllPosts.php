<?php session_start(); ?>

<?php ob_start(); ?>


<h2 class="center">Articles actuellement en ligne</h2>

<?php

while ($post = $listed_all_posts->fetch())
{
	if (empty($post['comments_count']))
	{
		$post['comments_count'] = 0;
	}
?>

<div class="myFrame">

	<div class="center">

		<p>
			<a href="index.php?action=displayPostAndComments&amp;post_id=<?=$post['post_id']?>"><h3><?=htmlspecialchars($post['title'])?></h3></a>
		</p>

	</div>

	<p>
		<em>Ecrit par <?=htmlspecialchars($post['login_name'])?>, le <?=htmlspecialchars($post['date'])?> et mis à jour le <?=htmlspecialchars($post['update_date'])?>,<br />cet article a suscité <?=htmlspecialchars($post['comments_count'])?> commentaire(s) validé(s).</em>
	</p>

	<p>
		<?= htmlspecialchars($post['lead'])?>
	</p>

</div>

<?php
}
$listed_all_posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>