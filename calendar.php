<?php
$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
require_once $dbconfile;

session_start();

$conn = OpenConnection();

$sql = "SELECT * FROM `Events` ORDER BY `Start` DESC, `Title`;";
$result = mysqli_query($conn, $sql);

$days = array();
while($row = mysqli_fetch_assoc($result)) {
	$title = $row["Title"];
	$loc = $row["Location"];
	$start = getdate(strtotime($row["Start"]));
	$end = getdate(strtotime($row["End"]));
	if(array_key_exists($start['mday'], $days) === false){
		$days[$start["mday"]] = array();
	}
	$days[$start['mday']][] = $row;	
}

CloseConnection($conn);

function getEvents($day, $month, $year){
	global $days;

	$output = "";
	if(array_key_exists($day, $days)){
		foreach($days[$day] as $row){
			$output = $output."<div class='event'>".$row["Title"]."</div>";
		}
	}
	return $output;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Michael Verban</title>
		<?php include 'head.html' ?>
	<link rel="stylesheet" type="text/css" href="style/Calendar.css">
</head>
<body>
	<?php include 'header.php' ?>
		<script type="text/javascript">
				window.onload = function(){document.getElementById('events').className = 'current-item';};
		</script>


	<div id="body">
		<h1>Calendar</h1>
		<p>Here is a calendar of events in the Madison Esports Club.</p>
		<table id="calendar">
		<tbody>
		<?php
			$today = getdate();
			print("<tr id='header-row'><th colspan=7>".$today['month']."</th></tr>");

			$dayNo = $today['mday'];
			$wdayNo = $today['wday'];
			$DIM = cal_days_in_month(0, $today['mon'], $today['year']);
			$firstDay = (($wdayNo - $dayNo + 1) % 7);
			if($firstDay < 0) {
				$firstDay += 7;
			}

			$dow = 0;
			for($dom = 1-$firstDay; $dom < $DIM + (7 - ($DIM%7)); $dom++){
				if($dow == 0){
					print("<tr>");
				}
				if($dom > 0 && $dom <= $DIM){
					print("<td class='value'><div class='day'><div class='date'>".$dom."</div>".getEvents($dom,$today['mon'],$today['year'])."<div class='spacer'></div></div></td>");
				}else{
					print("<td class='blank'></td>");
				}
				if($dow == 6) {
					print("</tr>");
				}
				$dow = ($dow + 1) % 7;
			}
		?>
		</tbody>
		</table>
	</div>
</body>
</html>
