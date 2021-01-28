<?php

session_start();

require('controller/backend/backendController.php');

try
{
	if (isset($_GET['action']))
	{
		if ($_GET['action'] == 'displayAllPosts')
		{
			displayAllPosts();
		}
		elseif ($_GET['action'] ==  'displayAwaitingComments')
		{
			displayAwaitingComments();
		}
		elseif ($_GET['action'] == 'newPost')
		{
			require('views/backend/backendNewPost.php');
		}
		elseif ($_GET['action'] == 'displayAllSubscribers')
		{
			displayAllSubscribers();
		}
		elseif ($_GET['action'] == 'addPost')
		{
			if (isset($_POST['title']) && isset($_POST['lead']) && isset($_POST['content']) && isset($_POST['category']))
			{
				addNewPost($_POST['title'], $_POST['lead'], $_POST['content'], $_POST['category']);
			}
			else
			{
				throw new Exception("Désolé, il manque des éléments nécessaires à l'enregistrement de l'article.", 1);
			}
		}
		elseif ($_GET['action'] == 'fillUpdatePostPage')
		{
			if (!isset($_GET['post_id']))
			{
				throw new Exception("Pas de numéro de post identifié, désolé.", 1);
			}
			else
			{
				fillUpdatePostPage($_GET['post_id']);				
			}
		}
		elseif ($_GET['action'] == 'updatePost')
		{
			if (isset($_POST['title']) && isset($_POST['lead']) && isset($_POST['content']) && isset($_POST['category']) && isset($_POST['post_id']))
			{
				modifyPost($_POST['title'], $_POST['lead'], $_POST['content'], $_POST['category'], $_POST['post_id']);
			}
			else
			{
				throw new Exception("Il manque un ou plusieurs éléments nécessaires à la modification de l'article, désolé.", 1);
			}
		}
		elseif ($_GET['action'] == 'validateComment')
		{
			if (!isset($_GET['comment_id']))
			{
				throw new Exception("Nous n'avons pas reconnu le commentaire à valider, désolé.", 1);
			}
			else
			{
				validateComment($_GET['comment_id']);
			}
		}
		elseif ($_GET['action'] == 'deleteComment')
		{
			if (!isset($_GET['comment_id']))
			{
				throw new Exception("Nous n'avons pas reconnu le commentaire à supprimer, désolé.", 1);
			}
			else
			{
				deleteComment($_GET['comment_id']);
			}
		}
		elseif ($_GET['action'] == 'activatePost')
		{
			if (isset($_GET['post_id']))
			{
				activatePost($_GET['post_id']);
			}
			else
			{
				throw new Exception("Nous n'avons pas reconnu l'article à activer", 1);
			}
		}
		elseif ($_GET['action'] == 'deactivatePost')
		{
			if (isset($_GET['post_id']))
			{
				deactivatePost($_GET['post_id']);
			}
			else
			{
				throw new Exception("Nous n'avons pas reconnu l'article à désactiver", 1);
			}
		}
	}

	else
	{		
		require('views/backend/backendHomepage.php');
	}

}
catch(Exception $e)
{
	echo 'Erreur : ' . $e->getMessage();
}
