<div id="calendarList">
<?php
	session_start();

	$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
	require_once $dbconfile;


	$conn = OpenConnection();


	$stmt = $conn->prepare("SELECT c.ID, c.Title, c.GroupID, g.Name FROM `Calendars` c LEFT JOIN `CalendarGroup` g ON (c.GroupID = g.ID) ORDER BY `GroupID`, `Title`;");
	$stmt->execute();
	$result = $stmt->get_result();

	$groups = array();
	$groupNames = array();
	while($row = $result->fetch_assoc()) {
		$ID = $row["ID"];
		$title = $row["Title"];
		$groupID = $row["GroupID"];
		if(!isset($groups[$groupID])){
			$groups[$groupID] = array();
			$groupNames[$groupID] = $row["Name"];
		}
		$groups[$groupID][$ID] = $title;
	}

	foreach($groups as $groupID => $group){
		print("<div class='calendarGroup'>".$groupNames[$groupID]."</div>");
		foreach($group as $ID => $title){
			print("<div class='calendarSelector'><input class='calendarSelector__checkbox' id='calendarSelector__".$ID."' data-calendar-ID='".$ID."' type='checkbox'/>".$title."</div>");
		}
	}
?>
</div>
