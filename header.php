<!-- Includes Files -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">	
<link rel="stylesheet" href="css/foundation.css" />
<link rel="stylesheet" href="css/site.css" />
<link rel="shortcut icon" href="favicon.ico" />
<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/modernizr.js"></script>
<script src="js/jquery.cookie.js"></script>
<!-- Connect to DB -->
<?php 
	$conf = parse_ini_file('conf.ini');		
	$hostname = $conf['hostname'];
	$username = $conf['username'];
	$password = $conf['password'];		
	
?>