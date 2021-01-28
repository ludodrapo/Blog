<?php session_start(); ?>

<?php ob_start(); ?>

<h3 class="center">Vérification d'identité</h3>

<p>
	Afin de sécuriser l'accés à la partie administration, merci de bien vouloir saisir ton mot de passe ...
</p>
<form method="post" action="index.php" class="center">

	<p>
		<input type="password" name="password" required />	
	</p>
	<p>
		<button type="submit">Valider</button>
	</p>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>