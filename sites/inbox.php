<?php
if ($user->isLoggedIn()) {
	$query = DB::getInstance()->query('SELECT * FROM messages WHERE target_id = ? ORDER BY id DESC', array($user->data()->id));

	if ($query->count()) {
		echo '<ul>';

		foreach ($query->results() as $message) {
			$from = new User($message->user_id);

			echo '<li><a href="?site=profile&id='.$from->data()->id.'">'.$from->data()->name.'</a>:<br>'.$message->message.'</li>';
		}

		echo '</ul>';
	}
	else {
		echo 'No messages here';
	}
}
else {
	Redirect::to('index.php');
}