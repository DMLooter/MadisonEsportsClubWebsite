<?php
session_start();

$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

if(isset($_COOKIE["session"])){
	$conn = OpenConnection();
	$stmt = $conn->prepare("SELECT `ID`, `Username` FROM `Users` WHERE `ID` = ?;");
	$stmt->bind_param("i", $_COOKIE["session"]);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows == 1){
		$row = $result->fetch_assoc();
		$stmt->close();
		//Set Session vars
		$_SESSION["logged"] = true;
		$_SESSION["user"] = $row["Username"];
		$_SESSION["user_id"] = $_COOKIE["session"];

		//Set cookie
		setcookie("session",$_COOKIE["session"], time()+(60*60*24*30), "/"); 

		CloseConnection($conn);
		header("Location: index");
		exit();
	}
	$stmt->close();
	CloseConnection($conn);
}
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
