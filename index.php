<?php
require_once 'core/Init.php';
$user = new User();

?>
<!doctype html>
<html>
	<head>
		<title>Social Network</title>
		<meta charset="UTF-8">
		<link rel="Stylesheet" type="text/css" href="css/main.css">
	</head>

	<body>
		<div id="navigation">
			<ul>
				<li><a href="index.php">Home</a></li>

				<?php
				if ($user->isLoggedIn()) {
				?>
					<li><a href="?site=add_status">Add status</a></li>
					<li><a href="?site=member_list">Member list</a></li>
					<li><a href="?site=profile&id=<?php echo $user->data()->id; ?>">My Profile</a></li>
					<li><a href="?site=edit_profile">Edit Profile</a></li>
					<li><a href="?site=friend_requests">Friend requests</a></li>
					<li><a href="?site=friends_list">Friends list</a></li>
					<li><a href="?site=inbox">Inbox</a></li>
					<li><a href="?site=logout">Log out</a></li>
				<?php
				}
				else {
				?>

				<li><a href="?site=login">Log in</a></li>
				<li><a href="?site=register">Register</a></li>

				<?php
				}
				?>
			</ul>
		</div>

		<div id="content">
			<?php
				if (Session::exists('home')) {
					echo '<div id="flash"><b>'.Session::flash('home').'</b></div>';
				}
			?>

			<?php
			switch (@Input::get('site')) {

			case 'login':
				require_once 'sites/login.php';
				break;

			case 'register':
				require_once 'sites/register.php';
				break;

			case 'logout':
				require_once 'sites/logout.php';
				break;

			case 'profile':
				require_once 'sites/profile.php';
				break;

			case 'edit_profile':
				require_once 'sites/edit_profile.php';
				break;

			case 'member_list':
				require_once 'sites/member_list.php';
				break;

			case 'invite_friend':
				require_once 'sites/invite_friend.php';
				break;

			case 'friend_requests':
				require_once 'sites/friend_requests.php';
				break;

			case 'accept_request':
				require_once 'sites/accept_request.php';
				break;

			case 'friends_list':
				require_once 'sites/friends_list.php';
				break;

			case 'remove_friend':
				require_once 'sites/remove_friend.php';
				break;

			case 'inbox':
				require_once 'sites/inbox.php';
				break;

			case 'send_message':
				require_once 'sites/send_message.php';
				break;

			case 'add_status':
			require_once 'sites/add_status.php';
				break;

			default:
				require_once 'sites/home.php';
				break;				

			}
			?>
		</div>

	</body>
</html>