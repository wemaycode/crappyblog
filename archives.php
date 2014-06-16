<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
	<title>archives | crappyblog</title>
	<?php require_once('header.php'); ?>
</head>
<body class="archives">
	<?php require_once('topnav.php'); ?>

	<div class="row"><div class="small-12 large-12 columns">
		<h2>archives</h2>
		<div class="content">
			<?php 				
				// Load Posts from Db
				$conn = mysql_connect($hostname,$username,$password) or die(mysql_error()); 
				mysql_select_db('crappyblog') or die(mysql_error());

				$query = mysql_query('SELECT * FROM posts ORDER BY date DESC') or die(mysql_error());
				while($post = mysql_fetch_array($query))
				{
					$postdate = new DateTime($post['date']);
					$datetype = gettype($postdate);
					echo '';
						echo '<p>' . $postdate->format('y.m.d') . ' <span class="title"><a href="/?id=' . $post['id'] . '">' . $post['title'] . '</a></span></p>';
					echo '';				
				} 
				mysql_close($conn);
			?> 
		</div>
	</div></div>

	<?php require_once('footer.php'); ?>
</body>
</html>