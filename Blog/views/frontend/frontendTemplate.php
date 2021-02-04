<!DOCTYPE html>

<html>

	<head>

		<title>Ludo Drapo, le blog</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="public/css/style.css" />

	</head>

	<body>

		<h1>Le blog de Ludo</h1>

		<nav>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="index.php?action=displayAllPosts">Tous les articles</a></li>
				<li><a href="#">Ludo, un parcours à part</a></li>
			</ul>
		</nav>
		<hr />
<?php
if (!isset($_SESSION['login_name']))
{
?>
		<p class="center">
			<a href="index.php?action=login">S'inscrire / Se connecter</a>
		</p>
<?php
}
elseif (isset($_SESSION['login_name']))
{
?>
		<p class="center">
			Vous êtes connecté(e), <?=htmlspecialchars($_SESSION['login_name'])?><br /><a href="index.php?action=logout">Se déconnecter</a> / <a href="index.php?action=profile">Profil</a>
		</p>
<?php
}
?>
		<hr />

		<?= $content ?>

		<hr />

		<footer>

<?php

if (!isset($_SESSION['profile']) || $_SESSION['profile'] == 'subscriber')
{
?>
			<div class="myFrame">
				<form method="post" action="index.php" style="text-align: left">
					<p>
						Pour me contacter directement, merci d'utiliser ce formulaire ...
					</p>
					<p>
						<input type="text" name="name" placeholder="name" required />
					</p>
					<p>
						<input type="text" name="email" placeholder="email" required />
					</p>
					<p>
						<textarea name="message" rows="5" cols="45" placeholder="Par exemple : il est vraiment top ce site !" required></textarea>
					</p>
					<button type="submit">C'est parti !</button>
				</form>
			</div>
<?php
}
?>
			<p class="center">
				Ludo Drapo, et le web est plus beau.<br />
			</p>

<?php
if ($_SESSION['profile'] == 'administrator')
{
?>
			<p class="center">
				<a href="index.php?action=goToAdmin">Administration du site</a>
			</p>
<?php
}
?>
		</footer>

	</body>
		
</html>
