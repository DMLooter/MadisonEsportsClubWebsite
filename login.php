<?php
session_start();

$email = $_POST["e"];
$pass = $_POST["p"];

$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

$conn = OpenConnection();

$stmt = $conn->prepare("SELECT `hash`, `Username` FROM `Users` WHERE `Email` = ?;");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows == 1){
	$row = $result->fetch_assoc();
	$stmt->close();
	if (password_verify($pass, $row["hash"])) {
		$_SESSION["user"] = $row["Username"];
		print(json_encode(["Success" => true, "Username" => $row["Username"]]));
	} else {
		print(json_encode(["Success" => false, "Message" => "Invalid Password"]));
	}
}
print(json_encode(["Success" => false, "Message" => "Invalid User"]));

CloseConnection($conn);

?>
