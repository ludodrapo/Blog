<?php

session_start();

require_once 'models/backend/backendPostsManager.php';
require_once 'models/backend/backendCommentsManager.php';
require_once 'models/backend/backendUsersManager.php';

//////////////////////
// USERS FUNCTIONS //
////////////////////

function displayAllSubscribers(): void
{
    $users = new UsersManager();
    $listed_users = $users->listAllUsers();

    require 'views/backend/backendListAllSubscribers.php';
}

function blockUser($user_id): void
{
    $user_to_block = new UsersManager();
    $user_data = $user_to_block->getUserData($user_id);
    $login_name = $user_data['login_name'];
    $email = $user_data['email'];
    $blocked_user = $user_to_block->deactivateUser($user_id);
    if ($blocked_user === false)
    {
        throw new Exception('Impossible de désactiver ce compte.', 1);
    }

    $subject = "Ton compte \"abonné\" sur le blog de Ludo, ${login_name}";
    $body = "Bonjour ${login_name},\n\nNous tenions à t'avertir par ce mail que ton compte \"abonné\" à notre blog a été bloqué.\n\nSi tu penses qu'il s'agit d'une erreur, n'hésite pas à nous contacter via le formulaire de contact en bas de page du site.\n\nBonne journée,\n\nLudo";
    $headers = "From: noreply@ludodrapo.com\n";

    if(!mail($email, $subject, $body, $headers))
    {
        throw new Exception("Impossible d'envoyer le mail de suspension de compte.", 1);
    }
    displayAllSubscribers();
}

function authorizeUser($user_id): void
{
    $user_to_authorize = new UsersManager();
    $user_data = $user_to_authorize->getUserData($user_id);
    $login_name = $user_data['login_name'];
    $email = $user_data['email'];
    $authorized_user = $user_to_authorize->activateUser($user_id);
    if ($authorized_user === false)
    {
        throw new Exception('Impossible de réactiver ce compte.', 1);   
    }

    $subject = "Ton compte \"abonné\" sur le blog de Ludo, ${login_name}";
    $body = "Bonjour ${login_name},\n\nBonne nouvelle : ton compte a été réactivé !\n\nWelcome back comme ils disent de l'autre côté de l'océan ...\n\nA très vite sur le blog.\n\nLudo.";
    $headers = "From: noreply@ludodrapo.com\n";

    if(!mail($email, $subject, $body, $headers))
    {
        throw new Exception("Impossible d'envoyer le mail de réactivation de compte.", 1);
    }
    displayAllSubscribers();
}

//////////////////////
// POSTS FUNCTIONS //
////////////////////

function displayAllPosts(): void
{
    $all_posts = new PostsManager();
    $listed_all_posts = $all_posts->listAllPosts();
    require 'views/backend/backendListAllPosts.php';
}

function addNewPost($title, $lead, $content, $category): void
{
    $new_post = new PostsManager();
    $added_post = $new_post->addPost($title, $lead, $content, $category);
    if ($added_post === false)
    {
        throw new Exception("Une erreur est survenue. Impossible d'enregistrer l'article.");
    }
    displayAllPosts();
}

function fillUpdatePostPage($post_id): void
{
    $post = new PostsManager();
    $post_details = $post->getPostDetails($post_id);
    require 'views/backend/backendUpdatePost.php';
}

function modifyPost($title, $lead, $content, $category, $post_id): void
{
    $post_to_modify = new PostsManager();
    $modified_post = $post_to_modify->updatePost($title, $lead, $content, $category, $post_id);
    if ($modified_post === false)
    {
        throw new Exception("Une erreur est survenue. Impossible de modifer l'article.", 1);
    }
    displayAllPosts();
}

function activatePost($post_id): void
{
    $post_to_activate = new PostsManager();
    $activated_post = $post_to_activate->activatePost($post_id);
    if ($activated_post === false)
    {
        throw new Exception("Une erreur est survenue. Impossible d'activer l'article..", 1);
    }
    displayAllPosts();
}

