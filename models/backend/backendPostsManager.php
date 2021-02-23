<?php

require_once 'models/Manager.php';

final class PostsManager extends Manager
{
    public function listAllPosts()
    {
        $blog_db = $this->dbConnect();
        return $blog_db->query('SELECT * FROM posts ORDER BY creation_date DESC');
    }

    public function addPost($title, $lead, $content, $category)
    {
        $blog_db = $this->dbConnect();
        $post_to_add = $blog_db->prepare('INSERT INTO posts(user_id, title, lead, content, category, is_ok) VALUES (:user_id, :title, :lead, :content, :category, 0)');
        return $post_to_add->execute(
            array(
            'user_id' => (int) strip_tags($_SESSION['user_id']),
            'title' => $title,
            'lead' => $lead,
            'content' => $content,
            'category' => $category
            )
        );
    }

    public function getPostDetails($post_id)
    {
        $blog_db = $this->dbConnect();
        $post_id = (int) $post_id;
        $get_post_details = $blog_db->prepare('SELECT * FROM posts WHERE post_id = ?');
        $get_post_details->execute(array($post_id));

        return $get_post_details->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePost($title, $lead, $content, $category, $post_id)
    {
        $blog_db = $this->dbConnect();
        $post_to_update = $blog_db->prepare('UPDATE posts SET title = :title, lead = :lead, content = :content, category = :category, update_date = CURRENT_TIMESTAMP WHERE post_id = :post_id');
        return $post_to_update->execute(
            array(
            'title' => $title,
            'lead' => $lead,
            'content' => $content,
            'category' => $category,
            'post_id' => (int) $post_id
            )
        );
    }

    public function activatePost($post_id)
    {
        $blog_db = $this->dbConnect();
        $post_id = (int) $post_id;
        $post_to_activate = $blog_db->prepare('UPDATE posts SET is_ok = 1 WHERE post_id = :post_id');
        return $post_to_activate->execute(
            array(
            'post_id' => $post_id
            )
        );
    }

    public function deactivatePost($post_id)
    {
        $blog_db = $this->dbConnect();
        $post_id = (int) $post_id;
        $post_to_deactivate = $blog_db->prepare('UPDATE posts SET is_ok = 0 WHERE post_id = :post_id');
        return $post_to_deactivate->execute(
            array(
            'post_id' => $post_id
            )
        );
    }

    public function getPostsRanking()
    {
        $blog_db = $this->dbConnect();
        return $blog_db->query('SELECT posts.title, COUNT(comments.comment_id) AS comments_count FROM posts LEFT JOIN comments ON comments.post_id = posts.post_id WHERE posts.is_ok = 1 GROUP BY posts.title ORDER BY comments_count DESC');
    }
}
