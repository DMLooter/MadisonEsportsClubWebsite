<?php
session_start();

if(!isset($_POST["title"])){
	die("Missing info");
}
/*
$email = $_POST["e"];
$user = $_POST["u"];
$pass = $_POST["p"];

$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

$conn = OpenConnection();
if(isset($_POST["e"])){
	$stmt = $conn->prepare("SELECT `ID`, `hash`, `Username`, `Email` FROM `Users` WHERE `Email` = ?;");
	$stmt->bind_param("s", $email);
	$stmt->execute();
}else{
	$stmt = $conn->prepare("SELECT `ID`, `hash`, `Username`, `Email` FROM `Users` WHERE `Username` = ?;");
	$stmt->bind_param("s", $user);
	$stmt->execute();
}
$result = $stmt->get_result();
if($result->num_rows == 1){
	$row = $result->fetch_assoc();
	$stmt->close();
	if (password_verify($pass, $row["hash"])) {
		//Set Session vars
		$_SESSION["logged"] = true;
		$_SESSION["user"] = $row["Username"];
		$_SESSION["user_id"] = $row["ID"];

		//Set cookie
		setcookie("session",$row["ID"], time()+(60*60*24*30), "/"); 

		CloseConnection($conn);
		header("Location: index");
		//print(json_encode(["Success" => true, "Username" => $row["Username"]]));
		exit();
	} else {
		CloseConnection($conn);
		header("Location: loginpage.php?success=false&failure=password");
		//print(json_encode(["Success" => false, "Message" => "Invalid Password"]));
		exit();
	}
}
CloseConnection($conn);
 */
header("Location: ../createevent.php?success=false&failure=notimplemented");
//print(json_encode(["Success" => false, "Message" => "Invalid User"]));
exit();
?>
