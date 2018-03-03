<?php

if (!isset($model)) {
		die('no model defined...!');	# code...
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $model->title; ?></title>
</head>
<body>
		<div style="width:80%; margin:auto ;">
				<h1>Home View Header...!</h1>
				<span class="content"><?php echo $model->page_content; ?></span>
				<br />
				<span class="contact_info">Contact Info : <?php echo $model->contact_info; ?></span>

		</div>


</body>
</html>