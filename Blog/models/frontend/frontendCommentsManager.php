<?php

require_once('models/Manager.php');

class CommentsManager extends Manager
{
	public function addComment($user_id, $post_id, $comment)
	{
		$db = $this->dbConnect();

		$comment_to_add = $db->prepare('INSERT INTO comments(user_id, post_id, comment) VALUES (:user_id, :post_id, :comment)');
		$added_comment = $comment_to_add->execute(array(
			'user_id'=>$user_id,
    		'post_id'=>$post_id,
    		'comment'=>$comment
		));
		return $added_comment;
	}

	public function getPostComments($post_id)
	{
		$db = $this->dbConnect();
		$post_id = (int)$post_id;
		$get_all_comments = $db->prepare('SELECT comments.comment, DATE_FORMAT(comments.comment_date, "%d/%m/%Y") AS date, DATE_FORMAT(comments.comment_date, "%H:%i") AS time, users.login_name FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.post_id = ? AND comments.is_ok = 1 ORDER BY comments.comment_date');
		$get_all_comments->execute(array($post_id));

		return $get_all_comments;
	}

	public function getUserCommentsCount($user_id)
	{
		$db = $this->dbConnect();
		$user_comments_count = $db->prepare('SELECT COUNT(comment) AS comments_count, COUNT(post_id) AS posts_count FROM comments WHERE user_id = ?');
		$user_comments_count->execute(array($user_id));

		$comments_count = $user_comments_count->fetch(PDO::FETCH_ASSOC);
		$user_comments_count->closeCursor();

		return $comments_count;
	}
}