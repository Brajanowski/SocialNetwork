<?php
if ($user->isLoggedIn()) {
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'status' => array(
					'required' => true,
					'min' => 3,
				)
			));

			if ($validation->passed()) {
				DB::getInstance()->insert('status', array(
					'user_id' => $user->data()->id,
					'status' => Input::get('status')
				));
				Session::flash('home', 'Successfully updated your status!');
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
		<label for="status">Status</label>
		<textarea type="text" name="status" id="status"></textarea>
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<input type="submit" value="Update your status!" />
</form>

<?php
}
else {
	Redirect::to('index.php');
}