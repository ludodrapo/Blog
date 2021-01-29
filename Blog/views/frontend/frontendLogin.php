<?php session_start(); ?>

<?php ob_start(); ?>

<h4>Déja membre ? Bravo, tu peux te connecter ...</h4>

<form method="post" action="index.php" class="center">
	<p>
		Pseudo : <input type="text" name="login_name" required autocomplete="off" />
	</p>
	<p>
		Mot de passe : <input type="password" name="password" required />	
	</p>
	<p>
		<button type="submit">Valider</button>
	</p>
</form>

<h4>Pas encore membre ? Pas grave, tu y es presque ...</h4>

<form method="post" action="index.php">
	<p>
		Saisis un pseudo que tu apprécies : <input type="text" name="new_login_name" required placeholder="Votre pseudo" title="Un bon pseudo, c'est important !" oninvalid="this.setCustomValidity('Pas le choix, il faut saisir un pseudo !')" oninput="this.setCustomValidity('')" />
	</p>
	<p>
		Saisis un mot de passe : <input type="password" name="new_password_1" required /><br /><em>(Attention : pour votre propre sécurité, votre mot de passe doit être composé d'entre 8 et 16 caractères et contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.)</em>
	</p>
	<p>
		Saisis à nouveau le mot de passe : <input type="password" name="new_password_2" required />
	</p>
	<p>
		Saisis une adresse mail valide : <input type="text" name="new_email" required />
	</p>
	<p class="center">
		<button type="submit">Je valide !</button>
	</p>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>
