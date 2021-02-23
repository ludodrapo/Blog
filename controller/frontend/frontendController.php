<?php

session_start();

require_once 'models/frontend/frontendPostsManager.php';
require_once 'models/frontend/frontendCommentsManager.php';
require_once 'models/frontend/frontendUsersManager.php';

  /////////////////////
 // POSTS FUNCTIONS //
/////////////////////

function displayLastPosts(): void
{
    $last_posts = new PostsManager();
    $last_posts = $last_posts->listLastPosts();
    include 'views/frontend/frontendHomepage.php';
}

function displayAllPosts(): void
{
    $all_posts = new PostsManager();
    $all_posts = $all_posts->listAllPosts();
    include 'views/frontend/frontendListAllPosts.php';
}

function displayPostAndComments($post_id): void
{
    $post = new PostsManager();
    $comments = new CommentsManager();
    $post_details = $post->getPostDetails($post_id);
    $comments = $comments->getPostComments($post_id);

    if (empty($post_details)) {
        throw new Exception("Cet article n'existe pas (ou plus), désolé.", 1);
    }
    include 'views/frontend/frontendPostAndComments.php';
}

  ////////////////////////
 // COMMENTS FUNCTIONS //
////////////////////////

function countUserComments($user_id): void
{
    $comments_count = new CommentsManager();
    $count = $comments_count->getUserCommentsCount($user_id);
    if ($count === false) {
        throw new Exception('Impossible de récupérer le nombre de commentaires.', 1);
    }
    include 'views/frontend/frontendProfile.php';
}

function addComment($user_id, $post_id, $comment): void
{
    $comment_to_add = new CommentsManager();
    $added_comment = $comment_to_add->addComment($user_id, $post_id, $comment);
    if ($added_comment === false) {
        throw new Exception("Une erreur est survenue. Impossible d'ajouter ton commentaire, désolé.", 1);
    }
    $email = Manager::ADMIN_EMAIL;
    $subject = 'Nouveau commentaire';
    $body = "Un nouveau commentaire en attente de validation vient d'être laissé sur le blog :\n\n\"${comment}\"\n\n";
    $headers = "From: noreply@leblogdeludo.com\n";
    if (!mail($email, $subject, $body, $headers)) {
        throw new Exception("Impossible d'avertir l'administrateur du site pour validation du commentaire.", 1);
    }
    include 'views/frontend/frontendThanksComment.php';
}

  /////////////////////
 // USERS FUNCTIONS //
/////////////////////

function addNewUser($new_login_name, $new_password_1, $new_password_2, $new_email): void
{
    $new_user = new UsersManager();
    $user_data = $new_user->getUserData($new_login_name);
    if (!empty($user_data)) {
        throw new Exception('Malheureusement ce pseudo existe déjà, désolé.<br />Pour revenir sur la page d\'accueil et essayer un autre login_name <a href="index.php?action=goToLogin">cliquez ici</a>.');
    }
    if (strlen($new_login_name) > 16) {
        throw new Exception('Ce pseudo dépasse les 16 caractères, peut-être est-il possible de le raccourcir un peu, non ?', 1);
    }
    if (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $new_password_1)) {
        throw new Exception('Le mot de passe ne respecte pas les critères nécessaires (entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial. Merci de bien vouloir en taper un nouveau <a href="index.php?action=goToLogin">en cliquant ici</a>.');
    }
    if ($new_password_1 != $new_password_2) {
        throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. Pour recommencer <a href="index.php?action=goToLogin">cliquez ici</a>.');
    }
    if (!preg_match('#^[0-9a-z._-]+@[a-z0-9.-_]{2,}\.[a-z]{2,4}$#', $new_email)) {
        //equal (!filter_var($new_email, FILTER_VALIDATE_EMAIL)
        throw new Exception("Désolé mais l'adresse mail saisie n'est pas valide. Pour revenir sur l'inscription <a href='index.php?action=goToLogin'>cliquez ici</a>.");
    }
    $new_password = password_hash($new_password_1, PASSWORD_DEFAULT);
    $added_user = $new_user->recordNewUser($new_login_name, $new_password, $new_email);

    if ($added_user === false) {
        throw new Exception('Une erreur est survenue lors de l\'enregistrement');
    }
    include 'views/frontend/frontendCongrats.php';
}

