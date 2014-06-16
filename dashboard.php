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
		<?php 
			// Handles Log In
			$conn = mysql_connect($hostname,$username,$password) or die(mysql_error()); 
			mysql_select_db('crappyblog') or die(mysql_error());
			$conf = parse_ini_file('conf.ini');		
			$a_username = $conf['a_username'];
			$a_password = $conf['a_password'];				
			if(isset($_POST['submit'])){
				if($_POST['username'] == $a_username && $_POST['password'] == $a_password){
					//echo "success!";
					setcookie("logged","true");
				}
				else { echo "Incorrect login."; }
			}
			mysql_close($conn);
		?> 
	</div></div>
	<div class="row admin"><div class="small-12 large-12 columns">
		<article class="posts">
			<section class="logout">
				<a href="/dashboard.php" id="logout">logout</a>
			</section>			
			<!-- Create New Post -->
			<section class="create">
				<header>create new post</header>
				<div class="panel newpost">
					<form action="" method="post" data-abide>
						<input type="text" id="title" placeholder="title" name="title" required /><br/>				
						<textarea id="content" placeholder="content" name="content" required></textarea>
						<input type="submit" name="submitnewpost" value="Submit" class="small radius button">
					</form>
				</div>
			</section>
			<?php
				// Create New Post			
				$conn = mysql_connect($hostname,$username,$password) or die(mysql_error()); 
				mysql_select_db('crappyblog') or die(mysql_error());

				if(isset($_POST['submitnewpost'])){
					$query = "INSERT INTO posts (title, content) VALUES ('" . $_POST['title'] . "', '" . $_POST['content'] . "')";
					//$query = "INSERT INTO posts (title, content) VALUES ('test','testcontent')";
					$result = mysql_query($query);
					if ($result){ echo "new post created!"; }
					else { die(mysql_error()); }
				}
				mysql_close($conn);				
			?>
			
			<!-- Edit Existing Post -->
			<section class="edit">
				<header>edit existing post</header>
				<div class="panel editpost">
					<section class="postlist">
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
									echo '<p>' . $postdate->format('y.m.d') . ' <span class="title"><a href="/dashboard.php?id=' . $post['id'] . '">' . $post['title'] . '</a></span></p>';
								echo '';				
							} 
							mysql_close($conn);
						?> 
					</section>
					<section class="editform">
						<p><a href="#" class="back">back to list</a></p>
						<form action="" method="post" data-abide>						
						<?php
							// Load Post into Edit Form
							$conn = mysql_connect($hostname,$username,$password) or die(mysql_error()); 
							mysql_select_db('crappyblog') or die(mysql_error());
							if($_SERVER['QUERY_STRING'] != "")
							{
								parse_str($_SERVER['QUERY_STRING'], $qs);
								$query = mysql_query("SELECT * FROM posts WHERE id = " . $qs['id']) or die(mysql_error());
							}	
							while($post = mysql_fetch_assoc($query))
							{
								echo '<input type="text" id="title" placeholder="title" name="title" value="' . $post['title'] . '" required /><br/>';				
								echo '<textarea id="content" placeholder="content" name="content" required>' . $post['content'] . '</textarea>';
								echo '<input type="submit" name="submiteditpost" value="Submit" class="small radius button">';
							}
							mysql_close($conn);
						?>
						</form>
					</section>
				</div>
			</section>
		</article>
	</div></div>
	

	<?php require_once('footer.php'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			// toggle login/admin sections
			if($.cookie('logged') == "true"){
				$('.row.login').hide();
				$('.row.admin').show();
			}
			// check for querystring for editing post
			if(getParameterByName('id') != ""){
				//alert("has qs");
				$('.editpost').show();
				$('.postlist').hide();
			}

			// logout clears cookies
			$('#logout').click(function(){
				$.removeCookie('logged');
			});

			// toggle create/edit panels
			$('.create header').click(function(){
				$('.newpost').toggle();
			});

			$('.edit header').click(function(){
				$('.editpost').toggle();
			});

			// show edit form on post click
			$('.postlist .title').click(function(){
				//$('.editform').toggle();
				//$('.postlist').toggle();
				//alert("load post id = " + $(this).attr("data"));
			});

			$('.back').click(function(){
				confirm("are you sure?");
				return true;
				//$('.editform').toggle();
				//$('.postlist').toggle();
			});

			// Get Querystring Value
			function getParameterByName(name) {
			    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
			    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			        results = regex.exec(location.search);
			    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
			}			
		});
	</script>
</body>
</html>