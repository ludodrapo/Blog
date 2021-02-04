<?php session_start(); ?>

<?php ob_start(); ?>


<h2 class="center">Commentaires en attente de validation</h2>


<?php
while ($comment = $all_awaiting_comments->fetch())
{
?>

<p>
	<em>Le <?=htmlspecialchars($comment['date'])?> à <?=htmlspecialchars($comment['time'])?>,</em><br />
	<strong><?=htmlspecialchars($comment['login_name'])?></strong> a souhaité laissé le commentaire suivant à propos de l'article intitulé <strong><?=htmlspecialchars($comment['title'])?></strong> :<br />
	"<?=htmlspecialchars($comment['comment'])?>"<br />
	<a href="backendIndex.php?action=validateComment&amp;comment_id=<?=$comment['comment_id']?>">Valider ce commentaire</a> / <a href="backendIndex.php?action=deleteComment&amp;comment_id=<?=$comment['comment_id']?>">Supprimer ce commentaire</a>
</p>

<?php
}
$all_awaiting_comments->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/backend/backendTemplate.php'); ?>