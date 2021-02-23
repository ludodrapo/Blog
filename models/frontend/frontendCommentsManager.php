<?php

require_once 'models/Manager.php';

final class CommentsManager extends Manager
{
    public function addComment($user_id, $post_id, $comment)
    {
        $blog_db = $this->dbConnect();

        $comment_to_add = $blog_db->prepare('INSERT INTO comments(user_id, post_id, comment) VALUES (:user_id, :post_id, :comment)');
        return $comment_to_add->execute(
            array(
            'user_id' => (int) $user_id,
            'post_id' => (int) $post_id,
            'comment' => $comment
            )
        );
    }

    public function getPostComments($post_id)
    {
        $blog_db = $this->dbConnect();
        $post_id = (int) $post_id;
        $get_all_comments = $blog_db->prepare('SELECT comments.comment, DATE_FORMAT(comments.comment_date, "%d/%m/%Y") AS date, DATE_FORMAT(comments.comment_date, "%H:%i") AS time, users.login_name FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.post_id = :post_id AND comments.is_ok = 1 ORDER BY comments.comment_date');
        $get_all_comments->execute(
            array(
            'post_id' => $post_id)
        );
        return $get_all_comments;
    }

    public function getUserCommentsCount($user_id)
    {
        $blog_db = $this->dbConnect();
        $user_id = (int) $user_id;
        $user_comments_count = $blog_db->prepare('SELECT COUNT(comment) AS comments_count, COUNT(DISTINCT post_id) AS posts_count FROM comments WHERE user_id = ?');
        $user_comments_count->execute(array($user_id));
        return $user_comments_count->fetch(PDO::FETCH_ASSOC);
    }
}
