<?php session_start(); ?>

<?php ob_start(); ?>


<section class="page-section portfolio">
    <div class="container mt-lg-5 mt-4">
                <!-- Portfolio Section Heading-->
        <h2 class="text-center text-uppercase text-secondary mb-0">Tous les articles</h2>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="far fa-newspaper"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">

<?php
while ($post = $all_posts->fetch()) {
    if (!isset($post['comments_count'])) {
        $post['comments_count'] = 0;
    } ?>
            <!-- Post -->
        
            <div class="col-md-6 col-xl-4 mb-5">
                <div class="portfolio-item mx-auto bg-white shadow">
                    <a href="index.php?action=displayPostAndComments&amp;post_id=<?php echo strip_tags($post['post_id'])?>">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                           <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-5x"></i></div>
                        </div>
                    </a>
                    <div class="p-3 pt-4">
                        <div>
                            <h4 class="text-center text-uppercase"><?php echo htmlspecialchars($post['title'])?></h4>
                        </div>
                        <div>
                            <p>
                                <em>Ecrit par <?php echo htmlspecialchars($post['login_name'])?>, le <?php echo htmlspecialchars($post['date'])?> et mis à jour le <?php echo htmlspecialchars($post['update_date'])?>, cet article a suscité <?php echo htmlspecialchars($post['comments_count'])?> commentaire(s) validé(s).</em>
                            </p>
                        </div>
                        <div class="lead">
                            <p>
                                <?php echo htmlspecialchars($post['lead'])?><br />
                            </p>
                        </div>
                        <div class="tiny-content">
                            <p>
                                <?php echo substr(htmlspecialchars_decode($post['content']), 0, 96) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

    <?php
}
$all_posts->closeCursor();
?>

        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/frontend/frontendTemplate.php'; ?>
