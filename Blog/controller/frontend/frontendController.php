<?php

session_start();

require_once('models/frontend/frontendPostsManager.php');
require_once('models/frontend/frontendCommentsManager.php');
require_once('models/frontend/frontendUsersManager.php');

//////////////////////
// POSTS FUNCTIONS //
////////////////////

function displayLastPosts()
{
	$last_posts = new PostsManager();
	$listed_last_posts = $last_posts->listLastPosts();

	require('views/frontend/frontendHomepage.php');
}

function displayAllPosts()
{
	$all_posts = new PostsManager();
	$listed_all_posts = $all_posts->listAllPosts();
	
	require('views/frontend/frontendListAllPosts.php');
}

function displayPostAndComments($post_id)
{
	$post = new PostsManager();
	$comments = new CommentsManager();
	$post_details = $post->getPostDetails($post_id);
	$all_comments = $comments->getPostComments($post_id);
	if (empty($post_details))
	{
		throw new Exception("Cet article n'existe pas (ou plus), désolé.", 1);	
	}
	else
	{
		require('views/frontend/frontendPostAndComments.php');
	}
}

/////////////////////////
// COMMENTS FUNCTIONS //
///////////////////////

function countUserComments($user_id)
{
	$comments_count = new CommentsManager();
	$count = $comments_count->getUserCommentsCount($user_id);
	if ($count === false)
	{
		throw new Exception("Impossible de récupérer le nombre de commentaires.", 1);
	}
	else
	{
		require('views/frontend/frontendProfile.php');
	}
}

function addComment($user_id, $post_id, $comment)
{
	$comment_to_add = new CommentsManager();
	$added_comment = $comment_to_add->addComment($user_id, $post_id, $comment);
	if ($added_comment === false) {
		throw new Exception("Impossible d'ajouter votre commentaire, désolé !", 1);
	}
	else
	{
		require('views/frontend/frontendThanksComment.php');
	}
}

//////////////////////
// USERS FUNCTIONS //
////////////////////

function addNewUser($new_login_name, $new_password_1, $new_password_2, $new_email)
{
	$new_user = new UsersManager();
	//first, we check if the login already exists with the function above
	$password_data = $new_user->getUserPassword($new_login_name);

	if (!empty($password_data))
	{
		throw new Exception('Malheureusement ce login_name existe déjà, désolé.<br />Pour revenir sur la page d\'accueil et essayer un autre login_name <a href="index.php?action=login">cliquez ici</a>.');
			//<br /> Si vous avez oublié votre mot de passe, vous pouvez le réinitialiser <a href="">en cliquant ici</a>. (To add when the function initialize password is available)
	}

	elseif (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $new_password_1))
	{
		throw new Exception('Le mot de passe ne respecte pas les critères nécessaires (entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial. Merci de bien vouloir en taper un nouveau <a href="index.php?action=login">en cliquant ici</a>.');
	}
	elseif ($new_password_1 != $new_password_2)
	{
		throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. Pour recommencer <a href="index.php?action=login">cliquez ici</a>.');
	}
	elseif (!preg_match('#^[0-9a-z._-]+@[a-z0-9.-_]{2,}\.[a-z]{2,4}$#', $new_email))
	{
		//equal (!filter_var($new_email, FILTER_VALIDATE_EMAIL)
		throw new Exception("Désolé mais l'adresse mail saisie n'est pas valide. Pour revenir sur l'inscription <a href='index.php?action=login'>cliquez ici</a>.");
	}
	else
	{
		$new_password = password_hash($new_password_1, PASSWORD_DEFAULT);

		$added_user = $new_user->recordNewUser($new_login_name, $new_password, $new_email);

		if ($added_user === false )
		{
			throw new Exception('Une erreur est survenue lors de l\'enregistrement');
		}
		else
		{
			
			require('views/frontend/frontendCongrats.php');
		}
	}
}

