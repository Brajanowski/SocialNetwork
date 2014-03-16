<?php
if ($user->isLoggedIn()) {
	if (Input::get('id')) {
		DB::getInstance()->query('DELETE FROM friends WHERE user_id = ? AND friend_id = ?', array($user->data()->id, Input::get('id')));
		DB::getInstance()->query('DELETE FROM friends WHERE user_id = ? AND friend_id = ?', array(Input::get('id'), $user->data()->id));
	}

	Redirect::to('index.php');
}
else {
	Redirect::to('index.php');
}