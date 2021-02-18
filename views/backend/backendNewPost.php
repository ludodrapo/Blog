<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container mt-lg-5 mt-4">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Nouvel article</h2>
                        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-rss"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                        <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-10 mx-lg-auto mx-3 mb-0 p-3 bg-white shadow">
                <form method="post" action="backendIndex.php?action=addPost" class="center mb-3">
                    <div class="form-group">
                        <h4>Titre de l'article</h4>
                        <textarea type="text" class="form-control" name="title" required rows="1" cols="30" placeholder="Genre un gimmick, une phrase choc !"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>Lead</h4>
                        <textarea type="text" class="form-control" name="lead" required rows="5" cols="30" placeholder="Chapô en français ... pour donner envie de tout lire"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>Contenu de l'article</h4>
                        <textarea id="editor" name="content" placeholder="Du fond, du sens, et du rythme ..."></textarea>
                    </div>
                    <div class="form-group">
                        <h4>Catégorie de l'article</h4>
                        <input type="text" class="form-control" name="category" required rows="1" cols="30" placeholder="En pensant à un éventuel tri plus tard ... "></textarea>
                    </div>
                    <br />
                    <div class="text-center">
                        <button class="btn btn-l btn-info" type="submit">Enregistrer</button>
                    </div>
                </form>
                <div class="text-center pt-3 mb-5">
                    <p>
                        <a class="btn btn-l btn-danger" href="backendIndex.php?action=displayAllPosts">Annuler</a>
                    </p>
                </div>

                <h4>Télécharger un visuel</h4>
                <p>
                    Taille maximum autorisée : 500 Ko.<br />
                    Format idéal : 16/9 et 1600px en résolution.
                </p>
                <form method="post" action="backendIndex.php?action=uploadImage" enctype="multipart/form-data" class="mb-5">
                    <div class="form-group">
                        <input class="form-control" type="file" name="image_to_upload" required />
                    </div>
                    <br />
                    <div class="text-center">
                        <button class="btn btn-l btn-info" type="submit">Envoyer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'backendTemplate.php'; ?>
