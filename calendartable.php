<table id="calendarTable">
	<tbody>
		<?php
			$today = getdate();
			$month = isset($_GET["month"]) ? $_GET["month"] : $today["mon"];
			$year = isset($_GET["year"]) ? $_GET["year"] : $today["year"];

			$dbconfile = parse_ini_file("db.ini")["db_connection_file"];
			require_once $dbconfile;

			session_start();

			$conn = OpenConnection();

			//TODO Make this change by month
			$firstdate = $year."-".$month."-1";
			$lastdate = $year."-".$month."-28";

			$stmt = $conn->prepare("SELECT * FROM `Events` WHERE CAST(`Start` AS DATE) BETWEEN ? AND ? ORDER BY `Start` DESC, `Title`;");
			$stmt->bind_param("ss", $firstdate, $lastdate);
			$stmt->execute();
			$result = $stmt->get_result();

			$days = array();
			while($row = mysqli_fetch_assoc($result)) {
				$title = $row["Title"];
				$loc = $row["Location"];

				//Convert times to hours.
				$startTS = strtotime($row["Start"]);
				$start = getdate($startTS);
				$row["Start"] = date("g:i A", $startTS);

				$endTS = strtotime($row["End"]);
				$end = getdate($endTS);
				$row["End"] = date("g:i A", $endTS);

				if(array_key_exists($start['mday'], $days) === false){
					$days[$start["mday"]] = array();
				}
				$days[$start['mday']][] = $row;	
			}

			CloseConnection($conn);

			$input = $month."-".$year;
			$date = DateTime::createFromFormat('d-m-Y', '01-'.$input);
			$firstdate = getdate($date->getTimestamp());

			$prevMonth = $month - 1;
			$prevYear = $year;
			$nextMonth = $month + 1;
			$nextYear = $year;
			if($prevMonth == 0){
				$prevYear--;
				$prevMonth = 12;
			}else if($nextMonth == 13){
				$nextYear++;
				$nextMonth = 1;
			}

			print("<tr id='header-row'><th><a class='calendarButton_link' href='javascript:void()'><div data-month='".$prevMonth."' data-year='".$prevYear."' class='calendarButton'>Prev</div></a></th><th colspan=5>".$firstdate['month']."</th><th><a class='calendarButton_link' href='javascript:void()'><div class='calendarButton' data-month='".$nextMonth."' data-year='".$nextYear."'>Next</div></a></th></tr>");

			$firstDayOfWeek = $firstdate['wday'];
			$DIM = cal_days_in_month(0, $firstdate['mon'], $firstdate['year']);

			$dow = 0;
			$weeks = ceil(($DIM + $firstDayOfWeek) / 7);
			for($dom = 1-$firstDayOfWeek; $dom <= $weeks * 7 - $firstDayOfWeek; $dom++){
				if($dow == 0){
					print("<tr>");
				}
				if($dom > 0 && $dom <= $DIM){
					print("<td class='value'><div class='day'><div class='date'>".$dom."</div>");
					if(array_key_exists($dom, $days)){
						foreach($days[$dom] as $row){
							//TODO add a calendarID data tag here so we can hide events.
							print("<div class='event' data-event-id='".$row["ID"]."' data-calendar-id='".$row["CalendarID"]."'>".$row["Title"]."</div>");
							print("<div class='tooltip' role='tooltip' data-event-id='".$row["ID"]."'>"
									.$row["Title"]
									."<br>Location: ".$row["Location"]
									."<br>".$row["Start"]." - ".$row["End"]."</div>");
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
