<?php session_start(); ?>

<?php ob_start(); ?>

<h2 class="center">Derniers articles publiés</h2>

<?php

while ($post = $listed_last_posts->fetch())
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
		<?= htmlspecialchars($post['lead'])?><br />
	</p>

</div>

<?php
}
$listed_last_posts->closeCursor();
?>

<hr /><h2 class="center">Le CV de Ludo</h2>



<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>
