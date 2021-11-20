<?php
session_start();

$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Michael Verban</title>
		<?php include 'head.html' ?>
	<link rel="stylesheet" type="text/css" href="style/Calendar.css">
</head>
<body>
	<?php include 'header.html' ?>
		<script type="text/javascript">
				window.onload = function(){document.getElementById('events').className = 'current-item';};
		</script>


	<div id="body">
		<h1>Calendar</h1>
		<form action="register.php" method="post">
			<label for="username">Username</label>
			<input id="username" name="u" /><br>
			<label for="email">Email</label>
			<input id="email" name="e" /><br>
			<label for="password">Password</label>
			<input id="password" name="p" type="password" /><br>
			<input type="submit">
		</form>
	</div>
</body>
</html>
