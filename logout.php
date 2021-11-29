<?php
session_start();
if(isset($_SESSION["logged"]) && $_SESSION["logged"]){
	setcookie("session","-1",time()+1);	
	session_unset();
	session_destroy();
	session_write_close();
}

header("Location: index");
?>
