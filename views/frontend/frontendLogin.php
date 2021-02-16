<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container mt-3 mt-lg-5">
<!-- login form -->
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-3 mb-5">
                <div class="portfolio-item mx-auto bg-white p-4 shadow rounded">
                    <h4 class="text-center text-uppercase text-secondary">Déjà membre ?<br />Tu peux te connecter : </h4>
            <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-user"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <form method="post" action="index.php?action=login" class="was-validated">
                        <div class="control-group">
            	            <div class="form-group floating-label-form-group controls mb-3 pb-2">
                                <label>Pseudo</label>
                                <input class="form-control" name="login_name" type="text" placeholder="Pseudo" required />
                            </div>
                        </div>
                        <div class="control-group">
                             <div class="form-group floating-label-form-group controls mb-3 pb-2">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
                            </div>
                        </div>
                        <br />
                        <div class="control-group">
                            <div class="form-group text-center">
                                <button class="btn btn-info btn-l" type="submit">Valider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      

    <!-- sign in form -->

            <div class="col-lg-6 mt-3">
                <div class="portfolio-item mx-auto bg-white p-4 shadow rounded">
                    <h4 class="text-center text-uppercase text-secondary mb-0">Pas encore inscrit ?<br />Tu y es presque ...</h4>
                            <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-user-plus"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <form method="post" action="index.php?action=signin" class="was-validated">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Pseudo</label>
                                <input class="form-control" name="new_login_name" type="text" placeholder="Un pseudo qui te ressemble" required />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" name="new_password_1" placeholder="Un mot de passe sûr" required />
                                <p class="help-block text-info">Attention : par sécurité, le mot de passe doit être composé d'entre 8 et 16 caractères et contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" name="new_password_2" placeholder="Le même mot de passe" required />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Email</label>
                                <input class="form-control" name="new_email" type="email" placeholder="Ton email de contact" required />
                            </div>
                        </div>
                        <br />
                        <div class="form-group text-center"><button class="btn btn-info btn-l" id="sendMessageButton" type="submit">Valider</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>
