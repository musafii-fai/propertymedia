 <?php 
	require_once 'core/db_mysqli.php';

	$model  = new Model_mysqli();
	$model->setTable("info_about");
	$getById = $model->getById(1);
	$facebook = $getById["facebook"] == "" ? "#" : $getById["facebook"];
	$twitter = $getById["twitter"] == "" ? "#" : $getById["twitter"];
	$instagram = $getById["instagram"] == "" ? "#" : $getById["instagram"];

	$fbTarget = $facebook == '#' ? '' : 'target="_blank"';
	$twitTarget = $twitter == '#' ? '' : 'target="_blank"';
	$igTarget = $instagram == '#' ? '' : 'target="_blank"';
?>
<ul>
	<li><a <?php echo $fbTarget; ?> href="<?php echo $facebook; ?>"><i class="icon-facebook"></i></a></li>
	<li><a <?php echo $twitTarget; ?> href="<?php echo $twitter; ?>"><i class="icon-twitter"></i></a></li>
	<li><a <?php echo $igTarget; ?> href="<?php echo $instagram; ?>"><i class="icon-instagram"></i></a></li>
</ul>
