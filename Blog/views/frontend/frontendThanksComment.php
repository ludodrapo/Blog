<?php session_start(); ?>

<?php ob_start(); ?>

<h3 class="center">Message important</h3>

<p class="center">
	Votre commentaire a bien été enregistré.<br /> Il sera visible par tous dès qu'il aura été validé.<br />Merci pour votre contribution à ce blog.
</p>

<p>
	<a href="index.php?action=displayPostAndComments&amp;post_id=<?=$post_id?>">Revenir à l'article commenté</a>
</p>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>