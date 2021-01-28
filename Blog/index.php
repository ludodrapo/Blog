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
				displayPostAndComments($_GET['post_id']);
			}
		}
		elseif ($_GET['action'] == 'addComment')
		{
			if (!isset($_GET['post_id']) OR !isset($_POST['comment']))
			{
				throw new Exception("Il manque des données pour l'envoi de ce commentaire.", 1);
			}
			addComment($_SESSION['user_id'], $_GET['post_id'], $_POST['comment']);
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
				countUserComments($_SESSION['user_id']);			
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
	elseif (!isset($_GET['action']) && empty($_SESSION['login_name']))
	{
		if (isset($_POST['login_name']) && isset($_POST['password']))
		{
			login($_POST['login_name'], $_POST['password']);
		}
		elseif (isset($_POST['new_login_name']) && isset($_POST['new_password_1']) && isset($_POST['new_password_2']) && isset($_POST['new_email']))
		{
			addNewUser($_POST['new_login_name'], $_POST['new_password_1'], $_POST['new_password_2'], $_POST['new_email']);
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
			modifyEmail($_POST['new_email'], $_POST['password']);
		}
		elseif (isset($_POST['new_password_1']) && isset($_POST['new_password_2']) && isset($_POST['password']))
		{
			modifyPassword($_POST['new_password_1'], $_POST['new_password_2'], $_POST['password']);
		}
		elseif (isset($_POST['password']) && !isset($_POST['new_email']))
		{	
			goToAdmin($_POST['password']);
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
	echo 'Erreur : ' . $e->getMessage();
}