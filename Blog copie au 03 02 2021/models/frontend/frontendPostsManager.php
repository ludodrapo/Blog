<?php

require_once('models/Manager.php');

class PostsManager extends Manager
{

	public function listAllPosts()
	{
		$db = $this->dbConnect();
		$all_posts_listed = $db->query('SELECT posts.post_id, posts.title, DATE_FORMAT(posts.creation_date, "%d/%m/%Y") AS date, DATE_FORMAT(posts.update_date, "%d/%m/%Y") AS update_date, posts.lead, users.login_name, SUM(comments.is_ok) AS comments_count FROM ((posts JOIN users ON posts.user_id = users.user_id) LEFT JOIN comments ON comments.post_id = posts.post_id) WHERE posts.is_ok = 1 GROUP BY posts.post_id ORDER BY posts.update_date DESC');

		return $all_posts_listed;
	}

	public function listLastPosts()
	{
		$db = $this->dbConnect();
		$last_posts_listed = $db->query('SELECT posts.post_id, posts.title, DATE_FORMAT(posts.creation_date, "%d/%m/%Y") AS date, DATE_FORMAT(posts.update_date, "%d/%m/%Y") AS update_date, posts.lead, users.login_name, SUM(comments.is_ok) AS comments_count FROM ((posts JOIN users ON posts.user_id = users.user_id) LEFT JOIN comments ON comments.post_id = posts.post_id) WHERE posts.is_ok = 1 GROUP BY posts.post_id ORDER BY posts.creation_date DESC LIMIT 3');
		
		return $last_posts_listed;
	}

	public function getPostDetails($post_id)
	{
		$db = $this->dbConnect();
		$post_id = (int)$post_id;
		$get_post_details = $db->prepare('SELECT posts.post_id, posts.title, DATE_FORMAT(posts.creation_date, "%d/%m/%Y") AS date, DATE_FORMAT(posts.update_date, "%d/%m/%Y") AS update_date, posts.lead, posts.content, users.login_name FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE posts.post_id = ?');
		$get_post_details->execute(array($post_id));
		$post_details = $get_post_details->fetch(PDO::FETCH_ASSOC);
		$get_post_details->closeCursor();
		return $post_details;
	}
}

