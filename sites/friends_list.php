<?php
if ($user->isLoggedIn()) {
	$query = DB::getInstance()->get('friends', array('user_id', '=', $user->data()->id));

	if ($query->count()) {
		echo '<ul>';
		foreach ($query->results() as $f) {
			$friend = new User($f->friend_id);
			echo '<li><a href="?site=profile&id='.$friend->data()->id.'">'.$friend->data()->name.'</a> <a href="?site=send_message&id='.$friend->data()->id.'">send message</a> <a href="?site=remove_friend&id='.$friend->data()->id.'">remove friend</a></li>';
		}
		echo '</ul>';
	}
	else {
		echo 'You have not friends!';
	}
}
else {
	Redirect::to('index.php');
}