function deactivatePost($post_id): void
{
    $post_to_deactivate = new PostsManager();
    $deactivated_post = $post_to_deactivate->deactivatePost($post_id);
    if ($deactivated_post === false)
    {
        throw new Exception("Une erreur est survenue. Impossible de désactiver l'article.", 1);
    }
    displayAllPosts();
}

/////////////////////////
// COMMENTS FUNCTIONS //
///////////////////////

function displayAwaitingComments(): void
{
    $comments = new CommentsManager();
    $awaiting_comments = $comments->getAwaitingComments();

    require 'views/backend/backendValidateComments.php';
}

function validateComment($comment_id): void
{
    $comment_to_validate = new CommentsManager();
    $validated_comment = $comment_to_validate->validateComment($comment_id);

    if ($validated_comment === false)
    {
        throw new Exception('Une erreur est survenue. Impossible de valider ce commentaire.', 1);
    }
    displayAwaitingComments();
}

function deleteComment($comment_id): void
{
    $comment_to_delete = new CommentsManager();
    $comment_user_data = $comment_to_delete->getCommentUserData($comment_id);
    $login_name = $comment_user_data['login_name'];
    $email = $comment_user_data['email'];
    $comment = wordwrap($comment_user_data['comment'], 70);//to limit length of lines in the email
    $deleted_comment = $comment_to_delete->deleteComment($comment_id);

    if ($deleted_comment === false)
    {
        throw new Exception('Une erreur est survenue. Impossible de supprimer ce commentaire.', 1);
    }

    $subject = "Ton commentaire sur le blog de Ludo, ${login_name}";
    $body = "Bonjour ${login_name},\nTu as laissé ce commentaire sur notre site :\n\n\"${comment}\"\n\nCelui-ci n'a pas été accepté par notre modérateur et a été supprimé.\nMerci de ta compréhension,\nLudo";
    $headers = "From: noreply@ludodrapo.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.

    if(!mail($email, $subject, $body, $headers))
    {
        throw new Exception("Impossible d'envoyer le message.", 1);
    }
    displayAwaitingComments();
}

  ////////////////////////
 // HOMEPAGE FUNCTIONS //
////////////////////////

function fillBackendHomepage(): void
{
    $comments = new CommentsManager();
    $posts = new PostsManager();
    $awaiting_comments = $comments->countAwaitingComments();
    $posts_ranking = $posts->getPostsRanking();

    require 'views/backend/backendHomepage.php';
}

  ////////////
 // UPLOAD //
////////////

function uploadImage(): void
{
    $target_dir = '/Users/ludo/Sites/localhost/coursphp/Blog/public/img/uploads/';
    $target_file = $target_dir . basename($_FILES['image_to_upload']['name']);
    $image_data = pathinfo($_FILES['image_to_upload']['name']);
    $image_type = $image_data['extension'];
    $extensions_ok = array('jpeg','jpg','png','gif');

    if (file_exists($target_file))
    {
        throw new Exception('Un fichier portant le même nom existe déjà, merci de renommer le fichier avant de le télécharger.', 1);
    }
    if ($_FILES['image_to_upload']['size'] > 500000)
    {
        throw new Exception('La taille du fichier dépasse les 5 Mo et ne peut donc être transféré.', 1);
    }
    if (!in_array($image_type, $extensions_ok))
    {
        throw new Exception("Les seuls types d'images autorisés sont : jpeg, jpg, png et gif.", 1);
    }
    if (move_uploaded_file($_FILES['image_to_upload']['tmp_name'], $target_file))
    {
        $congrats_message = 'Tout a bien fonctionné et le visuel peut maintenant être inséré. Attention, son nom de fichier est :<br />' . $_FILES['image_to_upload']['name'];
        require 'views/backend/backendCongrats.php';
    }
    else
    {
        throw new Exception("Une erreur est survenue et le fichier n'a pas pu être sauvegardé.", 1);
    }
}
