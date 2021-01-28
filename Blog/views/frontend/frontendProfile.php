<?php session_start(); ?>

<?php ob_start(); ?>

<h2 class="center">Profil</h2>

<?php
if ($count['comments_count'] > 0)
{
?>
<h3 class="center">Tes statistiques</h3>

<p>
	Tu as déjà fait <?=htmlspecialchars($count['comments_count'])?> commentaire(s) validés ou en attente de validation, à propos de <?=htmlspecialchars($count['posts_count'])?> article(s). Merci <?=htmlspecialchars($_SESSION['login_name'])?> pour ta participation à la vie de ce blog. C'est super !
</p>
<?php
}
?>

<h3 class="center">Mettre à jour tes infos perso</h3>

<p>
	Ton adresse de contact est actuellement : <?=htmlspecialchars($_SESSION['email'])?>.
</p>
<p class="center">
	<a href="index.php?action=updateEmail"><button type="text">Changer mon adresse email de contact</button></a>
</p>

<p>
	Il est important de changer régulièrement son mot de passe, n'hésite pas à le faire dès que tu peux ...
</p>
<p class="center">
	<a href="index.php?action=updatePassword"><button type="text">Changer mon mot de passe</button></a>
</p>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>