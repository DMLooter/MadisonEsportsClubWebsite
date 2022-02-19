function loadCalendar(month, year){
	$.ajax({
		url: `calendartable.php?month=${month}&year=${year}`,
		dataType: "html",
		success: function(data, status){
			$("#calendarTable").replaceWith(data);
			registerHandlers();
			registerPoppers();
		}
	});
}

function registerHandlers(){
	$(".calendarButton").on("click", function(){
		let month = $(this).attr("data-month");
		let year = $(this).attr("data-year");
		loadCalendar(month, year);
	});
	
	$(".calendarSelector__checkbox").on("change", function(){
		let calendarID = $(this).attr("data-calendar-id");
		if($(this).is(":checked")){
			$(`.event[data-calendar-id='${calendarID}']`).each(function(){
				$(this).show();
			});
		}else{
			$(`.event[data-calendar-id='${calendarID}']`).each(function(){
				$(this).hide();
			});
		}
	});
}

function registerPoppers(){
	$(".event").each(function(){
		const tooltip = $(`.tooltip[data-event-id='${$(this).attr("data-event-id")}']`)[0];

		const popperInstance = Popper.createPopper(this, tooltip, {placement: 'right'});
		this.addEventListener('mouseenter', function(){
			tooltip.setAttribute('data-show','');
			popperInstance.update();
		});
		this.addEventListener('mouseleave', function(){
			tooltip.removeAttribute('data-show');
		});

	});
}


registerHandlers();
registerPoppers();

