<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container mt-5">
                <!-- Contact Section Heading-->
        <h3 class="text-center text-uppercase text-secondary mb-0">Modification de ton mot de passe</h3>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-envelope"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div>
            <p>
                J'attire ici ton attention, cher abonné(e).<br />
                Une fois par le bouton, la demande confirmée,<br />
                Et si bien sûr tout s'est parfaitement déroulé<br />
                Pas le choix, il faudra te reconnecter ...<br />
            </p>
        </div>
                <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-lg-auto mx-3 bg-light pb-5 shadow rounded">
                <form method="post" action="index.php">
                       <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-3 pb-2">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe actuel" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-3 pb-2">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" name="new_password_1" placeholder="Nouveau mot de passe" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-3 pb-2">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" name="new_password_2" placeholder="Nouveau mot de passe ... deuxième !" required />
                        </div>
                    </div>
                    <br />
                    <div class="form-group text-center">
                    	<button class="btn btn-info btn-l" type="submit">Je confirme le changement</button>
                    </div>
                </form>
                <br />
                <div class="text-center">
                	<a href="index.php?action=profile"><button class="btn btn-danger btn-l">Je n'aime pas les alexandrins, alors j'annule</button></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--
<h2 class="center">Modification de ton mot de passe</h2>

<form method="post" action="index.php">
	<p class="center">
		C'est une excellente initiative !
	</p>
	<p>
		Saisis ton mot de passe actuel :<br />
		<input type="password" name="password" required />
	</p>

	<p>
		Saisis ton nouveau mot de passe :<br />
		<input type="password" name="new_password_1" required /><br />
		<em>(Attention : il doit absolument être composé de 8 à 16 caractères et contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.)</em>
	</p>
	<p>
		Saisis-le une deuxième fois (on n'est jamais trop prudent) :<br />
		<input type="password" name="new_password_2" required />
	</p>
	<p class="center">
		Attention, cher abonné :<br />
		Une fois ton changement validé,<br />
		Et si tout s'est bien passé<br />
		Il faudra te reconnecter ...<br />
	</p>
	<p class="center">
		<button type="submit">Valider</button>
	</p>

</form>
<p class="center">
	<a href="index.php?action=profile"><button>Annuler</button></a>
</p>-->
<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>