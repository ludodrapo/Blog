<?php session_start(); ?>

<?php ob_start(); ?>

<section>
    <div class="container my-5 pt-5">
        <div class="row justify-content-center pt-lg-5 pt-3">
            <div class="col-lg-8">
                <h2 class="text-secondary text-center text-uppercase mb-3">Message important</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-thumbs-up"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="bg-light rounded shadow text-center my-5 py-5">
                    <p>
                        Ton commentaire a bien été envoyé, <?php echo htmlspecialchars($_SESSION['login_name'])?>.<br />
                        Il sera visible par tous dès qu'il aura été validé.
                        <br />Merci pour ta contribution à ce blog.
                    </p>
                </div>
                <div class="text-center mt-5">
                    <a class="btn btn-l btn-info" href="index.php?action=displayPostAndComments&amp;post_id=<?php echo strip_tags($post_id)?>">Je reviens sur l'article que je lisais</a>
                </div>

                <div class="text-center mt-5">
                    <a class="btn btn-l btn-info" href="index.php">Non finalement je repars vers l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
