<?php

require_once('models/Manager.php');

class PostsManager extends Manager
{
	public function listAllPosts()
	{
		$db = $this->dbConnect();
		$all_posts_listed = $db->query('SELECT * FROM posts ORDER BY creation_date DESC');
		return $all_posts_listed;
	}

	public function addPost($title, $lead, $content, $category)
	{
		$db = $this->dbConnect();
		$post_to_add = $db->prepare('INSERT INTO posts(user_id, title, lead, content, category) VALUES (:user_id, :title, :lead, :content, :category)');
		$added_post = $post_to_add->execute(array(
			'user_id'=>strip_tags(htmlspecialchars($_SESSION['user_id'])),
    		'title'=>$title,
    		'lead'=>$lead,
    		'content'=>$content,
    		'category'=>$category
		));
		return $added_post;
	}

	public function getPostDetails($post_id)
	{
		$db = $this->dbConnect();
		$post_id = (int)$post_id;
		$get_post_details = $db->prepare('SELECT * FROM posts WHERE post_id = ?');
		$get_post_details->execute(array($post_id));
		$post_details = $get_post_details->fetch(PDO::FETCH_ASSOC);
		$get_post_details->closeCursor();
	
		return $post_details;
	}

	public function updatePost($title, $lead, $content, $category, $post_id)
	{
		$db = $this->dbConnect();
		$post_to_update = $db->prepare('UPDATE posts SET title = :title, lead = :lead, content = :content, category = :category, update_date = CURRENT_TIMESTAMP WHERE post_id = :post_id');
		$updated_post = $post_to_update->execute(array(
			'title'=>$title,
    		'lead'=>$lead,
    		'content'=>$content,
    		'category'=>$category,
    		'post_id'=>$post_id
		));
		return $updated_post;
	}

	public function activatePost($post_id)
	{
		$db = $this->dbConnect();
		$post_id = (int)$post_id;
		$post_to_activate = $db->prepare('UPDATE posts SET is_ok = 1 WHERE post_id = :post_id');
		$activated_post = $post_to_activate->execute(array(
			'post_id'=>$post_id
		));

		return $activated_post;
	}

	public function deactivatePost($post_id)
	{
		$db = $this->dbConnect();
		$post_id = (int)$post_id;
		$post_to_deactivate = $db->prepare('UPDATE posts SET is_ok = 0 WHERE post_id = :post_id');
		$deactivated_post = $post_to_deactivate->execute(array(
			'post_id'=>$post_id
		));

		return $deactivated_post;
	}
}

