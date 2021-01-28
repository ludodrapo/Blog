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
			if (
				isset($_POST['title']) &&
				isset($_POST['lead']) &&
				isset($_POST['content']) &&
				isset($_POST['category'])
			)
			{
				addNewPost(
					strip_tags(htmlspecialchars($_POST['title'])),
					strip_tags(htmlspecialchars($_POST['lead'])),
					strip_tags(htmlspecialchars($_POST['content'])),
					strip_tags(htmlspecialchars($_POST['category']))
				);
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
				fillUpdatePostPage(strip_tags(htmlspecialchars($_GET['post_id'])));				
			}
		}
		elseif ($_GET['action'] == 'updatePost')
		{
			if (
				isset($_POST['title']) &&
				isset($_POST['lead']) &&
				isset($_POST['content']) &&
				isset($_POST['category']) &&
				isset($_POST['post_id'])
			)
			{
				modifyPost(
					strip_tags(htmlspecialchars($_POST['title'])),
					strip_tags(htmlspecialchars($_POST['lead'])),
					strip_tags(htmlspecialchars($_POST['content'])),
					strip_tags(htmlspecialchars($_POST['category'])),
					strip_tags(htmlspecialchars($_POST['post_id']))
				);
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
				validateComment(strip_tags(htmlspecialchars($_GET['comment_id'])));
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
				deleteComment(strip_tags(htmlspecialchars($_GET['comment_id'])));
			}
		}
		elseif ($_GET['action'] == 'activatePost')
		{
			if (isset($_GET['post_id']))
			{
				activatePost(strip_tags(htmlspecialchars($_GET['post_id'])));
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
				deactivatePost(strip_tags(htmlspecialchars($_GET['post_id'])));
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
