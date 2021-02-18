<?php

session_start();

require 'controller/frontend/frontendController.php';

try
{
    if (isset($_GET['action']) && !empty($_GET['action']))
    {
  //////////////////////////////
 // DISPLAYING VIEWS ACTIONS //
//////////////////////////////
        if ($_GET['action'] === 'displayAllPosts')
        {
            displayAllPosts();
        }
        elseif ($_GET['action'] === 'goToLogin')
        {
            require 'views/frontend/frontendLogin.php';
        }

        elseif ($_GET['action'] === 'goToUpdateEmail')
        {
            require 'views/frontend/frontendUpdateEmail.php';
        }
        elseif ($_GET['action'] === 'goToUpdatePassword')
        {
            require 'views/frontend/frontendUpdatePassword.php';
        }
        elseif ($_GET['action'] === 'goToAdmin')
        {
            require 'views/frontend/frontendGoToAdmin.php';
        }
        elseif ($_GET['action'] === 'goToResume')
        {
            require 'views/frontend/resume.php';
        }
        elseif ($_GET['action'] === 'logout')
        {
            logout();
        }
  /////////////////////////////////////
 // FILLING VIEWS WITH DATA ACTIONS //
/////////////////////////////////////
        elseif ($_GET['action'] === 'displayPostAndComments')
        {
            if (!isset($_GET['post_id']))
            {
                throw new Exception("Pas d'identifiant d'article transmis.", 1);
            }
            displayPostAndComments(strip_tags($_GET['post_id']));
        }
        elseif ($_GET['action'] === 'profile')
        {
            if (!isset($_SESSION['user_id']))
            {
                throw new Exception("Impossible de reconnaître l'identifiant utilisateur.", 1);
            }
            countUserComments(strip_tags($_SESSION['user_id']));
        }
  /////////////////////
 // POSTING ACTIONS //
/////////////////////
        elseif ($_GET['action'] === 'addComment')
        {
            if (
                !isset($_GET['post_id']) || empty($_GET['post_id']) ||
                !isset($_POST['comment']) || empty($_POST['comment']) ||
                !isset($_SESSION['user_id']) || empty($_SESSION['user_id'])
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
        //To send contact mail if user is logged in
        elseif ($_GET['action'] === 'contactMail' && isset($_SESSION['login_name']))
        {
            if (isset($_POST['message']) && !empty($_POST['message']))
            {
                contactMail(
                    strip_tags($_SESSION['login_name']),
                    strip_tags($_SESSION['email']),
                    strip_tags($_POST['message'])
                );
            }
            else
            {
                throw new Exception("Il manque des données nécessaires à l'envoi de ce mail.", 1);
            }
        }
        //To send contact mail if no session is started
        elseif ($_GET['action'] === 'contactMail' && !isset($_SESSION['login_name']))
        {
            if (
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
            else
            {
                throw new Exception("Il manque des données nécessaires à l'envoi de ce mail.", 1);
            }
        }
  ///////////////////////
 // ACCESSING ACTIONS //
///////////////////////
        elseif ($_GET['action'] === 'login')
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
            else
            {
                throw new Exception('Il manque des données nécessaires à la connexion.', 1);
            }
        }
        elseif ($_GET['action'] === 'signin')
        {
            if (
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
                throw new Exception("Il manque des données nécessaires à la création d'un compte abonné.", 1);
            }
        }
        elseif ($_GET['action'] === 'accessAdmin')
        {
            if (isset($_POST['password']) && $_SESSION['profile'] == 'administrator')
            {
                goToAdmin(strip_tags($_POST['password']));
            }
        }
  ////////////////////////
 // USERS DATA ACTIONS //
////////////////////////
        elseif ($_GET['action'] === 'updateEmail')
        {
            if (isset($_POST['new_email']) && isset($_POST['password']))
            {
                modifyEmail(
                    strip_tags($_POST['new_email']),
                    strip_tags($_POST['password'])
                );
            }
            else
            {
                throw new Exception("Il manque des données nécessaires à la modification de l'adresse mail de contact.", 1);
            }
        }
        elseif ($_GET['action'] === 'updatePassword')
        {
            if (
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
            else
            {
                throw new Exception('Il manque des données nécessaires à la modification du mot de passe.', 1);
            }
        }
    }
  ///////////////
 // NO ACTION //
///////////////
    else
    {
        displayLastPosts();
    }
}

catch(Exception $exception)
{
    $bug_message = $exception->getMessage();
    require('views/frontend/frontendBugMessage.php');
}