function modifyEmail($new_email, $password): void
{
    $user_id = (int) strip_tags($_SESSION['user_id']);
    $new_email = filter_var($new_email, FILTER_SANITIZE_EMAIL);

    $user = new UsersManager();
    $user_data = $user->getUserData($user_id);
    $checked_password_OK = password_verify($password, $user_data['password']);

    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Cette adresse mail n'est pas valide. Pour essayer à nouveau <a href='index.php?action=goToUpdateEmail'>cliquez ici</a>", 1);
    }
    if (!$checked_password_OK) {
        throw new Exception("Le mot de passe actuel saisi n'est pas celui associé à ce pseudo ! Pour essayer à nouveau <a href='index.php?action=goToUpdateEmail'>cliquez ici</a>", 1);
    }

    $email_to_modify = new UsersManager();
    $modified_email = $email_to_modify->updateEmail($user_id, $new_email);
    if ($modified_email === false) {
        throw new Exception("Une erreur s'est produite, impossible de modifier l'email.", 1);
    }
    $_SESSION['email'] = $new_email;
    countUserComments($user_id);//to get the comments count and go to the profile page
}

function modifyPassword($new_password_1, $new_password_2, $password): void
{
    $user_id = (int) strip_tags($_SESSION['user_id']);
    $user = new UsersManager();
    $user_data = $user->getUserData($user_id);
    $checked_password_OK = password_verify($password, $user_data['password']);

    if (!$checked_password_OK) {
        throw new Exception("Le mot de passe saisi n'est pas celui associé à ce pseudo. Pour essayer à nouveau <a href='index.php?action=goToUpdatePassword'>clique ici</a>", 1);
    }
    if (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $new_password_1)) {
        throw new Exception('Le mot de passe ne respecte pas les critères nécessaires (entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial. Merci de bien vouloir en taper un nouveau <a href="index.php?action=goToUpdatePassword">en cliquant ici</a>.');
    }
    if ($new_password_1 != $new_password_2) {
        throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. Pour recommencer <a href="index.php?action=goToUpdatePassword">clique ici</a>.');
    }
    if ($password == $new_password_1) {
        throw new Exception('Ce mot de passe est identique au précédent. Etait-ce vraiment nécessaire ?!', 1);
    }
    $new_password = password_hash($new_password_1, PASSWORD_DEFAULT);
    $password_to_modify = new UsersManager();
    $modified_password = $password_to_modify->updatePassword($user_id, $new_password);
    if ($modified_email === false) {
        throw new Exception("Une erreur s'est produite, impossible de modifier le mot de passe.", 1);
    }
    logout();
}

  ///////////////////////
 // SESSION FUNCTIONS //
///////////////////////

function login($login_name, $password): void
{
    $user = new UsersManager();
    $user_data = $user->getUserData($login_name);
    $password_ok = password_verify($password, $user_data['password']);
    if (empty($user_data)) {
        throw new Exception("Nous n'avons pas reconnu ton pseudo,<a href='index.php?action=goToLogin'> clique ici</a> que tu souhaites réessayer ou bien créer un compte.");
    }
    if ($user_data['is_active'] === 0) {
        throw new Exception('Ce compte a été désactivé,<br /> merci de nous contacter via le formulaire du site si besoin.', 1);
    }
    if (!$password_ok) {
        throw new Exception("Le mot de passe saisi n'est pas celui associé à ce pseudo.", 1);
    }
    $_SESSION['login_name'] = $login_name;
    $_SESSION['user_id'] = (int) $user_data['user_id'];
    $_SESSION['profile'] = $user_data['profile'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['registration_date'] = $user_data['registration_date'];
    displayLastPosts();//to get the last posts and go to the homepage
}

function logout(): void
{
    session_unset();
    session_destroy();
    include 'views/frontend/frontendLogin.php';
}

function goToAdmin($password): void
{
    $login_name = strip_tags($_SESSION['login_name']);
    $user = new UsersManager();
    $user_data = $user->getUserData($login_name);
    $password_ok = password_verify($password, $user_data['password']);

    if (!$password_ok) {
        throw new Exception("Le mot de passe saisi n'est pas celui associé au compte administrateur. L'accés à la partie administration n'est donc pas autorisé.", 1);
    }
    header('location:backendIndex.php');
}

  ////////////////////
 // MAIL FUNCTIONS //
////////////////////

function contactMail($name, $email, $message): void
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("L'adresse mail renseignée n'est pas valide.", 1);
    }
    $email = Manager::ADMIN_EMAIL;
    $subject = "Blog Contact Form : ${name}";
    $body = "On a reçu un message de la part de ${name} depuis le formulaire du blog.\n\nVoici le message :\n${message}";
    $headers = "From: noreply@leblogdeludo.com\n";
    $headers .= "Reply-To: ${email}";

    if (!mail($email, $subject, $body, $headers)) {
        throw new Exception("Impossible d'envoyer le message.", 1);
    }
    include 'views/frontend/frontendThanksMail.php';
}
