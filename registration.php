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
	<link rel="stylesheet" type="text/css" href="style/Registration.css">
</head>
<body>
	<?php include 'header.php' ?>
		<script type="text/javascript">
				window.onload = function(){document.getElementById('events').className = 'current-item';};
		</script>


	<div id="body">
		<form action="register.php" method="post">
			<table>
			<tbody>
				<tr>
					<th colspan = "2">
						<h2>Create An Account</h2>
					</th>
				</tr>
				<tr>
					<td><label for="username">Username</label></td>
					<td><input id="username" name="u" /></td>
				</tr>
				<?php
					if(isset($_GET["failure"]) && $_GET["failure"] == "username"){
						print("<tr class='error'><td colspan='2'>* Username is already taken</td></tr>");
					}
				?>
				<tr>
					<td><label for="email">Email</label></td>
					<td><input id="email" name="e" /></td>
				</tr>
				<?php
					if(isset($_GET["failure"]) && $_GET["failure"] == "email"){
						print("<tr class='error'><td colspan='2'>* Email is already registered</td></tr>");
					}
				?>
				<tr>
					<td><label for="password">Password</label></td>
					<td><input id="password" name="p" type="password" /></td>
				</tr>
				<?php
					if(isset($_GET["failure"]) && $_GET["failure"] == "unknown"){
						print("<tr class='error'><td colspan='2'>* An unknown error occured. Please contact Admins</td></tr>");
					}
				?>
			</tbody>
			</table>
			<input type="submit">
		</form>
	</div>
</body>
</html>
