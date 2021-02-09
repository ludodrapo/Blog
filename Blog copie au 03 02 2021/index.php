<?php
session_start();

require('controller/frontend/frontendController.php');

try
{
	if (isset($_GET['action']))
	{
		if ($_GET['action'] == 'displayAllPosts')
		{
			displayAllPosts();
		}
		elseif ($_GET['action'] == 'displayPostAndComments')
		{
			if (!isset($_GET['post_id']))
			{
				throw new Exception("Pas d'identifiant d'article transmis.", 1);
			}
			else
			{
				displayPostAndComments(strip_tags($_GET['post_id']));
			}
		}
		elseif ($_GET['action'] == 'addComment')
		{
			if (
				!isset($_GET['post_id']) ||
				!isset($_POST['comment']) ||
				!isset($_SESSION['user_id']) ||
				empty($_GET['post_id']) ||
				empty($_POST['comment']) ||
				empty($_SESSION['user_id'])
			)
			{
				throw new Exception("Il manque des données pour l'envoi de ce commentaire.", 1);
			}
			addComment(
				strip_tags($_SESSION['user_id']),
				strip_tags($_GET['post_id']),
				strip_tags($_POST['comment'])
			);
		}
		elseif ($_GET['action'] == 'login')
		{
			require('views/frontend/frontendLogin.php');
		}
		elseif ($_GET['action'] == 'profile')
		{
			if (!isset($_SESSION['user_id']))
			{
				throw new Exception("Impossible de reconnaître l'identifiant utilisateur.", 1);
			}
			else
			{
				countUserComments(strip_tags($_SESSION['user_id']));			
			}
		}
		elseif ($_GET['action'] == 'updateEmail')
		{
			require('views/frontend/frontendUpdateEmail.php');
		}
		elseif ($_GET['action'] == 'updatePassword')
		{
			require('views/frontend/frontendUpdatePassword.php');
		}
		elseif ($_GET['action'] == 'goToAdmin')
		{
			require('views/frontend/frontendGoToAdmin.php');
		}
		elseif ($_GET['action'] == 'logout')
		{
			logout();
		}
	}
	elseif (
		isset($_POST['name']) && !empty($_POST['name']) &&
		isset($_POST['email']) && !empty($_POST['email']) &&
		isset($_POST['message']) && !empty($_POST['message'])
	)
	{
		contactMail(
			strip_tags($_POST['name']),
			strip_tags($_POST['email']),
			strip_tags($_POST['message'])
		);
	}
	elseif (!isset($_GET['action']) && empty($_SESSION['login_name']))
	{
		if (
			isset($_POST['login_name']) && isset($_POST['password']) &&
			!empty($_POST['login_name']) && !empty($_POST['password'])
		)
		{
			login(
				strip_tags($_POST['login_name']),
				strip_tags($_POST['password'])
			);
		}
		elseif (
			isset($_POST['new_login_name']) && !empty($_POST['new_login_name']) &&
			isset($_POST['new_password_1']) && !empty($_POST['new_password_1']) &&
			isset($_POST['new_password_2']) && !empty($_POST['new_password_2']) &&
			isset($_POST['new_email']) && !empty($_POST['new_email'])
		)
		{
			addNewUser(
				strip_tags($_POST['new_login_name']),
				strip_tags($_POST['new_password_1']),
				strip_tags($_POST['new_password_2']),
				strip_tags($_POST['new_email'])
			);
		}
		else
		{
			displayLastPosts();
		}
	}
	elseif(!isset($_GET['action']) && isset($_SESSION['login_name']))
	{
		if (isset($_POST['new_email']) && isset($_POST['password']))
		{	
			modifyEmail(
				strip_tags($_POST['new_email']),
				strip_tags($_POST['password'])
			);
		}
		elseif (
			isset($_POST['new_password_1']) && !empty($_POST['new_password_1']) &&
			isset($_POST['new_password_2']) && !empty($_POST['new_password_2']) &&
			isset($_POST['password']) && !empty($_POST['password'])
		)
		{
			modifyPassword(
				strip_tags($_POST['new_password_1']),
				strip_tags($_POST['new_password_2']),
				strip_tags($_POST['password'])
			);
		}
		elseif (
			isset($_POST['password']) &&
			!isset($_POST['new_email']) &&
			$_SESSION['profile'] == 'administrator')
		// need here the !isset(new_email) so the modifyEmail function (above) can work
		{	
			goToAdmin(strip_tags($_POST['password']));
		}

		else
		{
			displayLastPosts();
		}
	}
	else
	{
		displayLastPosts();
	}
}

catch(Exception $e)
{
	$bug_message = $e->getMessage();

	require('views/frontend/frontendBugMessage.php');
	//echo 'Aïe aïe aïe : ' . $e->getMessage();
}




