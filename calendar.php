<?php
$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Michael Verban</title>
		<?php include 'head.html' ?>
	<link rel="stylesheet" type="text/css" href="style/Calendar.css">
</head>
<body>
	<?php include 'header.php' ?>
		<script type="text/javascript">
				window.onload = function(){document.getElementById('events').className = 'current-item';};
		</script>


	<div id="body">
		<h1>Calendar</h1>
		<p>Here is a calendar of events in the Madison Esports Club.</p>
		<?php include 'calendartable.php' ?>
	</div>
</body>
</html>
