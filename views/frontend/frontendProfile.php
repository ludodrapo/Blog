<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container">
        <div class="row justify-content-center pt-lg-5 pt-3">
            <div class="col-lg-8">
                <h2 class="text-secondary text-center text-uppercase mb-3">Profil</h2>
                <div class="divider-custom mb-5">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-user-circle"></i></div>
                    <div class="divider-custom-line"></div>
                </div>

<?php
if ($_SESSION['profile'] !== 'administrator') {
    if ($count['comments_count'] > 0) {
        ?>
                <div class="bg-white mt-3 mb-5 p-4 shadow rounded">
                    <h3 class="text-secondary mb-3">Le blog et toi</h3>

                    <p>
                        Tu as déjà fait <?=htmlspecialchars($count['comments_count'])?> commentaire(s) validés ou en attente de validation, à propos de <?=htmlspecialchars($count['posts_count'])?> article(s). Merci <?=htmlspecialchars($_SESSION['login_name'])?> pour ta participation à la vie de ce blog. C'est super !
                    </p>
                </div>
        <?php
    } else {
        ?>
                <div class="bg-white mt-3 mb-5 p-4 shadow rounded">
                    <h3 class="text-secondary mb-3">Le blog et toi</h3>

                    <p>
                        Tu n'as pas encore posté de commentaire sur notre blog depuis ton inscription le <?=htmlspecialchars($_SESSION['registration_date'])?>, <?=htmlspecialchars($_SESSION['login_name'])?> ... N'hésite surtout pas à te lancer, nous sommes très gentils.
                    </p>
                </div>
                

        <?php
    }
}
        ?>
                <div class="bg-white my-3 p-4 shadow rounded">
                    <h3 class="text-secondary mb-3">Mettre à jour ton profil</h3>
                    <br />
                    <p>
                        Ton adresse de contact est actuellement : <?=htmlspecialchars($_SESSION['email'])?>.
                    </p>
                    <div class="text-center my-5">
                        <a class="btn btn-l btn-info" href="index.php?action=goToUpdateEmail">Je modifie mon adresse email</a>
                    </div>
                    <p>
                        Il est important de changer régulièrement son mot de passe.<br />N'hésite pas à le faire dès que tu peux ...
                    </p>
                    <div class="text-center my-5">
                        <a class="btn btn-l btn-info" href="index.php?action=goToUpdatePassword">Je change mon mot de passe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
