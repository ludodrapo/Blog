<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container mt-5">
                <!-- Contact Section Heading-->
        <h3 class="text-center text-uppercase text-secondary mb-0">Vérification d'identité</h3>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-lock"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-lg-auto mx-3 bg-white p-5 shadow rounded">
                <form method="post" action="index.php?action=accessAdmin" class="was-validated">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>MDP admin</label>
                            <input type="password" class="form-control" name="password" placeholder="MDP admin" required />
                        </div>
                    </div>
                    <br />
                    <div class="form-group text-center">
                    	<button class="btn btn-info btn-l" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
