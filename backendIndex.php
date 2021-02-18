<?php

session_start();

require 'controller/backend/backendController.php';

try
{
    if (isset($_GET['action']) && !empty($_GET['action']))
    {
        if ($_GET['action'] === 'displayAllPosts')
        {
            displayAllPosts();
        }
        elseif ($_GET['action'] === 'displayAwaitingComments')
        {
            displayAwaitingComments();
        }
        elseif ($_GET['action'] === 'newPost')
        {
            require 'views/backend/backendNewPost.php';
        }
        elseif ($_GET['action'] === 'displayAllSubscribers')
        {
            displayAllSubscribers();
        }
        elseif ($_GET['action'] === 'addPost')
        {
            if (
                !isset($_POST['title']) || empty($_POST['title']) ||
                !isset($_POST['lead']) || empty($_POST['lead']) ||
                !isset($_POST['content']) || empty($_POST['content']) ||
                !isset($_POST['category']) || empty($_POST['category'])
            )
            {
                throw new Exception("Il manque des éléments nécessaires à l'enregistrement de l'article.", 1);
            }
            addNewPost(
                strip_tags($_POST['title']),
                strip_tags($_POST['lead']),
                htmlspecialchars($_POST['content']),
                strip_tags($_POST['category'])
            );
        }
        elseif ($_GET['action'] === 'fillUpdatePostPage')
        {
            if (!isset($_GET['post_id']) || empty($_GET['post_id']))
            {
                throw new Exception('Pas de numéro de post identifié, désolé.', 1);
            }
            fillUpdatePostPage(strip_tags($_GET['post_id']));           
        }
        elseif ($_GET['action'] === 'updatePost')
        {
            if (
                !isset($_POST['title']) || empty($_POST['title']) ||
                !isset($_POST['lead']) || empty($_POST['lead']) ||
                !isset($_POST['content']) || empty($_POST['content']) ||
                !isset($_POST['category']) || empty($_POST['category']) ||
                !isset($_POST['post_id']) || empty($_POST['post_id'])
            )
            {
                throw new Exception("Il manque un ou plusieurs éléments nécessaires à la modification de l'article, désolé.", 1);
            }
            modifyPost(
                strip_tags($_POST['title']),
                strip_tags($_POST['lead']),
                htmlspecialchars($_POST['content']),
                strip_tags($_POST['category']),
                strip_tags($_POST['post_id'])
            );         
        }
        elseif ($_GET['action'] === 'validateComment')
        {
            if (!isset($_GET['comment_id']) || empty($_GET['comment_id']))
            {
                throw new Exception("Nous n'avons pas reconnu le commentaire à valider, désolé.", 1);
            }
            validateComment(strip_tags($_GET['comment_id']));
        }
        elseif ($_GET['action'] === 'deleteComment')
        {
            if (!isset($_GET['comment_id']) || empty($_GET['comment_id']))
            {
                throw new Exception("Nous n'avons pas reconnu le commentaire à supprimer.", 1);
            }
            deleteComment(strip_tags($_GET['comment_id']));
        }
        elseif ($_GET['action'] === 'activatePost')
        {
            if (!isset($_GET['post_id']) || empty($_GET['post_id']))
            {
                throw new Exception("Nous n'avons pas reconnu l'article à activer", 1);
            }
            activatePost(strip_tags($_GET['post_id']));
        }
        elseif ($_GET['action'] === 'deactivatePost')
        {
            if (!isset($_GET['post_id']) || empty($_GET['post_id']))
            {
                throw new Exception("Nous n'avons pas reconnu l'article à désactiver", 1);
            }
            deactivatePost(strip_tags($_GET['post_id']));   
        }
        elseif ($_GET['action'] === 'blockUser')
        {
            if (!isset($_GET['user_id']) || empty($_GET['user_id']))
            {
                throw new Exception("Nous n'avons pas reconnu l'identifiant de l'utilisateur à bloquer.", 1);
            }
            blockUser(strip_tags($_GET['user_id']));
        }
        elseif ($_GET['action'] === 'authorizeUser')
        {
            if (!isset($_GET['user_id']) || empty($_GET['user_id']))
            {
                throw new Exception("Nous n'avons pas reconnu l'idendtifiant de l'utilisateur à réactiver.", 1);
            }
            authorizeUser(strip_tags($_GET['user_id']));
        }
        elseif ($_GET['action'] === 'uploadImage')
        {
            if (!isset($_FILES['image_to_upload']) || empty($_FILES['image_to_upload']))
            {
                throw new Exception("Aucune image n'a été sélectionnée", 1);
            }
            uploadImage($_FILES['image_to_upload']);
        }
    }
    else
    {
        fillBackendHomepage();
    }
}
catch(Exception $exception)
{
    $bug_message = $exception->getMessage();
    require('views/backend/backendBugMessage.php');
}
