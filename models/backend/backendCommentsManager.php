<?php

require_once 'models/Manager.php';

class CommentsManager extends Manager
{
    public function getAwaitingComments()
    {
        $blog_db = $this->dbConnect();
        return $blog_db->query(
            'SELECT
                comments.comment_id,
                comments.comment,
                DATE_FORMAT(comments.comment_date, "%d/%m/%Y") AS date,
                DATE_FORMAT(comments.comment_date, "%Hh%i") AS time,
                posts.title,
                users.login_name,
                users.email
            FROM ((comments 
            JOIN posts ON posts.post_id = comments.post_id)
            JOIN users ON comments.user_id = users.user_id)
            WHERE comments.is_ok = 0'
        );
    }

    public function getCommentUserData($comment_id)
    {
        $blog_db = $this->dbConnect();
        $comment_id = (int) $comment_id;
        $comment_user_query = $blog_db->prepare('SELECT users.login_name, users.email, comments.comment FROM users JOIN comments WHERE users.user_id = comments.user_id AND comments.comment_id = ?');
        $comment_user_query->execute(array($comment_id));
        return $comment_user_query->fetch(PDO::FETCH_ASSOC);
    }

    public function validateComment($comment_id)
    {
        $blog_db = $this->dbConnect();
        $comment_id = (int) $comment_id;
        $comment_to_validate = $blog_db->prepare('UPDATE comments SET is_ok = 1 WHERE comment_id = ?');
        return $comment_to_validate->execute(array($comment_id));
    }

    public function deleteComment($comment_id)
    {
        $blog_db = $this->dbConnect();
        $comment_id = (int) $comment_id;
        $comment_to_delete = $blog_db->prepare('DELETE FROM comments WHERE comment_id = ?');
        return $comment_to_delete->execute(array($comment_id));
    }

    public function countAwaitingComments()
    {
        $blog_db = $this->dbConnect();
        $comments_query = $blog_db->query('SELECT COUNT(comment_id) AS count FROM comments WHERE comments.is_ok = 0');
        return $comments_query->fetch(PDO::FETCH_ASSOC);
    }
}
