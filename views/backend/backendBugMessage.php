<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
	<div class="container">
        <div class="row justify-content-center pt-lg-5 pt-3">
            <div class="col-lg-8">
				<h2 class="text-secondary text-center text-uppercase mb-3">Bon ben ... bug !</h2>
				<div class="divider-custom">
		            <div class="divider-custom-line"></div>
		            <div class="divider-custom-icon"><i class="fas fa-bug"></i></div>
		            <div class="divider-custom-line"></div>
		        </div>
		        <div class="bg-white text-center shadow my-5 pt-4 p-3">
					<p>
						<?=$bug_message?><br />
					</p>
				</div>
				<div class="text-center mt-4">
            		<button class="btn btn-l btn-info shadow" onclick="history.go(-1)">Retour à la page précédente</button>
        		</div>
				<br />
				<div class="text-center mt-4">
            		<a class="btn btn-l btn-info shadow" href="backendIndex.php">Retour à l'accueil</a>
        		</div>
        	</div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'views/backend/backendTemplate.php'; ?>