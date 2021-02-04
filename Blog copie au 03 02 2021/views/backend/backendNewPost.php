<?php session_start(); ?>

<?php ob_start(); ?>

<h2 class="center">Nouvel article</h2>

<form method="post" action="backendIndex.php?action=addPost" class="center">

	<p>
		Titre de l'article :<br />
		<textarea name="title" required rows="1" cols="45" placeholder="Titre"></textarea>
	</p>

	<p>
		Chapô (pour donner envie de lire l'article) :<br />
		<textarea name="lead" required rows="5" cols="45" placeholder="Chapô"></textarea>
	</p>

	<p>
		Contenu de l'article :<br />
		<textarea name="content" required rows="15" cols="45" placeholder="Article"></textarea>
	</p>

	<p>
		Catégorie de l'article :<br />
		<textarea name="category" required rows="1" cols="45" placeholder="Catégorie"></textarea>
	</p>

	<p>
		<button type="submit">Enregistrer</button>
	</p>

</form>

<p class="center">
	<a href="backendIndex.php?action=displayAllPosts"><button>Annuler</button></a>
</p>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>