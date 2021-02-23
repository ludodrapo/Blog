<?php

require_once 'models/Manager.php';

final class PostsManager extends Manager
{
    public function listAllPosts()
    {
        $blog_db = $this->dbConnect();
        return $blog_db->query(
            'SELECT
            posts.post_id,
            posts.title,
            DATE_FORMAT(posts.creation_date, "%d/%m/%Y") AS date,
            DATE_FORMAT(posts.update_date, "%d/%m/%Y") AS update_date,
            posts.lead,
            posts.content,
            users.login_name,
            SUM(comments.is_ok) AS comments_count
        FROM ((posts
            JOIN users ON posts.user_id = users.user_id)
            LEFT JOIN comments ON comments.post_id = posts.post_id)
        WHERE posts.is_ok = 1
        GROUP BY posts.post_id
        ORDER BY posts.update_date DESC'
        );
    }

    public function listLastPosts()
    {
        $blog_db = $this->dbConnect();
        return $blog_db->query(
            'SELECT posts.post_id,
                posts.title,
                DATE_FORMAT(posts.creation_date, "%d/%m/%Y") AS date,
                DATE_FORMAT(posts.update_date, "%d/%m/%Y") AS update_date,
                posts.lead,
                posts.content,
                users.login_name,
                SUM(comments.is_ok) AS comments_count
            FROM ((posts 
                JOIN users ON posts.user_id = users.user_id)
                LEFT JOIN comments ON comments.post_id = posts.post_id)
            WHERE posts.is_ok = 1
            GROUP BY posts.post_id
            ORDER BY posts.creation_date DESC
            LIMIT 3'
        );
    }

    public function getPostDetails($post_id)
    {
        $blog_db = $this->dbConnect();
        $post_id = (int) $post_id;
        $get_post_details = $blog_db->prepare(
            'SELECT
                posts.post_id,
                posts.title,
                DATE_FORMAT(posts.creation_date, "%d/%m/%Y") AS date,
                DATE_FORMAT(posts.update_date, "%d/%m/%Y") AS update_date,
                posts.lead,
                posts.content,
                users.login_name
            FROM
                posts
                INNER JOIN users ON posts.user_id = users.user_id
            WHERE posts.post_id = ?'
        );

        $get_post_details->execute(array($post_id));
        return $get_post_details->fetch(PDO::FETCH_ASSOC);
    }
}
