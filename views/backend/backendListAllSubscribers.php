<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container mt-lg-5 mt-4">
                <!-- Portfolio Section Heading-->
        <h2 class="text-center text-uppercase text-secondary mb-0">liste des abonnés</h2>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-users"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">

<?php
while ($user = $listed_users->fetch())
{
?>
            <div class="col-md-6 col-lg-4 mb-5">
            	<div class=" mx-auto shadow">
            		<div class="container">
            			<div class="row p-3">
            				<div class="col-6">
            					<strong><?=htmlspecialchars($user['login_name'])?></strong><br />Depuis le <?=htmlspecialchars($user['registration_date'])?><br />
            				</div>
	<?php
	if ($user['is_active'] == 1)
	{
	?>
	                        <div class="col-6 my-auto text-center">
	                         	<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#blockUser" >Bloquer</a>
                                <div id="blockUser" class="modal">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Sûr de toi ?</h3>
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            <div class="modal-body py-1 px-5">
                                                Attention, tu t'apprêtes à bloquer <?=htmlspecialchars($user['login_name'])?>, un mail automatique va lui être envoyé et il ou elle risque d'assez mal le prendre si c'est une erreur ...
                                            </div>
                                            <div class="modal-footer p-3">
                                                <div>
                                                    <a class="btn btn-danger" class="close" data-dismiss="modal">J'annule</a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-info" href="backendIndex.php?action=blockUser&amp;user_id=<?=$user['user_id']?>">J'assume</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>        
	                         </div>
	<?php
	}
	elseif ($user['is_active'] == 0)
	{
	?>
	                        <div class="col-6 my-auto text-center">
	                        	<a class="btn btn-info" href="#" data-toggle="modal" data-target="#authorizeUser">Réactiver</a>
                                <div id="authorizeUser" class="modal">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Sûr de toi ?</h3>
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            <div class="modal-body py-1 px-5">
                                                    Attention, tu t'apprêtes à redonner à <?=htmlspecialchars($user['login_name'])?> l'accès aux commentaires et un mail automatique va lui être envoyé ...
                                            </div>
                                            <div class="modal-footer p-3">
                                                <div>
                                                    <a class="btn btn-danger" class="close" data-dismiss="modal">J'annule</a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-info" href="backendIndex.php?action=authorizeUser&amp;user_id=<?=$user['user_id']?>">Compris</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>        
	                        </div>
	<?php
	}
	?>
	                    </div>
                    </div>
                </div>
            </div>
<?php
}
$listed_users->closeCursor();
?>

        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>