<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
	
	<?php require_once('header.php'); ?>
	<?php
		// default query loads most recent
		$query = mysql_query('SELECT * FROM posts ORDER BY date DESC LIMIT 1') or die(mysql_error());
		$title = "crappyblog";
		// check for querystring to load specific post
		if($_SERVER['QUERY_STRING'] != "")
		{
			parse_str($_SERVER['QUERY_STRING'], $qs);
			$query = mysql_query("SELECT * FROM posts WHERE id = " . $qs['id']) or die(mysql_error());
		}	
		while($post = mysql_fetch_assoc($query))
			{	
				if($_SERVER['QUERY_STRING'] != "")
				{
					$title = $post['title'] . " | " . $title;
				}
				echo "<title>" . $title ."</title>";
	?>
</head>
<body class="post">
	<?php require_once('topnav.php'); ?>

	<?php		
				$postdate = new DateTime($post['date']);

				echo '<div class="row"><div class="small-12 large-12 columns">';
					echo '<h2>' . $post['title'] . '</h2>';				
					echo '<p class="date">' . $postdate->format('y.m.d @ H:m') . '</p>';
					echo $post['content'];
				echo '</div></div>';				
			} 
	?> 	

	<!--
	crappyblog.local.com?id=1
	crappyblog.local.com/posts/learning-the-language-of-coding
-->

	<?php require_once('footer.php'); ?>
	
</body>
</html>