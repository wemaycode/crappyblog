<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
	<title>dashboard | crappyblog</title>
	<?php require_once('header.php'); ?>
</head>
<body class="dashboard">
	<?php require_once('topnav.php'); ?>

	<div class="row"><div class="small-12 large-12 columns">
		<h2>dashboard</h2>
		<div class="content">
			<form action="" method="post" data-abide>
				<div>
	          		<input type="text" id="username" placeholder="username" name="username" required>
				</div>
				<input id="password" name="password" type="password" placeholder="password" required><br/>
				<input type="submit" name="submit" value="Submit" class="small radius button">
			</form>
			<?php 		
				if(isset($_POST['submit'])){
					echo "form submitted";
				}
			?> 
		</div>
	</div></div>

	<?php require_once('footer.php'); ?>
	
</body>
</html>