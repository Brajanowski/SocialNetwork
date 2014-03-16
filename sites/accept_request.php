<?php
if ($user->isLoggedIn() && Input::get('id')) {
	$invited = DB::getInstance()->query('SELECT * FROM friend_requests WHERE inviter = ? AND friend = ? ', array(Input::get('id'), $user->data()->id))->count();
	if ($invited) {
		DB::getInstance()->delete('friend_requests', array('inviter', '=', Input::get('id')));
		DB::getInstance()->insert('friends', array('user_id' => $user->data()->id, 'friend_id' => Input::get('id')));
		DB::getInstance()->insert('friends', array('friend_id' => $user->data()->id, 'user_id' => Input::get('id')));
	}

	Redirect::to('index.php');
}
else {
	Redirect::to('index.php');
}