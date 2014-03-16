<?php
if (Input::get('id') && Input::get('id') != $user->data()->id && $user->isLoggedIn()) {
	$invited = DB::getInstance()->query('SELECT * FROM friend_requests WHERE friend = ? AND inviter = ?', array(Input::get('id'), $user->data()->id))->count();
	$waiting = DB::getInstance()->query('SELECT * FROM friend_requests WHERE inviter = ? AND friend = ?', array(Input::get('id'), $user->data()->id))->count();

	if (!$invited && !$waiting) {
			DB::getInstance()->insert('friend_requests', array(
			'inviter' => $user->data()->id,
			'friend' => Input::get('id')
		));
		Session::flash('home', 'Successfully invite friend.');
	}
	Redirect::to('index.php');	
}
else {
	Redirect::to('index.php');
}