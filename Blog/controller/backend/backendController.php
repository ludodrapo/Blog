<?php

session_start();

require_once('models/backend/backendPostsManager.php');
require_once('models/backend/backendCommentsManager.php');
require_once('models/backend/backendUsersManager.php');

function displayAllPosts()
{
	$all_posts = new PostsManager();
	$listed_all_posts = $all_posts->listAllPosts();
	require('views/backend/backendListAllPosts.php');
}

function displayAwaitingComments()
{
	$awaiting_comments = new CommentsManager();
	$all_awaiting_comments = $awaiting_comments->getAwaitingComments();

	require('views/backend/backendValidateComments.php');
}

function displayAllSubscribers()
{
	$users = new UsersManager();
	$listed_all_users = $users->listAllUsers();

	require('views/backend/backendListAllSubscribers.php');
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
/*
function deletePost($post_id)
{
	important : the post must be deactivated before it can be deleted
}
*/
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
	$deleted_comment = $comment_to_delete->deleteComment($comment_id);

	if ($deleted_comment === false)
	{
		throw new Exception("Impossible de supprimer ce commentaire, désolé.", 1);
	}
	else
	{
		displayAwaitingComments();
	}
}


