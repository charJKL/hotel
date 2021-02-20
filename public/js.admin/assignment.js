window.addEventListener("load", function(){
	var mouse = {};
	mouse.onMouseDown = function(e)
	{
		console.log(e);
	}
	window.addEventListener("mousedown", mouse.onMouseDown);
});