<?php
if ($user->isLoggedIn()) {
	$query = DB::getInstance()->query('SELECT * FROM friend_requests WHERE friend = ? ORDER BY id', array($user->data()->id));
	
	if (!$query->count()) {
		echo 'Nobody invited you to friends';
	}
	else {
		echo '<ul>';
		foreach ($query->results() as $request) {
			$inviter = new User($request->inviter);
			echo '<li><a href="?site=profile&id='.$inviter->data()->id.'">'.$inviter->data()->name.'</a> <a href="?site=accept_request&id='.$inviter->data()->id.'">Confirm!</a></li>';
		}
		echo '</ul>';
	}
}
else {
	Redirect::to('index.php');
}