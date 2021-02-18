<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container">
        <div class="row justify-content-center pt-lg-5 pt-3">
            <div class="col-lg-8">
                <h2 class="text-secondary text-center text-uppercase mb-3">Bienvenue !</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-thumbs-up"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="bg-white rounded shadow text-center my-5 py-5">
                    <p>
                        Ton compte a bien été créé, félicitations <?=htmlspecialchars($_SESSION['login_name'])?>.<br />
                        Nous sommes super contents de t'accueillir à bord.<br />
                        Bonne lecture et bons commentaires !<br />
                        Et sincèrement, merci pour ton inscription.<br />
                        Il ne te reste plus maintenant qu'à te connecter ...
                    </p>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-l btn-info" href="index.php?action=goToLogin">C'est parti, je me connecte !</a>
                </div>

                <div class="text-center mt-4">
                    <a class="btn btn-l btn-info" href="index.php">Ben plus tard, parce là, j'ai piscine.</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
