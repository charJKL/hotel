import "./css/homepage.css";
import "./css/homepage/datapicker.css";
import "./css/homepage/reservation.css";

import "jquery-ui/themes/base/core.css";
import "jquery-ui/themes/base/datepicker.css";
import "jquery-ui/themes/base/theme.css";

import $ from 'jquery';
import 'jquery-ui/ui/widgets/datepicker';


Date.prototype.format = function()
{
  let year = this.getFullYear();
  let month = (this.getMonth()+1).toString().padStart(2,"0");
  let day = this.getDate().toString().padStart(2,"0");
  return `${year}-${month}-${day}`;
}


const enumAction = {setStart: 1, setEnd: 2};
$(document).ready(function(){
	// TODO direct input change do not refresh calendar
	const inputStart = $(".reservation-start");
	const inputEnd = $(".reservation-end");
	var start = null;
	var end = null;
	
	let action = enumAction.setStart;
	let event = {}; // just namespace for events
	event.picked = function(dateText)
	{
		let selected = new Date(dateText);
		if(selected < start)
		{
			action = enumAction.setEnd;
			start = end = selected;
			inputStart.val(start.format());
			return;
		}
		
		if(action == enumAction.setStart)
		{
			console.log("start changed", selected);
			action = enumAction.setEnd;
			start = end = selected;
			inputStart.val(start.format());
			return;
		}
		if(action == enumAction.setEnd)
		{
			console.log("end changed", selected);
			action = enumAction.setStart;
			end = selected;
			inputEnd.val(end.format());
			return;
		}
	}
	event.paint = function(date)
	{
		let isSelectable = true;
		if(this.minDate && this.minDate > date) isSelectable = false;
		if(this.maxDate && this.maxDate < date) isSelectable = false;
		
		let cssClass = "";
		if(start && date.toDateString() === start.toDateString()) {cssClass = "ui-state-selected"; }
		if(start && end && date > start && date < end) cssClass = "ui-state-selected";
		if(end && date.toDateString() === end.toDateString()) {cssClass = "ui-state-selected"; }
		return [isSelectable, cssClass, null];
	}
	
	let today = new Date();
	let option = {};
	option.dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]; // TODO get translations from symfony
	option.dayNamesMin = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
	option.dayNamesShort = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
	option.monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	option.monthNamesShort = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	option.firstDay = 1;
	option.hideIfNoPrevNext = true;
	option.formatDate = "yy-mm-dd";
	option.beforeShowDay = event.paint.bind(option);
	option.onSelect = event.picked;
	option.numberOfMonths = 2;
	option.minDate = new Date(today.getFullYear(), today.getMonth(), today.getDate()); // we don't want time
	option.datapicker = $(".reservation-sheet").datepicker(option);
});