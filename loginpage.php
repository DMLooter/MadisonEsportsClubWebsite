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

	<div id="body">
		<form action="login.php" method="post">
			<table>
			<tbody>
				<tr>
					<th colspan = "2">
						<h2>Login</h2>
					</th>
				</tr>
				<tr>
					<td><label for="username">Username</label></td>
					<td><input id="username" name="u" /></td>
				</tr>
				<?php
					if(isset($_GET["failure"]) && $_GET["failure"] == "username"){
						print("<tr class='error'><td colspan='2'>* Username is invalid</td></tr>");
					}
				?>
				<tr>
					<td><label for="password">Password</label></td>
					<td><input id="password" name="p" type="password" /></td>
				</tr>
				<?php
					if(isset($_GET["failure"])){
						if($_GET["failure"] == "password"){
							print("<tr class='error'><td colspan='2'>* Invalid Password</td></tr>");
						}else if($_GET["failure"] == "unknown"){
							print("<tr class='error'><td colspan='2'>* An unknown error occured. Please contact Admins</td></tr>");
						}
					}
				?>
			</tbody>
			</table>
			<input type="submit">
		</form>
	</div>
</body>
</html>
