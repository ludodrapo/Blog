<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container">
        <div class="row justify-content-center pt-lg-5 pt-3">
            <div class="col-lg-10 pt-4 mb-3 mx-3 bg-white shadow rounded">
                <h2 class="text-secondary text-uppercase mb-3"><?php echo htmlspecialchars($post_details['title'])?></h2>
                <p>
                    <em>Ecrit par <?php echo htmlspecialchars($post_details['login_name'])?> le <?php echo htmlspecialchars($post_details['date'])?> et mis à jour le <?php echo htmlspecialchars($post_details['update_date'])?>.</em>
                </p>
                <p>
                    <strong><?php echo nl2br(htmlspecialchars($post_details['lead']))?></strong>
                </p>
                <div class="tiny-content" class="mb-5">
                    <?php echo htmlspecialchars_decode($post_details['content'])?><br />
                </div>
            </div>

            <div class="col-lg-10 mt-3">
                <h4>Commentaires <i class="far fa-comments"></i></h4>
            </div>
<?php
while ($comment = $comments->fetch()) {
    ?>
            <div class="col-lg-10">
                <p class="mb-3">
                    <em><?php echo htmlspecialchars($comment['login_name'])?>, le <?php echo htmlspecialchars($comment['date'])?> à <?php echo htmlspecialchars($comment['time'])?> :</em><br />"<?php echo htmlspecialchars($comment['comment'])?>".
                </p>
            </div>
    <?php
}
$comments->closeCursor();
?>

<?php
if (isset($_SESSION['login_name'])) {
    ?>
            <div class="col-lg-10 m-3 bg-white rounded shadow">
                <form method="post" action="index.php?action=addComment&amp;post_id=<?php echo strip_tags($post_details['post_id'])?>">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pt-3">
                            <label>Ton commentaire ...</label>
                            <textarea class="form-control" name="comment" rows="5" placeholder="Ton commentaire ..." required ></textarea>
                        </div>
                    </div>
                    <br />
                    <div class="form-group text-center">
                        <button class="btn btn-info btn-l" type="submit">Soumettre</button>
                    </div>
                </form>
            </div>
    <?php
} else {
        ?>
            <div class="col-lg-10">
                <p class="mb-3">
                    <em>Si tu souhaites ajouter un commentaire, tu dois être inscrit(e) et connecté(e). En plus, c'est super simple, il suffit de <a href="index.php?action=goToLogin">cliquer ici</a> !</em>
                </p>
            </div>
    <?php
    }
?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
