<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section portfolio">
    <div class="container mt-lg-5 mt-4">
                <!-- Contact Section Heading-->
        <h3 class="text-center text-uppercase text-secondary mb-0">Modification de ton mot de passe</h3>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-lock"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="divider-custom">
            <p class="text-center">
                J'attire ici ton attention, cher abonné(e).<br />
                Une fois par le bouton, la demande confirmée,<br />
                Et si bien sûr tout s'est parfaitement déroulé<br />
                Tu n'auras pas le choix, il faudra te reconnecter.<br />
            </p>
        </div>
                <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-lg-auto mx-3 bg-white pb-5 shadow rounded">
                <form method="post" action="index.php?action=updatePassword" class="was-validated p-3">
                       <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-3 pb-2">
                            <label>Mot de passe actuel</label>
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe actuel" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-3 pb-2">
                            <label>Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="new_password_1" placeholder="Nouveau mot de passe" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-3 pb-2">
                            <label>Encore une fois !</label>
                            <input type="password" class="form-control" name="new_password_2" placeholder="Encore une fois !" required />
                        </div>
                    </div>
                    <br />
                    <div class="form-group text-center">
                        <button class="btn btn-info btn-l" type="submit"><i class="fas fa-thumbs-up"></i> Moi j'aime bien quand ça rime<br />Alors oui je confirme !</button>
                    </div>
                </form>
                <br />
                <div class="text-center">
                    <a href="index.php?action=profile"><button class="btn btn-danger btn-l"><i class="fas fa-thumbs-down"></i> Je n'aime pas les quatrains<br />En arrière je reviens</button></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
