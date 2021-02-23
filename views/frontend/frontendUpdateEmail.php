<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section portfolio">
    <div class="container mt-lg-5 mt-4">
                <!-- Contact Section Heading-->
        <h3 class="text-center text-uppercase text-secondary mb-0">Modification de ton adresse mail de contact</h3>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-envelope"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-lg-auto mx-3 bg-white pb-5 shadow rounded">
                <form method="post" action="index.php?action=updateEmail" class="was-validated p-3">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-3 pb-2">
                            <label>Nouvel email</label>
                            <input class="form-control" name="new_email" type="email" placeholder="Nouvelle adresse mail" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-3 pb-2">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe actuel" required />
                        </div>
                    </div>
                    <br />
                    <div class="form-group text-center">
                        <button class="btn btn-info btn-l" type="submit"><i class="fas fa-thumbs-up"></i> Je confirme le changement</button>
                    </div>
                </form>
                <br />
                <div class="text-center">
                    <a href="index.php?action=profile"><button class="btn btn-danger btn-l"><i class="fas fa-thumbs-down"></i> Non, finalement, non.</button></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
