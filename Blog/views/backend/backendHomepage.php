<?php session_start(); ?>

<?php ob_start(); ?>

<h2 class="center">Bienvenue sur la page d'administration du blog</h2>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>