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
				window.onload = function(){document.getElementById('info').className = 'current-item';};
		</script>


	<div id="body">
		<h1>Meet The Board</h1>
		<table>
		<tbody>
		<?php include 'data/board.html' ?>
		</tbody>
		</table>
	</div>
	<script type="text/javascript" src="calendar.js"></script>
</body>
</html>
