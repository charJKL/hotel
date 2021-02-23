import "./css/homepage.css";

import strtotime from "locutus/php/datetime/strtotime.js";

console.log(strtotime);
console.log("works?");

window.addEventListener("load", function(){
	const calendar = document.getElementById("calendar");
	console.log(calendar);
	const months = [1,2];
	months.forEach(function(e){
		// TODO render caledar sheet 
		const month = document.createElement("div");
				month.className = "";
				month.innerHTML = "MONTH";
				
		//calendar.appendChild(month);
	});
});