function modifyEmail($new_email, $password)
{
	//initializing data
	$user_id = (int)strip_tags(htmlspecialchars($_SESSION['user_id']));
	$new_email = filter_var($new_email, FILTER_SANITIZE_EMAIL);

	$password_to_check = new UsersManager();
	$password_data = $password_to_check->getUserPassword($user_id);
	$checked_password_OK = password_verify($password, $password_data['password']);

	if (!filter_var($new_email, FILTER_VALIDATE_EMAIL))
	{
		throw new Exception("Cette adresse mail n'est pas valide. Pour essayer à nouveau <a href='index.php?action=updateEmail'>cliquez ici</a>", 1);
	}
	elseif (!$checked_password_OK)
	{
		throw new Exception("Vous n'avez pas saisi le bon mot de passe associé à ce pseudo ! Pour essayer à nouveau <a href='index.php?action=updateEmail'>cliquez ici</a>", 1);
	}
	else
	{
		$email_to_modify = new UsersManager();
		$modified_email = $email_to_modify->updateEmail($user_id, $new_email);
		if ($modified_email === false)
		{
			throw new Exception("Une erreur s'est produite, impossible de modifier l'email.", 1);
		}
		else
		{
			$_SESSION['email'] = $new_email;
			countUserComments($user_id);//to get the comments count and go to the profile page
		}
	}
}

function modifyPassword($new_password_1, $new_password_2, $password)
{
	//initializing data
	$user_id = (int)strip_tags(htmlspecialchars($_SESSION['user_id']));

	$password_to_check = new UsersManager();
	$password_data = $password_to_check->getUserPassword($user_id);
	$checked_password_OK = password_verify($password, $password_data['password']);

	if (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $new_password_1))
	{
		throw new Exception('Le mot de passe ne respecte pas les critères nécessaires (entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial. Merci de bien vouloir en taper un nouveau <a href="index.php?action=updatePassword">en cliquant ici</a>.');
	}
	elseif ($new_password_1 != $new_password_2)
	{
		throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. Pour recommencer <a href="index.php?action=updatePassword">clique ici</a>.');
	}
	elseif ($password == $new_password_1)
	{
		throw new Exception("Votre nouveau mot de passe est identique au précédent. Etait-ce vraiment nécessaire ?!", 1);
		
	}
	elseif (!$checked_password_OK)
	{
		throw new Exception("Vous n'avez pas saisi le bon mot de passe associé à ce pseudo ! Pour essayer à nouveau <a href='index.php?action=updatePassword'>clique ici</a>", 1);
	}
	else
	{
		$new_password = password_hash($new_password_1, PASSWORD_DEFAULT);
		$password_to_modify = new UsersManager();
		$modified_password = $password_to_modify->updatePassword($user_id, $new_password);
		if ($modified_email === false)
		{
			throw new Exception("Une erreur s'est produite, impossible de modifier le mot de passe.", 1);
		}
		else
		{
			logout();
		}
	}
}

////////////////////////
// SESSION FUNCTIONS //
//////////////////////

function login($login_name, $password)
{
	$user = new UsersManager();
	$password_data = $user->getUserPassword($login_name);
	$password_ok = password_verify($password, $password_data['password']);
	$active_data = $user->getUserIsActive($login_name);
	$user_data = $user->getUserData($login_name);
	if (empty($password_data))
	{
		throw new Exception('Nous n\'avons pas reconnu votre pseudo, <a href="index.php?action=login">cliquez ici</a> que vous souhaitiez réessayer ou créer un compte.');
	}
	elseif ($active_data['is_active'] = 0)
	{
		throw new Exception("Ce compte a été désactivé, merci de nous contacter via le formulaire du site si besoin.", 1);
	}
	elseif (!$password_ok)
	{
		throw new Exception('Vous n\'avez pas saisi le bon mot de passe associé à ce pseudo ! Pour essayer à nouveau <a href="index.php?action=login">cliquez ici</a>', 1);
	}
	else
	{
		$_SESSION['login_name'] = $login_name;
		$_SESSION['user_id'] = (int)$user_data['user_id'];
		$_SESSION['profile'] = $user_data['profile'];
		$_SESSION['email'] = $user_data['email'];
		$_SESSION['registration_date'] = $user_data['registration_date'];

		displayLastPosts();
	}	
}

function logout()
{
	session_unset();
	session_destroy();
	displayLastPosts();
}

function goToAdmin($password)
{
	$login_name = htmlspecialchars($_SESSION['login_name']);
	$user = new UsersManager();
	$password_data = $user->getUserPassword($login_name);
	$password_ok = password_verify($password, $password_data['password']);

	if (!$password_ok)
	{
		throw new Exception("Vous n'avez pas saisi le bon mot de passe associé à ce pseudo ! L'accés à la partie administration n'est pas autorisé<br /><a href='index.php'>Revenir au site</a>", 1);
	}
	else
	{	
		header('location:backendIndex.php');
	}
}


