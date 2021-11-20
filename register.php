<?php
session_start();

$email = $_POST["e"];
$username = $_POST["u"];
$pass = $_POST["p"];
$hash = password_hash($pass, PASSWORD_DEFAULT);

$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

$conn = OpenConnection();

$stmt = $conn->prepare("INSERT INTO `Users` (`Username`, `Email`, `hash`) VALUES(?, ?, ?)");
if($stmt === false){
	header("Location: registration.php?success=false&failure=unknown");
	exit();
}
$stmt->bind_param("sss", $username, $email, $hash);
try{
	$stmt->execute();
	CloseConnection($conn);
	header("Location: registration.php?success=true&user=".$username);
	exit();
	//print(json_encode(["Success" => true, "Username" => $row["Username"]]));
}catch(mysqli_sql_exception $e){
	$error = $stmt->error;
	$stmt->close();
	if(strpos($error, "UQ_Username") !== false){
		CloseConnection($conn);
		header("Location: registration.php?success=false&failure=username&user=".$username);
		exit();
	}else if(strpos($error, "UQ_Email") !== false){
		CloseConnection($conn);
		header("Location: registration.php?success=false&failure=email&email=".$email);
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
