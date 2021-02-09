<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container mt-lg-5 mt-4">
                <!-- Portfolio Section Heading-->
        <h2 class="text-center text-uppercase text-secondary mb-0">Commentaires en attente de validation</h2>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-comments"></i></div>
            <div class="divider-custom-line"></div>
        </div>
                <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">

<?php
while ($comment = $all_awaiting_comments->fetch())
{
?>
            <div class="col-md-6 col-lg-4 mb-5">
            	<div class="mx-auto shadow">
            		<div class="p-3">
            			<p>
            				Le <?=htmlspecialchars($comment['date'])?> à <?=htmlspecialchars($comment['time'])?>, <strong><?=htmlspecialchars($comment['login_name'])?></strong> à propos de l'article intitulé <strong>"<?=htmlspecialchars($comment['title'])?>"</strong> :
                        </p>
                        <p>
            				<em>"<?=htmlspecialchars($comment['comment'])?>"</em>
                        </p>
                        <div class="container">
                            <div class="row p-3">
                                <div class="col-6 text-center">
                                    <a class="btn btn-info" href="#" data-toggle="modal" data-target="#validateComment">Valider</a>
                                </div>
                                <div id="validateComment" class="modal">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Sûr de toi ?</h3>
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            <div class="modal-body py-1 px-5">
                                                    Attention, tu t'apprêtes à valider le commentaire de <?=htmlspecialchars($comment['login_name'])?>
                                            </div>
                                            <div class="modal-footer p-3">
                                                <div>
                                                    <a class="btn btn-info" class="close" data-dismiss="modal">J'annule</a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-danger" href="backendIndex.php?action=validateComment&amp;comment_id=<?=$comment['comment_id']?>">Je valide</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-center">
                                    <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteComment">Supprimer</a>
                                </div>
                                <div id="deleteComment" class="modal">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Sûr de toi ?</h3>
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            <div class="modal-body py-1 px-5">
                                                    Attention, tu t'apprêtes à supprimer définitivement le commentaire de <?=htmlspecialchars($comment['login_name'])?> ...<br />Un mail automatique va lui être envoyé.
                                            </div>
                                            <div class="modal-footer p-3">
                                                <div>
                                                    <a class="btn btn-info" class="close" data-dismiss="modal">J'annule</a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-danger" href="backendIndex.php?action=deleteComment&amp;comment_id=<?=$comment['comment_id']?>">Compris</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            		</div>
            	</div>
            </div>
<?php
}
$all_awaiting_comments->closeCursor();
?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/backend/backendTemplate.php'); ?>