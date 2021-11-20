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
		<form action="post" target="register.php">
			<input name="u" />
			<input name="e" />
			<input name="p" type="password" />
		</form>
	</div>
</body>
</html>
