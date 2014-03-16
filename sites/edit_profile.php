<?php
if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_current' => array(
				'required' => true,
				'min' => 6
			),
			'password_new' => array(
				'required' => true,
				'min' => 6
			),
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new'
			)
		));

		if ($validation->passed()) {
			
			if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
				Session::flash('home', 'You typed wrong current password!');
				Redirect::to('index.php?site=profile&action=edit');
			}
			else {
				try {
					$salt = Hash::make(32);
					$user->update(array(
						'password' => Hash::make(Input::get('password_new'), $salt),
						'salt' => $salt
					));

					Session::flash('home', 'Your password has been changed!');
					Redirect::to('index.php?site=edit_profile');
				}
				catch (Exception $e) {
					die ($e->getMessage());
				}
			}
		}
		else {
			foreach ($validate->errors() as $error) {
				echo $error.'<br>';
			}
		}
	}
	else if (Token::check(Input::get('token2'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'name' => array(
				'required' => true,
				'min' => 6,
				'max' => 50
			),
			'email' => array(
				'required' => true,
				'min' => 6,
				'max' => 256
			)
		));

		if ($validation->passed()) {
			
			try {
				$user->update(array(
					'name' => Input::get('name'),
					'email' => Input::get('email')
				));

				Session::flash('home', 'Your data has been changed!');
				Redirect::to('index.php?site=edit_profile');
			}
			catch (Exception $e) {
				die ($e->getMessage());
			}
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
		<label for="password_current">Current password</label>
		<input type="password" name="password_current" id="password_current" autocomplete="off">
	</div>

	<div class="field">
		<label for="password_new">New password</label>
		<input type="password" name="password_new" id="password_new" autocomplete="off">
	</div>

	<div class="field">
		<label for="password_new_again">New password again</label>
		<input type="password" name="password_new_again" id="password_new_again" autocomplete="off">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<input type="submit" value="Update" />
</form>

<form action="" method="post">
	<div class="field">
		<label for="name">Change your name</label>
		<input type="text" name="name" id="name" value="<?php echo $user->data()->name;?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="email">Change your e-mail adress</label>
		<input type="text" name="email" id="email" value="<?php echo $user->data()->email;?>" autocomplete="off">
	</div>

	<input type="hidden" name="token2" value="<?php echo Token::generate();?>">
	<input type="submit" value="Update" />

</form>