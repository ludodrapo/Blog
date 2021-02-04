<?php session_start(); ?>

<?php ob_start(); ?>

<h2 class="center">Modification d'un article</h2>

<form method="post" action="backendIndex.php?action=updatePost" class="center">

	<p>
		Titre de l'article :<br />
		<textarea name="title" required rows="1" cols="45" placeholder="Titre"><?=htmlspecialchars($post_details['title'])?></textarea>
	</p>

	<p>
		Chapô (pour donner envie de lire l'article) :<br />
		<textarea name="lead" required rows="5" cols="45" placeholder="Chapô"><?=htmlspecialchars($post_details['lead'])?></textarea>
	</p>

	<p>
		Contenu de l'article :<br />
		<textarea name="content" required rows="15" cols="45" placeholder="Article"><?=htmlspecialchars($post_details['content'])?></textarea>
	</p>

	<p>
		Catégorie de l'article :<br />
		<textarea name="category" required rows="1" cols="45" placeholder="Catégorie"><?=htmlspecialchars($post_details['category'])?></textarea>
	</p>

	<p>
		<input type="hidden" name="post_id" value="<?=$post_details['post_id']?>">
		<button type="submit">Enregistrer</button>
	</p>
</form>

<p class="center">
	<a href="backendIndex.php?action=displayAllPosts"><button>Annuler les modifications</button></a>
</p>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>