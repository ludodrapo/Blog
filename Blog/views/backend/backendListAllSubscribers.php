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
	<?php
	if ($user['is_active'] == 1)
	{
	?>
	<a href="backendIndex.php?action=blockUser&amp;user_id=<?=$user['user_id']?>">Bloquer</a>
	<?php
	}
	elseif ($user['is_active'] == 0)
	{
	?>
	<a href="backendIndex.php?action=authorizeUser&amp;user_id=<?=$user['user_id']?>">Réactiver</a>
	<?php
	}
	?>

</div>
<?php
}
$listed_all_users->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>