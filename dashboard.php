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
	</div></div>
	<div class="row login"><div class="small-12 large-12 columns">
		<section class="login">
			<form action="" method="post" data-abide>
				<div>
	          		<input type="text" id="username" placeholder="username" name="username" required>
				</div>
				<input id="password" name="password" type="password" placeholder="password" required><br/>
				<input type="submit" name="submit" value="Submit" class="small radius button">
			</form> 
		</section>
	</div></div>
	<div class="row admin"><div class="small-12 large-12 columns">
		<section class="posts">
			<h4>Posts</h4>
			<!-- Create New Post -->
			<article>
				<div id="btnCreate" class="small radius button">Create new post</div><br/>
			</article>
			<!-- Edit Existing Post -->
			<div id="btnEdit" class="small radius button">Edit existing posts</div>
		</section>
	</div></div>
	<?php 
		// Handles Log In
		$conf = parse_ini_file('conf.ini');		
		$a_username = $conf['a_username'];
		$a_password = $conf['a_password'];				
		if(isset($_POST['submit'])){
			if($_POST['username'] == $a_username && $_POST['password'] == $a_password){
				echo "success!";
				setcookie("logged","true");
			}
			else { echo "Incorrect login."; }
		}
	?> 

	<?php require_once('footer.php'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			if($.cookie('logged') == "true"){
				$('.row.login').hide();
				$('.row.admin').show();
			}
		});
	</script>
</body>
</html>