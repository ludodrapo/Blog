<?php session_start(); ?>

<?php ob_start(); ?>

<h3 class="center">Bienvenue <?=htmlspecialchars($_SESSION['login_name'])?> !</h3>

<p class="center">
	Ton compte a bien été créé, félicitations.<br />
	Nous sommes super contents de t'accueillir à bord.<br />
	Bonne lecture et bons commentaires !<br />
	Et sincèrement, merci pour ton inscription.<br />
	Il ne te reste plus qu'à te connecter ...
</p>
<p class="center">
	<a href="index.php"><button>De rien, ça me fait plaisir !</button></a> 
</p>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>