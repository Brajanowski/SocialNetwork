<?php
echo '<ol>';
foreach (DB::getInstance()->query('SELECT * FROM users ORDER BY name')->results() as $u) {
	echo '<li><a href="?site=profile&id='.$u->id.'">'.$u->name.'</a></li>';
}
echo '</ol>';