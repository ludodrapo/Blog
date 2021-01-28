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
				<li><a href="backendIndex.php">Accueil administration</a></li>
				<li><a href="backendIndex.php?action=displayAwaitingComments">Gérer les nouveaux commentaires</a></li>
				<li><a href="backendIndex.php?action=displayAllPosts">Gérer les articles</a></li>
				<li><a href="backendIndex.php?action=displayAllSubscribers">Abonnés</a></li>
			</ul>
		</nav>
		<hr />

		<?= $content ?>

	</body>

	<footer>

		<p>
			<hr />Ludo Drapo, et le web est plus beau.<br />
			<a href="index.php">Retour au site public</a>
		</p>

	</footer>
		
</html>