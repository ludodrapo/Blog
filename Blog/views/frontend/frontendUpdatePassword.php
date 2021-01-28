<?php session_start(); ?>

<?php ob_start(); ?>

<h2 class="center">Modification de ton mot de passe</h2>

<form method="post" action="index.php">
	<p class="center">
		C'est une excellente initiative !
	</p>
	<p>
		Saisis ton mot de passe actuel :<br />
		<input type="password" name="password" required />
	</p>

	<p>
		Saisis ton nouveau mot de passe :<br />
		<input type="password" name="new_password_1" required /><br />
		<em>(Attention : il doit absolument être composé de 8 à 16 caractères et contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.)</em>
	</p>
	<p>
		Saisis-le une deuxième fois (on n'est jamais trop prudent) :<br />
		<input type="password" name="new_password_2" required />
	</p>
	<p class="center">
		Attention, cher abonné :<br />
		Une fois ton changement validé,<br />
		Et si tout s'est bien passé<br />
		Il faudra te reconnecter ...<br />
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