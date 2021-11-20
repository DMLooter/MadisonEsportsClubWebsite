<?php
session_start();

$email = $_POST["e"];
$username = $_POST["u"];
$pass = $_POST["p"];
$hash = password_hash($pass, PASSWORD_DEFAULT);

$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

$conn = OpenConnection();

$stmt = $conn->prepare("INSERT INTO Users ([Username], [Email], [hash]) VALUES(?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hash);
if($stmt->execute()){
	CloseConnection($conn);
	header("Location: registration.php?success=true&user=".$username);
	exit();
	//print(json_encode(["Success" => true, "Username" => $row["Username"]]));
}else{
	$error = $stmt->error;
	$stmt->close();
	if(str_contains($error, "UQ_Username")){
		CloseConnection($conn);
		header("Location: registration.php?success=false&failure=username&user=".$username);
		exit();
	}else if(str_contains($error, "UQ_Email")){
		CloseConnection($conn);
		header("Location: registration.php?success=false&failure=email&user=".$email);
	exit();
	}else{
		CloseConnection($conn);
		header("Location: registration.php?success=false&failure=unknown");
		exit();
	}
}
CloseConnection($conn);
exit();
?>