<?php
if ($user->isLoggedIn()) {
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'message' => array(
					'required' => true,
					'min' => 3,
				)
			));

			if ($validation->passed()) {
				DB::getInstance()->insert('messages', array(
					'message' => Input::get('message'),
					'user_id' => $user->data()->id,
					'target_id' => Input::get('id')
				));
				Session::flash('home', 'You have sent message!');
				Redirect::to('index.php');
			}
			else {
				foreach ($validate->errors() as $error) {
					echo $error.'<br>';
				}
			}
		}
	}

?>

<form action="" method="post">
	<div class="field">
		<label for="message">Enter your message</label>
		<input type="text" name="message" id="message" value="" autocomplete="off">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<input type="submit" value="Send message" />
</form>


<?php
}
else {
	Redirect::to('index.php');
}