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

	</body>

	<footer>

		<p>
			<hr />Ludo Drapo, et le web est plus beau.<br /><hr />
<?php
if ($_SESSION['profile'] == 'administrator')
{
?>
			<a href="index.php?action=goToAdmin">Administration du site</a>
<?php
}
?>
		</p>

	</footer>
		
</html>
