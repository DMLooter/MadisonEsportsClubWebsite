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
		<h1>Our Affiliated Games</h1>
		<p>These are the official games that we have servers for. Check out each of their pages and servers for more information!</p>
		<table>
		<tbody>
			<?php include 'data/games.html' ?>
		</tbody>
		</table>
	</div>
	<script type="text/javascript" src="calendar.js"></script>
</body>
</html>
