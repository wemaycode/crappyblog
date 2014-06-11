<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
	<title>crappyblog</title>
	<?php require_once('header.php'); ?>
</head>
<body class="post">
	<?php require_once('topnav.php'); ?>

	<?php
		//echo "qs(" . $_SERVER['QUERY_STRING'] . ")";

		// check for querystring to load specific post
		if($_SERVER['QUERY_STRING'] != "")
		{
			parse_str($_SERVER['QUERY_STRING'], $qs);
			//echo $qs['id'];

			$query = mysql_query("SELECT * FROM posts WHERE id = " . $qs['id']) or die(mysql_error());

			while($post = mysql_fetch_array($query))
			{
				$postdate = new DateTime($post['date']);

				echo '<div class="row"><div class="small-12 large-12 columns">';
					echo '<h2>' . $post['title'] . '</h2>';				
					echo '<p class="date">' . $postdate->format('y.m.d @ H:m') . '</p>';
					echo $post['content'];
				echo '</div></div>';				
			} 
		}
		//	otherwise load most recent post
		else 
		{	
			$query = mysql_query('SELECT * FROM posts ORDER BY date DESC LIMIT 1') or die(mysql_error());

			while($post = mysql_fetch_array($query))
			{
				$postdate = new DateTime($post['date']);

				echo '<div class="row"><div class="small-12 large-12 columns">';
					echo '<h2>' . $post['title'] . '</h2>';				
					echo '<p class="date">' . $postdate->format('y.m.d @ H:m') . '</p>';
					echo $post['content'];
				echo '</div></div>';				
			} 
		}
	?> 	

	<!--
	crappyblog.local.com?id=1
	crappyblog.local.com/posts/learning-the-language-of-coding
-->

	<?php require_once('footer.php'); ?>
	
</body>
</html>