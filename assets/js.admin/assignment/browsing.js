import mouse from "./mouse.js";

window.addEventListener("load", function(){
	const rooms_box = document.querySelector(".assignment-rooms-list-box")
	const schedule = document.querySelector(".assignment-schedule");
	const schedule_box = document.querySelector(".assignment-schedule-box");
	const schedule_grid = document.querySelector(".assignment-schedule-grid");
	const schedule_today = document.querySelector(".assignment-schedule-line-today");
	
	
	const grid_scale = schedule.dataset.gridScale;
	const threshold = 3;
	const context = {};
			context.cursor = {x: 0, y: 0};
			context.position = {x: 0, y: 0};
			context.falseMovement = true;
	const browsing = {};
	browsing.onMouseDown = function(e)
	{
		if(e.button == mouse.leftButton) return; 
		e.preventDefault();
		
		context.cursor.x = e.clientX;
		context.cursor.y = e.clientY;
		context.position.x = parseInt(schedule_box.style.left === "" ? 0 : schedule_box.style.left);
		context.position.y = parseInt(schedule_box.style.top === "" ? 0 : schedule_box.style.top);
		context.falseMovement = true;
		
		schedule.addEventListener("mousemove", browsing.onMouseMove);
	}
	browsing.onMouseUp = function(e)
	{
		if(e.button == mouse.leftButton) return;
		e.preventDefault();
		schedule.removeEventListener("mousemove", browsing.onMouseMove);
		document.body.style.cursor = "";
	}
	browsing.onMouseMove = function(e)
	{
		let diff = {};
			diff.x = context.cursor.x - e.clientX;
			diff.y = context.cursor.y - e.clientY;
			
		let pos = {};
			pos.x = context.position.x - diff.x;
			pos.y = context.position.y - diff.y;
			
		let abs = {};
			abs.x = Math.abs(pos.x);
			abs.y = Math.abs(pos.y);
		if(abs.x > abs.threshold || abs.y > threshold) 
		{
			document.body.style.cursor = "move";
			context.falseMovement = false;
		}
		
		rooms_box.style.top = pos.y + "px";
		schedule_grid.style.top = pos.y + "px";
		schedule_today.style.left = pos.x + (grid_scale * 3) + "px";
		schedule_box.style.left = pos.x + "px";
		schedule_box.style.top = pos.y + "px";
	}
	browsing.onContextMenu = function(e)
	{
		if(context.falseMovement == true) return;
		e.preventDefault();
	}
	schedule.addEventListener("mousedown", browsing.onMouseDown);
	schedule.addEventListener("mouseup", browsing.onMouseUp);
	schedule.addEventListener("contextmenu", browsing.onContextMenu);
});