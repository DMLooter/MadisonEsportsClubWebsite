<table id="calendar">
	<tbody>
		<?php
			$today = getdate();
			$month = isset($_GET["month"]) ? $_GET["month"] : $today["mon"];
			$year = isset($_GET["year"]) ? $_GET["year"] : $today["year"];

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

			$input = $month."-".$year;
			$date = DateTime::createFromFormat('d-m-Y', '01-'.$input);
			$firstdate = getdate($date->getTimestamp());

			print("<tr id='header-row'><th colspan=7>".$firstdate['month']."</th></tr>");

			$firstDayOfWeek = $firstdate['wday'];
			$DIM = cal_days_in_month(0, $firstdate['mon'], $firstdate['year']);

			$dow = 0;
			for($dom = 1-$firstDayOfWeek; $dom < $DIM + (7 - ($DIM%7)); $dom++){
				if($dow == 0){
					print("<tr>");
				}
				if($dom > 0 && $dom <= $DIM){
					print("<td class='value'><div class='day'><div class='date'>".$dom."</div>");
					if(array_key_exists($dom, $days)){
						foreach($days[$dom] as $row){
							print("<div class='event'>".$row["Title"]."</div>");
						}
					}
					print("<div class='spacer'></div></div></td>");
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
