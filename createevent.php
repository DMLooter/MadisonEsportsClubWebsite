<?php
$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

session_start();

$conn = OpenConnection();
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
		<?php
			if(!isset($_SESSION["logged"]) || !$_SESSION["logged"]){
				print("<h1>Please Log in</h1>");
				print("<p>Only Game Officers, Board Members, and Competitive Team Captains may edit events, please log in</p>");
			}else{
				print("<form action='callback/createevent.php' method='post'>
				<table>
				<tbody>
					<tr>
						<th colspan = '2'>
							<h2>Create Event</h2>
						</th>
					</tr>
					<tr>
						<td><label for='eventtitle'>Title</label></td>
						<td><input id='eventtitle' name='title' /></td>
					</tr>
					<tr>
						<td><label for='location'>Location</label></td>
						<td><input id='location' name='location' /></td>
					</tr>");

				$stmt = $conn->prepare("SELECT c.ID, c.Title FROM UserCalendar uc LEFT JOIN Calendars c ON (uc.CalendarID = c.ID) WHERE uc.UserID = ?;");
//				print("SELECT c.ID, c.Title FROM UserCalendar uc LEFT JOIN Calendars c ON (uc.CalendarID = c.ID) WHERE uc.UserID = ".$_SESSION["user_id"].";");
				$stmt->bind_param("i", $_SESSION["user_id"]);
				$stmt->execute();
				$result = $stmt->get_result();
				print("<tr><td><label for='calendar'>Calendar</label></td><td><select id='calendar' name='calendarID'>");
				while($row = $result->fetch_assoc()){
					print("<option value='".$row["ID"]."'>".$row["Title"]."</option>");
				}
				print("</select></td></tr>");
				print("<tr><td><label for='startdatetime'>Event Start:</label></td>");
				print("<td><input id='startdatetime' name='start' type='datetime-local'/></td></tr>");
				print("<tr><td><label for='enddatetime'>Event End:</label></td>");
				print("<td><input id='enddatetime' name='end' type='datetime-local'/></td></tr>");
			print("</tbody></table><input type='submit'></form>");
			}
			CloseConnection($conn);
		?>
	</div>
</body>
</html>
