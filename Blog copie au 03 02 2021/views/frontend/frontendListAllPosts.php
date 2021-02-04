<?php session_start(); ?>

<?php ob_start(); ?>


<section class="page-section bg-light portfolio">
    <div class="container mt-lg-5 mt-4">
                <!-- Portfolio Section Heading-->
        <h2 class="text-center text-uppercase text-secondary mb-0">Tous les articles</h2>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-rss"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">

<?php
while ($post = $listed_all_posts->fetch())
{
	if (empty($post['comments_count']))
	{
		$post['comments_count'] = 0;
	}
?>
            <!-- Post -->
        
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto shadow">
                    <a href="index.php?action=displayPostAndComments&amp;post_id=<?=$post['post_id']?>">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                    	   <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                    </a>
                    <div class="p-3">
	                    <div>
	                    	<p>
								<h4><?=htmlspecialchars($post['title'])?></h4>
							</p>
						</div>

						<p>
							<em>Ecrit par <?=htmlspecialchars($post['login_name'])?>, le <?=htmlspecialchars($post['date'])?> et mis à jour le <?=htmlspecialchars($post['update_date'])?>, cet article a suscité <?=htmlspecialchars($post['comments_count'])?> commentaire(s) validé(s).</em>
						</p>

						<p class="lead">
							<?= htmlspecialchars($post['lead'])?><br />
						</p>
					</div>
                </div>
            </div>

<?php
}
$listed_all_posts->closeCursor();
?>

		</div>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>