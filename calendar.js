function loadCalendar(month, year){
	$.ajax({
		url: `calendartable.php?month=${month}&year=${year}`,
		dataType: "html",
		success: function(data, status){
			$("#calendarTable").replaceWith(data);
			registerHandlers();
		}
	});
}

function registerHandlers(){
	$(".calendarButton").on("click", function(){
		let month = $(this).attr("data-month");
		let year = $(this).attr("data-year");
		loadCalendar(month, year);
	});
}

registerHandlers();
