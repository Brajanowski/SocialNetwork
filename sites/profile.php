<?php
if (Input::get('id')) {
	$profile_user = new User(Input::get('id'));

	echo '<p>Full name: '.$profile_user->data()->name.'</p>';
	echo '<p>E-mail adress: '.$profile_user->data()->email.'</p>';

	$invited = DB::getInstance()->query('SELECT * FROM friend_requests WHERE friend = ? AND inviter = ?', array(Input::get('id'), $user->data()->id))->count();
	$waiting = DB::getInstance()->query('SELECT * FROM friend_requests WHERE inviter = ? AND friend = ?', array(Input::get('id'), $user->data()->id))->count();
	$is_friend = DB::getInstance()->query('SELECT * FROM friends WHERE user_id = ? AND friend_id = ?', array($user->data()->id, Input::get('id')))->count();
	if (!$is_friend && !$waiting && !$invited && $user->data()->id != $profile_user->data()->id && $user->isLoggedIn()) {
		echo '<a href="?site=invite_friend&id='.Input::get('id').'">Invite to friends</a>';
	}

	if ($waiting) {
		echo '<a href="?site=accept_request&id='.Input::get('id').'">Accept request!</a>';
	}

	if ($user->data()->id != $profile_user->data()->id) {
		echo '<br>';
		echo '<a href="?site=send_message&id='.Input::get('id').'">Send Message</a>';
		echo '<br>';
	}
	echo '<ul>';
	$query = DB::getInstance()->query('SELECT * FROM status WHERE user_id = ? ORDER BY id DESC', array(Input::get('id')));
	foreach ($query->results() as $status) {
		echo '<li>'.$status->status.'</li>';
	}
	echo '</ul>';
}
else {
	Redirect::to('index.php');
}
