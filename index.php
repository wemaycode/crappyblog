<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
	<title>crappyblog</title>
	<?php require_once('header.php'); ?>
</head>
<body class="home">
	<?php require_once('topnav.php'); ?>

	<?php 
		$conf = parse_ini_file('conf.ini');		
		$hostname = $conf['hostname'];
		$username = $conf['username'];
		$password = $conf['password'];		
		mysql_connect($hostname,$username,$password) or die(mysql_error()); 
		mysql_select_db('crappyblog') or die(mysql_error());
	?>
	<?php
		$query = mysql_query('SELECT * FROM posts ORDER BY date DESC LIMIT 1') or die(mysql_error());
		while($post = mysql_fetch_array($query))
		{
			echo '<div class="row"><div class="small-12 large-12 columns">';
				echo '<h2>' . $post['title'] . '</h2><p>' . $post['date'] . '</p>'. $post['content'];
			echo '</div></div>';				
		} 

	?> 	

	<?php require_once('footer.php'); ?>
	
</body>
</html>