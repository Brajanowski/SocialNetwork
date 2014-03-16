<?php
if ($user->isLoggedIn()) {
	$query = DB::getInstance()->query('SELECT * FROM status ORDER BY id DESC');

	echo '<ul>';
	foreach ($query->results() as $status) {
		$status_author = new User($status->user_id);
		echo '<li><a href="?site=profile&id='.$status_author->data()->id.'">'.$status_author->data()->name.'</a>: <br>'.$status->status.'</li>';
	}
	echo '</ul>';
}
else { 
?>

<div>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilisis eros. Sed erat. In in velit quis arcu ornare laoreet. Curabitur adipiscing luctus massa. Integer ut purus ac augue commodo commodo. Nunc nec mi eu justo tempor consectetuer. Etiam vitae nisl. In dignissim lacus ut ante. Cras elit lectus, bibendum a, adipiscing vitae, commodo et, dui. Ut tincidunt tortor. Donec nonummy, enim in lacinia pulvinar, velit tellus scelerisque augue, ac posuere libero urna eget neque. Cras ipsum. Vestibulum pretium, lectus nec venenatis volutpat, purus lectus ultrices risus, a condimentum risus mi et quam. Pellentesque auctor fringilla neque. Duis eu massa ut lorem iaculis vestibulum. Maecenas facilisis elit sed justo. Quisque volutpat malesuada velit. 
</div>

<?php
}
