<?php

require_once('models/Manager.php');

class CommentsManager extends Manager
{
	public function getAwaitingComments()
	{
		$db = $this->dbConnect();
		$all_awaiting_comments = $db->query(
			'SELECT comments.comment_id, comments.comment, DATE_FORMAT(comments.comment_date, "%d/%m/%Y") AS date, DATE_FORMAT(comments.comment_date, "%Hh%i") AS time, posts.title,users.login_name FROM ((comments JOIN posts ON posts.post_id = comments.post_id) JOIN users ON comments.user_id = users.user_id) WHERE comments.is_ok = 0');

		return $all_awaiting_comments;
	}
	
	public function validateComment($comment_id)
	{
		$db = $this->dbConnect();
		$comment_id = (int)$comment_id;
		$comment_to_validate = $db->prepare('UPDATE comments SET is_ok = 1 WHERE comment_id = ?');
		$validated_comment = $comment_to_validate->execute(array($comment_id));

		return $validated_comment;
	}

	public function deleteComment($comment_id)
	{
		$db = $this->dbConnect();
		$comment_id = (int)$comment_id;
		$comment_to_delete = $db->prepare('DELETE FROM comments WHERE comment_id = ?');
		$deleted_comment = $comment_to_delete->execute(array($comment_id));

		return $deleted_comment;
	}
}