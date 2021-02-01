<?php

session_start();

require_once('models/backend/backendPostsManager.php');
require_once('models/backend/backendCommentsManager.php');
require_once('models/backend/backendUsersManager.php');

//////////////////////
// USERS FUNCTIONS //
////////////////////

function displayAllSubscribers()
{
	$users = new UsersManager();
	$listed_all_users = $users->listAllUsers();

	require('views/backend/backendListAllSubscribers.php');
}

function blockUser($user_id)
{
	$user_to_block = new UsersManager();
	$user_data = $user_to_block->getUserData($user_id);
	$login_name = $user_data['login_name'];
	$email = $user_data['email'];
	$blocked_user = $user_to_block->deactivateUser($user_id);
	if ($blocked_user === false)
	{
		throw new Exception("Impossible de désactiver ce compte.", 1);
	}
	else
	{
		$subject = "Ton compte \"abonné\" sur le blog de Ludo, $login_name";
		$body = "Bonjour $login_name,\n\nNous te prévenons par ce mail que ton compte \"abonné\" à notre blog a été bloqué.\n\nSi tu penses qu'il s'agit d'une erreur, n'hésite pas à nous contacter via le formulaire de contact en bas de page du site.\n\nBonne journée,\n\nLudo";
		$headers = "From: noreply@ludodrapo.com\n";

		if(!mail($email, $subject, $body, $headers))
		{
			throw new Exception("Impossible d'envoyer le mail de suspension de compte.", 1);
		}
		displayAllSubscribers();
	}
}

function authorizeUser($user_id)
{
	$user_to_authorize = new UsersManager();
	$user_data = $user_to_authorize->getUserData($user_id);
	$login_name = $user_data['login_name'];
	$email = $user_data['email'];
	$authorized_user = $user_to_authorize->activateUser($user_id);
	if ($authorized_user === false)
	{
		throw new Exception("Impossible de réactiver ce compte.", 1);	
	}
	else
	{
		$subject = "Ton compte \"abonné\" sur le blog de Ludo, $login_name";
		$body = "Bonjour $login_name,\n\nBonne nouvelle : ton compte a été réactivé !\n\nWelcome back comme ils disent de l'autre côté de l'océan ...\n\nA très vite sur le blog.\n\nLudo.";
		$headers = "From: noreply@ludodrapo.com\n";

		if(!mail($email, $subject, $body, $headers))
		{
			throw new Exception("Impossible d'envoyer le mail de réactivation de compte.", 1);
		}
		displayAllSubscribers();
	}
}

//////////////////////
// POSTS FUNCTIONS //
////////////////////

function displayAllPosts()
{
	$all_posts = new PostsManager();
	$listed_all_posts = $all_posts->listAllPosts();
	require('views/backend/backendListAllPosts.php');
}

function addNewPost($title, $lead, $content, $category)
{
	$new_post = new PostsManager();
	$added_post = $new_post->addPost($title, $lead, $content, $category);
	if ($added_post === false)
	{
		throw new Exception('Impossible d\'enregristrer l\'article, désolé.');
	}
	else
	{
		displayAllPosts();
	}
}

function fillUpdatePostPage($post_id)
{
	$post = new PostsManager();
	$post_details = $post->getPostDetails($post_id);
	require('views/backend/backendUpdatePost.php');
}

function modifyPost($title, $lead, $content, $category, $post_id)
{
	$post_to_modify = new PostsManager();
	$modified_post = $post_to_modify->updatePost($title, $lead, $content, $category, $post_id);
	if ($modified_post === false)
	{
		throw new Exception("Impossible de modifer l'article, désolé.", 1);
	}
	else
	{
		displayAllPosts();
	}
}

function activatePost($post_id)
{
	$post_to_activate = new PostsManager();
	$activated_post = $post_to_activate->activatePost($post_id);
	if ($activated_post === false)
	{
		throw new Exception("Impossible d'activer l'article, désolé.", 1);
	}
	else
	{
		displayAllPosts();
	}
}

function deactivatePost($post_id)
{
	$post_to_deactivate = new PostsManager();
	$deactivated_post = $post_to_deactivate->deactivatePost($post_id);
	if ($deactivated_post === false)
	{
		throw new Exception("Impossible de désactiver l'article, désolé.", 1);
	}
	else
	{
		displayAllPosts();
	}
}

/////////////////////////
// COMMENTS FUNCTIONS //
///////////////////////

function displayAwaitingComments()
{
	$awaiting_comments = new CommentsManager();
	$all_awaiting_comments = $awaiting_comments->getAwaitingComments();

	require('views/backend/backendValidateComments.php');
}

function validateComment($comment_id)
{
	$comment_to_validate = new CommentsManager();
	$validated_comment = $comment_to_validate->validateComment($comment_id);

	if ($validated_comment === false)
	{
		throw new Exception("Impossible de valider ce commentaire, désolé.", 1);
	}
	else
	{
		displayAwaitingComments();
	}
}

function deleteComment($comment_id)
{
	$comment_to_delete = new CommentsManager();
	$comment_user_data = $comment_to_delete->getCommentUserData($comment_id);
	$login_name = $comment_user_data['login_name'];
	$email = $comment_user_data['email'];
	$comment = wordwrap($comment_user_data['comment'], 70);//to limit length of lines in the email
	$deleted_comment = $comment_to_delete->deleteComment($comment_id);

	if ($deleted_comment === false)
	{
		throw new Exception("Impossible de supprimer ce commentaire, désolé.", 1);
	}
	else
	{	
		$subject = "Ton commentaire sur le blog de Ludo, $login_name";
		$body = "Bonjour $login_name,\nTu as laissé ce commentaire sur notre site :\n\n\"$comment\"\n\nCelui-ci n'a pas été accepté par notre modérateur et a été supprimé.\nMerci de ta compréhension,\nLudo";
		$headers = "From: noreply@ludodrapo.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.

		if(!mail($email, $subject, $body, $headers))
		{
			throw new Exception("Impossible d'envoyer le message.", 1);
		}
		
		displayAwaitingComments();
	}
}


