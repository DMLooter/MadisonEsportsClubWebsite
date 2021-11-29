<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Michael Verban</title>
		<?php include 'head.html' ?>
	<link rel="stylesheet" type="text/css" href="style/Home.css">
</head>
<body>
	<?php include 'header.php' ?>
		<script type="text/javascript">
				window.onload = function(){document.getElementById('home').className = 'current-item';};
		</script>
	<div id="body">
		<h1>Welcome!</h1>
		<p>Welcome to the Madison Esports Club! This is a website in progress!</p>
	</div>
</body>
</html>
