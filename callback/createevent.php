<?php
$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

session_start();

if(!isset($_SESSION["user_id"]) || !isset($_POST["title"]) || !isset($_POST["calendarID"]) || !isset($_POST["start"]) || !isset($_POST["end"])){
	die("Missing info");
}
$title = $_POST["title"];
$location = isset($_POST['location']) ? $_POST['location'] : null;
$calendarID = $_POST["calendarID"];
$start = $_POST["start"];
$end = $_POST["end"];
$userIDCreatedBy = $_SESSION["user_id"];

$conn = OpenConnection();

$stmt = $conn->prepare("INSERT INTO `Events`(`Title`, `Location`, `Start`, `End`, `UserIDCreatedBy`, `calendarID`) VALUES (?, ?, ?, ?, ?, ?);");
$stmt->bind_param("ssssii", $title, $location, $start, $end, $userIDCreatedBy, $calendarID);
	
try{
	$stmt->execute();
	CloseConnection($conn);
	header("Location: ../createevent.php?success=true");
	exit();
}catch(mysqli_sql_exception $e){
	$error = $stmt->error;
	$stmt->close();
	if(strpos($error, "FK_Event_CalendarID") !== false){
		CloseConnection($conn);
		exit();
	}else if(strpos($error, "FK_Event_UserIDCreatedBy") !== false){
		CloseConnection($conn);
		exit();
	}else{
		CloseConnection($conn);
		exit();
	}
}
CloseConnection($conn);
header("Location: ../createevent.php?success=false&failure=notimplemented");
exit();
?>
