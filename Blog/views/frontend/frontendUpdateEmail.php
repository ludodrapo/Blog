<?php session_start(); ?>

<?php ob_start(); ?>

<h2 class="center">Modification de ton email de contact</h2>

<form method="post" action="index.php">

	<p>
		Saisis ta nouvelle adresse mail :
	</p>
	<p class="center">
		<input type="text" name="new_email" required />
	</p>
	<p>
		Et par mesure de sécurité, il faut également saisir ton mot de passe :
	</p>
	<p class="center">
		<input type="password" name="password" required />
	</p>
	<p class="center">
		<button type="submit">Valider</button>
	</p>

</form>

<p class="center">
	<a href="index.php?action=profile"><button>Annuler</button></a>
</p>


<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>