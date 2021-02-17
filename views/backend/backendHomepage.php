<?php session_start(); ?>

<section class="page-section">
    <div class="container mt-lg-5 mt-4">
                <!-- Portfolio Section Heading-->
        <h2 class="text-center text-uppercase text-secondary mb-0">Dashboard</h2>
                <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-chart-line"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <div class="row justify-content-center mt-2 mt-lg-5">
            <div class="col-lg-8 mb-5">
                <div class="mx-auto bg-white shadow">
                    <div class="p-3 text-center">
                        <p>
                            Il y a actuellement :
                        </p>
                        <a class="btn btn-info btn-xl mb-3" href="backendIndex.php?action=displayAwaitingComments"><i class="fas fa-comment"></i> <?=strip_tags($awaiting_comments['count'])?></a>
                        <p>
                            <strong>commentaires</strong>
                        </p>
                        <p>
                            en attente de validation.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-5">
                <div class="mx-auto bg-white shadow">
                    <div class="p-3">
                        <h5 class="text-center">Classement des articles par popularité</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th><i class="fas fa-comments"></i></th>
                                </tr>
                            </thead>
                            <tbody>
<?php
while ($post = $posts_ranking->fetch())
{
?>
                                <tr>
                                    <td><?=strip_tags($post['title'])?></td>
                                    <td><?=strip_tags($post['comments_count'])?></td>
                                </tr>
<?php
}
$posts_ranking->closeCursor();
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php $content = ob_get_clean(); ?>

<?php require 'backendTemplate.php'; ?>
