<?php session_start(); ?>

<?php ob_start(); ?>

<h2 class="center">Liste des abonnés</h2>

<?php
while ($user = $listed_all_users->fetch())
{
?>
<div class="myFrame">

	<strong><?=htmlspecialchars($user['login_name'])?></strong><br />
	Inscrit(e) depuis le <?=htmlspecialchars($user['registration_date'])?><br />

</div>
<?php
}
$listed_all_users->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>