<?php session_start(); ?>

<?php ob_start(); ?>

<header class="masthead bg-info text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <img class="masthead-avatar rounded-circle mb-5" src="public/img/photo_identite_nb.jpeg" alt="photo de Ludo" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">Ludo Drapo</h1>
                <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-laptop"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">Developpeur PHP - Musicien - Retail Manager</p>
    </div>
</header>

<section class="page-section portfolio" id="portfolio">
    <div class="container">
                <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Articles récents</h2>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-rss"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
<?php

while ($post = $last_posts->fetch())
{
	if (empty($post['comments_count']))
	{
		$post['comments_count'] = 0;
	}
?>
            <!-- Post -->
        
            <div class="col-md-6 col-xl-4 mb-5">
                <div class="portfolio-item mx-auto bg-white shadow">
                    <a href="index.php?action=displayPostAndComments&amp;post_id=<?=strip_tags($post['post_id'])?>">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                    	   <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-5x"></i></div>
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
$last_posts->closeCursor();
?>

        </div>
    </div>
</section>

<section class="page-section bg-info text-white mb-0" id="about">
    <div class="container">
                <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">A propos de Ludo</h2>
                <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-code"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-5 ml-auto">
            	<p class="lead">
            		Ex-retail manager et futur développeur web, passionné d'images, de mots et de notes ... Consciencieux, autonome, créatif, réactif, pédagogue et doté d'un très bon relationnel.
            	</p>
            </div>
            <div class="col-lg-5 mr-auto">
            	<p class="lead">
            		Avec Ludo dans votre équipe, vous êtes certain d'avoir quelqu'un sur qui vous pourrez toujours compter et dont l'enthousiasme communicatif illustre l'adage : "On peut être sérieux sans se prendre au sérieux". 
            	</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light" href="index.php?action=goToResume">Tout le CV en détail ...</a>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('views/frontend/frontendTemplate.php'); ?>
