<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container">
        <div class="row justify-content-center pt-lg-5 pt-3">
            <div class="col-lg-8">
                <h2 class="text-secondary text-center text-uppercase mb-3">
                Message important</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="bg-white rounded shadow m-4 mb-5 p-3">
<?php
if (!isset($_SESSION['login_name'])) {
    ?>
                    <p>
                        Merci pour ton mail, cher(e) lecteur/lectrice,
                        il a bien été envoyé.
                    </p>
                    <p>
                        J'essaie de répondre le plus rapidement possible
                        mais sans réponse dans les 15 jours,
                        il se peut que l'adresse saisie ne soit pas la bonne
                        donc il ne faut pas hésiter à me recontacter.
                    </p>

    <?php
} elseif (isset($_SESSION['login_name'])) {
        ?>
                    <p>
                        Merci pour ton message, 
                        <?php echo htmlspecialchars($_SESSION['login_name'])?>,
                        il a bien été envoyé donc je l'ai en toute logique reçu.
                    </p>
                    <p>
                        J'essaie de répondre le plus rapidement possible
                        mais sans réponse dans les 15 jours,
                        il se peut que j'ai simplement oublié
                        et je te prie d'ores et déjà de bien vouloir m'en excuser
                        ... n'hésite donc pas à me relancer.
                    </p>
    <?php
    } ?>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-l btn-info shadow" href="index.php">
                    Retour à l'accueil</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
