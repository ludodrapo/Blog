<?php session_start(); ?>

<?php ob_start(); ?>

<section class="page-section">
    <div class="container mt-lg-5 mt-4">
                <!-- Portfolio Section Heading-->
        <h2 class="text-center text-uppercase text-secondary mb-0">Articles disponibles</h2>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="far fa-newspaper"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="text-center text-uppercase my-5">
            <p>
                <a class="btn btn-xl btn-info shadow" href="backendIndex.php?action=newPost">Nouvel article</a>
            </p>
        </div>
                <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">

<?php
while ($post = $listed_all_posts->fetch())
{
?>
            <div class="col-md-6 col-xl-4 mb-5">
                <div class="mx-auto bg-white shadow">
                    <div class="equal-height-400 p-3">
                        <p>
                            <h4><?=htmlspecialchars($post['title'])?></h4>
                        </p>
                        <p>
                            <em><?= htmlspecialchars($post['lead'])?></em>
                        </p>
                        <div id="tiny-content">
                            <?= substr(htmlspecialchars_decode($post['content']), 0, 150) ?> ...
                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-6 text-center mb-3">
                                <a class="btn btn-l btn-info" href="backendIndex.php?action=fillUpdatePostPage&amp;post_id=<?=strip_tags($post['post_id'])?>">Modifier</a>
                            </div>
<?php
if ($post['is_ok'] == 1)
{
?>
                            <div class="col-6 text-center mb-3">
                                <a class="btn btn-l btn-danger" href="#" data-toggle="modal" data-target="#deactivatePost">Désactiver</a>
                                <div id="deactivatePost" class="modal">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Sûr de toi ?</h3>
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            <div class="modal-body py-1 px-5">
                                                Attention, tu t'apprêtes à supprimer cet article du blog public où il ne sera donc plus visible.
                                            </div>
                                            <div class="modal-footer p-3">
                                                <div>
                                                    <a class="btn btn-info" class="close" data-dismiss="modal">J'annule</a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-danger" href="backendIndex.php?action=deactivatePost&amp;post_id=<?=strip_tags($post['post_id'])?>">J'assume</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>        
                            </div>
<?php
}
elseif ($post['is_ok'] == 0)
{
?>
                            <div class="col-6 text-center mb-3">
                                <a class="btn btn-l btn-info" href="#" data-toggle="modal" data-target="#activatePost">Activer</a>
                                <div id="activatePost" class="modal">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Sûr de toi ?</h3>
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            <div class="modal-body py-1 px-5">
                                                Attention, tu t'apprêtes à rendre cet article visible sur le blog public.
                                            </div>
                                            <div class="modal-footer p-3">
                                                <div>
                                                    <a class="btn btn-info" class="close" data-dismiss="modal">J'annule</a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-danger" href="backendIndex.php?action=activatePost&amp;post_id=<?=strip_tags($post['post_id'])?>">J'assume</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                     
<?php
}
?>
                        </div>
                    </div>
                </div>                
            </div>
<?php
}
?>
        </div>
    </div>
</section>

<?php $listed_all_posts->closeCursor(); ?>

<?php $content = ob_get_clean(); ?>

<?php require 'backendTemplate.php'; ?>
